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

$i18n_language = 'German (Deutsch)';
$i18n_months = array('Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
$i18n_weekdays = array('Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag');
$i18n_weekdays_short = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '04/02', '05/01', '05/10', '05/21', '10/03', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Anmelden',
'menu.logout' => 'Abmelden',
'menu.forum' => 'Forum',
'menu.help' => 'Hilfe',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'Zeiten',
'menu.expenses' => 'Kosten',
'menu.reports' => 'Berichte',
'menu.charts' => 'Diagramme',
'menu.projects' => 'Projekte',
'menu.tasks' => 'Aufgaben',
'menu.users' => 'Personen',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
'menu.export' => 'Exportieren',
'menu.clients' => 'Kunden',
'menu.options' => 'Optionen',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Tragen Sie auf verschiedenen Weisen zu Time Tracker bei.',
'footer.credits' => 'Impressum',
'footer.license' => 'Lizenz',
'footer.improve' => 'Mach mit',

// Error messages.
'error.access_denied' => 'Zugriff verweigert.',
'error.sys' => 'Systemfehler.',
'error.db' => 'Datenbankfehler.',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Ungültige "{0}" Daten.',
'error.empty' => 'Feld "{0}" ist leer.',
'error.not_equal' => 'Feld "{0}" ist nicht gleich Feld "{1}".',
'error.interval' => 'Feld "{0}" muss größer sein als "{1}".',
'error.project' => 'Projekt wählen.',
'error.task' => 'Aufgabe auswählen.',
'error.client' => 'Kunde auswählen.',
'error.report' => 'Bericht auswählen.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Benutzername oder Passwort ungültig.',
'error.user_exists' => 'Benutzer mit diesem Konto ist bereits vorhanden.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Es gibt bereits ein Projekt mit diesem Namen.',
'error.task_exists' => 'Task mit diesem Namen existiert bereits.',
'error.client_exists' => 'Der Kunde mit dem Namen existiert schon.',
'error.invoice_exists' => 'Rechnung mit dieser Nummer existiert bereits.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Keine Einträge zur Rechnungsstellung gefunden.',
'error.no_login' => 'Benutzer mit diesen Anmeldedaten nicht vorhanden.',
'error.no_groups' => 'Die Datenbank ist leer. Als Administrator anmelden und ein neues Team erzeugen.', // TODO: replace "team" with "group".
'error.upload' => 'Fehler beim hochladen einer Datei.',
'error.range_locked' => 'Zeitinterval ist gesperrt.',
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
'button.add' => 'Hinzufügen',
'button.delete' => 'Löschen',
'button.generate' => 'Erstellen',
'button.reset_password' => 'Passwort zurücksetzen',
'button.send' => 'Senden',
'button.send_by_email' => 'Als E-Mail senden',
'button.create_group' => 'Gruppe erstellen',
'button.export' => 'Gruppe exportieren',
'button.import' => 'Gruppe importieren',
'button.close' => 'Schließen',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Teamname', // TODO: replace "team" with "group".
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
'label.cc' => 'CC',
'label.bcc' => 'BCC',
'label.subject' => 'Betreff',
'label.date' => 'Datum',
'label.start_date' => 'Anfangsdatum',
'label.end_date' => 'Enddatum',
'label.user' => 'Benutzer',
'label.users' => 'Personen',
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
'label.notes' => 'Beschreibungen',
'label.item' => 'Position',
'label.cost' => 'Kosten',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Summe (Tag)',
'label.week_total' => 'Summe (Woche)',
'label.month_total' => 'Summe (Monat)',
'label.today' => 'Heute',
'label.view' => 'Ansicht',
'label.edit' => 'Editieren',
'label.delete' => 'Löschen',
'label.configure' => 'Konfigurieren',
'label.select_all' => 'Alle auswählen',
'label.select_none' => 'Alle abwählen',
'label.day_view' => 'Tagesansicht',
'label.week_view' => 'Wochenansicht',
'label.id' => 'ID',
'label.language' => 'Sprache',
'label.decimal_mark' => 'Dezimaltrennzeichen',
'label.date_format' => 'Datumsformat',
'label.time_format' => 'Zeitformat',
'label.week_start' => 'Erster Wochentag',
'label.comment' => 'Kommentar',
'label.status' => 'Status',
'label.tax' => 'Umsatzsteuer',
'label.subtotal' => 'Zwischensumme',
'label.total' => 'Endsumme',
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
'label.page' => 'Seite',
'label.condition' => 'Bedingung',
'label.yes' => 'Ja',
'label.no' => 'Nein',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Benutzerfelder',
'label.monthly_quotas' => 'Monatliche Quoten',
'label.type' => 'Typ',
'label.type_dropdown' => 'Ausklappen',
'label.type_text' => 'Text',
'label.required' => 'Benötigt',
'label.fav_report' => 'Bevorzugter Report',
'label.schedule' => 'Zeitplan',
'label.what_is_it' => 'Was ist es?',
'label.expense' => 'Ausgaben',
'label.quantity' => 'Menge',
'label.paid_status' => 'Bezahlstatus',
'label.paid' => 'Bezahlt',
'label.mark_paid' => 'Als bezahlt setzen',
// TODO: translate the following.
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Anmelden',
'title.groups' => 'Gruppen',
'title.create_group' => 'Gruppe anlegen',
'title.edit_group' => 'Gruppe bearbeiten',
'title.delete_group' => 'Gruppe löschen',
'title.reset_password' => 'Passworterinnerung',
'title.change_password' => 'Passwortänderung',
'title.time' => 'Zeiten',
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
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Kunden',
'title.add_client' => 'Kunden hinzufügen',
'title.edit_client' => 'Kunden bearbeiten',
'title.delete_client' => 'Kunden löschen',
'title.invoices' => 'Rechnungen',
'title.add_invoice' => 'Rechnung hinzufügen',
'title.view_invoice' => 'Rechnung ansehen',
'title.delete_invoice' => 'Rechnung löschen',
'title.notifications' => 'Benachrichtigung',
'title.add_notification' => 'Benachrichtigung hinzufügen',
'title.edit_notification' => 'Benachrichtigung bearbeiten',
'title.delete_notification' => 'Benachrichtigung löschen',
'title.monthly_quotas' => 'Monatliche Quoten',
'title.export' => 'Daten exportieren',
'title.import' => 'Daten importieren',
'title.options' => 'Optionen',
'title.profile' => 'Profil',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Benutzerfelder',
'title.cf_add_custom_field' => 'Benutzerfeld hinzufügen',
'title.cf_edit_custom_field' => 'Benutzerfeld bearbeiten',
'title.cf_delete_custom_field' => 'Benutzerfeld löschen',
'title.cf_dropdown_options' => 'Auswahlmöglichkeiten',
'title.cf_add_dropdown_option' => 'Auswahlmöglichkeit hinzufügen',
'title.cf_edit_dropdown_option' => 'Auswahlmöglichkeit bearbeiten',
'title.cf_delete_dropdown_option' => 'Auswahlmöglichkeit löschen',
'title.locking' => 'Sperren',
// TODO: translate the following.
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- alle ---',
'dropdown.no' => '--- nein ---',
'dropdown.current_day' => 'heute',
'dropdown.previous_day' => 'gestern',
'dropdown.selected_day' => 'Tag',
'dropdown.current_week' => 'diese Woche',
'dropdown.previous_week' => 'vorherige Woche',
'dropdown.selected_week' => 'Woche',
'dropdown.current_month' => 'dieser Monat',
'dropdown.previous_month' => 'vorheriger Monat',
'dropdown.selected_month' => 'Monat',
'dropdown.current_year' => 'dieses Jahr',
'dropdown.previous_year' => 'vorheriges Jahr',
'dropdown.selected_year' => 'Jahr',
'dropdown.all_time' => 'Gesamtzeitraum',
'dropdown.projects' => 'Projekte',
'dropdown.tasks' => 'Aufgaben',
'dropdown.clients' => 'Kunden',
'dropdown.select' => '--- auswählen ---',
'dropdown.select_invoice' => '--- Rechnung auswählen ---',
'dropdown.status_active' => 'aktiv',
'dropdown.status_inactive' => 'inaktiv',
'dropdown.delete' => 'löschen',
'dropdown.do_not_delete' => 'nicht löschen',
'dropdown.paid' => 'bezahlt',
'dropdown.not_paid' => 'nicht bezahlt',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Passwort vergessen?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> ist ein einfaches, leicht zu bedienendes, Open-Source Zeiterfassungssystem.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Anfrage zur Zurücksetzung des Passwortes wurde per E-mail gesendet.',
'form.reset_password.email_subject' => 'Anuko Time Tracker Anfrage zur Zurücksetzung des Passwortes',
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Sehr geehrter Nutzer,\n\nJemand, IP %s, sendete die Aufforderung Ihr Anuko Time Tracker Passwort zurückzusetzen. Bitte rufen Sie diesen Link auf wenn Sie Ihr Passwort zurücksetzen möchten.\n\n%s\n\nAnuko Time Tracker ist ein einfaches, leicht zu bedienendes, Open-Source Zeiterfassungs-System. Besuchen Sie https://www.anuko.com für weitere Informationen.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Um das Passwort zurückzusetzen, geben Sie ein Neues ein und klicken dann auf Speichern.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm oder 0.0h)',
'form.time.billable' => 'In Rechnung stellen',
'form.time.uncompleted' => 'Unvollständig',
'form.time.remaining_quota' => 'Verbleibende Quote',
'form.time.over_quota' => 'Über der Quote',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Dieser Eintrag wurde ohne Startzeit gespeichert. Dies ist kein Fehler.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Neuer Eintrag',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Als bevorzugt speichern',
'form.reports.confirm_delete' => 'Sind Sie sicher, dass der bevorzugte Report gelöscht werden soll?',
'form.reports.include_billable' => 'in Rechnung stellen',
'form.reports.include_not_billable' => 'nicht in Rechnung stellen',
'form.reports.include_invoiced' => 'berechnet',
'form.reports.include_not_invoiced' => 'nicht berechnet',
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
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Rechnungsnummer',
'form.invoice.person' => 'Person',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Zu löschende Rechnung',
'form.invoice.invoice_entries' => 'Rechnungseintrag',
'form.invoice.confirm_deleting_entries' => 'Bitte die Löschung von Rechnungseinträgen bestätigen.',
// TODO: consider improving translation of form.invoice.confirm_deleting_entries
// This is a warning to user when they are deleting invoice entries.
// They may believe they delete entries from the invoice only but keep the Time Tracker (reports, etc.).
// What is really happening we delete entries from the system, so that they are no longer in reports, etc.
// Original English wording is as follows.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

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
'form.users.uncompleted_entry' => 'Nutzer hat einen unvollständigen Zeiteintrag',
'form.users.role' => 'Rolle',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-Manager',
'form.users.rate' => 'Stundensatz',
'form.users.default_rate' => 'Normaler Stundensatz',

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
'form.clients.active_clients' => 'Aktive Kunden',
'form.clients.inactive_clients' => 'Inaktive Kunden',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Zu löschender Kunde',
'form.client.client_entries' => 'Kundeneintrag',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Sie können alle Teamdaten in eine XML-Datei exportieren. Diese können in andere Zeiterfassungs-Programme importiert werden.',
'form.export.compression' => 'Kompression',
'form.export.compression_none' => 'Keine',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Teamdaten von einer XML-Datei importieren.', // TODO: replace "team" with "group".
'form.import.file' => 'Datei auswählen',
'form.import.success' => 'Import erfolgreich abgeschlossen.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Das Erzeugen eines neuen Manager Kontos, erzeugt eine neues Team.<br>Diese Teams können auch von XML-Dateien importiert werden.',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 Stunden',
'form.group_edit.24_hours' => '24 Stunden',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
'form.group_edit.tracking_mode' => 'Nachverfolgung',
'form.group_edit.mode_time' => 'Zeit',
'form.group_edit.mode_projects' => 'Projekte',
'form.group_edit.mode_projects_and_tasks' => 'Projekte und Aufgaben',
'form.group_edit.record_type' => 'Zeiterfassungstyp',
'form.group_edit.type_all' => 'alle',
'form.group_edit.type_start_finish' => 'Start und Ende',
'form.group_edit.type_duration' => 'Dauer',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Erweiterungen',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Von',
'form.mail.to' => 'An',
'form.mail.report_subject' => 'Time Tracker Bericht',
'form.mail.footer' => 'Anuko Time Tracker ist ein einfaches, leicht zu bedienendes, Open-Source<br>Zeitverwaltungs-System. Besuchen Sie <a href="https://www.anuko.com">www.anuko.com</a> für weitere Informationen.',
'form.mail.report_sent' => 'Der Bericht wurde gesendet.',
'form.mail.invoice_sent' => 'Die Rechnung wurde gesendet.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

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
