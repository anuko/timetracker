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

$i18n_language = 'Suomi';
$i18n_months = array('Tammikuu', 'Helmikuu', 'Maaliskuu', 'Huhtikuu', 'Toukokuu', 'Kesäkuu', 'Heinäkuu', 'Elokuu', 'Syyskuu', 'Lokakuu', 'Marraskuu', 'Joulukuu');
$i18n_weekdays = array('Sunnuntai', 'Maanantai', 'Tiistai', 'Keskiviikko', 'Torstai', 'Perjantai', 'Lauantai');
$i18n_weekdays_short = array('su', 'ma', 'ti', 'ke', 'to', 'pe', 'la');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '05/01', '06/24', '12/06', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on the top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Kirjaudu',
'menu.logout' => 'Kirjaudu ulos',
'menu.forum' => 'Keskustelupalsta',
'menu.help' => 'Apua',
'menu.create_team' => 'Luo tiimi',
'menu.profile' => 'Profiili',
'menu.time' => 'Tunnit',
'menu.expenses' => 'Kulut',
'menu.reports' => 'Raportit',
'menu.charts' => 'Kaaviot',
'menu.projects' => 'Projektit',
'menu.tasks' => 'Tehtävät',
'menu.users' => 'Käyttäjät',
'menu.teams' => 'Tiimit',
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
'error.field' => 'Virheellinen "{0}" tieto.',
'error.empty' => 'Kenttä "{0}" on tyhjä.',
'error.not_equal' => 'Kentät "{0}" ja "{1}" eivät ole samat.',
'error.interval' => 'Kentän "{0}" arvon tulee olla suurempi kuin kentän "{1}".',
'error.project' => 'Valitse projekti.',
'error.task' => 'Valitse tehtävä.',
'error.client' => 'Valitse asiakas.',
'error.report' => 'Valitse raportti.',
'error.auth' => 'Virheellinen käyttäjänimi tai salasana.',
'error.user_exists' => 'Tämä käyttäjänimi on jo olemassa.',
'error.project_exists' => 'Tämän niminen projekti on jo olemassa.',
'error.task_exists' => 'Tämän niminen tehtävä on jo olemassa.',
'error.client_exists' => 'Tämän niminen asiakas on jo olemassa.',
'error.invoice_exists' => 'Tällä numerolla oleva lasku on jo olemassa.',
'error.no_invoiceable_items' => 'Ei laskutettavia syötteitä.',
'error.no_login' => 'Tuntematon käyttäjänimi.',
'error.no_teams' => 'Tietokanta on tyhjä. Kirjaudu ylläpitäjänä ja luo uusi tiimi.',
'error.upload' => 'Virhe tiedoston lataus.',
'error.range_locked' => 'Aikaväli on lukittu.',
'error.mail_send' => 'Virhe postinlähetyksessä.',
'error.no_email' => 'Käyttäjätunnukseen ei ole liitetty sähköpostiosoitetta.',
'error.uncompleted_exists' => 'Kesken oleva syötetieto on jo olemassa. Sulje tai poista se.',
'error.goto_uncompleted' => 'Siirry kesken olevaan syötteeseen.',
'error.overlap' => 'Aikavälillä on päällekkäisiä syötteitä.',
'error.future_date' => 'Aika on tulevaisuudessa.',

