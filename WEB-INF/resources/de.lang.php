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

$i18n_language = 'Deutsch';
$i18n_months = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
$i18n_weekdays = array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag');
$i18n_weekdays_short = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '04/06', '04/09', '05/01', '05/17', '05/28', '10/03', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on the top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Anmelden',
'menu.logout' => 'Abmelden',
'menu.forum' => 'Forum',
'menu.help' => 'Hilfe',
'menu.create_team' => 'Neues Team',
'menu.profile' => 'Profil',
'menu.time' => 'Zeiten',
'menu.expenses' => 'Kosten',
'menu.reports' => 'Berichte',
'menu.charts' => 'Diagramme',
'menu.projects' => 'Projekte',
'menu.tasks' => 'Aufgaben',
'menu.users' => 'Personen',
'menu.teams' => 'Teams',
'menu.export' => 'Exportieren',
'menu.clients' => 'Kunden',
'menu.options' => 'Optionen',

// Footer - strings on the bottom of most pages.
// TODO: translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'Impressum',
'footer.license' => 'Lizenz',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following string.
// 'error.access_denied' => 'Access denied.',
'error.sys' => 'Systemfehler.',
'error.db' => 'Datenbankfehler.',
'error.field' => 'Ungültige "{0}" Daten.',
'error.empty' => 'Feld "{0}" ist leer.',
'error.not_equal' => 'Feld "{0}" ist nicht gleich Feld "{1}".',
'error.interval' => 'Feld "{0}" muss größer sein als "{1}".',
'error.project' => 'Projekt wählen.',
'error.task' => 'Aufgabe auswählen.',
'error.client' => 'Kunde auswählen.',
// TODO: translate the following string.
// 'error.report' => 'Select report.',
'error.auth' => 'Benutzername oder Passwort ungültig.',
'error.user_exists' => 'Benutzer mit diesem Konto ist bereits vorhanden.',
'error.project_exists' => 'Es gibt bereits ein Projekt mit diesem Namen.',
'error.task_exists' => 'Task mit diesem Namen existiert bereits.',
'error.client_exists' => 'Der Kunde mit dem Namen existiert schon.',
'error.invoice_exists' => 'Rechnung mit dieser Nummer existiert bereits.',
'error.no_invoiceable_items' => 'Keine Einträge zur Rechnungsstellung gefunden.',
'error.no_login' => 'Benutzer mit diesen Anmeldedaten nicht vorhanden.',
'error.no_teams' => 'Die Datenbank ist leer. Als Administrator anmelden und ein neues Team erzeugen.',
'error.upload' => 'Fehler beim hochladen einer Datei.',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Fehler beim versenden einer E-Mail.',
'error.no_email' => 'Dieser Benutzer besitzt keine e-Mail Adresse.',
'error.uncompleted_exists' => 'Unvollständiger Eintrag bereits vorhanden. Schließen oder Löschen.',
'error.goto_uncompleted' => 'Zum unvollständigen Eintrag gehen.',
'error.overlap' => 'Der Zeitinterval überschneidet sich mit vorhandenen Einträgen.',
'error.future_date' => 'Datum ist in der Zukunft.',

