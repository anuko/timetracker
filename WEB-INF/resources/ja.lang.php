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

// TODO: refactoring ongoing down from here.
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
'error.no_login' => 'このログインと関連されたユーザーはいません',
'error.upload' => 'ファイルのアップロードのエラー',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'メールの送信中のエラー',
// Note to translators: check the meaning of error.no_email. The error should say that there is no email address for user with a login provided.
'error.no_email' => 'このログインと関連されたメールがありません',
// TODO: translate the following.
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'ログイン',
'button.now' => '現在',
'button.save' => '保存',
'button.delete' => '削除',
'button.cancel' => 'キャンセル',
'button.submit' => '送信',
// TODO: improve translation of all button.add... strings.
'button.add_user' => '新規ユーザーの追加',
'button.add_project' => '新規プロジェクトの追加',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => '新規クライアントの追加',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => '追加',
'button.generate' => '生成',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => '進む',
'button.send' => '送信',
'button.send_by_email' => 'Eメールの送信',
'button.save_as_new' => '名前を付けて保存',
// TODO: improve translation of button.create_team
'button.create_team' => '新規チームの作成',
'button.export' => 'チームのエクスポート',
'button.import' => 'チームのインポート',
'button.apply' => '適用',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => '通貨',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.password' => 'パスワード',
'label.confirm_password' => 'パスワードの確認',
'label.email' => 'Eメール',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => '主題',
'label.total' => '合計',
// Translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => 'プロジェクト',
"form.filter.filter" => 'お気に入りレポート',
"form.filter.filter_new" => 'お気に入りに保存',
"form.filter.filter_confirm_delete" => 'このお気に入りレポートを削除しますか？',

// login form attributes
"form.login.title" => 'ログイン',
"form.login.login" => 'ログインID',

// password reminder form attributes
"form.fpass.title" => 'パスワードの初期化',
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
"form.admin.profile.th.name" => '名前',
"form.admin.profile.th.edit" => '編集',
"form.admin.profile.th.del" => '削除',
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
"form.mytime.activity" => '活動内容',
"form.mytime.start" => '開始',
"form.mytime.finish" => '終了',
"form.mytime.duration" => '期間',
"form.mytime.note" => 'ノート',
"form.mytime.behalf" => '日課',
"form.mytime.daily" => '日課',
"form.mytime.total" => '合計時間： ',
"form.mytime.th.project" => 'プロジェクト',
"form.mytime.th.activity" => '活動内容',
"form.mytime.th.start" => '開始',
"form.mytime.th.finish" => '終了',
"form.mytime.th.duration" => '期間',
"form.mytime.th.note" => 'ノート',
"form.mytime.th.edit" => '編集',
"form.mytime.th.delete" => '削除',
"form.mytime.del_yes" => '時間レコードが成功的に削除されました',
"form.mytime.no_finished_rec" => 'このレコードは開始時間だけで保存されました。これはエラーではありません。もし必要があればログアウトしてください。',
"form.mytime.billable" => '請求できる',
"form.mytime.warn_tozero_rec" => 'この時間レコードの期間が満了されましたから、この時間レコードは削除されることが必要です',
"form.mytime.uncompleted" => '未完成の',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '新規管理者のアカウントの作成',
"form.profile.edit_title" => 'プロファイルの編集',
"form.profile.name" => '名前',
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
"form.people.th.name" => '名前',
"form.people.th.login" => 'ログインID',
"form.people.th.role" => 'ルール',
"form.people.th.edit" => '編集',
"form.people.th.del" => '削除',
"form.people.th.status" => '状態',
"form.people.th.project" => 'プロジェクト',
"form.people.th.rate" => '給料',
"form.people.manager" => '管理者',
"form.people.comanager" => '共同管理者',
"form.people.empl" => 'ユーザー',
"form.people.name" => '名前',
"form.people.login" => 'ログインID',

"form.people.rate" => 'デフォルト時間当り給料',
"form.people.comanager" => '共同管理者',
"form.people.projects" => 'プロジェクト',

// projects form attributes
"form.project.proj_title" => 'プロジェクト',
"form.project.edit_str" => 'プロジェクトの編集',
"form.project.add_str" => '新規プロジェクトの追加',
"form.project.del_str" => 'プロジェクトの削除',
"form.project.th.name" => '名前',
"form.project.th.edit" => '編集',
"form.project.th.del" => '削除',
"form.project.name" => '名前',

