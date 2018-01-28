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
// 'menu.users' => 'Users',
'menu.teams' => 'Equips',
// TODO: translate the following.
// 'menu.export' => 'Export',
// 'menu.clients' => 'Clients',
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
'error.db' => 'Error de la Base de Dades.',
'error.field' => 'Dada "{0}" incorrecta.',
'error.empty' => 'L\\\'Arxiu "{0}" està buit.',
'error.not_equal' => 'L\\\'Arxiu "{0}" no és igual al arxiu "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Selleccionar Projecte.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',

// TODO: refactoring ongoing down from here.
'error.auth' => 'Usuari o parula de pas incorrecta',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Ja existeix un projecte amb aquest nom.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
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
'button.add_user' => 'Agregar usuari ',
'button.add_project' => 'Agregar projecte',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Agregar client',
// TODO: translate the folllowing:
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
// 'label.person_name' => 'Name',
// 'label.thing_name' => 'Name',
// 'label.login' => 'Login',
'label.password' => 'Paraula de pas',
'label.confirm_password' => 'Confirmar paraula de pas',
'label.email' => 'E-mail',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Assumpte',
'label.date' => 'Data',
// TODO: translate the following.
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
// 'label.user' => 'User',
// 'label.users' => 'Users',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
// 'label.project' => 'Project',
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
// 'label.today' => 'Today',
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
// 'label.edit' => 'Edit',
'label.delete' => 'Eliminar',
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
'label.role_admin' => '(administrador)',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// 'label.custom_fields' => 'Custom fields',
// 'label.monthly_quotas' => 'Monthly quotas',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
'label.fav_report' => 'Report favorit',
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',

// Form titles.
'title.login' => 'Sessió iniciada',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Restablir paraula de pas',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
// 'title.edit_time_record' => 'Editing Time Record',
// 'title.delete_time_record' => 'Deleting Time Record',
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.reports' => 'Reports',
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
'form.reset_password.message' => 'S\\\'ha enviat la petició de restablir paraula de pas.',
'form.reset_password.email_subject' => 'Sol·licitud de restabliment de la paraula de pas de Anuko Time Tracker',
// TODO: translate the following.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Per restablir la paraula de pas, si us plau escrigui-la i faci clic en guardar.',

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
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Guardar com a favorit',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
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
'form.reports.group_by_date' => 'data',
// TODO: translate the following.
// 'form.reports.group_by_user' => 'user',
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projecte',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
// 'form.reports.totals_only' => 'Totals only',

// TODO: the entire section from here to bottom needs refactoring.

// administrator form
"form.admin.duty_text" => 'Crear un nou grup, creant un nou compte del manejador de l\\\'equip.<br>També pot importar dades de grups, d\\\'un arxiu xml d\\\'un altre servidor Anuko Time Tracker.(No està permès col·lisions de e-mail).',

"form.admin.change_pass" => 'Canviar la paraula de pas de l\\\'administrador de compte',
"form.admin.profile.title" => 'Grups',
"form.admin.profile.noprofiles" => 'La seva base de dades està buida. Iniciï sessió com a administrador i creï un nou grup.',
"form.admin.profile.comment" => 'Eliminar grup',
"form.admin.profile.th.id" => 'Identificació',
"form.admin.profile.th.name" => 'Nom',
"form.admin.profile.th.edit" => 'Modificar',
"form.admin.profile.th.del" => 'Eliminar',
"form.admin.profile.th.active" => 'Actiu',

