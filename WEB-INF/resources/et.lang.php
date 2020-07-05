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

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Sisene',
'menu.logout' => 'Välju',
'menu.forum' => 'Foorum',
'menu.help' => 'Abiinfo',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'Profiil',
'menu.group' => 'Grupp',
'menu.plugins' => 'Lisad',
'menu.time' => 'Ajaarvestus',
// TODO: translate the following.
// 'menu.week' => 'Week',
'menu.expenses' => 'Kulud',
'menu.reports' => 'Raportid',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
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

// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
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
// TODO: translate the following.
// 'error.file_storage' => 'File storage server error.', // See comment in English file.
// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

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
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',


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
// TODO: Translate label.on_behalf, perhaps trying as "instead of".
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(haldur)',
'label.role_comanager' => '(kaashaldur)',
'label.role_admin' => '(administraator)',
'label.page' => 'Lehekülg',
'label.condition' => 'Tingimus',
'label.yes' => 'jah',
'label.no' => 'ei',
// TODO: translate the following.
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Eriväljad',
'label.monthly_quotas' => 'Kuu kvoot',
// TODO: translate the following.
// 'label.entity' => 'Entity',
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
// TODO: translate the following.
// 'label.week_menu' => 'Week menu',
'label.week_note' => 'Nädala märge',
'label.week_list' => 'Nädala nimekiri',
'label.work_units' => 'Töö ühikud',
'label.work_units_short' => 'Ühikud',
'label.totals_only' => 'Ainult summad',
'label.quota' => 'Kvoot',
// TODO: translate the following.
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
'label.active_users' => 'Aktiivsed kasutajad',
'label.inactive_users' => 'Mitteaktiivsed kasutajad',
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
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
'title.expenses' => 'Kulud',
'title.edit_expense' => 'Kulukirje muutmine',
'title.delete_expense' => 'Kulukirje kustutamine',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.predefined_expenses' => 'Eelmääratud kulukirje',
'title.add_predefined_expense' => 'Lisa eelmääratud kulukirje',
'title.edit_predefined_expense' => 'Muuda eelmääratut kulukirjet',
'title.delete_predefined_expense' => 'Kustuta eelmääratud kulukirje',
'title.reports' => 'Raportid',
'title.report' => 'Raport',
'title.send_report' => 'Saadan raportit',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'Arve',
'title.send_invoice' => 'Saada arve',
'title.charts' => 'Diagrammid',
'title.projects' => 'Projektid',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
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
// TODO: translate the following.
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
'title.monthly_quotas' => 'Kuu kvoot',
'title.export' => 'Grupi andmete alla laadimine',
'title.import' => 'Grupi andmete üles laadimine',
'title.options' => 'Suvandid',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
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
// TODO: translate the following.
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
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'aktiivne',
'dropdown.status_inactive' => 'mitte aktiivne',
'dropdown.delete' => 'kustuta',
'dropdown.do_not_delete' => 'ära kustuta',
// TODO: translate the following.
// 'dropdown.pending_approval' => 'pending approval',
// 'dropdown.approved' => 'approved',
// 'dropdown.not_approved' => 'not approved',
'dropdown.paid' => 'makstud',
'dropdown.not_paid' => 'mitte makstud',
// TODO: translate the following.
// 'dropdown.ascending' => 'ascending',
// 'dropdown.descending' => 'descending',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Unustasid salasõna?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga ajaarvestussüsteem.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasõna tühistamise teade on saadetud e-postile.',
'form.reset_password.email_subject' => 'Anuko Time Tracker, parooli tühistamise nõue',
'form.reset_password.email_body' => "Lugupeetud Kasutaja,\n\nIP-lt %s on nõutud Teie salasõna lähtestamist. Palun avage allolev link, kui soovite oma parooli lähtestada.\n\n%s\n\nAnuko Time Tracker on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga ajaarvestussüsteem. Lisainfo saamiseks külastage https://www.anuko.com lehekülge.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Kirjuta siia oma uus parool ja salvesta.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Arveldatav',
'form.time.uncompleted' => 'Lõpetamata',
'form.time.remaining_quota' => 'Allesolev kvoot',
'form.time.over_quota' => 'Üle kvoodi',
// Note for translators. "Balance" below means accumulated quota for user since 1st of the month
// until and including a selected day. If a quota is 8 hours a day, then the balance
// is 8 hours multiplied by a number of work days. "Remaining balance" and "Over balance" are
// balance differences with logged hours.
// The term looks confusing, if you have a better idea how to name these things, let us know.
'form.time.remaining_balance' => 'Järelejäänud kontoseis',  // TODO: check as per above comment.
'form.time.over_balance' => 'Üle piirmäära', // // TODO: check as per above comment.

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Kanne salvestati ainult alguse ajaga. See ei ole viga.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Uus kirje',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Salvesta lemmikuna',
'form.reports.confirm_delete' => 'Oled kindel, et soovid kustutada oma lemmik raportid?',
'form.reports.include_billable' => 'arveldatav',
'form.reports.include_not_billable' => 'mittearveldatav',

