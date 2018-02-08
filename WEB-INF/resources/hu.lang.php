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

$i18n_language = 'Magyar';
$i18n_months = array('Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December');
$i18n_weekdays = array('Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat');
$i18n_weekdays_short = array('V', 'H', 'K', 'Sz', 'Cs', 'P', 'Sz');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '03/15', '04/12', '04/13', '05/01', '05/31', '06/01', '08/20', '08/21', '10/23', '11/01', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Bejelentkezés',
'menu.logout' => 'Kijelentkezés',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Segítség',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
'menu.time' => 'Munkaidő',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Riportok',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projektek',
// 'menu.tasks' => 'Tasks',
// TODO: translate the following.
// 'menu.users' => 'Users',
'menu.teams' => 'Csoportok',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Ügyfelek',
'menu.options' => 'Opciók',

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
'error.db' => 'Adatbázis hiba.',
'error.field' => 'Hibás "{0}" mező tartalma.',
'error.empty' => 'A "{0}" mező üres.',
'error.not_equal' => 'A "{0}" mező tartalma nem egyezik meg a "{1}" mező tartalmával.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Válassz projektet.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Válassz ügyfelet.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
// 'error.auth' => 'Incorrect login or password.',
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Ilyen nevű projekt már létezik.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'File feltöltési hiba.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Bejelentkezés',
'button.now' => 'Most',
'button.save' => 'Mentés',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Vissza',
'button.submit' => 'Mentés',
'button.add_user' => 'Felhasználó felvétele',
'button.add_project' => 'Projekt felvétele',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Ügyfél hozzáadása',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Hozzáadás',
'button.generate' => 'Generálás',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Küld',
'button.send_by_email' => 'Küldés e-mail-ben',
'button.create_team' => 'Csoport létrehozása',
'button.export' => 'Csoport exportálása',
'button.import' => 'Csoport importálása',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Pénznem',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Név',
'label.thing_name' => 'Név',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Jelszó',
'label.confirm_password' => 'Jelszó megerősítése',
'label.thing_name' => 'Név',
// TODO: translate the following.
// 'label.email' => 'Email',
'label.cc' => 'Másolatot kap',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Tárgy',
'label.date' => 'Dátum',
'label.start_date' => 'Kezdő időpont',
'label.end_date' => 'Vég időpont',
// TODO: translate the following.
// 'label.user' => 'User',
// 'label.users' => 'Users',
'label.client' => 'Ügyfél',
'label.clients' => 'Ügyfelek',
'label.option' => 'Opció',
'label.invoice' => 'Számla',
'label.project' => 'Projekt',
'label.projects' => 'Projektek',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Kezdete',
'label.finish' => 'Vége',
'label.duration' => 'Időtartam',
'label.note' => 'Megjegyzés',
'label.notes' => 'Megjegyzések',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => 'Ma',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Szerkesztés',
'label.delete' => 'Törlés',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// TODO: translate the following.
'label.select_all' => 'Mindenkit kijelöl',
'label.select_none' => 'Senkit nem jelöl ki',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Megjegyzés',
'label.status' => 'Státusz',
'label.tax' => 'Adó',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Összesen',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'vagy',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* kötelezően kitöltendő mezők',
'label.on_behalf' => 'helyett',
'label.role_manager' => '(vezető)',
'label.role_comanager' => '(helyettes)',
'label.role_admin' => '(adminisztrátor)',
// TODO: translate the following.
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
'label.fav_report' => 'Előre definiált riport formátum',
// TODO: translate the following.
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Bejelentkezés',
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
'title.reports' => 'Riportok',
// TODO: translate the following.
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Számla',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projektek',
'title.add_project' => 'Projekt hozzáadása',
'title.edit_project' => 'Projekt szerkesztése',
'title.delete_project' => 'Projekt törlése',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
// 'title.users' => 'Users',
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
'title.clients' => 'Ügyfelek',
'title.add_client' => 'Ügyfél hozzáadása',
'title.edit_client' => 'Ügyfél szerkesztése',
'title.delete_client' => 'Ügyfél törlése',
'title.invoices' => 'Számlák',
// TODO: translate the following.
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
// 'title.export' => 'Exporting Team Data',
// 'title.import' => 'Importing Team Data',
'title.options' => 'Opciók',
'title.profile' => 'Profil',
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
'dropdown.all' => '--- összes ---',
'dropdown.no' => '--- nincs ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
'dropdown.current_week' => 'ezen a héten',
'dropdown.previous_week' => 'múlt héten',
// TODO: translate the following.
// 'dropdown.selected_week' => 'week',
'dropdown.current_month' => 'ebben a hónapban',
'dropdown.previous_month' => 'múlt hónapban',
// TODO: translate the following.
// 'dropdown.selected_month' => 'month',
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'projektek',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'ügyfelek',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Elfelejtetted a jelszót?',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
// 'form.time.billable' => 'Billable',
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
// TODO: translate the following.
// 'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Mentsük el ezt a riport formátumot',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
// 'form.reports.include_billable' => 'billable',
// 'form.reports.include_not_billable' => 'not billable',
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Jelölj meg egy időszakot',
'form.reports.set_period' => 'vagy állíts be konkrét dátumot',
// TODO: translate the following.
// 'form.reports.show_fields' => 'Show fields',
'form.reports.group_by' => 'Csoportosítva',
'form.reports.group_by_no' => '--- csoportosítás nélkül ---',
// TODO: translate the following.
// 'form.reports.group_by_date' => 'date',
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projekt',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportálása', // TODO: is this correct?
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
// TODO: translate the following.
// 'form.invoice.number' => 'Invoice number',
// 'form.invoice.person' => 'Person',
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: translate the following.
// 'form.charts.interval' => 'Interval',
// 'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: translate the following.
// 'form.projects.active_projects' => 'Active Projects',
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
// 'form.users.manager' => 'Manager',
// 'form.users.comanager' => 'Co-manager',
// 'form.users.rate' => 'Rate',
// 'form.users.default_rate' => 'Default hourly rate',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
// TODO: improve or check form.export.hint as the translation seems incorrect if we trust translate.google.com.
// Export does a single team export (all data in ONE team).
'form.export.hint' => 'Kimentheted az összes felvitt csoport adatait egy XML file-ba, ami megkönnyíti a TimeTracker szerverek közötti adatátvitelt.',
'form.export.compression' => 'Tömörítés',
// TODO: translate the following.
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Csoport adatok importja XML file-ból.',
'form.import.file' => 'Válassz file',
'form.import.success' => 'Az importálás sikeresen véget ért.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: fix form.teams.hint by translating it properly from the English string. Note that the ending is not translated at all.
'form.teams.hint' => 'Új csoport létrehozása egy csoport-vezetői jogosultsággal.<br>A csoport adatokat importálhatjuk XML-ből (no login collisions are allowed).',