// my time form attributes
"form.mytime.title" => 'El meu temps',
"form.mytime.edit_title" => 'Modificant l\\\'historial de temps',
"form.mytime.del_str" => 'Eliminant l\\\'historial de temps',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'Data',
"form.mytime.project" => 'Projecte',
"form.mytime.activity" => 'Activitat',
"form.mytime.start" => 'Inici',
"form.mytime.finish" => 'Fi',
"form.mytime.duration" => 'Durada',
"form.mytime.note" => 'Nota',
"form.mytime.behalf" => 'Treball del dia per a',
"form.mytime.daily" => 'Treball diari',
"form.mytime.total" => 'Hores totals: ',
"form.mytime.th.project" => 'Projecte',
"form.mytime.th.activity" => 'Activitat',
"form.mytime.th.start" => 'Inici',
"form.mytime.th.finish" => 'Fi',
"form.mytime.th.duration" => 'Durada',
"form.mytime.th.note" => 'Nota',
"form.mytime.th.edit" => 'Modificar',
"form.mytime.th.delete" => 'Eliminar',
"form.mytime.del_yes" => 'L\\\'historial de temps s\\\'ha eliminat amb èxit',
"form.mytime.no_finished_rec" => 'Aquest historial s\\\'ha guardat únicament amb l\\\'hora d\\\'inici. Aixó no és un error. Finalitzi sessió si ho necessita.',
"form.mytime.billable" => 'facturable',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'Crear un nou compte de manejador',
"form.profile.edit_title" => 'Modificant perfil',
"form.profile.name" => 'Nom',
// Note to translators: a few strings in this section a missing. Please check against the English file.
// TODO: translate the following.
// 'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.profile.uncompleted_indicators_none' => 'do not show',
// 'form.profile.uncompleted_indicators_show' => 'show',

// people form attributes
"form.people.ppl_str" => 'Persones',
"form.people.createu_str" => 'Creant nou usuari',
"form.people.edit_str" => 'Modificant usuari',
"form.people.del_str" => 'Eliminant usuari',
"form.people.th.name" => 'Nom',
"form.people.th.email" => 'e-mail',
"form.people.th.role" => 'Rol',
"form.people.th.edit" => 'Modificar',
"form.people.th.del" => 'Eliminar',
"form.people.th.status" => 'Estat',
"form.people.th.project" => 'Projecte',
"form.people.th.rate" => 'Taxa',
"form.people.manager" => 'Manejador',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.empl" => 'Usuari',
"form.people.name" => 'Nom',

"form.people.rate" => 'Taxa per defecte en hores',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.projects" => 'Projectes',

// projects form attributes
"form.project.proj_title" => 'Projectes',
"form.project.edit_str" => 'Modificant projecte',
"form.project.add_str" => 'Agregant nou projecte',
"form.project.del_str" => 'Eliminant projecte',
"form.project.th.name" => 'Nom',
"form.project.th.edit" => 'Modificar',
"form.project.th.del" => 'Eliminar',
"form.project.name" => 'Nom',

// activities form attributes
"form.activity.act_title" => 'Activitats',
"form.activity.add_title" => 'Agregant nova activitat',
"form.activity.edit_str" => 'Modificant activitat',
"form.activity.del_str" => 'Eliminant activitat',
"form.activity.name" => 'Nom',
"form.activity.project" => 'Projecte',
"form.activity.th.name" => 'Nom',
"form.activity.th.project" => 'Projecte',
"form.activity.th.edit" => 'Editar',
"form.activity.th.del" => 'Eliminar',

// report attributes
"form.report.title" => 'Reports',
"form.report.from" => 'Data d\\\'inici',
"form.report.to" => 'Data de fi',
"form.report.groupby_user" => 'Usuari',
"form.report.groupby_project" => 'Projecte',
"form.report.groupby_activity" => 'Activitat',
"form.report.duration" => 'Durada',
"form.report.start" => 'Inici',
"form.report.activity" => 'Activitat',
"form.report.show_idle" => 'Mostrar ausent',
"form.report.finish" => 'Fi',
"form.report.note" => 'Nota',
"form.report.project" => 'Projecte',
"form.report.totals_only" => 'Només totals',
"form.report.total" => 'Hores Totals',
"form.report.th.empllist" => 'Usuari',
"form.report.th.date" => 'Data',
"form.report.th.project" => 'Projecte',
"form.report.th.activity" => 'Activitat',
"form.report.th.start" => 'Inici',
"form.report.th.finish" => 'Fi',
"form.report.th.duration" => 'Durada',
"form.report.th.note" => 'Nota',

