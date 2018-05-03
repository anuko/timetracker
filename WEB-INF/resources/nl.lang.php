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

$i18n_language = 'Dutch (Nederlands)';
$i18n_months = array('Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December');
$i18n_weekdays = array('Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag');
$i18n_weekdays_short = array('Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za');
// format mm/dd
$i18n_holidays = array('01/01', '04/09', '04/30', '05/18', '05/28', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Aanmelden',
'menu.logout' => 'Afmelden',
'menu.forum' => 'Forum',
'menu.help' => 'Help',
'menu.create_group' => 'Maak groep',
'menu.profile' => 'Profiel',
'menu.group' => 'Groep',
'menu.time' => 'Tijden',
'menu.expenses' => 'Kosten',
'menu.reports' => 'Rapporten',
'menu.charts' => 'Grafieken',
'menu.projects' => 'Projecten',
'menu.tasks' => 'Taken',
'menu.users' => 'Medewerkers',
'menu.groups' => 'Groepen',
'menu.export' => 'Exporteren',
'menu.clients' => 'Klanten',
'menu.options' => 'Opties',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Je kunt op verschillende manieren aan de ontwikkeling van Time Tracker bijdragen.',
'footer.credits' => 'Medewerkers',
'footer.license' => 'Licentie',
'footer.improve' => 'Bijdragen',

// Error messages.
'error.access_denied' => 'Toegang geweigerd.',
'error.sys' => 'Systeem fout.',
'error.db' => 'Database fout.',
'error.feature_disabled' => 'Functie is uitgeschakeld.',
'error.field' => 'Incorrecte gegevens: "{0}".',
'error.empty' => 'Veld "{0}" is leeg.',
'error.not_equal' => 'Veld "{0}" is niet gelijk aan veld "{1}".',
'error.interval' => 'Veld "{0}" moet later zijn dan "{1}".',
'error.project' => 'Kies project.',
'error.task' => 'Kies taak.',
'error.client' => 'Kies klant.',
'error.report' => 'Kies rapport.',
'error.record' => 'Kies record.',
'error.auth' => 'Onjuiste inlognaam of wachtwoord.',
'error.user_exists' => 'Een gebruiker met deze inlognaam bestaat al.',
'error.object_exists' => 'Een object met deze naam bestaat al.',
'error.project_exists' => 'Een project met deze naam bestaat al.',
'error.task_exists' => 'Er bestaat al een taak met deze naam.',
'error.client_exists' => 'Een klant met deze naam bestaat al.',
'error.invoice_exists' => 'Dit nummer is al eens toegekend aan een factuur.',
'error.role_exists' => 'Een rol met deze rangorde bestaat al.',
'error.no_invoiceable_items' => 'Er zijn geen factuureerbare onderdelen.',
'error.no_login' => 'Een medewerker met deze inlognaam bestaat niet.',
'error.no_groups' => 'Uw database is leeg. Meld je aan als admin en maak een nieuw groep.',
'error.upload' => 'Fout bij het uploaden van het bestand.',
'error.range_locked' => 'Datums zijn geblokkeerd.',
'error.mail_send' => 'Fout bij het versturen van een e-mailbericht.',
'error.no_email' => 'Geen e-mailadres bekend voor dit account.',
'error.uncompleted_exists' => 'Niet afgeronde invoer bestaat al. Sluit of verwijder deze.',
'error.goto_uncompleted' => 'Ga naar onvolledige invoer.',
'error.overlap' => 'De huidige registratie overlapt een reeds bestaande registratie.',
'error.future_date' => 'Datum ligt in de toekomst.',

// Labels for buttons.
'button.login' => 'Aanmelden',
'button.now' => 'Nu',
'button.save' => 'Bewaren',
'button.copy' => 'Kopiëren',
'button.cancel' => 'Afbreken',
'button.submit' => 'Bewaren',
'button.add' => 'Toevoegen',
'button.delete' => 'Verwijderen',
'button.generate' => 'Genereren',
'button.reset_password' => 'Herstel het wachtwoord',
'button.send' => 'Verzenden',
'button.send_by_email' => 'Verzend per e-mail',
'button.create_group' => 'Maak team', // TODO: replace "team" with "group".
'button.export' => 'Team exporteren', // TODO: replace "team" with "group".
'button.import' => 'Team importeren', // TODO: replace "team" with "group".
'button.close' => 'Sluiten',
'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Teamnaam', // TODO: replace "team" with "group".
'label.address' => 'Adres',
'label.currency' => 'Munteenheid',
'label.manager_name' => 'Naam van de manager',
'label.manager_login' => 'Inlognaam van de manager',
'label.person_name' => 'Naam',
'label.thing_name' => 'Naam',
'label.login' => 'Inlognaam',
'label.password' => 'Wachtwoord',
'label.confirm_password' => 'Bevestig wachtwoord',
'label.email' => 'E-mailadres',
'label.cc' => 'Cc',
'label.bcc' => 'Bcc',
'label.subject' => 'Onderwerp',
'label.date' => 'Datum',
'label.start_date' => 'Begindatum',
'label.end_date' => 'Einddatum',
'label.user' => 'Medewerker',
'label.users' => 'Medewerkers',
'label.roles' => 'Rollen',
'label.client' => 'Klant',
'label.clients' => 'Klanten',
'label.option' => 'Optie',
'label.invoice' => 'Factuur',
'label.project' => 'Project',
'label.projects' => 'Projecten',
'label.task' => 'Taak',
'label.tasks' => 'Taken',
'label.description' => 'Omschrijving',
'label.start' => 'Aanvang',
'label.finish' => 'Einde',
'label.duration' => 'Tijdsduur',
'label.note' => 'Opmerking',
'label.notes' => 'Notities',
'label.item' => 'Artikel',
'label.cost' => 'Kosten',
'label.ip' => 'IP adres',
'label.day_total' => 'Dag totaal',
'label.week_total' => 'Week totaal',
'label.month_total' => 'Maand totaal',
'label.today' => 'Vandaag',
'label.view' => 'Bekijk',
'label.edit' => 'Wijzig',
'label.delete' => 'Verwijderen',
'label.configure' => 'Stel in',
'label.select_all' => 'Selecteer alle',
'label.select_none' => 'Selecteer niets',
'label.day_view' => 'Dag overzicht',
'label.week_view' => 'Week overzicht',
'label.id' => 'ID',
'label.language' => 'Taal',
'label.decimal_mark' => 'Decimaal teken',
'label.date_format' => 'Datum formaat',
'label.time_format' => 'Tijdsaanduiding',
'label.week_start' => 'Eerste dag van de week',
'label.comment' => 'Opmerkingen',
'label.status' => 'Status',
'label.tax' => 'BTW',
'label.subtotal' => 'Subtotaal',
'label.total' => 'Totaal',
'label.client_name' => 'Naam van de klant',
'label.client_address' => 'Adres van de klant',
'label.or' => 'of',
'label.error' => 'Fout',
'label.ldap_hint' => 'Type uw <b>Windows login</b> en <b>wachtwoord</b> in de onderstaande velden.',
'label.required_fields' => '* - verplichte velden',
'label.on_behalf' => 'namens',
'label.role_manager' => '(manager)',
'label.role_comanager' => '(co-manager)',
'label.role_admin' => '(beheerder)',
'label.page' => 'Pagina',
'label.condition' => 'Voorwaarde',
'label.yes' => 'ja',
'label.no' => 'nee',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Eigen velden',
'label.monthly_quotas' => 'Doelen per maand',
'label.type' => 'Type',
'label.type_dropdown' => 'uitklapbaar',
'label.type_text' => 'tekst',
'label.required' => 'Verplicht veld',
'label.fav_report' => 'Standaard rapport',
'label.schedule' => 'Planning',
'label.what_is_it' => 'Wat betekent dit?',
'label.expense' => 'Kosten',
'label.quantity' => 'Hoeveelheid',
'label.paid_status' => 'Status van betaling',
'label.paid' => 'Betaald',
'label.mark_paid' => 'Markeer als betaald',
'label.week_note' => 'Week aantekening',
'label.week_list' => 'Week overzicht',

// Form titles.
'title.login' => 'Aanmelden',
'title.groups' => 'Teams', // TODO: change "teams" to "groups".
'title.create_group' => 'Team maken', // TODO: change "team" to "group".
'title.edit_group' => 'Team bewerken', // TODO: change "team" to "group".
'title.delete_group' => 'Team aan het verwijderen', // TODO: change "team" to "group".
'title.reset_password' => 'Wachtwoord herstellen',
'title.change_password' => 'Wachtwoord aan het veranderen',
'title.time' => 'Tijdsregistraties',
'title.edit_time_record' => 'Wijzigen tijdrecord',
'title.delete_time_record' => 'Verwijder tijdrecord',
'title.expenses' => 'Kosten',
'title.edit_expense' => 'Bewerk kosten artikel',
'title.delete_expense' => 'Verwijder kosten artikel',
'title.predefined_expenses' => 'Vaste kosten',
'title.add_predefined_expense' => 'Vaste kosten toevoegen',
'title.edit_predefined_expense' => 'Vaste kosten bewerken',
'title.delete_predefined_expense' => 'Vaste kosten verwijderen',
'title.reports' => 'Rapporten',
'title.report' => 'Rapport',
'title.send_report' => 'Rapport aan het versturen',
'title.invoice' => 'Factuur',
'title.send_invoice' => 'Factuur verzenden',
'title.charts' => 'Grafieken',
'title.projects' => 'Projecten',
'title.add_project' => 'Project toevoegen',
'title.edit_project' => 'Project wijzigen',
'title.delete_project' => 'Project verwijderen',
'title.tasks' => 'Taken',
'title.add_task' => 'Taak toevoegen',
'title.edit_task' => 'Taak wijzigen',
'title.delete_task' => 'Taak verwijderen',
'title.users' => 'Medewerkers',
'title.add_user' => 'Medewerker toevoegen',
'title.edit_user' => 'Medewerker wijzigen',
'title.delete_user' => 'Medewerker verwijderen',
'title.roles' => 'Rollen',
'title.add_role' => 'Rol toevoegen',
'title.edit_role' => 'Rol wijzigen',
'title.delete_role' => 'Rol verwijderen',
'title.clients' => 'Klanten',
'title.add_client' => 'Klant toevoegen',
'title.edit_client' => 'Klant wijzigen',
'title.delete_client' => 'Klant verwijderen',
'title.invoices' => 'Facturen',
'title.add_invoice' => 'Factuur toevoegen',
'title.view_invoice' => 'Factuur bekijken',
'title.delete_invoice' => 'Factuur verwijderen',
'title.notifications' => 'Notificaties',
'title.add_notification' => 'Notificatie toevoegen',
'title.edit_notification' => 'Notificatie bewerken',
'title.delete_notification' => 'Notificatie verwijderen',
'title.monthly_quotas' => 'Doelen per maand',
'title.export' => 'Exporteer teamgegevens', // TODO: replace "team" with "group".
'title.import' => 'Importeer teamgegevens', // TODO: replace "team" with "group".
'title.options' => 'Opties',
'title.profile' => 'Profiel',
'title.group' => 'Groep instelling',
'title.cf_custom_fields' => 'Eigen velden',
'title.cf_add_custom_field' => 'Eigen veld toevoegen',
'title.cf_edit_custom_field' => 'Eigen veld bewerken',
'title.cf_delete_custom_field' => 'Eigen veld verwijderen',
'title.cf_dropdown_options' => 'Uitvouwmogelijkheden',
'title.cf_add_dropdown_option' => 'Uitvouwmogelijkheid toevoegen',
'title.cf_edit_dropdown_option' => 'Uitvouwmogelijkheid bewerken',
'title.cf_delete_dropdown_option' => 'Uitvouwmogelijkheid verwijderen',
'title.locking' => 'Blokkeren',
'title.week_view' => 'Week overzicht',
'title.swap_roles' => 'Rollen verruilen',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- allemaal ---',
'dropdown.no' => '--- geen ---',
'dropdown.current_day' => 'vandaag',
'dropdown.previous_day' => 'gisteren',
'dropdown.selected_day' => 'dag',
'dropdown.current_week' => 'deze week',
'dropdown.previous_week' => 'vorige week',
'dropdown.selected_week' => 'week',
'dropdown.current_month' => 'deze maand',
'dropdown.previous_month' => 'vorige maand',
'dropdown.selected_month' => 'maand',
'dropdown.current_year' => 'dit jaar',
'dropdown.previous_year' => 'vorig jaar',
'dropdown.selected_year' => 'jaar',
'dropdown.all_time' => 'alles',
'dropdown.projects' => 'projecten',
'dropdown.tasks' => 'taken',
'dropdown.clients' => 'klanten',
'dropdown.select' => '--- kies ---',
'dropdown.select_invoice' => '--- kies factuur ---',
'dropdown.status_active' => 'actief',
'dropdown.status_inactive' => 'inactief',
'dropdown.delete' => 'verwijderen',
'dropdown.do_not_delete' => 'niet verwijderen',
'dropdown.paid' => 'betaald',
'dropdown.not_paid' => 'niet betaald',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Wachtwoord vergeten?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is een eenvoudig en gemakkelijk te gebruiken open source tijdregistratiesysteem.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Het verzoek om het wachtwoord te herstellen is verzonden per email.',
'form.reset_password.email_subject' => 'Anuko Time Tracker wachtwoord herstel verzoek',
'form.reset_password.email_body' => "Geachte medewerker,\n\nIemand, met IP adres %s, heeft verzocht uw wachtwoord in Anuko Time Tracker te herstellen. Klik op deze link als u uw wachtwoord wil wijzigen.\n\n%s\n\nAnuko Time Tracker is een eenvoudig en gemakkelijk te gebruiken open source tijdregistratiesysteem. Bezoek https://www.anuko.com voor meer informatie.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Voer het nieuwe wachtwoord in en klik op Bewaren.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(uu:mm of 0.0u)',
'form.time.billable' => 'Factureerbaar',
'form.time.uncompleted' => 'Onvolledig',
'form.time.remaining_quota' => 'Te werken uren voor de doelstelling',
'form.time.over_quota' => 'Meer gewerkte uren dan de doelstelling',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Dit tijdrecord is opgeslagen met alleen een starttijd. Dit is geen fout.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Nieuwe toevoeging',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Bewaren als standaard',
'form.reports.confirm_delete' => 'Weet u zeker dat u deze favoriete rapportage wilt verwijderen?',
'form.reports.include_billable' => 'factureerbaar',
'form.reports.include_not_billable' => 'niet factureerbaar',
'form.reports.include_invoiced' => 'gefactureerd',
'form.reports.include_not_invoiced' => 'niet gefactureerd',
'form.reports.select_period' => 'Kies periode',
'form.reports.set_period' => 'of stel datums in',
'form.reports.show_fields' => 'Toon velden',
'form.reports.group_by' => 'Groeperen op',
'form.reports.group_by_no' => '--- niet groeperen ---',
'form.reports.group_by_date' => 'datum',
'form.reports.group_by_user' => 'medewerker',
'form.reports.group_by_client' => 'klant',
'form.reports.group_by_project' => 'project',
'form.reports.group_by_task' => 'taak',
'form.reports.totals_only' => 'Alleen totalen',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exporteer',
'form.report.assign_to_invoice' => 'Voeg toe aan factuur',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Factuur nummer',
'form.invoice.person' => 'Medewerker',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Te verwijderen factuur',
'form.invoice.invoice_entries' => 'Factuur gegevens',
'form.invoice.confirm_deleting_entries' => 'Bevestig het verwijderen van de facturen uit Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Periode',
'form.charts.chart' => 'Grafiek',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Actieve projecten',
'form.projects.inactive_projects' => 'Inactieve projecten',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Actieve taken',
'form.tasks.inactive_tasks' => 'Inactieve taken',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Actieve medewerkers',
'form.users.inactive_users' => 'Inactieve medewerkers',
'form.users.uncompleted_entry' => 'Gebruiker heeft tijd ingevoerd die niet compleet is',
'form.users.role' => 'Rol',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Tarief',
'form.users.default_rate' => 'Standaard uurtarief',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
'form.user_edit.swap_roles' => 'Rollen verruilen',

// Roles form. See example at https://timetracker.anuko.com/roles.php
'form.roles.active_roles' => 'Actieve rollen',
'form.roles.inactive_roles' => 'Inactieve rollen',
'form.roles.rank' => 'Volgorde',
'form.roles.rights' => 'Rechten',
'form.roles.assigned' => 'Toegewezen',
'form.roles.not_assigned' => 'Niet toegewezen',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Actieve klanten',
'form.clients.inactive_clients' => 'Inactieve klanten',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Klant die wordt verwijderd',
'form.client.client_entries' => 'Klant gegevens',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'U kunt alle teamgegevens naar een xml bestand exporteren. Dit kan zinvol zijn als u gegevens migreert naar uw eigen server.',
'form.export.compression' => 'Compressie',
'form.export.compression_none' => 'geen',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Importeer teamgegevens uit een xml bestand.', // TODO: replace "team" with "group".
'form.import.file' => 'Kies bestand',
'form.import.success' => 'Importeren gelukt.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below (3 places).
'form.groups.hint' => 'Maak een nieuw team door een team  manager account aan te maken.<br>U kunt ook teamgegevens importeren uit een xml file van een andere Anuko Time Tracker server (login namen moeten uniek zijn).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 uurs',
'form.group_edit.24_hours' => '24 uurs',
'form.group_edit.show_holidays' => 'Toon vakantiedagen',
'form.group_edit.tracking_mode' => 'Bijhouden',
'form.group_edit.mode_time' => 'tijd',
'form.group_edit.mode_projects' => 'projecten',
'form.group_edit.mode_projects_and_tasks' => 'projecten en taken',
'form.group_edit.record_type' => 'Registratie type',
'form.group_edit.type_all' => 'begin, einde en duur',
'form.group_edit.type_start_finish' => 'begin en einde',
'form.group_edit.type_duration' => 'duur',
'form.group_edit.punch_mode' => 'Start/stop modus',
'form.group_edit.allow_overlap' => 'Sta overlapping van tijden toe',
'form.group_edit.future_entries' => 'Toevoegingen toestaan in de toekomst',
'form.group_edit.uncompleted_indicators' => 'Onvolledige indicatoren',
'form.group_edit.allow_ip' => 'Toegestane IP adressen',
'form.group_edit.plugins' => 'Plugins',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Van',
'form.mail.to' => 'Aan',
'form.mail.report_subject' => 'Time Tracker rapport',
'form.mail.footer' => 'Anuko Time Tracker is een eenvoudig en gemakkelijk te gebruiken open source tijdregistratiesysteem. Bezoek <a href="https://www.anuko.com">www.anuko.com</a> voor meer informatie.',
'form.mail.report_sent' => 'Rapport is verzonden.',
'form.mail.invoice_sent' => 'Factuur is verzonden.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Jaar',
'form.quota.month' => 'Maand',
'form.quota.quota' => 'Quota',
'form.quota.workday_hours' => 'Werkuren per dag',
'form.quota.hint' => 'Als de velden leeg worden gelaten, dan zullen de doelen worden berekend op bassis van het aantal werkuren per dag en vakantiedagen.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
'form.swap.hint' => 'Degradeer jezelf naar een lagere rol door een rol te verruilen met iemand anders. Dit kan niet ongedaan worden gemaakt.',
'form.swap.swap_with' => 'Verruil rol met',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Gebruiker',
'role.user.low_case_label' => 'gebruiker',
'role.user.description' => 'Een gebruiker zonder beheer rechten.',
'role.client.label' => 'Klant',
'role.client.low_case_label' => 'klant',
'role.client.description' => 'Een klant kan zijn eigen rapporten, grafieken en facturen inzien.',
'role.supervisor.label' => 'Supervisor',
'role.supervisor.low_case_label' => 'supervisor',
'role.supervisor.description' => 'Een persoon met beperkte beheer rechten.',
'role.comanager.label' => 'Co-beheerder',
'role.comanager.low_case_label' => 'co-beheerder',
'role.comanager.description' => 'Een persoon met gemiddelde beheer rechten.',
'role.manager.label' => 'Beheerder',
'role.manager.low_case_label' => 'beheerder',
'role.manager.description' => 'Group beheerder. Kan een groep beheren.',
'role.top_manager.label' => 'Top beheerder',
'role.top_manager.low_case_label' => 'top beheerder',
'role.top_manager.description' => 'Top groepsbeheerder. Kan alle groepen beheren.',
'role.admin.label' => 'Administrator',
'role.admin.low_case_label' => 'administrator',
'role.admin.description' => 'Time Tracker beheerder.',
);
