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

$i18n_language = 'Portuguese (Português brasileiro)';
$i18n_months = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$i18n_weekdays = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
$i18n_weekdays_short = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Login',
'menu.logout' => 'Logout',
'menu.forum' => 'Fórum',
'menu.help' => 'Ajuda',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'Perfil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.plugins' => 'Plugins',
'menu.time' => 'Tempo',
// TODO: translate the following.
// 'menu.week' => 'Week',
'menu.expenses' => 'Gastos',
'menu.reports' => 'Relatórios',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
'menu.charts' => 'Gráficos',
'menu.projects' => 'Projetos',
'menu.tasks' => 'Tarefas',
'menu.users' => 'Usuários',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.subgroups' => 'Subgroups',
'menu.export' => 'Exportar',
'menu.clients' => 'Clientes',
'menu.options' => 'Opções',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Você pode contribuir com o Time Tracker de várias maneiras.',
'footer.credits' => 'Créditos',
'footer.license' => 'Licença',
'footer.improve' => 'Contribua',

// Error messages.
'error.access_denied' => 'Acesso negado.',
'error.sys' => 'Erro no sistema.',
'error.db' => 'Erro no banco de dados.',
// TODO: translate the following.
// 'error.registered_recently' => 'Registered recently.',
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Dados incorretos "{0}".',
'error.empty' => 'Campo "{0}" está vazio.',
'error.not_equal' => 'Campo "{0}" é diferente do campo "{1}".',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Selecione projeto.',
'error.task' => 'Selecione tarefa.',
'error.client' => 'Selecione cliente.',
'error.report' => 'Selecione relatório.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Usuário ou senha incorretos.',
'error.user_exists' => 'Já existe usuário com este login.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.invoice_exists' => 'Já existe fatura com este número.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Não há items faturáveis.',
// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
'error.no_login' => 'Não há usuário com este login.',
'error.no_groups' => 'Sua base de dados está vazia. Entre como admin e crie uma equipe nova.', // TODO: replace "team" with "group".
'error.upload' => 'Erro no envio do arquivo.',
'error.range_locked' => 'Período está bloqueado.',
'error.mail_send' => 'Erro enviando o e-mail.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => 'Não há e-mail associado a este login.',
'error.uncompleted_exists' => 'Entrada incompleta existente. Feche ou remova-a.',
'error.goto_uncompleted' => 'Ir até a entrada incompleta.',
'error.overlap' => 'O intervalo se sobrepõe com entradas já existentes.',
'error.future_date' => 'Data é no futuro.',
// TODO: translate the following.
// 'error.xml' => 'Error in XML file at line %d: %s.',
// 'error.cannot_import' => 'Cannot import: %s.',
// 'error.format' => 'Invalid file format.',
// 'error.user_count' => 'Limit on user count.',
// 'error.expired' => 'Expiration date reached.',
// 'error.file_storage' => 'File storage server error.', // See comment in English file.
// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

// Warning messages.
// TODO: translate the following.
// 'warn.sure' => 'Are you sure?',
// 'warn.confirm_save' => 'Date has changed. Confirm saving, not copying this item.',

// Success messages.
// TODO: translate the following.
// 'msg.success' => 'Operation completed successfully.',

