<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  'choisir l\\\'option'.
// Alternatively: use one backslash and surround by double-quotes: "choisir l\'option".
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Portuguese (Português Brasileiro)';
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
'menu.register' => 'Registro',
'menu.profile' => 'Perfil',
'menu.group' => 'Grupo',
'menu.plugins' => 'Plugins',
'menu.time' => 'Tempo',
'menu.puncher' => 'Punch',
'menu.week' => 'Semana',
'menu.expenses' => 'Despesas',
'menu.reports' => 'Relatórios',
'menu.timesheets' => 'Planilha de horas',
'menu.charts' => 'Gráficos',
'menu.projects' => 'Projetos',
'menu.tasks' => 'Tarefas',
'menu.users' => 'Usuários',
'menu.groups' => 'Grupos',
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
'error.registered_recently' => 'Registrado recentemente.',
'error.feature_disabled' => 'Recurso desabilitado.',
'error.field' => 'Dados incorretos "{0}".',
'error.empty' => 'Campo "{0}" está vazio.',
'error.not_equal' => 'Campo "{0}" é diferente do campo "{1}".',
'error.interval' => 'Campo "{0}" precisa ser maior que "{1}".',
'error.project' => 'Selecione projeto.',
'error.task' => 'Selecione tarefa.',
'error.client' => 'Selecione cliente.',
'error.report' => 'Selecione relatório.',
'error.record' => 'Selecione o registro.',
'error.auth' => 'Usuário ou senha incorretos.',
// TODO: translate the following.
// 'error.2fa_code' => 'Invalid 2FA code.',
// 'error.weak_password' => 'Weak password.',
'error.user_exists' => 'Já existe usuário com este login.',
'error.object_exists' => 'Já existe um objeto com este nome.',
'error.invoice_exists' => 'Já existe fatura com este número.',
'error.role_exists' => 'Já existe uma função com este rank.',
'error.no_invoiceable_items' => 'Não há items faturáveis.',
'error.no_records' => 'Não há registros.',
'error.no_login' => 'Não há usuário com este login.',
'error.no_groups' => 'Sua base de dados está vazia. Entre como admin e crie um grupo novo.',
'error.upload' => 'Erro no envio do arquivo.',
'error.range_locked' => 'Período bloqueado.',
'error.mail_send' => 'Erro ao enviar e-mail. Use MAIL_SMTP_DEBUG para diagnósticos.', // "Use" means the same in pt-br as in en.
'error.no_email' => 'Não há e-mail associado a este login.',
'error.uncompleted_exists' => 'Entrada incompleta existente. Feche ou remova-a.',
'error.goto_uncompleted' => 'Ir até a entrada incompleta.',
'error.overlap' => 'O intervalo se sobrepõe com entradas já existentes.',
'error.future_date' => 'Data é no futuro.',
'error.xml' => 'Erro no arquivo XML, linha line %d: %s.',
'error.cannot_import' => 'Não foi possível importar: %s.',
'error.format' => 'Formato de arquivo inválido.',
'error.user_count' => 'Limite na contagem de usuários.',
'error.expired' => 'Data de expiração atingida.',
'error.file_storage' => 'Erro relacionado ao servidor de armazenamento de arquivos.',

// Warning messages.
'warn.sure' => 'Tem certeza?',
'warn.confirm_save' => 'A data mudou. Confirme salvando, não copiando este item.',

