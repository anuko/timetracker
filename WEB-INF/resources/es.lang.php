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

$i18n_language = 'Spanish (Español)';
$i18n_months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$i18n_weekdays = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
$i18n_weekdays_short = array('Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '04/05', '04/06', '05/01', '08/15', '10/12', '11/01', '12/06', '12/08', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Iniciar sesión',
'menu.logout' => 'Finalizar sesión',
'menu.forum' => 'Foro',
'menu.help' => 'Ayuda',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'Perfil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'Tiempo',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Reportes',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Proyectos',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Personas',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.export' => 'Export',
'menu.clients' => 'Clientes',
'menu.options' => 'Opciones',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.'
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'Error de la base de datos.',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Dato "{0}" incorrecto.',
'error.empty' => 'El archivo "{0}" esta vacío.',
'error.not_equal' => 'El archivo "{0}" no es igual al archivo "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Seleccionar proyecto.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Usuario o contraseña incorrecta.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Ya existe un proyecto con este nombre.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
'error.no_groups' => 'Su base de datos esta vacía. Inicie sesión como administrador y cree un nuevo grupo.',
'error.upload' => 'Error subiendo el archivo.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Iniciar sesion',
'button.now' => 'Ahora',
'button.save' => 'Guardar',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Cancelar',
'button.submit' => 'Enviar',
'button.add' => 'Agregar',
'button.delete' => 'Eliminar',
'button.generate' => 'Generar',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar por correo',
'button.create_group' => 'Crear grupo',
'button.export' => 'Exportar grupo',
'button.import' => 'Importar grupo',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.group_name' => 'Group name',
'label.address' => 'Dirección',
'label.currency' => 'Moneda',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Nombre',
'label.thing_name' => 'Nombre',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Contraseña',
'label.confirm_password' => 'Confirmar contraseña',
'label.email' => 'Email',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Asunto',
'label.date' => 'Fecha',
'label.start_date' => 'Fecha de inicio',
'label.end_date' => 'Fecha de fin',
'label.user' => 'Usuario',
// TODO: translate the following.
// 'label.users' => 'Users',
// 'label.roles' => 'Roles',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
'label.option' => 'Opción',
// TODO: translate the following.
// 'label.invoice' => 'Invoice',
'label.project' => 'Proyecto',
'label.projects' => 'Proyectos',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Inicio',
'label.finish' => 'Fin',
'label.duration' => 'Duración',
'label.note' => 'Nota',
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => 'Hoy',
// TODO: translate the following.
// 'label.view' => 'View',
'label.edit' => 'Modificar',
'label.delete' => 'Eliminar',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => 'Seleccionar todos',
'label.select_none' => 'Quitar todas las selecciones',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'Identificación',
// TODO: translate the following.
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Comentario',
// TODO: translate the following.
// 'label.status' => 'Status',
'label.tax' => 'Impuesto',
// TODO: translate the following.
'label.subtotal' => 'Subtotal',
'label.total' => 'Total',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'o',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* - campos requeridos',
'label.on_behalf' => 'a nombre de',
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
'label.fav_report' => 'Reporte favorito',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Sesión iniciada',
'title.groups' => 'Grupos',
// TODO: translate the following.
// 'title.create_group' => 'Creating Group',
// 'title.edit_group' => 'Editing Group',
// 'title.delete_group' => 'Deleting Group',
'title.reset_password' => 'Reestablecer contraseña',
// TODO: translate the following.
// 'title.change_password' => 'Changing Password',
'title.time' => 'Tiempo',
'title.edit_time_record' => 'Modificando el historial de tiempo',
'title.delete_time_record' => 'Eliminando el historial de tiempo',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => 'Reportes',
// TODO: translate the following.
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Factura',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Proyectos',
'title.add_project' => 'Agregando proyecto',
'title.edit_project' => 'Modificando proyecto',
'title.delete_project' => 'Eliminando proyecto',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Personas',
'title.add_user' => 'Creando usuario',
'title.edit_user' => 'Modificando usuario',
'title.delete_user' => 'Eliminando usuario',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Clientes',
'title.add_client' => 'Agregar cliente',
'title.edit_client' => 'Modificando cliente',
'title.delete_client' => 'Eliminando cliente',
// TODO: translate the following.
// 'title.invoices' => 'Invoices',
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Exportar datos', // TODO: Consider changing to exportando for consistency with other titles.
'title.import' => 'Importar datos', // TODO: Consider changing to importando for consistency with other titles.
'title.options' => 'Opciones',
'title.profile' => 'Perfil',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
// 'title.cf_custom_fields' => 'Custom Fields',
// 'title.cf_add_custom_field' => 'Adding Custom Field',
// 'title.cf_edit_custom_field' => 'Editing Custom Field',
// 'title.cf_delete_custom_field' => 'Deleting Custom Field',
// 'title.cf_dropdown_options' => 'Dropdown Options',
// 'title.cf_add_dropdown_option' => 'Adding Option',
// 'title.cf_edit_dropdown_option' => 'Editing Option',
// 'title.cf_delete_dropdown_option' => 'Deleting Option',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- todos ---',
'dropdown.no' => '--- no ---',
'dropdown.current_day' => 'hoy',
'dropdown.previous_day' => 'ayer',
'dropdown.selected_day' => 'dia',
'dropdown.current_week' => 'esta semana',
'dropdown.previous_week' => 'la semana pasada',
'dropdown.selected_week' => 'semana',
'dropdown.current_month' => 'este mes',
'dropdown.previous_month' => 'el mes pasado',
'dropdown.selected_month' => 'mes',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'año',
// TODO: translate the following.
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'proyectos',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
'dropdown.select' => '--- seleccionar ---',
// TODO: translate the following.
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => '¿Olvido su contraseña?',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: check / improve translation of form.reset_password.message.
// English form is: 'form.reset_password.message' => 'Password reset request sent by email.',
// "by email" is missing here, and it is unclear how exactly it was sent.
'form.reset_password.message' => 'Se ha enviado la petición de reestablecer contraseña.',
'form.reset_password.email_subject' => 'Solicitud de reestablecimiento de la contraseña de Anuko Time Tracker',
// Note to translators: the ending of this string needs to be translated.
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Querido usuario, Alguien, IP %s, solicitó reestablecer su contraseña de Anuko Time Tracker. Por favor visite este enlace si quiere reestablecer su contraseña.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: improve translation of form.change_password.tip.
// The English form is: 'form.change_password.tip' => 'Type new password and click on Save.',
'form.change_password.tip' => 'Para reestablecer su contraseña, por favor digítela y de clic en Guardar.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// Note to translators: translate form.time.duration_format.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Facturable',
// TODO: translate the following.
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Este historial fue guardado solamente con la hora de Inicio. Esto no es un error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Guardar como favorito',
// TODO: translate form.reports.confirm_delete.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_billable' => 'facturable',
'form.reports.include_not_billable' => 'no facturable',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Seleccionar período de tiempo',
'form.reports.set_period' => 'o establecer fechas',
'form.reports.show_fields' => 'Mostrar campos',
'form.reports.group_by' => 'Agrupar por',
'form.reports.group_by_no' => '--- no agrupar ---',
'form.reports.group_by_date' => 'fecha',
'form.reports.group_by_user' => 'usuario',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'proyecto',
// TODO: traslate the following string.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Solo totales',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportar',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Número de factura',
'form.invoice.person' => 'Persona',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// TODO: translate the following.
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
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Rol',
'form.users.manager' => 'Manejador',
'form.users.comanager' => 'Auxiliar del manejador',
'form.users.rate' => 'Tasa',
// TODO: translate the following.
// 'form.users.default_rate' => 'Default hourly rate',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
// TODO: translate the following.
// 'form.user_edit.swap_roles' => 'Swap roles',

// Roles form. See example at https://timetracker.anuko.com/roles.php
// TODO: translate the following.
// 'form.roles.active_roles' => 'Active Roles',
// 'form.roles.inactive_roles' => 'Inactive Roles',
// 'form.roles.rank' => 'Rank',
// 'form.roles.rights' => 'Rights',
// 'form.roles.assigned' => 'Assigned',
// 'form.roles.not_assigned' => 'Not assigned',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Usted puede exportar todos los datos del grupo dentro de un archivo xml. Ésto puede ser útil si necesita migrar datos a su propio sevidor.',
'form.export.compression' => 'Comprimir',
// Note to translators: the strings below are missing in the translation and must be added.
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Importar datos del grupo desde un archivo xml.',
'form.import.file' => 'Seleccione el archivo',
'form.import.success' => 'Importación finalizada con éxito.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: improve translation of form.admin.hint - no login collisions are allowed.
// ALSO TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Crear un nuevo grupo, creando una nueva cuenta del manejador del equipo.<br>También puede importar datos de grupos, de un archivo xml de otro servidor Anuko Time Tracker (no estan permitidad colisiones de e-mail).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 horas',
'form.group_edit.24_hours' => '24 horas',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
// 'form.group_edit.tracking_mode' => 'Tracking mode',
// 'form.group_edit.mode_time' => 'time',
// 'form.group_edit.mode_projects' => 'projects',
// 'form.group_edit.mode_projects_and_tasks' => 'projects and tasks',
// 'form.group_edit.record_type' => 'Record type',
// 'form.group_edit.type_all' => 'all',
// 'form.group_edit.type_start_finish' => 'start and finish',
// 'form.group_edit.type_duration' => 'duration',
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.plugins' => 'Plugins',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'De',
'form.mail.to' => 'Para',
// TODO: translate form.mail.report_subject.
// 'form.mail.report_subject' => 'Time Tracker Report',
// Note to translators: the following strings need to be translated.
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Factura enviada.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own reports, charts, and invoices.',
// 'role.supervisor.label' => 'Supervisor',
// 'role.supervisor.low_case_label' => 'supervisor',
// 'role.supervisor.description' => 'A person with a small set of management rights.',
// 'role.comanager.label' => 'Co-manager',
// 'role.comanager.low_case_label' => 'co-manager',
// 'role.comanager.description' => 'A person with a big set of management functions.',
// 'role.manager.label' => 'Manager',
// 'role.manager.low_case_label' => 'manager',
// 'role.manager.description' => 'Group manager. Can do most of things for a group.',
// 'role.top_manager.label' => 'Top manager',
// 'role.top_manager.low_case_label' => 'top manager',
// 'role.top_manager.description' => 'Top group manager. Can do everything in a tree of groups.',
// 'role.admin.label' => 'Administrator',
// 'role.admin.low_case_label' => 'administrator',
// 'role.admin.description' => 'Site adminsitrator.',
);