// Labels for buttons.
'button.login' => 'Login',
'button.now' => 'Agora',
'button.save' => 'Salvar',
'button.copy' => 'Copiar',
'button.cancel' => 'Cancelar',
'button.submit' => 'Enviar',
'button.add' => 'Adicionar',
'button.delete' => 'Apagar',
'button.generate' => 'Criar',
'button.reset_password' => 'Resetar senha',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar por e-mail',
'button.create_group' => 'Criar equipe', // TODO: replace "team" with "group".
'button.export' => 'Exportar equipe', // TODO: replace "team" with "group".
'button.import' => 'Importar equipe', // TODO: replace "team" with "group".
'button.close' => 'Fechar',
'button.stop' => 'Parar',
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
'label.group_name' => 'Nome da equipe',  // TODO: replace "team" with "group".
'label.address' => 'Endereço',
'label.currency' => 'Moeda',
'label.manager_name' => 'Nome do gerente',
'label.manager_login' => 'Login do gerente',
'label.person_name' => 'Nome',
'label.thing_name' => 'Nome',
'label.login' => 'Login',
'label.password' => 'Senha',
'label.confirm_password' => 'Confirme a senha',
'label.email' => 'E-mail',
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Assunto',
'label.date' => 'Data',
'label.start_date' => 'Data inicial',
'label.end_date' => 'Data final',
'label.user' => 'Usuário',
'label.users' => 'Usuários',
// TODO: translate the following.
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
// 'label.roles' => 'Roles',
'label.client' => 'Cliente',
'label.clients' => 'Clientes',
'label.option' => 'Opção',
'label.invoice' => 'Fatura',
'label.project' => 'Projeto',
'label.projects' => 'Projetos',
'label.task' => 'Tarefa',
'label.tasks' => 'Tarefas',
'label.description' => 'Descrição',
'label.start' => 'Início',
'label.finish' => 'Fim',
'label.duration' => 'Duração',
'label.note' => 'Anotação',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Item',
'label.cost' => 'Custo',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Total diário',
'label.week_total' => 'Total semanal',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Hoje',
'label.view' => 'Ver',
'label.edit' => 'Editar',
'label.delete' => 'Apagar',
'label.configure' => 'Configurar',
'label.select_all' => 'Selecionar todos',
'label.select_none' => 'Desmarcar todos',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Idioma',
'label.decimal_mark' => 'Ponto decimal',
'label.date_format' => 'Formato da data',
'label.time_format' => 'Formato da hora',
'label.week_start' => 'Primeiro dia da semana',
'label.comment' => 'Anotação',
'label.status' => 'Status',
'label.tax' => 'Imposto',
'label.subtotal' => 'Subtotal',
'label.total' => 'Total',
'label.client_name' => 'Nome do cliente',
'label.client_address' => 'Endereço do cliente',
'label.or' => 'ou',
'label.error' => 'Erro',
'label.ldap_hint' => 'Entre com o seu <b>login do Windows</b> e <b>senha</b> nos campos abaixo.',
'label.required_fields' => '* - campos obrigatórios',
'label.on_behalf' => 'em nome de',
'label.role_manager' => '(gerente)',
'label.role_comanager' => '(coordenador)',
'label.role_admin' => '(administrador)',
'label.page' => 'Página',
// TODO: translate the following.
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Campos personalizados',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
// TODO: translate the following.
// 'label.entity' => 'Entity',
'label.type' => 'Tipo',
'label.type_dropdown' => 'lista suspensa',
'label.type_text' => 'texto',
'label.required' => 'Obrigatório',
'label.fav_report' => 'Relatório favorito',
'label.schedule' => 'Agenda',
'label.what_is_it' => 'O que é?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_menu' => 'Week menu',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
'label.totals_only' => 'Somente totais',
// TODO: translate the following.
// 'label.quota' => 'Quota',
// 'label.timesheet' => 'Timesheet',
// 'label.submitted' => 'Submitted',
// 'label.approved' => 'Approved',
// 'label.approval' => 'Report approval',
// 'label.mark_approved' => 'Mark approved',
// 'label.template' => 'Template',
// 'label.bind_templates_with_projects' => 'Bind templates with projects',
// 'label.prepopulate_note' => 'Prepopulate Note field',
// 'label.attachments' => 'Attachments',
// 'label.files' => 'Files',
// 'label.file' => 'File',
// 'label.image' => 'Image',
// 'label.download' => 'Download',
'label.active_users' => 'Usuários ativos',
'label.inactive_users' => 'Usuários inativos',
// TODO: translate the following.
// 'label.details' => 'Details',
// 'label.budget' => 'Budget',
// 'label.work' => 'Work',   // Table column header for work items, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.offer' => 'Offer', // Table column header for offers, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.contractor' => 'Contractor', // Table column header for offers (contractor is someone who offers to do work).
                                       // Technically, it is either an org name or a combination of org and group names
                                       // because both work items and offers are owned by Time Tracker groups of users.
// 'label.how_to_pay' => 'How to pay', // Label for the "How to pay" field on offers, which allows contractors to specify
                                       // how to pay them, for example: paypal email, check by mail to a specific address, etc.
// 'label.moderator_comment' => 'Moderator comment', // Label for "Moderator comment" field that explains something.