// Labels for buttons.
'button.login' => 'Kirjaudu',
'button.now' => 'Nyt',
'button.save' => 'Tallenna',
'button.copy' => 'Kopioi',
'button.cancel' => 'Keskeytä',
'button.submit' => 'Hyväksy',
'button.add_user' => 'Lisää käyttäjä',
'button.add_project' => 'Lisää projekti',
'button.add_task' => 'Lisää tehtävä',
'button.add_client' => 'Lisää asiakas',
'button.add_invoice' => 'Lisää lasku',
'button.add_option' => 'Lisää optio',
'button.add' => 'Lisää',
'button.generate' => 'Luo',
'button.reset_password' => 'Nollaa salasana',
'button.send' => 'Lähetä',
'button.send_by_email' => 'Lähetä sähköpostilla',
'button.create_team' => 'Luo tiimi',
'button.export' => 'Vie tiimi',
'button.import' => 'Tuo tiimi',
'button.close' => 'Sulje',
'button.stop' => 'Lopeta',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Tiimin nimi',
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
'label.date' => 'Päiväys',
'label.start_date' => 'Aloituspäivä',
'label.end_date' => 'Päättymispäivä',
'label.user' => 'Käyttäjä',
'label.users' => 'Käyttäjät',
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
'label.item' => 'Syöte',
'label.cost' => 'Hinta',
'label.week_total' => 'Viikko yhteensä',
'label.day_total' => 'Päivä yhteensä',
// 'label.month_total' => 'Month total',
// 'label.month_left' => 'Time until quota is met',
// 'label.month_over' => 'Over monthly quota',
'label.today' => 'Tänään',
'label.total_hours' => 'Tunnit yhteensä',
'label.total_cost' => 'Hinta yhteensä',
'label.view' => 'Näytä',
'label.edit' => 'Muokkaa',
'label.delete' => 'Poista',
'label.configure' => 'Aseta',
'label.select_all' => 'Valitse kaikki',
'label.select_none' => 'Poista kaikki valinnat',
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
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Omat kentät',
'label.type' => 'Tyyppi',
'label.type_dropdown' => 'pudotusvalikko',
'label.type_text' => 'teksti',
'label.required' => 'Pakollinen',
'label.fav_report' => 'Raporttipohja',
'label.cron_schedule' => 'Cron-ajoitus',
'label.what_is_it' => 'Mikä se on?',
// 'label.year' => 'Year',
// 'label.month' => 'Month',
// 'label.quota' => 'Quota',
// 'label.dailyWorkingHours' => 'Daily working hours',
// 'label.empty_values_explanation' => 'If values are empty, quotas are calculated automatically based on holidays in config',