// Labels for buttons.
'button.login' => 'Anmelden',
'button.now' => 'Jetzt',
'button.save' => 'Speichern',
'button.copy' => 'Kopieren',
'button.cancel' => 'Abbrechen',
'button.submit' => 'Abschicken',
'button.add_user' => 'Benutzerkonto hinzufügen',
'button.add_project' => 'Projekt anlegen',
'button.add_task' => 'Task hinzufügen',
'button.add_client' => 'Auftraggeber anlegen',
'button.add_invoice' => 'Rechnung hinzufügen',
'button.add_option' => 'Option hinzufügen',
'button.add' => 'Hinzufügen',
'button.generate' => 'Erstellen',
'button.reset_password' => 'Passwort zurücksetzen',
'button.send' => 'Senden',
'button.send_by_email' => 'Als E-Mail senden',
'button.create_team' => 'Team erstellen',
'button.export' => 'Team exportieren',
'button.import' => 'Team importieren',
'button.close' => 'Schließen',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Teamname',
'label.address' => 'Adresse',
'label.currency' => 'Währung',
'label.manager_name' => 'Manager Name',
'label.manager_login' => 'Manager Login',
'label.person_name' => 'Name',
'label.thing_name' => 'Name',
'label.login' => 'Anmeldung',
'label.password' => 'Passwort',
'label.confirm_password' => 'Passwort bestätigen',
'label.email' => 'E-Mail',
'label.date' => 'Datum',
'label.start_date' => 'Anfangsdatum',
'label.end_date' => 'Enddatum',
'label.user' => 'Benutzer',
'label.users' => 'Personen',
'label.client' => 'Kunde',
'label.clients' => 'Kunden',
'label.option' => 'Option',
'label.invoice' => 'Rechnung',
'label.project' => 'Projekt',
'label.projects' => 'Projekte',
'label.task' => 'Aufgabe',
'label.tasks' => 'Aufgaben',
'label.description' => 'Beschreibung',
'label.start' => 'Start',
'label.finish' => 'Ende',
'label.duration' => 'Dauer',
'label.note' => 'Beschreibung',
'label.item' => 'Position',
'label.cost' => 'Kosten',
'label.week_total' => 'Summe (Woche)',
'label.day_total' => 'Summe (Tag)',
// 'label.month_total' => 'Month total',
// 'label.month_left' => 'Time until quota is met',
// 'label.month_over' => 'Over monthly quota',
'label.today' => 'Heute',
'label.total_hours' => 'Gesamtstunden',
'label.total_cost' => 'Totale Kosten',
'label.view' => 'Ansicht',
'label.edit' => 'Editieren',
'label.delete' => 'Löschen',
'label.configure' => 'Konfigurieren',
'label.select_all' => 'Alle auswählen',
'label.select_none' => 'Alle abwählen',
'label.id' => 'ID',
'label.language' => 'Sprache',
// TODO: translate the following string.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'Datumsformat',
'label.time_format' => 'Zeitformat',
'label.week_start' => 'Erster Wochentag',
'label.comment' => 'Kommentar',
'label.status' => 'Status',
'label.tax' => 'Umsatzsteuer',
'label.subtotal' => 'Zwischensumme',
'label.total' => 'Gesamtsumme',
'label.client_name' => 'Kundenname',
'label.client_address' => 'Adresse',
'label.or' => 'oder',
'label.error' => 'Fehler',
'label.ldap_hint' => 'Geben Sie unten Ihren <b>Windows Benutzernamen</b> und Ihr <b>Passwort</b> ein.',
'label.required_fields' => '* - Pflichtfelder',
'label.on_behalf' => 'für',
'label.role_manager' => '(Manager)',
'label.role_comanager' => '(Co-Manager)',
'label.role_admin' => '(Administrator)',
// Translate the following string.
// 'label.page' => 'Page',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Benutzerfelder',
'label.type' => 'Typ',
'label.type_dropdown' => 'Ausklappen',
'label.type_text' => 'Text',
'label.required' => 'Benötigt',
'label.fav_report' => 'Bevorzugter Report',
// TODO: translate the following strings.
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.year' => 'Year',
// 'label.month' => 'Month',
// 'label.quota' => 'Quota',
// 'label.workdayHours' => 'Daily working hours',

