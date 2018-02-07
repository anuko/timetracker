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

$i18n_language = '简体中文';
$i18n_months = array('一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月');
$i18n_weekdays = array('星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
$i18n_weekdays_short = array('周日', '周一', '周二', '周三', '周四', '周五', '周六');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '01/25', '01/26', '01/27', '01/28', '01/29', '01/30', '01/31', '05/01', '05/28', '05/29');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => '登录',
'menu.logout' => '注销',
'menu.forum' => '论坛',
'menu.help' => '帮助',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => '简介',
'menu.time' => '时间记录',
'menu.expenses' => '费用',
'menu.reports' => '报告',
'menu.charts' => '图表',
'menu.projects' => '项目',
'menu.tasks' => '任务',
'menu.users' => '用户',
'menu.teams' => '团队',
'menu.export' => '导出数据',
'menu.clients' => '客户',
'menu.options' => '选项',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => '你可以以不同的方式为Time Tracker提建议。',
'footer.credits' => '信用',
'footer.license' => '许可证',
'footer.improve' => '投稿',

// Error messages.
'error.access_denied' => '拒绝访问。',
'error.sys' => '系统错误。',
'error.db' => '数据库错误。',
'error.field' => '不正确的"{0}"数据。',
'error.empty' => '栏目"{0}"为空。',
'error.not_equal' => '栏目"{0}"不等于栏目"{1}"。',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => '选择项目。',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => '选择客户。',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '不正确的用户名或密码。',
'error.user_exists' => '该用户登录信息已经存在。',
'error.project_exists' => '该项目名称已经存在。',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => '具有此名称的客户端已经存在。',
// TODO: translate the following.
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => '没有该登录信息的用户。',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => '上传文件出错。',
'error.range_locked' => '日期范围锁定。',
'error.mail_send' => '发送邮件时出错。',
'error.no_email' => '没有电子邮件与该用户名关联。',
'error.uncompleted_exists' => '未完成的条目已经存在。关闭或删除。',
'error.goto_uncompleted' => '进入未完成的条目。',
// TODO: translate the following.
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => '登录',
'button.now' => '当前时间',
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
'button.generate' => '创建',
'button.reset_password' => '重置密码',
'button.send' => '发送',
'button.send_by_email' => '通过邮件发送',
// TODO: translate the following.
// 'button.create_team' => 'Create team',
'button.export' => '导出团队信息',
'button.import' => '导入团队信息',
'button.close' => '关闭',
// TODO: translate the following.
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => '团队名称',
// TODO: translate the following.
// 'label.address' => 'Address',
'label.currency' => '货币',
'label.manager_name' => '管理员姓名',
'label.manager_login' => '管理员登录',
'label.person_name' => '姓名',
'label.thing_name' => '名称',
'label.login' => '登录',
'label.password' => '密码',
'label.confirm_password' => '确认密码',
'label.email' => '电子邮件',
'label.cc' => '抄送',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => '主题',
'label.date' => '日期',
'label.start_date' => '开始日期',
'label.end_date' => '结束日期',
'label.user' => '用户',
'label.users' => '用户',
'label.client' => '客户',
'label.clients' => '客户',
'label.option' => '选项',
'label.invoice' => '发票',
'label.project' => '项目',
'label.projects' => '项目',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => '开始',
'label.finish' => '结束',
'label.duration' => '持续时间',
'label.note' => '备注',
'label.notes' => '备注',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
'label.week_total' => '一周总计',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今天',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => '编辑',
'label.delete' => '删除',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => '全部选择',
'label.select_none' => '全部不选',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
'label.language' => '语言',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => '日期格式',
'label.time_format' => '时间格式',
'label.week_start' => '每周的第一天',
'label.comment' => '留言',
'label.status' => '状态',
'label.tax' => '税',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
'label.total' => '总计',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => '或',
// TODO: translate the following.
// 'label.error' => 'Error',
'label.ldap_hint' => '在下面的栏目输入您的<b>Windows用户名</b>和<b>密码</b>。',
'label.required_fields' => '* 必填栏目',
'label.on_behalf' => '代表',
'label.role_manager' => '(经理)',
'label.role_comanager' => '(合作经理人)',
'label.role_admin' => '(管理员)',
'label.page' => '页码',
// TODO: translate the following.
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
'label.fav_report' => '收藏的报告',
// TODO: translate the following.
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
'title.login' => '登录',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => '重设密码',
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
'title.invoice' => '发票',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => '项目',
'title.add_project' => '添加项目',
'title.edit_project' => '编辑项目',
'title.delete_project' => '删除项目',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => '用户',
// TODO: translate the following.
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
'title.clients' => '客户',
'title.add_client' => '添加客户',
'title.edit_client' => '编辑客户',
'title.delete_client' => '删除客户',
'title.invoices' => '发票',
// TODO: translate the following.
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
'title.options' => '选项',
'title.profile' => '简介',
// TODO: translate the following.
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
'dropdown.projects' => '项目',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => '客户',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '忘记密码？',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> 是一种简单、易用、开放源代码的实时跟踪系统。',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '密码重设请求已经发送。', // TODO: Add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko时间追踪器密码重设请求',
// TODO: translate the ending of the following.
'form.reset_password.email_body' => "亲爱的用户，\n\n有人，也可能是您自己，请求重新设置您的Anuko时间追踪器密码。如果您希望重设您的密码，请访问下面的连结：\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => '计费时间',
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
'form.reports.save_as_favorite' => '保存到我的收藏夹',
'form.reports.confirm_delete' => '您确认要删除收藏的这个报告吗？',
'form.reports.include_billable' => '计费时间',
'form.reports.include_not_billable' => '非计费时间',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => '选择时间段',
'form.reports.set_period' => '或设定日期',
'form.reports.show_fields' => '显示栏目',
'form.reports.group_by' => '分组方式',
'form.reports.group_by_no' => '--- 没有分组 ---',
'form.reports.group_by_date' => '日期',
'form.reports.group_by_user' => '用户',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => '项目',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: translate the following.
// 'form.report.export' => 'Export',
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
// TODO: translate the following.
// 'form.invoice.number' => 'Invoice number',
// 'form.invoice.person' => 'Person',
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
// 'form.users.role' => 'Role',
// 'form.users.manager' => 'Manager',
// 'form.users.comanager' => 'Co-manager',
// 'form.users.rate' => 'Rate',
// 'form.users.default_rate' => 'Default hourly rate',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
// TODO: translate the following.
// 'form.export.hint' => 'You can export all team data into an xml file. It could be useful if you are migrating data to your own server.',
// 'form.export.compression' => 'Compression',
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: translate the following.
// 'form.import.hint' => 'Import team data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: translate the following.
// 'form.teams.hint' =>  'Create a new team by creating a new team manager account.<br>You can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',



