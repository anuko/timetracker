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

$i18n_language = 'Norsk';
$i18n_months = array('Januar', 'Februar', 'Mars', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Desember');
$i18n_weekdays = array('Søndag', 'Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lørdag');
// TODO: check translation of $i18n_weekdays_short.
$i18n_weekdays_short = array('Sø', 'Ma', 'Ti', 'On', 'To', 'Fr', 'Lø');
// format mm/dd
$i18n_holidays = array('01/01', '04/05', '04/09', '04/10', '04/12', '04/13', '05/01', '05/17', '05/21', '05/31', '06/01', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Innlogging',
'menu.logout' => 'Logg ut',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Hjelp',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
'menu.time' => 'Tid',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Rapporter',
'menu.charts' => 'Diagrammer',
'menu.projects' => 'Prosjekter',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
// 'menu.teams' => 'Teams',
'menu.export' => 'Eksport',
'menu.clients' => 'Klienter',
'menu.options' => 'Opsjoner',

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
'error.db' => 'Databasefeil.',
'error.field' => 'Feil "{0}" data.',
'error.empty' => 'Feltet "{0}" er tomt.',
'error.not_equal' => 'Feltet "{0}" stemmer ikke med "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Velg prosjekt.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Velg klient.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Feil brukernavn eller passord.',
'error.user_exists' => 'Bruker med et slikt brukernavn eksisterer allerede.',
'error.project_exists' => 'Et prosjekt med dette navnet er allerede opprettet.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => 'En klient med dette navnet er allerede opprettet.',
// TODO: translate the following.
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
'error.no_login' => 'Det er ingen bruker med dette brukernavnet.',
// TODO: translate the following.
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Feil med lasting av fil.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Feil ved sending av e-post.',
'error.no_email' => 'Det er ingen e-post knyttet til dette brukernavnet.',
'error.uncompleted_exists' => 'Ufullført registrering finnes allerede. Lukk eller slett den.',
'error.goto_uncompleted' => 'Gå til ufullført registrering.',
// TODO: translate the following.
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Innlogging',
'button.now' => 'Nå',
'button.save' => 'Lagre',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Avbryt',
// TODO: translate the following.
// 'button.submit' => 'Submit',
'button.add_user' => 'Legg til bruker',
'button.add_project' => 'Legg til prosjekt',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Legg til klient',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Legg til',
'button.generate' => 'Generer',
'button.reset_password' => 'Resett passord',
'button.send' => 'Send',
'button.send_by_email' => 'Send som e-post',
'button.create_team' => 'Opprett team',
'button.export' => 'Eksport team',
'button.import' => 'Importer team',
'button.close' => 'Lukk',
// TODO: translate the following.
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Valuta',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Navn',
'label.thing_name' => 'Navn',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Passord',
'label.confirm_password' => 'Bekreft passord',
'label.email' => 'E-post',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Emne',
// TODO: translate the following.
// 'label.date' => 'Date',
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
// 'label.user' => 'User',
// 'label.users' => 'Users',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
'label.project' => 'Prosjekt',
'label.projects' => 'Prosjekter',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
// 'label.start' => 'Start',
// 'label.finish' => 'Finish',
// 'label.duration' => 'Duration',
'label.note' => 'Notat',
'label.notes' => 'Notater',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
'label.week_total' => 'Uken totalt',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'I dag',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Endre',
'label.delete' => 'Slett',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Kommentar',
'label.status' => 'Status',
'label.tax' => 'MVA',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
// 'label.total' => 'Total',
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'eller',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* obligatoriske felt',
'label.on_behalf' => 'på vegne av',
// TODO: translate the following.
// 'label.role_manager' => '(manager)',
// 'label.role_comanager' => '(co-manager)',
// 'label.role_admin' => '(administrator)',
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
'label.fav_report' => 'Favoritt rapport',
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
'title.login' => 'Innlogging',
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
// 'title.reports' => 'Reports',
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Prosjekter',
'title.add_project' => 'Legg til prosjekt',
'title.edit_project' => 'Endre prosjekt',
'title.delete_project' => 'Slett prosjekt',
// TODO: translate the following.
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
// 'title.options' => 'Options',
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
// 'title.week_view' => 'Week View',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
// TODO: translate the following.
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
// 'dropdown.current_week' => 'this week',
// 'dropdown.previous_week' => 'previous week',
// 'dropdown.selected_week' => 'week',
// 'dropdown.current_month' => 'this month',
// 'dropdown.previous_month' => 'previous month',
// 'dropdown.selected_month' => 'month',
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'prosjekter',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Glemt passordet?',
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
'form.time.billable' => 'Fakturerbar',
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
'form.reports.save_as_favorite' => 'Lagre som favoritt',
'form.reports.confirm_delete' => 'Er du sikker på at du vil slette denne favorittrapporten?',
'form.reports.include_billable' => 'fakturerbar',
'form.reports.include_not_billable' => 'ikke fakturerbar',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Velg tidsperiode',
'form.reports.set_period' => 'eller sett dato',
'form.reports.show_fields' => 'Vis feltene',
// 'form.reports.group_by' => 'Group by',
// 'form.reports.group_by_no' => '--- no grouping ---',
// 'form.reports.group_by_date' => 'date',
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
// 'form.reports.group_by_project' => 'project',
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: translate the following.
// 'form.report.export' => 'Export',
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



// TODO: refactoring ongoing down from here.

// password reminder form attributes
"form.fpass.login" => 'innlogging',
"form.fpass.send_pass_str" => 'passordet er sendt',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker passordet ditt',
// Note to translators: strings below need to be translated.
// "form.fpass.send_pass_body" => "Kjære bruker,\n\nNoen, trolig deg, bad om å få ditt Anuko Time Tracker password resatt. Vær vennlig å besøk denne lenken dersom du ønsker at passordet ditt skal resettes.\n\n%s\n\nAnuko Time Tracker er et enkelt og brukervennlig system for tidsregistrering basert på åpen kildekode. Les mer på https://www.anuko.com.\n\n",
// "form.fpass.reset_comment" => "vennligst skriv inn passordet og klikk på lagre for å resette passsordet.",

// Note to translators: the strings below must be translated
// // administrator form
// "form.admin.title" => 'administrator',
// "form.admin.duty_text" => 'opprett et nytt team ved å opprette en ny team manager konto.<br>du kan også importere team data fra en xml fil fra en annen Anuko Time Tracker server (ingen login kollisjoner er tillatt).',

// "form.admin.profile.title" => 'team',
// "form.admin.profile.noprofiles" => 'databasen din er tom. logg inn som admin og opprett et nytt team.',
// "form.admin.profile.comment" => 'slett team',
// "form.admin.profile.th.id" => 'id',
// "form.admin.profile.th.active" => 'aktiv',
// "form.admin.options" => 'opsjoner',
// "form.admin.custom_date_format" => "datoformat",
// "form.admin.custom_time_format" => "tidsformat",
// "form.admin.start_week" => "første ukedag",

// my time form attributes
// Note to translators: the 2 strings below must be translated
// "form.mytime.title" => 'min tid',
// "form.mytime.edit_title" => 'endre tidsoppføringen',
"form.mytime.del_str" => 'slett tids oppføringen',
"form.mytime.time_form" => ' (tt:mm)',
// Note to translators: "form.mytime.date" => 'dato', // the string must be translated
"form.mytime.start" => 'starttid',
"form.mytime.finish" => 'ferdig',
"form.mytime.duration" => 'varighet',
"form.mytime.daily" => 'daglig arbeide',
"form.mytime.total" => 'totalt antall timer: ',
"form.mytime.th.start" => 'starttid',
"form.mytime.th.finish" => 'ferdig',
"form.mytime.th.duration" => 'varighet',
// Note to translators: the strings below must be translated
// "form.mytime.del_yes" => 'tidsoppføringen er slettet', 
// "form.mytime.no_finished_rec" => 'Denne oppføringen ble lagret kun med starttid. Det er ikke en feil. Logg ut om nødvendig.',
// "form.mytime.warn_tozero_rec" => 'Denne oppføringen må slettes fordi tidsperioden er låst',
// "form.mytime.uncompleted" => 'uferdig',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'lag ny adminkonto',
"form.profile.edit_title" => 'endre profil',
"form.profile.login" => 'innlogging',

// Note to translators: the strings below are missing and must be added and translated
// "form.profile.showchart" => 'vis kakediagram',
// "form.profile.lang" => 'språk',
// "form.profile.custom_date_format" => "dato format",
// "form.profile.custom_time_format" => "tims format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "første dag i uken",

// people form attributes
"form.people.ppl_str" => 'personer',
"form.people.createu_str" => 'legg til ny bruker',
"form.people.edit_str" => 'endre bruker',
"form.people.del_str" => 'slett bruker',
"form.people.th.login" => 'innlogging',
"form.people.th.role" => 'rolle',
// Note to translators: the 2 strings below are missing and must be added and translated
// "form.people.th.rate" => 'timesats',
// Note to translators: the strings below must be correctly translated
// "form.people.manager" => 'admin',
// "form.people.comanager" => 'co-manager',
"form.people.empl" => 'bruker',
"form.people.login" => 'innlogging',
"form.people.rate" => 'timesats',

// report attributes
"form.report.title" => 'rapporter',
"form.report.from" => 'starttid',
"form.report.to" => 'ferdig',
"form.report.groupby_user" => 'bruker',
"form.report.groupby_project" => 'prosjekt',
"form.report.duration" => 'varighet',
"form.report.start" => 'starttid',
"form.report.finish" => 'ferdig',
// Note to translators: the strings below must be translated 
// "form.report.totals_only" => 'kun summer',
"form.report.total" => 'totalt antall timer',
"form.report.th.empllist" => 'bruker',
"form.report.th.date" => 'dato',
"form.report.th.start" => 'starttid',
"form.report.th.finish" => 'ferdig',
"form.report.th.duration" => 'varighet',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.above" => 'send denne rapporten som e-post',
// Note to translators: the strings below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker is et enkelt, brukervennlig tidsregistreringssystem<br>basert på åpen kildekode. Besøk <a href="https://www.anuko.com">www.anuko.com</a> for flere opplysninger.',
// "form.mail.sending_str" => '<b>the message has been sent</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'tilleggsinformasjon for faktura',
// Note to translators: the strings below are missing and must be added and translated
// "form.invoice.select_cust" => 'velg klient',
// "form.invoice.fillform" => 'fyll inn i feltene',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'fakturanummer',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'sats',
"form.invoice.th.summ" => 'antall',
"form.invoice.subtotal" => 'delsum',
"form.invoice.customer" => 'kommentar',
"form.invoice.mailinv_above" => 'send denne fakturaen som e-post',
// Note to translators: "form.invoice.sending_str" => '<b>invoice has been sent</b>', // the string must be translated

// Note to translators: the strings below are missing and must be added and translated
// "form.migration.zip" => 'komprimering',
// "form.migration.file" => 'velg fil',
// "form.migration.import.title" => 'import data',
// "form.migration.import.success" => 'import gjennomført vellykket',
// "form.migration.import.text" => 'import team data fra en xml fil',
// "form.migration.export.title" => 'export data',
// "form.migration.export.success" => 'eksport gjennomført vellykket',
// "form.migration.export.text" => 'du kan eksportere alle team data til en XML fil. dette kan være nyttig dersom du skal migrere data til din egen server.',
// "form.migration.compression.none" => 'ingen',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

// "form.client.title" => 'klienter',
// "form.client.add_title" => 'legg til klient',
// "form.client.edit_title" => 'endre klient',
// "form.client.del_title" => 'slett klient',

// miscellaneous strings
"forward.tocsvfile" => 'eksporter data til en .csv fil',
// Note to translators: the strings below are missing and must be translated and added
// "forward.toxmlfile" => 'eksporter data til en .xml fil',
// "forward.geninvoice" => 'lag faktura',

"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
// Note to translators: the strings below are missing and must be translated and added 
// "controls.notbind" => '--- no ---',
"controls.per_tm" => 'denne måneden',
"controls.per_lm" => 'forrige måned',
"controls.per_tw" => 'denne uken',
"controls.per_lw" => 'forrige uke',
// Note to translators: the strings below are missing and must be translated and added
// "controls.per_td" => 'i dag',
// "controls.per_at" => 'all tid',
// "controls.per_ty" => 'dette årr',

"label.inv_str" => 'faktura',
"label.set_empl" => 'velg brukere',
// Note to translators: the strings below are missing and must be translated and added
// "label.sel_all" => 'velg alle',
// "label.sel_none" => 'velg ingen',
// "label.disable" => 'slå av',
// "label.enable" => 'slå på',
// "label.hrs" => 'timer',
// "label.errors" => 'feil',
// "label.ldap_hint" => 'Skriv din <b>Windows login</b> og <b>passord</b> i feltene nedenfor.',

// login hello text
// "login.hello.text" => "Anuko Time Tracker er et enkelt, brukervennlig tidsregistreringssystem basert på åpen kildekode.",
);
