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

$i18n_language = 'Català';
$i18n_months = array('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');
$i18n_weekdays = array('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');
$i18n_weekdays_short = array('Dg', 'Dl', 'Dm', 'Dc', 'Dj', 'Dv', 'Ds');
// format mm/dd
$i18n_holidays = array('01/01', '01/16', '02/20', '03/29', '07/04', '09/04', '10/09', '11/11', '11/23', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Iniciar sessió',
'menu.logout' => 'Finalitzar sessió',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Ajuda',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Perfil',
// TODO: translate the following.
// 'menu.time' => 'Time',
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Informes',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projectes',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Usuaris',
'menu.teams' => 'Grups',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Clients',
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
'error.db' => 'Error de la base de dades.',
'error.field' => 'Dada "{0}" incorrecta.',
'error.empty' => 'L\\\'Arxiu "{0}" està buit.',
'error.not_equal' => 'L\\\'Arxiu "{0}" no és igual al arxiu "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Sel·leccionar projecte.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Sel·leccionar client.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Usuari o parula de pas incorrecta.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Ja existeix un projecte amb aquest nom.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
'error.no_teams' => 'La seva base de dades està buida. Iniciï sessió com a administrador i creï un nou grup.',
'error.upload' => 'Error pujant l\\\'arxiu.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Iniciar sessió',
'button.now' => 'Ara',
'button.save' => 'Guardar',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Cancel·lar',
'button.submit' => 'Enviar',
'button.add_user' => 'Agregar usuari',
'button.add_project' => 'Agregar projecte',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Agregar client',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Agregar',
'button.generate' => 'Generar',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar per correu',
'button.create_team' => 'Crear grup',
'button.export' => 'Exportar grup',
'button.import' => 'Importar grup',
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
'label.person_name' => 'Nom',
'label.thing_name' => 'Nom',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Paraula de pas',
'label.confirm_password' => 'Confirmar paraula de pas',
'label.email' => 'E-mail',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Assumpte',
'label.date' => 'Data',
'label.start_date' => 'Data d\\\'inici',
'label.end_date' => 'Data de fi',
'label.user' => 'Usuari',
'label.users' => 'Usuaris',
'label.client' => 'Client',
'label.clients' => 'Clients',
// TODO: translate the following.
// 'label.option' => 'Option',
'label.invoice' => 'Factura',
'label.project' => 'Projecte',
'label.projects' => 'Projectes',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Inici',
'label.finish' => 'Fi',
'label.duration' => 'Durada',
'label.note' => 'Nota',
'label.notes' => 'Notes',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
// 'label.today' => 'Today',
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Modificar',
'label.delete' => 'Eliminar',
'label.configure' => 'Configurar',
'label.select_all' => 'Seleccionar tots',
'label.select_none' => 'Treure totes las seleccions',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Comentari',
'label.status' => 'Estat',
'label.tax' => 'Impost',
// TODO: translate the following.
// 'label.subtotal' => 'Subtotal',
// 'label.total' => 'Total',
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'o',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* camps requerits',
'label.on_behalf' => 'a nom de',
'label.role_manager' => '(manejador)',
'label.role_comanager' => '(auxiliar del manejador)',
'label.role_admin' => '(administrador)',
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
'label.fav_report' => 'Report favorit',
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
// Compare with English file to see how it is done there and do Catalan titles similarly.
// Specifically: Agregant vs Agregar, etc.
'title.login' => 'Sessió iniciada',
'title.teams' => 'Grups',
// TODO: translate the following.
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
'title.delete_team' => 'Eliminar grup',
'title.reset_password' => 'Restablir paraula de pas',
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
'title.reports' => 'Informes',
'title.report' => 'Informe',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Factura',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projectes',
'title.add_project' => 'Agregant projecte',
'title.edit_project' => 'Modificant projecte',
'title.delete_project' => 'Eliminant projecte',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Usuaris',
// TODO: translate the following.
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
'title.clients' => 'Clients',
'title.add_client' => 'Agregar client',
'title.edit_client' => 'Modificar client',
'title.delete_client' => 'Eliminar client',
'title.invoices' => 'Factures',
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
// 'title.options' => 'Options',
'title.profile' => 'Perfil',
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
'dropdown.all' => '--- tots ---',
'dropdown.no' => '--- no ---',
'dropdown.current_day' => 'avui',
'dropdown.previous_day' => 'ahir',
'dropdown.selected_day' => 'dia',
'dropdown.current_week' => 'aquestat setmana',
'dropdown.previous_week' => 'la setmana passada',
'dropdown.selected_week' => 'setmana',
'dropdown.current_month' => 'aquest mes',
'dropdown.previous_month' => 'el mes passat',
'dropdown.selected_month' => 'mes',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'projectes',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'clients',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'actiu',
// TODO: translate the following.
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '¿Ha oblidat la seva paraula de pas?',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'S\\\'ha enviat la petició de restablir paraula de pas.', // TODO: add "by email" to match the English string.
'form.reset_password.email_subject' => 'Sol·licitud de restabliment de la paraula de pas de Anuko Time Tracker',
// TODO: translate the following.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Per restablir la paraula de pas, si us plau escrigui-la i faci clic en guardar.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Facturable',
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
'form.reports.save_as_favorite' => 'Guardar com a favorit',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_billable' => 'facturable',
'form.reports.include_not_billable' => 'no facturable',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Seleccionar període de temps',
'form.reports.set_period' => 'o establir dates',
'form.reports.show_fields' => 'Mostrar camps',
'form.reports.group_by' => 'Agrupar per',
'form.reports.group_by_no' => '--- no agrupar ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'usuari',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projecte',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Només totals',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportar',
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
// TODO: translate the following.
// 'form.export.hint' => 'You can export all team data into an xml file. It could be useful if you are migrating data to your own server.',
// 'form.export.compression' => 'Compression',
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: translate the following.
// 'form.import.hint' => 'Import team data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' => 'Crear un nou grup, creant un nou compte del manejador de l\\\'equip.<br>També pot importar dades de grups, d\\\'un arxiu xml d\\\'un altre servidor Anuko Time Tracker (no està permès col·lisions de login).',



// TODO: refactoring ongoing down from here.

// my time form attributes
"form.mytime.title" => 'El meu temps',
"form.mytime.edit_title" => 'Modificant l\\\'historial de temps',
"form.mytime.del_str" => 'Eliminant l\\\'historial de temps',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.total" => 'Hores totals: ',
"form.mytime.del_yes" => 'L\\\'historial de temps s\\\'ha eliminat amb èxit',
"form.mytime.no_finished_rec" => 'Aquest historial s\\\'ha guardat únicament amb l\\\'hora d\\\'inici. Aixó no és un error. Finalitzi sessió si ho necessita.',

// people form attributes
"form.people.ppl_str" => 'Persones',
"form.people.createu_str" => 'Creant nou usuari',
"form.people.edit_str" => 'Modificant usuari',
"form.people.del_str" => 'Eliminant usuari',
"form.people.th.email" => 'e-mail',
"form.people.th.role" => 'Rol',
"form.people.th.rate" => 'Taxa',
"form.people.manager" => 'Manejador',
"form.people.comanager" => 'Auxiliar del manejador',

"form.people.rate" => 'Taxa per defecte en hores',
"form.people.comanager" => 'Auxiliar del manejador',

// report attributes
"form.report.totals_only" => 'Només totals',
"form.report.total" => 'Hores Totals',

// mail form attributes
"form.mail.from" => 'De',
"form.mail.to" => 'Per a',
"form.mail.above" => 'Enviar aquest report por e-mail',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>Missatge enviat</b>',

// invoice attributes
"form.invoice.above" => 'Informació addicional per factura',
"form.invoice.select_cust" => 'Seleccioni el client',
"form.invoice.fillform" => 'Empleni els camps',
"form.invoice.number" => 'Número de factura',
"form.invoice.th.username" => 'Persona',
"form.invoice.th.time" => 'Hores',
"form.invoice.th.rate" => 'Taxa',
"form.invoice.th.summ" => 'Quantitat',
"form.invoice.subtotal" => 'Subtotal',
"form.invoice.mailinv_above" => 'Enviar aquesta factura per e-mail',
"form.invoice.sending_str" => '<b>Factura enviada</b>',

"form.migration.zip" => 'Comprimir',
"form.migration.file" => 'Sel·leccioni l\\\'arxiu',
"form.migration.import.title" => 'Importar dades',
"form.migration.import.success" => 'Importació finalitzada amb èxit',
"form.migration.import.text" => 'Importar dades del grup des d\\\'un arxiu xml',
"form.migration.export.title" => 'Exportar dades',
"form.migration.export.success" => 'Exportació finalitzada amb èxit',
"form.migration.export.text" => 'Vosté pot exportar totes les dades del grup dins d\\\'un archivo xml. Això pot ser útil si necessita migrar dades al seu propi servidor.',
);
