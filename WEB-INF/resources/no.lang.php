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

$i18n_language = 'Norsk';
$i18n_months = array('Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember');
$i18n_weekdays = array('Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag');
// TODO: check translation of $i18n_weekdays_short.
$i18n_weekdays_short = array('Sø', 'Ma', 'Ti', 'On', 'To', 'Fr', 'Lø');
// format mm/dd
$i18n_holidays = array('01/01', '04/05', '04/09', '04/10', '04/12', '04/13', '05/01', '05/17', '05/21', '05/31', '06/01', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Innlogging',
'menu.logout' => 'Logg ut',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Hjelp',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
'menu.time' => 'Tid',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Rapporter',
'menu.charts' => 'Diagrammer',
'menu.projects' => 'Prosjekter',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
// 'menu.teams' => 'Teams',
'menu.export' => 'Eksport',
'menu.clients' => 'Klienter',
'menu.options' => 'Opsjoner',

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
'error.db' => 'Databasefeil.',
'error.field' => 'Feil "{0}" data.',
'error.empty' => 'Feltet "{0}" er tomt.',
'error.not_equal' => 'Feltet "{0}" stemmer ikke med "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Velg prosjekt.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Feil brukernavn eller passord.',
'error.user_exists' => 'Bruker med et slikt brukernavn eksisterer allerede.',
'error.project_exists' => 'Et prosjekt med dette navnet er allerede opprettet.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => 'En klient med dette navnet er allerede opprettet.',
// TODO: translate the following.
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'Det er ingen bruker med dette brukernavnet.',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Feil med lasting av fil.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Feil ved sending av e-post.',
'error.no_email' => 'Det er ingen e-post knyttet til dette brukernavnet.',
'error.uncompleted_exists' => 'Ufullført registrering finnes allerede. Lukk eller slett den.',
'error.goto_uncompleted' => 'Gå til ufullført registrering.',
// TODO: translate the following.
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Innlogging',
'button.now' => 'Nå',
'button.save' => 'Lagre',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Avbryt',
// TODO: translate the following.
// 'button.submit' => 'Submit',
'button.add_user' => 'Legg til bruker',
'button.add_project' => 'Legg til prosjekt',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Legg til klient',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Legg til',
'button.generate' => 'Generer',
'button.reset_password' => 'Resett passord',
'button.send' => 'Send',
'button.send_by_email' => 'Send som e-post',
'button.create_team' => 'Opprett team',
'button.export' => 'Eksport team',
'button.import' => 'Importer team',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Valuta',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
// 'label.person_name' => 'Name',
// 'label.thing_name' => 'Name',
// 'label.login' => 'Login',
'label.password' => 'Passord',
'label.confirm_password' => 'Bekreft passord',
'label.email' => 'E-post',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Emne',
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
// 'label.today' => 'Today',
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
// 'label.edit' => 'Edit',
// 'label.delete' => 'Delete',



// TODO: refactoring ongoing down from here.

'label.total' => 'totalt',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

// TODO: Please check the translation against the current English file as many things are being refactored. For example, many labels have been added after label.email.

// "form.filter.project" => 'prosjekt',
// "form.filter.filter" => 'favorittrapport',
// "form.filter.filter_new" => 'lagre som favoritt',
// "form.filter.filter_confirm_delete" => 'er du sikker på at du vil slette denne favorittrapporten?',

// login form attributes
"form.login.title" => 'innlogging',
"form.login.login" => 'innlogging',

// password reminder form attributes
// Note to translators: "form.fpass.title" => 'remind password', // the string must be translated
"form.fpass.login" => 'innlogging',
"form.fpass.send_pass_str" => 'passordet er sendt',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker passordet ditt',
// Note to translators: strings below need to be translated.
// "form.fpass.send_pass_body" => "Kjære bruker,\n\nNoen, trolig deg, bad om å få ditt Anuko Time Tracker password resatt. Vær vennlig å besøk denne lenken dersom du ønsker at passordet ditt skal resettes.\n\n%s\n\nAnuko Time Tracker er et enkelt og brukervennlig system for tidsregistrering basert på åpen kildekode. Les mer på https://www.anuko.com.\n\n",
// "form.fpass.reset_comment" => "vennligst skriv inn passordet og klikk på lagre for å resette passsordet.",

// Note to translators: the strings below must be translated
// // administrator form
// "form.admin.title" => 'administrator',
// "form.admin.duty_text" => 'opprett et nytt team ved å opprette en ny team manager konto.<br>du kan også importere team data fra en xml fil fra en annen Anuko Time Tracker server (ingen login kollisjoner er tillatt).',

// "form.admin.change_pass" => 'bytt passord på administratorkontoen',
// "form.admin.profile.title" => 'team',
// "form.admin.profile.noprofiles" => 'databasen din er tom. logg inn som admin og opprett et nytt team.',
// "form.admin.profile.comment" => 'slett team',
// "form.admin.profile.th.id" => 'id',
// "form.admin.profile.th.name" => 'navn',
// "form.admin.profile.th.edit" => 'endre',
// "form.admin.profile.th.del" => 'slett',
// "form.admin.profile.th.active" => 'aktiv',
// "form.admin.options" => 'opsjoner',
// "form.admin.custom_date_format" => "datoformat",
// "form.admin.custom_time_format" => "tidsformat",
// "form.admin.start_week" => "første ukedag",

// my time form attributes
// Note to translators: the 2 strings below must be translated
// "form.mytime.title" => 'min tid',
// "form.mytime.edit_title" => 'endre tidsoppføringen',
"form.mytime.del_str" => 'slett tids oppføringen',
"form.mytime.time_form" => ' (tt:mm)',
// Note to translators: "form.mytime.date" => 'dato', // the string must be translated
"form.mytime.project" => 'prosjekt',
"form.mytime.activity" => 'aktivitet',
"form.mytime.start" => 'starttid',
"form.mytime.finish" => 'ferdig',
"form.mytime.duration" => 'varighet',
"form.mytime.note" => 'notat',
"form.mytime.behalf" => 'daglig arbeide for',
"form.mytime.daily" => 'daglig arbeide',
"form.mytime.total" => 'totalt antall timer: ',
"form.mytime.th.project" => 'prosjekt',
"form.mytime.th.activity" => 'aktivitet',
"form.mytime.th.start" => 'starttid',
"form.mytime.th.finish" => 'ferdig',
"form.mytime.th.duration" => 'varighet',
"form.mytime.th.note" => 'notat',
"form.mytime.th.edit" => 'endre',
"form.mytime.th.delete" => 'slett',
// Note to translators: the strings below must be translated
// "form.mytime.del_yes" => 'tidsoppføringen er slettet', 
// "form.mytime.no_finished_rec" => 'Denne oppføringen ble lagret kun med starttid. Det er ikke en feil. Logg ut om nødvendig.',
// "form.mytime.billable" => 'kan faktureres',
// "form.mytime.warn_tozero_rec" => 'Denne oppføringen må slettes fordi tidsperioden er låst',
// "form.mytime.uncompleted" => 'uferdig',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'lag ny adminkonto',
"form.profile.edit_title" => 'endre profil',
"form.profile.name" => 'navn',
"form.profile.login" => 'innlogging',

// Note to translators: the strings below are missing and must be added and translated
// "form.profile.showchart" => 'vis kakediagram',
// "form.profile.lang" => 'språk',
// "form.profile.custom_date_format" => "dato format",
// "form.profile.custom_time_format" => "tims format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "første dag i uken",

// people form attributes
"form.people.ppl_str" => 'personer',
"form.people.createu_str" => 'legg til ny bruker',
"form.people.edit_str" => 'endre bruker',
"form.people.del_str" => 'slett bruker',
"form.people.th.name" => 'navn',
"form.people.th.login" => 'innlogging',
"form.people.th.role" => 'rolle',
"form.people.th.edit" => 'endre',
"form.people.th.del" => 'slett',
"form.people.th.status" => 'status',
// Note to translators: the 2 strings below are missing and must be added and translated
// "form.people.th.project" => 'prosjekt',
// "form.people.th.rate" => 'timesats',
// Note to translators: the strings below must be correctly translated
// "form.people.manager" => 'admin',
// "form.people.comanager" => 'co-manager',
"form.people.empl" => 'bruker',
"form.people.name" => 'navn',
"form.people.login" => 'innlogging',

"form.people.rate" => 'timesats',
// Note to translators: the strings below are missing and must be added and translated
// "form.people.comanager" => 'co-manager',
// "form.people.projects" => 'prosjekter',

// projects form attributes
"form.project.proj_title" => 'prosjekter',
"form.project.edit_str" => 'endre prosjekt',
"form.project.add_str" => 'legg til nytt prosjekt',
"form.project.del_str" => 'slett prosjekt',
"form.project.th.name" => 'navn',
"form.project.th.edit" => 'endre',
"form.project.th.del" => 'slett',
"form.project.name" => 'navn',

// activities form attributes
"form.activity.act_title" => 'aktiviteter',
"form.activity.add_title" => 'legg til ny aktivitet',
"form.activity.edit_str" => 'endre aktivitet',
// Note to translators: "form.activity.del_str" => 'slett aktivitet', // the string is incompletely translated
"form.activity.name" => 'navn',
"form.activity.project" => 'prosjekt',
"form.activity.th.name" => 'navn',
"form.activity.th.project" => 'prosjekt',
"form.activity.th.edit" => 'endre',
"form.activity.th.del" => 'slett',

// report attributes
"form.report.title" => 'rapporter',
"form.report.from" => 'starttid',
"form.report.to" => 'ferdig',
"form.report.groupby_user" => 'bruker',
"form.report.groupby_project" => 'prosjekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varighet',
"form.report.start" => 'starttid',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'antall dager ikke aktiv',
"form.report.finish" => 'ferdig',
"form.report.note" => 'notat',
"form.report.project" => 'prosjekt',
// Note to translators: the strings below must be translated 
// "form.report.totals_only" => 'kun summer',
"form.report.total" => 'totalt antall timer',
"form.report.th.empllist" => 'bruker',
"form.report.th.date" => 'dato',
"form.report.th.project" => 'prosjekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'starttid',
"form.report.th.finish" => 'ferdig',
"form.report.th.duration" => 'varighet',
"form.report.th.note" => 'notat',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.comment" => 'kommentar',
"form.mail.above" => 'send denne rapporten som e-post',
// Note to translators: the strings below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker is et enkelt, brukervennlig tidsregistreringssystem<br>basert på åpen kildekode. Besøk <a href="https://www.anuko.com">www.anuko.com</a> for flere opplysninger.',
// "form.mail.sending_str" => '<b>the message has been sent</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'tilleggsinformasjon for faktura',
// Note to translators: the strings below are missing and must be added and translated
// "form.invoice.select_cust" => 'velg klient',
// "form.invoice.fillform" => 'fyll inn i feltene',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'fakturanummer',
"form.invoice.tax" => 'MVA',
"form.invoice.comment" => 'notat',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'sats',
"form.invoice.th.summ" => 'antall',
"form.invoice.subtotal" => 'delsum',
"form.invoice.customer" => 'kommentar',
"form.invoice.mailinv_above" => 'send denne fakturaen som e-post',
// Note to translators: "form.invoice.sending_str" => '<b>invoice has been sent</b>', // the string must be translated

// Note to translators: the strings below are missing and must be added and translated
// "form.migration.zip" => 'komprimering',
// "form.migration.file" => 'velg fil',
// "form.migration.import.title" => 'import data',
// "form.migration.import.success" => 'import gjennomført vellykket',
// "form.migration.import.text" => 'import team data fra en xml fil',
// "form.migration.export.title" => 'export data',
// "form.migration.export.success" => 'eksport gjennomført vellykket',
// "form.migration.export.text" => 'du kan eksportere alle team data til en XML fil. dette kan være nyttig dersom du skal migrere data til din egen server.',
// "form.migration.compression.none" => 'ingen',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

// "form.client.title" => 'klienter',
// "form.client.add_title" => 'legg til klient',
// "form.client.edit_title" => 'endre klient',
// "form.client.del_title" => 'slett klient',
// "form.client.th.name" => 'navn',
// "form.client.th.edit" => 'endre',
// "form.client.th.del" => 'slett',
// "form.client.name" => 'navn',
// "form.client.tax" => 'avgift',
// "form.client.comment" => 'kommentar ',

// miscellaneous strings
"forward.forgot_password" => 'glemt passordet?',
"forward.edit" => 'endre',
"forward.delete" => 'slett',
"forward.tocsvfile" => 'eksporter data til en .csv fil',
// Note to translators: the strings below are missing and must be translated and added
// "forward.toxmlfile" => 'eksporter data til en .xml fil',
// "forward.geninvoice" => 'lag faktura',
// "forward.change" => 'konfigur klienter',

// strings inside contols on forms
"controls.select.project" => '--- velg prosjekt ---',
"controls.select.activity" => '--- velg aktivitet ---',
// Note to translators: the string below is missing and must be translated and added
// "controls.select.client" => '--- velg klient ---',
"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
// Note to translators: the strings below are missing and must be translated and added 
// "controls.notbind" => '--- no ---',
"controls.per_tm" => 'denne måneden',
"controls.per_lm" => 'forrige måned',
"controls.per_tw" => 'denne uken',
"controls.per_lw" => 'forrige uke',
// Note to translators: the strings below are missing and must be translated and added
// "controls.per_td" => 'i dag',
// "controls.per_at" => 'all tid',
// "controls.per_ty" => 'dette årr',
"controls.sel_period" => '--- velg tidsperiode ---',
"controls.sel_groupby" => '--- ingen sortering ---',
// Note to translators: the strings below are missing and must be translated and added
// "controls.inc_billable" => 'fakturerbar',
// "controls.inc_nbillable" => 'ikke fakturerbar',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be translated and added
// "label.chart.title1" => 'aktiviteter for bruker',
// "label.chart.title2" => 'prosjekter for bruker',
// "label.chart.period" => 'diagram for perioden',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>på vegne av %s</b>',
// Note to translators: the strings below must be correctly translated
// "label.pminfo" => ' (admin)',
// "label.pcminfo" => ' (co-manager)',
// "label.painfo" => ' (administrator)',
"label.time_noentry" => 'ingen tilgang',
"label.today" => 'i dag',
"label.req_fields" => '* obligatoriske felt',
"label.sel_project" => 'velg prosjekt',
"label.sel_activity" => 'velg aktivitet',
"label.sel_tp" => 'velg tidsperiode',
"label.set_tp" => 'eller sett dato',
"label.fields" => 'vis feltene',
"label.group_title" => 'sorter på',
// Note to translators: the strings below must be translated
// "label.include_title" => 'ta med oppføringer',
// "label.inv_str" => 'faktura',
"label.set_empl" => 'velg brukere',
// Note to translators: the strings below are missing and must be translated and added
// "label.sel_all" => 'velg alle',
// "label.sel_none" => 'velg ingen',
// "label.or" => 'or',
// "label.disable" => 'slå av',
// "label.enable" => 'slå på',
// "label.filter" => 'filter',
// "label.timeweek" => 'uken totalt',
// "label.hrs" => 'timer',
// "label.errors" => 'feil',
// "label.ldap_hint" => 'Skriv din <b>Windows login</b> og <b>passord</b> i feltene nedenfor.',
// "label.calendar_today" => 'i dag',
// "label.calendar_close" => 'lukk',

// login hello text
// "login.hello.text" => "Anuko Time Tracker er et enkelt, brukervennlig tidsregistreringssystem basert på åpen kildekode.",
);
