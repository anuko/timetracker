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
$i18n_months = array('Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');
$i18n_weekdays = array('Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato');
$i18n_weekdays_short = array('Do', 'Lu', 'Ma', 'Me', 'Gi', 'Ve', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '04/12', '04/13', '04/25', '05/01', '06/02', '08/15', '11/01', '12/08', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Login',
'menu.logout' => 'Logout',
'menu.forum' => 'Forum',
'menu.help' => 'Aiuto',
'menu.create_team' => 'Crea gruppo',
'menu.profile' => 'Profilo',
'menu.time' => 'Tempo',
'menu.expenses' => 'Spese',
'menu.reports' => 'Rapporti',
'menu.charts' => 'Grafici',
'menu.projects' => 'Progetti',
'menu.tasks' => 'Compiti',
'menu.users' => 'Utenti',
'menu.teams' => 'Gruppi',
'menu.export' => 'Esportazione', // TODO: is this correct? Also, I auto-translated some other terms in menu section. Check for accuracy.
'menu.clients' => 'Clienti',
'menu.options' => 'Opzioni',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Puoi collaborare al progetto Time Tracker in diversi modi.',
'footer.credits' => 'Credits',
'footer.license' => 'Licenza',
'footer.improve' => 'Collabora',

// Error messages.
'error.access_denied' => 'Accesso negato.',
'error.sys' => 'Errore di sistema.',
'error.db' => 'Errore database.',
'error.field' => 'Dato "{0}" errato.',
'error.empty' => 'Il campo "{0}" è vuoto.',
'error.not_equal' => 'Il campo "{0}" non è uguale al campo "{1}".',
'error.interval' => 'Il campo "{0}" deve essere maggiore di "{1}".',
'error.project' => 'Seleziona il progetto.',
'error.task' => 'Seleziona compito.', // TODO: is this correct?
'error.client' => 'Seleziona il cliente.',
'error.report' => 'Seleziona rapporto.',
'error.record' => 'Seleziona record.',
'error.auth' => 'Login o password errati.',
'error.user_exists' => 'Esiste già un utente con questo username.',
'error.project_exists' => 'Esiste già un progetto con questo nome.',
'error.task_exists' => 'Esiste già un compito con questo nome.', // TODO: is this correct? "un compito"?
'error.client_exists' => 'Esiste già un cliente con questo nome.',
'error.invoice_exists' => 'Esiste già una fattura con questo numero.',
'error.no_invoiceable_items' => 'Non ci sono voci fatturabili.',
'error.no_login' => 'Non esiste un utente con questo username.',
'error.no_teams' => 'Il database è vuoto. Loggati come amministratore e crea un nuovo gruppo.',
'error.upload' => 'Errore di caricamento file.',
'error.range_locked' => 'Intervallo data bloccato.',
'error.mail_send' => 'Errore nella fase di invio mail.',
'error.no_email' => 'Non ci sono email associate a questo username.',
'error.uncompleted_exists' => 'Esiste una voce incompleta. Chiudila o cancellala.',
'error.goto_uncompleted' => 'Vai alle voce incompleta.',
'error.overlap' => 'Intervallo temporale sovrapposto a voci esistenti.',
'error.future_date' => 'La data è nel futuro.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Adesso',
'button.save' => 'Salva',
'button.copy' => 'Copia',
'button.cancel' => 'Cancella',
'button.submit' => 'Invia',
'button.add_user' => 'Aggiungi utente',
'button.add_project' => 'Aggiungi progetto',
'button.add_task' => 'Aggiungi compito',
'button.add_client' => 'Aggiungi cliente',
'button.add_invoice' => 'Aggiungi fattura',
'button.add_option' => 'Aggiungi opzione',
'button.add' => 'Aggiungi',
'button.generate' => 'Genera',
'button.reset_password' => 'Reset password',
'button.send' => 'Invia',
'button.send_by_email' => 'Invia tramite e-mail',
'button.create_team' => 'Crea team',
'button.export' => 'Esporta gruppo',
'button.import' => 'Importa gruppo',
'button.close' => 'Chiudi',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Nome del gruppo',
'label.address' => 'Indirizzo',
'label.currency' => 'Moneta',
'label.manager_name' => 'Nome manager',
'label.manager_login' => 'Username manager',
'label.person_name' => 'Nome',
'label.thing_name' => 'Nome',
'label.login' => 'Login',
'label.password' => 'Password',
'label.confirm_password' => 'Conferma password',
'label.email' => 'E-mail',
'label.cc' => 'Cc',
'label.bcc' => 'Ccn',
'label.subject' => 'Oggetto',
'label.date' => 'Data',
'label.start_date' => 'Data inizio',
'label.end_date' => 'Data fine',
'label.user' => 'Utente',
'label.users' => 'Utenti',
'label.client' => 'Cliente',
'label.clients' => 'Clienti',
'label.option' => 'Opzion',
'label.invoice' => 'Fattura',
'label.project' => 'Progetto',
'label.projects' => 'Progetti',
'label.task' => 'Compito',
'label.tasks' => 'Compiti',
'label.description' => 'Descrizione',
'label.start' => 'Inizio',
'label.finish' => 'Fine',
'label.duration' => 'Durata',
'label.note' => 'Nota',
'label.notes' => 'Note',
'label.item' => 'Voce',
'label.cost' => 'Costo',
'label.day_total' => 'Totale giornaliero',
'label.week_total' => 'Totale settimanale',
'label.month_total' => 'Totale mensile',
'label.today' => 'Oggi',
'label.view' => 'Visualizza',
'label.edit' => 'Modifica',
'label.delete' => 'Elimina',
'label.configure' => 'Configura',
'label.select_all' => 'Seleziona tutti',
'label.select_none' => 'Deseleziona tutti',
'label.day_view' => 'Vista giornaliera',
'label.week_view' => 'Vista settimanale',
'label.id' => 'ID',
'label.language' => 'Lingua',
'label.decimal_mark' => 'Separatore decimale',
'label.date_format' => 'Formato data',
'label.time_format' => 'Formato ora',
'label.week_start' => 'Primo giorno della settimana',
'label.comment' => 'Commento',
'label.status' => 'Stato',
'label.tax' => 'Imposta',
'label.subtotal' => 'Subtotale',
'label.total' => 'Totale',
'label.client_name' => 'Nome cliente',
'label.client_address' => 'Indirizzo cliente',
'label.or' => 'o',
'label.error' => 'Errore',
'label.ldap_hint' => 'Digita il tuo <b>Login Windows</b> e la tua <b>password</b> nei campi qui sotto.', // TODO: il tuo and then la tua? Improve?
'label.required_fields' => '* campi obbligatori',
'label.on_behalf' => 'a favore di',
'label.role_manager' => '(manager)',
'label.role_comanager' => '(co-manager)',
'label.role_admin' => '(amministratore)',
'label.page' => 'Pagina',
'label.condition' => 'Condizione',
'label.yes' => 'si',
'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Campi personalizzati',
'label.monthly_quotas' => 'Quote mensili',
'label.type' => 'Tipo',
'label.type_dropdown' => 'scelta multipla', // TODO: translation looks incorrect, a dropdown control is a single choice.
'label.type_text' => 'testo',
'label.required' => 'Obbligatorio',
'label.fav_report' => 'Rapporto preferito',
// 'label.cron_schedule' => 'Cron schedule', // TODO: how about "Programma cron" here?
'label.what_is_it' => 'Cosa è?',
'label.expense' => 'Spesa',
'label.quantity' => 'Quantità',
'label.paid_status' => 'Stato pagamento',
'label.paid' => 'Pagato',
'label.mark_paid' => 'Segna come pagato',
'label.week_note' => 'Nota settimanale',
'label.week_list' => 'Lista settimanale',

// Form titles.
// TODO: Improve titles for consistency, so that each title explains correctly what each
// page is about and is "consistent" from page to page, meaning that correct grammar is used everywhere.
// Compare with English file to see how it is done there and do Italian titles similarly.
'title.login' => 'Login',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
'title.delete_team' => 'Elimina team',
// TODO: translate the following.
// 'title.reset_password' => 'Resetting Password',
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
// 'title.edit_time_record' => 'Editing Time Record',
// 'title.delete_time_record' => 'Deleting Time Record',
'title.expenses' => 'Spese',
// TODO: translate the following.
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
// 'title.reports' => 'Reports',
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Fattura',
'title.send_invoice' => 'Invia fattura',
'title.charts' => 'Grafici',
'title.projects' => 'Progetti',
'title.add_project' => 'Aggiungi progetto',
'title.edit_project' => 'Modifica progetto',
'title.delete_project' => 'Elimina progetto',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Utenti',
'title.add_user' => 'Crea utente',
'title.edit_user' => 'Modifica utente',
'title.delete_user' => 'Elimina utente',
'title.clients' => 'Clienti',
'title.add_client' => 'Aggiungi cliente',
'title.edit_client' => 'Modifica cliente',
'title.delete_client' => 'Elimina cliente',
'title.invoices' => 'Fatture',
// TODO: translate the following.
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Esporta i dati del team',
'title.import' => 'Importa i dati del team',
'title.options' => 'Opzioni',
'title.profile' => 'Profilo',
// TODO: translate the following.
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

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- tutti ---',
'dropdown.no' => '--- no ---',
'dropdown.current_day' => 'oggi',
'dropdown.previous_day' => 'ieri',
'dropdown.selected_day' => 'giorno',
'dropdown.current_week' => 'questa settimana',
'dropdown.previous_week' => 'settimana scorsa',
'dropdown.selected_week' => 'settimana',
'dropdown.current_month' => 'questo mese',
'dropdown.previous_month' => 'mese scorso',
'dropdown.selected_month' => 'mese',
'dropdown.current_year' => 'quest\\\'anno',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'anno',
'dropdown.all_time' => 'tutto il tempo',
'dropdown.projects' => 'progetti',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'clienti',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
'dropdown.select_invoice' => '--- seleziona la fattura ---',
'dropdown.status_active' => 'attivo',
'dropdown.status_inactive' => 'inattivo',
// TODO: translate the following.
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Password dimenticata?',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: improve form.reset_password.message by specifying that it was sent "by email".
// English form: 'form.reset_password.message' => 'Password reset request sent by email.',
'form.reset_password.message' => 'Richiesta di reset pasword inviata.',
// TODO: translate the following.
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Fatturabile',
// TODO: translate the following.
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Questo record è stato salvato con la sola ora di inzio attività. Non è un errore.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
// TODO: translate the following.
'form.reports.save_as_favorite' => 'Salva nei preferiti',
'form.reports.confirm_delete' => 'Sei sicuro di voler cancellare questo report dai preferiti?',
'form.reports.include_billable' => 'fatturabile',
'form.reports.include_not_billable' => 'non fatturabile',
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Seleziona il periodo di tempo',
'form.reports.set_period' => 'oppure setta le date',
'form.reports.show_fields' => 'Mostra i campi',
'form.reports.group_by' => 'Raggruppa per',
'form.reports.group_by_no' => '--- non raggruppare ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'utente',
'form.reports.group_by_client' => 'cliente',
'form.reports.group_by_project' => 'progetto',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Solo i totali',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Esporta',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Numero fattura',
'form.invoice.person' => 'Persona',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// TODO: translate the following.
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: translate the following.
// 'form.charts.interval' => 'Interval',
'form.charts.chart' => 'Grafico',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: translate the following.
//'form.projects.active_projects' => 'Active Projects',
// 'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
// TODO: translate the following.
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
// 'form.users.role' => 'Role',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Costo',
'form.users.default_rate' => 'Costo per ora di default',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
// TODO: translate the following.
'form.export.hint' => 'Puoi esporate tutti i dati dei team in un file xml. Questo può essere utile se devi trasferire i dati da un server ad un altro.',
'form.export.compression' => 'Compressione',
// TODO: translate the following.
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Importa i dati del team da un file xml.',
'form.import.file' => 'Seleziona il file',
'form.import.success' => 'Importazione eseguita con successo.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: translate the following.
// 'form.teams.hint' =>  'Create a new team by creating a new team manager account.<br>You can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
// TODO: translate the following.
// 'form.profile.12_hours' => '12 hours',
// 'form.profile.24_hours' => '24 hours',
// 'form.profile.tracking_mode' => 'Tracking mode',
// 'form.profile.mode_time' => 'time',
// 'form.profile.mode_projects' => 'projects',
// 'form.profile.mode_projects_and_tasks' => 'projects and tasks',
// 'form.profile.record_type' => 'Record type',
// 'form.profile.type_all' => 'all',
// 'form.profile.type_start_finish' => 'start and finish',
// 'form.profile.type_duration' => 'duration',
// 'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.profile.uncompleted_indicators_none' => 'do not show',
// 'form.profile.uncompleted_indicators_show' => 'show',
// 'form.profile.plugins' => 'Plugins',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
// TODO: translate the following.
'form.mail.from' => 'Da',
'form.mail.to' => 'A',
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Fattura inviata.',

// Quotas configuration form.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',
);
