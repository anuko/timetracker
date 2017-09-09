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

$i18n_language = 'Česky';
$i18n_months = array('leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
$i18n_weekdays = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
$i18n_weekdays_short = array('ne', 'po', 'út', 'st', 'čt', 'pá', 'so');
// format mm/dd
$i18n_holidays = array('01/01', '04/13', '05/01', '05/08', '07/05', '07/06', '09/28', '10/28', '11/17', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'Přihlásit',
'menu.logout' => 'Odhlásit',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Pomoc',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'vytvořit nový účet vedoucího',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.time' => 'Time',
'menu.time' => 'záznam práce',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Sestavy',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projekty',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'Týmy',
'menu.export' => 'Export',
'menu.clients' => 'Zákazníci',
// TODO: translate the following.
// 'menu.options' => 'Options',

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
'error.db' => 'chyba databáze',
'error.field' => 'nesprávná "{0}" data',
'error.empty' => 'pole "{0}" je prázdné',
'error.not_equal' => 'pole "{0}" neodpovídá poli "{1}"',
'error.interval' => 'nevhodný interval',
'error.project' => 'výběr projektu',
'error.activity' => 'výběr činnosti',
'error.auth' => 'nesprávné jméno nebo heslo',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'projekt tohoto jména již existuje',
'error.activity_exists' => 'činnost tohoto jména již existuje',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: error.no_login needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'uživatel s tímto e-mailem neexistuje',
'error.upload' => 'chyba přenosu souboru',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'přihlásit',
'button.now' => 'teď',
'button.save' => 'uložit',
'button.delete' => 'smazat',
'button.cancel' => 'zrušit',
'button.submit' => 'uložit',
'button.add_user' => 'přidat uživatele',
'button.add_project' => 'přidat projekt',
'button.add_activity' => 'přidat činnost',
'button.add_client' => 'přidat zákazníka',
'button.add' => 'přidat',
'button.generate' => 'vytvořit',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'přejít',
'button.send' => 'poslat',
'button.send_by_email' => 'poslat e-mailem',
'button.save_as_new' => 'uložit jako nový',
'button.create_team' => 'vytvořit tým',
'button.export' => 'exportovat tým',
'button.import' => 'importovat tým',
'button.apply' => 'provést',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'měna',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.name' => 'jméno',

'label.password' => 'heslo',
'label.confirm_password' => 'potvrdit heslo',
// TODO: Translate the following.
// 'label.email' => 'email',
'label.cc' => 'Cc',
// TODO: Translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Předmět',
'label.total' => 'celkem',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => 'projekt',
"form.filter.filter" => 'oblíbená sestava',
"form.filter.filter_new" => 'uložit jako oblíbenou sestavu',
"form.filter.filter_confirm_delete" => 'opravdu chceš vymazat tuto položku z oblíbených?',

// login form attributes
"form.login.title" => 'přihlásit',
"form.login.login" => 'přihlásit',

// password reminder form attributes
"form.fpass.title" => 'resetovat heslo',
"form.fpass.login" => 'přihlásit',
"form.fpass.send_pass_str" => 'zaslán požadavek k vymazání hesla',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker požadavek na vymazání hesla',
// Note to translators: this string needs to be translated.
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "pro změnu hesla jej napište a zvolte uložit",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'vytvořit nový tým prostřednictvím účtu týmového manažera.<br>můžete také importovat týmová data z xml souboru z jiného time tracker serveru (nejsou povoleny shody e-mailových adres!).',

"form.admin.change_pass" => 'změna hesla účtu administrator',
"form.admin.profile.title" => 'týmy',
"form.admin.profile.noprofiles" => 'vaše databáze je prázdná. přihlašte se jako admin a vytvořte nový tým.',
"form.admin.profile.comment" => 'smazat tým',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'jméno',
"form.admin.profile.th.edit" => 'upravit',
"form.admin.profile.th.del" => 'smazat',
"form.admin.profile.th.active" => 'aktovní',
// Note to translators: the strings below are missing in the translation and must be added
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'můj deník',
"form.mytime.edit_title" => 'upravit časový záznam',
"form.mytime.del_str" => 'smazat časový záznam',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'datum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'činnost',
"form.mytime.start" => 'začátek',
"form.mytime.finish" => 'konec',
"form.mytime.duration" => 'trvání',
"form.mytime.note" => 'poznámka',
"form.mytime.behalf" => 'denní práce pracovníka',
"form.mytime.daily" => 'denní práce',
"form.mytime.total" => 'součet hodin: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'činnost',
"form.mytime.th.start" => 'začátek',
"form.mytime.th.finish" => 'konec',
"form.mytime.th.duration" => 'trvání',
"form.mytime.th.note" => 'poznámka',
"form.mytime.th.edit" => 'upravit',
"form.mytime.th.delete" => 'odstranit',
"form.mytime.del_yes" => 'časový záznam úspěšně odstraněn',
"form.mytime.no_finished_rec" => 'záznam byl uložen pouze s časem zahájení. není to chyba. můžete se odhlásit, potřebujete-li.',
"form.mytime.billable" => 'k fakturaci',
"form.mytime.warn_tozero_rec" => 'tento záznam musí být smazán, neboť období je uzamčeno',
// Note to translators: the string below is missing in the translation and must be added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'vytvořit nový manažerský účet',
"form.profile.edit_title" => 'upravit profil',
"form.profile.name" => 'jméno',
"form.profile.login" => 'přihlásit',

"form.profile.showchart" => 'zobrazuj grafy',
"form.profile.lang" => 'jazyk',
// Note to translators: the strings below are missing in the translation and must be added
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'pracovnící',
"form.people.createu_str" => 'vytváření nového uživatele',
"form.people.edit_str" => 'nastavení uživatele',
"form.people.del_str" => 'smazat uživatele',
"form.people.th.name" => 'jméno',
"form.people.th.login" => 'přihlásit',
"form.people.th.role" => 'role',
"form.people.th.edit" => 'upravit',
"form.people.th.del" => 'smazat',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'sazba',
"form.people.manager" => 'manažer',
"form.people.comanager" => 'spolumanažer',
"form.people.empl" => 'uživatel',
"form.people.name" => 'jméno',
"form.people.login" => 'přihlásit',

"form.people.rate" => 'hodinová sazba',
"form.people.comanager" => 'spolumanažer',
"form.people.projects" => 'projekty',

// projects form attributes
"form.project.proj_title" => 'projekty',
"form.project.edit_str" => 'upravit projekt',
"form.project.add_str" => 'pridat nový projekt',
"form.project.del_str" => 'smazat projekt',
"form.project.th.name" => 'jméno',
"form.project.th.edit" => 'upravit',
"form.project.th.del" => 'smazat',
"form.project.name" => 'Název',

// activities form attributes
"form.activity.act_title" => 'činnosti',
"form.activity.add_title" => 'přidat činnost',
"form.activity.edit_str" => 'upravit činnost',
"form.activity.del_str" => 'smazat činnost',
"form.activity.name" => 'název činnosti',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'jméno',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'upravit',
"form.activity.th.del" => 'smazat',

// report attributes
"form.report.title" => 'sestavy',
"form.report.from" => 'počáteční datum',
"form.report.to" => 'koncové datum',
"form.report.groupby_user" => 'uživatel',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'činnost',
"form.report.duration" => 'trvání',
"form.report.start" => 'počátek',
"form.report.activity" => 'činnost',
"form.report.show_idle" => 'ukázat nečinné',
"form.report.finish" => 'konec',
"form.report.note" => 'poznámka',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'pouze součty',
"form.report.total" => 'součty hodin',
"form.report.th.empllist" => 'uzivatel',
"form.report.th.date" => 'datum',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'činnost',
"form.report.th.start" => 'počátek',
"form.report.th.finish" => 'konec',
"form.report.th.duration" => 'trvání',
"form.report.th.note" => 'poznámka',

// mail form attributes
"form.mail.from" => 'od',
"form.mail.to" => 'komu',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'předmět',
"form.mail.comment" => 'komentář',
"form.mail.above" => 'poslat sestavu e-mailem',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>zpráva odeslána</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'fakturační informace',
"form.invoice.select_cust" => 'výběr firmy',
"form.invoice.fillform" => 'vyplňte pole',
"form.invoice.date" => 'datum',
"form.invoice.number" => 'faktura číslo',
"form.invoice.tax" => 'DPH',
"form.invoice.comment" => 'komentář ',
"form.invoice.th.username" => 'osoba',
"form.invoice.th.time" => 'hodin',
"form.invoice.th.rate" => 'sazba',
"form.invoice.th.summ" => 'množství',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'zákazník',
"form.invoice.mailinv_above" => 'poslat fakturu e-mailem',
"form.invoice.sending_str" => '<b>faktura odeslána</b>',

"form.migration.zip" => 'komprese',
"form.migration.file" => 'výběr souboru',
"form.migration.import.title" => 'importovat data',
"form.migration.import.success" => 'import byl úspěšně dokončen',
"form.migration.import.text" => 'importovat týmová data z xml souboru',
"form.migration.export.title" => 'exportovat data',
"form.migration.export.success" => 'export byl úspěšně dokončen',
"form.migration.export.text" => 'můžete exportova týmová data do xml souboru. může se to hodit pro přesun na jiný server.',
// Note to translators: the string below is missing in the translation and must be added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'zákazníci',
"form.client.add_title" => 'přidat zákazníka',
"form.client.edit_title" => 'upravit zákazníka',
"form.client.del_title" => 'smazat zákazníka',
"form.client.th.name" => 'jméno',
"form.client.th.edit" => 'upravit',
"form.client.th.del" => 'smazat',
"form.client.name" => 'jméno',
"form.client.tax" => 'DPH',
"form.client.comment" => 'poznámka ',

// miscellaneous strings
"forward.forgot_password" => 'zapomenuté heslo?',
"forward.edit" => 'upravit',
"forward.delete" => 'smazat',
"forward.tocsvfile" => 'exportovat data do .csv souboru',
"forward.toxmlfile" => 'exportovat data do .xml souboru',
"forward.geninvoice" => 'vytvořit fakturu',
"forward.change" => 'upravit zákazníky',

// strings inside contols on forms
"controls.select.project" => '--- výběr projektu ---',
"controls.select.activity" => '--- výběr činnosti ---',
"controls.select.client" => '--- výběr zákazníka ---',
"controls.project_bind" => '--- všechny ---',
"controls.all" => '--- vše ---',
"controls.notbind" => '--- nic ---',
"controls.per_tm" => 'tento měsíc',
"controls.per_lm" => 'minulý měsíc',
"controls.per_tw" => 'tento týden',
"controls.per_lw" => 'minulý týden',
"controls.per_td" => 'dnes',
"controls.per_at" => 'od počátku',
"controls.per_ty" => 'letos',
"controls.sel_period" => '--- výběr období ---',
"controls.sel_groupby" => '--- vše dohromady ---',
"controls.inc_billable" => 'k fakturaci',
"controls.inc_nbillable" => 'mimo fakturaci',
// Note to translators: the string below must be translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'činnosti uživatele',
"label.chart.title2" => 'projekty uživatele',
"label.chart.period" => 'přehled za období',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
// Note to translators: the string below must be translated
// "label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (manažer)',
"label.pcminfo" => ' (co-manažer)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'žádné záznamy',
"label.today" => 'dnes',
"label.req_fields" => '* nutno vyplnit',
"label.sel_project" => 'výběr projektu',
"label.sel_activity" => 'výběr činnosti',
"label.sel_tp" => 'výberte období',
"label.set_tp" => 'nebo určete dny',
"label.fields" => 'zobrazit pole',
"label.group_title" => 'seskupit podle',
"label.include_title" => 'včetně záznamů',
"label.inv_str" => 'faktura',
"label.set_empl" => 'výběr uživatelů',
"label.sel_all" => 'vybrat všechno',
"label.sel_none" => 'zrušit výběr',
"label.or" => 'nebo',
"label.disable" => 'zakázat',
"label.enable" => 'povolit',
"label.filter" => 'filtr',
"label.timeweek" => 'celkem za týden',
"label.hrs" => 'hodin',
// Note to translators: the 3 strings below are missing in the translation and must be added
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',

// login hello text
// Note to translators: the string below is missing in the translation and must be added
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