// activities form attributes
"form.activity.act_title" => '活動内容',
"form.activity.add_title" => '新規活動内容の追加',
"form.activity.edit_str" => '活動内容の編集',
"form.activity.del_str" => '活動内容の削除',
"form.activity.name" => '名前',
"form.activity.project" => 'プロジェクト',
"form.activity.th.name" => '名前',
"form.activity.th.project" => 'プロジェクト',
"form.activity.th.edit" => '編集',
"form.activity.th.del" => '削除',

// report attributes
"form.report.title" => 'レポート',
"form.report.from" => '開始日付',
"form.report.to" => '終了日付',
"form.report.groupby_user" => 'ユーザー',
"form.report.groupby_project" => 'プロジェクト',
"form.report.groupby_activity" => '活動内容',
"form.report.duration" => '期間',
"form.report.start" => '開始',
"form.report.activity" => '活動内容',
"form.report.show_idle" => '遊休の表示',
"form.report.finish" => '終了',
"form.report.note" => 'ノート',
"form.report.project" => 'プロジェクト',
"form.report.totals_only" => '全体だけ',
"form.report.total" => '合計時間',
"form.report.th.empllist" => 'ユーザー',
"form.report.th.date" => '日付',
"form.report.th.project" => 'プロジェクト',
"form.report.th.activity" => '活動内容',
"form.report.th.start" => '開始',
"form.report.th.finish" => '終了',
"form.report.th.duration" => '期間',
"form.report.th.note" => 'ノート',

// mail form attributes
"form.mail.from" => 'から',
"form.mail.to" => 'まで',
"form.mail.comment" => 'コメント',
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
"form.invoice.tax" => '税',
"form.invoice.comment" => 'コメント ',
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
"form.client.th.name" => '名前',
"form.client.th.edit" => '編集',
"form.client.th.del" => '削除',
"form.client.name" => '名前',
"form.client.tax" => '税',
"form.client.comment" => 'コメント ',

// miscellaneous strings
"forward.forgot_password" => 'パスワードを忘れましたか？',
"forward.edit" => '編集',
"forward.delete" => '削除',
"forward.tocsvfile" => 'csvファイルにエクスポート',
"forward.toxmlfile" => 'xmlファイルにエクスポート',
"forward.geninvoice" => '送り状の作成',
"forward.change" => 'クライアントの構成',

// strings inside contols on forms
"controls.select.project" => '--- プロジェクトの選択 ---',
"controls.select.activity" => '--- 活動内容の選択 ---',
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
"controls.sel_period" => '--- 時間期間の選択 ---',
"controls.sel_groupby" => '--- グループの機能がありません ---',
"controls.inc_billable" => '請求できる',
"controls.inc_nbillable" => '請求できません',
"controls.default" => '--- デフォルト ---',

// labels
"label.chart.title1" => 'ユーザーに対する活動内容',
"label.chart.title2" => 'ユーザーに対するプロジェクト',
"label.chart.period" => '期間表示のチャート',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>%sを代表して</b>',
"label.pminfo" => ' (管理者)',
"label.pcminfo" => ' (共同管理者)',
"label.painfo" => ' (管理者)',
"label.time_noentry" => '項目なし',
"label.today" => '今日',
"label.req_fields" => '* 必須のフィールド',
"label.sel_project" => 'プロジェクトの選択',
"label.sel_activity" => '活動内容の選択',
"label.sel_tp" => '時間期間の選択',
"label.set_tp" => 'あるいは日付を設定',
"label.fields" => 'フィールドの表示',
"label.group_title" => '次のようにグループ化',
"label.include_title" => 'レコードの含み',
"label.inv_str" => '送り状',
"label.set_empl" => 'ユーザーの選択',
"label.sel_all" => 'すべて選択',
"label.sel_none" => 'すべて解除',
"label.or" => 'あるいは',
"label.disable" => '使用中止',
"label.enable" => '使用可能',
"label.filter" => 'フィルター',
"label.timeweek" => '週合計',
"label.hrs" => '時間',
"label.errors" => 'エラー',
"label.ldap_hint" => '下記のフィールドにあなたの<b>WindowsのログインID</b>と<b>パスワード</b>を入力してください。',
// Note to translators: the strings below are missing and must be translated.
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
