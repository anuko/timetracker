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

$i18n_language = 'Portuguese (Português)';
$i18n_months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Augosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$i18n_weekdays = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
$i18n_weekdays_short = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
// format mm/dd
$i18n_holidays = array('01/01', '02/24', '04/10', '04/12', '04/25', '05/01', '06/10', '06/11', '08/15', '10/05', '01/11', '12/01', '12/08', '12/25');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Login',
'menu.logout' => 'Logout',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Ajuda',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'Perfil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'Tempo',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Relatórios',
// TODO: translate the following.
'menu.charts' => 'Charts',
'menu.projects' => 'Projetos',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Usuários',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.export' => 'Export',
// 'menu.clients' => 'Clients',
'menu.options' => 'Opções',

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
// 'error.db' => 'Database error.',
// 'error.feature_disabled' => 'Feature is disabled.',
// 'error.field' => 'Incorrect "{0}" data.',
// 'error.empty' => 'Field "{0}" is empty.',
// 'error.not_equal' => 'Field "{0}" is not equal to field "{1}".',
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Selecione projeto.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
// 'error.auth' => 'Incorrect login or password.',
// 'error.user_exists' => 'User with this login already exists.',
// 'error.object_exists' => 'Object with this name already exists.',
// 'error.project_exists' => 'Project with this name already exists.',
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.role_exists' => 'Role with this rank already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_groups' => 'Your database is empty. Login as admin and create a new group.',
// 'error.upload' => 'File upload error.',
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Hoje',
'button.save' => 'Salvar',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Cancelar',
'button.submit' => 'Submeter',
'button.add' => 'Adicionar',
'button.delete' => 'Apagar',
// TODO: translate the following.
// 'button.generate' => 'Generate',
// 'button.reset_password' => 'Reset password',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar por e-mail',
// TODO: translate the following.
// 'button.create_group' => 'Create group',
// 'button.export' => 'Export group',
// 'button.import' => 'Import group',
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.group_name' => 'Group name',
// 'label.address' => 'Address',
// 'label.currency' => 'Currency',
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Nome',
'label.thing_name' => 'Nome',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Senha',
'label.confirm_password' => 'Confirme a senha',
'label.email' => 'E-mail',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Assunto',
'label.date' => 'Data',
'label.start_date' => 'Data inicial',
'label.end_date' => 'Data final',
'label.user' => 'Usuário',
'label.users' => 'Usuários',
// TODO: translate the following.
// 'label.roles' => 'Roles',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
'label.project' => 'Projeto',
'label.projects' => 'Projetos',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Início',
'label.finish' => 'Fim',
'label.duration' => 'Duração',
'label.note' => 'Anotação',
'label.notes' => 'Anotações',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.ip' => 'IP',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
// 'label.today' => 'Today',
// 'label.view' => 'View',
'label.edit' => 'Editar',
'label.delete' => 'Apagar',
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
'label.comment' => 'Comentário',
'label.status' => 'Status',
// TODO: translate the following.
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
// 'label.total' => 'Total',
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'ou',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* campos obrigatórios',
// TODO: translate the following.
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(gerente)',
// TODO: translate the following.
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
// 'label.fav_report' => 'Favorite report',
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
'title.login' => 'Login',
// TODO: translate the following.
// 'title.groups' => 'Groups',
// 'title.create_group' => 'Creating Group',
// 'title.edit_group' => 'Editing Group',
// 'title.delete_group' => 'Deleting Group',
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
'title.reports' => 'Relatórios',
'title.report' => 'Relatório',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projetos',
'title.add_project' => 'Adicionando projeto',
'title.edit_project' => 'Editando projeto',
'title.delete_project' => 'Apagando projeto',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Usuários',
'title.add_user' => 'Adicionando usuário',
'title.edit_user' => 'Editando usuário',
'title.delete_user' => 'Apagando usuário',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
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
// 'title.export' => 'Exporting Group Data',
// 'title.import' => 'Importing Group Data',
'title.options' => 'Opções',
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
// TODO: translate the following.
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
'dropdown.current_week' => 'esta semana',
'dropdown.previous_week' => 'última semana',
'dropdown.selected_week' => 'semana',
'dropdown.current_month' => 'este mês',
'dropdown.previous_month' => 'último mês',
'dropdown.selected_month' => 'mês',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'projetos',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Esqueceu a senha?',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

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
// TODO: translate the following.
// 'form.reports.save_as_favorite' => 'Save as favorite',
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
// 'form.reports.include_billable' => 'billable',
// 'form.reports.include_not_billable' => 'not billable',
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Selecione o período de tempo',
'form.reports.set_period' => 'ou selecionar datas',
'form.reports.show_fields' => 'Exibir campos',
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

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
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
'form.users.manager' => 'Gerente',
// TODO: translate the following.
// 'form.users.comanager' => 'Co-manager',
// 'form.users.rate' => 'Rate',
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
// TODO: translate the following.
// 'form.export.hint' => 'You can export all group data into an xml file. It could be useful if you are migrating data to your own server.',
// 'form.export.compression' => 'Compression',
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: translate the following.
// 'form.import.hint' => 'Import group data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: translate the following.
// 'form.groups.hint' => 'Create a new group by creating a new group manager account.<br>You can also import group data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
// TODO: translate the following.
// 'form.group_edit.12_hours' => '12 hours',
// 'form.group_edit.24_hours' => '24 hours',
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
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
// 'form.mail.invoice_sent' => 'Invoice sent.',

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
