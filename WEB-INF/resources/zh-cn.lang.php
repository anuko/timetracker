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

$i18n_language = 'Chinese (简体中文)';
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
// 'menu.create_group' => 'Create Group',
'menu.profile' => '简介',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => '时间记录',
'menu.expenses' => '费用',
'menu.reports' => '报告',
'menu.charts' => '图表',
'menu.projects' => '项目',
'menu.tasks' => '任务',
'menu.users' => '用户',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
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
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
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
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => '该项目名称已经存在。',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => '具有此名称的客户端已经存在。',
// TODO: translate the following.
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => '没有该登录信息的用户。',
'error.no_groups' => '您的数据库没有任何记录。请以管理员身份登录并创建一个新团队。', // TODO: replace "team" with "group".
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
'button.add' => '添加',
'button.delete' => '删除',
'button.generate' => '创建',
'button.reset_password' => '重置密码',
'button.send' => '发送',
'button.send_by_email' => '通过邮件发送',
// TODO: translate the following.
// 'button.create_group' => 'Create group',
'button.export' => '导出团队信息', // TODO: replace "team" with "group".
'button.import' => '导入团队信息', // TODO: replace "team" with "group".
'button.close' => '关闭',
// TODO: translate the following.
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => '团队名称', // TODO: replace "team" with "group".
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
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
'label.week_total' => '一周总计',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今天',
// TODO: translate the following.
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
'label.id' => 'ID号',
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
// 'label.schedule' => 'Schedule',
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
'title.groups' => '团队', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.create_group' => 'Creating Group',
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => '删除团队', // TODO: change "team" to "group".
'title.reset_password' => '重设密码',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
'title.edit_time_record' => '编辑时间记录',
'title.delete_time_record' => '删除时间记录',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => '报告',
'title.report' => '报告',
// TODO: translate the following.
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
'title.add_user' => '添加用户', // TODO: is this correct?
'title.edit_user' => '编辑用户',
'title.delete_user' => '删除用户',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
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
// 'title.export' => 'Exporting Group Data',
// 'title.import' => 'Importing Group Data',
'title.options' => '选项',
'title.profile' => '简介',
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
'dropdown.all' => '--- 全部 ---',
'dropdown.no' => '--- 无 ---',
'dropdown.current_day' => '今天',
'dropdown.previous_day' => '昨天',
'dropdown.selected_day' => '天',
'dropdown.current_week' => '本周',
'dropdown.previous_week' => '上周',
'dropdown.selected_week' => '周',
'dropdown.current_month' => '本月',
'dropdown.previous_month' => '上个月', // TODO: is this correct? Not 上月?
'dropdown.selected_month' => '月',
'dropdown.current_year' => '今年',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => '全部时间',
'dropdown.projects' => '项目',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => '客户',
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
'form.login.forgot_password' => '忘记密码？',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> 是一种简单、易用、开放源代码的实时跟踪系统。',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '密码重设请求已经发送。', // TODO: Add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko时间追踪器密码重设请求',
// TODO: translate the following.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(时:分 或 0.0h)',
'form.time.billable' => '计费时间',
'form.time.uncompleted' => '未完成',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => '该记录只保存了开始时间。这不是错误。',

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
'form.invoice.number' => '发票号码',
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
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => '角色',
'form.users.manager' => '经理',
'form.users.comanager' => '合作经理人',
'form.users.rate' => '费率',
'form.users.default_rate' => '默认小时收费',

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
'form.export.hint' => '您可以将所有团队数据导出到xml文件。如果您要将数据转移到您自己的服务器，这项操作很有用。',
'form.export.compression' => '压缩',
'form.export.compression_none' => '不压缩',
'form.export.compression_bzip' => 'bzip格式',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => '从xml文件导入团队数据。', // TODO: replace "team" with "group".
'form.import.file' => '选择档',
'form.import.success' => '成功完成导入。',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => '通过创建新的团队经理账号来创建新团队。<br>您也可以从其它的Anuko时间追踪器服务器的xml文件导入团队数据(登录信息不能发生冲突)。',

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
'form.mail.from' => '从',
'form.mail.to' => '到',
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => '发票已送出。',

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
