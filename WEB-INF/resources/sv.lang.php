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

$i18n_language = 'Svenska';
$i18n_months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');
$i18n_weekdays = array('Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag');
$i18n_weekdays_short = array('Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '05/01', '06/06', '12/25', '12/26'); // OBS! Endast fasta helgdagar, då rörliga datum måste uppdateras varje år.

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Logga in',
'menu.logout' => 'Logga ut',
'menu.forum' => 'Forum',
'menu.help' => 'Hjälp',
'menu.create_team' => 'Skapa arbetsgrupp',
'menu.profile' => 'Profil',
'menu.time' => 'Tider',
'menu.expenses' => 'Kostnader',
'menu.reports' => 'Rapporter',
'menu.charts' => 'Diagram',
'menu.projects' => 'Projekt',
'menu.tasks' => 'Arbetsuppgifter',
'menu.users' => 'Användare',
'menu.teams' => 'Arbetsgrupper',
'menu.export' => 'Exportera',
'menu.clients' => 'Kunder',
'menu.options' => 'Alternativ',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Det finns många sätt du kan bidra till Anuko Time Tracker.',
'footer.credits' => 'Tack till',
'footer.license' => 'Licens',
'footer.improve' => 'Bidra',


// Error messages.
'error.access_denied' => 'Åtkomst nekad.',
'error.sys' => 'Systemfel.',
'error.db' => 'Databasfel.',
'error.field' => '"{0}" innehåller ett felaktigt värde.',
'error.empty' => '"{0}" kan inte vara tomt.',
'error.not_equal' => '"{0}" matchar inte "{1}".',
'error.interval' => '"{0}" måste vara större än "{1}".',
'error.project' => 'Välj ett projekt.',
'error.task' => 'Välj en arbetsuppgift.',
'error.client' => 'Välj en kund.',
'error.report' => 'Välj en rapport.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Ogiltigt användarnamn eller lösenord.',
'error.user_exists' => 'Det finns redan en användare med det här användarnamnet.',
'error.project_exists' => 'Det finns redan ett projekt med det här namnet.',
'error.task_exists' => 'Det finns redan en arbetsuppgift med det här namnet.',
'error.client_exists' => 'Det finns redan en kund med det här namnet.',
'error.invoice_exists' => 'Det finns redan en faktura med det här numret.',
'error.no_invoiceable_items' => 'Det finns inga debiterbara tidsregistreringar.',
'error.no_login' => 'Det finns ingen användare med det här användarnamnet.',
'error.no_teams' => 'Databasen är tom. Logga in som administratör och skapa en ny arbetsgrupp.',
'error.upload' => 'Ett fel uppstod när filen laddades upp.',
'error.range_locked' => 'Datumintervallet är låst.',
'error.mail_send' => 'Ett fel uppstod när när e-postmeddelandet skulle skickas.',
'error.no_email' => 'Det finns ingen e-postadress kopplad till det här användarnamnet.',
'error.uncompleted_exists' => 'En oavslutad registrering existerar redan. Avsluta eller ta bort den.',
'error.goto_uncompleted' => 'Visa registrering.',
'error.overlap' => 'Tidsintervallet överlappar med en redan existerande tidsregistrering.',
'error.future_date' => 'Det går inte att registrera tider framåt i tiden.',

// Labels for buttons.
'button.login' => 'Logga in',
'button.now' => 'Nu',
'button.save' => 'Spara',
'button.copy' => 'Kopiera',
'button.cancel' => 'Avbryt',
'button.submit' => 'Skicka',
'button.add_user' => 'Lägg till användare',
'button.add_project' => 'Lägg till projekt',
'button.add_task' => 'Lägg till arbetsuppgift',
'button.add_client' => 'Lägg till kund',
'button.add_invoice' => 'Lägg till faktura',
'button.add_option' => 'Lägg till alternativ',
'button.add' => 'Lägg till',
'button.generate' => 'Generera',
'button.reset_password' => 'Återställ lösenord',
'button.send' => 'Skicka',
'button.send_by_email' => 'Skicka som e-post',
'button.create_team' => 'Skapa ny arbetsgrupp',
'button.export' => 'Exportera arbetsgrupp',
'button.import' => 'Importera arbetsgrupp',
'button.close' => 'Stäng',
'button.stop' => 'Avsluta',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Namn på arbetsgrupp',
'label.address' => 'Adress',
'label.currency' => 'Valuta',
'label.manager_name' => 'Namn på ansvarig',
'label.manager_login' => 'Användarnamn för ansvarig',
'label.person_name' => 'Namn',
'label.thing_name' => 'Namn',
'label.login' => 'Användarnamn',
'label.password' => 'Lösenord',
'label.confirm_password' => 'Bekräfta lösenord',
'label.email' => 'E-postadress',
'label.cc' => 'Kopia',
'label.bcc' => 'Hemlig kopia',
'label.subject' => 'Ämne',
'label.date' => 'Datum',
'label.start_date' => 'Startdatum',
'label.end_date' => 'Slutdatum',
'label.user' => 'Användare',
'label.users' => 'Användare',
'label.client' => 'Kund',
'label.clients' => 'Kunder',
'label.option' => 'Alternativ',
'label.invoice' => 'Faktura',
'label.project' => 'Projekt',
'label.projects' => 'Projekt',
'label.task' => 'Arbetsuppgift',
'label.tasks' => 'Arbetsuppgifter',
'label.description' => 'Beskrivning',
'label.start' => 'Starttid',
'label.finish' => 'Sluttid',
'label.duration' => 'Varaktighet',
'label.note' => 'Anteckning',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Utlägg för',
'label.cost' => 'Kostnad',
'label.day_total' => 'Dagstotal',
'label.week_total' => 'Veckototal',
'label.month_total' => 'Månadstotal',
'label.today' => 'Idag',
'label.view' => 'Visa',
'label.edit' => 'Redigera',
'label.delete' => 'Ta bort',
'label.configure' => 'Konfigurera',
'label.select_all' => 'Markera alla',
'label.select_none' => 'Avmarkera alla',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Språk',
'label.decimal_mark' => 'Decimaltecken',
'label.date_format' => 'Datumformat',
'label.time_format' => 'Tidsformat',
'label.week_start' => 'Första dagen på veckan',
'label.comment' => 'Kommentar',
'label.status' => 'Status',
'label.tax' => 'Moms',
'label.subtotal' => 'Delsumma',
'label.total' => 'Totalsumma',
'label.client_name' => 'Kundnamn',
'label.client_address' => 'Kundadress',
'label.or' => 'eller',
'label.error' => 'Fel',
'label.ldap_hint' => 'Fyll i ditt <b>användarnamn och lösenord för Windows</b> i fälten nedan.',
'label.required_fields' => '* - Obligatoriska fält',
'label.on_behalf' => 'agerar som',
'label.role_manager' => '(Ansvarig)',
'label.role_comanager' => '(Delansvarig)',
'label.role_admin' => '(Administratör)',
'label.page' => 'Sida',
'label.condition' => 'Villkor',
// TODO: translate the following.
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Egna fält',
'label.monthly_quotas' => 'Månadskvoter',
'label.type' => 'Typ',
'label.type_dropdown' => 'Rullgardinsmeny',
'label.type_text' => 'Text',
'label.required' => 'Obligatorisk',
'label.fav_report' => 'Sparade rapporter',
'label.cron_schedule' => 'CRON-schema',
'label.what_is_it' => 'Vad är detta?',
'label.expense' => 'Kostnad',
'label.quantity' => 'Antal',
// TODO: translate the following.
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Rubriker för formulär
'title.login' => 'Logga in',
'title.teams' => 'Arbetsgrupper',
'title.create_team' => 'Skapa arbetsgrupp',
'title.edit_team' => 'Redigera arbetsgrupp',
'title.delete_team' => 'Ta bort arbetsgrupp',
'title.reset_password' => 'Återställ lösenord',
'title.change_password' => 'Ändra lösenord',
'title.time' => 'Tider',
'title.edit_time_record' => 'Redigera tidsregistrering',
'title.delete_time_record' => 'Ta bort tidsregistrering',
'title.expenses' => 'Kostnader',
'title.edit_expense' => 'Redigera kostnad',
'title.delete_expense' => 'Ta bort kostnad',
'title.predefined_expenses' => 'Fördefinierade kostnader',
'title.add_predefined_expense' => 'Lägg till fördefinierad kostnad',
'title.edit_predefined_expense' => 'Redigera fördefinierad kostnad',
'title.delete_predefined_expense' => 'Ta bort fördefinierad kostnad',
'title.reports' => 'Rapporter',
'title.report' => 'Rapport',
'title.send_report' => 'Skicka rapport',
'title.invoice' => 'Faktura',
'title.send_invoice' => 'Skicka faktura',
'title.charts' => 'Diagram',
'title.projects' => 'Projekt',
'title.add_project' => 'Lägg till projekt',
'title.edit_project' => 'Redigera projekt',
'title.delete_project' => 'Ta bort projekt',
'title.tasks' => 'Arbetsuppgifter',
'title.add_task' => 'Lägg till arbetsuppgift',
'title.edit_task' => 'Redigera arbetsuppgift',
'title.delete_task' => 'Ta bort arbetsuppgift',
'title.users' => 'Användare',
'title.add_user' => 'Lägg till användare',
'title.edit_user' => 'Redigera användare',
'title.delete_user' => 'Ta bort användare',
'title.clients' => 'Kunder',
'title.add_client' => 'Lägg till kund',
'title.edit_client' => 'Redigera kund',
'title.delete_client' => 'Ta bort kund',
'title.invoices' => 'Fakturor',
'title.add_invoice' => 'Lägg till faktura',
'title.view_invoice' => 'Visa faktura',
'title.delete_invoice' => 'Ta bort faktura',
'title.notifications' => 'Aviseringar',
'title.add_notification' => 'Lägg till avisering',
'title.edit_notification' => 'Redigera avisering',
'title.delete_notification' => 'Ta bort avisering',
'title.monthly_quotas' => 'Månadskvoter',
'title.export' => 'Exportera arbetsgrupp',
'title.import' => 'Importera arbetsgrupp',
'title.options' => 'Alternativ',
'title.profile' => 'Profil',
'title.cf_custom_fields' => 'Egna fält',
'title.cf_add_custom_field' => 'Lägg till fält',
'title.cf_edit_custom_field' => 'Redigera fält',
'title.cf_delete_custom_field' => 'Ta bort fält',
'title.cf_dropdown_options' => 'Alternativ för rullgardinsmeny',
'title.cf_add_dropdown_option' => 'Lägg till alternativ',
'title.cf_edit_dropdown_option' => 'Redigera alternativ',
'title.cf_delete_dropdown_option' => 'Ta bort alternativ',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
'title.locking' => 'Låsning',
// TODO: translate the following.
// 'title.week_view' => 'Week View',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- Alla ---',
'dropdown.no' => '--- Ingen ---',
'dropdown.current_day' => 'Idag',
'dropdown.previous_day' => 'Igår',
'dropdown.selected_day' => 'Dag',
'dropdown.current_week' => 'Den här veckan',
'dropdown.previous_week' => 'Föregående vecka',
'dropdown.selected_week' => 'Vecka',
'dropdown.current_month' => 'Den här månaden',
'dropdown.previous_month' => 'Föregående månad',
'dropdown.selected_month' => 'Månad',
'dropdown.current_year' => 'Det här året',
'dropdown.previous_year' => 'Föregående år',
'dropdown.selected_year' => 'År',
'dropdown.all_time' => 'Livstid',
'dropdown.projects' => 'Projekt',
'dropdown.tasks' => 'Arbetsuppgifter',
'dropdown.clients' => 'Kunder',
'dropdown.select' => '--- Välj ---',
'dropdown.select_invoice' => '--- Välj faktura ---',
'dropdown.status_active' => 'Aktiv',
'dropdown.status_inactive' => 'Inaktiv',
'dropdown.delete' => 'Ta bort',
'dropdown.do_not_delete' => 'Ta inte bort',
// TODO: translate the following.
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Glömt lösenordet?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> är en lättanvänd applikation byggd med öppen källkod som enkelt låter dig spåra och hålla koll på arbetstider.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Begäran om att återställa lösenordet skickades via e-post.',
'form.reset_password.email_subject' => 'Återställning av lösenord för Anuko Time Tracker begärd',
'form.reset_password.email_body' => "Kära användare,\n\Någon, förmodligen du, begärde att ditt lösenord för Anuko Time Tracker skulle återställas. Vänligen besök den här länken ifall du vill återställa ditt lösenord.\n\n%s\n\nAnuko Time Tracker är en lättanvänd applikation byggd med öppen källkod som enkelt låter dig spåra och hålla koll på arbetstider. Besök https://www.anuko.com för mer information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Fyll i ett nytt lösenord och klicka på Spara.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm eller 0.0h)',
'form.time.billable' => 'Debiterbar',
'form.time.uncompleted' => 'Oavslutad',
'form.time.remaining_quota' => 'Återstående kvot',
'form.time.over_quota' => 'Kvoten överstigen',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Den här tidsregistreringen har sparats utan sluttid. Fyll i en sluttid och klicka på Spara för att avsluta.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Spara rapport som',
'form.reports.confirm_delete' => 'Är du säker på att du vill ta bort den här rapporten från dina favoriter?',
'form.reports.include_billable' => 'Debiterbar tid',
'form.reports.include_not_billable' => 'Icke debiterbar tid',
'form.reports.include_invoiced' => 'Fakturerad tid',
'form.reports.include_not_invoiced' => 'Icke fakturerad tid',
'form.reports.select_period' => 'Välj intervall',
'form.reports.set_period' => 'eller ställ in datum',
'form.reports.show_fields' => 'Visa fält',
'form.reports.group_by' => 'Gruppera efter',
'form.reports.group_by_no' => '--- Ingen gruppering ---',
'form.reports.group_by_date' => 'Datum',
'form.reports.group_by_user' => 'Användare',
'form.reports.group_by_client' => 'Kund',
'form.reports.group_by_project' => 'Projekt',
'form.reports.group_by_task' => 'Arbetsuppgift',
'form.reports.totals_only' => 'Visa endast summeringar',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportera som',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Fakturanummer',
'form.invoice.person' => 'Person',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Fakturanummer',
'form.invoice.invoice_entries' => 'Relaterade tider och kostnader',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Intervall',
'form.charts.chart' => 'Diagram',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktiva projekt',
'form.projects.inactive_projects' => 'Inaktiva projekt',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktiva arbetsuppgifter',
'form.tasks.inactive_tasks' => 'Inaktiva arbetsuppgifter',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktiva användare',
'form.users.inactive_users' => 'Inaktiva användare',
'form.users.uncompleted_entry' => 'Användaren har en oavslutad tidsregistrering',
'form.users.role' => 'Roll',
'form.users.manager' => 'Ansvarig',
'form.users.comanager' => 'Delansvarig',
'form.users.rate' => 'Timtaxa',
'form.users.default_rate' => 'Standard timtaxa',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktiva kunder',
'form.clients.inactive_clients' => 'Inaktiva kunder',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Kund',
'form.client.client_entries' => 'Relaterade tider och kostnader',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Du kan exportera all information om arbetsgrupperna till en XML-fil. Det kan vara användbart när du migrerar till en egen server.',
'form.export.compression' => 'Komprimering',
'form.export.compression_none' => 'Ingen',
'form.export.compression_bzip' => 'B-zip',

// Importing Team Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importera arbetsgrupp från en XML-fil.',
'form.import.file' => 'Välj fil',
'form.import.success' => 'Importeringen lyckades utan problem.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' => 'Skapa en ny arbetsgrupp genom att skapa ett konto för en ansvarig person. Du kan även importera arbetsgrupper från en tidigare installation av Anuko Time Tracker via en XML-fil. Se till att inga användarnamn krockar när filen importeras.',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12-timmars',
'form.profile.24_hours' => '24-timmars',
// TODO: translate the following.
// 'form.profile.show_holidays' => 'Show holidays',
'form.profile.tracking_mode' => 'Spårningsmetod',
'form.profile.mode_time' => 'Endast tid',
'form.profile.mode_projects' => 'Projekt',
'form.profile.mode_projects_and_tasks' => 'Projekt och arbetsuppgifter',
'form.profile.record_type' => 'Typ av tidsregistrering',
'form.profile.type_all' => 'Alla',
'form.profile.type_start_finish' => 'Starttid och sluttid',
'form.profile.type_duration' => 'Varaktighet',
// TODO: translate the following.
// 'form.profile.punch_in_mode' => 'Punch in mode',
// 'form.profile.allow_overlap' => 'Allow overlap',
// 'form.profile.future_entries' => 'Future entries',
'form.profile.uncompleted_indicators' => 'Indikatorer för oavslutad registrering',
'form.profile.plugins' => 'Tillägg',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Från',
'form.mail.to' => 'Till',
'form.mail.report_subject' => 'Tidsrapport',
'form.mail.footer' => 'Anuko Time Tracker är en lättanvänd applikation byggd med öppen källkod för att enkelt spåra och hålla koll på arbetstider. Besök <a href="https://www.anuko.com">www.anuko.com</a> för mer information.',
'form.mail.report_sent' => 'Rapporten skickades.',
'form.mail.invoice_sent' => 'Fakturan skickades.',

// Quotas configuration form.
'form.quota.year' => 'År',
'form.quota.month' => 'Månad',
'form.quota.quota' => 'Kvot',
'form.quota.workday_hours' => 'Arbetstimmar per dag',
'form.quota.hint' => 'Om fälten lämnas tomma räknas kvoterna automatiskt ut baserat på arbetstimmar per dag och helgdagar.',
);