// Success messages.
'msg.success' => 'Operação concluída com sucesso.',

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
'button.create_group' => 'Criar grupo',
'button.export' => 'Exportar grupo',
'button.import' => 'Importar grupo',
'button.close' => 'Fechar',
'button.start' => 'Iniciar',
'button.stop' => 'Parar',
'button.approve' => 'Aprovar',
'button.disapprove' => 'Desaprovar',
// TODO: translate the following.
// 'button.sync' => 'Sync', // Used in Android app. The meaning is to synchronize offline time records with server.

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.menu' => 'Menu',
'label.group_name' => 'Nome do grupo',
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
'label.bcc' => 'Bcc',
'label.subject' => 'Assunto',
'label.date' => 'Data',
'label.start_date' => 'Data inicial',
'label.end_date' => 'Data final',
'label.user' => 'Usuário',
'label.users' => 'Usuários',
'label.group' => 'Grupo',
'label.subgroups' => 'Subgrupos',
'label.roles' => 'Funções',
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
'label.notes' => 'Anotações',
'label.item' => 'Item',
'label.cost' => 'Custo',
'label.ip' => 'IP',
'label.day_total' => 'Total diário',
'label.week_total' => 'Total semanal',
'label.month_total' => 'Total mensal',
'label.today' => 'Hoje',
'label.view' => 'Ver',
'label.edit' => 'Editar',
'label.delete' => 'Apagar',
'label.configure' => 'Configurar',
'label.select_all' => 'Selecionar todos',
'label.select_none' => 'Desmarcar todos',
'label.day_view' => 'Visão diária',
'label.week_view' => 'Visão semanal',
'label.puncher' => 'Puncher',
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
'label.page' => 'Página',
'label.condition' => 'Condição',
'label.yes' => 'sim',
'label.no' => 'não',
'label.sort' => 'Ordenar',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Campos personalizados',
'label.monthly_quotas' => 'Cotas mensais',
'label.entity' => 'Entidade',
'label.type' => 'Tipo',
'label.type_dropdown' => 'lista suspensa',
'label.type_text' => 'texto',
'label.required' => 'Obrigatório',
'label.fav_report' => 'Relatório favorito',
'label.schedule' => 'Agenda',
'label.what_is_it' => 'O que é?',
'label.expense' => 'Despesa',
'label.quantity' => 'Quantidade',
'label.paid_status' => 'Status pago',
'label.paid' => 'Pago',
'label.mark_paid' => 'Marcar como pago',
'label.week_note' => 'Anotação da semana',
'label.week_list' => 'Lista da semana',
// TODO: translate the following.
// 'label.weekends' => 'Weekends',
'label.work_units' => 'Unidades de trabalho',
'label.work_units_short' => 'Unidades',
'label.totals_only' => 'Somente totais',
'label.quota' => 'Cota',
'label.timesheet' => 'Planilha de horas',
'label.submitted' => 'Enviado',
'label.approved' => 'Aprovado',
'label.approval' => 'Aprovação de relatório',
'label.mark_approved' => 'Marcar como aprovado',
'label.template' => 'Modelo',
'label.bind_templates_with_projects' => 'Vincular modelos com projetos',
'label.prepopulate_note' => 'Pré-preencher campo de anotação',
'label.attachments' => 'Anexos',
'label.files' => 'Arquivos',
'label.file' => 'Arquivo',
'label.active_users' => 'Usuários ativos',
'label.inactive_users' => 'Usuários inativos',

// Entity names. We use lower case (in English) because they are used in dropdowns, too.
// They are used to associate a custom field with an entity type.
'entity.time' => 'tempo',
'entity.user' => 'usuário',
'entity.project' => 'projeto',

