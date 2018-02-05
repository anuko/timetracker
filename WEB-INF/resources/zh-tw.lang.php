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

$i18n_language = '簡體中文';
$i18n_months = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');
$i18n_weekdays = array('星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$i18n_weekdays_short = array('周日', '週一', '週二', '週三', '週四', '週五', '週六');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '01/25', '01/26', '01/27', '01/28', '01/29', '01/30', '04/04', '09/03');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => '登錄',
'menu.logout' => '登出',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => '幫助',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
// 'menu.profile' => 'Profile',
// 'menu.time' => 'Time',
// 'menu.expenses' => 'Expenses',
'menu.reports' => '報告',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => '項目',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => '團隊',
'menu.export' => '輸出資料',
'menu.clients' => '客戶',
'menu.options' => '選項',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: All error messages should be complete sentences with a period (full stop) in the end. Put them there.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => '資料庫錯誤',
'error.field' => '不正確的"{0}"資料',
'error.empty' => '欄目"{0}"為空',
'error.not_equal' => '欄目"{0}"不等於欄目"{1}"',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => '選擇項目',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '不正確的用戶名或密碼',
'error.user_exists' => '該使用者登錄資訊已經存在',
'error.project_exists' => '該專案名稱已經存在',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => '沒有該登錄資訊的使用者',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => '上傳文件出錯',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => '發送郵件時出錯',
'error.no_email' => '沒有電子郵件與該用戶名關聯',
// TODO: translate the following.
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => '登錄',
'button.now' => '當前時間',
'button.save' => '保存',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => '取消',
'button.submit' => '提交',
// TODO: translate the following.
// 'button.add_user' => 'Add user',
// 'button.add_project' => 'Add project',
// 'button.add_task' => 'Add task',
// 'button.add_client' => 'Add client',
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => '添加',
'button.generate' => '創建',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => '發送',
'button.send_by_email' => '通過郵件發送',
// TODO: translate the following.
// 'button.create_team' => 'Create team',
'button.export' => '輸出團隊資訊',
'button.import' => '輸入團隊資訊',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => '貨幣',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => '姓名',
'label.thing_name' => '名稱',
'label.login' => '登錄',
'label.password' => '密碼',
'label.confirm_password' => '確認密碼',
'label.email' => '電子郵件',
'label.cc' => '抄送',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => '主題',
// TODO: translate the following.
// 'label.date' => 'Date',
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
// 'label.user' => 'User',
// 'label.users' => 'Users',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
// 'label.project' => 'Project',
// 'label.projects' => 'Projects',
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
// 'label.start' => 'Start',
// 'label.finish' => 'Finish',
// 'label.duration' => 'Duration',
'label.note' => '備註',
'label.notes' => '備註',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
'label.week_total' => '一周總計',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今天',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => '編輯',
'label.delete' => '刪除',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => '總計',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => '或',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* 必填欄目',
'label.on_behalf' => '代表',
'label.role_manager' => '(經理)',
'label.role_comanager' => '(合作經理人)',
'label.role_admin' => '(管理員)',
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
// 'label.fav_report' => 'Favorite report',
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => '登錄',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => '重設密碼',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
// 'title.edit_time_record' => 'Editing Time Record',
// 'title.delete_time_record' => 'Deleting Time Record',
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
// 'title.reports' => 'Reports',
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
// 'title.projects' => 'Projects',
// 'title.add_project' => 'Adding Project',
// 'title.edit_project' => 'Editing Project',
// 'title.delete_project' => 'Deleting Project',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
// 'title.users' => 'Users',
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
// 'title.clients' => 'Clients',
// 'title.add_client' => 'Adding Client',
// 'title.edit_client' => 'Editing Client',
// 'title.delete_client' => 'Deleting Client',
// 'title.invoices' => 'Invoices',
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
// 'title.export' => 'Exporting Team Data',
// 'title.import' => 'Importing Team Data',
// 'title.options' => 'Options',
// 'title.profile' => 'Profile',
// 'title.cf_custom_fields' => 'Custom Fields',
// 'title.cf_add_custom_field' => 'Adding Custom Field',
// 'title.cf_edit_custom_field' => 'Editing Custom Field',
// 'title.cf_delete_custom_field' => 'Deleting Custom Field',
// 'title.cf_dropdown_options' => 'Dropdown Options',
// 'title.cf_add_dropdown_option' => 'Adding Option',
// 'title.cf_edit_dropdown_option' => 'Editing Option',
// 'title.cf_delete_dropdown_option' => 'Deleting Option',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
// TODO: translate the following.
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
// 'dropdown.current_week' => 'this week',
// 'dropdown.previous_week' => 'previous week',
// 'dropdown.selected_week' => 'week',
// 'dropdown.current_month' => 'this month',
// 'dropdown.previous_month' => 'previous month',
// 'dropdown.selected_month' => 'month',
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
// 'dropdown.projects' => 'projects',
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '忘記密碼？',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => '計費時間',
// TODO: translate the following.
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
// TODO: translate the following.
// 'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
// TODO: translate the following.
// 'form.reports.save_as_favorite' => 'Save as favorite',
'form.reports.confirm_delete' => '您確認要刪除收藏的這個報告嗎？',
'form.reports.include_billable' => '計費時間',
'form.reports.include_not_billable' => '非計費時間',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => '選擇時間段',
'form.reports.set_period' => '或設定日期',
'form.reports.show_fields' => '顯示欄目',
'form.reports.group_by' => '分組方式',
'form.reports.group_by_no' => '--- 沒有分組 ---',
// TODO: translate the following.
// 'form.reports.group_by_date' => 'date',
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
// 'form.reports.group_by_project' => 'project',
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',



// TODO: refactoring ongoing down from here.

"form.filter.project" => '項目',
"form.filter.filter" => '收藏的報告',
"form.filter.filter_new" => '保存到我的存檔',

// password reminder form attributes
"form.fpass.login" => '登錄',
"form.fpass.send_pass_str" => '密碼重設請求已經發送',
"form.fpass.send_pass_subj" => 'Anuko時間追蹤器密碼重設請求',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "親愛的用戶，\n\n有人，也可能是您自己，請求重新設置您的Anuko時間追蹤器密碼。如果您希望重設您的密碼，請訪問下麵的連結：\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "要重設密碼，請輸入新密碼並點擊保存按鈕",

// administrator form
"form.admin.title" => '管理員',
"form.admin.duty_text" => '通過創建新的團隊經理帳號來創建新團隊。<br>您也可以從其它的Anuko時間追蹤器伺服器的xml檔導入團隊資料(登錄資訊不能發生衝突)。',

"form.admin.change_pass" => '修改管理員帳號的密碼',
"form.admin.profile.title" => '團隊',
"form.admin.profile.noprofiles" => '您的資料庫沒有任何記錄。請以管理員身份登錄並創建一個新團隊。',
"form.admin.profile.comment" => '刪除團隊',
"form.admin.profile.th.id" => 'ID號',
"form.admin.profile.th.active" => '啟動',
"form.admin.options" => '選項',
"form.admin.custom_date_format" => "日期格式",
"form.admin.custom_time_format" => "時間格式",
"form.admin.start_week" => "每週的第一天",

// my time form attributes
"form.mytime.title" => '我的時間記錄',
"form.mytime.edit_title" => '編輯時間記錄',
"form.mytime.del_str" => '刪除時間記錄',
"form.mytime.time_form" => ' (時:分)',
"form.mytime.date" => '日期',
"form.mytime.project" => '項目',
"form.mytime.start" => '開始',
"form.mytime.finish" => '結束',
"form.mytime.duration" => '持續時間',
"form.mytime.daily" => '每日工作',
"form.mytime.total" => '總小時數： ',
"form.mytime.th.project" => '項目',
"form.mytime.th.start" => '開始',
"form.mytime.th.finish" => '結束',
"form.mytime.th.duration" => '持續時間',
"form.mytime.del_yes" => '成功刪除時間記錄',
"form.mytime.no_finished_rec" => '該記錄只保存了開始時間。這不是錯誤。如果需要，請登出。',
"form.mytime.warn_tozero_rec" => '由於這段時間是鎖定的，該時間記錄必須刪除',
"form.mytime.uncompleted" => '未完成',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '創建新管理帳號',
"form.profile.edit_title" => '編輯簡介',
"form.profile.login" => '登錄',

"form.profile.showchart" => '顯示餅狀圖',
"form.profile.lang" => '語言',
"form.profile.custom_date_format" => "日期格式",
"form.profile.custom_time_format" => "時間格式",
"form.profile.default_format" => "(默認)",
"form.profile.start_week" => "每週的第一天",

// people form attributes
"form.people.ppl_str" => '人員',
"form.people.createu_str" => '新建用戶',
"form.people.edit_str" => '編輯用戶',
"form.people.del_str" => '刪除用戶',
"form.people.th.login" => '登錄',
"form.people.th.role" => '角色',
"form.people.th.status" => '狀態',
"form.people.th.project" => '項目',
"form.people.th.rate" => '費率',
"form.people.manager" => '經理',
"form.people.comanager" => '合作經理人',
"form.people.empl" => '用戶',
"form.people.login" => '登錄',

"form.people.rate" => '默認小時收費',
"form.people.comanager" => '合作經理人',
"form.people.projects" => '項目',

// projects form attributes
"form.project.proj_title" => '項目',
"form.project.edit_str" => '編輯專案',
"form.project.add_str" => '添加新項目',
"form.project.del_str" => '刪除項目',

// activities form attributes
"form.activity.act_title" => '活動',
"form.activity.add_title" => '新建活動',
"form.activity.edit_str" => '編輯活動',
"form.activity.del_str" => '刪除活動',
"form.activity.project" => '項目',
"form.activity.th.project" => '項目',

// report attributes
"form.report.title" => '報告',
"form.report.from" => '開始日期',
"form.report.to" => '結束日期',
"form.report.groupby_user" => '用戶',
"form.report.groupby_project" => '項目',
"form.report.duration" => '持續時間',
"form.report.start" => '開始',
"form.report.finish" => '結束',
"form.report.project" => '項目',
"form.report.totals_only" => '僅僅今天',
"form.report.total" => '總計時間',
"form.report.th.empllist" => '用戶',
"form.report.th.date" => '日期',
"form.report.th.project" => '項目',
"form.report.th.start" => '開始',
"form.report.th.finish" => '結束',
"form.report.th.duration" => '持續時間',

// mail form attributes
"form.mail.from" => '從',
"form.mail.to" => '到',
"form.mail.comment" => '留言',
"form.mail.above" => '通過電子郵件發送該報告',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>消息已發送</b>',

// invoice attributes
"form.invoice.title" => '發票',
"form.invoice.caption" => '發票',
"form.invoice.above" => '發票附加資訊',
"form.invoice.select_cust" => '選擇客戶',
"form.invoice.fillform" => '填寫該欄目',
"form.invoice.date" => '日期',
"form.invoice.number" => '發票號碼',
"form.invoice.tax" => '稅',
"form.invoice.comment" => '留言',
"form.invoice.th.username" => '收費人',
"form.invoice.th.time" => '小時數',
"form.invoice.th.rate" => '費率',
"form.invoice.th.summ" => '帳號',
"form.invoice.subtotal" => '共計',
"form.invoice.customer" => '客戶',
"form.invoice.mailinv_above" => '通過電子郵件發送此發票',
"form.invoice.sending_str" => '<b>發票已送出</b>',

"form.migration.zip" => '壓縮',
"form.migration.file" => '選擇檔',
"form.migration.import.title" => '導入數據',
"form.migration.import.success" => '成功完成導入',
"form.migration.import.text" => '從xml檔導入團隊資料',
"form.migration.export.title" => '匯出數據',
"form.migration.export.success" => '成功完成匯出',
"form.migration.export.text" => '您可以將所有團隊資料匯出到xml檔。如果您要將資料轉移到您自己的伺服器，這項操作很有用。',
"form.migration.compression.none" => '不压缩',
"form.migration.compression.gzip" => 'gzip格式',
"form.migration.compression.bzip" => 'bzip格式',

"form.client.title" => '客戶',
"form.client.add_title" => '添加客戶',
"form.client.edit_title" => '編輯客戶',
"form.client.del_title" => '刪除客戶',
"form.client.tax" => '稅',
"form.client.comment" => '備註',

// miscellaneous strings
"forward.tocsvfile" => '將資料輸出到.csv文件',
"forward.toxmlfile" => '將資料輸出到.xml文件',
"forward.geninvoice" => '生成發票',

"controls.select.client" => '--- 選擇客戶 ---',
"controls.project_bind" => '--- 全部 ---',
"controls.all" => '--- 全部 ---',
"controls.notbind" => '--- 無 ---',
"controls.per_tm" => '本月',
"controls.per_lm" => '上個月',
"controls.per_tw" => '本周',
"controls.per_lw" => '上周',
"controls.per_td" => '今天',
"controls.per_at" => '全部時間',
"controls.per_ty" => '今年',

"label.inv_str" => '發票',
"label.set_empl" => '選擇用戶',
"label.sel_all" => '全部選擇',
"label.sel_none" => '全部不選',
"label.disable" => '禁用',
"label.enable" => '啟用',
"label.hrs" => '小時',
"label.errors" => '錯誤',
"label.ldap_hint" => '在下麵的欄目輸入您的<b>Windows用戶名</b>和<b>密碼</b>。',
);