// TODO: Check if translation of form.reports.include_invoiced and form.reports.include_not_invoiced is correct.
// "Invoiced" means that an invoice was issued to client, but may not be necessarily "paid" (yet).
// For paid status there is a plugin called "Paid status", that allows you to mark invoice items as "paid".
// Our concern is that Google auto-translates "arveldamata" as unpaid. Therefore, we may need a fix here.
// 'form.reports.include_invoiced' => 'arveldatud', // TODO: fix as per the above comment, if needed.
// 'form.reports.include_not_invoiced' => 'arveldamata', // TODO: fix as per the above comment, if needed.
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'Vali ajaperiood',
'form.reports.set_period' => 'või märgi kuupäevad',
'form.reports.show_fields' => 'Näita välju',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'Grupeeri',
'form.reports.group_by_no' => '--- grupeerimata ---',
'form.reports.group_by_date' => 'kuupäev',
'form.reports.group_by_user' => 'kasutaja',
'form.reports.group_by_client' => 'klient',
'form.reports.group_by_project' => 'projekt',
'form.reports.group_by_task' => 'tööülesanne',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Eksport',
'form.report.assign_to_invoice' => 'Lisa arvele',
// TODO: translate the following.
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
'form.invoice.number' => 'Arve number',
'form.invoice.person' => 'Isik',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Kustutatav arve',
'form.invoice.invoice_entries' => 'Arve kirjed',
'form.invoice.confirm_deleting_entries' => 'Palun kinnita oma Time Tracker\\\'i arve kirjete kustutamise soovi.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Ajavahemik',
'form.charts.chart' => 'Diagramm',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktiivsed projektid',
'form.projects.inactive_projects' => 'Mitteaktiivsed projektid',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktiivsed tööülesanded',
'form.tasks.inactive_tasks' => 'Mitteaktiivsed tööülesanded',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.uncompleted_entry' => 'Kasutajal on lõpetamata aja kanne',
'form.users.role' => 'Roll',
'form.users.manager' => 'Haldur',
'form.users.comanager' => 'Kaashaldur',
'form.users.rate' => 'Hind',
'form.users.default_rate' => 'Vaikimisi tunni hind',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
'form.user_edit.swap_roles' => 'Rollivahetus',

