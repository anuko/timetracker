<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
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
'menu.subgroups' => 'Subgrupos',
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
'error.user_exists' => 'Já existe usuário com este login.',
'error.object_exists' => 'Já existe um objeto com este nome.',
'error.invoice_exists' => 'Já existe fatura com este número.',
'error.role_exists' => 'Já existe uma função com este rank.',
'error.no_invoiceable_items' => 'Não há items faturáveis.',
'error.no_records' => 'Não há registros.',
'error.no_login' => 'Não há usuário com este login.',
'error.no_groups' => 'Sua base de dados está vazia. Entre como admin e crie um grupo novo.', 
'error.upload' => 'Erro no envio do arquivo.',
'error.range_locked' => 'Período está bloqueado.',
'error.mail_send' => 'Erro enviando o e-mail.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
'error.mail_send' => 'Erro ao enviar e-mail. Use MAIL_SMTP_DEBUG para diagnósticos.',
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
// Entendimento de error.file_storage: ocorreu um erro (não especificado) ao tentar se comunicar com o servidor de armazenamento de arquivos remoto (aquele que lida com anexos). 
// É uma mensagem genérica que nos informa que "algo deu errado" ao tentar fazer alguma operação com anexos.
// Por exemplo, o servidor de armazenamento de arquivos pode estar offline ou a opção de configuração do Time Tracker está errada, etc.
'error.file_storage' => 'Erro relacionado ao servidor de armazenamento de arquivos.',
// Entendimento de error.remote_work: ocorreu um erro (não especificado) ao tentar se comunicar com o servidor "Trabalho Remoto", aquele que suporta o plugin "Trabalho", consulte https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// É uma mensagem genérica nos informando que "algo deu errado" ao tentar fazer alguma operação com o plugin Work.
// Por exemplo, o servidor de Trabalho Remoto pode estar offline, entre outras coisas.
'error.remote_work' => 'Erro relacionado ao servidor responsável pelo plugin work.',

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
'button.create_group' => 'Criar equipe', // TODO: replace "team" with "group".
'button.export' => 'Exportar equipe', // TODO: replace "team" with "group".
'button.import' => 'Importar equipe', // TODO: replace "team" with "group".
'button.close' => 'Fechar',
'button.start' => 'Iniciar',
'button.stop' => 'Parar',
'button.approve' => 'Aprovar',
'button.disapprove' => 'Desaprovar',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.menu' => 'Menu',
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
'label.bcc' => 'Bcc',
'label.subject' => 'Assunto',
'label.date' => 'Data',
'label.start_date' => 'Data inicial',
'label.end_date' => 'Data final',
'label.user' => 'Usuário',
'label.users' => 'Usuários',
'label.group' => 'Grupo',
'label.subgroups' => 'Subgrupos',
'label.roles' => 'Papéis',
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
'label.puncher' => 'Puncher', // Is anderstood as a specific feature without direct translation.I suggest stays as is.
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
'label.condition' => 'Condição',
'label.yes' => 'sim',
'label.no' => 'não',
'label.sort' => 'Ordenar',
// Labels para plug-ins (extensões para Time Tracker que fornecem recursos adicionais).
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
'label.work_units' => 'Unidades de trabalho',
'label.work_units_short' => 'Unidades',
'label.totals_only' => 'Somente totais',
'label.quota' => 'Cota',
'label.timesheet' => 'Planilha de horas', 
'label.submitted' => 'Enviado',
'label.approved' => 'Aprovado',
'label.approval' => 'Aprovação de relatório',
'label.mark_approved' => 'Marcar como apovado',
'label.template' => 'Modelo',
'label.bind_templates_with_projects' => 'Vincular modelos com projetos',
'label.prepopulate_note' => 'Pré-preencher campo de anotação',
'label.attachments' => 'Anexos',
'label.files' => 'Arquivos',
'label.file' => 'Arquivo',
'label.image' => 'Imagem',
'label.download' => 'Download',
'label.active_users' => 'Usuários ativos',
'label.inactive_users' => 'Usuários inativos',
'label.details' => 'Detalhes',
'label.budget' => 'Orçamento',
'label.work' => 'Trabalho',   // Cabeçalho da coluna da tabela para itens de trabalho, consulte https://www.anuko.com/time_tracker/what_is/work_plugin.htm
'label.offer' => 'Oferta', // Cabeçalho da coluna da tabela para ofertas, consulte https://www.anuko.com/time_tracker/what_is/work_plugin.htm
'label.contractor' => 'Contratante', // Cabeçalho da coluna da tabela para contratante (é alguém que oferece um trabalho a ser feito).
                                       // Tecnicamente, é um nome de organização ou uma combinação de nomes de organização e grupo
                                       // porque os itens de trabalho e as ofertas são de propriedade de grupos de usuários do Time Tracker.
