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

// Menus.
'menu.login' => '登錄',
'menu.logout' => '登出',
// TODO: translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => '幫助',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => '創建新管理帳號',
'menu.profile' => '編輯簡介', // TODO: Improve this, used to be "Edit profile", now just "Profile".
'menu.time' => '我的時間記錄', // TODO: Improve this, used to be "My time", now just "Time".
// TODO: translate the following:
// 'menu.expenses' => 'Expenses',
'menu.reports' => '報告',
// TODO: translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => '項目',
// TODO: translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => '團隊',
'menu.export' => '輸出資料',
'menu.clients' => '客戶',
'menu.options' => '選項',

// Footer - strings on the bottom of most pages.
// TODO: translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following:
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => '資料庫錯誤',
'error.field' => '不正確的"{0}"資料',
'error.empty' => '欄目"{0}"為空',
'error.not_equal' => '欄目"{0}"不等於欄目"{1}"',
'error.interval' => '不正確的間隔',
'error.project' => '選擇項目',
'error.activity' => '選擇活動',
'error.auth' => '不正確的用戶名或密碼',
'error.user_exists' => '該使用者登錄資訊已經存在',
'error.project_exists' => '該專案名稱已經存在',
'error.activity_exists' => '該活動名稱已經存在',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
'error.no_login' => '沒有該登錄資訊的使用者',
'error.upload' => '上傳文件出錯',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => '發送郵件時出錯',
'error.no_email' => '沒有電子郵件與該用戶名關聯',
// Note to translators: strings below must be translated.
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

// labels for various buttons
'button.login' => '登錄',
'button.now' => '當前時間',
// 'button.set' => '設置',
'button.save' => '保存',
'button.delete' => '刪除',
'button.cancel' => '取消',
'button.submit' => '提交',
// TODO: check / improve translation of all button.add... strings.
'button.add_user' => '添加新用戶',
'button.add_project' => '添加新項目',
'button.add_activity' => '添加新活動',
'button.add_client' => '添加新客戶',
'button.add' => '添加',
'button.generate' => '創建',
// Note to translators: button.reset_password needs to be translated.
// 'button.reset_password' => 'reset password',
'button.send' => '發送',
'button.send_by_email' => '通過郵件發送',
'button.save_as_new' => '另存為',
// TODO: improve translation of button.create_team
'button.create_team' => '創建新團隊',
'button.export' => '輸出團隊資訊',
'button.import' => '輸入團隊資訊',
'button.apply' => '應用',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => '貨幣',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.password' => '密碼',
'label.confirm_password' => '確認密碼',
'label.email' => '電子郵件',
'label.total' => '總計',
// Translate the following string.
// 'label.page' => 'Page',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => '項目',
"form.filter.filter" => '收藏的報告',
"form.filter.filter_new" => '保存到我的存檔',
"form.filter.filter_confirm_delete" => '您確認要刪除收藏的這個報告嗎？',

// login form attributes
"form.login.title" => '登錄',
"form.login.login" => '登錄',

// password reminder form attributes
"form.fpass.title" => '重設密碼',
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
"form.admin.profile.th.name" => '姓名',
"form.admin.profile.th.edit" => '編輯',
"form.admin.profile.th.del" => '刪除',
"form.admin.profile.th.active" => '啟動',
"form.admin.options" => '選項',
"form.admin.lang_default" => '網站預設語言',
"form.admin.lang_browser_default" => '(默認流覽器)',
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
"form.mytime.activity" => '活動',
"form.mytime.start" => '開始',
"form.mytime.finish" => '結束',
"form.mytime.duration" => '持續時間',
"form.mytime.note" => '備註',
"form.mytime.behalf" => '每日工作，執行人員：',
"form.mytime.daily" => '每日工作',
"form.mytime.total" => '總小時數： ',
"form.mytime.th.project" => '項目',
"form.mytime.th.activity" => '活動',
"form.mytime.th.start" => '開始',
"form.mytime.th.finish" => '結束',
"form.mytime.th.duration" => '持續時間',
"form.mytime.th.note" => '備註',
"form.mytime.th.edit" => '編輯',
"form.mytime.th.delete" => '刪除',
"form.mytime.del_yes" => '成功刪除時間記錄',
"form.mytime.no_finished_rec" => '該記錄只保存了開始時間。這不是錯誤。如果需要，請登出。',
"form.mytime.billable" => '計費時間',
"form.mytime.warn_tozero_rec" => '由於這段時間是鎖定的，該時間記錄必須刪除',
"form.mytime.uncompleted" => '未完成',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '創建新管理帳號',
"form.profile.edit_title" => '編輯簡介',
"form.profile.name" => '名字',
"form.profile.login" => '登錄',

"form.profile.showchart" => '顯示餅狀圖',
"form.profile.lang" => '語言',
"form.profile.lang_browser_default" => '(默認流覽器)',
"form.profile.custom_date_format" => "日期格式",
"form.profile.custom_time_format" => "時間格式",
"form.profile.default_format" => "(默認)",
"form.profile.start_week" => "每週的第一天",

