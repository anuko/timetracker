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

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option 
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Svenska';
$i18n_months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');
$i18n_weekdays = array('Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag');
$i18n_weekdays_short = array('sön', 'mån', 'tis', 'ons', 'tor', 'fr', 'lör');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '04/10', '04/12', '04/13', '05/01', '05/21', '05/31', '06/06', '06/20', '10/31', '11/01', '12/25', '12/26');

$i18n_key_words = array(

// menu entries
'menu.login' => 'Logga in',
'menu.logout' => 'Logga ut',
'menu.feedback' => 'Feedback',
'menu.help' => 'Hjälp',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'Skapa huvudkonto',
'menu.edit_profile' => 'Ändra profil',
'menu.my_time' => 'Mina tider',
'menu.reports' => 'Rapporter',
// Note to translators: menu.charts needs to be translated.
// 'menu.charts' => 'charts',
'menu.projects' => 'Projekt',
'menu.activities' => 'Aktiviteter',
'menu.people' => 'Personal',
// Note to translators: is menu.teams translated correctly? It's a list of teams in the system.
'menu.teams' => 'Team',
// Note to translators: menu.export needs to be translated.
// 'menu.export' => 'export',
'menu.clients' => 'Kunder',
'menu.options' => 'Inställningar',
'menu.admin' => 'Admin',

// error strings
'error.db' => 'Fel i databasen',
'error.field' => 'felaktig "{0}" data',
'error.empty' => 'fält "{0}" är tomt',
'error.not_equal' => 'fält "{0}" är inte lika med fält "{1}"',
'error.interval' => 'felaktig intervall',
'error.project' => 'välj projekt',
'error.activity' => 'välj aktivitet',
'error.auth' => 'felaktig login eller lösenord',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'projektnamnet finns redan i databasen',
'error.activity_exists' => 'aktivitetsnamnet finns redan i databasen',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: this string needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'det finns ingen användare med denna e-postadress',
'error.upload' => 'felaktig filuppladdning',
// Note to translators: the strings below are missing and must be added and translated
// 'error.period_locked' => 'can\\\'t complete the operation. records older than a certain number of days cannot be created or modified. team manager defines this in the "Lock interval in days" value on the "Profile" page. set it to 0 to remove locking. <br><br>uncompleted records (with 0 or empty duration) can be deleted.',
// 'error.mail_send' => 'error sending mail',
// 'error.no_email' => 'no email associated with this login',
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

// labels for various buttons
'button.login' => 'Logga in',
'button.now' => 'nu',
// 'button.set' => 'använd',
'button.save' => 'spara',
'button.delete' => 'ta bort',
'button.cancel' => 'avbryt',
'button.submit' => 'skicka',
'button.add_user' => 'skapa användare',
'button.add_project' => 'skapa projekt',
'button.add_activity' => 'skapa aktivitet',
'button.add_client' => 'skapa kund',
'button.add' => 'lägg till',
'button.generate' => 'skapa',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'gå vidare',
'button.send' => 'skicka',
'button.send_by_email' => 'skicka e-post',
'button.save_as_new' => 'spara som nytt',
// TODO: improve translation of button.create_team.
'button.create_team' => 'skapa nytt team',
'button.export' => 'exportera team',
'button.import' => 'importera team',
'button.apply' => 'spara',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'valuta',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.password' => 'lösenord',
'label.confirm_password' => 'bekräfta lösenord',
'label.email' => 'e-post',
'label.total' => 'total',
// Translate the following string.
// 'label.page' => 'Page',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'favorit rapport',
"form.filter.filter_new" => 'spara som favorit',
// Note to translators: the string below is missing and must be added and translated
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'logga in',
"form.login.login" => 'logga in',

// password reminder form attributes
"form.fpass.title" => 'återställ lösenord',
"form.fpass.login" => 'logga in',
"form.fpass.send_pass_str" => 'begäran för återställning av lösenord har skickats',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker lösenordsåterställning',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "Kära användare,\n\nSomeone, antagligen har du begärt återställning av lösenord för Anuko Time Tracker. Vänligen besök denna länk om du vill återställa ditt lösenord.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "skriv in ditt lösenord och tryck på spara för att ändra ditt lösenord",

// administrator form
"form.admin.title" => 'administratör',
"form.admin.duty_text" => 'skapa ny team genom att skapa en teamledar konto.<br>du kan även importera team information från en xmlfil eller annan anuko time tracker server (inga e-post dubletter tillåts).',

"form.admin.change_pass" => 'ändra lösenord för administratörs kontot',
"form.admin.profile.title" => 'team',
"form.admin.profile.noprofiles" => 'databasen är tom. logga in som admin och skapa ny team.',
"form.admin.profile.comment" => 'ta bort team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'namn',
"form.admin.profile.th.edit" => 'redigera',
"form.admin.profile.th.del" => 'ta bort',
"form.admin.profile.th.active" => 'aktiverad',
"form.admin.lock.period" => 'låsintervall i antal dagar',
"form.admin.options" => 'inställningar',
// Note to translators: the strings below are missing and must be added and translated
// "form.admin.lang_default" => 'site default language',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'mina tider',
"form.mytime.edit_title" => 'ändra tidstämpel',
"form.mytime.del_str" => 'ta bort tidsstämpel',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'datum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'aktivitet',
"form.mytime.start" => 'start',
"form.mytime.finish" => 'slut',
"form.mytime.duration" => 'varaktighet',
"form.mytime.note" => 'beskrivning',
"form.mytime.behalf" => 'daglig arbete för',
"form.mytime.daily" => 'daglig arbete',
"form.mytime.total" => 'total antal timmar: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'aktivitet',
"form.mytime.th.start" => 'start',
"form.mytime.th.finish" => 'slut',
"form.mytime.th.duration" => 'längd',
"form.mytime.th.note" => 'beskrivning',
"form.mytime.th.edit" => 'ändra',
"form.mytime.th.delete" => 'ta bort',
"form.mytime.del_yes" => 'borttagning av tiddstämpel lyckades',
"form.mytime.no_finished_rec" => 'denna tidsstämpel var sparad med endast starttid. Det är inget fel. logga ut om du vill.',
"form.mytime.billable" => 'debiterbar',
"form.mytime.warn_tozero_rec" => 'denna tidsstämpel måste tas bort för att tidsperiden är låst',
// Note to translators: the string below is missing and must be added and translated
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'skapa huvudkonto',
"form.profile.edit_title" => 'ändra profilen',
"form.profile.name" => 'namn',
"form.profile.login" => 'logga in',

// Note to translators: the strings below are missing and must be added and translated
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'personal',
"form.people.createu_str" => 'skapa ny användare',
"form.people.edit_str" => 'ändra användare',
"form.people.del_str" => 'ta bort användare',
"form.people.th.name" => 'namn',
"form.people.th.login" => 'logga in',
"form.people.th.role" => 'roll',
"form.people.th.edit" => 'redigera',
"form.people.th.del" => 'ta bort',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'timpris',
"form.people.manager" => 'chef',
"form.people.comanager" => 'vicechef',
"form.people.empl" => 'användare',
"form.people.name" => 'namn',
"form.people.login" => 'logga in',

"form.people.rate" => 'standard timpris',
"form.people.comanager" => 'vice-chef',
"form.people.projects" => 'projekt',

// projects form attributes
"form.project.proj_title" => 'projekt',
"form.project.edit_str" => 'ändra projekt',
"form.project.add_str" => 'lägg till nytt projekt',
"form.project.del_str" => 'ta bort projekt',
"form.project.th.name" => 'namn',
"form.project.th.edit" => 'redigera',
"form.project.th.del" => 'ta bort',
"form.project.name" => 'namn',

// activities form attributes
"form.activity.act_title" => 'aktiviteter',
"form.activity.add_title" => 'lägg till aktivitet',
"form.activity.edit_str" => 'ändra aktivitet',
"form.activity.del_str" => 'ta bort aktivitet',
"form.activity.name" => 'namn',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'namn',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'redigera',
"form.activity.th.del" => 'ta bort',

// report attributes
"form.report.title" => 'rapporter',
"form.report.from" => 'startdatum',
"form.report.to" => 'slutdatum',
"form.report.groupby_user" => 'användare',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varktighet',
"form.report.start" => 'start',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'visa passivitet',
"form.report.finish" => 'avsluta',
"form.report.note" => 'beskrivning',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'endast totala',
"form.report.total" => 'totala timmar',
"form.report.th.empllist" => 'användare',
"form.report.th.date" => 'datum',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'slut',
"form.report.th.duration" => 'varaktiget',
"form.report.th.note" => 'beskrivning',

// mail form attributes
"form.mail.from" => 'från',
"form.mail.to" => 'till',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'ämne',
"form.mail.comment" => 'kommentarer',
"form.mail.above" => 'skicka rapporten med e-post',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>meddelandet skickat</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'ytterligare information för fakturan',
"form.invoice.select_cust" => 'välj kund',
"form.invoice.fillform" => 'fyll i fälten',
"form.invoice.date" => 'datum',
"form.invoice.number" => 'fakturanummer',
"form.invoice.tax" => 'moms',
"form.invoice.daily_subtotals" => 'daglig subtotal',
"form.invoice.yourcoo" => 'ditt namn<br> och adress',
"form.invoice.custcoo" => 'kundens namn<br> och adress',
"form.invoice.comment" => 'kommentarer ',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timmar',
"form.invoice.th.rate" => 'timpris',
"form.invoice.th.summ" => 'antal',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'kund',
"form.invoice.mailinv_above" => 'skicka fakturan med e-post',
"form.invoice.sending_str" => '<b>fakturan skickades</b>',

"form.migration.zip" => 'komprimering',
"form.migration.file" => 'välj fil',
"form.migration.import.title" => 'importera information',
"form.migration.import.success" => 'importen lyckades',
"form.migration.import.text" => 'importera team information från en xml fil',
"form.migration.export.title" => 'exportera information',
"form.migration.export.success" => 'exporten lyckades',
"form.migration.export.text" => 'du kan exportera all team data i en xmlfil. detta kan vara användbar om du migrerar till en egen server.',
// Note to translators: the string below is missing and must be added and translated
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kunder',
"form.client.add_title" => 'lägg till kund',
"form.client.edit_title" => 'ändra kund',
"form.client.del_title" => 'ta bort kund',
"form.client.th.name" => 'namn',
"form.client.th.edit" => 'redigera',
"form.client.th.del" => 'ta bort',
"form.client.name" => 'namn',
"form.client.tax" => 'moms',
"form.client.daily_subtotals" => 'daglig subtotal',
"form.client.yourcoo" => 'ditt namn<br> och adress på fakturan',
"form.client.custcoo" => 'adress',
"form.client.comment" => 'kommentarer ',

// miscellaneous strings
"forward.forgot_password" => 'glömt lösenord?',
"forward.edit" => 'redigera',
"forward.delete" => 'ta bort',
"forward.tocsvfile" => 'exportera data till .csv fil',
"forward.toxmlfile" => 'exportera data till .xml fil',
"forward.geninvoice" => 'skapa faktura',
"forward.change" => 'justera kunder',

// strings inside contols on forms
"controls.select.project" => '--- välj projekt ---',
"controls.select.activity" => '--- välj aktivitet ---',
"controls.select.client" => '--- välj kund ---',
"controls.project_bind" => '--- alla ---',
"controls.all" => '--- alla ---',
"controls.notbind" => '--- nej ---',
"controls.per_tm" => 'denna månad',
"controls.per_lm" => 'förra månad',
"controls.per_tw" => 'denna vecka',
"controls.per_lw" => 'förra vecka',
"controls.per_td" => 'denna dag',
"controls.per_at" => 'hela perioden',
// Note to translators: the string below is missing and must be translated and added
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- välj tidsperiod ---',
"controls.sel_groupby" => '--- ingen gruppering ---',
"controls.inc_billable" => 'debiterbar',
"controls.inc_nbillable" => 'icke debiterbar',
// Note to translators: the string below is missing and must be translated and added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'användarens aktiviteter',
// Note to translators: the string below is missing and must be translated and added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'graf för perioden',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>genom %s</b>',
"label.pminfo" => ' (chef)',
"label.pcminfo" => ' (vice-chef)',
"label.painfo" => ' (administratör)',
"label.time_noentry" => 'tomt',
"label.today" => 'idag',
"label.req_fields" => '* obligatoriska fält',
"label.sel_project" => 'välj projekt',
"label.sel_activity" => 'välj aktivitet',
"label.sel_tp" => 'välj tidsperiod',
"label.set_tp" => 'eller ange datum',
"label.fields" => 'visa fält',
"label.group_title" => 'grupperad som',
"label.include_title" => 'inkludera information',
"label.inv_str" => 'faktura',
"label.set_empl" => 'välj användare',
"label.sel_all" => 'markera alla',
"label.sel_none" => 'avmarkera alla',
"label.or" => 'eller',
"label.disable" => 'deaktiverad',
"label.enable" => 'aktiverad',
"label.filter" => 'filter',
"label.timeweek" => 'veckovis total',
// Note to translators: the strings below are missing and must be added and translated
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
?>