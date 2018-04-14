<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

/*
 * This file generates a report in PDF format using TCPDF library from http://www.tcpdf.org/.
 * If installed, it is expected to be in WEB-INF/lib/tcpdf/ folder.
 */
require_once('initialize.php');
import('form.Form');
import('form.ActionForm');
import('ttReportHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_reports') || ttAccessAllowed('view_reports'))) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Check whether TCPDF library is available.
if (!file_exists('WEB-INF/lib/tcpdf/'))
  die('TCPDF library is not found in WEB-INF/lib/tcpdf/');

// Include TCPDF library.
require_once('WEB-INF/lib/tcpdf/tcpdf.php');

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->group_id);
}

// Report settings are stored in session bean before we get here.
$bean = new ActionForm('reportBean', new Form('reportForm'), $request);

// There are 2 variations of report: totals only, or normal. Totals only means that the report
// is grouped by either date, user, client, project, task or cf_1 and user only needs to see subtotals by group.
$totals_only = ($bean->getAttribute('chtotalsonly') == '1');

// Determine group by header.
$group_by = $bean->getAttribute('group_by');
if ('no_grouping' != $group_by) {
  if ('cf_1' == $group_by)
    $group_by_header = $custom_fields->fields[0]['label'];
  else {
    $key = 'label.'.$group_by;
    $group_by_header = $i18n->get($key);
  }
}

// Obtain items for report.
if (!$totals_only)
  $items = ttReportHelper::getItems($bean); // Individual entries.
if ($totals_only || 'no_grouping' != $group_by)
  $subtotals = ttReportHelper::getSubtotals($bean); // Subtotals for groups of items.
$totals = ttReportHelper::getTotals($bean); // Totals for the entire report.

// Assign variables that are used to print subtotals.
if ($items && 'no_grouping' != $group_by) {
  $print_subtotals = true;
  $first_pass = true;
  $prev_grouped_by = '';
  $cur_grouped_by = '';
}

// Build a string to use as filename for the files being downloaded.
$filename = strtolower($i18n->get('title.report')).'_'.$bean->mValues['start_date'].'_'.$bean->mValues['end_date'];

// Start preparing HTML to build PDF from.
$styleHeader = 'style="background-color:#a6ccf7;"';
$styleSubtotal = 'style="background-color:#e0e0e0;"';
$styleCentered = 'style="text-align:center;"';
$styleRightAligned = 'style="text-align:right;"';

$title = $i18n->get('title.report').": ".$totals['start_date']." - ".$totals['end_date'];
$html = '<h1 style="text-align:center;">'.$title.'</h1>';
$html .= '<table border="1" cellpadding="3" cellspacing="0" width="100%">';