// TODO: refactoring ongoing down from here.

// administrator form
"form.admin.profile.title" => 'csoportok',
"form.admin.profile.noprofiles" => 'az adatbázis üres. lépj be adminisztrátorként és hozz létre egyet.',
"form.admin.profile.comment" => 'csoport törlése',
"form.admin.profile.th.id" => 'azonosító',
"form.admin.profile.th.active" => 'aktív',

// my time form attributes
"form.mytime.title" => 'munkaidőm',
"form.mytime.edit_title" => 'szerkesztés',
"form.mytime.del_str" => 'törlés',
"form.mytime.time_form" => ' (óó:pp)',
"form.mytime.total" => 'összesített óraszám: ',
"form.mytime.del_yes" => 'a bejegyzés törölve',
"form.mytime.no_finished_rec" => 'csak az munka kezdete lett megjelölve, ha később visszalépsz a rendszerbe beállíthatod a vég-időpontot...',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'új vezetői jogosultság létrehozása',
"form.profile.edit_title" => 'profil szerkesztése',

// people form attributes
"form.people.ppl_str" => 'munkatársak',
"form.people.createu_str" => 'új munkatárs hozzáadása',
"form.people.edit_str" => 'munkatárs adatainak szerkesztése',
"form.people.del_str" => 'munkatárs adatainak törlése',
"form.people.th.role" => 'szerepkör',
"form.people.th.rate" => 'tarifa',
"form.people.manager" => 'vezető',
"form.people.comanager" => 'helyettes',

"form.people.rate" => 'általános óradíj',
"form.people.comanager" => 'helyettes',

// report attributes
"form.report.total" => 'összesített óraszám',

// mail form attributes
"form.mail.from" => 'feladó',
"form.mail.to" => 'címzett',
"form.mail.above" => 'küldjük el ezt a riportot e-mail-ben...',
// Note to translators: the string below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>az üzenet elküldve</b>',

// invoice attributes
"form.invoice.title" => 'számla',
"form.invoice.caption" => 'Számla',
"form.invoice.above" => 'a számlához tartozó adatok',
"form.invoice.select_cust" => 'válassz ügyfelet',
"form.invoice.fillform" => 'töltsd ki a mezőket',
"form.invoice.number" => 'számla azonosító száma',
"form.invoice.th.username" => 'személy',
"form.invoice.th.time" => 'óra',
"form.invoice.th.rate" => 'tarifa',
"form.invoice.th.summ" => 'darab',
"form.invoice.subtotal" => 'részösszeg',
"form.invoice.customer" => 'Ügyfél',
"form.invoice.mailinv_above" => 'küldjük el ezt a számlát e-mail-en',
"form.invoice.sending_str" => '<b>a számla elküldve</b>',
);
