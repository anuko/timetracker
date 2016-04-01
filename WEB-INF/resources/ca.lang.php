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

// Menus.
'menu.login' => 'Iniciar sessió',
'menu.logout' => 'Finalitzar sessió',
// TODO: translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'Ajuda',
// Note to translators: menu.create_team needs to be translated more accurately.
'menu.create_team' => 'Crear un nou compte de manejador',
'menu.profile' => 'Perfil',
// 'menu.time' => 'Time',
'menu.time' => 'El meu temps', // TODO: menu.time is no longer "My time", just "Time".
// TODO: translate the following:
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Informes',
// TODO: translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projectes',
// TODO: translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'Equips',
// TODO: translate the following:
// 'menu.export' => 'Export',
// 'menu.clients' => 'Clients',
// 'menu.options' => 'Options',
 
// Footer - strings on the bottom of most pages.
// TODO: translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following:
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'Error de la Base de Dades.',
'error.field' => 'Dada "{0}" incorrecta.',
'error.empty' => 'L\\\'Arxiu "{0}" està buit.',
'error.not_equal' => 'L\\\'Arxiu "{0}" no és igual al arxiu "{1}".',
'error.interval' => 'Interval incorrecte', // TODO: English string changed to 'Field "{0}" must be greater than "{1}".', re-translate.
'error.project' => 'Selleccionar Projecte',
// TODO: translate the following:
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.'

// Refactoring needs to be done down from here to sync with English file.
'error.auth' => 'Usuari o parula de pas incorrecta',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'Ja existeix un projecte amb aquest nom',
'error.activity_exists' => 'Ja existeix una activitat amb aquest nom',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: error.no_login needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'No existeix cap usuari amb aquest e-mail',
'error.upload' => 'Error pujant l\\\'arxiu',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail',
// 'error.no_email' => 'No email associated with this login',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// labels for various buttons
'button.login' => 'Iniciar sessió',
'button.now' => 'Ara',
// 'button.set' => 'Establir',
'button.save' => 'Guardar',
'button.delete' => 'Eliminar',
'button.cancel' => 'Cancel·lar',
'button.submit' => 'Enviar',
'button.add_user' => 'Agregar usuari ',
'button.add_project' => 'Agregar projecte',
'button.add_activity' => 'Agregar activitat',
'button.add_client' => 'Agregar client',
'button.add' => 'Agregar',
'button.generate' => 'Generar',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'Anar',
'button.send' => 'Enviar',
'button.send_by_email' => 'Enviar per correu',
'button.save_as_new' => 'Guardar com a nou',
'button.create_team' => 'Crear grup',
'button.export' => 'Exportar grup',
'button.import' => 'Importar grup',
'button.apply' => 'Aplicar',

// labels for controls on various forms
// TODO: translate label.team_name.
// 'label.team_name' => 'team name',
'label.currency' => 'Moneda',
// TODO: translate these 2 strings below.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.name' => 'Nom',

'label.password' => 'Paraula de pas',
'label.confirm_password' => 'Confirmar paraula de pas',
'label.email' => 'e-mail',
// Translate the following string.
// 'label.page' => 'Page',

"form.filter.project" => 'Projecte',
"form.filter.filter" => 'Report favorit',
"form.filter.filter_new" => 'Guardar com a favorit',

// login form attributes
"form.login.title" => 'Sessió iniciada',
"form.login.login" => 'e-mail',

// password reminder form attributes
"form.fpass.title" => 'Restablir paraula de pas',
"form.fpass.login" => 'e-mail',
"form.fpass.send_pass_str" => 's\\\'ha enviat la petició de restablir paraula de pas',
"form.fpass.send_pass_subj" => 'Sol·licitud de restabliment de la paraula de pas de Anuko Time Tracker',
// Note to translators: this string needs to be translated.
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "Per restablir la paraula de pas, si us plau escrigui-la i faci clic en guardar",

// administrator form
"form.admin.title" => 'Administrador',
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
"form.admin.lock.period" => 'interval de tancament en dies',

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
"form.mail.cc" => 'cc',
"form.mail.subject" => 'Assumpte',
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
"form.invoice.daily_subtotals" => 'Subtotals diaris',
"form.invoice.yourcoo" => 'El seu nom <br> i direcció',
"form.invoice.custcoo" => 'Nom del client <br> i direcció',
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
"form.client.daily_subtotals" => 'Subtotals diaris',
"form.client.yourcoo" => 'El seu nou <br> i direcció a la factura',
"form.client.custcoo" => 'Direcció',
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