// Form titles.
'title.login' => 'Kirjautuminen',
'title.teams' => 'Tiimit',
'title.create_team' => 'Tiimin luonti',
'title.edit_team' => 'Tiimin muokkaus',
'title.delete_team' => 'Tiimin poisto',
'title.reset_password' => 'Salasanan nollaus',
'title.change_password' => 'Salasanan vaihto',
'title.time' => 'Tuntien kirjaus',
'title.edit_time_record' => 'Tuntikirjausten muokkaus',
'title.delete_time_record' => 'Tuntikirjausten poisto',
'title.expenses' => 'Kulut',
'title.edit_expense' => 'Kulutietojen muokkaus',
'title.delete_expense' => 'Kulutiedon poisto',
'title.reports' => 'Raportit',
'title.report' => 'Raportti',
'title.send_report' => 'Raportin lähetys',
'title.invoice' => 'Lasku',
'title.send_invoice' => 'Laskun lähetys',
'title.charts' => 'Kaaviot',
'title.projects' => 'Projektit',
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
// 'title.monthly_quota' => 'Monthly quota',
'title.export' => 'Tiimitietojen vienti',
'title.import' => 'Tiimitietojen tunti',
'title.options' => 'Optiot',
'title.profile' => 'Profiili',
'title.cf_custom_fields' => 'Omat kentät',
'title.cf_add_custom_field' => 'Oman kentän lisäys',
'title.cf_edit_custom_field' => 'Oman kentän muokkaus',
'title.cf_delete_custom_field' => 'Oman kentän poisto',
'title.cf_dropdown_options' => 'Pudotusvalikon vaihtoehdot',
'title.cf_add_dropdown_option' => 'Vaihtoehdon lisäys',
'title.cf_edit_dropdown_option' => 'Vaihtoehdon muokkaus',
'title.cf_delete_dropdown_option' => 'Vaihtoehdon poisto',
'title.locking' => 'Lukitus',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- kaikki ---',
'dropdown.no' => '--- ei ---',
'dropdown.this_day' => 'tämä päivä',
'dropdown.this_week' => 'tämä viikko',
'dropdown.last_week' => 'viime viikko',
'dropdown.this_month' => 'tämä kuu',
'dropdown.last_month' => 'viime kuu',
'dropdown.this_year' => 'tämä vuosi',
'dropdown.all_time' => 'kaikki tunnit',
'dropdown.projects' => 'projektit',
'dropdown.tasks' => 'tehtävät',
'dropdown.clients' => 'asiakkaat',
'dropdown.select' => '--- valitse ---',
'dropdown.select_invoice' => '--- valitse lasku ---',
'dropdown.status_active' => 'aktiivinen',
'dropdown.status_inactive' => 'inaktiivinen',
'dropdown.delete'=>'poista',
'dropdown.do_not_delete'=>'älä poista',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Salasana unohtunut?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> on yksinkertainen ja helppokäyttöinen vapaan koodin tuntiseurantaohjelmisto.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Salasanan nollauspyyntöviesti lähetetty.',
'form.reset_password.email_subject' => 'Anuko Time Tracker -salasanan nollauspyyntö',
'form.reset_password.email_body' => "Hyvä käyttäjä,\n\nJoku, mahdollisesti sinä itse, on pyytänyt nollaamaan Anuko Time Tracker -ohjelman salasanasi. Jos haluat nollata salasanasi, käy sivulla \n\n%s\n\nAnuko Time Tracker on yksinkertainen ja helppokäyttöinen vapaan koodin tuntiseurantaohjelmisto. Lisätietoja sivulla https://www.anuko.com.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Syötä uusi salasana ja osoita Tallenna.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm tai 0.0h)',
'form.time.billable' => 'Laskutettava',
'form.time.uncompleted' => 'Keskeneräinen',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Vain aloitusaika tallennettiin tietueeseen. Kyseessä ei ole virhe.',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Tallenna raporttipohjaksi',
'form.reports.confirm_delete' => 'Haluatko varmasti poistaa tämän raporttipohjan?',
'form.reports.include_records' => 'Sisällytä tietueet',
'form.reports.include_billable' => 'laskutettavat',
'form.reports.include_not_billable' => 'ei-laskutettavat',
'form.reports.include_invoiced' => 'laskutettu',
'form.reports.include_not_invoiced' => 'laskuttamatta',
'form.reports.select_period' => 'Valitse ajanjakso',
'form.reports.set_period' => 'tai aseta päivät',
'form.reports.show_fields' => 'Näytä kentät',
'form.reports.group_by' => 'Ryhmittelyperuste',
'form.reports.group_by_no' => '--- ei ryhmitystä ---',
'form.reports.group_by_date' => 'päivä',
'form.reports.group_by_user' => 'käyttäjä',
'form.reports.group_by_client' => 'asiakas',
'form.reports.group_by_project' => 'projekti',
'form.reports.group_by_task' => 'tehtävä',
'form.reports.totals_only' => 'Vain yhteissummat',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Vie',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Laskun numero',
'form.invoice.person' => 'Henkilö',
'form.invoice.invoice_to_delete' => 'Poistettava lasku',
'form.invoice.invoice_entries' => 'Laskurivit',

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
'form.users.active_users' => 'Aktiiviset käyttäjät',
'form.users.inactive_users' => 'Ei-aktiiviset käyttäjät',
'form.users.role' => 'Rooli',
'form.users.manager' => 'Esimies',
'form.users.comanager' => 'Apuesimies',
'form.users.rate' => 'Taksa',
'form.users.default_rate' => 'Oletustuntitaksa',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Poistettava asiakas',
'form.client.client_entries' => 'Asiakassyötteet',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktiiviset asiakkaat',
'form.clients.inactive_clients' => 'Ei-aktiiviset asiakkaat',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Voit viedä tiimin tiedot xml-tiedostoksi, mikä voi helpottaa tietojen siirtoa omalle palvelimelle.',
'form.export.compression' => 'Pakkaus',
'form.export.compression_none' => 'ei pakata',
'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Tuo tiimitiedot xml-tiedostosta.',
'form.import.file' => 'Valitse tiedosto',
'form.import.success' => 'Tietojen tuonti onnistui.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' =>  'Luo uusi tiimi luomalla ensin tiimin esimiehen käyttäjätili.<br>Tiimin tiedot voi myös tuoda toiselta Anuko Time Tracker -palvelimelta xml-muodossa (käyttäjänimien oltava uusia).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12-tuntinen',
'form.profile.24_hours' => '24-tuntinen',
'form.profile.tracking_mode' => 'Seurantamuoto',
'form.profile.mode_time' => 'aika',
'form.profile.mode_projects' => 'projektit',
'form.profile.mode_projects_and_tasks' => 'projektit ja tehtävät',
'form.profile.record_type' => 'Tietueen tyyppi',
'form.profile.type_all' => 'kaikki',
'form.profile.type_start_finish' => 'aloitus ja lopetus',
'form.profile.type_duration' => 'kesto',
'form.profile.plugins' => 'Lisäosat',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Lähettäjä',
'form.mail.to' => 'Vastaanottaja',
'form.mail.cc' => 'Kopio',
'form.mail.subject' => 'Aihe',
'form.mail.report_subject' => 'Time Tracker -raportti',
'form.mail.footer' => 'Anuko Time Tracker on yksinkertainen ja helppokäyttöinen vapaan koodin tuntiseurantaohjelmisto. Lisätietoja sivulla <a href="https://www.anuko.com">www.anuko.com</a>.',
'form.mail.report_sent' => 'Raportti lähetetty.',
'form.mail.invoice_sent' => 'Lasku lähetetty.',
);
