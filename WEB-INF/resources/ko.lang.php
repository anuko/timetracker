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

$i18n_language = '한국어';
$i18n_months = array('1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월');
$i18n_weekdays = array('일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일');
$i18n_weekdays_short = array('일', '월', '화', '수', '목', '금', '토');
// format mm/dd
$i18n_holidays = array('01/01', '01/25', '01/26', '01/27', '03/02', '03/05', '08/15', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => '로그인',
'menu.logout' => '로그아웃',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => '도움말',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => '프로필',
// TODO: translate the following.
// 'menu.time' => 'Time',
// 'menu.expenses' => 'Expenses',
'menu.reports' => '보고서',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => '프로젝트',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => '팀',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => '클라이언트',
'menu.options' => '옵션',

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
'error.db' => '데이터베이스 오류',
'error.field' => '부정확한 "{0}" 의 데이터',
'error.empty' => '"{0}" 의 필드가 비어있습니다',
'error.not_equal' => '"{0}" 의 필드가 "{1}" 의 필드와 같지 않습니다',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => '프로젝트의 선택',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => '부정확한 로그인 혹은 암호가 틀립니다',
'error.user_exists' => '본 로그인과 연계된 사용자가 이미 있습니다',
'error.project_exists' => '본 이름과 연계된 프로젝트가 이미 있습니다',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => '본 로그인과 연계된 사용자가 없습니다',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => '파일 업로드 오류',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => '메일 보내기에서의 오류',
'error.no_email' => '본 로그인과 연계된 이메일이 없습니다',
// TODO: translate the following.
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => '로그인',
'button.now' => '지금',
'button.save' => '저장',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => '취소',
'button.submit' => '발송',
// TODO: translate the following.
// 'button.add_user' => 'Add user',
// 'button.add_project' => 'Add project',
// 'button.add_task' => 'Add task',
// 'button.add_client' => 'Add client',
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => '추가',
'button.generate' => '생성',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => '송신',
'button.send_by_email' => '이메일로 송신',
// TODO: translate the following.
// 'button.create_team' => 'Create team',
'button.export' => '팀 익스포트',
'button.import' => '팀 임포트',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => '화폐',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => '이름',
'label.thing_name' => '이름',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Password',
'label.confirm_password' => '암호 확인',
'label.email' => '이메일',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => '제목',
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
'label.today' => '오늘',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => '편집',
'label.delete' => '삭제',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
'label.language' => '언어',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => '합계',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
// TODO: translate all 3 roles properly, see https://www.anuko.com/time_tracker/user_guide/user_accounts.htm
// This may require different terms for role_manager and role_comanager.
'label.role_manager' => '(관리자)',
'label.role_comanager' => '(공동관리자)',
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
'title.login' => '로그인',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => '암호 재설정',
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
'title.report' => '보고서',
// TODO: translate the following.
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



// TODO: refactoring ongoing down from here.

"form.filter.project" => '프로젝트',
"form.filter.filter" => '좋아하는 보고서',
"form.filter.filter_new" => '좋아하는 것으로 저장',
"form.filter.filter_confirm_delete" => '좋아하는 이 보고서를 삭제해도 좋습니까?',

// password reminder form attributes
"form.fpass.login" => '로그인',
"form.fpass.send_pass_str" => '송신한 암호 재설정 요청',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker 암호 재설정 요청',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "사용자님께,\n\n누군가 (아마 당신) 가 당신의 Anuko Time Tracker 암호 재설정을 요청하였습니다. 당신의 암호를 재설정하기 바란다면 이 링크를 찾아주십시오. \n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "암호를 재설정하려면 암호를 입력하고 저장을 클릭하십시오",

// administrator form
"form.admin.title" => '관리자',
"form.admin.duty_text" => '신규 팀관리자 계정을 생성하여 신규 팀을 생성합니다.<br>또한 다른 Anuko Time Tracker 서버 에서 xml 파일로부터 팀 데이터를 임포트할수 있습니다 (로그인 충돌은 허용되지 안음).',

"form.admin.change_pass" => '관리자 계정의 암호 변경',
"form.admin.profile.title" => '팀',
"form.admin.profile.noprofiles" => '당신의 데이터베이스는 비어있습니다. 관리자로 로그인하여 새로운 팀을 생성하십시오.',
"form.admin.profile.comment" => '팀 삭제',
"form.admin.profile.th.id" => '식별자',
"form.admin.profile.th.active" => '활동내용',
"form.admin.options" => '옵션',
"form.admin.custom_date_format" => "날짜 포맷",
"form.admin.custom_time_format" => "시간 포맷",
"form.admin.start_week" => "주의 시작요일",

// my time form attributes
"form.mytime.title" => '나의 시간',
"form.mytime.edit_title" => '시간기록을 편집하기',
"form.mytime.del_str" => '시간기록을 삭제하기',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => '날짜',
"form.mytime.project" => '프로젝트',
"form.mytime.start" => '시작',
"form.mytime.finish" => '마감',
"form.mytime.duration" => '기간',
"form.mytime.note" => '표식',
"form.mytime.behalf" => '다음을 위한 하루일과',
"form.mytime.daily" => '하루일과',
"form.mytime.total" => '전체 시간: ',
"form.mytime.th.project" => '프로젝트',
"form.mytime.th.activity" => '활동내용',
"form.mytime.th.start" => '시작',
"form.mytime.th.finish" => '마감',
"form.mytime.th.duration" => '기간',
"form.mytime.th.note" => '표식',
"form.mytime.del_yes" => '성과적으로 삭제된 시간기록',
"form.mytime.no_finished_rec" => '이 기록은 시작 시간으로만 저장되었습니다. 이것은 오류는 아닙니다. 필요하면 로그아웃 하십시오.',
"form.mytime.billable" => '청구가능',
"form.mytime.warn_tozero_rec" => '이 시간기간이 로크되었으므로 이 시간기록은 삭제되어야 합니다',
"form.mytime.uncompleted" => '완성되지 않은',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => '신규 관리자 계정을 생성',
"form.profile.edit_title" => '프로필을 편집하기',
"form.profile.login" => '로그인ID',

"form.profile.showchart" => '원 그래프를 보기',
"form.profile.custom_date_format" => "날짜 포맷",
"form.profile.custom_time_format" => "시간 포맷",
"form.profile.default_format" => "(디폴트)",
"form.profile.start_week" => "주의 시작요일",

// people form attributes
"form.people.ppl_str" => '멤버',
"form.people.createu_str" => '신규 사용자를 만들기',
"form.people.edit_str" => '사용자를 편집하기',
"form.people.del_str" => '사용자를 삭제하기',
"form.people.th.login" => '로그인ID',
"form.people.th.role" => '직위',
"form.people.th.status" => '상태',
"form.people.th.project" => '프로젝트',
"form.people.th.rate" => '급여',
"form.people.manager" => '관리자',
"form.people.comanager" => '공동관리자',
"form.people.empl" => '사용자',
"form.people.login" => '로그인ID',

"form.people.rate" => '디폴트 시간당 급여',
"form.people.comanager" => '공동관리자',
"form.people.projects" => '프로젝트',

// projects form attributes
"form.project.proj_title" => '프로젝트',
"form.project.edit_str" => '프로젝트를 편집하기',
"form.project.add_str" => '신규 프로젝트를 추가하기',
"form.project.del_str" => '프로젝트를 삭제하기',

// activities form attributes
"form.activity.project" => '프로젝트',

// report attributes
"form.report.title" => '보고서',
"form.report.from" => '시작 날짜',
"form.report.to" => '마감 날짜',
"form.report.groupby_user" => '사용자',
"form.report.groupby_project" => '프로젝트',
"form.report.duration" => '기간',
"form.report.start" => '시작',
"form.report.finish" => '마감',
"form.report.note" => '표식',
"form.report.project" => '프로젝트',
"form.report.totals_only" => '오직 전체만',
"form.report.total" => '시간 총합',
"form.report.th.empllist" => '사용자',
"form.report.th.date" => '날짜',
"form.report.th.project" => '프로젝트',
"form.report.th.start" => '시작',
"form.report.th.finish" => '마감',
"form.report.th.duration" => '기간',
"form.report.th.note" => '주의',

// mail form attributes
"form.mail.from" => '부터',
"form.mail.to" => '까지',
"form.mail.comment" => '코멘트',
"form.mail.above" => '이 보고서를 이메일로 송신',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>송신된 메시지</b>',

// invoice attributes
"form.invoice.title" => '송장',
"form.invoice.caption" => '송장',
"form.invoice.above" => '송장에 대한 보충정보',
"form.invoice.select_cust" => '클라이언트의 선택',
"form.invoice.fillform" => '필드들을 채우십시오',
"form.invoice.date" => '날짜',
"form.invoice.number" => '송장 번호',
"form.invoice.tax" => '세금',
"form.invoice.comment" => '코멘트 ',
"form.invoice.th.username" => '개인',
"form.invoice.th.time" => '시간',
"form.invoice.th.rate" => '급여',
"form.invoice.th.summ" => '수량',
"form.invoice.subtotal" => '소계',
"form.invoice.customer" => '클라이언트',
"form.invoice.mailinv_above" => '이 송장을 이메일로 송신',
"form.invoice.sending_str" => '<b>송신한 송장</b>',

"form.migration.zip" => '압축',
"form.migration.file" => '파일 선택',
"form.migration.import.title" => '데이터 임포트',
"form.migration.import.success" => '성과적으로 완료된 임포트',
"form.migration.import.text" => 'xml 파일로부터 팀 데이터를 임포트',
"form.migration.export.title" => '데이터 익스포트',
"form.migration.export.success" => '성과적으로 완료된 익스포트',
"form.migration.export.text" => '팀의 모든 데이터를 xml 파일로 익스포트 할수 있습니다. 이것은 데이터를 당신자신의 서버에로 옮길때 쓸모있을수 있습니다.',
"form.migration.compression.none" => '없음',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => '클라이언트',
"form.client.add_title" => '클라이언트 추가',
"form.client.edit_title" => '클라이언트 편집',
"form.client.del_title" => '클라이언트 삭제',
"form.client.tax" => '세금',
"form.client.comment" => '코멘트 ',

// miscellaneous strings
"forward.forgot_password" => '암호를 잊으셨습니까?',
"forward.edit" => '편집',
"forward.delete" => '삭제',
"forward.tocsvfile" => '데이터를 .csv 파일로 익스포트',
"forward.toxmlfile" => '데이터를 .xml 파일로 익스포트',
"forward.geninvoice" => '송장 만들기',
"forward.change" => '클라이언트 구성',

// strings inside contols on forms
"controls.select.project" => '--- 프로젝트 선택 ---',
"controls.select.activity" => '--- 활동내용 선택 ---',
"controls.select.client" => '--- 클라이언트 선택 ---',
"controls.project_bind" => '--- 전부 ---',
"controls.all" => '--- 전부 ---',
"controls.notbind" => '--- 아니 ---',
"controls.per_tm" => '이번달',
"controls.per_lm" => '전번달',
"controls.per_tw" => '이번주',
"controls.per_lw" => '전번주',
"controls.per_td" => '오늘',
"controls.per_at" => '전시간',
"controls.per_ty" => '올해',
"controls.sel_period" => '--- 시간 기간을 선택 ---',
"controls.sel_groupby" => '--- 그룹화되지 않음 ---',
"controls.inc_billable" => '청구 가능한',
"controls.inc_nbillable" => '청구 가능하지 않은',
"controls.default" => '--- 디폴트 ---',

// labels
"label.chart.title1" => '사용자별 활동내용',
"label.chart.title2" => '사용자별 프로젝트',
"label.chart.period" => '기간에 따른 그래프',

"label.pbehalf_info" => '%s %s <b>%s 을 대표하여</b>',
"label.time_noentry" => '항목이 없음',
"label.req_fields" => '* 필수 필드',
"label.sel_project" => '프로젝트 선택',
"label.sel_activity" => '활동내용 선택',
"label.sel_tp" => '시간 기간을 선택',
"label.set_tp" => '혹은 날짜를 설정',
"label.fields" => '필드들을 보기',
"label.group_title" => '다음것에 의한 그룹화',
"label.include_title" => '기록을 포함',
"label.inv_str" => '송장',
"label.set_empl" => '사용자들을 선택',
"label.sel_all" => '모두 선택',
"label.sel_none" => '모두 해제',
"label.or" => '혹은',
"label.disable" => '무력화',
"label.enable" => '가능화',
"label.filter" => '필터',
"label.timeweek" => '주별 합계',
"label.hrs" => '시간',
"label.errors" => '오류',
"label.ldap_hint" => '아래의 필드들에서 <b>Windows 로그인</b> 및 <b>암호</b> 를 입력하십시오.',
);