// Form titles.
'title.error' => 'Erro',
'title.success' => 'Sucesso',
'title.login' => 'Login',
// TODO: translate the follolwing.
// 'title.2fa' => 'Two Factor Authentication',
'title.groups' => 'Grupos',
'title.add_group' => 'Adicionando grupo',
'title.edit_group' => 'Editando grupo',
'title.delete_group' => 'Apagando grupo',
'title.reset_password' => 'Resetando a senha',
'title.change_password' => 'Alterando a senha',
'title.time' => 'Tempo',
'title.edit_time_record' => 'Editando entrada de hora',
'title.delete_time_record' => 'Apagando entrada de hora',
'title.time_files' => 'Arquivos de registro de tempo',
'title.puncher' => 'Puncher',
'title.expenses' => 'Gastos',
'title.edit_expense' => 'Editando item de gasto',
'title.delete_expense' => 'Apagando item de gasto',
'title.expense_files' => 'Arquivos de itens de despesas',
'title.reports' => 'Relatórios',
'title.report' => 'Report',
'title.send_report' => 'Enviando relatório',
'title.timesheets' => 'Planilhas de horas',
'title.timesheet' => 'Planilha de horas',
'title.timesheet_files' => 'Arquivos de planilha de horas',
'title.invoice' => 'Fatura',
'title.send_invoice' => 'Enviando fatura',
'title.charts' => 'Gráficos',
'title.projects' => 'Projetos',
'title.project_files' => 'Arquivos do projeto',
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
'title.roles' => 'Funções',
'title.add_role' => 'Adicionando função',
'title.edit_role' => 'Editando função',
'title.delete_role' => 'Apagando função',
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
'title.add_timesheet' => 'Adicionando planilha de horas',
'title.edit_timesheet' => 'Editando planilha de horas',
'title.delete_timesheet' => 'Apagando planilha de horas',
'title.monthly_quotas' => 'Cotas mensais',
'title.export' => 'Exportando dados do grupo',
'title.import' => 'Importando dados do grupo',
'title.options' => 'Opções',
'title.display_options' => 'Opções de exibição',
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
'title.week_view' => 'Visão semanal',
'title.swap_roles' => 'Alteração de funções',
'title.work_units' => 'Unidades de trabalho',
'title.templates' => 'Modelos',
'title.add_template' => 'Adicionando modelo',
'title.edit_template' => 'Editando modelo',
'title.delete_template' => 'Apagando modelo',
'title.edit_file' => 'Editando arquivo',
'title.delete_file' => 'Apagando arquivo',
'title.download_file' => 'Baixando arquivo',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- todos ---',
'dropdown.no' => '--- não ---',
'dropdown.current_day' => 'hoje',
'dropdown.previous_day' => 'ontem',
'dropdown.selected_day' => 'dia',
'dropdown.current_week' => 'esta semana',
'dropdown.previous_week' => 'última semana',
'dropdown.selected_week' => 'semana',
'dropdown.current_month' => 'este mês',
'dropdown.previous_month' => 'último mês',
'dropdown.selected_month' => 'mês',
'dropdown.current_year' => 'este ano',
'dropdown.previous_year' => 'último ano',
'dropdown.selected_year' => 'ano',
'dropdown.all_time' => 'todas as datas',
'dropdown.projects' => 'projetos',
'dropdown.tasks' => 'tarefas',
'dropdown.clients' => 'clientes',
'dropdown.select' => '--- selecione ---',
'dropdown.select_invoice' => '--- selecione fatura ---',
'dropdown.select_timesheet' => '--- selecione planilha de horas ---',
'dropdown.status_active' => 'ativo',
'dropdown.status_inactive' => 'inativo',
'dropdown.delete' => 'apagar',
'dropdown.do_not_delete' => 'não apagar',
'dropdown.approved' => 'aprovado',
'dropdown.not_approved' => 'não aprovado',
'dropdown.paid' => 'pago',
'dropdown.not_paid' => 'não pago',
'dropdown.ascending' => 'ascendente',
'dropdown.descending' => 'descendente',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Esqueceu a senha?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> é um sistema de código aberto de rastreamento do tempo.',

// Email subject and body for two-factor authentication.
// TODO: translate the following.
// 'email.2fa_code.subject' => 'Anuko Time Tracker two-factor authentication code',
// 'email.2fa_code.body' => "Dear User,\n\nYour two-factor authentication code is:\n\n%s\n\n",

// Two-factor authentication form. See example at https://timetracker.anuko.com/2fa.php.
// TODO: translate the following.
// 'form.2fa.hint' => 'Check your email for 2FA code and enter it here.',
// 'form.2fa.2fa_code' => '2FA code',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Pedido para resetar a senha enviado por e-mail.',
'form.reset_password.email_subject' => 'Pedido de alteração de senha no Anuko Time Tracker',
'form.reset_password.email_body' => "Caro usuário,\n\nAlguém do IP %s solicitou a redefinição da senha do Anuko Time Tracker. Visite este link se quiser redefinir sua senha.\n\n%s\n\nAnuko Time Tracker é um sistema de rastreamento de apontamentos de código aberto. Visite https://www.anuko.com para obter mais informações.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Entre com a nova senha e clique em Salvar.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm ou 0.0h)',
'form.time.billable' => 'Faturável',
'form.time.uncompleted' => 'Incompleta',
'form.time.remaining_quota' => 'Cota restante',
'form.time.over_quota' => 'Acima da cota',
'form.time.remaining_balance' => 'Saldo restante',
'form.time.over_balance' => 'Saldo excedente',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Esta entrada foi salva somente com hora de início. Não é um erro.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Nova entrada',

