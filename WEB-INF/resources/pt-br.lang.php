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

$i18n_language = 'Português do Brasil';
$i18n_months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$i18n_weekdays = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
// Note to translators: $i18n_weekdays_short needs to be translated. These are shortened days of week.
$i18n_weekdays_short = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
// format mm/dd
$i18n_holidays = array('01/01', '04/21', '05/01', '09/07', '10/12', '11/15', '12/25');
$i18n_key_words = array(

// Menus.
'menu.login' => 'Login',
'menu.logout' => 'Logout',
// TODO: Translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'Ajuda',
'menu.create_team' => 'Criar nova organização', // TODO: is this good? An organization may have multiple teams in TT.
'menu.profile' => 'Perfil',
'menu.time' => 'Tempo',
'menu.expenses' => 'Gastos',
'menu.reports' => 'Relatórios',
'menu.charts' => 'Gráficos',
'menu.projects' => 'Projetos',
'menu.tasks' => 'Tarefas',
'menu.users' => 'Usuários',
'menu.teams' => 'Organização',
'menu.export' => 'Exportar',
'menu.clients' => 'Clientes',
'menu.options' => 'Opções',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Você pode contribuir com o Time Tracker de várias maneiras.',
'footer.credits' => 'Créditos',
'footer.license' => 'Licença',
'footer.improve' => 'Contribuir',

// Error messages.
'error.access_denied' => 'Acesso negado.',
'error.sys' => 'Erro no sistema.',
'error.db' => 'Erro no banco de dados.',
'error.field' => 'Dados incorretos "{0}".',
'error.empty' => 'Campo "{0}" está vazio.',
'error.not_equal' => 'Campo "{0}" é diferente do campo "{1}".',
'error.interval' => 'Intervalo incorreto.',
'error.project' => 'Selecione projeto.',
// TODO: translate the following:
// 'error.task' => 'Select task.',
'error.client' => 'Selecionar cliente.',
// 'error.report' => 'Select report.',
'error.auth' => 'Usuário ou senha incorretos.',
'error.user_exists' => 'Já existe usuário com este login.',
'error.project_exists' => 'Já existe projeto com este nome.',
// TODO: translate the following:
// 'error.task_exists' => 'Task with this name already exists.',
'error.client_exists' => 'Já existe cliente com este nome.',
// TODO: translate the following:
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
'error.no_teams' => 'Sua base de dados está vazia. Entre como admin e crie uma organização nova.',
// TODO: translate the following:
// 'error.upload' => 'File upload error.',
'error.range_locked' => 'Período está bloqueado.',
'error.mail_send' => 'Erro enviando o e-mail.',
'error.no_email' => 'Não há e-mail associado a este login.',
'error.uncompleted_exists' => 'Entrada incompleta existente. Feche ou remova-a.',
'error.goto_uncompleted' => 'Ir até entrada incompleta.',
// TODO: translate the following:
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Agora',
'button.save' => 'Salvar',
// TODO: translate the following:
// 'button.copy' => 'Copy',
'button.cancel' => 'Cancelar',
'button.submit' => 'Enviar',
// TODO: translate the following:
// 'button.add_user' => 'Add user',
'button.add_project' => 'Adicionar projeto',
// TODO: translate the following:
// 'button.add_task' => 'Add task',
'button.add_client' => 'Adicionar cliente',
// TODO: translate the following:
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Adicionar',
'button.generate' => 'Criar',
'button.reset_password' => 'Resetar senha',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar por e-mail',
'button.create_team' => 'Criar organização',
'button.export' => 'Exportar organização',
'button.import' => 'Importar organização',
// TODO: translate the following:
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Nome da organização',
// TODO: translate the following:
// 'label.address' => 'Address',
'label.currency' => 'Moeda',
'label.manager_name' => 'Nome do gerente',
'label.manager_login' => 'Login do gerente',
'label.person_name' => 'Nome',
'label.thing_name' => 'Nome',
'label.login' => 'Login',
'label.password' => 'Senha',
'label.confirm_password' => 'Confirme a senha',
'label.email' => 'E-mail',
'label.date' => 'Data',
'label.start_date' => 'Data inicial',
'label.end_date' => 'Data final',
'label.user' => 'Usuário',
// 'label.users' => 'Users',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
'label.invoice' => 'Fatura',
'label.project' => 'Projeto',
'label.projects' => 'Projetos',
// TODO: translate the following:
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Início',
'label.finish' => 'Fim',
'label.duration' => 'Duração',
'label.note' => 'Anotação',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.week_total' => 'Week total',
// 'label.day_total' => 'Day total',
// 'label.today' => 'Today',
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Editar',
'label.delete' => 'Apagar',
// TODO: translate the following:
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
'label.id' => 'ID',
'label.language' => 'Idioma',
// TODO: translate the following:
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'Formato da data',
'label.time_format' => 'Formato da hora',
'label.week_start' => 'Primeiro dia da semana',
'label.comment' => 'Anotação',
'label.status' => 'Status',
// TODO: translate the following:
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
'label.role_manager' => '(gerente)',
// 'label.role_comanager' => '(co-manager)',
'label.role_admin' => '(administrador)',
'label.page' => 'Página',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// TODO: translate the following:
// 'label.custom_fields' => 'Custom fields',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
'label.fav_report' => 'Relatório favorito',
// TODO: translate the following:
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',

// Form titles.
'title.login' => 'Login',
'title.teams' => 'Organizações',
// TODO: translate the following:
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
// 'title.reset_password' => 'Resetting Password',
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
'title.edit_time_record' => 'Editando entrada de hora',
'title.delete_time_record' => 'Apagando entrada de hora',
// TODO: translate the following:
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
'title.reports' => 'Relatórios',
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Fatura',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projetos',
'title.add_project' => 'Adicionando projeto',
'title.edit_project' => 'Editando projeto',
'title.delete_project' => 'Apagando projeto',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
// 'title.users' => 'Users',
'title.add_user' => 'Adicionando usuário',
'title.edit_user' => 'Editando usuário',
'title.delete_user' => 'Apagando usuário',
// TODO: translate the following:
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
// 'title.export' => 'Exporting Team Data',
// 'title.import' => 'Importing Team Data',
'title.options' => 'Opções',
'title.profile' => 'Perfil',
// TODO: translate the following:
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
// TODO: translate the following:
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// NOTE TO TRANSLATORS: dropdown.this_day does not necessarily means "today". It means a specific ("this") day selected on calendar. See Charts.
// 'dropdown.this_day' => 'this day',
// 'dropdown.this_week' => 'this week',
// 'dropdown.last_week' => 'last week',
// 'dropdown.this_month' => 'this month',
// 'dropdown.last_month' => 'last month',
// 'dropdown.this_year' => 'this year',
// 'dropdown.all_time' => 'all time',
// 'dropdown.projects' => 'projects',
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'ativo',
// TODO: translate the following:
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',


// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
// TODO: translate the following:
// 'form.login.forgot_password' => 'Forgot password?',
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following:
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
'form.reset_password.email_body' => "Prezado usuário,\n\nAlguém, possivelmente você, solicitou o reset da sua senha do Anuko Time Tracker. Entre nete link para resetar a sua senha.\n\n%s\n\nAnuko Time Tracker é um sistema, simples, de fácil uso, de código abertois, de rastreamento do tempo. Visite https://www.anuko.com para mais informações.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Entre com a nova senha e clique em Salvar.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following:
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Faturável',
'form.time.uncompleted' => 'Incompleta',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Eesta entrada foi salva somente com hora de início. Não é um erro.',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Guardar como favorito',
'form.reports.confirm_delete' => 'Tem certeza que deseja remover este relatório dos favoritos?',
// TODO: translate the following:
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
'form.reports.group_by_user' => 'usuário',
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projeto',
// TODO: translate the following:
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Somente totais',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: translate the following:
// 'form.report.export' => 'Export',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
// TODO: translate the following:
'form.invoice.number' => 'Número da fatura',
// 'form.invoice.person' => 'Person',
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: translate the following:
// 'form.charts.interval' => 'Interval',
// 'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: translate the following:
// 'form.projects.active_projects' => 'Active Projects',
// 'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
// TODO: translate the following:
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following:
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
'form.users.role' => 'Papel',
'form.users.manager' => 'Gerente',
'form.users.comanager' => 'Coordenador',
'form.users.rate' => 'Honorário',
// 'form.users.default_rate' => 'Default hourly rate',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following:
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following:
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
// TODO: translate the following:
// 'form.export.hint' => 'You can export all team data into an xml file. It could be useful if you are migrating data to your own server.',
// 'form.export.compression' => 'Compression',
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
// TODO: translate the following:
// 'form.import.hint' => 'Import team data from an xml file.',
// 'form.import.file' => 'Select file',
// 'form.import.success' => 'Import completed successfully.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' =>  'Crie uma nova organização fazendo uma nova conta de gerente.<br>você também pode importar os dados de um arquivo xml de outro servidor Anuko Time Tracker (não havendo colisão de usuários).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
// TODO: translate the following:
// 'form.profile.12_hours' => '12 hours',
// 'form.profile.24_hours' => '24 hours',
// 'form.profile.tracking_mode' => 'Tracking mode',
// 'form.profile.mode_time' => 'time',
// 'form.profile.mode_projects' => 'projects',
// 'form.profile.mode_projects_and_tasks' => 'projects and tasks',
// 'form.profile.record_type' => 'Record type',
// 'form.profile.type_all' => 'all',
// 'form.profile.type_start_finish' => 'start and finish',
// 'form.profile.type_duration' => 'duration',
// 'form.profile.plugins' => 'Plugins',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'De',
'form.mail.to' => 'Para',
'form.mail.cc' => 'Cc',
'form.mail.subject' => 'Assunto',
// 'form.mail.report_subject' => 'Time Tracker Report',
'form.mail.footer' => 'Anuko Time Tracker é um sistema, simples, de fácil uso, de código aberto,<br>de rastreamento do tempo. Visite <a href="https://www.anuko.com">www.anuko.com</a> para mais informações.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Fatura enviada.',
);