// Roles form. See example at https://timetracker.anuko.com/roles.php
// TODO: translate the following. Proposed 'Aktiivne roll' and 'Mitteaktiivne roll' seem problematic,
// as they apper to refer to a singulr role (while we need multiple roles, similar to form.projects.active_projects).
// 'form.roles.active_roles' => 'Active Roles',
// 'form.roles.inactive_roles' => 'Inactive Roles',
'form.roles.rank' => 'Seisus',
'form.roles.rights' => 'Õigused',
'form.roles.assigned' => 'Määratud',
'form.roles.not_assigned' => 'Määramata',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktiivsed kliendid',
'form.clients.inactive_clients' => 'Mitteaktiivsed kliendid',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Kustutatav klient',
'form.client.client_entries' => 'Kliendi kirjed',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "meeskonna" with "grupp" in the string below.
'form.export.hint' => 'Võid kogu meeskonna andmed eksportida XML faili. Sellest võib olla kasu, kui vahetad serverit.',
'form.export.compression' => 'Pakkimine',
'form.export.compression_none' => 'puudub',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Impordi grupi andmed XML failist.',
'form.import.file' => 'Vali fail',
'form.import.success' => 'Andmete importimine õnnestus.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
'form.groups.hint' => 'Uue grupi lisamiseks loo esmalt grupi haldur.<br>Lisaks on võimalik importida grupi andmed XML failist (kasutajatunnused ei tohi korduda).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 tundi',
'form.group_edit.24_hours' => '24 tundi',
// TODO: translate the following.
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
'form.group_edit.tracking_mode' => 'Jälgimise režiim',
'form.group_edit.mode_time' => 'ajaarvestus',
'form.group_edit.mode_projects' => 'projektid',
'form.group_edit.mode_projects_and_tasks' => 'projektid ja tööülesanded',
'form.group_edit.record_type' => 'Kirje tüüp',
'form.group_edit.type_all' => 'kõik',
'form.group_edit.type_start_finish' => 'algus ja lõpp',
'form.group_edit.type_duration' => 'vahemik',
'form.group_edit.punch_mode' => 'Kellast-kellani režiim',
'form.group_edit.allow_overlap' => 'Luba ajaline ülekate',
'form.group_edit.future_entries' => 'Tuleviku kirjed',
'form.group_edit.uncompleted_indicators' => 'Lõpetamata kirjete indikaator', // TODO: Fix this. Indicators (plural), not indicator.
'form.group_edit.confirm_save' => 'Kinnita salvestamine',
'form.group_edit.allow_ip' => 'Luba IP',
// TODO: translate the following.
// 'form.group_edit.advanced_settings' => 'Advanced settings',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
'form.group_delete.hint' => 'Oled kindel, et soovid kogu gruppi kustutada?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Kellelt',
'form.mail.to' => 'Kellele',
'form.mail.report_subject' => 'Time Tracker raport',
'form.mail.footer' => 'Anuko Time Tracker on lihtne, lihtsalt kasutatav ja avatud lähtekoodiga <br>ajaarvestussüsteem. Lisainfo saamiseks külastage <a href="https://www.anuko.com">www.anuko.com</a> lehekülge.',
'form.mail.report_sent' => 'Raport on saadetud.',
'form.mail.invoice_sent' => 'Arve on saadetud.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Aasta',
'form.quota.month' => 'Kuu',
'form.quota.workday_hours' => 'Töötunde päevas',
'form.quota.hint' => 'Tühjade väljade korral arvutatakse töötamise kvoodid tööpäevade ja pühade põhjal.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
'form.swap.hint' => 'Rolli muutmiseks muuda oma kasutajat. Rollivahetust ei saa tagasi võtta.',
'form.swap.swap_with' => 'Vaheta kasutajaga roll',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
'form.work_units.minutes_in_unit' => 'Minuteid ühikus',
'form.work_units.1st_unit_threshold' => 'Esimese ühiku piirmäär',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Tavakasutaja',
'role.user.low_case_label' => 'tavakasutaja',
// TODO: Translate role.user.description. "Haldusõigustega tavakasutaja." auto-translates with an opposite meaning.
// 'role.user.description' => 'A regular member without management rights.',
'role.client.label' => 'Klient',
'role.client.low_case_label' => 'klient',
// TODO: translate the following.
// 'role.client.description' => 'A client can view its own data.',
'role.client.description' => 'Kliendil on lubatud vaadata oma raporteid ja arveid.',
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
'role.top_manager.low_case_label' => 'juht',
'role.top_manager.description' => 'Ettevõtte juht, kellel on lubatud hallata mitut gruppi.',
'role.admin.label' => 'Administraator',
'role.admin.low_case_label' => 'administraator',
'role.admin.description' => 'Rakenduse administraator.',

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
// 'form.display_options.menu' => 'Menu',
// 'form.display_options.note_on_separate_row' => 'Note on separate row',

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
