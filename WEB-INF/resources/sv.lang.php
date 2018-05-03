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

$i18n_language = 'Swedish (Svenska)';
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
'menu.create_group' => 'Skapa grupp',
'menu.profile' => 'Profil',
'menu.group' => 'Grupp',
'menu.time' => 'Tider',
'menu.expenses' => 'Kostnader',
'menu.reports' => 'Rapporter',
'menu.charts' => 'Diagram',
'menu.projects' => 'Projekt',
'menu.tasks' => 'Arbetsuppgifter',
'menu.users' => 'Användare',
'menu.groups' => 'Grupper',
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
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
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
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Det finns redan ett projekt med det här namnet.',
'error.task_exists' => 'Det finns redan en arbetsuppgift med det här namnet.',
'error.client_exists' => 'Det finns redan en kund med det här namnet.',
'error.invoice_exists' => 'Det finns redan en faktura med det här numret.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Det finns inga debiterbara tidsregistreringar.',
'error.no_login' => 'Det finns ingen användare med det här användarnamnet.',
'error.no_groups' => 'Databasen är tom. Logga in som administratör och skapa en ny grupp.',
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
'button.add' => 'Lägg till',
'button.delete' => 'Ta bort',
'button.generate' => 'Generera',
'button.reset_password' => 'Återställ lösenord',
'button.send' => 'Skicka',
'button.send_by_email' => 'Skicka som e-post',
'button.create_group' => 'Skapa grupp',
'button.export' => 'Exportera grupp',
'button.import' => 'Importera grupp',
'button.close' => 'Stäng',
'button.stop' => 'Avsluta',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Namn på grupp',
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
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
// TODO: translate the following.
// 'label.ip' => 'IP',
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
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
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
'title.groups' => 'Grupper',
'title.create_group' => 'Skapa grupp',
'title.edit_group' => 'Redigera grupp',
'title.delete_group' => 'Ta bort grupp',
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
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
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
'title.export' => 'Exportera grupp',
'title.import' => 'Importera grupp',
'title.options' => 'Alternativ',
'title.profile' => 'Profil',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Egna fält',
'title.cf_add_custom_field' => 'Lägg till fält',
'title.cf_edit_custom_field' => 'Redigera fält',
'title.cf_delete_custom_field' => 'Ta bort fält',
'title.cf_dropdown_options' => 'Alternativ för rullgardinsmeny',
'title.cf_add_dropdown_option' => 'Lägg till alternativ',
'title.cf_edit_dropdown_option' => 'Redigera alternativ',
'title.cf_delete_dropdown_option' => 'Ta bort alternativ',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
'title.locking' => 'Låsning',
// TODO: translate the following.
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

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
// TODO: English string has changed. "from IP" added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Kära användare,\n\Någon, IP %s, begärde att ditt lösenord för Anuko Time Tracker skulle återställas. Vänligen besök den här länken ifall du vill återställa ditt lösenord.\n\n%s\n\nAnuko Time Tracker är en lättanvänd applikation byggd med öppen källkod som enkelt låter dig spåra och hålla koll på arbetstider. Besök https://www.anuko.com för mer information.\n\n",

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
'form.clients.active_clients' => 'Aktiva kunder',
'form.clients.inactive_clients' => 'Inaktiva kunder',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Kund',
'form.client.client_entries' => 'Relaterade tider och kostnader',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: check and confirm the translation of form.export.hint is correct. We are exporting ONE group.
'form.export.hint' => 'Du kan exportera all information om grupp till en XML-fil. Det kan vara användbart när du migrerar till en egen server.',
'form.export.compression' => 'Komprimering',
'form.export.compression_none' => 'Ingen',
'form.export.compression_bzip' => 'B-zip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importera grupp från en XML-fil.',
'form.import.file' => 'Välj fil',
'form.import.success' => 'Importeringen lyckades utan problem.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: check translation of form.groups.hint for accuracy.
'form.groups.hint' => 'Skapa en ny grupp genom att skapa ett konto för en ansvarig person. Du kan även importera grupp från en tidigare installation av Anuko Time Tracker via en XML-fil. Se till att inga användarnamn krockar när filen importeras.',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12-timmars',
'form.group_edit.24_hours' => '24-timmars',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
'form.group_edit.tracking_mode' => 'Spårningsmetod',
'form.group_edit.mode_time' => 'Endast tid',
'form.group_edit.mode_projects' => 'Projekt',
'form.group_edit.mode_projects_and_tasks' => 'Projekt och arbetsuppgifter',
'form.group_edit.record_type' => 'Typ av tidsregistrering',
'form.group_edit.type_all' => 'Alla',
'form.group_edit.type_start_finish' => 'Starttid och sluttid',
'form.group_edit.type_duration' => 'Varaktighet',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
'form.group_edit.uncompleted_indicators' => 'Indikatorer för oavslutad registrering',
// TODO: translate the following.
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Tillägg',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Från',
'form.mail.to' => 'Till',
'form.mail.report_subject' => 'Tidsrapport',
'form.mail.footer' => 'Anuko Time Tracker är en lättanvänd applikation byggd med öppen källkod för att enkelt spåra och hålla koll på arbetstider. Besök <a href="https://www.anuko.com">www.anuko.com</a> för mer information.',
'form.mail.report_sent' => 'Rapporten skickades.',
'form.mail.invoice_sent' => 'Fakturan skickades.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'År',
'form.quota.month' => 'Månad',
'form.quota.quota' => 'Kvot',
'form.quota.workday_hours' => 'Arbetstimmar per dag',
'form.quota.hint' => 'Om fälten lämnas tomma räknas kvoterna automatiskt ut baserat på arbetstimmar per dag och helgdagar.',

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