// Entity names. We use lower case (in English) because they are used in dropdowns, too.
// They are used to associate a custom field with an entity type.
// TODO: translate the following.
// 'entity.time' => 'time',
// 'entity.user' => 'user',
// 'entity.project' => 'project',

// Form titles.
'title.error' => 'Erro',
// TODO: Translate the following.
// 'title.success' => 'Success',
'title.login' => 'Login',
'title.groups' => 'Equipes', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.subgroups' => 'Subgroups',
// 'title.add_group' => 'Adding Group',
'title.edit_group' => 'Editando equipe', // TODO: change "team" to "group".
'title.delete_group' => 'Apagando equipe', // TODO: change "team" to "group".
'title.reset_password' => 'Resetando a senha',
'title.change_password' => 'Alterando a senha',
'title.time' => 'Tempo',
'title.edit_time_record' => 'Editando entrada de hora',
'title.delete_time_record' => 'Apagando entrada de hora',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
'title.expenses' => 'Gastos',
'title.edit_expense' => 'Editando item de gasto',
'title.delete_expense' => 'Apagando item de gasto',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.reports' => 'Relatórios',
'title.report' => 'Report',
'title.send_report' => 'Enviando relatório',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'Fatura',
'title.send_invoice' => 'Enviando fatura',
'title.charts' => 'Gráficos',
'title.projects' => 'Projetos',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
'title.add_project' => 'Adicionando projeto',
'title.edit_project' => 'Editando projeto',
'title.delete_project' => 'Apagando projeto',
'title.tasks' => 'Tarefas',
'title.add_task' => 'Adicionando tarefa',
'title.edit_task' => 'Editando tarefa',
'title.delete_task' => 'Apagando tarefa',
'title.users' => 'Usuários',
'title.add_user' => 'Adicionando usuário',
'title.edit_user' => 'Editando usuário',
'title.delete_user' => 'Apagando usuário',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Clientes',
'title.add_client' => 'Adicionando cliente',
'title.edit_client' => 'Editando cliente',
'title.delete_client' => 'Apagando cliente',
'title.invoices' => 'Faturas',
'title.add_invoice' => 'Adicionando fatura',
'title.view_invoice' => 'Vendo fatura',
'title.delete_invoice' => 'Apagando fatura',
'title.notifications' => 'Notificações',
'title.add_notification' => 'Adicionando notificação',
'title.edit_notification' => 'Editando notificação',
'title.delete_notification' => 'Apagando notificação',
// TODO: translate the following.
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Exportando dados de equipe', // TODO: replace "team" with "group".
'title.import' => 'Importando dados de equipe', // TODO: replace "team" with "group".
'title.options' => 'Opções',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
'title.profile' => 'Perfil',
'title.plugins' => 'Plugins',
'title.cf_custom_fields' => 'Campos personalizados',
'title.cf_add_custom_field' => 'Adicionando campo personalizado',
'title.cf_edit_custom_field' => 'Editando campo personalizado',
'title.cf_delete_custom_field' => 'Apagando campo personalizado',
'title.cf_dropdown_options' => 'Opções da lista suspensa',
'title.cf_add_dropdown_option' => 'Adicionando opção',
'title.cf_edit_dropdown_option' => 'Editando opção',
'title.cf_delete_dropdown_option' => 'Apagando opção',
'title.locking' => 'Bloquear',
// TODO: translate the following.
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',
// 'title.work_units' => 'Work Units',
// 'title.templates' => 'Templates',
// 'title.add_template' => 'Adding Template',
// 'title.edit_template' => 'Editing Template',
// 'title.delete_template' => 'Deleting Template',
// 'title.edit_file' => 'Editing File',
// 'title.delete_file' => 'Deleting File',
// 'title.download_file' => 'Downloading File',
// 'title.work' => 'Work',
// 'title.add_work' => 'Adding Work',
// 'title.edit_work' => 'Editing Work',
// 'title.delete_work' => 'Deleting Work',
// 'title.active_work' => 'Active Work', // Active work items this group outsources to other groups.
// 'title.available_work' => 'Available Work', // Available work items from other organizations.
// 'title.inactive_work' => 'Inactive Work', // Inactive work items this group was outsourcing to other groups.
// 'title.pending_work' => 'Pending Work', // Work items pending moderator approval.
// 'title.offer' => 'Offer',
// 'title.add_offer' => 'Adding Offer',
// 'title.edit_offer' => 'Editing Offer',
// 'title.delete_offer' => 'Deleting Offer',
// 'title.active_offers' => 'Active Offers', // Active offers this group makes available to other groups.
// 'title.available_offers' => 'Available Offers', // Available offers from other organizations.
// 'title.inactive_offers' => 'Inactive Offers', // Inactive offers for group.
// 'title.pending_offers' => 'Pending Offers', // Offers pending moderator approval.

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- todos ---',
'dropdown.no' => '--- não ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'dia',
'dropdown.current_week' => 'esta semana',
'dropdown.previous_week' => 'última semana',
'dropdown.selected_week' => 'semana',
'dropdown.current_month' => 'este mês',
'dropdown.previous_month' => 'último mês',
'dropdown.selected_month' => 'mês',
'dropdown.current_year' => 'este ano',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'ano',
'dropdown.all_time' => 'todas as datas',
'dropdown.projects' => 'projetos',
'dropdown.tasks' => 'tarefas',
'dropdown.clients' => 'clientes',
'dropdown.select' => '--- selecione ---',
'dropdown.select_invoice' => '--- selecione fatura ---',
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'ativo',
'dropdown.status_inactive' => 'inativo',
'dropdown.delete' => 'apagar',
'dropdown.do_not_delete' => 'não apagar',
// TODO: translate the following.
// 'dropdown.pending_approval' => 'pending approval',
// 'dropdown.approved' => 'approved',
// 'dropdown.not_approved' => 'not approved',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',
// 'dropdown.ascending' => 'ascending',
// 'dropdown.descending' => 'descending',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Esqueceu a senha?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> é um sistema, simples, de fácil uso, de código aberto, de rastreamento do tempo.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Pedido para resetar a senha enviado por e-mail.',
'form.reset_password.email_subject' => 'Pedido de alteração de senha no Anuko Time Tracker',
// TODO: English string has changed. "from IP" added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Prezado usuário,\n\nAlguém, IP %s, solicitou o reset da sua senha do Anuko Time Tracker. Entre nete link para resetar a sua senha.\n\n%s\n\nAnuko Time Tracker é um sistema, simples, de fácil uso, de código abertois, de rastreamento do tempo. Visite https://www.anuko.com para mais informações.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Entre com a nova senha e clique em Salvar.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm ou 0.0h)',
'form.time.billable' => 'Faturável',
'form.time.uncompleted' => 'Incompleta',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Eesta entrada foi salva somente com hora de início. Não é um erro.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Guardar como favorito',
'form.reports.confirm_delete' => 'Tem certeza que deseja remover este relatório dos favoritos?',
'form.reports.include_billable' => 'faturável',
'form.reports.include_not_billable' => 'não faturável',
'form.reports.include_invoiced' => 'faturado',
'form.reports.include_not_invoiced' => 'não faturado',
// TODO: translate the following.
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'Selecione o período de tempo',
'form.reports.set_period' => 'ou selecionar datas',
'form.reports.show_fields' => 'Exibir campos',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'Agrupar por',
'form.reports.group_by_no' => '--- sem agrupar ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'usuário',
'form.reports.group_by_client' => 'cliente',
'form.reports.group_by_project' => 'projeto',
'form.reports.group_by_task' => 'tarefa',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportar',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',
// 'form.report.assign_to_timesheet' => 'Assign to timesheet',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php
// TODO: translate the following.
// 'form.timesheets.active_timesheets' => 'Active Timesheets',
// 'form.timesheets.inactive_timesheets' => 'Inactive Timesheets',

