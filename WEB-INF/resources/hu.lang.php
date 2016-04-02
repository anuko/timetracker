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

// Note to translators: Please use proper capitalization rules for your language.

$i18n_language = 'Magyar';
$i18n_months = array('január', 'február', 'március', 'április', 'május', 'június', 'július', 'augusztus', 'szeptember', 'október', 'november', 'december');
$i18n_weekdays = array('vasárnap', 'hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat');
$i18n_weekdays_short = array('V', 'H', 'K', 'Sz', 'Cs', 'P', 'Sz');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '03/15', '04/12', '04/13', '05/01', '05/31', '06/01', '08/20', '08/21', '10/23', '11/01', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'bejelentkezés',
'menu.logout' => 'kijelentkezés',
// TODO: Translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'segítség',
// TODO: Translate the following:
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'profil',
'menu.time' => 'munkaidő',
// TODO: Translate the following:
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'riportok',
// TODO: Translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => 'projektek',
// TODO: Translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'csoportok',
// TODO: Translate the following:
// 'menu.export' => 'Export'
'menu.clients' => 'ügyfelek',
'menu.options' => 'opciók',

// Footer - strings on the bottom of most pages.
// TODO: Translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: Translate the following:
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'adatbázis hiba',
'error.field' => 'hibás "{0}" mező tartalma',
'error.empty' => 'a "{0}" mező üres',
'error.not_equal' => 'A "{0}" mező tartalma nem egyezik meg a "{1}" mező tartalmával!',
'error.interval' => 'hibás időszak megadás',
'error.project' => 'válassz projektet',
'error.activity' => 'válassz tevékenységet',
'error.auth' => 'hibás bejelentkezési adatok',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'ilyen nevű projekt már létezik',
'error.activity_exists' => 'ilyen névvel már van definiálva tevékenység',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: this string needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'nincs ilyen e-mail címmel definiált felhasználó',
'error.upload' => 'file feltöltési hiba',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'error sending mail',
// 'error.no_email' => 'no email associated with this login',
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

// labels for various buttons
'button.login' => 'bejelentkezés',
'button.now' => 'most',
// 'button.set' => 'beállítás',
'button.save' => 'mentés',
'button.delete' => 'törlés',
'button.cancel' => 'vissza',
'button.submit' => 'mentés',
'button.add_user' => 'felhasználó felvétele',
'button.add_project' => 'projekt felvétele',
'button.add_activity' => 'tevékenyég felvétele',
'button.add_client' => 'ügyfél hozzáadása',
'button.add' => 'hozzáadás',
'button.generate' => 'generálás',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'mehet',
'button.send' => 'küld',
'button.send_by_email' => 'küldés e-mail-ben',
'button.save_as_new' => 'mentés újként',
'button.create_team' => 'csoport létrehozása',
'button.export' => 'csoportok exportálása',
'button.import' => 'csoportok importálása',
'button.apply' => 'alkalmaz',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'pénznem',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.name' => 'név',

'label.password' => 'jelszó',
'label.confirm_password' => 'jelszó megerősítése',
// 'label.email' => 'email',
'label.total' => 'összesen',
// Translate the following string.
// 'label.page' => 'Page',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => 'projekt',
"form.filter.filter" => 'előre definiált riport formátum',
"form.filter.filter_new" => 'mentsük el ezt a riport formátumot',
// Note to translators: the string below is missing and must be added and translated
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'bejelentkezés',
// Note to translators: "form.login.login" => 'e-mail cím', // email has been changed to login

// password reminder form attributes
"form.fpass.title" => 'a jelszó alap állapotra állítása',
// Note to translators: "form.fpass.login" => 'e-mail cím', // email has been changed to login
"form.fpass.send_pass_str" => 'jelszó alap állapotra állítása megkezdve',
"form.fpass.send_pass_subj" => 'A jelszó alap állapotra állítása a Anuko TimeTracker-ben',
// Note to translators: the string below must be translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "a jelszót a megváltoztatásához írja be és mentse el",

// administrator form
"form.admin.title" => 'Adminisztrátor',
"form.admin.duty_text" => 'új csoport létrehozása egy csoport-vezetői jogosultsággal.<br>a csoport adatokat importálhatjuk XML-ből (csak az e-mail címek ne ütközzenek).',

