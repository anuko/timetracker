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
// 'error.project' => 'Select project.',
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
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
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => '团队名称',
// TODO: translate the following.
// 'label.address' => 'Address',
'label.currency' => '货币',
'label.manager_name' => '管理员姓名',
'label.manager_login' => '管理员登录',
// TODO: translate the following.
// 'label.person_name' => 'Name',
// 'label.thing_name' => 'Name',
// 'label.login' => 'Login',
'label.password' => '密码',
'label.confirm_password' => '确认密码',
'label.email' => '电子邮件',
'label.cc' => '抄送',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => '主题',
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
// 'label.note' => 'Note',
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => '今天',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
// 'label.edit' => 'Edit',
'label.delete' => '删除',
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
'label.total' => '总计',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
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
// TODO: translate the following.
// 'title.login' => 'Login',
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
// TODO: translate the following.
// 'form.login.forgot_password' => 'Forgot password?',
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",



// TODO: refactoring ongoing down from here.

// TODO: everything below needs serious work and be synchronized with the master English file.
// For example, form.filter.project property no longer exists, and so on.

// If you intend to improve perhaps go in small steps and coordinate with the maintainer if anything is unclear.
"form.filter.project" => '项目',
"form.filter.filter" => '收藏的报告',
"form.filter.filter_new" => '保存到我的收藏夹',
"form.filter.filter_confirm_delete" => '您确认要删除收藏的这个报告吗？',

// login form attributes
"form.login.title" => '登录',
"form.login.login" => '登录',

// password reminder form attributes
"form.fpass.title" => '重设密码',
"form.fpass.login" => '登录',
"form.fpass.send_pass_str" => '密码重设请求已经发送',
"form.fpass.send_pass_subj" => 'Anuko时间追踪器密码重设请求',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "亲爱的用户，\n\n有人，也可能是您自己，请求重新设置您的Anuko时间追踪器密码。如果您希望重设您的密码，请访问下面的连结：\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "要重设密码，请输入新密码并点击保存按钮",

// administrator form
"form.admin.title" => '管理员',
"form.admin.duty_text" => '通过创建新的团队经理账号来创建新团队。<br>您也可以从其它的Anuko时间追踪器服务器的xml文件导入团队数据(登录信息不能发生冲突)。',

"form.admin.change_pass" => '修改管理员账号的密码',
"form.admin.profile.title" => '团队',
"form.admin.profile.noprofiles" => '您的数据库没有任何记录。请以管理员身份登录并创建一个新团队。',
"form.admin.profile.comment" => '删除团队',
"form.admin.profile.th.id" => 'ID号',
"form.admin.profile.th.name" => '姓名',
"form.admin.profile.th.edit" => '编辑',
"form.admin.profile.th.del" => '删除',
"form.admin.profile.th.active" => '启用',
"form.admin.options" => '选项',
"form.admin.custom_date_format" => "日期格式",
"form.admin.custom_time_format" => "时间格式",
"form.admin.start_week" => "每周的第一天",

// my time form attributes
"form.mytime.title" => '我的时间记录',
"form.mytime.edit_title" => '编辑时间记录',
"form.mytime.del_str" => '删除时间记录',
"form.mytime.time_form" => ' (时:分)',
"form.mytime.date" => '日期',
"form.mytime.project" => '项目',
"form.mytime.activity" => '活动',
"form.mytime.start" => '开始',
"form.mytime.finish" => '结束',
"form.mytime.duration" => '持续时间',
"form.mytime.note" => '备注',
"form.mytime.behalf" => '每日工作，人员：',
"form.mytime.daily" => '每日工作',
"form.mytime.total" => '总小时数： ',
"form.mytime.th.project" => '项目',
"form.mytime.th.activity" => '活动',
"form.mytime.th.start" => '开始',
"form.mytime.th.finish" => '结束',
"form.mytime.th.duration" => '持续时间',
"form.mytime.th.note" => '备注',
"form.mytime.th.edit" => '编辑',
"form.mytime.th.delete" => '删除',
"form.mytime.del_yes" => '成功删除时间记录',
"form.mytime.no_finished_rec" => '该记录只保存了开始时间。这不是错误。如果需要，请注销。',
"form.mytime.billable" => '计费时间',
"form.mytime.warn_tozero_rec" => '由于这段时间是锁定的，该时间记录必须删除',
"form.mytime.uncompleted" => '未完成',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '新建管理账号',
"form.profile.edit_title" => '编辑简介',
"form.profile.name" => '名字',
"form.profile.login" => '登录',

"form.profile.showchart" => '显示饼状图',
"form.profile.lang" => '语言',
"form.profile.custom_date_format" => "日期格式",
"form.profile.custom_time_format" => "时间格式",
"form.profile.default_format" => "(默认)",
"form.profile.start_week" => "每周的第一天",