/*
// Some of the strings could propably be reused above... Working on it...

// invoice attributes
"form.invoice.tax" => 'honorário',
"form.invoice.daily_subtotals" => 'subtotais diários'
"form.invoice.yourcoo" => 'seu nome<br> e endereço',
"form.invoice.custcoo" => 'nome do cliente<br> e endereço',
"form.invoice.comment" => 'comentário ',
"form.invoice.th.username" => 'pessoa',
"form.invoice.th.time" => 'horas',
"form.invoice.th.rate" => 'taxa',
"form.invoice.th.summ" => 'quantidade',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" =>'cliente',

// Note to translators: the strings below are missing and must be added and translated 
"form.migration.zip" => 'compressão',
"form.migration.file" => 'selecionar arquivo',
"form.migration.import.title" => 'importar dados',
"form.migration.import.success" => 'importação realizada com sucesso',
"form.migration.import.text" => 'importar dados de organização de um arquivo xml',
"form.migration.export.title" => 'exportar dados',
"form.migration.export.success" => 'exportação realizada com sucesso',
"form.migration.export.text" => 'você pode exportar todos os dados da organização para um arquivo xml. isto pode ser útil se você estiver migrando os dados para um servidor próprio.',
"form.migration.compression.none" => 'nenhuma',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',
"form.client.title" => 'clientes',
"form.client.add_title" => 'adicionar cliente',
"form.client.edit_title" => 'editar cliente',
"form.client.del_title" => 'apagar cliente',
"form.client.th.name" => 'nome',
"form.client.th.edit" => 'editar',
"form.client.th.del" => 'apagar',
"form.client.name" => 'nome',
"form.client.tax" => 'taxa',
"form.client.daily_subtotals" => 'subtotais diários',
"form.client.yourcoo" => 'seu nome<br> e endereço na fatura',
"form.client.custcoo" => 'endereço',
"form.client.comment" => 'comentário ',
// miscellaneous strings
"forward.forgot_password" => 'esqueceu a senha?',
// Note to translators: the strings below must be translated 
"forward.edit" => 'editar',
"forward.delete" => 'apagar',
// Note to translators: the string below must be translated 
"forward.tocsvfile" => 'exportar dados para arquivo .csv',
// Note to translators: the strings below are missing and must be added and translated 
"forward.toxmlfile" => 'exportar dados para arquivo .xml',
"forward.geninvoice" => 'criar fatura',
"forward.change" => 'configurar clientes',
// strings inside contols on forms
"controls.select.project" => '--- selecione projeto ---',
"controls.select.activity" => '--- selecione atividade ---',
// Note to translators: the strings below are missing and must be added and translated 
"controls.select.client" => '--- selecione cliente ---',
"controls.project_bind" => '--- todos ---',
"controls.all" => '--- todos ---',
"controls.notbind" => '--- não ---',
"controls.per_tm" => 'este mês',
"controls.per_lm" => 'último mês',
"controls.per_tw" => 'esta semana',
"controls.per_lw" => 'última semana',
// Note to translators: the strings below are missing and must be added and translated 
"controls.per_td" => 'este dia',
"controls.per_at" => 'tudo',
"controls.per_ty" => 'este ano',
"controls.sel_period" => '--- selecione o período de tempo ---',
// Note to translators: the strings below must be translated 
"controls.sel_groupby" => '--- sem agrupar ---',
"controls.inc_billable" => 'faturável',
"controls.inc_nbillable" => 'não faturável',
"controls.default" => '--- padrão ---',
// labels
// Note to translators: the strings below are missing and must be added and translated 
"label.chart.title1" => 'atividades para o usuário',
"label.chart.title2" => 'projetos para o usuário',
"label.chart.period" => 'gráfico para o período',
"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>em nome de %s</b>',
"label.pminfo" => ' (gerente)',
// Note to translators: the strings below are missing and must be added and translated 
"label.pcminfo" => ' (coordenador)',
"label.painfo" => ' (administrador)',
"label.time_noentry" => 'sem registro',
"label.today" => 'hoje',
"label.req_fields" => '* campos obrigatórios',
// Note to translators: the strings below must be translated 
"label.sel_project" => 'selecione o projeto',
"label.sel_activity" => 'selecione a atividade',
"label.sel_tp" => 'selecione o período de tempo',
"label.set_tp" => 'ou selecionar datas',
"label.fields" => 'exibir campos',
// Note to translators: the strings below must be translated
"label.group_title" => 'agrupar por',
"label.include_title" => 'incluir entradas',
"label.inv_str" => 'fatura',
"label.set_empl" => 'selecione os usuários'
"label.sel_all" => 'selecionar todos',
"label.sel_none" => 'desmarcar todos',
"label.or" => 'ou',
"label.disable" => 'disabilitar',
"label.enable" => 'habilitar',
"label.filter" => 'filtar',
"label.timeweek" => 'total semanal',
"label.hrs" => 'hrs',
"label.errors" => 'erros',
"label.ldap_hint" => 'Entre com o seu <b>login do Windows</b> e <b>senha</b> nos campos abaixo.',
"label.calendar_today" => 'hoje',
"label.calendar_close" => 'fechar',
// login hello text
"login.hello.text" => "Anuko Time Tracker é um sistema, simples, de fácil uso, de código aberto, de rastreamento do tempo.",
);
*/