'label.how_to_pay' => 'Como pagar', // Rótulo para o campo "Como pagar" nas ofertas, que permite aos contratantes especificar
                                    // como realizará o pagamento, por exemplo: e-mail do paypal, pix, etc.
'label.moderator_comment' => 'Comentário do moderador', // Rótulo de "Comentário do moderador", para o campo que explica algo.

// Nomes de entidades. Usamos letras minúsculas (em inglês) porque elas também são usadas em menus suspensos.
// Eles são usados para associar um campo personalizado a um tipo de entidade.
'entity.time' => 'tempo',
'entity.user' => 'usuário',
'entity.project' => 'projeto',

// Form titles.
'title.error' => 'Erro',
'title.success' => 'Sucesso',
'title.login' => 'Login',
'title.groups' => 'Equipes', // TODO: change "teams" to "groups".
'title.subgroups' => 'Subgrupos',
'title.add_group' => 'Adicionando grupo',
'title.edit_group' => 'Editando equipe', // TODO: change "team" to "group".
'title.delete_group' => 'Apagando equipe', // TODO: change "team" to "group".
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
'title.timesheet_files' => 'Arquivo de planilhas de horas',
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
'title.roles' => 'Papéis',
'title.add_role' => 'Adding Role',
'title.edit_role' => 'Editing Role',
'title.delete_role' => 'Deleting Role',
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
'title.export' => 'Exportando dados de equipe', // TODO: replace "team" with "group".
'title.import' => 'Importando dados de equipe', // TODO: replace "team" with "group".
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
'title.swap_roles' => 'Alteração de papéis',
'title.work_units' => 'Unidades de trabalho',
'title.templates' => 'Modelos',
'title.add_template' => 'Adicionando modelo',
'title.edit_template' => 'Editando modelo',
'title.delete_template' => 'Apagando modelo',
'title.edit_file' => 'Editando arquivo',
'title.delete_file' => 'Apagando arquivo',
'title.download_file' => 'Baixando arquivo',
'title.work' => 'Trabalho',
'title.add_work' => 'Adicionando trabalho',
'title.edit_work' => 'Editando trabalho',
'title.delete_work' => 'Apagando trabalho',
'title.active_work' => 'Trabalho ativo', // Itens de trabalho ativos que este grupo terceiriza para outros grupos.
'title.available_work' => 'Trabalho disponível', // Itens de trabalho disponíveis de outras organizações.
'title.inactive_work' => 'Trabalho inativo', // Itens de trabalho inativos que este grupo estava terceirizando para outros grupos.
'title.pending_work' => 'Trabalho pendente', // Itens de trabalho pendentes de aprovação do moderador.
'title.offer' => 'Oferta',
'title.add_offer' => 'Adicionando oferta',
'title.edit_offer' => 'Editando oferta',
'title.delete_offer' => 'Apagando oferta',
'title.active_offers' => 'Ofertas ativas', // Ofertas ativas que este grupo disponibiliza para outros grupos.
'title.available_offers' => 'Ofertas disponíveis', // Ofertas disponíveis de outras organizações.
'title.inactive_offers' => 'Ofertas inativas', // Ofertas inativas para grupo.
'title.pending_offers' => 'Ofertas pendentes', // Ofertas pendentes de aprovação do moderador.

// Seção para strings comuns dentro de caixas de combinação em formulários. Strings compartilhados entre formulários devem ser colocados aqui.
// Strings que são usados em um único formulário devem ir para a seção específica do formulário.
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
'dropdown.previous_year' => 'ano anterior',
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
'dropdown.pending_approval' => 'aprovação pendente',
'dropdown.approved' => 'aprovado',
'dropdown.not_approved' => 'não aprovado',
'dropdown.paid' => 'pago',
'dropdown.not_paid' => 'não pago',
'dropdown.ascending' => 'ascendente',
'dropdown.descending' => 'descendente',

// Abaixo está uma seção para strings que são usadas em formulários individuais. Quando uma string é usada apenas em um formulário, ela deve ser colocada aqui.
// Uma exceção é para formulários intimamente relacionados, como "Tempo" e "Editando registro de tempo" com controles semelhantes. Em tais casos
// uma string pode ser definida no formulário principal e usada em formulários relacionados. O motivo para isso é tornar o esforço de tradução mais fácil.
// Strings que são usados em vários formulários não relacionados devem ser colocados em seções compartilhadas, como label. <stringname>, etc. 
 

