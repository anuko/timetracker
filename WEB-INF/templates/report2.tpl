<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<div class="section-header">{$i18n.form.report.export} {if file_exists('WEB-INF/lib/tcpdf')}<a href="topdf.php">PDF</a>,{/if} <a href="tofile.php?type=xml">XML</a> {$i18n.label.or} <a href="tofile.php?type=csv">CSV</a></div>
{$forms.reportViewForm.open}
{* totals only report *}
{if $bean->getAttribute('chtotalsonly')}
<table class="x-scrollable-table">
  <tr>
    <th>{$group_by_header|escape}</th>
  {if $bean->getAttribute('chduration')}<th>{$i18n.label.duration}</th>{/if}
  {if $bean->getAttribute('chunits')}<th>{$i18n.label.work_units_short}</th>{/if}
  {if $bean->getAttribute('chcost')}<th>{$i18n.label.cost}</th>{/if}
  </tr>
  {foreach $subtotals as $subtotal}
  <tr>
    <td class="text-cell">{if $subtotal['name']}{$subtotal['name']|escape}{else}&nbsp;{/if}</td>
    {if $bean->getAttribute('chduration')}<td class="time-cell">{$subtotal['time']}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="number-cell">{$subtotal['units']}</td>{/if}
    {if $bean->getAttribute('chcost')}<td class="money-value-cell">{if $user->can('manage_invoices') || $user->isClient()}{$subtotal['cost']}{else}{$subtotal['expenses']}{/if}</td>{/if}
  </tr>
  {/foreach}
  {* print totals *}
  <tr>
    <th class="invoice-label">{$i18n.label.total}:</th>
  {if $bean->getAttribute('chduration')}<td class="time-cell">{$totals['time']}</td>{/if}
  {if $bean->getAttribute('chunits')}<td class="number-cell">{$totals['units']}</td>{/if}
  {if $bean->getAttribute('chcost')}<td class="money-value-cell">{$user->currency|escape} {if $user->can('manage_invoices') || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>{/if}
  </tr>
</table>
{else}
{* normal report *}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.date}</th>
  {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<th>{$i18n.label.user}</th>{/if}
  {* user custom fileds *}
  {if isset($custom_fields) && $custom_fields->userFields}
    {foreach $custom_fields->userFields as $userField}
      {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
      {if $bean->getAttribute($checkbox_control_name)}<th>{{$userField['label']|escape}}</th>{/if}
    {/foreach}
  {/if}
  {if $bean->getAttribute('chclient')}<th>{$i18n.label.client}</th>{/if}
  {if $bean->getAttribute('chproject')}<th>{$i18n.label.project}</th>{/if}
  {if $bean->getAttribute('chtask')}<th>{$i18n.label.task}</th>{/if}
  {* time custom fileds *}
  {if isset($custom_fields) && $custom_fields->timeFields}
    {foreach $custom_fields->timeFields as $timeField}
      {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
      {if $bean->getAttribute($checkbox_control_name)}<th>{{$timeField['label']|escape}}</th>{/if}
    {/foreach}
  {/if}
  {if $bean->getAttribute('chstart')}<th>{$i18n.label.start}</th>{/if}
  {if $bean->getAttribute('chfinish')}<th>{$i18n.label.finish}</th>{/if}
  {if $bean->getAttribute('chduration')}<th>{$i18n.label.duration}</th>{/if}
  {if $bean->getAttribute('chunits')}<th>{$i18n.label.work_units_short}</th>{/if}
  {if $bean->getAttribute('chnote') && !$note_on_separate_row}<th>{$i18n.label.note}</th>{/if}
  {if $bean->getAttribute('chcost')}<th>{$i18n.label.cost}</th>{/if}
  {if $bean->getAttribute('chapproved')}<th>{$i18n.label.approved}</th>{/if}
  {if $bean->getAttribute('chpaid')}<th>{$i18n.label.paid}</th>{/if}
  {if $bean->getAttribute('chip')}<th>{$i18n.label.ip}</th>{/if}
  {if $bean->getAttribute('chinvoice')}<th>{$i18n.label.invoice}</th>{/if}
  {if $bean->getAttribute('chtimesheet')}<th>{$i18n.label.timesheet}</th>{/if}
  {if $bean->getAttribute('chfiles')}<th></th>{/if}
  </tr>
  {foreach $report_items as $item}
  {* print subtotal for a block of grouped values *}
    {$cur_date = $item.date}
    {if $print_subtotals}
      {$cur_grouped_by = $item.grouped_by}
      {if $cur_grouped_by != $prev_grouped_by && !$first_pass}
  <tr>
    <th class="invoice-label">{$i18n.label.subtotal}</th>
        {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="text-cell subtotal-cell">{$subtotals[$prev_grouped_by]['user']|escape}</td>{/if}
        {* user custom fileds *}
        {if isset($custom_fields) && $custom_fields->userFields}
          {foreach $custom_fields->userFields as $userField}
            {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
            {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
          {/foreach}
        {/if}
        {if $bean->getAttribute('chclient')}<td class="text-cell subtotal-cell">{$subtotals[$prev_grouped_by]['client']|escape}</td>{/if}
        {if $bean->getAttribute('chproject')}<td class="text-cell subtotal-cell">{$subtotals[$prev_grouped_by]['project']|escape}</td>{/if}
        {if $bean->getAttribute('chtask')}<td class="text-cell subtotal-cell">{$subtotals[$prev_grouped_by]['task']|escape}</td>{/if}

        {* time custom fileds *}
          {if isset($custom_fields) && $custom_fields->timeFields}
           {foreach $custom_fields->timeFields as $timeField}
            {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
            {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
          {/foreach}
        {/if}
        {if $bean->getAttribute('chstart')}<td></td>{/if}
        {if $bean->getAttribute('chfinish')}<td></td>{/if}
        {if $bean->getAttribute('chduration')}<td class="time-cell subtotal-cell">{$subtotals[$prev_grouped_by]['time']}</td>{/if}
        {if $bean->getAttribute('chunits')}<td class="number-cell subtotal-cell">{$subtotals[$prev_grouped_by]['units']}</td>{/if}
        {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
        {if $bean->getAttribute('chcost')}<td class="money-value-cell subtotal-cell">{if $user->can('manage_invoices') || $user->isClient()}{$subtotals[$prev_grouped_by]['cost']}{else}{$subtotals[$prev_grouped_by]['expenses']}{/if}</td>{/if}
        {if $bean->getAttribute('chapproved')}<td></td>{/if}
        {if $bean->getAttribute('chpaid')}<td></td>{/if}
        {if $bean->getAttribute('chip')}<td></td>{/if}
        {if $bean->getAttribute('chinvoice')}<td></td>{/if}
        {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
        {if $bean->getAttribute('chfiles')}<td></td>{/if}
        {if $use_checkboxes}<td></td>{/if}
    <td></td>{* column for edit icons *}
  </tr>
  <tr><td>&nbsp;</td></tr>
      {/if}
    {$first_pass = false}
    {/if}
    {* print regular row *}
  <tr>
    <td class="date-cell">{$item.date}</td>
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="text-cell">{$item.user|escape}</td>{/if}
    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="control_name" value='user_field_'|cat:$userField['id']}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td class="text-cell">{$item.$control_name|escape}</td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chclient')}<td class="text-cell">{$item.client|escape}</td>{/if}
    {if $bean->getAttribute('chproject')}<td class="text-cell">{$item.project|escape}</td>{/if}
    {if $bean->getAttribute('chtask')}<td class="text-cell">{$item.task|escape}</td>{/if}
    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="control_name" value='time_field_'|cat:$timeField['id']}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td class="text-cell">{$item.$control_name|escape}</td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chstart')}<td class="time-cell">{$item.start}</td>{/if}
    {if $bean->getAttribute('chfinish')}<td class="time-cell">{$item.finish}</td>{/if}
    {if $bean->getAttribute('chduration')}<td class="time-cell">{$item.duration}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="number-cell">{$item.units}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td class="text-cell">{$item.note|escape}</td>{/if}
    {if $bean->getAttribute('chcost')}<td class="money-value-cell">{if $user->can('manage_invoices') || $user->isClient()}{$item.cost}{else}{$item.expense}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td class="yes-no-cell">{if $item.approved == 1}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>{/if}
    {if $bean->getAttribute('chpaid')}<td class="yes-no-cell">{if $item.paid == 1}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>{/if}
    {if $bean->getAttribute('chip')}<td class="text-cell">{if $item.modified}{$item.modified_ip} {$item.modified}{else}{$item.created_ip} {$item.created}{/if}</td>{/if}
    {if $bean->getAttribute('chinvoice')}<td class="text-cell">{$item.invoice|escape}</td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td class="text-cell">{$item.timesheet_name|escape}</td>{/if}
    {if $bean->getAttribute('chfiles')}
      {if 1 == $item.type}<td>{if $item.has_files}<a href="time_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a>{/if}</td>{/if}
      {if 2 == $item.type}<td>{if $item.has_files}<a href="expense_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a>{/if}</td>{/if}
    {/if}
    {if $use_checkboxes}
      {if 1 == $item.type}<td><input type="checkbox" name="log_id_{$item.id}"></td>{/if}
      {if 2 == $item.type}<td><input type="checkbox" name="item_id_{$item.id}"></td>{/if}
    {/if}
    {if $item.approved || $item.timesheet_id || $item.invoice_id}
    <td>&nbsp;</td>
    {else}
      {if 1 == $item.type}<td><a href="time_edit.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>{/if}
      {if 2 == $item.type}<td><a href="expense_edit.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>{/if}
    {/if}
  </tr>
    {if $note_on_separate_row && $bean->getAttribute('chnote') && $item.note}
  <tr>
    <th class="invoice-label">{$i18n.label.note}</td>
    <td colspan="{$colspan}" class="text-cell">{$item.note|escape}</td>
  </tr>
    {/if}
    {$prev_date = $item.date}
    {if $print_subtotals} {$prev_grouped_by = $item.grouped_by} {/if}
  {/foreach}
  {* print a terminating subtotal *}
  {if $print_subtotals}
  <tr>
    <th class="invoice-label">{$i18n.label.subtotal}</th>
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="text-cell subtotal-cell">{$subtotals[$cur_grouped_by]['user']|escape}</td>{/if}

    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chclient')}<td class="text-cell subtotal-cell">{$subtotals[$cur_grouped_by]['client']|escape}</td>{/if}
    {if $bean->getAttribute('chproject')}<td class="text-cell subtotal-cell">{$subtotals[$cur_grouped_by]['project']|escape}</td>{/if}
    {if $bean->getAttribute('chtask')}<td class="text-cell subtotal-cell">{$subtotals[$cur_grouped_by]['task']|escape}</td>{/if}
    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="time-cell subtotal-cell">{$subtotals[$cur_grouped_by]['time']}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="number-cell subtotal-cell">{$subtotals[$cur_grouped_by]['units']}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td class="money-value-cell subtotal-cell">{if $user->can('manage_invoices') || $user->isClient()}{$subtotals[$cur_grouped_by]['cost']}{else}{$subtotals[$cur_grouped_by]['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td></td>{/if}
    {if $bean->getAttribute('chpaid')}<td></td>{/if}
    {if $bean->getAttribute('chip')}<td></td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
    {if $bean->getAttribute('chfiles')}<td></td>{/if}
    {if $use_checkboxes}<td></td>{/if}
    <td></td>{* column for edit icons *}
  </tr>
  {/if}
  {* print totals *}
  <tr><td>&nbsp;</td></tr>
  <tr>
    <th class="invoice-label">{$i18n.label.total}</td>
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td></td>{/if}
    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chclient')}<td></td>{/if}
    {if $bean->getAttribute('chproject')}<td></td>{/if}
    {if $bean->getAttribute('chtask')}<td></td>{/if}
    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}
    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="time-cell subtotal-cell">{$totals['time']}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="number-cell subtotal-cell">{$totals['units']}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td class="money-value-cell subtotal-cell">{$user->currency|escape} {if $user->can('manage_invoices') || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td></td>{/if}
    {if $bean->getAttribute('chpaid')}<td></td>{/if}
    {if $bean->getAttribute('chip')}<td></td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
    {if $bean->getAttribute('chfiles')}<td></td>{/if}
    {if $use_checkboxes}<td></td>{/if}
    <td></td>{* column for edit icons *}
  </tr>
</table>
{/if}
{$forms.reportViewForm.close}






{$forms.reportViewForm.open}
<table width="720">
  <td valign="top">
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
<!-- totals only report -->
{if $bean->getAttribute('chtotalsonly')}
{else}
<!-- normal report -->
      <tr>
        <td class="tableHeader">{$i18n.label.date}</td>
  {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="tableHeader">{$i18n.label.user}</td>{/if}

  {* user custom fileds *}
  {if isset($custom_fields) && $custom_fields->userFields}
    {foreach $custom_fields->userFields as $userField}
      {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
      {if $bean->getAttribute($checkbox_control_name)}<td class="tableHeader">{{$userField['label']|escape}}</td>{/if}
    {/foreach}
  {/if}

  {if $bean->getAttribute('chclient')}<td class="tableHeader">{$i18n.label.client}</td>{/if}
  {if $bean->getAttribute('chproject')}<td class="tableHeader">{$i18n.label.project}</td>{/if}
  {if $bean->getAttribute('chtask')}<td class="tableHeader">{$i18n.label.task}</td>{/if}

  {* time custom fileds *}
  {if isset($custom_fields) && $custom_fields->timeFields}
    {foreach $custom_fields->timeFields as $timeField}
      {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
      {if $bean->getAttribute($checkbox_control_name)}<td class="tableHeader">{{$timeField['label']|escape}}</td>{/if}
    {/foreach}
  {/if}

  {if $bean->getAttribute('chstart')}<td class="tableHeaderCentered" width="5%">{$i18n.label.start}</td>{/if}
  {if $bean->getAttribute('chfinish')}<td class="tableHeaderCentered" width="5%">{$i18n.label.finish}</td>{/if}
  {if $bean->getAttribute('chduration')}<td class="tableHeaderCentered" width="5%">{$i18n.label.duration}</td>{/if}
  {if $bean->getAttribute('chunits')}<td class="tableHeaderCentered" width="5%">{$i18n.label.work_units_short}</td>{/if}
  {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td class="tableHeader">{$i18n.label.note}</td>{/if}
  {if $bean->getAttribute('chcost')}<td class="tableHeaderCentered" width="5%">{$i18n.label.cost}</td>{/if}
  {if $bean->getAttribute('chapproved')}<td class="tableHeader">{$i18n.label.approved}</td>{/if}
  {if $bean->getAttribute('chpaid')}<td class="tableHeader">{$i18n.label.paid}</td>{/if}
  {if $bean->getAttribute('chip')}<td class="tableHeaderCentered">{$i18n.label.ip}</td>{/if}
  {if $bean->getAttribute('chinvoice')}<td class="tableHeader">{$i18n.label.invoice}</td>{/if}
  {if $bean->getAttribute('chtimesheet')}<td class="tableHeader">{$i18n.label.timesheet}</td>{/if}
  {if $bean->getAttribute('chfiles')}<td></td>{/if}
      </tr>
  {foreach $report_items as $item}
    <!-- print subtotal for a block of grouped values -->
    {$cur_date = $item.date}
    {if $print_subtotals}
      {$cur_grouped_by = $item.grouped_by}
      {if $cur_grouped_by != $prev_grouped_by && !$first_pass}
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.subtotal}
        {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="cellLeftAlignedSubtotal">{$subtotals[$prev_grouped_by]['user']|escape}</td>{/if}

        {* user custom fileds *}
        {if isset($custom_fields) && $custom_fields->userFields}
          {foreach $custom_fields->userFields as $userField}
            {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
            {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
          {/foreach}
        {/if}

        {if $bean->getAttribute('chclient')}<td class="cellLeftAlignedSubtotal">{$subtotals[$prev_grouped_by]['client']|escape}</td>{/if}
        {if $bean->getAttribute('chproject')}<td class="cellLeftAlignedSubtotal">{$subtotals[$prev_grouped_by]['project']|escape}</td>{/if}
        {if $bean->getAttribute('chtask')}<td class="cellLeftAlignedSubtotal">{$subtotals[$prev_grouped_by]['task']|escape}</td>{/if}

        {* time custom fileds *}
          {if isset($custom_fields) && $custom_fields->timeFields}
           {foreach $custom_fields->timeFields as $timeField}
            {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
            {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
          {/foreach}
        {/if}

        {if $bean->getAttribute('chstart')}<td></td>{/if}
        {if $bean->getAttribute('chfinish')}<td></td>{/if}
        {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$subtotals[$prev_grouped_by]['time']}</td>{/if}
        {if $bean->getAttribute('chunits')}<td class="cellRightAlignedSubtotal">{$subtotals[$prev_grouped_by]['units']}</td>{/if}
        {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
        {if $bean->getAttribute('chcost')}<td class="cellRightAlignedSubtotal">{if $user->can('manage_invoices') || $user->isClient()}{$subtotals[$prev_grouped_by]['cost']}{else}{$subtotals[$prev_grouped_by]['expenses']}{/if}</td>{/if}
        {if $bean->getAttribute('chapproved')}<td></td>{/if}
        {if $bean->getAttribute('chpaid')}<td></td>{/if}
        {if $bean->getAttribute('chip')}<td></td>{/if}
        {if $bean->getAttribute('chinvoice')}<td></td>{/if}
        {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
        {if $bean->getAttribute('chfiles')}<td></td>{/if}
        {if $use_checkboxes}<td></td>{/if}
        <td></td>{* column for edit icons *}
      </tr>
      <tr><td>&nbsp;</td></tr>
      {/if}
    {$first_pass = false}
    {/if}
      <!--  print regular row -->
      {if $cur_date != $prev_date}
        {if $report_row_class == 'rowReportItem'} {$report_row_class = 'rowReportItemAlt'} {else} {$report_row_class = 'rowReportItem'} {/if}
      {/if}
      <tr class="{$report_row_class}">
        <td class="cellLeftAligned">{$item.date}</td>
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="cellLeftAligned">{$item.user|escape}</td>{/if}

    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="control_name" value='user_field_'|cat:$userField['id']}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td>{$item.$control_name|escape}</td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chclient')}<td class="cellLeftAligned">{$item.client|escape}</td>{/if}
    {if $bean->getAttribute('chproject')}<td class="cellLeftAligned">{$item.project|escape}</td>{/if}
    {if $bean->getAttribute('chtask')}<td class="cellLeftAligned">{$item.task|escape}</td>{/if}

    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="control_name" value='time_field_'|cat:$timeField['id']}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td>{$item.$control_name|escape}</td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chstart')}<td nowrap class="cellRightAligned">{$item.start}</td>{/if}
    {if $bean->getAttribute('chfinish')}<td nowrap class="cellRightAligned">{$item.finish}</td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAligned">{$item.duration}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="cellRightAligned">{$item.units}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td class="cellLeftAligned">{$item.note|escape}</td>{/if}
    {if $bean->getAttribute('chcost')}<td class="cellRightAligned">{if $user->can('manage_invoices') || $user->isClient()}{$item.cost}{else}{$item.expense}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td class="cellRightAligned">{if $item.approved == 1}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>{/if}
    {if $bean->getAttribute('chpaid')}<td class="cellRightAligned">{if $item.paid == 1}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>{/if}
    {if $bean->getAttribute('chip')}<td class="cellRightAligned">{if $item.modified}{$item.modified_ip} {$item.modified}{else}{$item.created_ip} {$item.created}{/if}</td>{/if}
    {if $bean->getAttribute('chinvoice')}<td class="cellRightAligned">{$item.invoice|escape}</td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td class="cellRightAligned">{$item.timesheet_name|escape}</td>{/if}
    {if $bean->getAttribute('chfiles')}
      {if 1 == $item.type}<td class="cellRightAligned">{if $item.has_files}<a href="time_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a>{/if}</td>{/if}
      {if 2 == $item.type}<td class="cellRightAligned">{if $item.has_files}<a href="expense_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a>{/if}</td>{/if}
    {/if}
    {if $use_checkboxes}
      {if 1 == $item.type}<td bgcolor="white"><input type="checkbox" name="log_id_{$item.id}"></td>{/if}
      {if 2 == $item.type}<td bgcolor="white"><input type="checkbox" name="item_id_{$item.id}"></td>{/if}
    {/if}
    {if $item.approved || $item.timesheet_id || $item.invoice_id}
        <td>&nbsp;</td>
    {else}
      {if 1 == $item.type}<td><a href="time_edit.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>{/if}
      {if 2 == $item.type}<td><a href="expense_edit.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>{/if}
    {/if}
      </tr>
    {if $note_on_separate_row && $bean->getAttribute('chnote') && $item.note}
      <tr>
        <td class="cellRightAligned">{$i18n.label.note}:</td>
        <td colspan="{$colspan}">{$item.note|escape}</td>
      </tr>
    {/if}
    {$prev_date = $item.date}
    {if $print_subtotals} {$prev_grouped_by = $item.grouped_by} {/if}
  {/foreach}
  <!-- print a terminating subtotal -->
  {if $print_subtotals}
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.subtotal}
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td class="cellLeftAlignedSubtotal">{$subtotals[$cur_grouped_by]['user']|escape}</td>{/if}

    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chclient')}<td class="cellLeftAlignedSubtotal">{$subtotals[$cur_grouped_by]['client']|escape}</td>{/if}
    {if $bean->getAttribute('chproject')}<td class="cellLeftAlignedSubtotal">{$subtotals[$cur_grouped_by]['project']|escape}</td>{/if}
    {if $bean->getAttribute('chtask')}<td class="cellLeftAlignedSubtotal">{$subtotals[$cur_grouped_by]['task']|escape}</td>{/if}

    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$subtotals[$cur_grouped_by]['time']}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="cellRightAlignedSubtotal">{$subtotals[$cur_grouped_by]['units']}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td class="cellRightAlignedSubtotal">{if $user->can('manage_invoices') || $user->isClient()}{$subtotals[$cur_grouped_by]['cost']}{else}{$subtotals[$cur_grouped_by]['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td></td>{/if}
    {if $bean->getAttribute('chpaid')}<td></td>{/if}
    {if $bean->getAttribute('chip')}<td></td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
    {if $bean->getAttribute('chfiles')}<td></td>{/if}
    {if $use_checkboxes}<td></td>{/if}
        <td></td>{* column for edit icons *}
      </tr>
  {/if}
  <!-- print totals -->
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.total}</td>
    {if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}<td></td>{/if}

    {* user custom fileds *}
    {if isset($custom_fields) && $custom_fields->userFields}
      {foreach $custom_fields->userFields as $userField}
        {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chclient')}<td></td>{/if}
    {if $bean->getAttribute('chproject')}<td></td>{/if}
    {if $bean->getAttribute('chtask')}<td></td>{/if}

    {* time custom fileds *}
    {if isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
        {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
        {if $bean->getAttribute($checkbox_control_name)}<td></td>{/if}
      {/foreach}
    {/if}

    {if $bean->getAttribute('chstart')}<td></td>{/if}
    {if $bean->getAttribute('chfinish')}<td></td>{/if}
    {if $bean->getAttribute('chduration')}<td class="cellRightAlignedSubtotal">{$totals['time']}</td>{/if}
    {if $bean->getAttribute('chunits')}<td class="cellRightAlignedSubtotal">{$totals['units']}</td>{/if}
    {if $bean->getAttribute('chnote') && !$note_on_separate_row}<td></td>{/if}
    {if $bean->getAttribute('chcost')}<td nowrap class="cellRightAlignedSubtotal">{$user->currency|escape} {if $user->can('manage_invoices') || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>{/if}
    {if $bean->getAttribute('chapproved')}<td></td>{/if}
    {if $bean->getAttribute('chpaid')}<td></td>{/if}
    {if $bean->getAttribute('chip')}<td></td>{/if}
    {if $bean->getAttribute('chinvoice')}<td></td>{/if}
    {if $bean->getAttribute('chtimesheet')}<td></td>{/if}
    {if $bean->getAttribute('chfiles')}<td></td>{/if}
    {if $use_checkboxes}<td></td>{/if}
        <td></td>{* column for edit icons *}
      </tr>
{/if}
    </table>
  </td>
</tr>
</table>
{if $report_items && ($use_mark_approved || $use_mark_paid || $use_assign_to_invoice || $use_assign_to_timesheet)}
<table width="720" cellspacing="0" cellpadding="0" border="0">
  {if $use_mark_approved}
  <tr>
    <td align="right">
      <table>
        <tr><td>{$i18n.label.mark_approved}: {$forms.reportViewForm.mark_approved_select_options.control} {$forms.reportViewForm.mark_approved_action_options.control} {$forms.reportViewForm.btn_mark_approved.control}</td></tr>
      </table>
    </td>
  </tr>
  {/if}
  {if $use_mark_paid}
  <tr>
    <td align="right">
      <table>
        <tr><td>{$i18n.label.mark_paid}: {$forms.reportViewForm.mark_paid_select_options.control} {$forms.reportViewForm.mark_paid_action_options.control} {$forms.reportViewForm.btn_mark_paid.control}</td></tr>
      </table>
    </td>
  </tr>
  {/if}
  {if $use_assign_to_invoice}
  <tr>
    <td align="right">
      <table>
        <tr><td>{$i18n.form.report.assign_to_invoice}: {$forms.reportViewForm.assign_invoice_select_options.control} {$forms.reportViewForm.recent_invoice.control} {$forms.reportViewForm.btn_assign_invoice.control}</td></tr>
      </table>
    </td>
  </tr>
  {/if}
  {if $use_assign_to_timesheet}
  <tr>
    <td align="right">
      <table>
        <tr><td>{$i18n.form.report.assign_to_timesheet}: {$forms.reportViewForm.assign_timesheet_select_options.control} {$forms.reportViewForm.timesheet.control} {$forms.reportViewForm.btn_assign_timesheet.control}</td></tr>
      </table>
    </td>
  </tr>
  {/if}
</table>
{/if}
{$forms.reportViewForm.close}

<table width="720" cellspacing="4" cellpadding="4" border="0">
<tr>
  <td align="center">
  <table>
  <tr>
    <td><input type="button" onclick="chLocation('report_send.php');" value="{$i18n.button.send_by_email}"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
