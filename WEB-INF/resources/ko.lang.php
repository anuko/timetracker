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

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Korean (한국어)';
$i18n_months = array('1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월');
$i18n_weekdays = array('일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일');
$i18n_weekdays_short = array('일', '월', '화', '수', '목', '금', '토');
// format mm/dd
$i18n_holidays = array('01/01', '01/25', '01/26', '01/27', '03/02', '03/05', '08/15', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => '로그인',
'menu.logout' => '로그아웃',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => '도움말',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => '프로필',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => '시간',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => '보고서',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => '프로젝트',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => '사용자',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.export' => 'Export',
'menu.clients' => '클라이언트',
'menu.options' => '옵션',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => '데이터베이스 오류.',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => '부정확한 "{0}" 의 데이터.',
'error.empty' => '"{0}" 의 필드가 비어있습니다.',
'error.not_equal' => '"{0}" 의 필드가 "{1}" 의 필드와 같지 않습니다.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => '프로젝트의 선택.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => '클라이언트 선택.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '부정확한 로그인 혹은 암호가 틀립니다.',
'error.user_exists' => '본 로그인과 연계된 사용자가 이미 있습니다.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => '본 이름과 연계된 프로젝트가 이미 있습니다.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => '본 로그인과 연계된 사용자가 없습니다.',
'error.no_groups' => '당신의 데이터베이스는 비어있습니다. 관리자로 로그인하여 새로운 팀을 생성하십시오.', // TODO: replace "team" with "group".
'error.upload' => '파일 업로드 오류.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => '메일 보내기에서의 오류.',
'error.no_email' => '본 로그인과 연계된 이메일이 없습니다.',
// TODO: translate the following.
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => '로그인',
'button.now' => '지금',
'button.save' => '저장',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => '취소',
'button.submit' => '발송',
'button.add' => '추가',
'button.delete' => '삭제',
'button.generate' => '생성',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => '송신',
'button.send_by_email' => '이메일로 송신',
// TODO: translate the following.
// 'button.create_group' => 'Create group',
'button.export' => '팀 익스포트', // TODO: replace "team" with "group".
'button.import' => '팀 임포트', // TODO: replace "team" with "group".
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.group_name' => 'Group name',
// 'label.address' => 'Address',
'label.currency' => '화폐',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => '이름',
'label.thing_name' => '이름',
'label.login' => '로그인ID',
'label.password' => 'Password',
'label.confirm_password' => '암호 확인',
'label.email' => '이메일',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => '제목',
'label.date' => '날짜',
'label.start_date' => '시작 날짜',
'label.end_date' => '마감 날짜',
'label.user' => '사용자',
'label.users' => '사용자',
// TODO: translate the following.
// 'label.roles' => 'Roles',
'label.client' => '클라이언트',
'label.clients' => '클라이언트',
'label.option' => '옵션',
'label.invoice' => '송장',
'label.project' => '프로젝트',
'label.projects' => '프로젝트',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => '시작',
'label.finish' => '마감',
'label.duration' => '기간',
'label.note' => '표식',
'label.notes' => '표식',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
'label.week_total' => '주별 합계',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '오늘',
// TODO: translate the following.
// 'label.view' => 'View',
'label.edit' => '편집',
'label.delete' => '삭제',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => '모두 선택',
'label.select_none' => '모두 해제',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => '식별자',
'label.language' => '언어',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => '날짜 포맷',
'label.time_format' => '시간 포맷',
'label.week_start' => '주의 시작요일',
'label.comment' => '코멘트',
'label.status' => '상태',
'label.tax' => '세금',
'label.subtotal' => '소계',
'label.total' => '합계',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => '혹은',
// TODO: translate the following.
// 'label.error' => 'Error',
'label.ldap_hint' => '아래의 필드들에서 <b>Windows 로그인</b> 및 <b>암호</b> 를 입력하십시오.',
'label.required_fields' => '* 필수 필드',
'label.on_behalf' => '을 대표하여',
// TODO: translate all 3 roles properly, see https://www.anuko.com/time_tracker/user_guide/user_accounts.htm
// This may require different terms for role_manager and role_comanager.
'label.role_manager' => '(관리자)',
'label.role_comanager' => '(공동관리자)',
// 'label.role_admin' => '(administrator)',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// TODO: translate the following.
// 'label.custom_fields' => 'Custom fields',
// 'label.monthly_quotas' => 'Monthly quotas',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
'label.fav_report' => '좋아하는 보고서',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
'label.quantity' => '수량',
// TODO: translate the following.
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => '로그인',
'title.groups' => '팀', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.create_group' => 'Creating Group',
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => '팀 삭제',  // TODO: change "team" to "group".
'title.reset_password' => '암호 재설정',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
'title.time' => '시간',
'title.edit_time_record' => '시간기록을 편집하기',
'title.delete_time_record' => '시간기록을 삭제하기',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => '보고서',
'title.report' => '보고서',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
'title.invoice' => '송장',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => '프로젝트',
'title.add_project' => '프로젝트를 추가하기',
'title.edit_project' => '프로젝트를 편집하기',
'title.delete_project' => '프로젝트를 편집하기',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => '사용자', // TODO: is this correct? Not 사용자를 as below? title.users is for many (plural) users.
                          // title.add, title.edit, and title.delete are for a single user.
'title.add_user' => '사용자를 추가하기', // TODO: is this correct?
'title.edit_user' => '사용자를 편집하기',
'title.delete_user' => '사용자를 삭제하기',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => '클라이언트',
'title.add_client' => '클라이언트 추가',
'title.edit_client' => '클라이언트 편집',
'title.delete_client' => '클라이언트 삭제',
'title.invoices' => '송장',
// TODO: translate the following.
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
// 'title.export' => 'Exporting Group Data',
// 'title.import' => 'Importing Group Data',
'title.options' => '옵션',
'title.profile' => '프로필',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
// 'title.cf_custom_fields' => 'Custom Fields',
// 'title.cf_add_custom_field' => 'Adding Custom Field',
// 'title.cf_edit_custom_field' => 'Editing Custom Field',
// 'title.cf_delete_custom_field' => 'Deleting Custom Field',
// 'title.cf_dropdown_options' => 'Dropdown Options',
// 'title.cf_add_dropdown_option' => 'Adding Option',
// 'title.cf_edit_dropdown_option' => 'Editing Option',
// 'title.cf_delete_dropdown_option' => 'Deleting Option',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- 전부 ---',
'dropdown.no' => '--- 아니 ---',
'dropdown.current_day' => '오늘',
// TODO: translate the following.
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => '일',
'dropdown.current_week' => '이번주',
'dropdown.previous_week' => '전번주',
'dropdown.selected_week' => '주',
'dropdown.current_month' => '이번달',
'dropdown.previous_month' => '전번달',
'dropdown.selected_month' => '달',
'dropdown.current_year' => '올해',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => '전시간',
'dropdown.projects' => '프로젝트',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => '클라이언트',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '암호를 잊으셨습니까?',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '송신한 암호 재설정 요청.', // TODO: add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko Time Tracker 암호 재설정 요청',
// TODO: translate the following.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm 혹은 0.0h)', // TODO: is there a better term for hh:mm as a hint to user what to enter?
'form.time.billable' => '청구가능',
'form.time.uncompleted' => '완성되지 않은',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => '이 기록은 시작 시간으로만 저장되었습니다. 이것은 오류는 아닙니다.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => '좋아하는 것으로 저장',
'form.reports.confirm_delete' => '좋아하는 이 보고서를 삭제해도 좋습니까?',
'form.reports.include_billable' => '청구 가능한',
'form.reports.include_not_billable' => '청구 가능하지 않은',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => '시간 기간을 선택',
'form.reports.set_period' => '혹은 날짜를 설정',
'form.reports.show_fields' => '필드들을 보기',
'form.reports.group_by' => '다음것에 의한 그룹화',
'form.reports.group_by_no' => '--- 그룹화되지 않음 ---',
'form.reports.group_by_date' => '날짜',
'form.reports.group_by_user' => '사용자',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => '프로젝트',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => '오직 전체만',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => '익스포트', // TODO: is this correct?
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => '송장 번호',
'form.invoice.person' => '개인',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: translate the following.
// 'form.charts.interval' => 'Interval',
// 'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: translate the following.
// 'form.projects.active_projects' => 'Active Projects',
// 'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
// TODO: translate the following.
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => '직위', // TODO: is this correct? The term "role" describes user function, as in "team manager role".
'form.users.manager' => '관리자',
'form.users.comanager' => '공동관리자',
'form.users.rate' => '급여',
'form.users.default_rate' => '디폴트 시간당 급여',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
// TODO: translate the following.
// 'form.user_edit.swap_roles' => 'Swap roles',

// Roles form. See example at https://timetracker.anuko.com/roles.php
// TODO: translate the following.
// 'form.roles.active_roles' => 'Active Roles',
// 'form.roles.inactive_roles' => 'Inactive Roles',
// 'form.roles.rank' => 'Rank',
// 'form.roles.rights' => 'Rights',
// 'form.roles.assigned' => 'Assigned',
// 'form.roles.not_assigned' => 'Not assigned',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => '팀의 모든 데이터를 xml 파일로 익스포트 할수 있습니다. 이것은 데이터를 당신자신의 서버에로 옮길때 쓸모있을수 있습니다.',
'form.export.compression' => '압축',
'form.export.compression_none' => '없음',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'xml 파일로부터 팀 데이터를 임포트.', // TODO: replace "team" with "group".
'form.import.file' => '파일 선택',
'form.import.success' => '성과적으로 완료된 임포트.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => '신규 팀관리자 계정을 생성하여 신규 팀을 생성합니다.<br>또한 다른 Anuko Time Tracker 서버 에서 xml 파일로부터 팀 데이터를 임포트할수 있습니다 (로그인 충돌은 허용되지 안음).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
// TODO: translate the following.
// 'form.group_edit.12_hours' => '12 hours',
// 'form.group_edit.24_hours' => '24 hours',
// 'form.group_edit.show_holidays' => 'Show holidays',
// 'form.group_edit.tracking_mode' => 'Tracking mode',
// 'form.group_edit.mode_time' => 'time',
// 'form.group_edit.mode_projects' => 'projects',
// 'form.group_edit.mode_projects_and_tasks' => 'projects and tasks',
// 'form.group_edit.record_type' => 'Record type',
// 'form.group_edit.type_all' => 'all',
// 'form.group_edit.type_start_finish' => 'start and finish',
// 'form.group_edit.type_duration' => 'duration',
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.plugins' => 'Plugins',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => '부터',
'form.mail.to' => '까지', // TODO: is this correct? The meaning is that we send an email TO this person.
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => '송신한 송장.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own reports, charts, and invoices.',
// 'role.supervisor.label' => 'Supervisor',
// 'role.supervisor.low_case_label' => 'supervisor',
// 'role.supervisor.description' => 'A person with a small set of management rights.',
// 'role.comanager.label' => 'Co-manager',
// 'role.comanager.low_case_label' => 'co-manager',
// 'role.comanager.description' => 'A person with a big set of management functions.',
// 'role.manager.label' => 'Manager',
// 'role.manager.low_case_label' => 'manager',
// 'role.manager.description' => 'Group manager. Can do most of things for a group.',
// 'role.top_manager.label' => 'Top manager',
// 'role.top_manager.low_case_label' => 'top manager',
// 'role.top_manager.description' => 'Top group manager. Can do everything in a tree of groups.',
// 'role.admin.label' => 'Administrator',
// 'role.admin.low_case_label' => 'administrator',
// 'role.admin.description' => 'Site adminsitrator.',
);
