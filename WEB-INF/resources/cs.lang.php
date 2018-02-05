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

$i18n_language = 'Česky';
$i18n_months = array('Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');
$i18n_weekdays = array('Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota');
$i18n_weekdays_short = array('Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So');
// format mm/dd
$i18n_holidays = array('01/01', '04/13', '05/01', '05/08', '07/05', '07/06', '09/28', '10/28', '11/17', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Přihlásit',
'menu.logout' => 'Odhlásit',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Pomoc',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.time' => 'Time',
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Sestavy',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projekty',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'Týmy',
'menu.export' => 'Export',
'menu.clients' => 'Zákazníci',
// TODO: translate the following.
// 'menu.options' => 'Options',

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
'error.db' => 'Chyba databáze.',
'error.field' => 'Nesprávná "{0}" data.',
'error.empty' => 'Pole "{0}" je prázdné.',
'error.not_equal' => 'Pole "{0}" neodpovídá poli "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Výběr projektu.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Nesprávné jméno nebo heslo.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Projekt tohoto jména již existuje.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Chyba přenosu souboru.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Přihlásit',
'button.now' => 'Teď',
'button.save' => 'Uložit',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Zrušit',
'button.submit' => 'Uložit',
'button.add_user' => 'Přidat uživatele',
'button.add_project' => 'Přidat projekt',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Přidat zákazníka',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Přidat',
'button.generate' => 'Vytvořit',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Poslat',
'button.send_by_email' => 'Poslat e-mailem',
'button.create_team' => 'Vytvořit tým',
'button.export' => 'Exportovat tým',
'button.import' => 'Importovat tým',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Měna',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
// TODO: confirm that Jméno and Název are correct translations.
'label.person_name' => 'Jméno',
'label.thing_name' => 'Název',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Heslo',
'label.confirm_password' => 'Potvrdit heslo',
// TODO: translate the following.
// 'label.email' => 'Email',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Předmět',
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
// 'label.project' => 'Project',
'label.projects' => 'Projekty',
// TODO: translate the following.
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
'label.week_total' => 'Celkem za týden',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Dnes',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Upravit',
'label.delete' => 'Smazat',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
'label.language' => 'Jazyk',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Celkem',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'nebo',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* nutno vyplnit',
// TODO: translate the following.
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(manažer)',
'label.role_comanager' => '(co-manažer)',
'label.role_admin' => '(administrator)',
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
'label.fav_report' => 'Oblíbená sestava',
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
'title.login' => 'Přihlásit',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Resetovat heslo',
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
'title.reports' => 'Sestavy',
// TODO: translate the following.
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projekty',
// TODO: translate the following.
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
'dropdown.projects' => 'projekty',
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
'form.login.forgot_password' => 'Zapomenuté heslo?',
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
'form.time.billable' => 'K fakturaci',
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
// TODO: translate the following.
// 'form.reports.save_as_favorite' => 'Save as favorite',
'form.reports.confirm_delete' => 'Opravdu chceš vymazat tuto položku z oblíbených?',
'form.reports.include_billable' => 'k fakturaci',
'form.reports.include_not_billable' => 'mimo fakturaci',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Výberte období',
'form.reports.set_period' => 'nebo určete dny',
'form.reports.show_fields' => 'Zobrazit pole',
'form.reports.group_by' => 'Seskupit podle',
// TODO: translate the following.
// 'form.reports.group_by_no' => '--- no grouping ---',
// 'form.reports.group_by_date' => 'date',
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
// 'form.reports.group_by_project' => 'project',
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',


// TODO: refactoring ongoing down from here.

// password reminder form attributes
"form.fpass.title" => 'resetovat heslo',
"form.fpass.login" => 'přihlásit',
"form.fpass.send_pass_str" => 'zaslán požadavek k vymazání hesla',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker požadavek na vymazání hesla',
// Note to translators: this string needs to be translated.
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "pro změnu hesla jej napište a zvolte uložit",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'vytvořit nový tým prostřednictvím účtu týmového manažera.<br>můžete také importovat týmová data z xml souboru z jiného time tracker serveru (nejsou povoleny shody e-mailových adres!).',

"form.admin.change_pass" => 'změna hesla účtu administrator',
"form.admin.profile.title" => 'týmy',
"form.admin.profile.noprofiles" => 'vaše databáze je prázdná. přihlašte se jako admin a vytvořte nový tým.',
"form.admin.profile.comment" => 'smazat tým',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'aktovní',
// Note to translators: the strings below are missing in the translation and must be added
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'můj deník',
"form.mytime.edit_title" => 'upravit časový záznam',
"form.mytime.del_str" => 'smazat časový záznam',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'datum',
"form.mytime.project" => 'projekt',
"form.mytime.start" => 'začátek',
"form.mytime.finish" => 'konec',
"form.mytime.duration" => 'trvání',
"form.mytime.note" => 'poznámka',
"form.mytime.daily" => 'denní práce',
"form.mytime.total" => 'součet hodin: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.start" => 'začátek',
"form.mytime.th.finish" => 'konec',
"form.mytime.th.duration" => 'trvání',
"form.mytime.th.note" => 'poznámka',
"form.mytime.del_yes" => 'časový záznam úspěšně odstraněn',
"form.mytime.no_finished_rec" => 'záznam byl uložen pouze s časem zahájení. není to chyba. můžete se odhlásit, potřebujete-li.',
"form.mytime.warn_tozero_rec" => 'tento záznam musí být smazán, neboť období je uzamčeno',
// Note to translators: the string below is missing in the translation and must be added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'vytvořit nový manažerský účet',
"form.profile.edit_title" => 'upravit profil',
"form.profile.login" => 'přihlásit',

"form.profile.showchart" => 'zobrazuj grafy',

// people form attributes
"form.people.ppl_str" => 'pracovnící',
"form.people.createu_str" => 'vytváření nového uživatele',
"form.people.edit_str" => 'nastavení uživatele',
"form.people.del_str" => 'smazat uživatele',
"form.people.th.login" => 'přihlásit',
"form.people.th.role" => 'role',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'sazba',
"form.people.manager" => 'manažer',
"form.people.comanager" => 'spolumanažer',
"form.people.empl" => 'uživatel',
"form.people.login" => 'přihlásit',

"form.people.rate" => 'hodinová sazba',
"form.people.comanager" => 'spolumanažer',
"form.people.projects" => 'projekty',

// projects form attributes
"form.project.proj_title" => 'projekty',
"form.project.edit_str" => 'upravit projekt',
"form.project.add_str" => 'pridat nový projekt',
"form.project.del_str" => 'smazat projekt',

// activities form attributes
"form.activity.project" => 'projekt',

// report attributes
"form.report.from" => 'počáteční datum',
"form.report.to" => 'koncové datum',
"form.report.groupby_user" => 'uživatel',
"form.report.groupby_project" => 'projekt',
"form.report.duration" => 'trvání',
"form.report.start" => 'počátek',
"form.report.finish" => 'konec',
"form.report.note" => 'poznámka',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'pouze součty',
"form.report.total" => 'součty hodin',
"form.report.th.empllist" => 'uzivatel',
"form.report.th.date" => 'datum',
"form.report.th.project" => 'projekt',
"form.report.th.start" => 'počátek',
"form.report.th.finish" => 'konec',
"form.report.th.duration" => 'trvání',
"form.report.th.note" => 'poznámka',

// mail form attributes
"form.mail.from" => 'od',
"form.mail.to" => 'komu',
"form.mail.comment" => 'komentář',
"form.mail.above" => 'poslat sestavu e-mailem',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>zpráva odeslána</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'fakturační informace',
"form.invoice.select_cust" => 'výběr firmy',
"form.invoice.fillform" => 'vyplňte pole',
"form.invoice.date" => 'datum',
"form.invoice.number" => 'faktura číslo',
"form.invoice.tax" => 'DPH',
"form.invoice.comment" => 'komentář ',
"form.invoice.th.username" => 'osoba',
"form.invoice.th.time" => 'hodin',
"form.invoice.th.rate" => 'sazba',
"form.invoice.th.summ" => 'množství',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'zákazník',
"form.invoice.mailinv_above" => 'poslat fakturu e-mailem',
"form.invoice.sending_str" => '<b>faktura odeslána</b>',

"form.migration.zip" => 'komprese',
"form.migration.file" => 'výběr souboru',
"form.migration.import.title" => 'importovat data',
"form.migration.import.success" => 'import byl úspěšně dokončen',
"form.migration.import.text" => 'importovat týmová data z xml souboru',
"form.migration.export.title" => 'exportovat data',
"form.migration.export.success" => 'export byl úspěšně dokončen',
"form.migration.export.text" => 'můžete exportova týmová data do xml souboru. může se to hodit pro přesun na jiný server.',
// Note to translators: the string below is missing in the translation and must be added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'zákazníci',
"form.client.add_title" => 'přidat zákazníka',
"form.client.edit_title" => 'upravit zákazníka',
"form.client.del_title" => 'smazat zákazníka',
"form.client.tax" => 'DPH',
"form.client.comment" => 'poznámka ',

// miscellaneous strings
"forward.tocsvfile" => 'exportovat data do .csv souboru',
"forward.toxmlfile" => 'exportovat data do .xml souboru',
"forward.geninvoice" => 'vytvořit fakturu',

"controls.select.client" => '--- výběr zákazníka ---',
"controls.project_bind" => '--- všechny ---',
"controls.all" => '--- vše ---',
"controls.notbind" => '--- nic ---',
"controls.per_tm" => 'tento měsíc',
"controls.per_lm" => 'minulý měsíc',
"controls.per_tw" => 'tento týden',
"controls.per_lw" => 'minulý týden',
"controls.per_td" => 'dnes',
"controls.per_at" => 'od počátku',
"controls.per_ty" => 'letos',

"label.fields" => 'zobrazit pole',
"label.group_title" => 'seskupit podle',
"label.inv_str" => 'faktura',
"label.set_empl" => 'výběr uživatelů',
"label.sel_all" => 'vybrat všechno',
"label.sel_none" => 'zrušit výběr',
"label.disable" => 'zakázat',
"label.enable" => 'povolit',
"label.hrs" => 'hodin',
);
