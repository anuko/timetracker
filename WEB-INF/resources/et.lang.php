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
'menu.export' => 'Andmete salvestamine',
'menu.clients' => 'Kliendid',
'menu.options' => 'Suvandid',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Sul on võimalik mitmeti panustada Time Tracker\\\'i arendamisse.',
'footer.credits' => 'Tunnustused',
'footer.license' => 'Litsents',
'footer.improve' => 'Panusta', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

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
'error.role_exists' => 'Kasutaja roll on juba kasutusel.',
'error.no_invoiceable_items' => 'Arveldatavaid arveid ei leitud.',
'error.no_login' => 'Sellise tunnusega kasutajat ei ole.',
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
'label.manager_login' => 'Halduri kasutajanimi',
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
'label.on_behalf' => '', // TODO: probably untranslateable phrase
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
'label.required' => 'kohustuslik',
'label.fav_report' => 'Lemmikraport',
'label.schedule' => '<i>cron</i> vormingus ajavahemik',
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
'title.groups' => 'Grupid', // TODO: change "teams" to "groups".
'title.subgroups' => 'Alamgrupid',
'title.add_group' => 'Lisa grupp',
'title.edit_group' => 'Muuda gruppi',
'title.delete_group' => 'Kustuta grupp',  // TODO: change "team" to "group".
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
'title.add_user' => 'Kasutaja lisamine', // TODO: is this correct?
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
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
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
'dropdown.current_year' => 'käesolev aasta',
'dropdown.previous_year' => 'eelmine aasta',
'dropdown.selected_year' => 'aasta',
'dropdown.all_time' => 'kõik ajavahemikud',
'dropdown.projects' => 'projektid',
'dropdown.tasks' => 'tööülesanded',
'dropdown.clients' => 'kliendid',
'dropdown.select' => '--- vali ---',
'dropdown.select_invoice' => '--- vali arve ---',
'dropdown.status_active' => 'aktiivne',
'dropdown.status_inactive' => 'mitte aktiivne',
'dropdown.delete' => 'kustuta',
'dropdown.do_not_delete' => 'ära kustuta',
'dropdown.paid' => 'makstud',
'dropdown.not_paid' => 'mitte makstud',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Unustasid salasõna?',
// TODO: translate the following.
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga ajaarvestussüsteem.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasõna tühistamise teade on saadetud e-postile.',
'form.reset_password.email_subject' => 'Anuko Time Tracker, parooli tühistamise nõue',
'form.reset_password.email_body' => "Lugupeetud Kasutaja,\n\nIP-lt %s on nõutud Teie salasõna lähtestamist. Palun avage allolev link, kui soovite oma parooli lähtestada.\n\n%s\n\nAnuko Time Tracker on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga ajaarvestussüsteem. Lisainfo saamiseks külastage https://www.anuko.com lehekülge.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Kirjuta siia oma uus parool ja salvesta.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Arvelduse olek',
'form.time.uncompleted' => 'Lõpetamata',
'form.time.remaining_quota' => 'Allesolev kvoot',
'form.time.over_quota' => 'Üle kvoodi',
'form.time.remaining_balance' => 'Järelejäänud kontoseis',
'form.time.over_balance' => 'Üle piirmäära',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Kanne salvestati ainult alguse ajaga. See ei ole viga.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Uus kirje',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Salvesta lemmikuna',
'form.reports.confirm_delete' => 'Oled kindel, et soovid kustutada oma lemmik raportid?',
'form.reports.include_billable' => 'arveldatav',
'form.reports.include_not_billable' => 'mittearveldatav',
'form.reports.include_invoiced' => 'arveldatud',
'form.reports.include_not_invoiced' => 'arveldamata',
'form.reports.select_period' => 'Vali ajaperiood',
'form.reports.set_period' => 'või märgi kuupäevad',
'form.reports.show_fields' => 'Näita välju',
'form.reports.group_by' => 'Grupeeri',
'form.reports.group_by_no' => '--- grupeerimata ---',
'form.reports.group_by_date' => 'kuupäev',
'form.reports.group_by_user' => 'kasutaja',
'form.reports.group_by_client' => 'klient',
'form.reports.group_by_project' => 'projekt',
'form.reports.group_by_task' => 'tööülesanne',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Salvesta vormingus:', // TODO: is this correct? We want a verb as in "Export XML" - see report export options.
                                        // The current combined English string is "Export PDF, XML or CSV".
                                        // Meaning: user can have a displayed report in these formats.
'form.report.assign_to_invoice' => 'Lisa arvele',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Arve number',
'form.invoice.person' => 'Isik',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Kustutatav arve',
'form.invoice.invoice_entries' => 'Arve kirjed',
'form.invoice.confirm_deleting_entries' => 'Palun kinnita oma Time Tracker\\\'i arve kirjete kustutamise soovi.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Ajavahemik',
'form.charts.chart' => 'Diagrammid',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktiivsed projektid',
'form.projects.inactive_projects' => 'Mitteaktiivsed projektid',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktiivsed tööülesanded',
'form.tasks.inactive_tasks' => 'Mitteaktiivsed tööülesanded',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktiivsed Kasutajad',
'form.users.inactive_users' => 'Mitteaktiivsed Kasutajad',
'form.users.uncompleted_entry' => 'Kasutajal on lõpetamata aja kanne',
'form.users.role' => 'Roll',
'form.users.manager' => 'Haldur',
'form.users.comanager' => 'Kaashaldur',
'form.users.rate' => 'Hind',
'form.users.default_rate' => 'Vaikimisi tunni hind',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
// TODO: translate the following.
'form.user_edit.swap_roles' => 'Rollivahetus',

