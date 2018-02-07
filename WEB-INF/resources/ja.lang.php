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

$i18n_language = '日本語';
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
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'プロファイル',
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
'menu.teams' => 'チーム',
// TODO: translate the following.
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
'error.project_exists' => 'この名前のプロジェクトは既に存在します。',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'このログインと関連されたユーザーはいません。',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
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
// TODO: translate the following.
// 'button.add_user' => 'Add user',
// 'button.add_project' => 'Add project',
// 'button.add_task' => 'Add task',
// 'button.add_client' => 'Add client',
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => '追加',
'button.generate' => '生成',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => '送信',
'button.send_by_email' => 'Eメールの送信',
// TODO: translate the following.
// 'button.create_team' => 'Create team',
'button.export' => 'チームのエクスポート',
'button.import' => 'チームのインポート',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
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
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
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
// 'label.day_total' => 'Day total',
'label.week_total' => '週合計',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => '今日',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
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
// 'label.id' => 'ID',
'label.language' => '言語',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => '日付形式',
'label.time_format' => '時間形式',
'label.week_start' => '週の開始日',
'label.comment' => 'コメント',
'label.status' => '状態',
'label.tax' => '税',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
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
'title.login' => 'ログイン',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'パスワードの初期化',
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
// TODO: translate the following.
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
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
// 'title.export' => 'Exporting Team Data',
// 'title.import' => 'Importing Team Data',
'title.options' => 'オプション',
'title.profile' => 'プロファイル',
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
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'パスワードを忘れましたか？',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => '送信したパスワードの初期化の要求。', // TODO: add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko Time Trackerのパスワードの初期化の要求',
// TODO: translate the ending of this string.
'form.reset_password.email_body' => "尊敬なるお客様、\n\n誰から（多分あなた）あなたのAnuko Time Trackerのパスワードの初期化が要求されました。あなたのパスワードを初期化しようとこのリンクを押してください。\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",


// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => '請求できる',
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
'form.teams.hint' => '新規チームの管理者のアカウントを生成して新規チームを作成します。<br>あなたはなお他のAnuko Time Trackerサーバのxmlのファイルからチームデータをインポートすることができます(ログインの衝突は許可されません)。',



// TODO: refactoring ongoing down from here.

// administrator form
"form.admin.profile.title" => 'チーム',
"form.admin.profile.noprofiles" => 'あなたのデータベースは空いています。管理者にログインして新規チームを作成してください。',
"form.admin.profile.comment" => 'チームの削除',
"form.admin.profile.th.id" => '識別子',
"form.admin.profile.th.active" => '活動内容',

// my time form attributes
"form.mytime.title" => '私の時間',
"form.mytime.edit_title" => '時間レコードの編集',
"form.mytime.del_str" => '時間レコードの削除',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.total" => '合計時間： ',
"form.mytime.del_yes" => '時間レコードが成功的に削除されました',
"form.mytime.no_finished_rec" => 'このレコードは開始時間だけで保存されました。これはエラーではありません。もし必要があればログアウトしてください。',
"form.mytime.warn_tozero_rec" => 'この時間レコードの期間が満了されましたから、この時間レコードは削除されることが必要です',
"form.mytime.uncompleted" => '未完成の',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '新規管理者のアカウントの作成',
"form.profile.edit_title" => 'プロファイルの編集',
"form.profile.showchart" => 'パイ図表の表示',

// people form attributes
"form.people.ppl_str" => 'メンバー',
"form.people.createu_str" => '新規ユーザーの作成',
"form.people.edit_str" => 'ユーザーの編集',
"form.people.del_str" => 'ユーザーの削除',
"form.people.th.role" => 'ルール',
"form.people.th.rate" => '給料',
"form.people.manager" => '管理者',
"form.people.comanager" => '共同管理者',

"form.people.rate" => 'デフォルト時間当り給料',
"form.people.comanager" => '共同管理者',

// report attributes
"form.report.title" => 'レポート',
"form.report.total" => '合計時間',

// mail form attributes
"form.mail.from" => 'から',
"form.mail.to" => 'まで',
"form.mail.above" => 'このレポートをEメールで送信',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>送信したメッセージ</b>',

// invoice attributes
"form.invoice.title" => '送り状',
"form.invoice.caption" => '送り状',
"form.invoice.above" => '送り状の追加の情報',
"form.invoice.select_cust" => 'クライアントの選択',
"form.invoice.fillform" => 'フィールドの作成',
"form.invoice.number" => '送り状の番号',
"form.invoice.th.username" => '個人',
"form.invoice.th.time" => '時間',
"form.invoice.th.rate" => '給料',
"form.invoice.th.summ" => '数量',
"form.invoice.subtotal" => '小計',
"form.invoice.customer" => 'クライアント',
"form.invoice.mailinv_above" => '送り状をEメールで送信',
"form.invoice.sending_str" => '<b>送信した送り状</b>',

"form.migration.zip" => '圧縮',
"form.migration.file" => 'ファイルの選択',
"form.migration.import.title" => 'データのインポート',
"form.migration.import.success" => 'インポートが成功的に完了されました',
"form.migration.import.text" => 'xmlファイルからチームのデータをインポート',
"form.migration.export.title" => 'データのエクスポート',
"form.migration.export.success" => 'エクスポートが成功的に完了されました',
"form.migration.export.text" => 'あなたはすべてのチームのデータをxmlファイルにエクスポートすることができます。これはあなたの自分のサーバに移動する時に有用します。',
"form.migration.compression.none" => 'なし',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',
);
