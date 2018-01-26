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

$i18n_language = 'English';
$i18n_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$i18n_weekdays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$i18n_weekdays_short = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '01/16', '02/20', '05/28', '07/04', '09/03', '10/10', '11/11', '11/24', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on the top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Login',
'menu.logout' => 'Logout',
'menu.forum' => 'Forum',
'menu.help' => 'Help',
'menu.create_team' => 'Create Team',
'menu.profile' => 'Profile',
'menu.time' => 'Time',
'menu.expenses' => 'Expenses',
'menu.reports' => 'Reports',
'menu.charts' => 'Charts',
'menu.projects' => 'Projects',
'menu.tasks' => 'Tasks',
'menu.users' => 'Users',
'menu.teams' => 'Teams',
'menu.export' => 'Export',
'menu.clients' => 'Clients',
'menu.options' => 'Options',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'Credits',
'footer.license' => 'License',
'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                  // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
'error.access_denied' => 'Access denied.',
'error.sys' => 'System error.',
'error.db' => 'Database error.',
'error.field' => 'Incorrect "{0}" data.',
'error.empty' => 'Field "{0}" is empty.',
'error.not_equal' => 'Field "{0}" is not equal to field "{1}".',
'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Select project.',
'error.task' => 'Select task.',
'error.client' => 'Select client.',
'error.report' => 'Select report.',
'error.record' => 'Select record.',
'error.auth' => 'Incorrect login or password.',
'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Project with this name already exists.',
'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => 'Client with this name already exists.',
'error.invoice_exists' => 'Invoice with this number already exists.',
'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'No user with this login.',
'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'File upload error.',
'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Error sending mail.',
'error.no_email' => 'No email associated with this login.',
'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
'error.goto_uncompleted' => 'Go to uncompleted entry.',
'error.overlap' => 'Time interval overlaps with existing records.',
'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Now',
'button.save' => 'Save',
'button.copy' => 'Copy',
'button.cancel' => 'Cancel',
'button.submit' => 'Submit',
'button.add_user' => 'Add user',
'button.add_project' => 'Add project',
'button.add_task' => 'Add task',
'button.add_client' => 'Add client',
'button.add_invoice' => 'Add invoice',
'button.add_option' => 'Add option',
'button.add' => 'Add',
'button.generate' => 'Generate',
'button.reset_password' => 'Reset password',
'button.send' => 'Send',
'button.send_by_email' => 'Send by e-mail',
'button.create_team' => 'Create team',
'button.export' => 'Export team',
'button.import' => 'Import team',
'button.close' => 'Close',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Team name',
'label.address' => 'Address',
'label.currency' => 'Currency',
'label.manager_name' => 'Manager name',
'label.manager_login' => 'Manager login',
'label.person_name' => 'Name',
'label.thing_name' => 'Name',
'label.login' => 'Login',
'label.password' => 'Password',
'label.confirm_password' => 'Confirm password',
'label.email' => 'Email',
'label.cc' => 'Cc',
'label.bcc' => 'Bcc',
'label.subject' => 'Subject',
'label.date' => 'Date',
'label.start_date' => 'Start date',
'label.end_date' => 'End date',
'label.user' => 'User',
'label.users' => 'Users',
'label.client' => 'Client',
'label.clients' => 'Clients',
'label.option' => 'Option',
'label.invoice' => 'Invoice',
'label.project' => 'Project',
'label.projects' => 'Projects',
'label.task' => 'Task',
'label.tasks' => 'Tasks',
'label.description' => 'Description',
'label.start' => 'Start',
'label.finish' => 'Finish',
'label.duration' => 'Duration',
'label.note' => 'Note',
'label.notes' => 'Notes',
'label.item' => 'Item',
'label.cost' => 'Cost',
'label.day_total' => 'Day total',
'label.week_total' => 'Week total',
'label.month_total' => 'Month total',
'label.today' => 'Today',
'label.total_hours' => 'Total hours',
'label.total_cost' => 'Total cost',
'label.view' => 'View',
'label.edit' => 'Edit',
'label.delete' => 'Delete',
'label.configure' => 'Configure',
'label.select_all' => 'Select all',
'label.select_none' => 'Deselect all',
'label.day_view' => 'Day view',
'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Language',
'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'Date format',
'label.time_format' => 'Time format',
'label.week_start' => 'First day of week',
'label.comment' => 'Comment',
'label.status' => 'Status',
'label.tax' => 'Tax',
'label.subtotal' => 'Subtotal',
'label.total' => 'Total',
'label.client_name' => 'Client name',
'label.client_address' => 'Client address',
'label.or' => 'or',
'label.error' => 'Error',
'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* - required fields',
'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(manager)',
'label.role_comanager' => '(co-manager)',
'label.role_admin' => '(administrator)',
'label.page' => 'Page',
'label.condition' => 'Condition',
'label.yes' => 'yes',
'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Custom fields',
'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'Type',
'label.type_dropdown' => 'dropdown',
'label.type_text' => 'text',
'label.required' => 'Required',
'label.fav_report' => 'Favorite report',
'label.cron_schedule' => 'Cron schedule',
'label.what_is_it' => 'What is it?',
'label.expense' => 'Expense',
'label.quantity' => 'Quantity',
'label.paid_status' => 'Paid status',
'label.paid' => 'Paid',
'label.mark_paid' => 'Mark paid',

