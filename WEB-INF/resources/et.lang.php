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

$i18n_language = 'Eesti';
$i18n_months = array('Jaanuar', 'Veebruar', 'Märts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');
$i18n_weekdays = array('Pühapäev', 'Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev');
$i18n_weekdays_short = array('P', 'E', 'T', 'K', 'N', 'R', 'L');
// format mm/dd
$i18n_holidays = array('01/01', '02/24', '04/10', '04/12', '05/01', '05/31', '06/23', '06/24', '08/20', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'Login',
'menu.logout' => 'Logout',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Abiinfo',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'loo uus managerikonto',
'menu.profile' => 'Profiili',
'menu.time' => 'Aeg',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Raportid',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projektid',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'Meeskonnad',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Kliendid',
'menu.options' => 'Suvandid',

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
'error.db' => 'andmebaasi viga',
'error.field' => 'valed "{0}" andmed',
'error.empty' => 'väli "{0}" on tühi',
'error.not_equal' => 'väli "{0}" ei ole väljaga "{1}" võrdne',
'error.interval' => 'ebakorrektne intervall',
'error.project' => 'vali projekt',
'error.activity' => 'vali tegevus',
'error.auth' => 'vale login või salasõna',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'selle nimega projekt on juba olemas',
'error.activity_exists' => 'selle nimega tegevus on juba olemas',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: this string needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'sellise e-mail aadressiga kasutajat ei ole', 
'error.upload' => 'viga faili vastuvõtmisel',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'error sending mail',
// 'error.no_email' => 'no email associated with this login',
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

// labels for various buttons
'button.login' => 'login',
'button.now' => 'kohe',
// 'button.set' => 'aseta',
'button.save' => 'salvesta',
'button.delete' => 'kustuta',
'button.cancel' => 'tühista',
'button.submit' => 'postita',
'button.add_user' => 'lisa kasutaja',
'button.add_project' => 'lisa projekt',
'button.add_activity' => 'lisa tegevus',
'button.add_client' => 'lisa klient',
'button.add' => 'lisa',
'button.generate' => 'loo',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'edasi',
'button.send' => 'saada',
'button.send_by_email' => 'saada e-mailiga',
'button.save_as_new' => 'salvesta uuena',
'button.create_team' => 'loo meeskond',
'button.export' => 'ekspordi meeskond',
'button.import' => 'impordi meeskond',
'button.apply' => 'rakenda',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'valuuta',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.name' => 'nimi',

'label.password' => 'salasõna',
'label.confirm_password' => 'kinnita salasõna',
// 'label.email' => 'email',
'label.total' => 'kokku',
// Translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',

// Form titles.
'title.options' => 'Suvandid',
// TODO: almost the entire title section is missing here. See the English file.

"form.filter.project" => 'projekt',
"form.filter.filter" => 'lemmikraport',
"form.filter.filter_new" => 'salvesta lemmikuna',
// Note to translators: the string below is missing and must be added to the translation
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',

// password reminder form attributes
"form.fpass.title" => 'tühjenda salasõna',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'salasõna tühjendamise käsk edastatud',
// Note to translators: the 3 strings below must be translated
// "form.fpass.send_pass_subj" => 'AnukoTime Tracker password reset request',
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'administraator',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new meeskond by creating a new meeskond manager account.<br>you can also import meeskond data from an xml file from another Anuko time tracker server (no e-mail collisions are allowed).',

"form.admin.change_pass" => 'muuda administraatori konto salasõna',
"form.admin.profile.title" => 'meeskonnad',
"form.admin.profile.noprofiles" => 'sinu andmebaas on tühi. logi adminina sisse ja loo uus meeskond.',
"form.admin.profile.comment" => 'kustuta meeskond',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'nimi',
"form.admin.profile.th.edit" => 'muuda',
"form.admin.profile.th.del" => 'kustuta',
"form.admin.profile.th.active" => 'aktiivne',
// Note to translators: the strings below are missing in the translation and must be translated
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'minu aeg',
"form.mytime.edit_title" => 'ajakande muutmine',
"form.mytime.del_str" => 'ajakande kustutamine',
// Note to translators: the string below must be translated
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'kuupäev',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tegevus',
"form.mytime.start" => 'algus',
"form.mytime.finish" => 'lõpp',
"form.mytime.duration" => 'kestus',
"form.mytime.note" => 'märkus',
// Note to translators: "form.mytime.behalf" => 'igapäevane töö', // the translation is incorrect
"form.mytime.daily" => 'igapäevane töö',
"form.mytime.total" => 'tunde kokku: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'tegevus',
"form.mytime.th.start" => 'algus',
"form.mytime.th.finish" => 'lõpp',
"form.mytime.th.duration" => 'kestus',
"form.mytime.th.note" => 'märkus',
"form.mytime.th.edit" => 'muuda',
"form.mytime.th.delete" => 'kustuta',
"form.mytime.del_yes" => 'ajakanne kustutatud',
"form.mytime.no_finished_rec" => 'kanne salvestati ainult alguse ajaga. see ei ole viga. logi välja kui vaja peaks olema.',
"form.mytime.billable" => 'arvestatav',
"form.mytime.warn_tozero_rec" => 'see ajakanne tuleb kustutada kuna see ajaperiood on lukustatud',
// Note to translators: the string below must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'loo uus halduri konto',
"form.profile.edit_title" => 'profiili muutmine',
"form.profile.name" => 'nimi',
"form.profile.login" => 'login',

// Note to translators: the strings below must be translated and added to the localization file
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'inimesed',
"form.people.createu_str" => 'loo uus kasutaja',
"form.people.edit_str" => 'kasutaja muutmine',
"form.people.del_str" => 'kasutaja kustutamine',
"form.people.th.name" => 'nimi',
"form.people.th.login" => 'login',
"form.people.th.role" => 'roll',
"form.people.th.edit" => 'muuda',
"form.people.th.del" => 'kustuta',
"form.people.th.status" => 'seisund',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'hind',
"form.people.manager" => 'haldur',
"form.people.comanager" => 'kaashaldur',
"form.people.empl" => 'kasutaja',
"form.people.name" => 'nimi',
"form.people.login" => 'login',

"form.people.rate" => 'vaikimisi tunni hind',
"form.people.comanager" => 'kaashaldur',
"form.people.projects" => 'projektid',

// projects form attributes
"form.project.proj_title" => 'projektid',
"form.project.edit_str" => 'projektide muutmine',
"form.project.add_str" => 'uue projekti lisamine',
"form.project.del_str" => 'projekti kustutamine',
"form.project.th.name" => 'nimi',
"form.project.th.edit" => 'muuda',
"form.project.th.del" => 'kustuta',
"form.project.name" => 'nimi',

// activities form attributes
"form.activity.act_title" => 'tegevus',
"form.activity.add_title" => 'uue tegevuse lisamine',
"form.activity.edit_str" => 'tegevuse muutmine',
"form.activity.del_str" => 'tegevuse kustutamine',
"form.activity.name" => 'nimi',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'nimi',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'muuda',
"form.activity.th.del" => 'kustuta',

// report attributes
"form.report.title" => 'aruanded',
"form.report.from" => 'algab kuupäevast',
"form.report.to" => 'lõpeb kuupäeval',
"form.report.groupby_user" => 'kasutaja',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'tegevus',
"form.report.duration" => 'kestus',
"form.report.start" => 'algus',
"form.report.activity" => 'tegevus',
"form.report.show_idle" => 'näita tühja aega',
"form.report.finish" => 'lõpp',
"form.report.note" => 'märkus',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'ainult summad',
"form.report.total" => 'tunde kokku',
"form.report.th.empllist" => 'kasutaja',
"form.report.th.date" => 'kuupäev',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'tegevus',
"form.report.th.start" => 'algus',
"form.report.th.finish" => 'lõpp',
"form.report.th.duration" => 'kestus',
"form.report.th.note" => 'märkus',

// mail form attributes
"form.mail.from" => 'kellelt',
"form.mail.to" => 'kellele',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'teema',
"form.mail.comment" => 'märkus',
"form.mail.above" => 'saada aruanne e-mailiga',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>teade saadetud</b>',

// invoice attributes
"form.invoice.title" => 'arve',
"form.invoice.caption" => 'arve',
"form.invoice.above" => 'lisainformatsioon arvele',
"form.invoice.select_cust" => 'vali klient',
"form.invoice.fillform" => 'täida väljad',
"form.invoice.date" => 'kuupäev',
"form.invoice.number" => 'arve number',
"form.invoice.tax" => 'maks',
"form.invoice.comment" => 'kommentaar ',
"form.invoice.th.username" => 'isik',
"form.invoice.th.time" => 'tunde',
"form.invoice.th.rate" => 'hind',
"form.invoice.th.summ" => 'summa',
"form.invoice.subtotal" => 'vahesumma',
"form.invoice.customer" => 'klient',
"form.invoice.mailinv_above" => 'saada see arve e-mailiga',
"form.invoice.sending_str" => '<b>arve saadetud</b>',

"form.migration.zip" => 'pakkimine',
"form.migration.file" => 'vali fail',
"form.migration.import.title" => 'impordi andmed',
"form.migration.import.success" => 'andmed imporditud',
"form.migration.import.text" => 'impordi meeskonna andmed xml-failist',
"form.migration.export.title" => 'ekspordi andmed',
"form.migration.export.success" => 'andmed eksporditud',
"form.migration.export.text" => 'võid kogu meeskonna andmed eksportida xml-faili. sellest võib olla kasu kui vahetad serverit.',
// Note to translators: the string below must be translated and added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kliendid',
"form.client.add_title" => 'lisa klient',
"form.client.edit_title" => 'muuda klienti',
"form.client.del_title" => 'kustuta klient',
"form.client.th.name" => 'nimi',
"form.client.th.edit" => 'muuda',
"form.client.th.del" => 'kustuta',
"form.client.name" => 'nimi',
"form.client.tax" => 'maks',
"form.client.comment" => 'märkus ',

// miscellaneous strings
"forward.forgot_password" => 'unustasid salasõna?',
"forward.edit" => 'muuda',
"forward.delete" => 'kustuta',
"forward.tocsvfile" => 'ekspordi andmed .csv faili',
"forward.toxmlfile" => 'ekspordi andmed .xml faili',
"forward.geninvoice" => 'loo arve',
"forward.change" => 'konfigureeri kliendid',

// strings inside contols on forms
"controls.select.project" => '--- vali projekt ---',
"controls.select.activity" => '--- vali tegevus ---',
"controls.select.client" => '--- vali klient ---',
"controls.project_bind" => '--- kõik ---',
"controls.all" => '--- kõik ---',
"controls.notbind" => '--- ei ---',
"controls.per_tm" => 'käesolev kuu',
"controls.per_lm" => 'eelmine kuu',
"controls.per_tw" => 'käesolev nädal',
"controls.per_lw" => 'eelmine nädal',
"controls.per_td" => 'täna',
"controls.per_at" => 'kõik ajad',
// Note to translators: the string below must be translated and added
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- vali ajaperiood ---',
"controls.sel_groupby" => '--- ilma grupeerimata ---',
"controls.inc_billable" => 'arvestatav',
"controls.inc_nbillable" => 'mittearvestatav',
// Note to translators: the string below must be translated and added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'tegevused kasutajal',
// Note to translators: the string below is missing and must be translated and added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'tabel perioodiks',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (haldur)',
"label.pcminfo" => ' (kaashaldur)',
"label.painfo" => ' (administraator)',
"label.time_noentry" => 'sissekanne puudub',
"label.today" => 'täna',
"label.req_fields" => '* nõutud väljad',
"label.sel_project" => 'vali projekt',
"label.sel_activity" => 'vali tegevus',
"label.sel_tp" => 'vali ajaperiood',
"label.set_tp" => 'või märgi kuupäevad',
"label.fields" => 'näita välju',
"label.group_title" => 'grupeeri',
"label.include_title" => 'kaasa kanded',
"label.inv_str" => 'arved',
"label.set_empl" => 'vali kasutajad',
"label.sel_all" => 'vali kõik',
"label.sel_none" => 'märgi kõik mittevalituks',
"label.or" => 'või',
"label.disable" => 'keela',
"label.enable" => 'luba',
"label.filter" => 'filtreeri',
"label.timeweek" => 'nädalane summa',
// Note to translators: the strings below must be translated and added to the localization file
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