// Reports form. See example at https://timetracker.anuko.com/reports.php.
'form.reports.save_as_favorite' => 'Guardar como favorito',
'form.reports.confirm_delete' => 'Tem certeza que deseja remover este relatório dos favoritos?',
'form.reports.include_billable' => 'faturável',
'form.reports.include_not_billable' => 'não faturável',
'form.reports.include_invoiced' => 'faturado',
'form.reports.include_not_invoiced' => 'não faturado',
'form.reports.include_assigned' => 'atribuído',
'form.reports.include_not_assigned' => 'não atribuído',
'form.reports.include_pending' => 'pendente',
'form.reports.select_period' => 'Selecione o período de tempo',
'form.reports.set_period' => 'ou selecionar datas',
// TODO: translate the following.
// 'form.reports.note_containing' => 'Note containing',
'form.reports.show_fields' => 'Exibir campos',
'form.reports.time_fields' => 'Campos de tempo',
'form.reports.user_fields' => 'Campos de usuário',
// TODO: translate the following.
// 'form.reports.project_fields' => 'Project fields',
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
// 'form.report.per_hour' => 'Per hour',
'form.report.assign_to_invoice' => 'Atribuir a fatura',
'form.report.assign_to_timesheet' => 'Atribuir a planilha de horas',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php.
'form.timesheets.active_timesheets' => 'Planilhas de horas ativas',
'form.timesheets.inactive_timesheets' => 'Planilhas de horas inativas',

// Templates form. See example at https://timetracker.anuko.com/templates.php.
'form.templates.active_templates' => 'Modelos ativos',
'form.templates.inactive_templates' => 'Modelos inativos',

// Invoice form. See example at https://timetracker.anuko.com/invoice_view.php
// (you can get to this form after generating an invoice).
'form.invoice.number' => 'Número da fatura',
'form.invoice.person' => 'Pessoa',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php.
'form.invoice.invoice_to_delete' => 'Fatura a ser apagada',
'form.invoice.invoice_entries' => 'Entradas de fatura',
'form.invoice.confirm_deleting_entries' => 'Confirme a exclusão das entradas de fatura do Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php.
'form.charts.interval' => 'Intervalo',
'form.charts.chart' => 'Gráfico',

// Projects form. See example at https://timetracker.anuko.com/projects.php.
'form.projects.active_projects' => 'Projetos ativos',
'form.projects.inactive_projects' => 'Projetos inativos',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php.
'form.tasks.active_tasks' => 'Tarefas ativas',
'form.tasks.inactive_tasks' => 'Tarefas inativas',

// Users form. See example at https://timetracker.anuko.com/users.php.
// TODO: translate the following.
// 'form.users.uncompleted_entry_today' => 'User has an uncompleted time entry today',
'form.users.uncompleted_entry' => 'O usuário tem uma entrada incompleta',
'form.users.role' => 'Função',
'form.users.manager' => 'Gerente',
'form.users.comanager' => 'Coordenador',
'form.users.rate' => 'Honorário',
'form.users.default_rate' => 'Honorário padrão por hora',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php.
'form.user_edit.swap_roles' => 'Alternar funções',

// Roles form. See example at https://timetracker.anuko.com/roles.php.
'form.roles.active_roles' => 'Funções ativas',
'form.roles.inactive_roles' => 'Funções inativas',
'form.roles.rank' => 'Rank',
'form.roles.rights' => 'Direitos',
'form.roles.assigned' => 'Atribuído',
'form.roles.not_assigned' => 'Não atribuído',

// Clients form. See example at https://timetracker.anuko.com/clients.php.
'form.clients.active_clients' => 'Clientes ativos',
'form.clients.inactive_clients' => 'Clientes inativos',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php.
'form.client.client_to_delete' => 'Cliente a ser apagado',
'form.client.client_entries' => 'Entradas de cliente',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php.
'form.export.hint' => 'Você pode exportar todos os dados do grupo para um arquivo xml. Isto pode ser útil se você estiver migrando os dados para um servidor próprio.',
'form.export.compression' => 'Compressão',
'form.export.compression_none' => 'nenhuma',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importar dados do grupo de um arquivo xml.',
'form.import.file' => 'Selecionar arquivo',
'form.import.success' => 'Importação realizada com sucesso.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
'form.groups.hint' => 'Crie um novo grupo fazendo uma nova conta de gerente.<br>Você também pode importar os dados de um arquivo xml de outro servidor Anuko Time Tracker (não havendo colisão de usuários).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 horas',
'form.group_edit.24_hours' => '24 horas',
'form.group_edit.display_options' => 'Opções de exibição',
'form.group_edit.holidays' => 'Feriados',
'form.group_edit.tracking_mode' => 'Modo de acompanhamento',
'form.group_edit.mode_time' => 'tempo',
'form.group_edit.mode_projects' => 'projetos',
'form.group_edit.mode_projects_and_tasks' => 'projetos e tarefas',
'form.group_edit.record_type' => 'Tipo de entrada',
'form.group_edit.type_all' => 'todos',
'form.group_edit.type_start_finish' => 'início e fim',
'form.group_edit.type_duration' => 'duração',
'form.group_edit.punch_mode' => 'Modo punch',
// TODO: translate the following.
// 'form.group_edit.one_uncompleted' => 'One uncompleted',
'form.group_edit.allow_overlap' => 'Permitir sobreposição',
'form.group_edit.future_entries' => 'Entradas futuros',
'form.group_edit.uncompleted_indicators' => 'Indicadores incompletos',
'form.group_edit.confirm_save' => 'Confirme o salvamento',
'form.group_edit.advanced_settings' => 'Configurações avançadas',

