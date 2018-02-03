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
// 'menu.users' => 'Users',
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
// 'error.client' => 'Select client.',
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
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
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
'label.project' => 'Projekt',
// TODO: translate the following.
// 'label.projects' => 'Projects',
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
// 'label.start' => 'Start',
// 'label.finish' => 'Finish',
// 'label.duration' => 'Duration',
// 'label.note' => 'Note',
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => 'Täna',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Muuda',
'label.delete' => 'Kustuta',
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
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Kokku',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
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
// 'label.fav_report' => 'Favorite report',
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
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
// 'title.projects' => 'Projects',
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
'title.options' => 'Suvandid',
// TODO: translate the following.
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
// 'dropdown.projects' => 'projects',
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
// TODO: translate the following.
// 'form.login.forgot_password' => 'Forgot password?',
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",



// TODO: refactoring ongoing down from here.

"form.filter.project" => 'projekt',
"form.filter.filter" => 'lemmikraport',
"form.filter.filter_new" => 'salvesta lemmikuna',
// Note to translators: the string below is missing and must be added to the translation
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// password reminder form attributes
"form.fpass.title" => 'tühjenda salasõna',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'salasõna tühjendamise käsk edastatud',
// Note to translators: the 3 strings below must be translated
// "form.fpass.send_pass_subj" => 'AnukoTime Tracker password reset request',
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'administraator',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new meeskond by creating a new meeskond manager account.<br>you can also import meeskond data from an xml file from another Anuko time tracker server (no e-mail collisions are allowed).',

"form.admin.change_pass" => 'muuda administraatori konto salasõna',
"form.admin.profile.title" => 'meeskonnad',
"form.admin.profile.noprofiles" => 'sinu andmebaas on tühi. logi adminina sisse ja loo uus meeskond.',
"form.admin.profile.comment" => 'kustuta meeskond',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'aktiivne',
// Note to translators: the strings below are missing in the translation and must be translated
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'minu aeg',
"form.mytime.edit_title" => 'ajakande muutmine',
"form.mytime.del_str" => 'ajakande kustutamine',
// Note to translators: the string below must be translated
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'kuupäev',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tegevus',
"form.mytime.start" => 'algus',
"form.mytime.finish" => 'lõpp',
"form.mytime.duration" => 'kestus',
"form.mytime.note" => 'märkus',
// Note to translators: "form.mytime.behalf" => 'igapäevane töö', // the translation is incorrect
"form.mytime.daily" => 'igapäevane töö',
"form.mytime.total" => 'tunde kokku: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.start" => 'algus',
"form.mytime.th.finish" => 'lõpp',
"form.mytime.th.duration" => 'kestus',
"form.mytime.th.note" => 'märkus',
"form.mytime.del_yes" => 'ajakanne kustutatud',
"form.mytime.no_finished_rec" => 'kanne salvestati ainult alguse ajaga. see ei ole viga. logi välja kui vaja peaks olema.',
"form.mytime.billable" => 'arvestatav',
"form.mytime.warn_tozero_rec" => 'see ajakanne tuleb kustutada kuna see ajaperiood on lukustatud',
// Note to translators: the string below must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'loo uus halduri konto',
"form.profile.edit_title" => 'profiili muutmine',
"form.profile.login" => 'login',

// Note to translators: the strings below must be translated and added to the localization file
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'inimesed',
"form.people.createu_str" => 'loo uus kasutaja',
"form.people.edit_str" => 'kasutaja muutmine',
"form.people.del_str" => 'kasutaja kustutamine',
"form.people.th.login" => 'login',
"form.people.th.role" => 'roll',
"form.people.th.status" => 'seisund',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'hind',
"form.people.manager" => 'haldur',
"form.people.comanager" => 'kaashaldur',
"form.people.empl" => 'kasutaja',
"form.people.login" => 'login',

"form.people.rate" => 'vaikimisi tunni hind',
"form.people.comanager" => 'kaashaldur',
"form.people.projects" => 'projektid',

// projects form attributes
"form.project.proj_title" => 'projektid',
"form.project.edit_str" => 'projektide muutmine',
"form.project.add_str" => 'uue projekti lisamine',
"form.project.del_str" => 'projekti kustutamine',

// activities form attributes
"form.activity.project" => 'projekt',

