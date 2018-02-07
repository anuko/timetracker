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

$i18n_language = 'Română';
$i18n_months = array('Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie');
$i18n_weekdays = array('Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata');
$i18n_weekdays_short = array('Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sa');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '04/19', '04/20', '05/01', '06/07', '06/08', '08/15', '12/01', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Autentificare',
'menu.logout' => 'Iesire',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Ajutor',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
'menu.time' => 'Timpul',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Rapoarte',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Proiecte',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Utilizatori',
'menu.teams' => 'Echipe',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Clienti',
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
'error.db' => 'Eroare baza de date.',
// TODO: translate the following.
// 'error.field' => 'Incorrect "{0}" data.',
'error.empty' => 'Campul "{0}" este gol.',
'error.not_equal' => 'Campul "{0}" nu este egal cu campul "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
// TODO: for "select" errors: Selecteaza or Alege? We need consistent usage.
'error.project' => 'Selecteaza proiect.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Alege client.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Nume de utilizator sau parola incorecta.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Proiectul cu acest nume exista deja.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Eroare la upload-ul fisierului.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Autentifica',
'button.now' => 'Acum',
'button.save' => 'Salveaza',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Renunta',
'button.submit' => 'Trimite',
'button.add_user' => 'Adauga utilizator',
'button.add_project' => 'Adauga proiect',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Adauga client',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Adauga',
'button.generate' => 'Genereaza',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Trimite',
'button.send_by_email' => 'Trimite pe e-mail',
'button.create_team' => 'Adauga echipa',
'button.export' => 'Exporta echipa',
'button.import' => 'Importa echipa',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Moneda',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Nume',
'label.thing_name' => 'Nume',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Parola',
'label.confirm_password' => 'Confirma parola',
'label.email' => 'E-mail',
'label.cc' => 'Copie',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Subiect',
'label.date' => 'Data',
'label.start_date' => 'Data inceput',
'label.end_date' => 'Data sfarsit',
'label.user' => 'Utilizator',
'label.users' => 'Utilizatori',
// TODO: translate the following.
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
'label.project' => 'Proiect',
'label.projects' => 'Proiecte',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Inceput',
'label.finish' => 'Sfarsit',
'label.duration' => 'Durata',
'label.note' => 'Nota',
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => 'Astazi',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
// TODO: confirm that label.edit and label.delete are translated correctly.
'label.edit' => 'Editează',
'label.delete' => 'Șterge',
'label.configure' => 'Configureaza',
// TODO: translate the following.
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
'label.comment' => 'Comentariu',
'label.status' => 'Stare',
'label.tax' => 'Taxa',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Total',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'sau',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* date obligatorii',
'label.on_behalf' => 'in numele',
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
'label.fav_report' => 'Raport favorite',
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
'title.login' => 'Autentificare',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Reseteaza parola',
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
// 'title.reports' => 'Reports',
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Proiecte',
'title.add_project' => 'Adaugare proiect',
'title.edit_project' => 'Editare proiect',
'title.delete_project' => 'Stergere proiect',
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
'dropdown.projects' => 'proiecte',
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
'form.login.forgot_password' => 'Parola pierduta?',
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
'form.reports.save_as_favorite' => 'Salveaza ca favorit',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
// 'form.reports.include_billable' => 'billable',
// 'form.reports.include_not_billable' => 'not billable',
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Alege perioada',
'form.reports.set_period' => 'sau introdu intervalul de date',
'form.reports.show_fields' => 'Arata campuri',
'form.reports.group_by' => 'Grupat dupa',
'form.reports.group_by_no' => '--- fara grupare ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'utilizator',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'proiect',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Numai totaluri',

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
"form.fpass.login" => 'autentifica', 
"form.fpass.send_pass_str" => 'cererea de resetare a parolei a fost trimisa',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker - cerere de resetare a parolei',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "Draga Utilizator,\n\nCineva, posibil tu, a cerut resetarea parolei pentru contul Anuko Time Tracker. Te rog, viziteaza acesta legatura daca doresti sa iti resetezi parola.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "pentru resetarea parolei introdu-o si da click pe salveaza",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'adauga o noua echipa prin adaugarea unui nou cont de tip manager.<br>deasemeni poti importa datele despre echipa dintr-un fisier xml generat de un alt server Anuko Time Tracker  (nu sunt permise duplicate pentru emailuri).',