// Advanced Group Settings form. See example at https://timetracker.anuko.com/group_advanced_edit.php.
'form.group_advanced_edit.allow_ip' => 'Permitir IP',
// TODO: Translate the following.
// 'form.group_advanced_edit.password_complexity' => 'Password complexity',
// 'form.group_advanced_edit.2fa' => 'Two factor authentication',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php.
'form.group_delete.hint' => 'Tem certeza de que deseja excluir todo o grupo?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => 'Para',
'form.mail.report_subject' => 'Relatório do Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker é um sistema de código aberto,<br>de rastreamento do tempo. Visite <a href="https://www.anuko.com">www.anuko.com</a> para mais informações.',
'form.mail.report_sent' => 'Relatório enviado.',
'form.mail.invoice_sent' => 'Fatura enviada.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Ano',
'form.quota.month' => 'Mês',
'form.quota.workday_hours' => 'Horas em um dia útil',
'form.quota.hint' => 'Se os valores estiverem vazios, as cotas serão calculadas automaticamente com base nas horas de trabalho e feriados.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
'form.swap.hint' => 'Rebaixe-se a função inferior trocando funções com outra pessoa. Isto não pode ser desfeito.',
'form.swap.swap_with' => 'Trocar função com',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
'form.work_units.minutes_in_unit' => 'Minutos em unidade',
'form.work_units.1st_unit_threshold' => 'Limiar da 1ª unidade',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Usuário',
'role.user.low_case_label' => 'usuário',
'role.user.description' => 'Um membro regular sem direitos de gestão.',
'role.client.label' => 'Cliente',
'role.client.low_case_label' => 'cliente',
'role.client.description' => 'Um cliente pode visualizar seus próprios dados.',
'role.supervisor.label' => 'Supervisor',
'role.supervisor.low_case_label' => 'supervisor',
'role.supervisor.description' => 'Uma pessoa com um pequeno conjunto de direitos de gerenciamento.',
'role.comanager.label' => 'Co-gerente',
'role.comanager.low_case_label' => 'co-gerente',
'role.comanager.description' => 'Uma pessoa com um grande conjunto de funções de gerenciamento.',
'role.manager.label' => 'Gerente',
'role.manager.low_case_label' => 'gerente',
'role.manager.description' => 'Gerente de grupo. Pode fazer a maioria das coisas para um grupo.',
'role.top_manager.label' => 'Gerente geral',
'role.top_manager.low_case_label' => 'gerente geral',
'role.top_manager.description' => 'Principal gerente de grupo. Pode fazer tudo em uma árvore de grupos.',
'role.admin.label' => 'Administrador',
'role.admin.low_case_label' => 'administrador',
'role.admin.description' => 'Adminsitrador do site/sistema.',

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
'form.timesheet_view.submit_subject' => 'Solicitação de aprovação de planilha de horas',
'form.timesheet_view.submit_body' => "Uma nova planilha de horas requer aprovação.<p>Usuário: %s.",
'form.timesheet_view.approve_subject' => 'Planilha de horas aprovada',
'form.timesheet_view.approve_body' => "Sua planilha de horas %s foi aprovada.<p>%s",
'form.timesheet_view.disapprove_subject' => 'Planilha de horas não aprovada',
'form.timesheet_view.disapprove_body' => "Sua planilha de horas %s não foi aprovada.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
'form.display_options.note_on_separate_row' => 'Anotação em linha separada',
'form.display_options.not_complete_days' => 'Dias não completos',
// TODO: translate the following.
// 'form.display_options.inactive_projects' => 'Inactive projects',
// 'form.display_options.cost_per_hour' => 'Cost per hour',
'form.display_options.custom_css' => 'CSS customizado',
// TODO: translate the following.
// 'form.display_options.custom_translation' => 'Custom translation',
);