if ($totals_only) {
  // We are building a "totals only" report with only subtotals and total.
  $colspan = 1; // Column span for an empty row.
  // Table header.
  $html .= '<thead>';
  $html .= "<tr $styleHeader>";
  $html .= '<td>'.htmlspecialchars($group_by_header).'</td>';
  if ($bean->getAttribute('chduration')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.duration').'</td>'; }
  if ($bean->getAttribute('chcost')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.cost').'</td>'; }
  $html .= '</tr>';
  $html .= '</thead>';
  // Print subtotals.
  foreach ($subtotals as $subtotal) {
    $html .= '<tr>';
    $html .= '<td>'.htmlspecialchars($subtotal['name']).'</td>';
    if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$subtotal['time'].'</td>';
    if ($bean->getAttribute('chcost')) {
      $html .= "<td $styleRightAligned>";
      if ($user->can('manage_invoices') || $user->isClient())
        $html .= $subtotal['cost'];
      else
        $html .= $subtotal['expenses'];
      $html .= '</td>'; 
    }
    $html .= '</tr>';
  }
  // Print totals.
  $html .= '<tr><td colspan="'.$colspan.'">&nbsp;</td></tr>';
  $html .= "<tr $styleSubtotal>";
  $html .= '<td>'.$i18n->get('label.total').'</td>';
  if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$totals['time'].'</td>';
  if ($bean->getAttribute('chcost')) {
      $html .= "<td $styleRightAligned>";
      $html .= htmlspecialchars($user->currency).' ';
      if ($user->can('manage_invoices') || $user->isClient())
        $html .= $totals['cost'];
      else
        $html .= $totals['expenses'];
      $html .= '</td>';
    }
  $html .= '</tr>';
  $html .= '</table>';
} else {
  // We are building a normal report with items, optionally grouped with subtotals, and total.
  $colspan = 1; // Column span for an empty row.
  // Table header.
  $html .= '<thead>';
  $html .= "<tr $styleHeader>";
  $html .= '<td>'.$i18n->get('label.date').'</td>';
  if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) { $colspan++; $html .= '<td>'.$i18n->get('label.user').'</td>'; }
  if ($bean->getAttribute('chclient')) { $colspan++; $html .= '<td>'.$i18n->get('label.client').'</td>'; }
  if ($bean->getAttribute('chproject')) { $colspan++; $html .= '<td>'.$i18n->get('label.project').'</td>'; }
  if ($bean->getAttribute('chtask')) { $colspan++; $html .= '<td>'.$i18n->get('label.task').'</td>'; }
  if ($bean->getAttribute('chcf_1')) { $colspan++; $html .= '<td>'.htmlspecialchars($custom_fields->fields[0]['label']).'</td>'; }
  if ($bean->getAttribute('chstart')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.start').'</td>'; }
  if ($bean->getAttribute('chfinish')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.finish').'</td>'; }
  if ($bean->getAttribute('chduration')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.duration').'</td>'; }
  if ($bean->getAttribute('chnote')) { $colspan++; $html .= '<td>'.$i18n->get('label.note').'</td>'; }
  if ($bean->getAttribute('chcost')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.cost').'</td>'; }
  if ($bean->getAttribute('chpaid')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.paid').'</td>'; }
  if ($bean->getAttribute('chip')) { $colspan++; $html .= "<td $styleCentered>".$i18n->get('label.ip').'</td>'; }
  if ($bean->getAttribute('chinvoice')) { $colspan++; $html .= '<td>'.$i18n->get('label.invoice').'</td>'; }
  $html .= '</tr>';
  $html .= '</thead>';

  foreach ($items as $item) {
    // Print a subtotal for a block of grouped values.
    $cur_date = $item['date'];
    if ($print_subtotals) {
      $cur_grouped_by = $item['grouped_by'];
      if ($cur_grouped_by != $prev_grouped_by && !$first_pass) {
        $html .= '<tr style="background-color:#e0e0e0;">';
        $html .= '<td>'.$i18n->get('label.subtotal').'</td>';
        if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) {
            $html .= '<td>';
            if ($group_by == 'user') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
            $html .= '</td>';
        }
        if ($bean->getAttribute('chclient')) {
            $html .= '<td>';
            if ($group_by == 'client') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
            $html .= '</td>';
        }
        if ($bean->getAttribute('chproject')) {
            $html .= '<td>';
            if ($group_by == 'project') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
            $html .= '</td>';
        }
        if ($bean->getAttribute('chtask')) {
            $html .= '<td>';
            if ($group_by == 'task') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
            $html .= '</td>';
        }
        if ($bean->getAttribute('chcf_1')) {
            $html .= '<td>';
            if ($group_by == 'cf_1') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
            $html .= '</td>';
        }
        if ($bean->getAttribute('chstart')) $html .= '<td></td>';
        if ($bean->getAttribute('chfinish')) $html .= '<td></td>';
        if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$subtotals[$prev_grouped_by]['time'].'</td>';
        if ($bean->getAttribute('chnote')) $html .= '<td></td>';
        if ($bean->getAttribute('chcost')) {
          $html .= "<td $styleRightAligned>";
          if ($user->can('manage_invoices') || $user->isClient())
            $html .= $subtotals[$prev_grouped_by]['cost'];
          else
            $html .= $subtotals[$prev_grouped_by]['expenses'];
          $html .= '</td>';
        }
        if ($bean->getAttribute('chpaid')) $html .= '<td></td>';
        if ($bean->getAttribute('chip')) $html .= '<td></td>';
        if ($bean->getAttribute('chinvoice')) $html .= '<td></td>';
        $html .= '</tr>';
        $html .= '<tr><td colspan="'.$colspan.'">&nbsp;</td></tr>';
      }
      $first_pass = false; 
    }

    // Print a regular row.
    $html .= '<tr>';
    $html .= '<td>'.$item['date'].'</td>';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) $html .= '<td>'.htmlspecialchars($item['user']).'</td>';
    if ($bean->getAttribute('chclient')) $html .= '<td>'.htmlspecialchars($item['client']).'</td>';
    if ($bean->getAttribute('chproject')) $html .= '<td>'.htmlspecialchars($item['project']).'</td>';
    if ($bean->getAttribute('chtask')) $html .= '<td>'.htmlspecialchars($item['task']).'</td>';
    if ($bean->getAttribute('chcf_1')) $html .= '<td>'.htmlspecialchars($item['cf_1']).'</td>';
    if ($bean->getAttribute('chstart')) $html .= "<td $styleRightAligned>".$item['start'].'</td>';
    if ($bean->getAttribute('chfinish')) $html .= "<td $styleRightAligned>".$item['finish'].'</td>';
    if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$item['duration'].'</td>';
    if ($bean->getAttribute('chnote')) $html .= '<td>'.htmlspecialchars($item['note']).'</td>';
    if ($bean->getAttribute('chcost')) {
      $html .= "<td $styleRightAligned>";
      if ($user->can('manage_invoices') || $user->isClient())
        $html .= $item['cost'];
      else
        $html .= $item['expense'];
      $html .= '</td>';
    }
    if ($bean->getAttribute('chpaid')) {
        $html .= '<td>';
        $html .= $item['paid'] == 1 ? $i18n->get('label.yes') : $i18n->get('label.no');
        $html .= '</td>';
    }
    if ($bean->getAttribute('chip')) {
        $html .= '<td>';
        $html .= $item['modified'] ? $item['modified_ip'].' '.$item['modified'] : $item['created_ip'].' '.$item['created'];
        $html .= '</td>';
    }
    if ($bean->getAttribute('chinvoice')) $html .= '<td>'.htmlspecialchars($item['invoice']).'</td>';
    $html .= '</tr>';

    $prev_date = $item['date'];
    if ($print_subtotals) $prev_grouped_by = $item['grouped_by'];
  }

  // Print a terminating subtotal.
  if ($print_subtotals) {
    $html .= '<tr style="background-color:#e0e0e0;">';
    $html .= '<td>'.$i18n->get('label.subtotal').'</td>';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) {
      $html .= '<td>';
      if ($group_by == 'user') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
      $html .= '</td>';
    }
    if ($bean->getAttribute('chclient')) {
      $html .= '<td>';
      if ($group_by == 'client') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
      $html .= '</td>';
    }
    if ($bean->getAttribute('chproject')) {
      $html .= '<td>';
      if ($group_by == 'project') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
      $html .= '</td>';
    }
    if ($bean->getAttribute('chtask')) {
      $html .= '<td>';
      if ($group_by == 'task') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
      $html .= '</td>';
    }
    if ($bean->getAttribute('chcf_1')) {
      $html .= '<td>';
      if ($group_by == 'cf_1') $html .= htmlspecialchars($subtotals[$prev_grouped_by]['name']);
      $html .= '</td>';
    }
    if ($bean->getAttribute('chstart')) $html .= '<td></td>';
    if ($bean->getAttribute('chfinish')) $html .= '<td></td>';
    if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$subtotals[$prev_grouped_by]['time'].'</td>';
    if ($bean->getAttribute('chnote')) $html .= '<td></td>';
    if ($bean->getAttribute('chcost')) {
      $html .= "<td $styleRightAligned>";
      if ($user->can('manage_invoices') || $user->isClient())
        $html .= $subtotals[$prev_grouped_by]['cost'];
      else
        $html .= $subtotals[$prev_grouped_by]['expenses'];
      $html .= '</td>';
    }
    if ($bean->getAttribute('chpaid')) $html .= '<td></td>';
    if ($bean->getAttribute('chip')) $html .= '<td></td>';
    if ($bean->getAttribute('chinvoice')) $html .= '<td></td>';
    $html .= '</tr>';
  }

  // Print totals.
  $html .= '<tr><td colspan="'.$colspan.'">&nbsp;</td></tr>';
  $html .= '<tr style="background-color:#e0e0e0;">';
  $html .= '<td>'.$i18n->get('label.total').'</td>';
  if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) $html .= '<td></td>';
  if ($bean->getAttribute('chclient')) $html .= '<td></td>';
  if ($bean->getAttribute('chproject')) $html .= '<td></td>';
  if ($bean->getAttribute('chtask')) $html .= '<td></td>';
  if ($bean->getAttribute('chcf_1')) $html .= '<td></td>';
  if ($bean->getAttribute('chstart')) $html .= '<td></td>';
  if ($bean->getAttribute('chfinish')) $html .= '<td></td>';
  if ($bean->getAttribute('chduration')) $html .= "<td $styleRightAligned>".$totals['time'].'</td>';
  if ($bean->getAttribute('chnote')) $html .= '<td></td>';
  if ($bean->getAttribute('chcost')) {
    $html .= "<td $styleRightAligned>".htmlspecialchars($user->currency).' ';
    if ($user->can('manage_invoices') || $user->isClient())
      $html .= $totals['cost'];
    else
      $html .= $totals['expenses'];
    $html .= '</td>';
  }
  if ($bean->getAttribute('chpaid')) $html .= '<td></td>';
  if ($bean->getAttribute('chip')) $html .= '<td></td>';
  if ($bean->getAttribute('chinvoice')) $html .= '<td></td>';
  $html .= '</tr>';
  $html .= '</table>';
}

// Output footer.
if (!defined('REPORT_FOOTER') || !(REPORT_FOOTER == false)) // By default we print it unless explicitely defined as false.
  $html .= '<p style="text-align: center;">'.$i18n->get('form.mail.footer').'</p>';

// By this time we have html ready.

// Determine title for report.
$title = $i18n->get('title.report').": ".$totals['start_date']." - ".$totals['end_date'];

header('Pragma: public'); // This is needed for IE8 to download files over https.
header('Content-Type: text/html; charset=utf-8');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Cache-Control: private', false);

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.$filename.'.pdf"');


// Beginning of TCPDF code here.

// Extend TCPDF class so that we can use custom header and footer.
class ttPDF extends TCPDF {

  public $image_file = 'images/tt_logo.png'; // Image file for the logo in header.
  public $page_word = 'Page'; // Localized "Page" word in footer, ex: Page 1/2.

  // SetImageFile - sets image file name.
  public function SetImageFile($imgFile) {
    $this->image_file = $imgFile;
  }

  // SetPageWord - sets page word for footer.
  public function SetPageWord($pageWord) {
    $this->page_word = $pageWord;
  }

  // Page header.
  public function Header() {
    // Print logo, which is the only element of our custom header.
    $this->Image($this->image_file, 10, 10, '', '', '', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
  }

  // Page footer.
  public function Footer() {
    // Position at 15 mm from bottom.
    $this->SetY(-15);
    // Set font.
    $this->SetFont('freeserif', 'I', 8);
    // Print localized page number.
    $this->Cell(0, 10, $this->page_word.' '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// Create new PDF document.
$pdf = new ttPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// If custom logo file exists - set it.
if (file_exists('images/'.$user->group_id.'.png'))
  $pdf->SetImageFile('images/'.$user->group_id.'.png');

// Set page word for the footer.
$pdf->SetPageWord($i18n->get('label.page'));

// Set document information.
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Anuko Time Tracker');
$pdf->SetTitle('Anuko Time Tracker Report');
$pdf->SetSubject('Anuko Time Tracker Report');
$pdf->SetKeywords('Anuko, time, tracker, report');

// Set margins.
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks.
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor.
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page.
$pdf->AddPage();

// Set font (freeserif seems to work for all languages).
$pdf->SetFont('freeserif', '', 10); // helvetica here does not work for Russian.

// Write HTML.
$pdf->writeHTML($html, true, false, false, false, '');

// Close and output PDF document.
// $pdf->Output('timesheet.pdf', 'I'); // This will display inline in browser.
$pdf->Output($filename.'.pdf', 'D'); // D is for downloads.

// End of of TCPDF code.
