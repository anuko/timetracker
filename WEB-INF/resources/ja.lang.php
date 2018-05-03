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

$i18n_language = 'Japanese (日本語)';
$i18n_months = array('1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月');
$i18n_weekdays = array('日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日');
$i18n_weekdays_short = array('日', '月', '火', '水', '木', '金', '土');
// format mm/dd
$i18n_holidays = array('01/01', '01/12', '03/20', '05/03', '05/04', '05/05', '05/06', '09/21', '09/22', '09/23', '11/03', '11/23');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'ログイン',
'menu.logout' => 'ログアウト',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'ヘルプ',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'プロファイル',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => '時間',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'レポート',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'プロジェクト',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'ユーザー',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.export' => 'Export',
'menu.clients' => 'クライアント',
'menu.options' => 'オプション',

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
'error.db' => 'データベースのエラー。',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => '不正確な"{0}"データ。',
'error.empty' => '"{0}"のフィールドが空白です。',
'error.not_equal' => '"{0}"のフィールドは"{1}"のフィールドと違います。',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'プロジェクトの選択。',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'クライアントの選択。',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '不正確なログインあるいはパスワードが不正確です。',
'error.user_exists' => 'このログインと関連されたユーザーは既に存在します。',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'この名前のプロジェクトは既に存在します。',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'このログインと関連されたユーザーはいません。',
'error.no_groups' => 'あなたのデータベースは空いています。管理者にログインして新規チームを作成してください。', // TODO: replace "team" with "group".
'error.upload' => 'ファイルのアップロードのエラー。',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'メールの送信中のエラー。',
// TODO: translate the following.
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'ログイン',
'button.now' => '現在',
'button.save' => '保存',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'キャンセル',
'button.submit' => '送信',
'button.add' => '追加',
'button.delete' => '削除',
'button.generate' => '生成',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => '送信',
'button.send_by_email' => 'Eメールの送信',
// TODO: translate the following.
// 'button.create_group' => 'Create group',
'button.export' => 'チームのエクスポート', // TODO: replace "team" with "group".
'button.import' => 'チームのインポート', // TODO: replace "team" with "group".
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.group_name' => 'Group name',
// 'label.address' => 'Address',
'label.currency' => '通貨',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => '名前',
'label.thing_name' => '名前',
'label.login' => 'ログインID',
'label.password' => 'パスワード',
'label.confirm_password' => 'パスワードの確認',
'label.email' => 'Eメール',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => '主題',
'label.date' => '日付',
'label.start_date' => '開始日付',
'label.end_date' => '終了日付',
'label.user' => 'ユーザー',
'label.users' => 'ユーザー',
// TODO: translate the following.
// 'label.roles' => 'Roles',
'label.client' => 'クライアント',
'label.clients' => 'クライアント',
'label.option' => 'オプション',
'label.invoice' => '送り状',
'label.project' => 'プロジェクト',
'label.projects' => 'プロジェクト',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => '開始',
'label.finish' => '終了',
'label.duration' => '期間',
'label.note' => 'ノート',
'label.notes' => 'ノート',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
'label.week_total' => '週合計',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今日',
// TODO: translate the following.
// 'label.view' => 'View',
'label.edit' => '編集',
'label.delete' => '削除',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => 'すべて選択',
'label.select_none' => 'すべて解除',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => '識別子',
'label.language' => '言語',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => '日付形式',
'label.time_format' => '時間形式',
'label.week_start' => '週の開始日',
'label.comment' => 'コメント',
'label.status' => '状態',
'label.tax' => '税',
'label.subtotal' => '小計',
'label.total' => '合計',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'あるいは',
// TODO: translate the following.
// 'label.error' => 'Error',
'label.ldap_hint' => '下記のフィールドにあなたの<b>WindowsのログインID</b>と<b>パスワード</b>を入力してください。',
'label.required_fields' => '* 必須のフィールド',
'label.on_behalf' => 'を代表して',
// TODO: translate all 3 roles properly, see https://www.anuko.com/time_tracker/user_guide/user_accounts.htm
// This may require different terms for role_manager and role_comanager.
'label.role_manager' => '(管理者)',
'label.role_comanager' => '(共同管理者)',
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
'label.fav_report' => 'お気に入りレポート',
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
'title.login' => 'ログイン',
'title.groups' => 'チーム', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.create_group' => 'Creating Group',
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => 'チームの削除',  // TODO: change "team" to "group".
'title.reset_password' => 'パスワードの初期化',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
'title.time' => '時間',
'title.edit_time_record' => '時間レコードの編集',
'title.delete_time_record' => '時間レコードの削除',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => 'レポート',
'title.report' => 'レポート',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
'title.invoice' => '送り状',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'プロジェクト',
'title.add_project' => 'プロジェクトの追加',
'title.edit_project' => 'プロジェクトの編集',
'title.delete_project' => 'プロジェクトの削除',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'ユーザー',
'title.add_user' => 'ユーザーの作成',
'title.edit_user' => 'ユーザーの編集',
'title.delete_user' => 'ユーザーの削除',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'クライアント',
'title.add_client' => 'クライアントの追加',
'title.edit_client' => 'クライアントの編集',
'title.delete_client' => 'クライアントの削除',
'title.invoices' => '送り状',
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
'title.options' => 'オプション',
'title.profile' => 'プロファイル',
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
'dropdown.all' => '--- すべて ---',
'dropdown.no' => '--- いいえ ---',
'dropdown.current_day' => '今日',
'dropdown.previous_day' => '昨日',
'dropdown.selected_day' => '日',
'dropdown.current_week' => '今週',
'dropdown.previous_week' => '先週',
'dropdown.selected_week' => '週',
'dropdown.current_month' => '今月',
'dropdown.previous_month' => '先月',
'dropdown.selected_month' => '月',
'dropdown.current_year' => '今年',
'dropdown.previous_year' => '昨年',
'dropdown.selected_year' => '年',
'dropdown.all_time' => 'すべての時間',
'dropdown.projects' => 'プロジェクト',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'パスワードを忘れましたか？',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '送信したパスワードの初期化の要求。', // TODO: add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko Time Trackerのパスワードの初期化の要求',
// TODO: translate the ending of this string.
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// Older translation is below.
// 'form.reset_password.email_body' => "尊敬なるお客様、\n\n誰から（多分あなた）あなたのAnuko Time Trackerのパスワードの初期化が要求されました。あなたのパスワードを初期化しようとこのリンクを押してください。\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",


// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
'form.time.duration_format' => '(hh:mm あるいは 0.0h)', // TODO: is there a better term for hh:mm as a hint to user what to enter?
'form.time.billable' => '請求できる',
'form.time.uncompleted' => '未完成の',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'このレコードは開始時間だけで保存されました。これはエラーではありません。',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'お気に入りに保存',
'form.reports.confirm_delete' => 'このお気に入りレポートを削除しますか？',
// TODO: translate the following.
'form.reports.include_billable' => '請求できる',
'form.reports.include_not_billable' => '請求できません',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => '時間期間の選択',
'form.reports.set_period' => 'あるいは日付を設定',
'form.reports.show_fields' => 'フィールドの表示',
'form.reports.group_by' => '次のようにグループ化',
'form.reports.group_by_no' => '--- グループの機能がありません ---',
'form.reports.group_by_date' => '日付',
'form.reports.group_by_user' => 'ユーザー',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'プロジェクト',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => '全体だけ',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => '輸出する', // TODO: is this correct?
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => '送り状の番号',
'form.invoice.person' => '個人',

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
'form.users.role' => '役割', // TODO: is this correct?
'form.users.manager' => '管理者',
'form.users.comanager' => '共同管理者',
'form.users.rate' => '給料',
'form.users.default_rate' => 'デフォルト時間当り給料',

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
'form.export.hint' => 'あなたはすべてのチームのデータをxmlファイルにエクスポートすることができます。これはあなたの自分のサーバに移動する時に有用します。',
'form.export.compression' => '圧縮',
'form.export.compression_none' => 'なし',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'xmlファイルからチームのデータをインポート。', // TODO: replace "team" with "group".
'form.import.file' => 'ファイルの選択',
'form.import.success' => 'インポートが成功的に完了されました。',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => '新規チームの管理者のアカウントを生成して新規チームを作成します。<br>あなたはなお他のAnuko Time Trackerサーバのxmlのファイルからチームデータをインポートすることができます(ログインの衝突は許可されません)。',

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
'form.mail.from' => 'から',
'form.mail.to' => 'まで',
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => '送信した送り状。',

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