// Form titles.
'title.login' => 'Login',
'title.teams' => 'Teams',
'title.create_team' => 'Creating Team',
'title.edit_team' => 'Editing Team',
'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Resetting Password',
'title.change_password' => 'Changing Password',
'title.time' => 'Time',
'title.edit_time_record' => 'Editing Time Record',
'title.delete_time_record' => 'Deleting Time Record',
'title.expenses' => 'Expenses',
'title.edit_expense' => 'Editing Expense Item',
'title.delete_expense' => 'Deleting Expense Item',
'title.predefined_expenses' => 'Predefined Expenses',
'title.add_predefined_expense' => 'Adding Predefined Expense',
'title.edit_predefined_expense' => 'Editing Predefined Expense',
'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => 'Reports',
'title.report' => 'Report',
'title.send_report' => 'Sending Report',
'title.invoice' => 'Invoice',
'title.send_invoice' => 'Sending Invoice',
'title.charts' => 'Charts',
'title.projects' => 'Projects',
'title.add_project' => 'Adding Project',
'title.edit_project' => 'Editing Project',
'title.delete_project' => 'Deleting Project',
'title.tasks' => 'Tasks',
'title.add_task' => 'Adding Task',
'title.edit_task' => 'Editing Task',
'title.delete_task' => 'Deleting Task',
'title.users' => 'Users',
'title.add_user' => 'Adding User',
'title.edit_user' => 'Editing User',
'title.delete_user' => 'Deleting User',
'title.clients' => 'Clients',
'title.add_client' => 'Adding Client',
'title.edit_client' => 'Editing Client',
'title.delete_client' => 'Deleting Client',
'title.invoices' => 'Invoices',
'title.add_invoice' => 'Adding Invoice',
'title.view_invoice' => 'Viewing Invoice',
'title.delete_invoice' => 'Deleting Invoice',
'title.notifications' => 'Notifications',
'title.add_notification' => 'Adding Notification',
'title.edit_notification' => 'Editing Notification',
'title.delete_notification' => 'Deleting Notification',
'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Exporting Team Data',
'title.import' => 'Importing Team Data',
'title.options' => 'Options',
'title.profile' => 'Profile',
'title.cf_custom_fields' => 'Custom Fields',
'title.cf_add_custom_field' => 'Adding Custom Field',
'title.cf_edit_custom_field' => 'Editing Custom Field',
'title.cf_delete_custom_field' => 'Deleting Custom Field',
'title.cf_dropdown_options' => 'Dropdown Options',
'title.cf_add_dropdown_option' => 'Adding Option',
'title.cf_edit_dropdown_option' => 'Editing Option',
'title.cf_delete_dropdown_option' => 'Deleting Option',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
'title.locking' => 'Locking',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- all ---',
'dropdown.no' => '--- no ---',
'dropdown.current_day' => 'today',
'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'day',
'dropdown.current_week' => 'this week',
'dropdown.previous_week' => 'previous week',
'dropdown.selected_week' => 'week',
'dropdown.current_month' => 'this month',
'dropdown.previous_month' => 'previous month',
'dropdown.selected_month' => 'month',
'dropdown.current_year' => 'this year',
'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'year',
'dropdown.all_time' => 'all time',
'dropdown.projects' => 'projects',
'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'clients',
'dropdown.select' => '--- select ---',
'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'active',
'dropdown.status_inactive' => 'inactive',
'dropdown.delete'=>'delete',
'dropdown.do_not_delete'=>'do not delete',
'dropdown.paid' => 'paid',
'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Forgot password?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Password reset request sent by email.',
'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Billable',
'form.time.uncompleted' => 'Uncompleted',
'form.time.remaining_quota' => 'Remaining quota',
'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Save as favorite',
'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_records' => 'Include records',
'form.reports.include_billable' => 'billable',
'form.reports.include_not_billable' => 'not billable',
'form.reports.include_invoiced' => 'invoiced',
'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Select time period',
'form.reports.set_period' => 'or set dates',
'form.reports.show_fields' => 'Show fields',
'form.reports.group_by' => 'Group by',
'form.reports.group_by_no' => '--- no grouping ---',
'form.reports.group_by_date' => 'date',
'form.reports.group_by_user' => 'user',
'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'project',
'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Totals only',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Export',
'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Invoice number',
'form.invoice.person' => 'Person',
'form.invoice.invoice_to_delete' => 'Invoice to delete',
'form.invoice.invoice_entries' => 'Invoice entries',
'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Interval',
'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Active Projects',
'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Active Tasks',
'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Active Users',
'form.users.inactive_users' => 'Inactive Users',
'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Role',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Rate',
'form.users.default_rate' => 'Default hourly rate',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Client to delete',
'form.client.client_entries' => 'Client entries',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Active Clients',
'form.clients.inactive_clients' => 'Inactive Clients',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'You can export all team data into an xml file. It could be useful if you are migrating data to your own server.',
'form.export.compression' => 'Compression',
'form.export.compression_none' => 'none',
'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Import team data from an xml file.',
'form.import.file' => 'Select file',
'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' =>  'Create a new team by creating a new team manager account.<br>You can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12 hours',
'form.profile.24_hours' => '24 hours',
'form.profile.tracking_mode' => 'Tracking mode',
'form.profile.mode_time' => 'time',
'form.profile.mode_projects' => 'projects',
'form.profile.mode_projects_and_tasks' => 'projects and tasks',
'form.profile.record_type' => 'Record type',
'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
'form.profile.uncompleted_indicators_none' => 'do not show',
'form.profile.uncompleted_indicators_show' => 'show',
'form.profile.type_all' => 'all',
'form.profile.type_start_finish' => 'start and finish',
'form.profile.type_duration' => 'duration',
'form.profile.plugins' => 'Plugins',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'From',
'form.mail.to' => 'To',
'form.mail.report_subject' => 'Time Tracker Report',
'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Invoice sent.',

// Quotas configuration form.
'form.quota.year' => 'Year',
'form.quota.month' => 'Month',
'form.quota.quota' => 'Quota',
'form.quota.workday_hours' => 'Hours in a work day',
'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',
);
