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

$i18n_language = 'Italian (Italiano)';
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
'menu.create_group' => 'Crea gruppo',
'menu.profile' => 'Profilo',
'menu.group' => 'Gruppo',
'menu.time' => 'Tempo',
'menu.expenses' => 'Spese',
'menu.reports' => 'Rapporti',
'menu.charts' => 'Grafici',
'menu.projects' => 'Progetti',
'menu.tasks' => 'Compiti',
'menu.users' => 'Utenti',
'menu.groups' => 'Gruppi',
'menu.export' => 'Esportazione',
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
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Dato "{0}" errato.',
'error.empty' => 'Il campo "{0}" è vuoto.',
'error.not_equal' => 'Il campo "{0}" non è uguale al campo "{1}".',
'error.interval' => 'Il campo "{0}" deve essere maggiore di "{1}".',
'error.project' => 'Seleziona il progetto.',
'error.task' => 'Seleziona compito.',
'error.client' => 'Seleziona il cliente.',
'error.report' => 'Seleziona rapporto.',
'error.record' => 'Seleziona record.',
'error.auth' => 'Login o password errati.',
'error.user_exists' => 'Esiste già un utente con questo username.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Esiste già un progetto con questo nome.',
'error.task_exists' => 'Esiste già un compito con questo nome.',
'error.client_exists' => 'Esiste già un cliente con questo nome.',
'error.invoice_exists' => 'Esiste già una fattura con questo numero.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Non ci sono voci fatturabili.',
'error.no_login' => 'Non esiste un utente con questo username.',
'error.no_groups' => 'Il database è vuoto. Loggati come amministratore e crea un nuovo gruppo.',
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
'button.add' => 'Aggiungi',
'button.delete' => 'Elimina',
'button.generate' => 'Genera',
'button.reset_password' => 'Reset password',
'button.send' => 'Invia',
'button.send_by_email' => 'Invia tramite e-mail',
'button.create_group' => 'Crea gruppo',
'button.export' => 'Esporta gruppo',
'button.import' => 'Importa gruppo',
'button.close' => 'Chiudi',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Nome del gruppo',
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
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
// TODO: translate the following.
// 'label.ip' => 'IP',
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
'label.ldap_hint' => 'Digita il tuo <b>Login Windows</b> e la tua <b>password</b> nei campi qui sotto.',
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
'label.type_dropdown' => 'menu a tendina',
'label.type_text' => 'testo',
'label.required' => 'Obbligatorio',
'label.fav_report' => 'Rapporto preferito',
'label.schedule' => 'Programma',
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
// Specifically: Eliminazione vs Elimina - we probably want nouns in titles.
'title.login' => 'Login',
'title.groups' => 'Gruppi',
'title.create_group' => 'Creazione gruppo',
'title.edit_group' => 'Modifica gruppo',
'title.delete_group' => 'Elimina gruppo',
'title.reset_password' => 'Reset password',
'title.change_password' => 'Cambio password',
'title.time' => 'Tempo',
'title.edit_time_record' => 'Modifica record temporale',
'title.delete_time_record' => 'Eliminazione record temporale',
'title.expenses' => 'Spese',
'title.edit_expense' => 'Modifica voce di spesa',
'title.delete_expense' => 'Eliminezione voce di spesa',
'title.predefined_expenses' => 'Spese predefinite',
'title.add_predefined_expense' => 'Aggiunta spese predefinite',
'title.edit_predefined_expense' => 'Modifica spese predefinite',
'title.delete_predefined_expense' => 'Eliminazione spese predefinite',
'title.reports' => 'Rapporti',
'title.report' => 'Rapporto',
'title.send_report' => 'Invio Rapporto',
'title.invoice' => 'Fattura',
'title.send_invoice' => 'Invia fattura',
'title.charts' => 'Grafici',
'title.projects' => 'Progetti',
'title.add_project' => 'Aggiungi progetto',
'title.edit_project' => 'Modifica progetto',
'title.delete_project' => 'Elimina progetto',
'title.tasks' => 'Compiti',
'title.add_task' => 'Aggiungi compito',
'title.edit_task' => 'Modifica compito',
'title.delete_task' => 'Eliminazione compito',
'title.users' => 'Utenti',
'title.add_user' => 'Crea utente',
'title.edit_user' => 'Modifica utente',
'title.delete_user' => 'Elimina utente',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Clienti',
'title.add_client' => 'Aggiungi cliente',
'title.edit_client' => 'Modifica cliente',
'title.delete_client' => 'Elimina cliente',
'title.invoices' => 'Fatture',
'title.add_invoice' => 'Aggiunta fattura',
'title.view_invoice' => 'Visualizzazione fattura',
'title.delete_invoice' => 'Eliminazione fattura',
'title.notifications' => 'Notifiche',
'title.add_notification' => 'Aggiunta notifica',
'title.edit_notification' => 'Modifica notifica',
'title.delete_notification' => 'Eliminazione notifica',
'title.monthly_quotas' => 'Quote mensili',
'title.export' => 'Esporta i dati del gruppo',
'title.import' => 'Importa i dati del gruppo',
'title.options' => 'Opzioni',
'title.profile' => 'Profilo',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Campi personalizzati',
'title.cf_add_custom_field' => 'Aggiunta campo personalizzato',
'title.cf_edit_custom_field' => 'Modifica campo personalizzato',
'title.cf_delete_custom_field' => 'Eliminazione campo personalizzato',
'title.cf_dropdown_options' => 'Opzioni menu di scelta',
'title.cf_add_dropdown_option' => 'Aggiunta opzione',
'title.cf_edit_dropdown_option' => 'Modifica opzione',
'title.cf_delete_dropdown_option' => 'Eliminazione opzione',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
'title.locking' => 'Bloccaggio',
'title.week_view' => 'Vista settimanale',
// 'title.swap_roles' => 'Swapping Roles',

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
'dropdown.previous_year' => 'anno precedente',
'dropdown.selected_year' => 'anno',
'dropdown.all_time' => 'tutto il tempo',
'dropdown.projects' => 'progetti',
'dropdown.tasks' => 'compiti',
'dropdown.clients' => 'clienti',
'dropdown.select' => '--- seleziona ---',
'dropdown.select_invoice' => '--- seleziona la fattura ---',
'dropdown.status_active' => 'attivo',
'dropdown.status_inactive' => 'inattivo',
'dropdown.delete' => 'elimina',
'dropdown.do_not_delete' => 'non eliminare',
'dropdown.paid' => 'pagato',
'dropdown.not_paid' => 'non pagato',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Password dimenticata?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> è un sistema semplice e open source per registrare i tempi di lavoro.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Richiesta di reset password inviata via mail.',
'form.reset_password.email_subject' => 'Richiesta reset password per Anuko Time Tracker',
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Caro utente,\n\n qualcuno, IP %s, ha richiesto di reimpostare la tua password per Anuko Time Tracker. Per favore visita questo link per reimpostare la tua password.\n\n%s\n\nAnuko Time Tracker è un sistema semplice e open source per registrare i tempi di lavoro. Visita https://www.anuko.com per maggiori informazioni.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Digita una nuova password e clicca su Salva.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(oo:mm o 0.0h)',
'form.time.billable' => 'Fatturabile',
'form.time.uncompleted' => 'Incompleti',
'form.time.remaining_quota' => 'Quota rimanente',
'form.time.over_quota' => 'Sopra quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Questo record è stato salvato con la sola ora di inzio attività. Non è un errore.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Nuova voce',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Salva nei preferiti',
'form.reports.confirm_delete' => 'Sei sicuro di voler cancellare questo report dai preferiti?',
'form.reports.include_billable' => 'fatturabile',
'form.reports.include_not_billable' => 'non fatturabile',
'form.reports.include_invoiced' => 'fatturato',
'form.reports.include_not_invoiced' => 'non fatturato',
'form.reports.select_period' => 'Seleziona il periodo di tempo',
'form.reports.set_period' => 'oppure setta le date',
'form.reports.show_fields' => 'Mostra i campi',
'form.reports.group_by' => 'Raggruppa per',
'form.reports.group_by_no' => '--- non raggruppare ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'utente',
'form.reports.group_by_client' => 'cliente',
'form.reports.group_by_project' => 'progetto',
'form.reports.group_by_task' => 'compito',
'form.reports.totals_only' => 'Solo i totali',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Esporta',
'form.report.assign_to_invoice' => 'Assegna alla fattura',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Numero fattura',
'form.invoice.person' => 'Persona',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Fattura da eliminare',
'form.invoice.invoice_entries' => 'Voci fattura',
'form.invoice.confirm_deleting_entries' => 'Per favore conferma di voler eliminare le voci fattura da Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Intervallo',
'form.charts.chart' => 'Grafico',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Progetti attivi',
'form.projects.inactive_projects' => 'Progetti inattivi',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Compiti attivi',
'form.tasks.inactive_tasks' => 'Compiti inattivi',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Utenti attivi',
'form.users.inactive_users' => 'Utenti inattivi',
'form.users.uncompleted_entry' => 'Questo utente ha un record temporale incompleto',
'form.users.role' => 'Ruolo',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Costo',
'form.users.default_rate' => 'Costo per ora di default',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
// TODO: translate the following.
// 'form.user_edit.swap_roles' => 'Swap roles',