"form.admin.change_pass" => 'az adminisztrátori jelszó megváltoztatása',
"form.admin.profile.title" => 'csoportok',
"form.admin.profile.noprofiles" => 'az adatbázis üres. lépj be adminisztrátorként és hozz létre egyet.',
"form.admin.profile.comment" => 'csoport törlése',
"form.admin.profile.th.id" => 'azonosító',
"form.admin.profile.th.name" => 'név',
"form.admin.profile.th.edit" => 'szerkesztés',
"form.admin.profile.th.del" => 'törlés',
"form.admin.profile.th.active" => 'aktív',
// Note to translators: the strings below are missing and must be added and translated 
// "form.admin.lock.period" => 'lock interval in days',
"form.admin.options" => 'opciók',
// "form.admin.lang_default" => 'site default language',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'munkaidőm',
"form.mytime.edit_title" => 'szerkesztés',
"form.mytime.del_str" => 'törlés',
"form.mytime.time_form" => ' (óó:pp)',
"form.mytime.date" => 'dátum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tevékenység',
"form.mytime.start" => 'kezdete',
"form.mytime.finish" => 'vége',
"form.mytime.duration" => 'hossz',
"form.mytime.note" => 'megjegyzés',
"form.mytime.behalf" => 'napi tevékenység lista, munkatárs:',
"form.mytime.daily" => 'napi munka',
"form.mytime.total" => 'összesített óraszám: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'tevékenység',
"form.mytime.th.start" => 'kezdete',
"form.mytime.th.finish" => 'vége',
"form.mytime.th.duration" => 'hossz',
"form.mytime.th.note" => 'megjegyzés',
"form.mytime.th.edit" => 'szerkesztés',
"form.mytime.th.delete" => 'törlés',
"form.mytime.del_yes" => 'a bejegyzés törölve',
"form.mytime.no_finished_rec" => 'csak az munka kezdete lett megjelölve, ha később visszalépsz a rendszerbe beállíthatod a vég-időpontot...',
// Note to translators: the strings below are missing and must be added and translated 
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'új vezetői jogosultság létrehozása',
"form.profile.edit_title" => 'profil szerkesztése',
"form.profile.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.profile.login" => 'login',

// Note to translators: the strings below are missing and must be added and translated 
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'munkatársak',
"form.people.createu_str" => 'új munkatárs hozzáadása',
"form.people.edit_str" => 'munkatárs adatainak szerkesztése',
"form.people.del_str" => 'munkatárs adatainak törlése',
"form.people.th.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.th.login" => 'login',
"form.people.th.role" => 'szerepkör',
"form.people.th.edit" => 'szerkesztés',
"form.people.th.del" => 'törlés',
"form.people.th.status" => 'státusz',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'tarifa',
"form.people.manager" => 'vezető',
"form.people.comanager" => 'helyettes',
"form.people.empl" => 'dolgozó',
"form.people.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.login" => 'login',

"form.people.rate" => 'általános óradíj',
"form.people.comanager" => 'helyettes',
"form.people.projects" => 'projektek',
// Note to translators: the string below is missing and must be added and translated 

// projects form attributes
"form.project.proj_title" => 'projektek',
"form.project.edit_str" => 'projekt adatainak szerkesztése',
"form.project.add_str" => 'új projekt hozzáadása',
"form.project.del_str" => 'projekt törlése',
"form.project.th.name" => 'név',
"form.project.th.edit" => 'szerkesztés',
"form.project.th.del" => 'törlés',
"form.project.name" => 'név',

// activities form attributes
"form.activity.act_title" => 'tevékenységek',
"form.activity.add_title" => 'új tevékenyég felvétele',
"form.activity.edit_str" => 'tevékenység szerkesztése',
"form.activity.del_str" => 'tevékenység törlése',
"form.activity.name" => 'név',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'név',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'szerkesztés',
"form.activity.th.del" => 'törlés',

// report attributes
"form.report.title" => 'riportok',
"form.report.from" => 'kezdő időpont',
"form.report.to" => 'vég időpont',
"form.report.groupby_user" => 'személyek szerint',
"form.report.groupby_project" => 'projektek szerint',
"form.report.groupby_activity" => 'tevékenységek szerint',
"form.report.duration" => 'időtartam',
"form.report.start" => 'kezdet',
"form.report.activity" => 'tevékenység',
"form.report.show_idle" => 'az üres időszakok megjelenítése',
"form.report.finish" => 'befejezés',
"form.report.note" => 'megjegyzés',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'csak a teljes óraszám',
"form.report.total" => 'összesített óraszám',
"form.report.th.empllist" => 'dolgozó',
"form.report.th.date" => 'dátum',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'tevékenység',
"form.report.th.start" => 'elkezdve',
"form.report.th.finish" => 'befejezve',
"form.report.th.duration" => 'időtartam',
"form.report.th.note" => 'megjegyzés',

// mail form attributes
"form.mail.from" => 'feladó',
"form.mail.to" => 'címzett',
"form.mail.cc" => 'másolatot kap',
"form.mail.subject" => 'tárgy',
"form.mail.comment" => 'megjegyzés',
"form.mail.above" => 'küldjük el ezt a riportot e-mail-ben...',
// Note to translators: the string below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>az üzenet elküldve</b>',