// report attributes
"form.report.from" => 'algab kuupäevast',
"form.report.to" => 'lõpeb kuupäeval',
"form.report.groupby_user" => 'kasutaja',
"form.report.groupby_project" => 'projekt',
"form.report.duration" => 'kestus',
"form.report.start" => 'algus',
"form.report.finish" => 'lõpp',
"form.report.note" => 'märkus',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'ainult summad',
"form.report.total" => 'tunde kokku',
"form.report.th.empllist" => 'kasutaja',
"form.report.th.date" => 'kuupäev',
"form.report.th.project" => 'projekt',
"form.report.th.start" => 'algus',
"form.report.th.finish" => 'lõpp',
"form.report.th.duration" => 'kestus',
"form.report.th.note" => 'märkus',

// mail form attributes
"form.mail.from" => 'kellelt',
"form.mail.to" => 'kellele',
"form.mail.comment" => 'märkus',
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
"form.invoice.date" => 'kuupäev',
"form.invoice.number" => 'arve number',
"form.invoice.tax" => 'maks',
"form.invoice.comment" => 'kommentaar ',
"form.invoice.th.username" => 'isik',
"form.invoice.th.time" => 'tunde',
"form.invoice.th.rate" => 'hind',
"form.invoice.th.summ" => 'summa',
"form.invoice.subtotal" => 'vahesumma',
"form.invoice.customer" => 'klient',
"form.invoice.mailinv_above" => 'saada see arve e-mailiga',
"form.invoice.sending_str" => '<b>arve saadetud</b>',

"form.migration.zip" => 'pakkimine',
"form.migration.file" => 'vali fail',
"form.migration.import.title" => 'impordi andmed',
"form.migration.import.success" => 'andmed imporditud',
"form.migration.import.text" => 'impordi meeskonna andmed xml-failist',
"form.migration.export.title" => 'ekspordi andmed',
"form.migration.export.success" => 'andmed eksporditud',
"form.migration.export.text" => 'võid kogu meeskonna andmed eksportida xml-faili. sellest võib olla kasu kui vahetad serverit.',
// Note to translators: the string below must be translated and added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kliendid',
"form.client.add_title" => 'lisa klient',
"form.client.edit_title" => 'muuda klienti',
"form.client.del_title" => 'kustuta klient',
"form.client.tax" => 'maks',
"form.client.comment" => 'märkus ',

// miscellaneous strings
"forward.forgot_password" => 'unustasid salasõna?',
"forward.tocsvfile" => 'ekspordi andmed .csv faili',
"forward.toxmlfile" => 'ekspordi andmed .xml faili',
"forward.geninvoice" => 'loo arve',
"forward.change" => 'konfigureeri kliendid',

// strings inside contols on forms
"controls.select.project" => '--- vali projekt ---',
"controls.select.activity" => '--- vali tegevus ---',
"controls.select.client" => '--- vali klient ---',
"controls.project_bind" => '--- kõik ---',
"controls.all" => '--- kõik ---',
"controls.notbind" => '--- ei ---',
"controls.per_tm" => 'käesolev kuu',
"controls.per_lm" => 'eelmine kuu',
"controls.per_tw" => 'käesolev nädal',
"controls.per_lw" => 'eelmine nädal',
"controls.per_td" => 'täna',
"controls.per_at" => 'kõik ajad',
// Note to translators: the string below must be translated and added
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- vali ajaperiood ---',
"controls.sel_groupby" => '--- ilma grupeerimata ---',
"controls.inc_billable" => 'arvestatav',
"controls.inc_nbillable" => 'mittearvestatav',
// Note to translators: the string below must be translated and added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'tegevused kasutajal',
// Note to translators: the string below is missing and must be translated and added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'tabel perioodiks',

"label.req_fields" => '* nõutud väljad',
"label.sel_project" => 'vali projekt',
"label.sel_activity" => 'vali tegevus',
"label.sel_tp" => 'vali ajaperiood',
"label.set_tp" => 'või märgi kuupäevad',
"label.fields" => 'näita välju',
"label.group_title" => 'grupeeri',
"label.include_title" => 'kaasa kanded',
"label.inv_str" => 'arved',
"label.set_empl" => 'vali kasutajad',
"label.sel_all" => 'vali kõik',
"label.sel_none" => 'märgi kõik mittevalituks',
"label.or" => 'või',
"label.disable" => 'keela',
"label.enable" => 'luba',
"label.filter" => 'filtreeri',
"label.timeweek" => 'nädalane summa',
);