// Roles form. See example at https://timetracker.anuko.com/roles.php
// TODO: translate the following.
// 'form.roles.active_roles' => 'Active Roles',
// 'form.roles.inactive_roles' => 'Inactive Roles',
// 'form.roles.rank' => 'Rank',
// 'form.roles.rights' => 'Rights',
// 'form.roles.assigned' => 'Assigned',
// 'form.roles.not_assigned' => 'Not assigned',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Clienti attivi',
'form.clients.inactive_clients' => 'Clienti inattivi',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Client da eliminare',
'form.client.client_entries' => 'Voci client',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Puoi esporate tutti i dati dei gruppo in un file xml. Questo può essere utile se devi trasferire i dati da un server ad un altro.',
'form.export.compression' => 'Compressione',
'form.export.compression_none' => 'niente',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Importa i dati del gruppo da un file xml.',
'form.import.file' => 'Seleziona il file',
'form.import.success' => 'Importazione eseguita con successo.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
'form.groups.hint' => 'Crea un nuovo gruppo creando un account gruppo manager.<br>Puoi anche importare i dati di un gruppo da un file xml esportato da un altro server Anuko Time Tracker (non sono ammessi login duplicati).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 ore',
'form.group_edit.24_hours' => '24 ore',
'form.group_edit.show_holidays' => 'Mostra vacanze',
'form.group_edit.tracking_mode' => 'Modalità di registrazione',
'form.group_edit.mode_time' => 'tempo',
'form.group_edit.mode_projects' => 'progetti',
'form.group_edit.mode_projects_and_tasks' => 'progetti e compiti',
'form.group_edit.record_type' => 'Tipo di record',
'form.group_edit.type_all' => 'tutto',
'form.group_edit.type_start_finish' => 'inizio e fine',
'form.group_edit.type_duration' => 'durata',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
'form.group_edit.uncompleted_indicators' => 'Indicatori incompleti',
// TODO: translate the following.
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Plugin',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Da',
'form.mail.to' => 'A',
'form.mail.report_subject' => 'Rapporto Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker è un sistema semplice e open source <br>per registrare i tempi di lavoro. Visita <a href="https://www.anuko.com">www.anuko.com</a> per maggiori informazioni.',
'form.mail.report_sent' => 'Rapporto inviato.',
'form.mail.invoice_sent' => 'Fattura inviata.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Anno',
'form.quota.month' => 'Mese',
'form.quota.quota' => 'Quota',
'form.quota.workday_hours' => 'Ore lavorative in un giorno',
'form.quota.hint' => 'Se i valori sono vuoti, le quote vengono calcolate automaticamente basandosi su ore giornaliere e vacanze.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own reports, charts, and invoices.',
// 'role.supervisor.label' => 'Supervisor',
// 'role.supervisor.low_case_label' => 'supervisor',
// 'role.supervisor.description' => 'A person with a small set of management rights.',
// 'role.comanager.label' => 'Co-manager',
// 'role.comanager.low_case_label' => 'co-manager',
// 'role.comanager.description' => 'A person with a big set of management functions.',
// 'role.manager.label' => 'Manager',
// 'role.manager.low_case_label' => 'manager',
// 'role.manager.description' => 'Group manager. Can do most of things for a group.',
// 'role.top_manager.label' => 'Top manager',
// 'role.top_manager.low_case_label' => 'top manager',
// 'role.top_manager.description' => 'Top group manager. Can do everything in a tree of groups.',
// 'role.admin.label' => 'Administrator',
// 'role.admin.low_case_label' => 'administrator',
// 'role.admin.description' => 'Site adminsitrator.',
);
