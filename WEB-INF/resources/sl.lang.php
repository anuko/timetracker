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

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option 
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Slovenščina';
$i18n_months = array('januar', 'februar', 'marec', 'april', 'maj', 'junij', 'julij', 'avgust', 'september', 'oktober', 'november', 'december');
$i18n_weekdays = array('nedelja', 'ponedeljek', 'torek', 'sreda', 'četrtek', 'petek', 'sobota');
$i18n_weekdays_short = array('ned', 'pon', 'tor', 'sre', 'čet', 'pet', 'sob');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '02/08', '04/12', '04/13', '04/27', '05/01', '05/02', '06/25', '10/31', '11/01', '12/25', '12/26');

$i18n_key_words = array(

// menu entries
'menu.login' => 'prijava',
'menu.logout' => 'odjava',
'menu.feedback' => 'povratna informacija',
'menu.help' => 'pomoč',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'ustvari nov manager račun',
'menu.edit_profile' => 'uredi profil',
'menu.my_time' => 'moj čas',
'menu.reports' => 'poročila',
// Note to translators: menu.charts needs to be translated.
// 'menu.charts' => 'charts',
'menu.projects' => 'projekti',
'menu.activities' => 'aktivnosti',
'menu.people' => 'ljudje',
'menu.teams' => 'timi',
// Note to translators: menu.export needs to be translated.
// 'menu.export' => 'export',
'menu.clients' => 'stranke',
'menu.options' => 'možnosti',
'menu.admin' => 'admin',

// Note to translators: these strings need to be translated.
// error strings
// 'error.db' => 'database error',
// 'error.field' => 'incorrect "{0}" data',
// 'error.empty' => 'field "{0}" is empty',
// 'error.not_equal' => 'field "{0}" is not equal to field "{1}"',
// 'error.interval' => 'incorrect interval',
// 'error.project' => 'select project',
// 'error.activity' => 'select activity',
// 'error.auth' => 'incorrect login or password',
// 'error.user_exists' => 'user with this login already exists',
// 'error.project_exists' => 'project with this name already exists',
// 'error.activity_exists' => 'activity with this name already exists',
// 'error.client_exists' => 'client with this name already exists',
// 'error.no_login' => 'no user with this login',
// 'error.upload' => 'file upload error',
// 'error.period_locked' => 'can\\\'t complete the operation. records older than a certain number of days cannot be created or modified. team manager defines this in the "Lock interval in days" value on the "Profile" page. set it to 0 to remove locking. <br><br>uncompleted records (with 0 or empty duration) can be deleted.',
// 'error.mail_send' => 'error sending mail',
// 'error.no_email' => 'no email associated with this login',
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

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
?>