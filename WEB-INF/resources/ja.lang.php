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
// 'menu.users' => 'Users',
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
// TODO: All error messages should be complete sentences with a period (full stop) in the end. Put them there.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'データベースのエラー',
'error.field' => '不正確な"{0}"データ',
'error.empty' => '"{0}"のフィールドが空白です',
'error.not_equal' => '"{0}"のフィールドは"{1}"のフィールドと違います',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'プロジェクトの選択',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '不正確なログインあるいはパスワードが不正確です',
'error.user_exists' => 'このログインと関連されたユーザーは既に存在します',
'error.project_exists' => 'この名前のプロジェクトは既に存在します',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'このログインと関連されたユーザーはいません',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'ファイルのアップロードのエラー',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'メールの送信中のエラー',
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
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'パスワード',
'label.confirm_password' => 'パスワードの確認',
'label.email' => 'Eメール',
// TODO: translate the following.
// 'label.cc' => 'Cc',
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
'label.project' => 'プロジェクト',
'label.projects' => 'プロジェクト',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
// 'label.start' => 'Start',
// 'label.finish' => 'Finish',
// 'label.duration' => 'Duration',
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
'label.comment' => 'コメント',
// TODO: translate the following.
// 'label.status' => 'Status',
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
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
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
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'プロジェクト',
// TODO: translate the following.
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
// TODO: translate the following.
// 'form.reports.group_by_date' => 'date',
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'プロジェクト',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',



// TODO: refactoring ongoing down from here.

// password reminder form attributes
"form.fpass.login" => 'ログイン',
"form.fpass.send_pass_str" => '送信したパスワードの初期化の要求',
"form.fpass.send_pass_subj" => 'Anuko Time Trackerのパスワードの初期化の要求',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "尊敬なるお客様、\n\n誰から（多分あなた）あなたのAnuko Time Trackerのパスワードの初期化が要求されました。あなたのパスワードを初期化しようとこのリンクを押してください。\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "あなたのパスワードを初期化しようとパスワードを入力して保存をクリックしてください",

// administrator form
"form.admin.title" => '管理者',
"form.admin.duty_text" => '新規チームの管理者のアカウントを生成して新規チームを作成します。<br>あなたはなお他のAnuko Time Trackerサーバのxmlのファイルからチームデータをインポートすることができます(ログインの衝突は許可されません)。',

"form.admin.change_pass" => '管理者のアカウントのパスワードの変更',
"form.admin.profile.title" => 'チーム',
"form.admin.profile.noprofiles" => 'あなたのデータベースは空いています。管理者にログインして新規チームを作成してください。',
"form.admin.profile.comment" => 'チームの削除',
"form.admin.profile.th.id" => '識別子',
"form.admin.profile.th.active" => '活動内容',
"form.admin.options" => 'オプション',
"form.admin.custom_date_format" => "日付形式",
"form.admin.custom_time_format" => "時間形式",
"form.admin.start_week" => "週の開始日",

// my time form attributes
"form.mytime.title" => '私の時間',
"form.mytime.edit_title" => '時間レコードの編集',
"form.mytime.del_str" => '時間レコードの削除',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => '日付',
"form.mytime.project" => 'プロジェクト',
"form.mytime.start" => '開始',
"form.mytime.finish" => '終了',
"form.mytime.duration" => '期間',
"form.mytime.daily" => '日課',
"form.mytime.total" => '合計時間： ',
"form.mytime.th.project" => 'プロジェクト',
"form.mytime.th.start" => '開始',
"form.mytime.th.finish" => '終了',
"form.mytime.th.duration" => '期間',
"form.mytime.del_yes" => '時間レコードが成功的に削除されました',
"form.mytime.no_finished_rec" => 'このレコードは開始時間だけで保存されました。これはエラーではありません。もし必要があればログアウトしてください。',
"form.mytime.warn_tozero_rec" => 'この時間レコードの期間が満了されましたから、この時間レコードは削除されることが必要です',
"form.mytime.uncompleted" => '未完成の',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '新規管理者のアカウントの作成',
"form.profile.edit_title" => 'プロファイルの編集',
"form.profile.login" => 'ログインID',

