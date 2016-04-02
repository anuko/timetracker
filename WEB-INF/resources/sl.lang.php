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

$i18n_language = 'Slovenščina';
$i18n_months = array('januar', 'februar', 'marec', 'april', 'maj', 'junij', 'julij', 'avgust', 'september', 'oktober', 'november', 'december');
$i18n_weekdays = array('nedelja', 'ponedeljek', 'torek', 'sreda', 'četrtek', 'petek', 'sobota');
$i18n_weekdays_short = array('ned', 'pon', 'tor', 'sre', 'čet', 'pet', 'sob');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '02/08', '04/12', '04/13', '04/27', '05/01', '05/02', '06/25', '10/31', '11/01', '12/25', '12/26');

$i18n_key_words = array(

// Menus.
'menu.login' => 'Prijava',
'menu.logout' => 'Odjava',
// TODO: translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'Pomoč',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'Ustvari nov manager račun',
'menu.profile' => 'Profil',
'menu.time' => 'Moj čas', // TODO: Improve this, used to be "My time", now just "Time".
// TODO: translate the following:
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Poročila',
// TODO: translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projekti',
// TODO: translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'Timi',
// TODO: translate the following:
// 'menu.export' => 'Export',
'menu.clients' => 'Stranke',
'menu.options' => 'Možnosti',

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
// 'error.db' => 'Database error.',
// 'error.field' => 'Incorrect "{0}" data.',
// 'error.empty' => 'Field "{0}" is empty.',
// 'error.not_equal' => 'Field "{0}" is not equal to field "{1}".',
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
// 'error.project' => 'Select project.',
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.auth' => 'Incorrect login or password.',
// 'error.user_exists' => 'User with this login already exists.',
// 'error.project_exists' => 'Project with this name already exists.',
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
// 'error.upload' => 'File upload error.',
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// labels for various buttons
'button.login' => 'prijava',
'button.now' => 'zdaj',
// 'button.set' => 'nastavi',
'button.save' => 'shrani',
'button.delete' => 'izbriši',
'button.cancel' => 'prekliči',
'button.submit' => 'potrdi',
'button.add_user' => 'dodaj uporabnika',
'button.add_project' => 'dodaj projekt',
'button.add_activity' => 'dodaj aktivnost',
'button.add_client' => 'dodaj stranko',
'button.add' => 'dodaj',
'button.generate' => 'ustvari',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'pojdi',
'button.send' => 'pošlji',
'button.send_by_email' => 'pošlji preko elektronske pošte',
'button.save_as_new' => 'shrani kot novo',
'button.create_team' => 'ustvari tim',
'button.export' => 'izvozi tim',
'button.import' => 'uvozi tim',
'button.apply' => 'uporabi',

// labels for controls on various forms
// TODO: translate label.team_name and the strings below.
// 'label.team_name' => 'team name',
// 'label.currency' => 'currency',
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.password' => 'geslo',
// 'label.confirm_password' => 'confirm password',
'label.email' => 'email',
'label.total' => 'total',
// Translate the following string.
// 'label.page' => 'Page',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'favorite report',
"form.filter.filter_new" => 'save as favorite',
"form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'prijava',
"form.login.login" => 'prijava',

// password reminder form attributes
"form.fpass.title" => 'razveljavi geslo',
"form.fpass.login" => 'prijava',
"form.fpass.send_pass_str" => 'zahteva za razveljavitev gesla je bila poslana',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker zahteva za razveljavitev gesla',
// Note to translators: the ending of this tring below needs to be translated.
"form.fpass.send_pass_body" => "Spoštovani uporabnik,\n\nNekdo, najverjetneje vi, je zahteval razveljavitev vašega Anuko Time Tracker gesla. Prosimo obiščite to povezavo, če želite razveljaviti vaše geslo.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "za razveljavitev gesla, prosimo vtipkajte geslo in kliknite gumb shrani",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'create a new team by creating a new team manager account.<br>you can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

"form.admin.change_pass" => 'change password of administrator account',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'your database is empty. login as admin and create a new team.',
"form.admin.profile.comment" => 'delete team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'name',
"form.admin.profile.th.edit" => 'edit',
"form.admin.profile.th.del" => 'delete',
"form.admin.profile.th.active" => 'active',
"form.admin.lock.period" => 'lock interval in days',
"form.admin.options" => 'options',
"form.admin.lang_default" => 'site default language',
"form.admin.lang_browser_default" => '(browser default)',
"form.admin.custom_date_format" => "date format",
"form.admin.custom_time_format" => "time format",
"form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'my time',
"form.mytime.edit_title" => 'editing time record',
"form.mytime.del_str" => 'deleting time record',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'date',
"form.mytime.project" => 'project',
"form.mytime.activity" => 'activity',
"form.mytime.start" => 'start',
"form.mytime.finish" => 'finish',
"form.mytime.duration" => 'duration',
"form.mytime.note" => 'note',
"form.mytime.behalf" => 'daily work for',
"form.mytime.daily" => 'daily work',
"form.mytime.total" => 'hours total: ',
"form.mytime.th.project" => 'project',
"form.mytime.th.activity" => 'activity',
"form.mytime.th.start" => 'start',
"form.mytime.th.finish" => 'finish',
"form.mytime.th.duration" => 'duration',
"form.mytime.th.note" => 'note',
"form.mytime.th.edit" => 'edit',
"form.mytime.th.delete" => 'delete',
"form.mytime.del_yes" => 'time record deleted successfully',
"form.mytime.no_finished_rec" => 'this record was saved with only start time. it is not an error. logout if you need to.',
"form.mytime.billable" => 'billable',
"form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
"form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.create_title" => 'creating team',
"form.profile.edit_title" => 'editing profile',
"form.profile.name" => 'name',
"form.profile.login" => 'login',

"form.profile.showchart" => 'show pie charts',
"form.profile.lang" => 'language',
"form.profile.lang_browser_default" => '(browser default)',
"form.profile.custom_date_format" => "date format",
"form.profile.custom_time_format" => "time format",
"form.profile.default_format" => "(default)",
"form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'people',
"form.people.createu_str" => 'creating new user',
"form.people.edit_str" => 'editing user',
"form.people.del_str" => 'deleting user',
"form.people.th.name" => 'name',
"form.people.th.login" => 'login',
"form.people.th.role" => 'role',
"form.people.th.edit" => 'edit',
"form.people.th.del" => 'delete',
"form.people.th.status" => 'status',
"form.people.th.project" => 'project',
"form.people.th.rate" => 'rate',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'user',
"form.people.name" => 'name',
"form.people.login" => 'login',

"form.people.rate" => 'default hourly rate',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projects',

// projects form attributes
"form.project.proj_title" => 'projekti',
"form.project.edit_str" => 'urejanje projektov',
"form.project.add_str" => 'dodajanje novega projekta',
"form.project.del_str" => 'brisanje projekta',
"form.project.th.name" => 'ime',
"form.project.th.edit" => 'uredi',
"form.project.th.del" => 'izbriši',
"form.project.name" => 'ime',

// activities form attributes
"form.activity.act_title" => 'aktivnosti',
"form.activity.add_title" => 'dodajanje novih aktivnosti',
"form.activity.edit_str" => 'urejanje aktivnosti',
"form.activity.del_str" => 'brisanje aktivnosti',
"form.activity.name" => 'ime',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'ime',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'uredi',
"form.activity.th.del" => 'izbriši',

// report attributes
"form.report.title" => 'reports',
"form.report.from" => 'start date',
"form.report.to" => 'end date',
"form.report.groupby_user" => 'user',
"form.report.groupby_project" => 'project',
"form.report.groupby_activity" => 'activity',
"form.report.duration" => 'duration',
"form.report.start" => 'start',
"form.report.activity" => 'activity',
"form.report.show_idle" => 'show idle',
"form.report.finish" => 'finish',
"form.report.note" => 'note',
"form.report.project" => 'project',
"form.report.totals_only" => 'totals only',
"form.report.total" => 'hours total',
"form.report.th.empllist" => 'user',
"form.report.th.date" => 'date',
"form.report.th.project" => 'project',
"form.report.th.activity" => 'activity',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'finish',
"form.report.th.duration" => 'duration',
"form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'od',
"form.mail.to" => 'za',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'predmet',
"form.mail.comment" => 'komentar',
"form.mail.above" => 'pošlji to poročilo preko elektronske pošte',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>sporočilo poslano</b>',

// invoice attributes
"form.invoice.title" => 'invoice',
"form.invoice.caption" => 'invoice',
"form.invoice.above" => 'additional information for invoice',
"form.invoice.select_cust" => 'select client',
"form.invoice.fillform" => 'fill the fields',
"form.invoice.date" => 'date',
"form.invoice.number" => 'invoice number',
"form.invoice.tax" => 'tax',
"form.invoice.daily_subtotals" => 'daily subtotals',
"form.invoice.yourcoo" => 'your name<br> and address',
"form.invoice.custcoo" => 'client name<br> and address',
"form.invoice.comment" => 'comment ',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'hours',
"form.invoice.th.rate" => 'rate',
"form.invoice.th.summ" => 'amount',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.customer" => 'client',
"form.invoice.mailinv_above" => 'send this invoice by e-mail',
"form.invoice.sending_str" => '<b>invoice sent</b>',

"form.migration.zip" => 'compression',
"form.migration.file" => 'select file',
"form.migration.import.title" => 'import data',
"form.migration.import.success" => 'import completed successfully',
"form.migration.import.text" => 'import team data from an xml file',
"form.migration.export.title" => 'export data',
"form.migration.export.success" => 'export completed successfully',
"form.migration.export.text" => 'you can export all team data into an xml file. this could be useful if you are migrating data to your own server.',
"form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'clients',
"form.client.add_title" => 'add client',
"form.client.edit_title" => 'edit client',
"form.client.del_title" => 'delete client',
"form.client.th.name" => 'name',
"form.client.th.edit" => 'edit',
"form.client.th.del" => 'delete',
"form.client.name" => 'name',
"form.client.tax" => 'tax',
"form.client.daily_subtotals" => 'daily subtotals',
"form.client.yourcoo" => 'your name<br> and address in invoice',
"form.client.custcoo" => 'address',
"form.client.comment" => 'comment ',

// miscellaneous strings
"forward.forgot_password" => 'forgot password?',
"forward.edit" => 'edit',
"forward.delete" => 'delete',
"forward.tocsvfile" => 'export data to .csv file',
"forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'generate invoice',
"forward.change" => 'configure clients',

// strings inside contols on forms
"controls.select.project" => '--- select project ---',
"controls.select.activity" => '--- select activity ---',
"controls.select.client" => '--- select client ---',
"controls.project_bind" => '--- all ---',
"controls.all" => '--- all ---',
"controls.notbind" => '--- no ---',
"controls.per_tm" => 'this month',
"controls.per_lm" => 'last month',
"controls.per_tw" => 'this week',
"controls.per_lw" => 'last week',
"controls.per_td" => 'this day',
"controls.per_at" => 'all time',
"controls.per_ty" => 'this year',
"controls.sel_period" => '--- select time period ---',
"controls.sel_groupby" => '--- no grouping ---',
"controls.inc_billable" => 'billable',
"controls.inc_nbillable" => 'not billable',
"controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'aktivnosti uporabnika',
"label.chart.title2" => 'projekti uporabnika',
"label.chart.period" => 'graf za obdobje',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'no entry',
"label.today" => 'today',
"label.req_fields" => '* required fields',
"label.sel_project" => 'select project',
"label.sel_activity" => 'select activity',
"label.sel_tp" => 'select time period',
"label.set_tp" => 'or set dates',
"label.fields" => 'show fields',
"label.group_title" => 'group by',
"label.include_title" => 'include records',
"label.inv_str" => 'invoice',
"label.set_empl" => 'select users',
"label.sel_all" => 'select all',
"label.sel_none" => 'deselect all',
"label.or" => 'or',
"label.disable" => 'disable',
"label.enable" => 'enable',
"label.filter" => 'filter',
"label.timeweek" => 'weekly total',
"label.hrs" => 'hrs',
"label.errors" => 'errors',
"label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
"label.calendar_today" => 'today',
"label.calendar_close" => 'close',

// login hello text
"login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
