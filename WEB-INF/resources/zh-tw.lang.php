<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Chinese (簡體中文)';
$i18n_months = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');
$i18n_weekdays = array('星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$i18n_weekdays_short = array('周日', '週一', '週二', '週三', '週四', '週五', '週六');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => '登錄',
'menu.logout' => '登出',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => '幫助',
// TODO: translate the following.
// 'menu.register' => 'Register',
// 'menu.profile' => 'Profile',
// 'menu.group' => 'Group',
// 'menu.plugins' => 'Plugins',
// 'menu.time' => 'Time',
// 'menu.puncher' => 'Punch',
// 'menu.week' => 'Week',
// 'menu.expenses' => 'Expenses',
'menu.reports' => '報告',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
// 'menu.charts' => 'Charts',
'menu.projects' => '項目',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => '用戶',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
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
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => '資料庫錯誤。',
// TODO: translate the following.
// 'error.registered_recently' => 'Registered recently.',
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => '不正確的"{0}"資料。',
'error.empty' => '欄目"{0}"為空。',
'error.not_equal' => '欄目"{0}"不等於欄目"{1}"。',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => '選擇項目。',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => '選擇客戶。',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '不正確的用戶名或密碼。',
'error.user_exists' => '該使用者登錄資訊已經存在。',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_records' => 'There are no records.',
'error.no_login' => '沒有該登錄資訊的使用者。',
'error.no_groups' => '您的資料庫沒有任何記錄。請以管理員身份登錄並創建一個新團隊。', // TODO: replace "team" with "group".
'error.upload' => '上傳文件出錯。',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => '發送郵件時出錯。',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => '沒有電子郵件與該用戶名關聯。',
// TODO: translate the following.
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',
// 'error.xml' => 'Error in XML file at line %d: %s.',
// 'error.cannot_import' => 'Cannot import: %s.',
// 'error.format' => 'Invalid file format.',
// 'error.user_count' => 'Limit on user count.',
// 'error.expired' => 'Expiration date reached.',
// 'error.file_storage' => 'File storage server error.', // See comment in English file.
// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

// Warning messages.
// TODO: translate the following.
// 'warn.sure' => 'Are you sure?',
// 'warn.confirm_save' => 'Date has changed. Confirm saving, not copying this item.',

// Success messages.
// TODO: translate the following.
// 'msg.success' => 'Operation completed successfully.',

// Labels for buttons.
'button.login' => '登錄',
'button.now' => '當前時間',
'button.save' => '保存',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => '取消',
'button.submit' => '提交',
'button.add' => '添加',
'button.delete' => '刪除',
'button.generate' => '創建',
'button.reset_password' => '重設密碼',
'button.send' => '發送',
'button.send_by_email' => '通過郵件發送',
// TODO: translate the following.
// 'button.create_group' => 'Create group',
'button.export' => '輸出團隊資訊', // TODO: replace "team" with "group".
'button.import' => '輸入團隊資訊', // TODO: replace "team" with "group".
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.start' => 'Start',
// 'button.stop' => 'Stop',
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
// 'label.group_name' => 'Group name',
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
'label.date' => '日期',
// TODO: translate the following.
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
'label.user' => '用戶',
'label.users' => '用戶',
// TODO: translate the following.
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
// 'label.roles' => 'Roles',
'label.client' => '客戶',
'label.clients' => '客戶',
'label.option' => '選項',
'label.invoice' => '發票',
'label.project' => '項目',
'label.projects' => '項目',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => '開始',
'label.finish' => '結束',
'label.duration' => '持續時間',
'label.note' => '備註',
'label.notes' => '備註',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
'label.week_total' => '一周總計',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今天',
// TODO: translate the following.
// 'label.view' => 'View',
'label.edit' => '編輯',
'label.delete' => '刪除',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => '全部選擇',
'label.select_none' => '全部不選',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.puncher' => 'Puncher',
'label.id' => 'ID號',
'label.language' => '語言',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => '日期格式',
'label.time_format' => '時間格式',
'label.week_start' => '每週的第一天',
'label.comment' => '留言',
'label.status' => '狀態',
'label.tax' => '稅',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
'label.total' => '總計',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => '或',
// TODO: translate the following.
// 'label.error' => 'Error',
'label.ldap_hint' => '在下麵的欄目輸入您的<b>Windows用戶名</b>和<b>密碼</b>。',
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
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// TODO: translate the following.
// 'label.custom_fields' => 'Custom fields',
// 'label.monthly_quotas' => 'Monthly quotas',
// 'label.entity' => 'Entity',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
'label.fav_report' => '收藏的報告',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
// 'label.totals_only' => 'Totals only',
// 'label.quota' => 'Quota',
// 'label.timesheet' => 'Timesheet',
// 'label.submitted' => 'Submitted',
// 'label.approved' => 'Approved',
// 'label.approval' => 'Report approval',
// 'label.mark_approved' => 'Mark approved',
// 'label.template' => 'Template',
// 'label.bind_templates_with_projects' => 'Bind templates with projects',
// 'label.prepopulate_note' => 'Prepopulate Note field',
// 'label.attachments' => 'Attachments',
// 'label.files' => 'Files',
// 'label.file' => 'File',
// 'label.active_users' => 'Active Users',
// 'label.inactive_users' => 'Inactive Users',
// 'label.details' => 'Details',
// 'label.budget' => 'Budget',
// 'label.work' => 'Work',   // Table column header for work items, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.offer' => 'Offer', // Table column header for offers, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.contractor' => 'Contractor', // Table column header for offers (contractor is someone who offers to do work).
                                       // Technically, it is either an org name or a combination of org and group names
                                       // because both work items and offers are owned by Time Tracker groups of users.
// 'label.how_to_pay' => 'How to pay', // Label for the "How to pay" field on offers, which allows contractors to specify
                                       // how to pay them, for example: paypal email, check by mail to a specific address, etc.
// 'label.moderator_comment' => 'Moderator comment', // Label for "Moderator comment" field that explains something.

// Entity names. We use lower case (in English) because they are used in dropdowns, too.
// They are used to associate a custom field with an entity type.
// TODO: translate the following.
// 'entity.time' => 'time',
// 'entity.user' => 'user',
// 'entity.project' => 'project',

// Form titles.
// TODO: Translate the following.
// 'title.error' => 'Error',
// 'title.success' => 'Success',
'title.login' => '登錄',
'title.groups' => '團隊', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.add_group' => 'Adding Group',
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => '刪除團隊', // TODO: change "team" to "group".
'title.reset_password' => '重設密碼',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
'title.edit_time_record' => '編輯時間記錄',
'title.delete_time_record' => '刪除時間記錄',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
// 'title.puncher' => 'Puncher',
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.expense_files' => 'Expense Item Files',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => '報告',
'title.report' => '報告',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => '發票',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => '項目',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
'title.add_project' => '添加項目',
'title.edit_project' => '編輯專案', // TODO: is this correct? I do not see 項目 here.
'title.delete_project' => '刪除項目',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => '用戶',
'title.add_user' => '添加用戶', // TODO: is this correct?
'title.edit_user' => '編輯用戶',
'title.delete_user' => '刪除用戶',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => '客戶',
'title.add_client' => '添加客戶',
'title.edit_client' => '編輯客戶',
'title.delete_client' => '刪除客戶',
'title.invoices' => '發票',
// TODO: translate the following.
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
// 'title.monthly_quotas' => 'Monthly Quotas',
// 'title.export' => 'Exporting Group Data',
// 'title.import' => 'Importing Group Data',
'title.options' => '選項',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
// 'title.profile' => 'Profile',
// 'title.plugins' => 'Plugins',
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
// 'title.work_units' => 'Work Units',
// 'title.templates' => 'Templates',
// 'title.add_template' => 'Adding Template',
// 'title.edit_template' => 'Editing Template',
// 'title.delete_template' => 'Deleting Template',
// 'title.edit_file' => 'Editing File',
// 'title.delete_file' => 'Deleting File',
// 'title.download_file' => 'Downloading File',
// 'title.work' => 'Work',
// 'title.add_work' => 'Adding Work',
// 'title.edit_work' => 'Editing Work',
// 'title.delete_work' => 'Deleting Work',
// 'title.active_work' => 'Active Work', // Active work items this group outsources to other groups.
// 'title.available_work' => 'Available Work', // Available work items from other organizations.
// 'title.inactive_work' => 'Inactive Work', // Inactive work items this group was outsourcing to other groups.
// 'title.pending_work' => 'Pending Work', // Work items pending moderator approval.
// 'title.offer' => 'Offer',
// 'title.add_offer' => 'Adding Offer',
// 'title.edit_offer' => 'Editing Offer',
// 'title.delete_offer' => 'Deleting Offer',
// 'title.active_offers' => 'Active Offers', // Active offers this group makes available to other groups.
// 'title.available_offers' => 'Available Offers', // Available offers from other organizations.
// 'title.inactive_offers' => 'Inactive Offers', // Inactive offers for group.
// 'title.pending_offers' => 'Pending Offers', // Offers pending moderator approval.

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- 全部 ---',
'dropdown.no' => '--- 無 ---',
'dropdown.current_day' => '今天',
'dropdown.previous_day' => '昨天',
'dropdown.selected_day' => '天',
'dropdown.current_week' => '本周',
'dropdown.previous_week' => '上周',
'dropdown.selected_week' => '周',
'dropdown.current_month' => '本月',
'dropdown.previous_month' => '上個月', // TODO: is this corrtect? Not 上月?
'dropdown.selected_month' => '月',
'dropdown.current_year' => '今年',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => '年',
'dropdown.all_time' => '全部時間',
'dropdown.projects' => '項目',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => '客戶',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.select_timesheet' => '--- select timesheet ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.pending_approval' => 'pending approval',
// 'dropdown.approved' => 'approved',
// 'dropdown.not_approved' => 'not approved',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',
// 'dropdown.ascending' => 'ascending',
// 'dropdown.descending' => 'descending',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '忘記密碼？',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is an open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '密碼重設請求已經發送。', // TODO: Add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko時間追蹤器密碼重設請求',
// TODO: translate the following.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is an open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(時:分 或 0.0h)',
'form.time.billable' => '計費時間',
'form.time.uncompleted' => '未完成',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => '該記錄只保存了開始時間。這不是錯誤。',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => '保存到我的存檔',
'form.reports.confirm_delete' => '您確認要刪除收藏的這個報告嗎？',
'form.reports.include_billable' => '計費時間',
'form.reports.include_not_billable' => '非計費時間',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => '選擇時間段',
'form.reports.set_period' => '或設定日期',
'form.reports.show_fields' => '顯示欄目',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => '分組方式',
'form.reports.group_by_no' => '--- 沒有分組 ---',
'form.reports.group_by_date' => '日期',
'form.reports.group_by_user' => '用戶',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => '項目',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: translate the following.
// 'form.report.export' => 'Export',
// 'form.report.assign_to_invoice' => 'Assign to invoice',
// 'form.report.assign_to_timesheet' => 'Assign to timesheet',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php
// TODO: translate the following.
// 'form.timesheets.active_timesheets' => 'Active Timesheets',
// 'form.timesheets.inactive_timesheets' => 'Inactive Timesheets',

// Templates form. See example at https://timetracker.anuko.com/templates.php
// TODO: translate the following.
// 'form.templates.active_templates' => 'Active Templates',
// 'form.templates.inactive_templates' => 'Inactive Templates',

// Invoice form. See example at https://timetracker.anuko.com/invoice_view.php
// (you can get to this form after generating an invoice).
'form.invoice.number' => '發票號碼',
'form.invoice.person' => '人', // TODO: is this correct?

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
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => '角色',
'form.users.manager' => '經理',
'form.users.comanager' => '合作經理人',
'form.users.rate' => '費率',
'form.users.default_rate' => '默認小時收費',

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
'form.export.hint' => '您可以將所有團隊資料匯出到xml檔。如果您要將資料轉移到您自己的伺服器，這項操作很有用。',
'form.export.compression' => '壓縮',
'form.export.compression_none' => '不压缩',
'form.export.compression_bzip' => 'bzip格式',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => '從xml檔導入團隊資料。', // TODO: replace "team" with "group".
'form.import.file' => '選擇檔',
'form.import.success' => '成功完成導入。',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => '通過創建新的團隊經理帳號來創建新團隊。<br>您也可以從其它的Anuko時間追蹤器伺服器的xml檔導入團隊資料(登錄資訊不能發生衝突)。',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
// TODO: translate the following.
// 'form.group_edit.12_hours' => '12 hours',
// 'form.group_edit.24_hours' => '24 hours',
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
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
// 'form.group_edit.confirm_save' => 'Confirm saving',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.advanced_settings' => 'Advanced settings',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => '到',
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is an open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => '發票已送出。',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
// TODO: translate the following.
// 'form.work_units.minutes_in_unit' => 'Minutes in unit',
// 'form.work_units.1st_unit_threshold' => '1st unit threshold',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own data.',
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

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
// TODO: translate the following.
// 'form.timesheet_view.submit_subject' => 'Timesheet approval request',
// 'form.timesheet_view.submit_body' => "A new timesheet requires approval.<p>User: %s.",
// 'form.timesheet_view.approve_subject' => 'Timesheet approved',
// 'form.timesheet_view.approve_body' => "Your timesheet %s was approved.<p>%s",
// 'form.timesheet_view.disapprove_subject' => 'Timesheet not approved',
// 'form.timesheet_view.disapprove_body' => "Your timesheet %s was not approved.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
// TODO: translate the following.
// 'form.display_options.note_on_separate_row' => 'Note on separate row',
// 'form.display_options.not_complete_days' => 'Not complete days',
// 'form.display_options.custom_css' => 'Custom CSS',

// Work plugin strings. See example at https://timetracker.anuko.com/work.php
// TODO: translate the following.
// 'work.error.work_not_available' => 'Work item is not available.',
// 'work.error.offer_not_available' => 'Offer is not available.',
// 'work.type.one_time' => 'one time', // Work type is "one time job" for well defined work ("do exactly this").
// 'work.type.ongoing' => 'ongoing',   // Work type is "ongoing" for complex jobs (billed by the hour, multiple contractors, etc.)
// 'work.label.own_work' => 'Own work',
// 'work.label.own_offers' => 'Own offers',
// 'work.label.offers' => 'Offers',
// 'work.button.send_message' => 'Send message',
// 'work.button.make_offer' => 'Make offer',
// 'work.button.accept' => 'Accept',
// 'work.button.decline' => 'Decline',
// 'work.title.send_message' => 'Sending Message',
// 'work.msg.message_sent' => 'Message sent.',
);
