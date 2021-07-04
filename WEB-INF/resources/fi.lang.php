<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.

$i18n_language = 'Finnish (Suomi)';
$i18n_months = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kesäkuu', 'Heinäkuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');
$i18n_weekdays = array('Sunnuntai', 'Maanantai', 'Tiistai', 'Keskiviikko', 'Torstai', 'Perjantai', 'Lauantai');
$i18n_weekdays_short = array('Su', 'Ma', 'Ti', 'Ke', 'To', 'Pe', 'La');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Kirjaudu',
'menu.logout' => 'Kirjaudu ulos',
'menu.forum' => 'Keskustelupalsta',
'menu.help' => 'Apua',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'Profiili',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.plugins' => 'Lisäosat',
'menu.time' => 'Tunnit',
// TODO: translate the following.
// 'menu.puncher' => 'Punch',
// 'menu.week' => 'Week',
'menu.expenses' => 'Kulut',
'menu.reports' => 'Raportit',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
'menu.charts' => 'Kaaviot',
'menu.projects' => 'Projektit',
'menu.tasks' => 'Tehtävät',
'menu.users' => 'Käyttäjät',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
'menu.export' => 'Vie',
'menu.clients' => 'Asiakkaat',
'menu.options' => 'Optiot',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Voit osallistua Time Tracker -sovelluksen tuotekehitykseen monin tavoin.',
// 'Credits' is a bit difficult to translate, the exact literal term might be 'Ansiot' or 'Antaa tunnustus' but that's not widely used in this meaning.
// The term that is used is something like 'We are thanking' ('Kiitämme') but that does not sound good, either. So I just let it be as it was for time being as everybody (?) understands the meaning anyway.
'footer.credits' => 'Credits',
'footer.license' => 'Lisenssi',
'footer.improve' => 'Osallistu kehitystyöhön',

