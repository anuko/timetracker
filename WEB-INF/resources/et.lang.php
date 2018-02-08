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

$i18n_language = 'Eesti';
$i18n_months = array('Jaanuar', 'Veebruar', 'Märts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');
$i18n_weekdays = array('Pühapäev', 'Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev');
$i18n_weekdays_short = array('P', 'E', 'T', 'K', 'N', 'R', 'L');
// format mm/dd
$i18n_holidays = array('01/01', '02/24', '04/10', '04/12', '05/01', '05/31', '06/23', '06/24', '08/20', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Login',
'menu.logout' => 'Logout',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Abiinfo',
// TODO: translate the following.
'menu.create_team' => 'Create Team',
'menu.profile' => 'Profiili',
'menu.time' => 'Aeg',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Raportid',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projektid',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Kasutajad',
'menu.teams' => 'Meeskonnad',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Kliendid',
'menu.options' => 'Suvandid',

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
'error.db' => 'Andmebaasi viga.',
'error.field' => 'Valed "{0}" andmed.',
'error.empty' => 'Väli "{0}" on tühi.',
'error.not_equal' => 'Väli "{0}" ei ole väljaga "{1}" võrdne.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Vali projekt.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Vali klient.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Vale login või salasõna.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Selle nimega projekt on juba olemas.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Viga faili vastuvõtmisel.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Kohe',
'button.save' => 'Salvesta',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Tühista',
'button.submit' => 'Postita',
'button.add_user' => 'Lisa kasutaja',
'button.add_project' => 'Lisa projekt',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Lisa klient',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Lisa',
'button.generate' => 'Loo',
'button.reset_password' => 'Tühjenda salasõna',
'button.send' => 'Saada',
'button.send_by_email' => 'Saada e-mailiga',
'button.create_team' => 'Loo meeskond',
'button.export' => 'Ekspordi meeskond',
'button.import' => 'Impordi meeskond',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Valuuta',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Nimi',
'label.thing_name' => 'Nimi',
'label.login' => 'Login',
'label.password' => 'Salasõna',
'label.confirm_password' => 'Kinnita salasõna',
// TODO: translate the following.
// 'label.email' => 'Email',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Teema',
'label.date' => 'Kuupäev',
'label.start_date' => 'Algab kuupäevast',
'label.end_date' => 'Lõpeb kuupäeval',
'label.user' => 'Kasutaja',
'label.users' => 'Kasutajad',
'label.client' => 'Klient',
'label.clients' => 'Kliendid',
// TODO: translate the following.
// 'label.option' => 'Option',
'label.invoice' => 'Arve',
'label.project' => 'Projekt',
'label.projects' => 'Projektid',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Algus',
'label.finish' => 'Lõpp',
'label.duration' => 'Kestus',
'label.note' => 'Märkus',
'label.notes' => 'Märkused',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
'label.week_total' => 'Nädalane summa',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Täna',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Muuda',
'label.delete' => 'Kustuta',
'label.configure' => 'Konfigureeri',
'label.select_all' => 'Vali kõik',
'label.select_none' => 'Märgi kõik mittevalituks',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Kommentaar',
'label.status' => 'Seisund',
'label.tax' => 'Maks',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Kokku',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'või',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* nõutud väljad',
// TODO: translate the following.
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(haldur)',
'label.role_comanager' => '(kaashaldur)',
'label.role_admin' => '(administraator)',
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
'label.fav_report' => 'Lemmikraport',
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
// TODO: Improve titles for consistency, so that each title explains correctly what each
// page is about and is "consistent" from page to page, meaning that correct grammar is used everywhere.
// Compare with English file to see how it is done there and do Estonian titles similarly.
// Specifically: lisamine vs lisa, etc.
'title.login' => 'Login',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Tühjenda salasõna',
// TODO: translate the following.
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
'title.reports' => 'Raportid',
// TODO: translate the following.
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Arve',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projektid',
'title.add_project' => 'Projekti lisamine',
'title.edit_project' => 'Projekti muutmine',
'title.delete_project' => 'Projekti kustutamine',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Kasutajad',
// TODO: translate the following.
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
'title.clients' => 'Kliendid',
'title.add_client' => 'Lisa klient',
'title.edit_client' => 'Muuda klienti',
'title.delete_client' => 'Kustuta klient',
'title.invoices' => 'Arved',
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
'title.options' => 'Suvandid',
'title.profile' => 'Profiili',
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
'dropdown.all' => '--- kõik ---',
'dropdown.no' => '--- ei ---',
'dropdown.current_day' => 'täna',
'dropdown.previous_day' => 'eile',
'dropdown.selected_day' => 'päev',
'dropdown.current_week' => 'käesolev nädal',
'dropdown.previous_week' => 'eelmine nädal',
'dropdown.selected_week' => 'nädal',
'dropdown.current_month' => 'käesolev kuu',
'dropdown.previous_month' => 'eelmine kuu',
'dropdown.selected_month' => 'kuu',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => 'kõik ajad',
'dropdown.projects' => 'projektid',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'kliendid',
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
'form.login.forgot_password' => 'Unustasid salasõna?',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasõna tühjendamise käsk edastatud.', // TODO: add "by email" to match the English string.
// TODO: translate the following.
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Arvestatav',
// TODO: translate the following.
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
'form.reports.save_as_favorite' => 'Salvesta lemmikuna',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_billable' => 'arvestatav',
'form.reports.include_not_billable' => 'mittearvestatav',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Vali ajaperiood',
'form.reports.set_period' => 'või märgi kuupäevad',
'form.reports.show_fields' => 'Näita välju',
'form.reports.group_by' => 'Grupeeri',
'form.reports.group_by_no' => '--- ilma grupeerimata ---',
'form.reports.group_by_date' => 'kuupäev',
'form.reports.group_by_user' => 'kasutaja',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projekt',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Ainult summad',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Eksportimine', // TODO: is this correct? We want a verb as in "Export XML" - see report export options.
                                        // The current combined English string is "Export PDF, XML or CSV".
                                        // Meaning: user can have a displayed report in these formats.
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
'form.export.hint' => 'Võid kogu meeskonna andmed eksportida xml-faili. Sellest võib olla kasu kui vahetad serverit.',
'form.export.compression' => 'Pakkimine',
// TODO: translate the following.
// 'form.export.compression_none' => 'none',
'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: translate the following.
// 'form.import.hint' => 'Import team data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: translate the following.
// 'form.teams.hint' =>  'Create a new team by creating a new team manager account.<br>You can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',



// TODO: refactoring ongoing down from here.

// administrator form
"form.admin.profile.title" => 'meeskonnad',
"form.admin.profile.noprofiles" => 'sinu andmebaas on tühi. logi adminina sisse ja loo uus meeskond.',
"form.admin.profile.comment" => 'kustuta meeskond',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'aktiivne',

// my time form attributes
"form.mytime.title" => 'minu aeg',
"form.mytime.edit_title" => 'ajakande muutmine',
"form.mytime.del_str" => 'ajakande kustutamine',
"form.mytime.total" => 'tunde kokku: ',
"form.mytime.del_yes" => 'ajakanne kustutatud',
"form.mytime.no_finished_rec" => 'kanne salvestati ainult alguse ajaga. see ei ole viga. logi välja kui vaja peaks olema.',
"form.mytime.warn_tozero_rec" => 'see ajakanne tuleb kustutada kuna see ajaperiood on lukustatud',
// Note to translators: the string below must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'loo uus halduri konto',
"form.profile.edit_title" => 'profiili muutmine',

// people form attributes
"form.people.ppl_str" => 'inimesed',
"form.people.createu_str" => 'loo uus kasutaja',
"form.people.edit_str" => 'kasutaja muutmine',
"form.people.del_str" => 'kasutaja kustutamine',
"form.people.th.role" => 'roll',
"form.people.th.rate" => 'hind',
"form.people.manager" => 'haldur',
"form.people.comanager" => 'kaashaldur',

"form.people.rate" => 'vaikimisi tunni hind',
"form.people.comanager" => 'kaashaldur',

// report attributes
"form.report.total" => 'tunde kokku',

// mail form attributes
"form.mail.from" => 'kellelt',
"form.mail.to" => 'kellele',
"form.mail.above" => 'saada aruanne e-mailiga',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>teade saadetud</b>',

// invoice attributes
"form.invoice.title" => 'arve',
"form.invoice.caption" => 'arve',
"form.invoice.above" => 'lisainformatsioon arvele',
"form.invoice.select_cust" => 'vali klient',
"form.invoice.fillform" => 'täida väljad',
"form.invoice.number" => 'arve number',
"form.invoice.th.username" => 'isik',
"form.invoice.th.time" => 'tunde',
"form.invoice.th.rate" => 'hind',
"form.invoice.th.summ" => 'summa',
"form.invoice.subtotal" => 'vahesumma',
"form.invoice.customer" => 'klient',
"form.invoice.mailinv_above" => 'saada see arve e-mailiga',
"form.invoice.sending_str" => '<b>arve saadetud</b>',

"form.migration.file" => 'vali fail',
"form.migration.import.title" => 'impordi andmed',
"form.migration.import.success" => 'andmed imporditud',
"form.migration.import.text" => 'impordi meeskonna andmed xml-failist',
"form.migration.export.title" => 'ekspordi andmed',
"form.migration.export.success" => 'andmed eksporditud',
);
