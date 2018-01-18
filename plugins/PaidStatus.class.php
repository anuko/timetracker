<?php
import('ttReportHelper');
class PaidStatus {
  static function markReportPaid($bean) {
    global $user;
    $mdb2 = getConnection();
    $where = ttReportHelper::getWhere($bean);
    
    if ($bean->getAttribute('chclient') || 'client' == $group_by_option)
      $left_joins .= " left join tt_clients c on (c.id = l.client_id)";
    if (($user->canManageTeam() || $user->isClient()) && $bean->getAttribute('chinvoice'))
      $left_joins .= " left join tt_invoices i on (i.id = l.invoice_id and i.status = 1)";
    if ($user->canManageTeam() || $user->isClient() || $user->isPluginEnabled('ex'))
       $left_joins .= " left join tt_users u on (u.id = l.user_id)";
    if ($bean->getAttribute('chproject') || 'project' == $group_by_option)
      $left_joins .= " left join tt_projects p on (p.id = l.project_id)";
    if ($bean->getAttribute('chtask') || 'task' == $group_by_option)
      $left_joins .= " left join tt_tasks t on (t.id = l.task_id)";
    if ($include_cf_1) {
      if ($cf_1_type == CustomFields::TYPE_TEXT)
        $left_joins .= " left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1)";
      elseif ($cf_1_type == CustomFields::TYPE_DROPDOWN) {
        $left_joins .=  " left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1)".
          " left join tt_custom_field_options cfo on (cfl.option_id = cfo.id)";
      }
    }
    
    $sql = "UPDATE tt_log l $left_joins SET paid = TRUE $where";
    
    // Update paid status for this report.
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());
  }
}