// people form attributes
"form.people.ppl_str" => '人員',
"form.people.createu_str" => '新建用戶',
"form.people.edit_str" => '編輯用戶',
"form.people.del_str" => '刪除用戶',
"form.people.th.name" => '姓名',
"form.people.th.login" => '登錄',
"form.people.th.role" => '角色',
"form.people.th.edit" => '編輯',
"form.people.th.del" => '刪除',
"form.people.th.status" => '狀態',
"form.people.th.project" => '項目',
"form.people.th.rate" => '費率',
"form.people.manager" => '經理',
"form.people.comanager" => '合作經理人',
"form.people.empl" => '用戶',
"form.people.name" => '姓名',
"form.people.login" => '登錄',

"form.people.rate" => '默認小時收費',
"form.people.comanager" => '合作經理人',
"form.people.projects" => '項目',

// projects form attributes
"form.project.proj_title" => '項目',
"form.project.edit_str" => '編輯專案',
"form.project.add_str" => '添加新項目',
"form.project.del_str" => '刪除項目',
"form.project.th.name" => '名稱',
"form.project.th.edit" => '編輯',
"form.project.th.del" => '刪除',
"form.project.name" => '名稱',

// activities form attributes
"form.activity.act_title" => '活動',
"form.activity.add_title" => '新建活動',
"form.activity.edit_str" => '編輯活動',
"form.activity.del_str" => '刪除活動',
"form.activity.name" => '名稱',
"form.activity.project" => '項目',
"form.activity.th.name" => '名稱',
"form.activity.th.project" => '項目',
"form.activity.th.edit" => '編輯',
"form.activity.th.del" => '刪除',

// report attributes
"form.report.title" => '報告',
"form.report.from" => '開始日期',
"form.report.to" => '結束日期',
"form.report.groupby_user" => '用戶',
"form.report.groupby_project" => '項目',
"form.report.groupby_activity" => '活動',
"form.report.duration" => '持續時間',
"form.report.start" => '開始',
"form.report.activity" => '活動',
"form.report.show_idle" => '顯示空閒',
"form.report.finish" => '結束',
"form.report.note" => '備註',
"form.report.project" => '項目',
"form.report.totals_only" => '僅僅今天',
"form.report.total" => '總計時間',
"form.report.th.empllist" => '用戶',
"form.report.th.date" => '日期',
"form.report.th.project" => '項目',
"form.report.th.activity" => '活動',
"form.report.th.start" => '開始',
"form.report.th.finish" => '結束',
"form.report.th.duration" => '持續時間',
"form.report.th.note" => '備註',

// mail form attributes
"form.mail.from" => '從',
"form.mail.to" => '到',
"form.mail.cc" => '抄送',
"form.mail.subject" => '主題',
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
"form.client.th.name" => '姓名',
"form.client.th.edit" => '編輯',
"form.client.th.del" => '刪除',
"form.client.name" => '姓名',
"form.client.tax" => '稅',
"form.client.comment" => '備註',

// miscellaneous strings
"forward.forgot_password" => '忘記密碼？',
"forward.edit" => '編輯',
"forward.delete" => '刪除',
"forward.tocsvfile" => '將資料輸出到.csv文件',
"forward.toxmlfile" => '將資料輸出到.xml文件',
"forward.geninvoice" => '生成發票',
"forward.change" => '客戶設置',

// strings inside contols on forms
"controls.select.project" => '--- 選擇項目 ---',
"controls.select.activity" => '--- 選擇活動 ---',
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
"controls.sel_period" => '--- 選擇時間段 ---',
"controls.sel_groupby" => '--- 沒有分組 ---',
"controls.inc_billable" => '計費時間',
"controls.inc_nbillable" => '非計費時間',
"controls.default" => '--- 默認 ---',

// labels
"label.chart.title1" => '活動用戶',
"label.chart.title2" => '項目用戶',
"label.chart.period" => '圖表期限',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>代表%s</b>',
"label.pminfo" => ' (經理)',
"label.pcminfo" => ' (合作經理人)',
"label.painfo" => ' (管理員)',
"label.time_noentry" => '沒有條目',
"label.today" => '今天',
"label.req_fields" => '* 必填欄目',
"label.sel_project" => '選擇項目',
"label.sel_activity" => '選擇活動',
"label.sel_tp" => '選擇時間段',
"label.set_tp" => '或設定日期',
"label.fields" => '顯示欄目',
"label.group_title" => '分組方式：',
"label.include_title" => '包含記錄',
"label.inv_str" => '發票',
"label.set_empl" => '選擇用戶',
"label.sel_all" => '全部選擇',
"label.sel_none" => '全部不選',
"label.or" => '或',
"label.disable" => '禁用',
"label.enable" => '啟用',
"label.filter" => '篩檢程式',
"label.timeweek" => '一周總計',
"label.hrs" => '小時',
"label.errors" => '錯誤',
"label.ldap_hint" => '在下麵的欄目輸入您的<b>Windows用戶名</b>和<b>密碼</b>。',
// Note to translators: string below must be translated.
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