// charts form attributes
// Note to translators: form.charts.title needs to be translated.
// 'form.charts.title' => 'charts',

// mail form attributes
"form.mail.from" => 'De',
"form.mail.to" => 'Per a',
"form.mail.comment" => 'Comentari',
"form.mail.above" => 'Enviar aquest report por e-mail',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>Missatge enviat</b>',

// invoice attributes
"form.invoice.title" => 'Factura',
"form.invoice.caption" => 'Factura',
"form.invoice.above" => 'Informació addicional per factura',
"form.invoice.select_cust" => 'Seleccioni el client',
"form.invoice.fillform" => 'Empleni els camps',
"form.invoice.date" => 'Data',
"form.invoice.number" => 'Número de factura',
"form.invoice.tax" => 'Impost',
"form.invoice.comment" => 'Comentari ',
"form.invoice.th.username" => 'Persona',
"form.invoice.th.time" => 'Hores',
"form.invoice.th.rate" => 'Taxa',
"form.invoice.th.summ" => 'Quantitat',
"form.invoice.subtotal" => 'Subtotal',
"form.invoice.customer" => 'Client',
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

"form.client.title" => 'Clients',
"form.client.add_title" => 'Agregar client',
"form.client.edit_title" => 'Modificar client',
"form.client.del_title" => 'Eliminar client',
"form.client.th.name" => 'Nom',
"form.client.th.edit" => 'Modificar',
"form.client.th.del" => 'Eliminar',
"form.client.name" => 'Nom',
"form.client.tax" => 'Impost',
"form.client.comment" => 'Comentari ',

// miscellaneous strings
"forward.forgot_password" => '¿Ha oblidat la seva paraula de pas?',
"forward.edit" => 'Modificar',
"forward.delete" => 'Eliminar',
"forward.tocsvfile" => 'Exportar dades a un arxiu .csv',
"forward.geninvoice" => 'Generar factura',
"forward.change" => 'Configurar clients',

// strings inside contols on forms
"controls.select.project" => '--- Sel·leccionar projecte ---',
"controls.select.activity" => '--- Sel·leccionar activitat ---',
"controls.select.client" => '--- Sel·leccionar client ---',
"controls.project_bind" => '--- Tots ---',
"controls.all" => '--- Tots ---',
"controls.notbind" => '--- No ---',
"controls.per_tm" => 'Aquest mes',
"controls.per_lm" => 'El mes passat',
"controls.per_tw" => 'Aquestat setmana',
"controls.per_lw" => 'La setmana passada',
"controls.per_td" => 'Aquest dia',
"controls.per_lw" => 'La setmana passada',
"controls.sel_period" => '--- Seleccionar període de temps ---',
"controls.sel_groupby" => '--- No agrupar ---',
"controls.inc_billable" => 'facturable',
"controls.inc_nbillable" => 'no facturable',

// labels
"label.chart.title1" => 'activitats per usuari',
"label.chart.period" => 'gràfica por període',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>A nom de %s</b>',
"label.pminfo" => ' (Manejador)',
"label.pcminfo" => ' (Auxiliar del manejador)',
"label.painfo" => ' (Administrador)',
"label.time_noentry" => 'Sense entrada',
"label.today" => 'Data Actual',
"label.req_fields" => '* camps requerits',
"label.sel_project" => 'Seleccionar projecte',
"label.sel_activity" => 'Seleccionar activitat',
"label.sel_tp" => 'Seleccionar període de temps',
"label.set_tp" => 'o establir dates',
"label.fields" => 'Mostrar camps',
"label.group_title" => 'Agrupar per',
"label.include_title" => 'include records',
"label.inv_str" => 'Factura',
"label.set_empl" => 'Seleccionar usuaris',
"label.sel_all" => 'Seleccionar tots',
"label.sel_none" => 'Treure totes las seleccions',
"label.or" => 'o',
"label.disable" => 'Deshabilitar',
"label.enable" => 'Habilitar',
"label.filter" => 'Filtrar',
"label.timeweek" => 'total setmanal',
// Note to translators: strings below are missing from the translation and need to be added.
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