"form.profile.showchart" => 'パイ図表の表示',
"form.profile.lang" => '言語',
"form.profile.custom_date_format" => "日付形式",
"form.profile.custom_time_format" => "時間形式",
"form.profile.default_format" => "(デフォルト)",
"form.profile.start_week" => "週の開始日",

// people form attributes
"form.people.ppl_str" => 'メンバー',
"form.people.createu_str" => '新規ユーザーの作成',
"form.people.edit_str" => 'ユーザーの編集',
"form.people.del_str" => 'ユーザーの削除',
"form.people.th.login" => 'ログインID',
"form.people.th.role" => 'ルール',
"form.people.th.status" => '状態',
"form.people.th.project" => 'プロジェクト',
"form.people.th.rate" => '給料',
"form.people.manager" => '管理者',
"form.people.comanager" => '共同管理者',
"form.people.empl" => 'ユーザー',
"form.people.login" => 'ログインID',

"form.people.rate" => 'デフォルト時間当り給料',
"form.people.comanager" => '共同管理者',
"form.people.projects" => 'プロジェクト',

// projects form attributes
"form.project.proj_title" => 'プロジェクト',
"form.project.edit_str" => 'プロジェクトの編集',
"form.project.add_str" => '新規プロジェクトの追加',
"form.project.del_str" => 'プロジェクトの削除',

// activities form attributes
"form.activity.act_title" => '活動内容',
"form.activity.add_title" => '新規活動内容の追加',
"form.activity.edit_str" => '活動内容の編集',
"form.activity.del_str" => '活動内容の削除',
"form.activity.project" => 'プロジェクト',
"form.activity.th.project" => 'プロジェクト',

// report attributes
"form.report.title" => 'レポート',
"form.report.from" => '開始日付',
"form.report.to" => '終了日付',
"form.report.groupby_user" => 'ユーザー',
"form.report.groupby_project" => 'プロジェクト',
"form.report.duration" => '期間',
"form.report.start" => '開始',
"form.report.finish" => '終了',
"form.report.project" => 'プロジェクト',
"form.report.totals_only" => '全体だけ',
"form.report.total" => '合計時間',
"form.report.th.empllist" => 'ユーザー',
"form.report.th.date" => '日付',
"form.report.th.project" => 'プロジェクト',
"form.report.th.start" => '開始',
"form.report.th.finish" => '終了',
"form.report.th.duration" => '期間',

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
"form.invoice.date" => '日付',
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

"form.client.title" => 'クライアント',
"form.client.add_title" => 'クライアントの追加',
"form.client.edit_title" => 'クライアントの編集',
"form.client.del_title" => 'クライアントの削除',

// miscellaneous strings
"forward.tocsvfile" => 'csvファイルにエクスポート',
"forward.toxmlfile" => 'xmlファイルにエクスポート',
"forward.geninvoice" => '送り状の作成',

"controls.select.client" => '--- クライアントの選択 ---',
"controls.project_bind" => '--- すべて ---',
"controls.all" => '--- すべて ---',
"controls.notbind" => '--- いいえ ---',
"controls.per_tm" => '今月',
"controls.per_lm" => '先月',
"controls.per_tw" => '今週',
"controls.per_lw" => '先週',
"controls.per_td" => '今日',
"controls.per_at" => 'すべての時間',
"controls.per_ty" => '今年',

"label.inv_str" => '送り状',
"label.set_empl" => 'ユーザーの選択',
"label.sel_all" => 'すべて選択',
"label.sel_none" => 'すべて解除',
"label.disable" => '使用中止',
"label.enable" => '使用可能',
"label.hrs" => '時間',
"label.errors" => 'エラー',
"label.ldap_hint" => '下記のフィールドにあなたの<b>WindowsのログインID</b>と<b>パスワード</b>を入力してください。',
);
