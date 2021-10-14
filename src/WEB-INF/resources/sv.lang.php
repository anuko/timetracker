<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Swedish (Svenska)';
$i18n_months = array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December');
$i18n_weekdays = array('Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag');
$i18n_weekdays_short = array('Sö', 'Må', 'Ti', 'On', 'To', 'Fr', 'Lö');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Logga in',
'menu.logout' => 'Logga ut',
'menu.forum' => 'Forum',
'menu.help' => 'Hjälp',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'Profil',
'menu.group' => 'Grupp',
'menu.plugins' => 'Tillägg',
'menu.time' => 'Tider',
// TODO: translate the following.
// 'menu.puncher' => 'Punch',
// 'menu.week' => 'Week',
'menu.expenses' => 'Kostnader',
'menu.reports' => 'Rapporter',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
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
// 'error.registered_recently' => 'Registered recently.',
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
'error.invoice_exists' => 'Det finns redan en faktura med det här numret.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Det finns inga debiterbara tidsregistreringar.',
// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
'error.no_login' => 'Det finns ingen användare med det här användarnamnet.',
'error.no_groups' => 'Databasen är tom. Logga in som administratör och skapa en ny grupp.',
'error.upload' => 'Ett fel uppstod när filen laddades upp.',
'error.range_locked' => 'Datumintervallet är låst.',
'error.mail_send' => 'Ett fel uppstod när när e-postmeddelandet skulle skickas.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => 'Det finns ingen e-postadress kopplad till det här användarnamnet.',
'error.uncompleted_exists' => 'En oavslutad registrering existerar redan. Avsluta eller ta bort den.',
'error.goto_uncompleted' => 'Visa registrering.',
'error.overlap' => 'Tidsintervallet överlappar med en redan existerande tidsregistrering.',
'error.future_date' => 'Det går inte att registrera tider framåt i tiden.',
// TODO: translate the following.
// 'error.xml' => 'Error in XML file at line %d: %s.',
// 'error.cannot_import' => 'Cannot import: %s.',
// 'error.format' => 'Invalid file format.',
// 'error.user_count' => 'Limit on user count.',
// 'error.expired' => 'Expiration date reached.',
// 'error.file_storage' => 'File storage server error.', // See comment in English file.
// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

// Warning messages.
// TODO: translate the following.
// 'warn.sure' => 'Are you sure?',
// 'warn.confirm_save' => 'Date has changed. Confirm saving, not copying this item.',

// Success messages.
// TODO: translate the following.
// 'msg.success' => 'Operation completed successfully.',

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
// TODO: translate the following.
// 'button.start' => 'Start',
'button.stop' => 'Avsluta',
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',
// 'button.sync' => 'Sync', // Used in Android app. The meaning is to synchronize offline time records with server.

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
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
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
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
// 'label.puncher' => 'Puncher',
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
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Egna fält',
'label.monthly_quotas' => 'Månadskvoter',
// TODO: translate the following.
// 'label.entity' => 'Entity',
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
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
'label.totals_only' => 'Visa endast summeringar',
'label.quota' => 'Kvot',
// TODO: translate the following.
// 'label.timesheet' => 'Timesheet',
// 'label.submitted' => 'Submitted',
// 'label.approved' => 'Approved',
// 'label.approval' => 'Report approval',
// 'label.mark_approved' => 'Mark approved',
// 'label.template' => 'Template',
// 'label.bind_templates_with_projects' => 'Bind templates with projects',
// 'label.prepopulate_note' => 'Prepopulate Note field',
// 'label.attachments' => 'Attachments',
// 'label.files' => 'Files',
// 'label.file' => 'File',
'label.active_users' => 'Aktiva användare',
'label.inactive_users' => 'Inaktiva användare',
// TODO: translate the following.
// 'label.details' => 'Details',
// 'label.budget' => 'Budget',
// 'label.work' => 'Work',   // Table column header for work items, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.offer' => 'Offer', // Table column header for offers, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.contractor' => 'Contractor', // Table column header for offers (contractor is someone who offers to do work).
                                       // Technically, it is either an org name or a combination of org and group names
                                       // because both work items and offers are owned by Time Tracker groups of users.
// 'label.how_to_pay' => 'How to pay', // Label for the "How to pay" field on offers, which allows contractors to specify
                                       // how to pay them, for example: paypal email, check by mail to a specific address, etc.