// Formulário de login. Veja exemplo em https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Esqueceu a senha?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> é um sistema de código aberto de rastreamento do tempo.',

// Formulário de resetar a senha. Veja exemplo em https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Pedido para resetar a senha enviado por e-mail.',
'form.reset_password.email_subject' => 'Pedido de alteração de senha no Anuko Time Tracker',
'form.reset_password.email_body' => "Caro usuário, \n\n Alguém do IP %s solicitou a redefinição da senha do Anuko Time Tracker. Visite este link se quiser redefinir sua senha. \n\n%s\n\n Anuko Time Tracker é um sistema de rastreamento de apontamentos de código aberto. Visite https://www.anuko.com para obter mais informações. \n\n",
// "IP %s" provavelmente soa estranho.
'form.reset_password.email_body' => "Prezado usuário,\n\nAlguém, IP %s, solicitou o reset da sua senha do Anuko Time Tracker. Entre nete link para resetar a sua senha.\n\n%s\n\nAnuko Time Tracker é um sistema de código abertois, de rastreamento do tempo. Visite https://www.anuko.com para mais informações.\n\n",

// Formulário de alteração de senha. Veja exemplo em https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Entre com a nova senha e clique em Salvar.',

// Formulário de tempo. Veja exemplo em https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm ou 0.0h)',
'form.time.billable' => 'Faturável',
'form.time.uncompleted' => 'Incompleta',
'form.time.remaining_quota' => 'Cota excedente',
'form.time.over_quota' => 'Acima da cota',
'form.time.remaining_balance' => 'Saldo restante',
'form.time.over_balance' => 'Saldo excedente',

// Editando formulário de registro de tempo. Veja exemplo em https://timetracker.anuko.com/time_edit.php (acesse, editando um registro de tempo incompleto).
'form.time_edit.uncompleted' => 'Eesta entrada foi salva somente com hora de início. Não é um erro.',

// ormulário de visualização de semana. Veja exemplo em https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Nova entrada',

// Formulário de relatórios. Veja exemplo em https://timetracker.anuko.com/reports.php
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
'form.reports.show_fields' => 'Exibir campos',
'form.reports.time_fields' => 'Campos de apontamento',
'form.reports.user_fields' => 'Campos de usuário',
'form.reports.group_by' => 'Agrupar por',
'form.reports.group_by_no' => '--- sem agrupar ---',
'form.reports.group_by_date' => 'data',
'form.reports.group_by_user' => 'usuário',
'form.reports.group_by_client' => 'cliente',
'form.reports.group_by_project' => 'projeto',
'form.reports.group_by_task' => 'tarefa',

// Formulário de relatório. Veja exemplo em https://timetracker.anuko.com/report.php
// (após gerar um relatório em https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportar',
'form.report.assign_to_invoice' => 'Atribuir a fatura',
'form.report.assign_to_timesheet' => 'Atribuir a planilha de horas',

// Formulário de planilha de horas. Veja  exemplo em https://timetracker.anuko.com/timesheets.php
'form.timesheets.active_timesheets' => 'Planilhas de horas ativas',
'form.timesheets.inactive_timesheets' => 'Planilhas de horas inativas',

// Formulário de modelos. Veja exemplo em https://timetracker.anuko.com/templates.php
'form.templates.active_templates' => 'Modelos ativos',
'form.templates.inactive_templates' => 'Modelos inativos',

// Formulário de fatura. Veja exemplo em https://timetracker.anuko.com/invoice.php
// (você pode acessar este formulário após gerar um relatório).
'form.invoice.number' => 'Número da fatura',
'form.invoice.person' => 'Pessoa',

// Formulário de exclusão de fatura. veja exemplo em https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Fatura a ser apagada',
'form.invoice.invoice_entries' => 'Entradas de fatura',
'form.invoice.confirm_deleting_entries' => 'Confirme a exclusão das entradas de fatura do Time Tracker.',

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
'form.users.uncompleted_entry' => 'O usuário tem um apontamento incompleto',
'form.users.role' => 'Papel',
'form.users.manager' => 'Gerente',
'form.users.comanager' => 'Coordenador',
'form.users.rate' => 'Honorário',
'form.users.default_rate' => 'Honorário padrão por hora',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
'form.user_edit.swap_roles' => 'Alternar papéis',

