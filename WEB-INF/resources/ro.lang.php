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
// 'menu.users' => 'Users',
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
'error.project' => 'Selecteaza proiect.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
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
// 'label.person_name' => 'Name',
// 'label.thing_name' => 'Name',
// 'label.login' => 'Login',
'label.password' => 'Parola',
'label.confirm_password' => 'Confirma parola',
'label.email' => 'E-mail',
'label.cc' => 'Copie',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Subiect',
// TODO: translate the following.
// 'label.date' => 'Date',
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
'label.delete' => 'Sterge',
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
'label.total' => 'Total',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
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
// 'label.fav_report' => 'Favorite report',
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',



// TODO: refactoring ongoing down from here.

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => 'proiect',
"form.filter.filter" => 'rapoarte favorite',
"form.filter.filter_new" => 'salveaza ca favorit',
// Note to translators: the string below is missing and must be added and translated 
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'autentificare',
"form.login.login" => 'autentifica', 

// password reminder form attributes
"form.fpass.title" => 'reseteaza parola',
"form.fpass.login" => 'autentifica', 
"form.fpass.send_pass_str" => 'cererea de resetare a parolei a fost trimisa',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker - cerere de resetare a parolei',
// Note to translators: the ending of this string below needs to be translated.
"form.fpass.send_pass_body" => "Draga Utilizator,\n\nCineva, posibil tu, a cerut resetarea parolei pentru contul Anuko Time Tracker. Te rog, viziteaza acesta legatura daca doresti sa iti resetezi parola.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "pentru resetarea parolei introdu-o si da click pe salveaza",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'adauga o noua echipa prin adaugarea unui nou cont de tip manager.<br>deasemeni poti importa datele despre echipa dintr-un fisier xml generat de un alt server Anuko Time Tracker  (nu sunt permise duplicate pentru emailuri).',

"form.admin.change_pass" => 'schimba parola contului de administrator',
"form.admin.profile.title" => 'echipe',
"form.admin.profile.noprofiles" => 'baza de date este goala. intra ca admin si adauga o noua echipa.',
"form.admin.profile.comment" => 'sterge echipa',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'nunme',
"form.admin.profile.th.edit" => 'editeaza',
"form.admin.profile.th.del" => 'sterge',
"form.admin.profile.th.active" => 'activ',
// Note to translators: the strings below are missing and must be added and translated 
// "form.admin.options" => 'options',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'timpul meu',
"form.mytime.edit_title" => 'editarea inregistrarii timpului',
"form.mytime.del_str" => 'stergerea inregistrarii timpului',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'data',
"form.mytime.project" => 'proiect',
"form.mytime.activity" => 'activitate',
"form.mytime.start" => 'inceput',
"form.mytime.finish" => 'sfarsit',
"form.mytime.duration" => 'durata',
"form.mytime.note" => 'nota',
"form.mytime.behalf" => 'activitatea zilnica pentru',
"form.mytime.daily" => 'activitatea zilnica',
"form.mytime.total" => 'ore total: ',
"form.mytime.th.project" => 'proiect',
"form.mytime.th.activity" => 'activitate',
"form.mytime.th.start" => 'inceput',
"form.mytime.th.finish" => 'sfarsit',
"form.mytime.th.duration" => 'durata',
"form.mytime.th.note" => 'nota',
"form.mytime.th.edit" => 'editeaza',
"form.mytime.th.delete" => 'sterge',
"form.mytime.del_yes" => 'inregistrarea timului a fost stearsa cu succes',
"form.mytime.no_finished_rec" => 'aceasta inregistrare a fost salvata numei cu timpul de inceput. nu este o eroare. poti parasi aplicatia daca este nevoie.',
// Note to translators: the strings below are missing and must be added and translated 
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'creazaun nou cont de tip manager',
"form.profile.edit_title" => 'editeaza profilul',
"form.profile.name" => 'nume',
// Note to translators: the string below is missing and must be added and translated 
// "form.profile.login" => 'login',

// Note to translators: the strings below are missing and must be added and translated 
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'persoane',
"form.people.createu_str" => 'adaugare untilizator nou',
"form.people.edit_str" => 'editare utilizator',
"form.people.del_str" => 'stergee utilizator',
"form.people.th.name" => 'nume',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.th.login" => 'login',
"form.people.th.role" => 'functie',
"form.people.th.edit" => 'editeaza',
"form.people.th.del" => 'sterge',
"form.people.th.status" => 'stare',
"form.people.th.project" => 'proiect',
"form.people.th.rate" => 'rata',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'utilizator',
"form.people.name" => 'nume',
// Note to translators: "form.people.login" => 'e-mail', // email has been changed to login