// Error messages.
'error.access_denied' => 'Pääsy estetty.',
'error.sys' => 'Järjestelmävirhe.',
'error.db' => 'Tietokantavirhe.',
// TODO: translate the following.
// 'error.registered_recently' => 'Registered recently.',
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Virheellinen "{0}" tieto.',
'error.empty' => 'Kenttä "{0}" on tyhjä.',
'error.not_equal' => 'Kentät "{0}" ja "{1}" eivät ole samat.',
'error.interval' => 'Kentän "{0}" arvon tulee olla suurempi kuin kentän "{1}".',
'error.project' => 'Valitse projekti.',
'error.task' => 'Valitse tehtävä.',
'error.client' => 'Valitse asiakas.',
'error.report' => 'Valitse raportti.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Virheellinen käyttäjänimi tai salasana.',
'error.user_exists' => 'Tämä käyttäjänimi on jo olemassa.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.invoice_exists' => 'Tällä numerolla oleva lasku on jo olemassa.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Ei laskutettavia syötteitä.',
// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
'error.no_login' => 'Tuntematon käyttäjänimi.',
'error.no_groups' => 'Tietokanta on tyhjä. Kirjaudu ylläpitäjänä ja luo uusi tiimi.',  // TODO: replace "team" with "group".
'error.upload' => 'Virhe tiedoston lataus.',
'error.range_locked' => 'Aikaväli on lukittu.',
'error.mail_send' => 'Virhe postinlähetyksessä.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => 'Käyttäjätunnukseen ei ole liitetty sähköpostiosoitetta.',
'error.uncompleted_exists' => 'Kesken oleva syötetieto on jo olemassa. Sulje tai poista se.',
'error.goto_uncompleted' => 'Siirry kesken olevaan syötteeseen.',
'error.overlap' => 'Aikavälillä on päällekkäisiä syötteitä.',
'error.future_date' => 'Aika on tulevaisuudessa.',
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
'button.login' => 'Kirjaudu',
'button.now' => 'Nyt',
'button.save' => 'Tallenna',
'button.copy' => 'Kopioi',
'button.cancel' => 'Keskeytä',
'button.submit' => 'Hyväksy',
'button.add' => 'Lisää',
'button.delete' => 'Poista',
'button.generate' => 'Luo',
'button.reset_password' => 'Nollaa salasana',
'button.send' => 'Lähetä',
'button.send_by_email' => 'Lähetä sähköpostilla',
'button.create_group' => 'Luo tiimi', // TODO: replace "team" with "group".
'button.export' => 'Vie tiimi', // TODO: replace "team" with "group".
'button.import' => 'Tuo tiimi', // TODO: replace "team" with "group".
'button.close' => 'Sulje',
// TODO: translate the following.
// 'button.start' => 'Start',
'button.stop' => 'Lopeta',
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
'label.group_name' => 'Tiimin nimi', // TODO: replace "team" with "group".
'label.address' => 'Osoite',
'label.currency' => 'Valuutta',
'label.manager_name' => 'Esimies',
'label.manager_login' => 'Esimiehen käyttäjätunnus',
'label.person_name' => 'Nimi',
'label.thing_name' => 'Nimi',
'label.login' => 'Käyttäjätunnus',
'label.password' => 'Salasana',
'label.confirm_password' => 'Vahvista salasana',
'label.email' => 'Sähköposti',
'label.cc' => 'Kopio',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Aihe',
'label.date' => 'Päiväys',
'label.start_date' => 'Aloituspäivä',
'label.end_date' => 'Päättymispäivä',
'label.user' => 'Käyttäjä',
'label.users' => 'Käyttäjät',
// TODO: translate the following.
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
// 'label.roles' => 'Roles',
'label.client' => 'Asiakas',
'label.clients' => 'Asiakkaat',
'label.option' => 'Optio',
'label.invoice' => 'Lasku',
'label.project' => 'Projekti',
'label.projects' => 'Projektit',
'label.task' => 'Tehtävä',
'label.tasks' => 'Tehtävät',
'label.description' => 'Kuvaus',
'label.start' => 'Aloitus',
'label.finish' => 'Lopetus',
'label.duration' => 'Kesto',
'label.note' => 'Huom',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Syöte',
'label.cost' => 'Hinta',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Päivä yhteensä',
'label.week_total' => 'Viikko yhteensä',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Tänään',
'label.view' => 'Näytä',
'label.edit' => 'Muokkaa',
'label.delete' => 'Poista',
'label.configure' => 'Aseta',
'label.select_all' => 'Valitse kaikki',
'label.select_none' => 'Poista kaikki valinnat',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.puncher' => 'Puncher',
'label.id' => 'ID',
'label.language' => 'Kieli',
'label.decimal_mark' => 'Desimaalierotin',
'label.date_format' => 'Päiväyksen muoto',
'label.time_format' => 'Kellonajan muoto',
'label.week_start' => 'Viikon 1. päivä',
'label.comment' => 'Kommentti',
'label.status' => 'Tila',
'label.tax' => 'Vero',
'label.subtotal' => 'Välisumma',
'label.total' => 'Yhteensä',
'label.client_name' => 'Asiakkaan nimi',
'label.client_address' => 'Asiakkaan osoite',
'label.or' => 'tai',
'label.error' => 'Virhe',
'label.ldap_hint' => 'Syötä <b>Windows-käyttäjätunnuksesi</b> ja <b>salasanasi</b> ao. kenttiin.',
'label.required_fields' => '* - pakolliset kentät',
'label.on_behalf' => 'puolesta',
'label.role_manager' => '(esimies)',
'label.role_comanager' => '(apu-esimies)',
'label.role_admin' => '(ylläpitäjä)',
'label.page' => 'Sivu',
// TODO: translate the following.
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Omat kentät',
// TODO: translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
// TODO: translate the following.
// 'label.entity' => 'Entity',
'label.type' => 'Tyyppi',
'label.type_dropdown' => 'pudotusvalikko',
'label.type_text' => 'teksti',
'label.required' => 'Pakollinen',
'label.fav_report' => 'Raporttipohja',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
'label.what_is_it' => 'Mikä se on?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
'label.totals_only' => 'Vain yhteissummat',
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
'label.active_users' => 'Aktiiviset käyttäjät',
'label.inactive_users' => 'Ei-aktiiviset käyttäjät',
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
'title.error' => 'Virhe',
// TODO: Translate the following.
// 'title.success' => 'Success',
'title.login' => 'Kirjautuminen',
'title.groups' => 'Tiimit', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.add_group' => 'Adding Group',
'title.edit_group' => 'Tiimin muokkaus', // TODO: change "team" to "group".
'title.delete_group' => 'Tiimin poisto', // TODO: change "team" to "group".
'title.reset_password' => 'Salasanan nollaus',
'title.change_password' => 'Salasanan vaihto',
'title.time' => 'Tuntien kirjaus',
'title.edit_time_record' => 'Tuntikirjausten muokkaus',
'title.delete_time_record' => 'Tuntikirjausten poisto',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
// 'title.puncher' => 'Puncher',
'title.expenses' => 'Kulut',
'title.edit_expense' => 'Kulutietojen muokkaus',
'title.delete_expense' => 'Kulutiedon poisto',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.reports' => 'Raportit',
'title.report' => 'Raportti',
'title.send_report' => 'Raportin lähetys',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'Lasku',
'title.send_invoice' => 'Laskun lähetys',
'title.charts' => 'Kaaviot',
'title.projects' => 'Projektit',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
'title.add_project' => 'Projektin lisäys',
'title.edit_project' => 'Projektin muokkaus',
'title.delete_project' => 'Projektin poisto',
'title.tasks' => 'Tehtävät',
'title.add_task' => 'Tehtävän lisäys',
'title.edit_task' => 'Tehtävän muokkaus',
'title.delete_task' => 'Tehtävän poisto',
'title.users' => 'Käyttäjät',
'title.add_user' => 'Käyttäjän lisäys',
'title.edit_user' => 'Käyttäjän muokkaus',
'title.delete_user' => 'Käyttäjän poisto',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Asiakkaat',
'title.add_client' => 'Asiakkaan lisäys',
'title.edit_client' => 'Asiakkaan muokkaus',
'title.delete_client' => 'Asiakkaan poisto',
'title.invoices' => 'Laskut',
'title.add_invoice' => 'Laskun lisäys',
'title.view_invoice' => 'Laskun tarkastelu',
'title.delete_invoice' => 'Laskun poisto',
'title.notifications' => 'Ilmoitukset',
'title.add_notification' => 'Ilmoituksen lisäys',
'title.edit_notification' => 'Ilmoituksen muokkaus',
'title.delete_notification' => 'Ilmoituksen poisto',
// TODO: translate the following.
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Tiimitietojen vienti', // TODO: replace "team" with "group".
'title.import' => 'Tiimitietojen tunti', // TODO: replace "team" with "group".
'title.options' => 'Optiot',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
'title.profile' => 'Profiili',
'title.plugins' => 'Lisäosat',
'title.cf_custom_fields' => 'Omat kentät',
'title.cf_add_custom_field' => 'Oman kentän lisäys',
'title.cf_edit_custom_field' => 'Oman kentän muokkaus',
'title.cf_delete_custom_field' => 'Oman kentän poisto',
'title.cf_dropdown_options' => 'Pudotusvalikon vaihtoehdot',
'title.cf_add_dropdown_option' => 'Vaihtoehdon lisäys',
'title.cf_edit_dropdown_option' => 'Vaihtoehdon muokkaus',
'title.cf_delete_dropdown_option' => 'Vaihtoehdon poisto',
'title.locking' => 'Lukitus',
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
'dropdown.all' => '--- kaikki ---',
'dropdown.no' => '--- ei ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'päivä',
'dropdown.current_week' => 'tämä viikko',
'dropdown.previous_week' => 'viime viikko',
'dropdown.selected_week' => 'viikko',
'dropdown.current_month' => 'tämä kuu',
'dropdown.previous_month' => 'viime kuu',
'dropdown.selected_month' => 'kuu',
'dropdown.current_year' => 'tämä vuosi',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'vuosi',
'dropdown.all_time' => 'kaikki tunnit',
'dropdown.projects' => 'projektit',
'dropdown.tasks' => 'tehtävät',
'dropdown.clients' => 'asiakkaat',
'dropdown.select' => '--- valitse ---',
'dropdown.select_invoice' => '--- valitse lasku ---',
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'aktiivinen',
'dropdown.status_inactive' => 'inaktiivinen',
'dropdown.delete' => 'poista',
'dropdown.do_not_delete' => 'älä poista',
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
'form.login.forgot_password' => 'Salasana unohtunut?',
 // TODO: check translation of form.login.about - is open source "vapaan koodin"?
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> on vapaan koodin tuntiseurantaohjelmisto.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasanan nollauspyyntöviesti lähetetty.',
'form.reset_password.email_subject' => 'Anuko Time Tracker -salasanan nollauspyyntö',
// TODO: English string has changed. Re-translate.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is an open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Hyvä käyttäjä,\n\nJoku, IP %s, on pyytänyt nollaamaan Anuko Time Tracker -ohjelman salasanasi. Jos haluat nollata salasanasi, käy sivulla \n\n%s\n\nAnuko Time Tracker on vapaan koodin tuntiseurantaohjelmisto. Lisätietoja sivulla https://www.anuko.com.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Syötä uusi salasana ja osoita Tallenna.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm tai 0.0h)',
'form.time.billable' => 'Laskutettava',
'form.time.uncompleted' => 'Keskeneräinen',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Vain aloitusaika tallennettiin tietueeseen. Kyseessä ei ole virhe.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Tallenna raporttipohjaksi',
'form.reports.confirm_delete' => 'Haluatko varmasti poistaa tämän raporttipohjan?',
'form.reports.include_billable' => 'laskutettavat',
'form.reports.include_not_billable' => 'ei-laskutettavat',
'form.reports.include_invoiced' => 'laskutettu',
'form.reports.include_not_invoiced' => 'laskuttamatta',
// TODO: translate the following.
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'Valitse ajanjakso',
'form.reports.set_period' => 'tai aseta päivät',
'form.reports.show_fields' => 'Näytä kentät',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'Ryhmittelyperuste',
'form.reports.group_by_no' => '--- ei ryhmitystä ---',
'form.reports.group_by_date' => 'päivä',
'form.reports.group_by_user' => 'käyttäjä',
'form.reports.group_by_client' => 'asiakas',
'form.reports.group_by_project' => 'projekti',
'form.reports.group_by_task' => 'tehtävä',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Vie',
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