// Form titles.
'title.login' => 'Anmelden',
'title.teams' => 'Teams',
'title.create_team' => 'Arbeitsgruppe anlegen',
'title.edit_team' => 'Team bearbeiten',
'title.delete_team' => 'Team löschen',
'title.reset_password' => 'Passworterinnerung',
'title.change_password' => 'Passwortänderung',
'title.time' =>  'Meine Zeiten',
'title.edit_time_record' => 'Bearbeiten des Stundeneintrags',
'title.delete_time_record' => 'Eintrag löschen',
'title.expenses' => 'Kosten',
'title.edit_expense' => 'Kostenposition ändern',
'title.delete_expense' => 'Kostenposition löschen',
'title.reports' => 'Berichte',
'title.report' => 'Bericht',
'title.send_report' => 'Bericht senden',
'title.invoice' => 'Rechnung',
'title.send_invoice' => 'Rechnung senden',
'title.charts' => 'Diagramme',
'title.projects' => 'Projekte',
'title.add_project' => 'Projekt anlegen',
'title.edit_project' => 'Projekt bearbeiten',
'title.delete_project' => 'Projekt löschen',
'title.tasks' => 'Aufgaben',
'title.add_task' => 'Aufgabe hinzufügen',
'title.edit_task' => 'Aufgabe bearbeiten',
'title.delete_task' => 'Aufgabe löschen',
'title.users' => 'Personen',
'title.add_user' => 'Benutzerkonto erstellen',
'title.edit_user' => 'Benutzerdaten bearbeiten',
'title.delete_user' => 'Benutzer löschen',
'title.clients' => 'Kunden',
'title.add_client' => 'Kunden hinzufügen',
'title.edit_client' => 'Kunden bearbeiten',
'title.delete_client' => 'Kunden löschen',
'title.invoices' => 'Rechnungen',
'title.add_invoice' => 'Rechnung hinzufügen',
'title.view_invoice' => 'Rechnung ansehen',
'title.delete_invoice' => 'Rechnung löschen',
// TODO: translate the following strings.
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quota' => 'Monthly quota',
'title.export' => 'Daten exportieren',
'title.import' => 'Daten importieren',
'title.options' => 'Optionen',
'title.profile' => 'Profil',
'title.cf_custom_fields' => 'Benutzerfelder',
'title.cf_add_custom_field' => 'Benutzerfeld hinzufügen',
'title.cf_edit_custom_field' => 'Benutzerfeld bearbeiten',
'title.cf_delete_custom_field' => 'Benutzerfeld löschen',
'title.cf_dropdown_options' => 'Auswahlmöglichkeiten',
'title.cf_add_dropdown_option' => 'Auswahlmöglichkeit hinzufügen',
'title.cf_edit_dropdown_option' => 'Auswahlmöglichkeit bearbeiten',
'title.cf_delete_dropdown_option' => 'Auswahlmöglichkeit löschen',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// TODO: Translate the following:
// 'title.locking' => 'Locking',


// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- alle ---',
'dropdown.no' => '--- nein ---',
'dropdown.this_day' => 'aktueller Tag',
'dropdown.this_week' => 'aktuelle Woche',
'dropdown.last_week' => 'vorherige Woche',
'dropdown.this_month' => 'aktueller Monat',
'dropdown.last_month' => 'vorheriger Monat',
'dropdown.this_year' => 'aktuelles Jahr',
'dropdown.all_time' => 'Gesamtzeitraum',
'dropdown.projects' => 'Projekte',
'dropdown.tasks' => 'Aufgaben',
'dropdown.clients' => 'Kunden',
'dropdown.select' => '--- auswählen ---',
'dropdown.select_invoice' => '--- Rechnung auswählen ---',
'dropdown.status_active' => 'aktiv',
'dropdown.status_inactive' => 'inaktiv',
// TODO: translate the following strings.
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Passwort vergessen?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> ist ein einfaches, leicht zu bedienendes, Open-Source Zeiterfassungssystem.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Anfrage zur Zurücksetzung des Passwortes wurde per E-mail gesendet.',
'form.reset_password.email_subject' => 'Anuko Time Tracker Anfrage zur Zurücksetzung des Passwortes',
'form.reset_password.email_body' => "Sehr geehrter Nutzer,\n\nJemand, vielleicht Sie, sendete die Aufforderung Ihr Anuko Time Tracker Passwort zurückzusetzen. Bitte rufen Sie diesen Link auf wenn Sie Ihr Passwort zurücksetzen möchten.\n\n%s\n\nAnuko Time Tracker ist ein einfaches, leicht zu bedienendes, Open-Source Zeiterfassungs-System. Besuchen Sie https://www.anuko.com für weitere Informationen.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Um das Passwort zurückzusetzen, geben Sie ein Neues ein und klicken dann auf Speichern.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm oder 0.0h)',
'form.time.billable' => 'In Rechnung stellen',
'form.time.uncompleted' => 'Unvollständig',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Dieser Eintrag wurde ohne Startzeit gespeichert. Dies ist kein Fehler.',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Als bevorzugt speichern',
'form.reports.confirm_delete' => 'Sind Sie sicher, dass der bevorzugte Report gelöscht werden soll?',
'form.reports.include_records' => 'Daten hinzufügen',
'form.reports.include_billable' => 'in Rechnung stellen',
'form.reports.include_not_billable' => 'nicht in Rechnung stellen',
// TODO: translate the following strings.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Zeitraum auswählen',
'form.reports.set_period' => 'oder Datum eingeben',
'form.reports.show_fields' => 'Felder anzeigen',
'form.reports.group_by' => 'Gruppieren nach',
'form.reports.group_by_no' => '--- keine Gruppierung ---',
'form.reports.group_by_date' => 'Datum',
'form.reports.group_by_user' => 'Benutzer',
'form.reports.group_by_client' => 'Kunde',
'form.reports.group_by_project' => 'Projekt',
'form.reports.group_by_task' => 'Aufgabe',
'form.reports.totals_only' => 'Nur Gesamtstunden',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportiere',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Rechnungsnummer',
'form.invoice.person' => 'Person',
// TODO: translate the following stings.
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Zeitraum',
'form.charts.chart' => 'Diagramm',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktive Projekte',
'form.projects.inactive_projects' => 'Inaktive Projekte',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktive Tasks',
'form.tasks.inactive_tasks' => 'Inaktive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktive Nutzer',
'form.users.inactive_users' => 'Inaktive Nutzer',
'form.users.role' => 'Rolle',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-Manager',
'form.users.rate' => 'Stundensatz',
'form.users.default_rate' => 'Normaler Stundensatz',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following strings.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktive Kunden',
'form.clients.inactive_clients' => 'Inaktive Kunden',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Sie können alle Teamdaten in eine XML-Datei exportieren. Diese können in andere Zeiterfassungs-Programme importiert werden.',
'form.export.compression' => 'Kompression',
'form.export.compression_none' => 'Keine',
'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Teamdaten von einer XML-Datei importieren.',
'form.import.file' => 'Datei auswählen',
'form.import.success' => 'Import erfolgreich abgeschlossen.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' => 'Das Erzeugen eines neuen Manager Kontos, erzeugt eine neues Team.<br>Diese Teams können auch von XML-Dateien importiert werden.',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12 Stunden',
'form.profile.24_hours' => '24 Stunden',
'form.profile.tracking_mode' => 'Nachverfolgung',
'form.profile.mode_time' => 'Zeit',
'form.profile.mode_projects' => 'Projekte',
'form.profile.mode_projects_and_tasks' => 'Projekte und Aufgaben',
'form.profile.record_type' => 'Zeiterfassungstyp',
'form.profile.type_all' => 'alle',
'form.profile.type_start_finish' => 'Start und Ende',
'form.profile.type_duration' => 'Dauer',
'form.profile.plugins' => 'Erweiterungen',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Von',
'form.mail.to' => 'An',
'form.mail.cc' => 'CC',
'form.mail.subject' => 'Betreff',
'form.mail.report_subject' => 'Time Tracker Bericht',
'form.mail.footer' => 'Anuko Time Tracker ist ein einfaches, leicht zu bedienendes, Open-Source<br>Zeitverwaltungs-System. Besuchen Sie <a href="https://www.anuko.com">www.anuko.com</a> für weitere Informationen.',
'form.mail.report_sent' => 'Der Bericht wurde gesendet.',
'form.mail.invoice_sent' => 'Die Rechnung wurde gesendet.',
);