// 'label.moderator_comment' => 'Moderator comment', // Label for "Moderator comment" field that explains something.

// Entity names. We use lower case (in English) because they are used in dropdowns, too.
// They are used to associate a custom field with an entity type.
// TODO: translate the following.
// 'entity.time' => 'time',
// 'entity.user' => 'user',
// 'entity.project' => 'project',

// Rubriker för formulär
'title.error' => 'Fel',
// TODO: Translate the following.
// 'title.success' => 'Success',
'title.login' => 'Logga in',
'title.groups' => 'Grupper',
// TODO: translate the following.
// 'title.add_group' => 'Adding Group',
'title.edit_group' => 'Redigera grupp',
'title.delete_group' => 'Ta bort grupp',
'title.reset_password' => 'Återställ lösenord',
'title.change_password' => 'Ändra lösenord',
'title.time' => 'Tider',
'title.edit_time_record' => 'Redigera tidsregistrering',
'title.delete_time_record' => 'Ta bort tidsregistrering',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
// 'title.puncher' => 'Puncher',
'title.expenses' => 'Kostnader',
'title.edit_expense' => 'Redigera kostnad',
'title.delete_expense' => 'Ta bort kostnad',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.predefined_expenses' => 'Fördefinierade kostnader',
'title.add_predefined_expense' => 'Lägg till fördefinierad kostnad',
'title.edit_predefined_expense' => 'Redigera fördefinierad kostnad',
'title.delete_predefined_expense' => 'Ta bort fördefinierad kostnad',
'title.reports' => 'Rapporter',
'title.report' => 'Rapport',
'title.send_report' => 'Skicka rapport',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'Faktura',
'title.send_invoice' => 'Skicka faktura',
'title.charts' => 'Diagram',
'title.projects' => 'Projekt',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
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
// TODO: translate the following.
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
'title.monthly_quotas' => 'Månadskvoter',
'title.export' => 'Exportera grupp',
'title.import' => 'Importera grupp',
'title.options' => 'Alternativ',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
'title.profile' => 'Profil',
'title.plugins' => 'Tillägg',
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
// 'title.work_units' => 'Work Units',
// 'title.templates' => 'Templates',
// 'title.add_template' => 'Adding Template',
// 'title.edit_template' => 'Editing Template',
// 'title.delete_template' => 'Deleting Template',
// 'title.edit_file' => 'Editing File',
// 'title.delete_file' => 'Deleting File',
// 'title.download_file' => 'Downloading File',
// 'title.work' => 'Work',
// 'title.add_work' => 'Adding Work',
// 'title.edit_work' => 'Editing Work',
// 'title.delete_work' => 'Deleting Work',
// 'title.active_work' => 'Active Work', // Active work items this group outsources to other groups.
// 'title.available_work' => 'Available Work', // Available work items from other organizations.
// 'title.inactive_work' => 'Inactive Work', // Inactive work items this group was outsourcing to other groups.
// 'title.pending_work' => 'Pending Work', // Work items pending moderator approval.
// 'title.offer' => 'Offer',
// 'title.add_offer' => 'Adding Offer',
// 'title.edit_offer' => 'Editing Offer',
// 'title.delete_offer' => 'Deleting Offer',
// 'title.active_offers' => 'Active Offers', // Active offers this group makes available to other groups.
// 'title.available_offers' => 'Available Offers', // Available offers from other organizations.
// 'title.inactive_offers' => 'Inactive Offers', // Inactive offers for group.
// 'title.pending_offers' => 'Pending Offers', // Offers pending moderator approval.

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
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'Aktiv',
'dropdown.status_inactive' => 'Inaktiv',
'dropdown.delete' => 'Ta bort',
'dropdown.do_not_delete' => 'Ta inte bort',
// TODO: translate the following.
// 'dropdown.pending_approval' => 'pending approval',
// 'dropdown.approved' => 'approved',
// 'dropdown.not_approved' => 'not approved',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',
// 'dropdown.ascending' => 'ascending',
// 'dropdown.descending' => 'descending',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Glömt lösenordet?',
 // TODO: re-translate form.login.about as it has changed.
 // 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is an open source time tracking system.',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> är en lättanvänd applikation byggd med öppen källkod som enkelt låter dig spåra och hålla koll på arbetstider.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Begäran om att återställa lösenordet skickades via e-post.',