// invoice attributes
"form.invoice.title" => 'számla',
"form.invoice.caption" => 'Számla',
"form.invoice.above" => 'a számlához tartozó adatok',
"form.invoice.select_cust" => 'válassz ügyfelet',
"form.invoice.fillform" => 'töltsd ki a mezőket',
"form.invoice.date" => 'Dátum',
"form.invoice.number" => 'számla azonosító száma',
"form.invoice.tax" => 'adó',
"form.invoice.daily_subtotals" => 'napi részösszeg',
"form.invoice.yourcoo" => 'az ön neve<br> és címe',
"form.invoice.custcoo" => 'az ügyfél nevebr> és címe',
"form.invoice.comment" => 'megjegyzés ',
"form.invoice.th.username" => 'személy',
"form.invoice.th.time" => 'óra',
"form.invoice.th.rate" => 'tarifa',
"form.invoice.th.summ" => 'darab',
"form.invoice.subtotal" => 'részösszeg',
"form.invoice.customer" => 'Ügyfél',
"form.invoice.mailinv_above" => 'küldjük el ezt a számlát e-mail-en',
"form.invoice.sending_str" => '<b>a számla elküldve</b>',

"form.migration.zip" => 'tömörítés',
"form.migration.file" => 'válassz file-nevet',
"form.migration.import.title" => 'adatok importálása',
"form.migration.import.success" => 'az importálás sikeresen véget ért',
"form.migration.import.text" => 'csoport adatok importja XML file-ból',
"form.migration.export.title" => 'az adatok exportálása',
"form.migration.export.success" => 'az exportálás sikeres volt',
"form.migration.export.text" => 'kimentheted az összes felvitt csoport adatait egy XML file-ba, ami megkönnyíti a TimeTracker szerverek közötti adatátvitelt...',
// Note to translators: the strings below are missing and must be added and translated 
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title"=> 'ügyfelek',
"form.client.add_title" => 'új ügyfél hozzáadása',
"form.client.edit_title" => 'ügyfél adatainak szerkesztése',
"form.client.del_title" => 'ügyfél törlése',
"form.client.th.name" => 'név',
"form.client.th.edit" => 'szerkesztés',
"form.client.th.del" => 'törlés',
"form.client.name" => 'név',
"form.client.tax" => 'adó',
"form.client.daily_subtotals" => 'napi részösszeg',
"form.client.yourcoo" => 'az Ön neve<br> és számlázási címe',
"form.client.custcoo" => 'cím',
"form.client.comment" => 'megjegyzés ',

// miscellaneous strings
"forward.forgot_password" => 'elfelejtetted a jelszót?',
"forward.edit" => 'szerkesztés',
"forward.delete" => 'törlés',
"forward.tocsvfile" => 'az adatok exportálása CSV file-ba',
// Note to translators: the string below is missing and must be added and translated 
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'számla készítés',
"forward.change" => 'ügyfelek adatainak beállítása',

// strings inside contols on forms
"controls.select.project" => '--- válassz projektet ---',
"controls.select.activity" => '--- válassz tevékenységet ---',
"controls.select.client" => '--- válassz ügyfelet ---',
"controls.project_bind" => '--- összes ---',
"controls.all" => '--- összes ---',
"controls.notbind" => '--- nincs ---',
"controls.per_tm" => 'ebben a hónapban',
"controls.per_lm" => 'múlt hónapban',
"controls.per_tw" => 'ezen a héten',
"controls.per_lw" => 'múlt héten',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- válassz időszakot ---',
"controls.sel_groupby" => '--- csoportosítás nélkül ---',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be added and translated 
// "label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>helyett %s</b>',
"label.pminfo" => ' (vezető)',
"label.pcminfo" => ' (helyettes)',
"label.painfo" => ' (adminisztrátor)',
"label.time_noentry" => 'nincs bejegyzés',
"label.today" => 'ma',
"label.req_fields" => '* kötelezően kitöltendő mezők',
"label.sel_project" => 'válassz projektet',
"label.sel_activity" => 'válassz tevékenységet',
"label.sel_tp" => 'jelölj meg egy időszakot',
"label.set_tp" => '... vagy állíts be konkrét dátumot',
"label.fields" => 'csak a kijelölt mezők fognak szerepelni a riportban',
"label.group_title" => 'csoportosítva',
// Note to translators: the string below is missing and must be added and translated 
// "label.include_title" => 'include records',
"label.inv_str" => 'számla',
"label.set_empl" => 'válassz dolgozót',
"label.sel_all" => 'mindenkit kijelöl',
"label.sel_none" => 'senkit nem jelöl ki',
"label.or" => 'vagy',
"label.disable" => 'tiltva',
"label.enable" => 'engedélyezve',
"label.filter" => 'szűrés',
// Note to translators: the strings below are missing and must be added and translated 
//"label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