// people form attributes
"form.people.ppl_str" => '人员',
"form.people.createu_str" => '新建用户',
"form.people.edit_str" => '编辑用户',
"form.people.del_str" => '删除用户',
"form.people.th.name" => '姓名',
"form.people.th.login" => '登录',
"form.people.th.role" => '角色',
"form.people.th.edit" => '编辑',
"form.people.th.del" => '删除',
"form.people.th.status" => '状态',
"form.people.th.project" => '项目',
"form.people.th.rate" => '费率',
"form.people.manager" => '经理',
"form.people.comanager" => '合作经理人',
"form.people.empl" => '用户',
"form.people.name" => '姓名',
"form.people.login" => '登录',

"form.people.rate" => '默认小时收费',
"form.people.comanager" => '合作经理人',
"form.people.projects" => '项目',

// projects form attributes
"form.project.proj_title" => '项目',
"form.project.edit_str" => '编辑项目',
"form.project.add_str" => '添加新项目',
"form.project.del_str" => '删除项目',
"form.project.th.name" => '名称',
"form.project.th.edit" => '编辑',
"form.project.th.del" => '删除',
"form.project.name" => '名称',

// activities form attributes
"form.activity.act_title" => '活动',
"form.activity.add_title" => '新建活动',
"form.activity.edit_str" => '编辑活动',
"form.activity.del_str" => '删除活动',
"form.activity.name" => '名称',
"form.activity.project" => '项目',
"form.activity.th.name" => '名称',
"form.activity.th.project" => '项目',
"form.activity.th.edit" => '编辑',
"form.activity.th.del" => '删除',

// report attributes
"form.report.title" => '报告',
"form.report.from" => '开始日期',
"form.report.to" => '结束日期',
"form.report.groupby_user" => '用户',
"form.report.groupby_project" => '项目',
"form.report.duration" => '持续时间',
"form.report.start" => '开始',
"form.report.finish" => '结束',
"form.report.note" => '备注',
"form.report.project" => '项目',
"form.report.totals_only" => '仅仅今天',
"form.report.total" => '总计时间',
"form.report.th.empllist" => '用户',
"form.report.th.date" => '日期',
"form.report.th.project" => '项目',
"form.report.th.start" => '开始',
"form.report.th.finish" => '结束',
"form.report.th.duration" => '持续时间',
"form.report.th.note" => '备注',

// mail form attributes
"form.mail.from" => '从',
"form.mail.to" => '到',
"form.mail.comment" => '留言',
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
"form.invoice.date" => '日期',
"form.invoice.number" => '发票号码',
"form.invoice.tax" => '税',
"form.invoice.comment" => '留言',
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

"form.client.title" => '客户',
"form.client.add_title" => '添加客户',
"form.client.edit_title" => '编辑客户',
"form.client.del_title" => '删除客户',
"form.client.th.name" => '姓名',
"form.client.th.edit" => '编辑',
"form.client.th.del" => '删除',
"form.client.name" => '姓名',
"form.client.tax" => '税',
"form.client.comment" => '备注',

// miscellaneous strings
"forward.forgot_password" => '忘记密码？',
"forward.edit" => '编辑',
"forward.delete" => '删除',
"forward.tocsvfile" => '将数据导出到.csv文件',
"forward.toxmlfile" => '将数据导出到.xml文件',
"forward.geninvoice" => '生成发票',
"forward.change" => '客户设置',

// strings inside contols on forms
"controls.select.project" => '--- 选择项目 ---',
"controls.select.activity" => '--- 选择活动 ---',
"controls.select.client" => '--- 选择客户 ---',
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
"controls.sel_period" => '--- 选择时间段 ---',
"controls.sel_groupby" => '--- 没有分组 ---',
"controls.inc_billable" => '计费时间',
"controls.inc_nbillable" => '非计费时间',
"controls.default" => '--- 默认 ---',

// labels
"label.chart.title1" => '活动用户',
"label.chart.title2" => '项目用户',
"label.chart.period" => '图表期限',

"label.pbehalf_info" => '%s %s <b>代表%s</b>',
"label.time_noentry" => '没有条目',
"label.req_fields" => '* 必填栏目',
"label.sel_project" => '选择项目',
"label.sel_activity" => '选择活动',
"label.sel_tp" => '选择时间段',
"label.set_tp" => '或设定日期',
"label.fields" => '显示栏目',
"label.group_title" => '分组方式：',
"label.include_title" => '包含记录',
"label.inv_str" => '发票',
"label.set_empl" => '选择用户',
"label.sel_all" => '全部选择',
"label.sel_none" => '全部不选',
"label.or" => '或',
"label.disable" => '禁用',
"label.enable" => '启用',
"label.filter" => '过滤器',
"label.timeweek" => '一周总计',
"label.hrs" => '小时',
"label.errors" => '错误',
"label.ldap_hint" => '在下面的栏目输入您的<b>Windows用户名</b>和<b>密码</b>。',
// Note to translators: strings below must be translated.
 "label.calendar_today" => '今天',
 "label.calendar_close" => '关闭',

// login hello text
 "login.hello.text" => "anuko时间跟踪器是一种简单、易用、开放源代码的实时跟踪系统。",
);
