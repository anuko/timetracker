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

// Note to translators: Use proper capitalization rules for your language.

$i18n_language = 'Estonian (Eesti)';
$i18n_months = array('Jaanuar', 'Veebruar', 'Märts', 'Aprill', 'Mai', 'Juuni', 'Juuli', 'August', 'September', 'Oktoober', 'November', 'Detsember');
$i18n_weekdays = array('Pühapäev', 'Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev');
$i18n_weekdays_short = array('P', 'E', 'T', 'K', 'N', 'R', 'L');
// format mm/dd
$i18n_holidays = array('01/01', '02/24', '04/19', '04/21', '05/01', '06/09', '06/23', '06/24', '08/20', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Sisene',
'menu.logout' => 'Välju',
'menu.forum' => 'Foorum',
'menu.help' => 'Abiinfo',
'menu.create_group' => 'Loo grupp',
'menu.profile' => 'Profiil',
'menu.group' => 'Grupp',
'menu.plugins' => 'Lisad',
'menu.time' => 'Ajaarvestus',
'menu.expenses' => 'Kulud',
'menu.reports' => 'Raportid',
'menu.charts' => 'Diagrammid',
'menu.projects' => 'Projektid',
'menu.tasks' => 'Tööülesanded',
'menu.users' => 'Kasutajad',
'menu.groups' => 'Grupid',
'menu.subgroups' => 'Alamgrupid',
'menu.export' => 'Eksport', // TODO: is this a correct term as an opposite of "Import"?
'menu.clients' => 'Kliendid',
'menu.options' => 'Suvandid',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Sul on võimalik mitmeti panustada Time Tracker\\\'i arendamisse.',
'footer.credits' => 'Tunnustused',
'footer.license' => 'Litsents',
'footer.improve' => 'Panusta',

// Error messages.
'error.access_denied' => 'Puudub ligipääs.',
'error.sys' => 'Rakenduse viga.',
'error.db' => 'Andmebaasi viga.',
'error.feature_disabled' => 'Rakenduse funktsionaalsus on välja lülitatud.',
'error.field' => 'Välja "{0}" andmed ei vasta nõutele.',
'error.empty' => 'Väli "{0}" on tühi.',
'error.not_equal' => 'Väli "{0}" ei ole väljaga "{1}" võrdne.',
'error.interval' => 'Välja "{0}" väärtus peab olema suurem kui välja "{1}" väärtus.',
'error.project' => 'Vali projekt.',
'error.task' => 'Vali tööülesanne.',
'error.client' => 'Vali klient.',
'error.report' => 'Vali raport.',
'error.record' => 'Vali kirje.',
'error.auth' => 'Autentimine ebaõnnestus.',
'error.user_exists' => 'Selle nimega kasutaja on juba kasutusel.',
'error.object_exists' => 'Sellise nimega objekt on juba olemas.',
'error.invoice_exists' => 'Arve number on juba kasutusel.',

// TODO: Improve translation of error.role_exists.
// 'error.role_exists' => 'Role with this rank already exists.',
// It is displayed when user tries to add a role with an already existing RANK.
// There is no indication of RANK collision in this translation.
// 'error.role_exists' => 'Kasutaja roll on juba kasutusel.',

// TODO: Improve translation of error.no_invoiceable_items.
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// This error shows up when user tries to ctreate a new invoice,
// but there are no billable records such time or expenses to include.
// Google auto-translates below as "No billable invoices found." which seems wrong.
// 'error.no_invoiceable_items' => 'Arveldatavaid arveid ei leitud.',

'error.no_login' => 'Sellise tunnusega kasutajat ei ole.',

// TODO: Improve translation of error.no_groups. Replace meeskond with grupp?
// Why? Before supporting subgroups, Time Tracker organized users in "teams".
// Now we have "groups" with "subgroups", renamed from original "team".
// Meeskond below is a glimpse from earlier versions, before renaming occurred.
'error.no_groups' => 'Sinu andmebaas on tühi. Logi administraatorina sisse ja loo uus meeskond.',

'error.upload' => 'Viga faili vastuvõtmisel.',
'error.range_locked' => 'Kuupäevavahemik on lukus.',
'error.mail_send' => 'E-posti saatmisel tekkis viga. Vea tuvastamiseks kasuta MAIL_SMTP_DEBUG muutujat.',
'error.no_email' => 'Kasutajaga pole ühtegi e-posti seotud.',
'error.uncompleted_exists' => 'Leiti varasemalt lõpetamata kirje. Sulge või kustuta see.',
'error.goto_uncompleted' => 'Ava lõpetamata kirje.',
'error.overlap' => 'Ajavahemik kattub varasema kirjega.',
'error.future_date' => 'Kuupäev on tulevikus.',
'error.xml' => 'Viga XML failis, real %d: %s.',
'error.cannot_import' => 'Ebaõnnestunud import: %s.',
'error.format' => 'Faili formaat on vale.',
'error.user_count' => 'Kasutajate arvu piirang.',
'error.expired' => 'Kehtivusaeg on lõppenud.',

// Warning messages.
'warn.sure' => 'Oled kindel?',
'warn.confirm_save' => 'Kuupäeva on muudetud. Muudatuse kinnitamisel ei varundata esialgset kirjet, vaid muudetakse seda. Kinnitad muudatuse?',

// Success messages.
'msg.success' => 'Tegevus oli edukas.',

// Labels for buttons.
'button.login' => 'Sisene',
'button.now' => 'Nüüd',
'button.save' => 'Salvesta',
'button.copy' => 'Kopeeri',
'button.cancel' => 'Tühista',
'button.submit' => 'Postita',
'button.add' => 'Lisa',
'button.delete' => 'Kustuta',
'button.generate' => 'Loo',
'button.reset_password' => 'Lähtesta salasõna',
'button.send' => 'Saada',
'button.send_by_email' => 'Saada e-postiga',
'button.create_group' => 'Loo grupp',
'button.export' => 'Ekspordi grupp',
'button.import' => 'Impordi grupp',
'button.close' => 'Sulge',
'button.stop' => 'Stopp',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Grupi nimi',
'label.address' => 'Aadress',
'label.currency' => 'Valuuta',
'label.manager_name' => 'Halduri nimi',
'label.manager_login' => 'Halduri sisenemine',
'label.person_name' => 'Nimi',
'label.thing_name' => 'Nimi',
'label.login' => 'Kasutajanimi',
'label.password' => 'Salasõna',
'label.confirm_password' => 'Kinnita salasõna',
'label.email' => 'E-post',
'label.cc' => 'Cc',
'label.bcc' => 'Bcc',
'label.subject' => 'Teema',
'label.date' => 'Kuupäev',
'label.start_date' => 'Algus kuupäev',
'label.end_date' => 'Lõpu kuupäev',
'label.user' => 'Kasutaja',
'label.users' => 'Kasutajad',
'label.group' => 'Grupp',
'label.subgroups' => 'Alamgrupid',
'label.roles' => 'Rollid',
'label.client' => 'Klient',
'label.clients' => 'Kliendid',
'label.option' => 'Valik',
'label.invoice' => 'Arve',
'label.project' => 'Projekt',
'label.projects' => 'Projektid',
'label.task' => 'Tööülesanne',
'label.tasks' => 'Tööülesanded',
'label.description' => 'Kirjeldus',
'label.start' => 'Algus',
'label.finish' => 'Lõpp',
'label.duration' => 'Kestus',
'label.note' => 'Märkus',
'label.notes' => 'Märkused',
'label.item' => 'Ese',
'label.cost' => 'Hind',
'label.ip' => 'IP',
'label.day_total' => 'Päeva summa',
'label.week_total' => 'Nädala summa',
'label.month_total' => 'Kuu summa',
'label.today' => 'Täna',
'label.view' => 'Vaata',
'label.edit' => 'Muuda',
'label.delete' => 'Kustuta',
'label.configure' => 'Seadista',
'label.select_all' => 'Vali kõik',
'label.select_none' => 'Märgi kõik mittevalituks',
'label.day_view' => 'Päeva vaade',
'label.week_view' => 'Nädala vaade',
'label.id' => 'ID',
'label.language' => 'Keel',
'label.decimal_mark' => 'Koma märk',
'label.date_format' => 'Kuupäeva formaat',
'label.time_format' => 'Kella formaat',
'label.week_start' => 'Nädala alguspäev',
'label.comment' => 'Kommentaar',
'label.status' => 'Seisund',
'label.tax' => 'Maksud',
'label.subtotal' => 'Vahesumma',
'label.total' => 'Kokku',
'label.client_name' => 'Kliendi nimi',
'label.client_address' => 'Kliendi aadress',
'label.or' => 'või',
'label.error' => 'Viga',
'label.ldap_hint' => 'Kasuta allolevas tabelis oma Windows\\\'i kasutajatunnuseid.',
'label.required_fields' => '* nõutud väljad',
// TODO: Translate label.on_behalf, perhaps trying as "instead of".
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(haldur)',
'label.role_comanager' => '(kaashaldur)',
'label.role_admin' => '(administraator)',
'label.page' => 'Lehekülg',
'label.condition' => 'Tingimus',
'label.yes' => 'jah',
'label.no' => 'ei',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Eriväljad',
'label.monthly_quotas' => 'Kuu kvoot',
'label.type' => 'Tüüp',
'label.type_dropdown' => 'rippmenüü',
'label.type_text' => 'tekst',
'label.required' => 'Kohustuslik',
'label.fav_report' => 'Lemmikraport',
'label.schedule' => 'Ajakava',
'label.what_is_it' => 'Mis see on?',
'label.expense' => 'Kulu',
'label.quantity' => 'Kogus',
'label.paid_status' => 'Makse olek',
'label.paid' => 'Makstud',
'label.mark_paid' => 'Märgi makstuks',
'label.week_note' => 'Nädala märge',
'label.week_list' => 'Nädala nimekiri',
'label.work_units' => 'Töö ühikud',
'label.work_units_short' => 'Ühikud',
'label.totals_only' => 'Ainult summad',
'label.quota' => 'Kvoot',

// Form titles.
// TODO: Improve titles for consistency, so that each title explains correctly what each
// page is about and is "consistent" from page to page, meaning that correct grammar is used everywhere.
// Compare with English file to see how it is done there and do Estonian titles similarly.
// Specifically: lisamine vs lisa, etc.
'title.error' => 'Viga',
'title.success' => 'Õnnestumine',
'title.login' => 'Sisene',
'title.groups' => 'Grupid',
'title.subgroups' => 'Alamgrupid',
'title.add_group' => 'Lisa grupp',
'title.edit_group' => 'Muuda gruppi',
'title.delete_group' => 'Kustuta grupp',
'title.reset_password' => 'Tühjenda salasõna',
'title.change_password' => 'Muuda salasõna',
'title.time' => 'Ajaarvestus',
'title.edit_time_record' => 'Ajakande muutmine',
'title.delete_time_record' => 'Ajakande kustutamine',
'title.expenses' => 'Kulud',
'title.edit_expense' => 'Kulukirje muutmine',
'title.delete_expense' => 'Kulukirje kustutamine',
'title.predefined_expenses' => 'Eelmääratud kulukirje',
'title.add_predefined_expense' => 'Lisa eelmääratud kulukirje',
'title.edit_predefined_expense' => 'Muuda eelmääratut kulukirjet',
'title.delete_predefined_expense' => 'Kustuta eelmääratud kulukirje',
'title.reports' => 'Raportid',
'title.report' => 'Raport',
'title.send_report' => 'Saadan raportit',
'title.invoice' => 'Arve',
'title.send_invoice' => 'Saada arve',
'title.charts' => 'Diagrammid',
'title.projects' => 'Projektid',
'title.add_project' => 'Projekti lisamine',
'title.edit_project' => 'Projekti muutmine',
'title.delete_project' => 'Projekti kustutamine',
'title.tasks' => 'Tööülesanded',
'title.add_task' => 'Lisa tööülesanne',
'title.edit_task' => 'Muuda tööülesannet',
'title.delete_task' => 'Kustuta tööülesanne',
'title.users' => 'Kasutajad',
'title.add_user' => 'Kasutaja lisamine',
'title.edit_user' => 'Kasutaja muutmine',
'title.delete_user' => 'Kasutaja kustutamine',
'title.roles' => 'Rollid',
'title.add_role' => 'Rolli lisamine',
'title.edit_role' => 'Rolli muutmine',
'title.delete_role' => 'Rolli kustutamine',
'title.clients' => 'Kliendid',
'title.add_client' => 'Lisa klient',
'title.edit_client' => 'Muuda klienti',
'title.delete_client' => 'Kustuta klient',
'title.invoices' => 'Arved',
'title.add_invoice' => 'Arve lisamine',
'title.view_invoice' => 'Arve vaatamine',
'title.delete_invoice' => 'Arve kustutamine',
'title.notifications' => 'Teated',
'title.add_notification' => 'Teate lisamine',
'title.edit_notification' => 'Teate muutmine',
'title.delete_notification' => 'Teate kustutamine',
'title.monthly_quotas' => 'Kuu kvoot',
'title.export' => 'Grupi andmete alla laadimine',
'title.import' => 'Grupi andmete üles laadimine',
'title.options' => 'Suvandid',
'title.profile' => 'Profiil',
'title.plugins' => 'Lisad',
'title.cf_custom_fields' => 'Eriväljad',
'title.cf_add_custom_field' => 'Lisa eriväli',
'title.cf_edit_custom_field' => 'Muuda erivälja',
'title.cf_delete_custom_field' => 'Kustuta eriväli',
'title.cf_dropdown_options' => 'Rippmenüü valikud',
'title.cf_add_dropdown_option' => 'Lisa valik',
'title.cf_edit_dropdown_option' => 'Muuda valikut',
'title.cf_delete_dropdown_option' => 'Kustuta valik',
'title.locking' => 'Lukustamine',
'title.week_view' => 'Nädala vaade',
'title.swap_roles' => 'Rollivahetus',
'title.work_units' => 'Töö ühikud',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- kõik ---',
'dropdown.no' => '--- ei ---',
'dropdown.current_day' => 'täna',
'dropdown.previous_day' => 'eile',
'dropdown.selected_day' => 'päev',
'dropdown.current_week' => 'käesolev nädal',
'dropdown.previous_week' => 'eelmine nädal',
'dropdown.selected_week' => 'nädal',
'dropdown.current_month' => 'käesolev kuu',
'dropdown.previous_month' => 'eelmine kuu',
'dropdown.selected_month' => 'kuu',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => 'kõik ajad',
'dropdown.projects' => 'projektid',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'kliendid',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'aktiivne',
// TODO: translate the following.
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Unustasid salasõna?',
// TODO: translate the following.
// 'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasõna tühjendamise käsk edastatud.', // TODO: add "by email" to match the English string.
// TODO: translate the following.
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Arvestatav',
// TODO: translate the following.
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Kanne salvestati ainult alguse ajaga. See ei ole viga.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Salvesta lemmikuna',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_billable' => 'arvestatav',
'form.reports.include_not_billable' => 'mittearvestatav',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Vali ajaperiood',
'form.reports.set_period' => 'või märgi kuupäevad',
'form.reports.show_fields' => 'Näita välju',
'form.reports.group_by' => 'Grupeeri',
'form.reports.group_by_no' => '--- ilma grupeerimata ---',
'form.reports.group_by_date' => 'kuupäev',
'form.reports.group_by_user' => 'kasutaja',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'projekt',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Eksportimine', // TODO: is this correct? We want a verb as in "Export XML" - see report export options.
                                        // The current combined English string is "Export PDF, XML or CSV".
                                        // Meaning: user can have a displayed report in these formats.
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Arve number',
'form.invoice.person' => 'Isik',

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
'form.users.role' => 'Roll',
'form.users.manager' => 'Haldur',
'form.users.comanager' => 'Kaashaldur',
'form.users.rate' => 'Hind',
'form.users.default_rate' => 'Vaikimisi tunni hind',

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
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Võid kogu meeskonna andmed eksportida xml-faili. Sellest võib olla kasu kui vahetad serverit.',
'form.export.compression' => 'Pakkimine',
// TODO: translate the following.
// 'form.export.compression_none' => 'none',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Impordi meeskonna andmed xml-failist.', // TODO: replace "team" with "group".
'form.import.file' => 'Vali fail',
'form.import.success' => 'Andmed imporditud.',

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
// 'form.group_edit.confirm_save' => 'Confirm saving',
// 'form.group_edit.allow_ip' => 'Allow IP',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Kellelt',
'form.mail.to' => 'Kellele',
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Arve saadetud.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.workday_hours' => 'Hours in work day',
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