// Invoice form. See example at https://timetracker.anuko.com/invoice_view.php
// (you can get to this form after generating an invoice).
'form.invoice.number' => 'Laskun numero',
'form.invoice.person' => 'Henkilö',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Poistettava lasku',
'form.invoice.invoice_entries' => 'Laskurivit',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Ajalta',
'form.charts.chart' => 'Kaavio',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktiiviset projektit',
'form.projects.inactive_projects' => 'Ei-aktiiviset projektit',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktiiviset tehtävät',
'form.tasks.inactive_tasks' => 'Ei-aktiiviset tehtävät',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Rooli',
'form.users.manager' => 'Esimies',
'form.users.comanager' => 'Apuesimies',
'form.users.rate' => 'Taksa',
'form.users.default_rate' => 'Oletustuntitaksa',

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
'form.clients.active_clients' => 'Aktiiviset asiakkaat',
'form.clients.inactive_clients' => 'Ei-aktiiviset asiakkaat',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Poistettava asiakas',
'form.client.client_entries' => 'Asiakassyötteet',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Voit viedä tiimin tiedot xml-tiedostoksi, mikä voi helpottaa tietojen siirtoa omalle palvelimelle.',
'form.export.compression' => 'Pakkaus',
'form.export.compression_none' => 'ei pakata',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Tuo tiimitiedot xml-tiedostosta.', // TODO: replace "team" with "group".
'form.import.file' => 'Valitse tiedosto',
'form.import.success' => 'Tietojen tuonti onnistui.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Luo uusi tiimi luomalla ensin tiimin esimiehen käyttäjätili.<br>Tiimin tiedot voi myös tuoda toiselta Anuko Time Tracker -palvelimelta xml-muodossa (käyttäjänimien oltava uusia).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12-tuntinen',
'form.group_edit.24_hours' => '24-tuntinen',
// TODO: translate the following.
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
'form.group_edit.tracking_mode' => 'Seurantamuoto',
'form.group_edit.mode_time' => 'aika',
'form.group_edit.mode_projects' => 'projektit',
'form.group_edit.mode_projects_and_tasks' => 'projektit ja tehtävät',
'form.group_edit.record_type' => 'Tietueen tyyppi',
'form.group_edit.type_all' => 'kaikki',
'form.group_edit.type_start_finish' => 'aloitus ja lopetus',
'form.group_edit.type_duration' => 'kesto',
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
'form.mail.to' => 'Vastaanottaja',
'form.mail.report_subject' => 'Time Tracker -raportti',
// TODO: English string for form.mail.footer changed. Re-translate.
'form.mail.footer' => 'Anuko Time Tracker on yksinkertainen ja helppokäyttöinen vapaan koodin tuntiseurantaohjelmisto. Lisätietoja sivulla <a href="https://www.anuko.com">www.anuko.com</a>.',
'form.mail.report_sent' => 'Raportti lähetetty.',
'form.mail.invoice_sent' => 'Lasku lähetetty.',

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
