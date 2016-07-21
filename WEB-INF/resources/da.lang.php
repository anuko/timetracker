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

// Note to translators: Please use proper capitalization rules for your language.

$i18n_language = 'Dansk';
$i18n_months = array('januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december');
$i18n_weekdays = array('søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag');
$i18n_weekdays_short = array('sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø');
// format mm/dd
$i18n_holidays = array('01/01', '04/09', '04/10', '04/12', '04/13', '05/08', '05/21', '05/31', '06/01', '06/05', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'Login',
'menu.logout' => 'Logout',
// TODO: translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'Hjælp',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'lav en ny manager konto',
'menu.profile' => 'Profil',
'menu.time' => 'Tid',
// TODO: translate the following:
// 'menu.expenses' => 'Expenses'
'menu.reports' => 'Rapporter',
// TODO: translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projekter',
// TODO: translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
// 'menu.teams' => 'Teams',
// 'menu.export' => 'Export',
'menu.clients' => 'Kunder',
'menu.options' => 'Indstillinger',

// Footer - strings on the bottom of most pages.
// TODO: translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: Translate the following:
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'database fejl',
'error.field' => 'forkert "{0}" data',
'error.empty' => 'felt "{0}" er tom',
'error.not_equal' => 'felt "{0}" er ikke lig med "{1}"',
'error.interval' => 'forkert interval',
'error.project' => 'vælg projekt',
'error.activity' => 'vælg aktivitet',
'error.auth' => 'forkert login eller password',
// Note to translators: 'error.user_exists' => 'der eksitrerer en bruger med denne e-mail adresse', // e-mail must be changed to login.
'error.project_exists' => 'der eksiterer allerede et projekt med det navn',
'error.activity_exists' => 'aktivitet med det navn eksisterer allerede',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
'error.no_login' => 'ingen bruger med denne login',
'error.upload' => 'fil upload problem',
// TODO: translate the following:
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'login',
'button.now' => 'nu',
// 'button.set' => 'sæt',
'button.save' => 'gem',
'button.delete' => 'slet',
'button.cancel' => 'fortryd',
'button.submit' => 'gem',
'button.add_user' => 'tilføj bruger',
'button.add_project' => 'tilføj project',
'button.add_activity' => 'tilføj aktivitet',
'button.add_client' => 'tilføj kunde',
'button.add' => 'tilføj',
'button.generate' => 'dan',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'gе til',
// Note to translators: the strings below must be translated
// 'button.send' => 'send',
// 'button.send_by_email' => 'send som e-mail',
'button.save_as_new' => 'gem som ny',
// TODO: check translation of button.create_team
// 'button.create_team' => 'lav en team',
'button.export' => 'exporter team',
'button.import' => 'importer team',
'button.apply' => 'gem',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'møntfod',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.name' => 'navn',

'label.password' => 'adgangskode',
'label.confirm_password' => 'gentag adgangskode',
'label.email' => 'email',

// Form titles.
'title.options' => 'Indstillinger',
// TODO: almost entire title section is missing here. See the English file.


"form.filter.project" => 'projekt',
"form.filter.filter" => 'favorit rapport',
"form.filter.filter_new" => 'gem som favorit',
// Note to translators: the string below is missing in the translation and must be added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',

// password reminder form attributes
"form.fpass.title" => 'nulstil adgangskode',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'ønske om ny adgangskode sendt',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker adgangskode nulstil ',
// Note to translators: this string needs to be translated.
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "for at nulstille din adgangskode, tast det og klik gem",

// administrator form
"form.admin.title" => 'administrator',
// Note to translators: "form.admin.duty_text" => 'Lav et nyt team, ved at lave en team manager konto.<br>Du kan ogsе importerer fra en xml fil fra en anden Anuko Time Tracker server (no login collisions are allowed).', // the phrase in brackets must be translated

"form.admin.change_pass" => 'skift adgagnskode pе administrator konto',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'din database er tom, login som administrator og lav et nyt team',
"form.admin.profile.comment" => 'slet team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'navn',
"form.admin.profile.th.edit" => 'rediger',
"form.admin.profile.th.del" => 'slet',
"form.admin.profile.th.active" => 'aktive',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'min tid',
"form.mytime.edit_title" => 'rediger tids post',
"form.mytime.del_str" => 'slet tids post',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'dato',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'aktivitet',
"form.mytime.start" => 'start',
"form.mytime.finish" => 'slut',
"form.mytime.duration" => 'varighed',
"form.mytime.note" => 'notat',
"form.mytime.behalf" => 'dagligt arbejde for',
"form.mytime.daily" => 'dagligt arbejde',
"form.mytime.total" => 'timer i alt: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'aktivitet',
"form.mytime.th.start" => 'start',
"form.mytime.th.finish" => 'slut',
"form.mytime.th.duration" => 'varighed',
"form.mytime.th.note" => 'notat',
"form.mytime.th.edit" => 'rediger',
"form.mytime.th.delete" => 'slet',
"form.mytime.del_yes" => 'tids post slettet',
"form.mytime.no_finished_rec" => 'denne post er gemt med kun en start tid. Det er ikke nødvendigvis en fejl. Du kan nu logge af.',
// Note to translators: the 3 strings below are missing in the translation and need to be added
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'Dan ny manager konot',
"form.profile.edit_title" => 'rediger profil',
"form.profile.name" => 'navn',
"form.profile.login" => 'login', 

// Note to translators: the strings below are missing in the translation and need to be added
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'Brugere',
"form.people.createu_str" => 'Dan ny bruger',
"form.people.edit_str" => 'reidger bruger',
"form.people.del_str" => 'slet bruger',
"form.people.th.name" => 'navn',
"form.people.th.login" => 'login', 
"form.people.th.role" => 'rolle',
"form.people.th.edit" => 'rediger',
"form.people.th.del" => 'slet',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'rate',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'bruger',
"form.people.name" => 'navn',
"form.people.login" => 'login', 

"form.people.rate" => 'standard tidsfaktor',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projekter',

// projects form attributes
"form.project.proj_title" => 'projekter',
"form.project.edit_str" => 'rediger projekter',
"form.project.add_str" => 'tilføj projekt', 
"form.project.del_str" => 'slet projekt',
"form.project.th.name" => 'navn',
"form.project.th.edit" => 'rediger',
"form.project.th.del" => 'slet',
"form.project.name" => 'navn',

// activities form attributes
"form.activity.act_title" => 'aktiviteter',
"form.activity.add_title" => 'tilføj ny aktivitet', 
"form.activity.edit_str" => 'rediger aktivitet',
"form.activity.del_str" => 'slet aktivitet',
"form.activity.name" => 'navn',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'navn',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'rediger',
"form.activity.th.del" => 'slet',

// report attributes
"form.report.title" => 'rapport',
"form.report.from" => 'start dato',
"form.report.to"=> 'slut dato',
"form.report.groupby_user" => 'bruger',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varighed',
"form.report.start" => 'start',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'hvis ledig tid',
"form.report.finish" => 'slut',
"form.report.note" => 'notat',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'kun totaler',
"form.report.total" => 'timer totalt',
"form.report.th.empllist" => 'bruger',
"form.report.th.date" => 'dato',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'slut',
"form.report.th.duration" => 'varighed',
"form.report.th.note" => 'notat',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'emne',
"form.mail.comment" => 'komment',
"form.mail.above" => 'send denne rapport pr. email',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>mail sendt</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'Yderligere information for faktura',
"form.invoice.select_cust" => 'vælg kunde', 
"form.invoice.fillform" => 'udfyld felterne',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'faktura nummer',
"form.invoice.tax" => 'skat',
"form.invoice.comment" => 'kommentar',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'rate',
"form.invoice.th.summ" => 'beløb', 
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'kunde',
"form.invoice.mailinv_above" => 'send denne faktura pr. e-mail',
"form.invoice.sending_str" => '<b>faktura sendt</b>',

"form.migration.zip" => 'komprimering',
"form.migration.file" => 'vælg fil', 
"form.migration.import.title" => 'import data',
"form.migration.import.success" => 'import gennemført', 
"form.migration.import.text" => 'import team data fra en xml fil',
"form.migration.export.title" => 'export data',
"form.migration.export.success" => 'export gennemført', 
"form.migration.export.text" => 'Du kan eksporerer data til enxml fil. det kan være praktisk hvis du flytter til egen server.', 
// Note to translators: the 3 strings below are missing in the translation and must be added
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kunder',
"form.client.add_title" => 'tilføj kunde', 
"form.client.edit_title" => 'rediger kunde',
"form.client.del_title" => 'slet kunde',
"form.client.th.name" => 'navn',
"form.client.th.edit" => 'rediger',
"form.client.th.del" => 'slet',
"form.client.name" => 'naavn',
"form.client.tax" => 'skat',
"form.client.comment" => 'kommenter ',

// miscellaneous strings
"forward.forgot_password" => 'Glemt adgangskode?',
"forward.edit" => 'rediger',
"forward.delete" => 'slet',
"forward.tocsvfile" => 'exporter data til .csv fil',
// Note to translators:  the string below is missing in the translation and must be added
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'dan faktura',
"forward.change" => 'konfigurer kunder',

// strings inside contols on forms
"controls.select.project" => '--- vælg projekt ---',
"controls.select.activity" => '--- vælg aktivitet ---',
"controls.select.client" => '---  vælg kunde---',
"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
"controls.notbind" => '--- ingen ---',
"controls.per_tm" => 'denne mеned',
"controls.per_lm" => 'sidste mеned',
"controls.per_tw" => 'denne uge',
"controls.per_lw" => 'sidste uge',
// Note to translators: the 3 strings below are missing in the translation and must be added
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- vælg tids periode ---',
"controls.sel_groupby" => '--- vælg gruppe ---', 
// Note to translators: the 3 strings below are missing in the translation and must be added
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the 3 strings below are missing in the translation and must be added
//"label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>pе vegne af %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'ingen input',
"label.today" => 'idag',
"label.req_fields"=> '* krævede felter', 
"label.sel_project" => 'vælg projekt',
"label.sel_activity" => 'vælg aktivtet',
"label.sel_tp" => 'vælg periode',
"label.set_tp" => 'eller vælg datoer',
"label.fields" => 'Vis fleter',
"label.group_title" => 'gruper',
// Note to translators: the string below is missing in the translation and must be added
// "label.include_title" => 'include records',
"label.inv_str" => 'faktura',
"label.set_empl" => 'vælg brugere',
"label.sel_all" => 'vælg alle',
"label.sel_none" => 'fravælg alle', 
"label.or" => 'eller',
"label.disable" => 'disable',
"label.enable" => 'enable',
"label.filter" => 'filtrer',
// Note to translators: strings below are missing in the translation and must be added
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