// Roles form. See example at https://timetracker.anuko.com/roles.php
'form.roles.active_roles' => 'Papéis ativos',
'form.roles.inactive_roles' => 'Papéis inativos',
'form.roles.rank' => 'Rank',
'form.roles.rights' => 'Direitos',
'form.roles.assigned' => 'Atribuído',
'form.roles.not_assigned' => 'Não atribuído',

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
'form.group_edit.allow_overlap' => 'Permitir sobreposição',
'form.group_edit.future_entries' => 'Entradas futuros',
'form.group_edit.uncompleted_indicators' => 'Indicadores incompletos',
'form.group_edit.confirm_save' => 'Confirme o salvamento',
'form.group_edit.allow_ip' => 'Permitir IP',
'form.group_edit.advanced_settings' => 'Configurações avançadas',

// Formulário de exclusão de grupo. Veja exemplo em https://timetracker.anuko.com/delete_group.php
'form.group_delete.hint' => 'Tem certeza de que deseja excluir todo o grupo?',

// Formulário de Email. Veja exemplo em https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => 'Para',
'form.mail.report_subject' => 'Relatório do Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker é um sistema de código aberto,<br>de rastreamento do tempo. Visite <a href="https://www.anuko.com">www.anuko.com</a> para mais informações.',
'form.mail.report_sent' => 'Relatório enviado.',
'form.mail.invoice_sent' => 'Fatura enviada.',

// Formulário de configuração de cotas. Veja exemplo em https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Ano',
'form.quota.month' => 'Mês',
'form.quota.workday_hours' => 'Horas em um dia útil',
'form.quota.hint' => 'Se os valores estiverem vazios, as cotas serão calculadas automaticamente com base nas horas de trabalho e feriados.',

// Formulário de alteração de papéis. veja exemplo em https://timetracker.anuko.com/swap_roles.php.
'form.swap.hint' => 'Rebaixe-se a papel inferior trocando funções com outra pessoa. Isto não pode ser desfeito.',
'form.swap.swap_with' => 'Trocar papéis com',

// Formulário de configuração de unidades de trabalho. Veja exemplo em https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
'form.work_units.minutes_in_unit' => 'Minutos em unidade',
'form.work_units.1st_unit_threshold' => 'Limiar da 1ª unidade',

// Funções e direitos. Essas strings são usadas em vários lugares. Agrupados aqui para fornecer traduções consistentes.
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
'role.manager.low_case_label' => 'Gerente',
'role.manager.description' => 'Gerente de grupo. Pode fazer a maioria das coisas para um grupo.',
'role.top_manager.label' => 'Gerente geral',
'role.top_manager.low_case_label' => 'gerente geral',
'role.top_manager.description' => 'Principal gerente de grupo. Pode fazer tudo em uma árvore de grupos.',
'role.admin.label' => 'Administrador',
'role.admin.low_case_label' => 'administrador',
'role.admin.description' => 'Adminsitrador do site/sistema.',

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
'form.timesheet_view.submit_subject' => 'Solicitação de aprovação de planilha de horas',
'form.timesheet_view.submit_body' => "Uma nova planilha de horas requer aprovação. <p> Usuário: %s.",
'form.timesheet_view.approve_subject' => 'Planilha de horas aprovada',
'form.timesheet_view.approve_body' => "Sua planilha de horas foi aprovada.<p>%s",
'form.timesheet_view.disapprove_subject' => 'Planilha de horas não aprovada',
'form.timesheet_view.disapprove_body' => "Sua planilha de horas %s não foi aprovada.<p>%s",

// Formulário de opções de visualização. Veja exemplo em https://timetracker.anuko.com/display_options.php.
'form.display_options.note_on_separate_row' => 'Anotação em linha separada',
'form.display_options.not_complete_days' => 'Dias não completos',
// 'form.display_options.custom_css' => 'CSS customizado',

// Work plugin strings. See example at https://timetracker.anuko.com/work.php
'work.error.work_not_available' => 'Item de trabalho não está disponível.',
'work.error.offer_not_available' => 'Oferta não disponível',
'work.type.one_time' => 'Uma interação', // O tipo uma interação é usado para "trabalho único", bem definido ("faça exatamente isso").
'work.type.ongoing' => 'Em progresso', // Use o tipo "Em progresso" Para trabalhos complexos (faturado por hora, vários contratados, etc.)
'work.label.own_work' => 'Trabalho próprio',
'work.label.own_offers' => 'Ofertas próprias',
'work.label.offers' => 'Ofertas',
'work.button.send_message' => 'Enviar mensagem',
'work.button.make_offer' => 'Fazer oferta',
'work.button.accept' => 'Aceitar',
'work.button.decline' => 'Recusar',
'work.title.send_message' => 'Enviando mensagem',
'work.msg.message_sent' => 'Mensagem enviada.',
);