"form.admin.profile.title" => 'echipe',
"form.admin.profile.noprofiles" => 'baza de date este goala. intra ca admin si adauga o noua echipa.',
"form.admin.profile.comment" => 'sterge echipa',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'activ',

// my time form attributes
"form.mytime.title" => 'timpul meu',
"form.mytime.edit_title" => 'editarea inregistrarii timpului',
"form.mytime.del_str" => 'stergerea inregistrarii timpului',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.total" => 'ore total: ',
"form.mytime.del_yes" => 'inregistrarea timului a fost stearsa cu succes',
"form.mytime.no_finished_rec" => 'aceasta inregistrare a fost salvata numei cu timpul de inceput. nu este o eroare. poti parasi aplicatia daca este nevoie.',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'creazaun nou cont de tip manager',
"form.profile.edit_title" => 'editeaza profilul',

// people form attributes
"form.people.ppl_str" => 'persoane',
"form.people.createu_str" => 'adaugare untilizator nou',
"form.people.edit_str" => 'editare utilizator',
"form.people.del_str" => 'stergee utilizator',
"form.people.th.role" => 'functie',
"form.people.th.rate" => 'rata',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',

"form.people.rate" => 'pret pe ora implicit',
"form.people.comanager" => 'co-manager',

// report attributes
"form.report.title" => 'rapoarte',
"form.report.total" => 'ore total',

// mail form attributes
"form.mail.from" => 'de la',
"form.mail.to" => 'catre',
"form.mail.above" => 'trimite acest raport pe e-mail',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>mesaj trimis</b>',

// invoice attributes
"form.invoice.title" => 'factura',
"form.invoice.caption" => 'factura',
"form.invoice.above" => 'informatii aditionale pentru factura',
"form.invoice.select_cust" => 'alege client',
"form.invoice.fillform" => 'comleteaza campurile',
"form.invoice.number" => 'numar factura',
"form.invoice.th.username" => 'persoana',
"form.invoice.th.time" => 'ore',
"form.invoice.th.rate" => 'rata',
"form.invoice.th.summ" => 'valoare',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'client',
"form.invoice.mailinv_above" => 'trimite aceasta factura pe email',
"form.invoice.sending_str" => '<b>factura trimisa</b>',

"form.migration.zip" => 'compresie',
"form.migration.file" => 'alege fisier',
"form.migration.import.title" => 'importa date',
"form.migration.import.success" => 'importul s-a incheiat cu succes',
"form.migration.import.text" => 'importa date echipa dintr-un fisier xml',
"form.migration.export.title" => 'exporta date',
"form.migration.export.success" => 'exportul s-a inchieat cu succes',
"form.migration.export.text" => 'poti exporta toate datele despre echipa intr-un fisier xml. acesta poate fi folositor daca transferi datele pe alt server',
// Note to translators: the strings below are missing and must be added and translated 
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'clienti',
"form.client.add_title" => 'adauga client',
"form.client.edit_title" => 'editeaza client',
"form.client.del_title" => 'sterge client',

// miscellaneous strings
"forward.tocsvfile" => 'exporta date in fisier .csv',
"forward.geninvoice" => 'genereaza factura',

"controls.project_bind" => '--- toate ---',
"controls.all" => '--- toate ---',
"controls.notbind" => '--- nu ---',
"controls.per_tm" => 'luna curenta',
"controls.per_lm" => 'luna trecuta',
"controls.per_tw" => 'saptamana curenta',
"controls.per_lw" => 'saptamana trecuta',

"label.inv_str" => 'factura',
"label.set_empl" => 'alege utilizatori',
"label.sel_all" => 'selecteaza   tot',
"label.sel_none" => 'deselecteaza tot',
"label.disable" => 'inactiv',
"label.enable" => 'activ',
);