// Roles form. See example at https://timetracker.anuko.com/roles.php
// TODO: translate the following.
'form.roles.active_roles' => 'Aktiivne roll',
'form.roles.inactive_roles' => 'Mitteaktiivne roll',
'form.roles.rank' => 'Seisus',
'form.roles.rights' => 'Õigused',
'form.roles.assigned' => 'Määratud',
'form.roles.not_assigned' => 'Määramata',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
'form.clients.active_clients' => 'Aktiivsed kliendid',
'form.clients.inactive_clients' => 'Mitteaktiivsed kliendid',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
'form.client.client_to_delete' => 'Kustutatav klient',
'form.client.client_entries' => 'Kliendi kirjed',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Võid kogu meeskonna andmed eksportida XML faili. Sellest võib olla kasu, kui vahetad serverit.',
'form.export.compression' => 'Pakkimine',
// TODO: translate the following.
'form.export.compression_none' => 'puudub',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Impordi grupi andmed XML failist.', // TODO: replace "team" with "group".
'form.import.file' => 'Vali fail',
'form.import.success' => 'Andmete importimine õnnestus.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: translate the following.
'form.groups.hint' => 'Uue grupi lisamiseks loo esmalt grupi haldur.<br>Lisaks on võimalik importida grupi andmed XML failist (kasutajatunnused ei tohi korduda).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
// TODO: translate the following.
'form.group_edit.12_hours' => '12 tundi',
'form.group_edit.24_hours' => '24 tundi',
'form.group_edit.show_holidays' => 'Näita pühi',
'form.group_edit.tracking_mode' => 'Jälgimise režiim',
'form.group_edit.mode_time' => 'ajaarvestus',
'form.group_edit.mode_projects' => 'projektid',
'form.group_edit.mode_projects_and_tasks' => 'projektid ja tööülesanded',
'form.group_edit.record_type' => 'Kirje tüüp',
'form.group_edit.type_all' => 'kõik',
'form.group_edit.type_start_finish' => 'algus ja lõpp',
'form.group_edit.type_duration' => 'vahemik',
'form.group_edit.punch_mode' => 'kellast-kellani režiim',
'form.group_edit.allow_overlap' => 'Luba ajaline ülekate',
'form.group_edit.future_entries' => 'Tuleviku kirjed',
'form.group_edit.uncompleted_indicators' => 'Lõpetamata kirjete indikaator',
'form.group_edit.confirm_save' => 'Kinnita salvestamine',
'form.group_edit.allow_ip' => 'Luba IP',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
'form.group_delete.hint' => 'Oled kindel, et soovid kogu gruppi kustutada?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Kellelt',
'form.mail.to' => 'Kellele',
// TODO: translate the following.
'form.mail.report_subject' => 'Aja arvestuse raport',
'form.mail.footer' => 'Anuko Time Tracker on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga <br>ajaarvestussüsteem. Lisainfo saamiseks külastage <a href="https://www.anuko.com">www.anuko.com</a> lehekülge.',
'form.mail.report_sent' => 'Raport on saadetud.',
'form.mail.invoice_sent' => 'Arve on saadetud.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
'form.quota.year' => 'aasta',
'form.quota.month' => 'kuu',
'form.quota.workday_hours' => 'töötunde päevas',
'form.quota.hint' => 'Tühjade väljade korral arvutatakse töötamise kvoodid tööpäevade ja pühade põhjal.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
'form.swap.hint' => 'Rolli muutmiseks muuda oma kasutajat. Rollivahetust ei saa tagasi võtta.',
'form.swap.swap_with' => 'Vaheta kasutajaga roll:',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
// TODO: translate the following.
'form.work_units.minutes_in_unit' => 'minuteid ühikus',
'form.work_units.1st_unit_threshold' => 'esimese ühiku piirmäär',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
'role.user.label' => 'Tavakasutaja',
'role.user.low_case_label' => 'tavakasutaja',
'role.user.description' => 'Haldusõigustega tavakasutaja.',
'role.client.label' => 'Klient',
'role.client.low_case_label' => 'klient',
'role.client.description' => 'Kliendil on lubatud vaadata oma raporteid, diagramme ja arveid.',
'role.supervisor.label' => 'Ülevaataja',
'role.supervisor.low_case_label' => 'ülevaataja',
'role.supervisor.description' => 'Mõningate lisaõigustega kasutaja.',
'role.comanager.label' => 'Kaashaldur',
'role.comanager.low_case_label' => 'kaashaldur',
'role.comanager.description' => 'Mitmete halduri õigustega kasutja.',
'role.manager.label' => 'Haldur',
'role.manager.low_case_label' => 'haldur',
'role.manager.description' => 'Grupihaldur, kellel on lubatud enamik grupiga soetud tegevusi.',
'role.top_manager.label' => 'Juht',
'role.top_manager.low_case_label' => 'Juht',
'role.top_manager.description' => 'Ettevõtte juht, kellel on lubatud hallata mitut gruppi.',
'role.admin.label' => 'Administraator',
'role.admin.low_case_label' => 'administraator',
'role.admin.description' => 'Rakenduse administraator.',
);