// TODO: refactoring ongoing down from here.

// administrator form
"form.admin.duty_text" => '通过创建新的团队经理账号来创建新团队。<br>您也可以从其它的Anuko时间追踪器服务器的xml文件导入团队数据(登录信息不能发生冲突)。',

"form.admin.profile.title" => '团队',
"form.admin.profile.noprofiles" => '您的数据库没有任何记录。请以管理员身份登录并创建一个新团队。',
"form.admin.profile.comment" => '删除团队',
"form.admin.profile.th.id" => 'ID号',
"form.admin.profile.th.active" => '启用',

// my time form attributes
"form.mytime.title" => '我的时间记录',
"form.mytime.edit_title" => '编辑时间记录',
"form.mytime.del_str" => '删除时间记录',
"form.mytime.time_form" => ' (时:分)',
"form.mytime.total" => '总小时数： ',
"form.mytime.del_yes" => '成功删除时间记录',
"form.mytime.no_finished_rec" => '该记录只保存了开始时间。这不是错误。如果需要，请注销。',
"form.mytime.warn_tozero_rec" => '由于这段时间是锁定的，该时间记录必须删除',
"form.mytime.uncompleted" => '未完成',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '新建管理账号',
"form.profile.edit_title" => '编辑简介',
"form.profile.showchart" => '显示饼状图',

// people form attributes
"form.people.ppl_str" => '人员',
"form.people.createu_str" => '新建用户',
"form.people.edit_str" => '编辑用户',
"form.people.del_str" => '删除用户',
"form.people.th.role" => '角色',
"form.people.th.rate" => '费率',
"form.people.manager" => '经理',
"form.people.comanager" => '合作经理人',

"form.people.rate" => '默认小时收费',
"form.people.comanager" => '合作经理人',

// report attributes
"form.report.title" => '报告',
"form.report.total" => '总计时间',

// mail form attributes
"form.mail.from" => '从',
"form.mail.to" => '到',
"form.mail.above" => '通过电子邮件发送该报告',
// Note to translators: this string needs to be translated.
"form.mail.footer_str" => 'anuko时间跟踪器是一种简单、易用、开放源码的时间跟踪系统。 看<a href ="https://www.anuko.com"> www.anuko网</a>更多信息。',
"form.mail.sending_str" => '<b>消息已发送</b>',

// invoice attributes
"form.invoice.title" => '发票',
"form.invoice.caption" => '发票',
"form.invoice.above" => '发票附加信息',
"form.invoice.select_cust" => '选择客户',
"form.invoice.fillform" => '填写该栏目',
"form.invoice.number" => '发票号码',
"form.invoice.th.username" => '收费人',
"form.invoice.th.time" => '小时数',
"form.invoice.th.rate" => '费率',
"form.invoice.th.summ" => '账号',
"form.invoice.subtotal" => '共计',
"form.invoice.customer" => '客户',
"form.invoice.mailinv_above" => '通过电子邮件发送此发票',
"form.invoice.sending_str" => '<b>发票已送出</b>',

"form.migration.zip" => '压缩',
"form.migration.file" => '选择档',
"form.migration.import.title" => '导入数据',
"form.migration.import.success" => '成功完成导入',
"form.migration.import.text" => '从xml文件导入团队数据',
"form.migration.export.title" => '导出数据',
"form.migration.export.success" => '导出成功',
"form.migration.export.text" => '您可以将所有团队数据导出到xml文件。如果您要将数据转移到您自己的服务器，这项操作很有用。',
"form.migration.compression.none" => '不压缩',
"form.migration.compression.gzip" => 'gzip格式',
"form.migration.compression.bzip" => 'bzip格式',

// miscellaneous strings
"forward.tocsvfile" => '将数据导出到.csv文件',
"forward.toxmlfile" => '将数据导出到.xml文件',
"forward.geninvoice" => '生成发票',

"controls.project_bind" => '--- 全部 ---',
"controls.all" => '--- 全部 ---',
"controls.notbind" => '--- 无 ---',
"controls.per_tm" => '本月',
"controls.per_lm" => '上个月',
"controls.per_tw" => '本周',
"controls.per_lw" => '上周',
"controls.per_td" => '今天',
"controls.per_at" => '全部时间',
"controls.per_ty" => '今年',
);
