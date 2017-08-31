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

// Note to translators: Please use proper capitalization rules for your language.

$i18n_language = 'Dansk';
$i18n_months = array('Januar', 'Februar', 'Marts', 'April', 'Maj', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'December');
$i18n_weekdays = array('Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag');
$i18n_weekdays_short = array('Sø', 'Ma', 'Ti', 'On', 'To', 'Fr', 'Lø');
// format mm/dd
$i18n_holidays = array('01/01', '04/09', '04/10', '04/12', '04/13', '05/08', '05/21', '05/31', '06/01', '06/05', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'Log ind',
'menu.logout' => 'Log ud',
'menu.forum' => 'Forum',
'menu.help' => 'Hjælp',
'menu.create_team' => 'Lav et team',
'menu.profile' => 'Profil',
'menu.time' => 'Tid',
'menu.expenses' => 'Udgifter',
'menu.reports' => 'Rapporter',
'menu.charts' => 'Diagrammer',
'menu.projects' => 'Projekter',
'menu.tasks' => 'Opgaver',
'menu.users' => 'Brugere',
'menu.teams' => 'Teams',
'menu.export' => 'Eksport',
'menu.clients' => 'Kunder',
'menu.options' => 'Indstillinger',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Du kan bidrage til Time Tracker på mange forskellige måder.',
'footer.credits' => 'Medvirkende',
'footer.license' => 'Licens',
'footer.improve' => 'Bidrag',

// Error messages.
'error.access_denied' => 'Adgang nægtet.',
'error.sys' => 'System fejl.',
'error.db' => 'Database fejl.',
'error.field' => 'Forkert "{0}" data.',
'error.empty' => 'Felt "{0}" er tom.',
'error.not_equal' => 'Felt "{0}" er ikke lig med "{1}".',
'error.interval' => 'Felt "{0}" skal være større end "{1}".',
'error.project' => 'Vælg projekt.',
'error.task' => 'Vælg opgave.',
'error.client' => 'Vælg klient.',
'error.report' => 'Vælg rapport.',
'error.auth' => 'Forkert brugernavn eller adgangskode.',
'error.user_exists' => 'Brugernavn eksistere allerede.',
'error.project_exists' => 'Der eksiterer allerede et projekt med det navn.',
'error.task_exists' => 'Opgavenavn eksistere allerede.',
'error.client_exists' => 'Der eksistere allerede en klient med dette navn.',
'error.invoice_exists' => 'Fakturanummer eksistere allerede.',
'error.no_invoiceable_items' => 'Der er ingen fakturerbar emner.',
'error.no_login' => 'Ingen bruger med denne login.',
'error.no_teams' => 'Din database er tom, login som administrator og lav et nyt team.',
'error.upload' => 'Fil upload problem.',
'error.range_locked' => 'Dato interval er spærret.',
'error.mail_send' => 'Fejl under sending af mail.',
'error.no_email' => 'Der er ingen email tilknyttet dette brugernavn.',
'error.uncompleted_exists' => 'Uafsluttet registrering eksistere allerede. Luk eller slet det.',
'error.goto_uncompleted' => 'Gå til uafsluttet registrering.',
'error.overlap' => 'Tidsinterval overlapper eksisterende poster.',
'error.future_date' => 'Datoen er ud i fremtiden.',

// Labels for buttons.
'button.login' => 'Log ind',
'button.now' => 'Nu',
'button.save' => 'Gem',
'button.copy' => 'Kopiér',
'button.cancel' => 'Fortryd',
'button.submit' => 'Gem',
'button.add_user' => 'Tilføj bruger',
'button.add_project' => 'Tilføj project',
'button.add_task' => 'Tilføj opgave',
'button.add_client' => 'Tilføj kunde',
'button.add_invoice' => 'Tilføj faktura',
'button.add_option' => 'Tilføj mulighed',
'button.add' => 'Tilføj',
'button.generate' => 'Generer',
'button.reset_password' => 'Nulstil adgangskode',
'button.send' => 'Send',
'button.send_by_email' => 'Send som e-mail',
'button.create_team' => 'Lav et team',
'button.export' => 'Exporter team',
'button.import' => 'Importer team',
'button.close' => 'Luk',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Team navn',
// TODO: Translate the following.
// 'label.address' => 'Address',
'label.currency' => 'Møntfod',
// TODO: Translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Navn',
'label.thing_name' => 'Navn',
'label.login' => 'Login',
'label.password' => 'Adgangskode',
'label.confirm_password' => 'Gentag adgangskode',
'label.email' => 'E-mail',
'label.date' => 'Dato',
// TODO: Translate the following.
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
'label.user' => 'Bruger',
'label.users' => 'Brugere',
// TODO: Translate the following.
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
'label.project' => 'Projekt',
'label.projects' => 'Projekter',
// TODO: Translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Start',
'label.finish' => 'Slut',
'label.duration' => 'Varighed',
'label.note' => 'Notat',
// TODO: Translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
// 'label.today' => 'Today',
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Rediger',
'label.delete' => 'Slet',
// TODO: Translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
'label.id' => 'ID',
// TODO: Translate the following.
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'Dato format',
'label.time_format' => 'Tids format',
'label.week_start' => 'Første dag i ugen',
// TODO: Translate the following.
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
// 'label.total' => 'Total',
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
// 'label.role_manager' => '(manager)',
// 'label.role_comanager' => '(co-manager)',
'label.role_admin' => '(administrator)',
// TODO: Translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// 'label.custom_fields' => 'Custom fields',
// 'label.monthly_quotas' => 'Monthly quotas',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
'label.fav_report' => 'Favorit rapport',
// TODO: Translate the following.
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',


// Form titles.
'title.login' => 'Login',
// TODO: Translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
// 'title.reset_password' => 'Resetting Password',
// 'title.change_password' => 'Changing Password',
'title.time' => 'Tid',
// TODO: Translate the following.
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
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projekter',
// TODO: Translate the following.
// 'title.add_project' => 'Adding Project',
// 'title.edit_project' => 'Editing Project',
// 'title.delete_project' => 'Deleting Project',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
// 'title.users' => 'Users',
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
// 'title.clients' => 'Clients',
// 'title.add_client' => 'Adding Client',
// 'title.edit_client' => 'Editing Client',
// 'title.delete_client' => 'Deleting Client',
// 'title.invoices' => 'Invoices',
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
'title.options' => 'Indstillinger',
// TODO: Translate the following.
// 'title.profile' => 'Profile',
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

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
// TODO: Translate the following.
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// NOTE TO TRANSLATORS: dropdown.this_day does not necessarily means "today". It means a specific ("this") day selected on calendar. See Charts.
// TODO: Translate the following.
// 'dropdown.this_day' => 'this day',
// 'dropdown.this_week' => 'this week',
// 'dropdown.last_week' => 'last week',
// 'dropdown.this_month' => 'this month',
// 'dropdown.last_month' => 'last month',
// 'dropdown.this_year' => 'this year',
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'projekter',
// TODO: Translate the following.
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'aktive',
// TODO: Translate the following.
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',

// Login form. See example at https://timetracker.anuko.com/login.php.
// TODO: Translate the following.
// 'form.login.forgot_password' => 'Forgot password?',
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: Translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: Translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: Translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
// 'form.time.billable' => 'Billable',
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
// TODO: Translate the following.
// 'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Gem som favorit',
'form.reports.confirm_delete' => 'Er du sikker på at du vil slette denne favorit rapport?',
// TODO: Translate the following.
// 'form.reports.include_records' => 'Include records',
// 'form.reports.include_billable' => 'billable',
// 'form.reports.include_not_billable' => 'not billable',
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
// 'form.reports.select_period' => 'Select time period',
// 'form.reports.set_period' => 'or set dates',
// 'form.reports.show_fields' => 'Show fields',
// 'form.reports.group_by' => 'Group by',
// 'form.reports.group_by_no' => '--- no grouping ---',
'form.reports.group_by_date' => 'dato',
'form.reports.group_by_user' => 'bruger',
// TODO: Translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projekt',
// TODO: Translate the following.
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: Translate the following.
// 'form.report.export' => 'Export',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
// TODO: Translate the following.
// 'form.invoice.number' => 'Invoice number',
// 'form.invoice.person' => 'Person',
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: Translate the following.
// 'form.charts.interval' => 'Interval',
// 'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: Translate the following.
// 'form.projects.active_projects' => 'Active Projects',
// 'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
// TODO: Translate the following.
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: Translate the following.
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
// 'form.users.role' => 'Role',
// 'form.users.manager' => 'Manager',
// 'form.users.comanager' => 'Co-manager',
// 'form.users.rate' => 'Rate',
// 'form.users.default_rate' => 'Default hourly rate',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: Translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: Translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
// TODO: Translate the following.
// 'form.export.hint' => 'You can export all team data into an xml file. It could be useful if you are migrating data to your own server.',
// 'form.export.compression' => 'Compression',
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: Translate the following.
// 'form.import.hint' => 'Import team data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: Translate the following.
// 'form.teams.hint' =>  'Create a new team by creating a new team manager account.<br>You can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
// TODO: Translate the following.
// 'form.profile.12_hours' => '12 hours',
// 'form.profile.24_hours' => '24 hours',
// 'form.profile.tracking_mode' => 'Tracking mode',
'form.profile.mode_time' => 'tid',
'form.profile.mode_projects' => 'projekter',
// TODO: Translate the following.
// 'form.profile.mode_projects_and_tasks' => 'projects and tasks',
// 'form.profile.record_type' => 'Record type',
// 'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.profile.uncompleted_indicators_none' => 'do not show',
// 'form.profile.uncompleted_indicators_show' => 'show',
// 'form.profile.type_all' => 'all',
// 'form.profile.type_start_finish' => 'start and finish',
// 'form.profile.type_duration' => 'duration',
// 'form.profile.plugins' => 'Plugins',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
// TODO: Translate the following.
// 'form.mail.from' => 'From',
// 'form.mail.to' => 'To',
// 'form.mail.cc' => 'Cc',
// 'form.mail.subject' => 'Subject',
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
// 'form.mail.invoice_sent' => 'Invoice sent.',

// Quotas configuration form.
// TODO: Translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',


// TODO: refactoring ongoing down form here. All these below are old string, but perhaps we can reuse some of them above...

"form.mytime.total" => 'timer i alt: ',
"form.mytime.del_yes" => 'tids post slettet',
"form.mytime.no_finished_rec" => 'denne post er gemt med kun en start tid. Det er ikke nødvendigvis en fejl. Du kan nu logge af.',
// Note to translators: the 3 strings below are missing in the translation and need to be added
"form.mytime.billable" => 'Fakturerbar',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'Dan ny manager konot',
"form.profile.edit_title" => 'Rediger profil',
"form.profile.name" => 'Navn',
"form.profile.login" => 'Login', 

// Note to translators: the strings below are missing in the translation and need to be added
// "form.profile.showchart" => 'show pie charts',
"form.profile.lang" => 'Sprog',
"form.profile.custom_date_format" => "Dato format",
"form.profile.custom_time_format" => "Tids format",
// "form.profile.default_format" => "(default)",
"form.profile.start_week" => "Første dag i ugen",

// people form attributes
"form.people.ppl_str" => 'Brugere',
"form.people.createu_str" => 'Dan ny bruger',
"form.people.edit_str" => 'Rediger bruger',
"form.people.del_str" => 'Slet bruger',
"form.people.th.name" => 'Navn',
"form.people.th.login" => 'Login', 
"form.people.th.role" => 'rolle',
"form.people.th.edit" => 'rediger',
"form.people.th.del" => 'slet',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'rate',
"form.people.manager" => 'manager',
"form.people.comanager" => 'co-manager',
"form.people.empl" => 'bruger',
"form.people.name" => 'navn',
"form.people.login" => 'login', 

"form.people.rate" => 'standard tidsfaktor',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projekter',

// projects form attributes
"form.project.proj_title" => 'Projekter',
"form.project.edit_str" => 'Rediger projekter',
"form.project.add_str" => 'Tilføj projekt', 
"form.project.del_str" => 'Slet projekt',
"form.project.th.name" => 'Navn',
"form.project.th.edit" => 'Rediger',
"form.project.th.del" => 'Slet',
"form.project.name" => 'navn',

// activities form attributes
"form.activity.act_title" => 'Aktiviteter',
"form.activity.add_title" => 'Tilføj ny aktivitet', 
"form.activity.edit_str" => 'Rediger aktivitet',
"form.activity.del_str" => 'Slet aktivitet',
"form.activity.name" => 'Navn',
"form.activity.project" => 'Projekt',
"form.activity.th.name" => 'Navn',
"form.activity.th.project" => 'Projekt',
"form.activity.th.edit" => 'Rediger',
"form.activity.th.del" => 'Slet',

// report attributes
"form.report.title" => 'rapport',
"form.report.from" => 'start dato',
"form.report.to"=> 'slut dato',
"form.report.groupby_user" => 'bruger',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varighed',
"form.report.start" => 'start',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'Ledig tid',
"form.report.finish" => 'slut',
"form.report.note" => 'notat',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'kun totaler',
"form.report.total" => 'timer totalt',
"form.report.th.empllist" => 'bruger',
"form.report.th.date" => 'dato',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'slut',
"form.report.th.duration" => 'varighed',
"form.report.th.note" => 'notat',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'emne',
"form.mail.comment" => 'komment',
"form.mail.above" => 'send denne rapport pr. e-mail',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>E-mail sendt</b>',

// invoice attributes
"form.invoice.title" => 'Faktura',
"form.invoice.caption" => 'Faktura',
"form.invoice.above" => 'Yderligere information om faktura',
"form.invoice.select_cust" => 'Vælg kunde', 
"form.invoice.fillform" => 'udfyld felterne',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'Faktura nummer',
"form.invoice.tax" => 'Moms',
"form.invoice.comment" => 'Kommentar',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'rate',
"form.invoice.th.summ" => 'beløb', 
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'kunde',
"form.invoice.mailinv_above" => 'Send denne faktura pr. e-mail',
"form.invoice.sending_str" => '<b>Faktura sendt</b>',

"form.migration.zip" => 'komprimering',
"form.migration.file" => 'Vælg fil', 
"form.migration.import.title" => 'import data',
"form.migration.import.success" => 'import gennemført', 
"form.migration.import.text" => 'import team data fra en xml fil',
"form.migration.export.title" => 'Eksport data',
"form.migration.export.success" => 'Eksport gennemført', 
"form.migration.export.text" => 'Du kan eksporterer data til en xml fil. Dette kan være praktisk, hvis du flytter til egen server.', 
// Note to translators: the 3 strings below are missing in the translation and must be added
"form.migration.compression.none" => 'Ingen',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kunder',
"form.client.add_title" => 'tilføj kunde', 
"form.client.edit_title" => 'rediger kunde',
"form.client.del_title" => 'slet kunde',
"form.client.th.name" => 'navn',
"form.client.th.edit" => 'rediger',
"form.client.th.del" => 'slet',
"form.client.name" => 'naavn',
"form.client.tax" => 'Moms',
"form.client.comment" => 'kommenter ',

// miscellaneous strings
"forward.forgot_password" => 'Glemt adgangskode?',
"forward.edit" => 'rediger',
"forward.delete" => 'slet',
"forward.tocsvfile" => 'exporter data til .csv fil',
// Note to translators:  the string below is missing in the translation and must be added
"forward.toxmlfile" => 'Eksport data som xml fil',
"forward.geninvoice" => 'Dan faktura',
"forward.change" => 'Konfigurer kunder',

// strings inside contols on forms
"controls.select.project" => '--- vælg projekt ---',
"controls.select.activity" => '--- vælg aktivitet ---',
"controls.select.client" => '---  vælg kunde---',
"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
"controls.notbind" => '--- ingen ---',
"controls.per_tm" => 'denne mеned',
"controls.per_lm" => 'sidste mеned',
"controls.per_tw" => 'denne uge',
"controls.per_lw" => 'sidste uge',
// Note to translators: the 3 strings below are missing in the translation and must be added
"controls.per_td" => 'I dag',
"controls.per_at" => 'Total tid',
"controls.per_ty" => 'I år',
"controls.sel_period" => '--- vælg tids periode ---',
"controls.sel_groupby" => '--- vælg gruppe ---', 
// Note to translators: the 3 strings below are missing in the translation and must be added
"controls.inc_billable" => 'Fakturerbar',
"controls.inc_nbillable" => 'Ikke fakturerbar',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the 3 strings below are missing in the translation and must be added
"label.chart.title1" => 'Bruger aktiviteter',
"label.chart.title2" => 'Bruger projekter',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>pе vegne af %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'ingen input',
"label.today" => 'I dag',
"label.req_fields"=> '* krævede felter', 
"label.sel_project" => 'vælg projekt',
"label.sel_activity" => 'vælg aktivtet',
"label.sel_tp" => 'vælg periode',
"label.set_tp" => 'eller vælg datoer',
"label.fields" => 'Vis fleter',
"label.group_title" => 'gruper',
// Note to translators: the string below is missing in the translation and must be added
// "label.include_title" => 'include records',
"label.inv_str" => 'Faktura',
"label.set_empl" => 'vælg brugere',
"label.sel_all" => 'vælg alle',
"label.sel_none" => 'fravælg alle', 
"label.or" => 'eller',
"label.disable" => 'disable',
"label.enable" => 'enable',
"label.filter" => 'filtrer',
// Note to translators: strings below are missing in the translation and must be added
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',

// login hello text
"login.hello.text" => "Anuko Time Tracker er et let anvendeligt Open Source værktøj til tidsregistrering.",
);