// Templates form. See example at https://timetracker.anuko.com/templates.php
// TODO: translate the following.
// 'form.templates.active_templates' => 'Active Templates',
// 'form.templates.inactive_templates' => 'Inactive Templates',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Número da fatura',
'form.invoice.person' => 'Pessoa',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Fatura a ser apagada',
'form.invoice.invoice_entries' => 'Entradas de fatura',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Intervalo',
'form.charts.chart' => 'Gráfico',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Projetos ativos',
'form.projects.inactive_projects' => 'Projetos inativos',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Tarefas ativas',
'form.tasks.inactive_tasks' => 'Tarefas inativas',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Papel',
'form.users.manager' => 'Gerente',
'form.users.comanager' => 'Coordenador',
'form.users.rate' => 'Honorário',
'form.users.default_rate' => 'Honorário padrão por hora',

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
'form.clients.active_clients' => 'Clientes ativos',
'form.clients.inactive_clients' => 'Clientes inativos',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Cliente a ser apagado',
'form.client.client_entries' => 'Entradas de cliente',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Você pode exportar todos os dados da equipe para um arquivo xml. Isto pode ser útil se você estiver migrando os dados para um servidor próprio.',
'form.export.compression' => 'Compressão',
'form.export.compression_none' => 'nenhuma',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importar dados de equipe de um arquivo xml.', // TODO: replace "team" with "group".
'form.import.file' => 'Selecionar arquivo',
'form.import.success' => 'Importação realizada com sucesso.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below (3 places).
'form.groups.hint' => 'Crie uma nova equipe fazendo uma nova conta de gerente.<br>Você também pode importar os dados de um arquivo xml de outro servidor Anuko Time Tracker (não havendo colisão de usuários).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 horas',
'form.group_edit.24_hours' => '24 horas',
// TODO: translate the following.
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
'form.group_edit.tracking_mode' => 'Modo de acompanhamento',
'form.group_edit.mode_time' => 'tempo',
'form.group_edit.mode_projects' => 'projetos',
'form.group_edit.mode_projects_and_tasks' => 'projetos e tarefas',
'form.group_edit.record_type' => 'Tipo de entrada',
'form.group_edit.type_all' => 'todos',
'form.group_edit.type_start_finish' => 'início e fim',
'form.group_edit.type_duration' => 'duração',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.confirm_save' => 'Confirm saving',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.advanced_settings' => 'Advanced settings',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => 'Para',
'form.mail.report_subject' => 'Relatório do Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker é um sistema, simples, de fácil uso, de código aberto,<br>de rastreamento do tempo. Visite <a href="https://www.anuko.com">www.anuko.com</a> para mais informações.',
'form.mail.report_sent' => 'Relatório enviado.',
'form.mail.invoice_sent' => 'Fatura enviada.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
// TODO: translate the following.
// 'form.work_units.minutes_in_unit' => 'Minutes in unit',
// 'form.work_units.1st_unit_threshold' => '1st unit threshold',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own data.',
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

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
// TODO: translate the following.
// 'form.timesheet_view.submit_subject' => 'Timesheet approval request',
// 'form.timesheet_view.submit_body' => "A new timesheet requires approval.<p>User: %s.",
// 'form.timesheet_view.approve_subject' => 'Timesheet approved',
// 'form.timesheet_view.approve_body' => "Your timesheet %s was approved.<p>%s",
// 'form.timesheet_view.disapprove_subject' => 'Timesheet not approved',
// 'form.timesheet_view.disapprove_body' => "Your timesheet %s was not approved.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
// TODO: translate the following.
// 'form.display_options.note_on_separate_row' => 'Note on separate row',
// 'form.display_options.not_complete_days' => 'Not complete days',
// 'form.display_options.custom_css' => 'Custom CSS',

// Work plugin strings. See example at https://timetracker.anuko.com/work.php
// TODO: translate the following.
// 'work.error.work_not_available' => 'Work item is not available.',
// 'work.error.offer_not_available' => 'Offer is not available.',
// 'work.type.one_time' => 'one time', // Work type is "one time job" for well defined work ("do exactly this").
// 'work.type.ongoing' => 'ongoing',   // Work type is "ongoing" for complex jobs (billed by the hour, multiple contractors, etc.)
// 'work.label.own_work' => 'Own work',
// 'work.label.own_offers' => 'Own offers',
// 'work.label.offers' => 'Offers',
// 'work.button.send_message' => 'Send message',
// 'work.button.make_offer' => 'Make offer',
// 'work.button.accept' => 'Accept',
// 'work.button.decline' => 'Decline',
// 'work.title.send_message' => 'Sending Message',
// 'work.msg.message_sent' => 'Message sent.',
);
