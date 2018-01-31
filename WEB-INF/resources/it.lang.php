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

// Note to translators: Use proper capitalization rules for your language.

$i18n_language = 'Italiano';
$i18n_months = array('Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luiglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');
$i18n_weekdays = array('Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato');
$i18n_weekdays_short = array('Do', 'Lu', 'Ma', 'Me', 'Gi', 'Ve', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '04/12', '04/13', '04/25', '05/01', '06/02', '08/15', '11/01', '12/08', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
// TODO: translate the following.
// 'menu.login' => 'Login',
// 'menu.logout' => 'Logout',
// 'menu.forum' => 'Forum',
// 'menu.help' => 'Help',
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profilo',
'menu.time' => 'Tempo',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
// 'menu.reports' => 'Reports',
// 'menu.charts' => 'Charts',
'menu.projects' => 'Progetti',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
// 'menu.teams' => 'Teams',
// 'menu.export' => 'Export',
'menu.clients' => 'Clienti',
'menu.options' => 'Opzioni',

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
// 'error.db' => 'Database error.',
'error.field' => 'Dato "{0}" errato.',
'error.empty' => 'Il campo "{0}" è vuoto.',
'error.not_equal' => 'Il campo "{0}" non è uguale al campo "{1}".',
// TODO: translate the following.
// error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Seleziona il progetto.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Login o password errati.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Esiste già un progetto con questo nome.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
// 'error.upload' => 'File upload error.',
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Adesso',
'button.save' => 'Salva',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Cancella',
'button.submit' => 'Invia',
'button.add_user' => 'Aggiungi utente',
'button.add_project' => 'Aggiungi progetto',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Aggiungi cliente',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
// 'button.add' => 'Add',
'button.generate' => 'Genera',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Invia',
'button.send_by_email' => 'Invia tramite e-mail',
'button.create_team' => 'Crea team',
'button.export' => 'Esporta team',
'button.import' => 'Importa team',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Moneta',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Nome',
'label.thing_name' => 'Nome',
'label.login' => 'Login',
'label.password' => 'Password',
'label.confirm_password' => 'Conferma password',
'label.email' => 'E-mail',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Oggetto',
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
'label.edit' => 'Modifica',
'label.delete' => 'Elimina',
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
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Totale',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
// 'label.role_manager' => '(manager)',
// 'label.role_comanager' => '(co-manager)',
// 'label.role_admin' => '(administrator)',
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

// Form titles.
'title.login' => 'Login',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
// 'title.reset_password' => 'Resetting Password',
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



// TODO: refactoring ongoing down from here.

"form.filter.project" => 'progetto',
"form.filter.filter" => 'report preferiti',
"form.filter.filter_new" => 'salva nei preferiti',
"form.filter.filter_confirm_delete" => 'sei sicuro di voler cancellare questo report dai preferiti?',

// password reminder form attributes
"form.fpass.send_pass_str" => 'richiesta di reset pasword inviata',
"form.fpass.send_pass_subj" => 'richiesta di password reset', 
// Note to translators: the strings below must be translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'amministratore',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new team by creating a new team manager account.<br>you can also import team data from an xml file from another Anuko Time Tracker server (no e-mail collisions are allowed).',

"form.admin.change_pass" => 'cambia la password dell\\\'amministratore',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'il database è vuoto. loggati come amministratore e crea un nuovo team.',
"form.admin.profile.comment" => 'elimina team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'attivo',
"form.admin.options" => 'opzioni',

// my time form attributes
"form.mytime.title" => 'giorno',
"form.mytime.edit_title" => 'modifica time record',
"form.mytime.del_str" => 'elimina time record',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'data',
"form.mytime.project" => 'progetto',
"form.mytime.activity" => 'attività',
"form.mytime.start" => 'inizio',
"form.mytime.finish" => 'fine',
"form.mytime.duration" => 'durata',
"form.mytime.note" => 'note',
"form.mytime.behalf" => 'attività giornaliera per',
"form.mytime.daily" => 'attività giornaliera',
"form.mytime.total" => 'ore totali: ',
"form.mytime.th.project" => 'progetto',
"form.mytime.th.activity" => 'attività',
"form.mytime.th.start" => 'inizio',
"form.mytime.th.finish" => 'fine',
"form.mytime.th.duration" => 'durata',
"form.mytime.th.note" => 'note',
"form.mytime.del_yes" => 'time record cancellato',
"form.mytime.no_finished_rec" => 'questo record è stato salvato con la sola ora di inzio attività. non è un errore. esegui il logout per altro....',
"form.mytime.billable" => 'fatturabile',
"form.mytime.warn_tozero_rec" => 'questo time record deve essere cancellato perchè il periodo di riferimento è stato bloccato',
// Note to translators: the string below is missing and must be added and translated
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.edit_title" => 'modifca il profilo',

// people form attributes
"form.people.ppl_str" => 'persone',
"form.people.createu_str" => 'crea un nuovo utente',
"form.people.edit_str" => 'modifica utente',
"form.people.del_str" => 'elimina utente',
"form.people.th.role" => 'funzione',
"form.people.th.status" => 'stato',
"form.people.th.project" => 'progetto',
"form.people.th.rate" => 'costo',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'utente',
"form.people.rate" => 'costo per ora di default',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'progetti',

// projects form attributes
"form.project.proj_title" => 'progetti',
"form.project.edit_str" => 'mofifca progetto',
"form.project.add_str" => 'aggiungi nuovo progetto',
"form.project.del_str" => 'elimina progetto',

// activities form attributes
"form.activity.project" => 'progetto',

// report attributes
"form.report.title" => 'report',
"form.report.from" => 'data inizio',
"form.report.to" => 'data fine',
"form.report.groupby_user" => 'utente',
"form.report.groupby_project" => 'progetto',
"form.report.groupby_activity" => 'attività',
"form.report.duration" => 'durata',
"form.report.start" => 'inizio',
"form.report.activity" => 'attività',
"form.report.show_idle" => 'mostra inattivi',
"form.report.finish" => 'fine',
"form.report.note" => 'nota',
"form.report.project" => 'progetto',
"form.report.totals_only" => 'solo i totali',
"form.report.total" => 'ore totali',
"form.report.th.empllist" => 'utente',
"form.report.th.date" => 'data',
"form.report.th.project" => 'progetto',
"form.report.th.activity" => 'attività',
"form.report.th.start" => 'inizio',
"form.report.th.finish" => 'fine',
"form.report.th.duration" => 'durata',
"form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'da',
"form.mail.to" => 'a',
"form.mail.comment" => 'commento',
"form.mail.above" => 'invia questo report tramite e-mail',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>messaggio inviato</b>',

// invoice attributes
"form.invoice.title" => 'fattura',
"form.invoice.caption" => 'fattura',
"form.invoice.above" => 'informazioni aggiuntive per la fattura',
"form.invoice.select_cust" => 'seleziona il cliente',
"form.invoice.fillform" => 'compila i campi',
"form.invoice.date" => 'data',
"form.invoice.number" => 'numero fattura',
"form.invoice.tax" => 'tassa',
"form.invoice.comment" => 'commento ',
"form.invoice.th.username" => 'persona',
"form.invoice.th.time" => 'ore',
"form.invoice.th.rate" => 'costo',
"form.invoice.th.summ" => 'ammontare',
"form.invoice.subtotal" => 'subtotale',
"form.invoice.customer" => 'cliente',
"form.invoice.mailinv_above" => 'invia la fattura tramite e-mail',
"form.invoice.sending_str" => '<b>fattura inviata</b>',

"form.migration.zip" => 'compressione',
"form.migration.file" => 'seleziona il file',
"form.migration.import.title" => 'importa i dati',
"form.migration.import.success" => 'importazione eseguita con successo',
"form.migration.import.text" => 'importa i dati del team da un file xml',
"form.migration.export.title" => 'esporta i dati',
"form.migration.export.success" => 'esportazione eseguita con successo',
"form.migration.export.text" => 'puoi esporate tutti i dati dei team in un file xml. questo può essere utile se devi trasferire i dati da un server ad un altro.',

"form.client.title" => 'clienti',
"form.client.add_title" => 'aggiungi cliente',
"form.client.edit_title" => 'modifica cliente',
"form.client.del_title" => 'elimina cliente',
"form.client.tax" => 'tassa',
"form.client.comment" => 'commento ',

// miscellaneous strings
"forward.forgot_password" => 'password dimenticata?',
"forward.edit" => 'modifica',
"forward.delete" => 'elimina',
"forward.tocsvfile" => 'esporta i dati in un file .csv',
"forward.toxmlfile" => 'esporta i dati in un file .xml',
"forward.geninvoice" => 'genera la fattura',
"forward.change" => 'configura i clienti',

// strings inside contols on forms
"controls.select.project" => '--- seleziona il progetto ---',
"controls.select.activity" => '--- seleziona la attività ---',
"controls.select.client" => '--- seleziona il cliente ---',
"controls.project_bind" => '--- tutti ---',
"controls.all" => '--- tutti ---',
"controls.notbind" => '--- no ---',
"controls.per_tm" => 'questo mese',
"controls.per_lm" => 'mese scorso',
"controls.per_tw" => 'questa settimana',
"controls.per_lw" => 'settimana scorsa',
"controls.per_td" => 'questo giorno',
"controls.per_at" => 'tutto il tempo',
"controls.per_ty" => 'quest\\\'anno',
"controls.sel_period" => '--- seleziona il periodo di tempo ---',
"controls.sel_groupby" => '--- non raggruppare ---',
"controls.inc_billable" => 'fatturabile',
"controls.inc_nbillable" => 'non fatturabile',
// Note to translators: the string below must be translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'attività per utente',
// Note to translators: the string below is missing and must be added and translated
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'grafico per il periodo',

"label.pbehalf_info" => '%s %s <b>a favore di %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (amministratore)',
"label.time_noentry" => 'nessun inserimento',
"label.today" => 'oggi',
"label.req_fields" => '* campi obbligatori',
"label.sel_project" => 'seleziona il progetto',
"label.sel_activity" => 'seleziona la attività',
"label.sel_tp" => 'seleziona il periodo di tempo',
"label.set_tp" => 'oppure setta le date',
"label.fields" => 'mostra i campi',
"label.group_title" => 'raggruppa per',
"label.include_title" => 'includi records',
"label.inv_str" => 'fattura',
"label.set_empl" => 'seleziona utenti',
"label.sel_all" => 'seleziona tutti',
"label.sel_none" => 'deseleziona tutti',
"label.or" => 'o',
"label.disable" => 'disabilita',
"label.enable" => 'abilita',
"label.filter" => 'filtro',
"label.timeweek" => 'totale settimanale',
"label.hrs" => 'ore',
// Note to translators: the strings below are missing and must be added and translated
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