'form.reset_password.email_subject' => 'Återställning av lösenord för Anuko Time Tracker begärd',
// TODO: English string has changed. Re-translate.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is an open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
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
// TODO: translate the following.
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

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
// TODO: translate the following.
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'Välj intervall',
'form.reports.set_period' => 'eller ställ in datum',
'form.reports.show_fields' => 'Visa fält',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'Gruppera efter',
'form.reports.group_by_no' => '--- Ingen gruppering ---',
'form.reports.group_by_date' => 'Datum',
'form.reports.group_by_user' => 'Användare',
'form.reports.group_by_client' => 'Kund',
'form.reports.group_by_project' => 'Projekt',
'form.reports.group_by_task' => 'Arbetsuppgift',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportera som',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',
// 'form.report.assign_to_timesheet' => 'Assign to timesheet',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php
// TODO: translate the following.
// 'form.timesheets.active_timesheets' => 'Active Timesheets',
// 'form.timesheets.inactive_timesheets' => 'Inactive Timesheets',

// Templates form. See example at https://timetracker.anuko.com/templates.php
// TODO: translate the following.
// 'form.templates.active_templates' => 'Active Templates',
// 'form.templates.inactive_templates' => 'Inactive Templates',

// Invoice form. See example at https://timetracker.anuko.com/invoice_view.php
// (you can get to this form after generating an invoice).
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
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
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
// 'form.group_edit.confirm_save' => 'Confirm saving',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.advanced_settings' => 'Advanced settings',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => 'Till',
'form.mail.report_subject' => 'Tidsrapport',
// TODO: retranslate form.mail.footer as the English string has changed.
// 'form.mail.footer' => 'Anuko Time Tracker is an open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
'form.mail.footer' => 'Anuko Time Tracker är en lättanvänd applikation byggd med öppen källkod för att enkelt spåra och hålla koll på arbetstider. Besök <a href="https://www.anuko.com">www.anuko.com</a> för mer information.',
'form.mail.report_sent' => 'Rapporten skickades.',
'form.mail.invoice_sent' => 'Fakturan skickades.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'År',
'form.quota.month' => 'Månad',
'form.quota.workday_hours' => 'Arbetstimmar per dag',
'form.quota.hint' => 'Om fälten lämnas tomma räknas kvoterna automatiskt ut baserat på arbetstimmar per dag och helgdagar.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
// TODO: translate the following.
// 'form.work_units.minutes_in_unit' => 'Minutes in unit',
// 'form.work_units.1st_unit_threshold' => '1st unit threshold',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own data.',
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

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
// TODO: translate the following.
// 'form.timesheet_view.submit_subject' => 'Timesheet approval request',
// 'form.timesheet_view.submit_body' => "A new timesheet requires approval.<p>User: %s.",
// 'form.timesheet_view.approve_subject' => 'Timesheet approved',
// 'form.timesheet_view.approve_body' => "Your timesheet %s was approved.<p>%s",
// 'form.timesheet_view.disapprove_subject' => 'Timesheet not approved',
// 'form.timesheet_view.disapprove_body' => "Your timesheet %s was not approved.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
// TODO: translate the following.
// 'form.display_options.note_on_separate_row' => 'Note on separate row',
// 'form.display_options.not_complete_days' => 'Not complete days',
// 'form.display_options.inactive_projects' => 'Inactive projects',
// 'form.display_options.custom_css' => 'Custom CSS',

// Work plugin strings. See example at https://timetracker.anuko.com/work.php
// TODO: translate the following.
// 'work.error.work_not_available' => 'Work item is not available.',
// 'work.error.offer_not_available' => 'Offer is not available.',
// 'work.type.one_time' => 'one time', // Work type is "one time job" for well defined work ("do exactly this").
// 'work.type.ongoing' => 'ongoing',   // Work type is "ongoing" for complex jobs (billed by the hour, multiple contractors, etc.)
// 'work.label.own_work' => 'Own work',
// 'work.label.own_offers' => 'Own offers',
// 'work.label.offers' => 'Offers',
// 'work.button.send_message' => 'Send message',
// 'work.button.make_offer' => 'Make offer',
// 'work.button.accept' => 'Accept',
// 'work.button.decline' => 'Decline',
// 'work.title.send_message' => 'Sending Message',
// 'work.msg.message_sent' => 'Message sent.',
);