"form.people.rate" => 'pret pe ora implicit',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'proiecte',

// projects form attributes
"form.project.proj_title" => 'proiecte',
"form.project.edit_str" => 'editare proiect',
"form.project.add_str" => 'adauagre proiect nou',
"form.project.del_str" => 'stergere proiect',
"form.project.th.name" => 'nume',
"form.project.th.edit" => 'editeaza',
"form.project.th.del" => 'sterge',
"form.project.name" => 'nume',

// activities form attributes
"form.activity.act_title" => 'activitati',
"form.activity.add_title" => 'adaugare activitate noua',
"form.activity.edit_str" => 'editare activitate',
"form.activity.del_str" => 'stergere activitate',
"form.activity.name" => 'nume',
"form.activity.project" => 'proiect',
"form.activity.th.name" => 'nume',
"form.activity.th.project" => 'proiect',
"form.activity.th.edit" => 'editare',
"form.activity.th.del" => 'stergere',

// report attributes
"form.report.title" => 'rapoarte',
"form.report.from" => 'data inceput',
"form.report.to" => 'data sfarsit',
"form.report.groupby_user" => 'utilizator',
"form.report.groupby_project" => 'proiect',
"form.report.groupby_activity" => 'activitate',
"form.report.duration" => 'durata',
"form.report.start" => 'inceput',
"form.report.activity" => 'activitate',
"form.report.show_idle" => 'arata liber',
"form.report.finish" => 'sfarsit',
"form.report.note" => 'nota',
"form.report.project" => 'proiect',
"form.report.totals_only" => 'numai totaluri',
"form.report.total" => 'ore total',
"form.report.th.empllist" => 'utilizator',
"form.report.th.date" => 'data',
"form.report.th.project" => 'proiect',
"form.report.th.activity" => 'activitate',
"form.report.th.start" => 'inceput',
"form.report.th.finish" => 'sfarsit',
"form.report.th.duration" => 'durata',
"form.report.th.note" => 'nota',

// mail form attributes
"form.mail.from" => 'de la',
"form.mail.to" => 'catre',
"form.mail.comment" => 'comentariu',
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
"form.invoice.date" => 'data',
"form.invoice.number" => 'numar factura',
"form.invoice.tax" => 'taxa',
"form.invoice.comment" => 'comentariu ',
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
"form.client.th.name" => 'nume',
"form.client.th.edit" => 'editeaza',
"form.client.th.del" => 'sterge',
"form.client.name" => 'nume',
"form.client.tax" => 'taxa',
"form.client.comment" => 'comentariu ',

// miscellaneous strings
"forward.forgot_password" => 'parola pierduta?',
"forward.edit" => 'editeaza',
"forward.delete" => 'sterge',
"forward.tocsvfile" => 'exporta date in fisier .csv',
// Note to translators: the string below is missing and must be added and translated 
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'genereaza factura',
"forward.change" => 'configureaza clienti',

// strings inside contols on forms
"controls.select.project" => '--- alege proiect    ---',
"controls.select.activity" => '--- alege activitate ---',
"controls.select.client" => '--- alege client     ---',
"controls.project_bind" => '--- toate ---',
"controls.all" => '--- toate ---',
"controls.notbind" => '--- nu ---',
"controls.per_tm" => 'luna curenta',
"controls.per_lm" => 'luna trecuta',
"controls.per_tw" => 'saptamana curenta',
"controls.per_lw" => 'saptamana trecuta',
// Note to translators: the strings below must be translated
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year'
"controls.sel_period" => '--- alege perioada ---',
"controls.sel_groupby" => '--- fara grupare   ---',
// Note to translators: the strings below must be translated
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be added and translated 
// "label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>in numele %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'nu exista inregistrari',
"label.today" => 'astazi',
"label.req_fields" => '* date obligatorii',
"label.sel_project" => 'alege proiect',
"label.sel_activity" => 'alege activitate',
"label.sel_tp" => 'alege perioada',
"label.set_tp" => 'sau introdu intervalul de date',
"label.fields" => 'arata campuri',
"label.group_title" => 'grupat dupa',
// Note to translators: the string below is missing and must be added and translated 
// "label.include_title" => 'include records',
"label.inv_str" => 'factura',
"label.set_empl" => 'alege utilizatori',
"label.sel_all" => 'selecteaza   tot',
"label.sel_none" => 'deselecteaza tot',
"label.or" => 'sau',
"label.disable" => 'inactiv',
"label.enable" => 'activ',
"label.filter" => 'filtru',
// Note to translators: the strings below are missing and must be added and translated 
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
