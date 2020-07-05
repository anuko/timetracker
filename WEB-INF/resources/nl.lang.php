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

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Aanmelden',
'menu.logout' => 'Afmelden',
'menu.forum' => 'Forum',
'menu.help' => 'Help',
'menu.register' => 'Registreren',
'menu.profile' => 'Profiel',
'menu.group' => 'Groep',
'menu.plugins' => 'Plugins',
'menu.time' => 'Tijden',
'menu.week' => 'Week',
'menu.expenses' => 'Kosten',
'menu.reports' => 'Rapporten',
'menu.timesheets' => 'Tijdenoverzichten',
'menu.charts' => 'Grafieken',
'menu.projects' => 'Projecten',
'menu.tasks' => 'Taken',
'menu.users' => 'Medewerkers',
'menu.groups' => 'Groepen',
'menu.subgroups' => 'Subgroepen',
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
'error.invoice_exists' => 'Dit nummer is al eens toegekend aan een factuur.',
'error.role_exists' => 'Een rol met deze rangorde bestaat al.',
'error.no_invoiceable_items' => 'Er zijn geen factuureerbare onderdelen.',
'error.no_records' => 'Er zijn geen records.',
'error.no_login' => 'Een medewerker met deze inlognaam bestaat niet.',
'error.no_groups' => 'Uw database is leeg. Meld je aan als admin en maak een nieuw groep.',
'error.upload' => 'Fout bij het uploaden van het bestand.',
'error.range_locked' => 'Datums zijn geblokkeerd.',
'error.mail_send' => 'Fout bij het versturen van een e-mailbericht. Gebruik MAIL_SMTP_DEBUG om het probleem te diagnosticeren',
'error.no_email' => 'Geen e-mailadres bekend voor dit account.',
'error.uncompleted_exists' => 'Niet afgeronde invoer bestaat al. Sluit of verwijder deze.',
'error.goto_uncompleted' => 'Ga naar onvolledige invoer.',
'error.overlap' => 'De huidige registratie overlapt een reeds bestaande registratie.',
'error.future_date' => 'Datum ligt in de toekomst.',
'error.xml' => 'Fout in XML bestand in regel line %d: %s.',
'error.cannot_import' => 'Kan het volgende niet importeren: %s.',
'error.format' => 'Bestandsformaat niet valide.',
'error.user_count' => 'Limiet op aantal gebruikers.',
'error.expired' => 'Verloop datum is bereikt.',

// TODO: translate error.file_storage and error.remote_work.

// Meaning of error.file_storage: an (unspecified) error occurred when trying to communicate with remote
// file storage server (the one that handles attachments). It is a generic message telling us that
// "something went wrong" when trying to do some operation with attachments.
// For example, File Storage server could be offline, or Time Tracker config option is wrong, etc.

// 'error.file_storage' => 'File storage server error.', // See comment in English file.

// Meaning of error.remote_work: an (unspecified) error occurred when trying to communicate with
// "Remote Work" server, the one that supports the "Work" plugin, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// It is a generic message telling us that "something went wrong" when trying to do some operation with Work plugin.
// For example, Remote Work server could be offline, among other things.

// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

// Warning messages.
'warn.sure' => 'Ben je er zeker van?',
'warn.confirm_save' => 'De datum is veranderd. Bevestig dat je dit item wilt opslaan en niet wilt kopiëren.',

// Success messages.
'msg.success' => 'De bewerking is succesvol uitgevoerd.',

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
'button.create_group' => 'Maak groep',
'button.export' => 'Groep exporteren',
'button.import' => 'Groep importeren',
'button.close' => 'Sluiten',
'button.stop' => 'Stop',
'button.approve' => 'Goedkeuren',
'button.disapprove' => 'Afkeuren',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Groepsnaam',
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
'label.group' => 'Groep',
'label.subgroups' => 'Subgroepen',
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
'label.sort' => 'Sorteren',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Eigen velden',
'label.monthly_quotas' => 'Doelen per maand',
'label.entity' => 'Entiteit',
'label.type' => 'Type',
'label.type_dropdown' => 'uitklapbaar',
'label.type_text' => 'tekst',
'label.required' => 'Verplicht veld',
'label.fav_report' => 'Standaard rapport',
'label.schedule' => 'Planning',
'label.what_is_it' => 'Meer informatie',
'label.expense' => 'Kosten',
'label.quantity' => 'Hoeveelheid',
'label.paid_status' => 'Status van betaling',
'label.paid' => 'Betaald',
'label.mark_paid' => 'Markeer als betaald',
'label.week_menu' => 'Week menu',
'label.week_note' => 'Week aantekening',
'label.week_list' => 'Week overzicht',
'label.work_units' => 'Werk eenheid',
'label.work_units_short' => 'Eenheid',
'label.totals_only' => 'Alleen totalen',
'label.quota' => 'Maanddoel',
'label.timesheet' => 'Tijdenoverzicht',
'label.submitted' => 'Verzonden',
'label.approved' => 'Goedgekeurd',
'label.approval' => 'Rapport goedkeuring',
'label.mark_approved' => 'Markeer goedkeuring',
'label.template' => 'Sjabloon',
// TODO: translate the following.
// 'label.bind_templates_with_projects' => 'Bind templates with projects',
// 'label.prepopulate_note' => 'Prepopulate Note field',
'label.attachments' => 'Bijlagen',
'label.files' => 'Bestanden',
'label.file' => 'Bestand',
'label.image' => 'Afbeelding',
'label.download' => 'Download',
'label.active_users' => 'Actieve medewerkers',
'label.inactive_users' => 'Inactieve medewerkers',
'label.details' => 'Details',
'label.budget' => 'Budget',
// TODO: translate the following.
// 'label.work' => 'Work',   // Table column header for work items, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.offer' => 'Offer', // Table column header for offers, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.contractor' => 'Contractor', // Table column header for offers (contractor is someone who offers to do work).
                                       // Technically, it is either an org name or a combination of org and group names
                                       // because both work items and offers are owned by Time Tracker groups of users.
// 'label.how_to_pay' => 'How to pay', // Label for the "How to pay" field on offers, which allows contractors to specify
                                       // how to pay them, for example: paypal email, check by mail to a specific address, etc.
// 'label.moderator_comment' => 'Moderator comment', // Label for "Moderator comment" field that explains something.

// Entity names.
'entity.time' => 'tijd',
'entity.user' => 'medewerker',
'entity.project' => 'project',

// Form titles.
'title.error' => 'Fout',
'title.success' => 'Succes',
'title.login' => 'Aanmelden',
'title.groups' => 'Groepen',
'title.subgroups' => 'Subgroepen',
'title.add_group' => 'Groep toevoegen',
'title.edit_group' => 'Groep bewerken',
'title.delete_group' => 'Groep aan het verwijderen',
'title.reset_password' => 'Wachtwoord herstellen',
'title.change_password' => 'Wachtwoord aan het veranderen',
'title.time' => 'Tijdsregistraties',
'title.edit_time_record' => 'Wijzigen tijdrecord',
'title.delete_time_record' => 'Verwijder tijdrecord',
'title.time_files' => 'Tijden bestanden',
'title.expenses' => 'Kosten',
'title.edit_expense' => 'Bewerk kosten artikel',
'title.delete_expense' => 'Verwijder kosten artikel',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.predefined_expenses' => 'Vaste kosten',
'title.add_predefined_expense' => 'Vaste kosten toevoegen',
'title.edit_predefined_expense' => 'Vaste kosten bewerken',
'title.delete_predefined_expense' => 'Vaste kosten verwijderen',
'title.reports' => 'Rapporten',
'title.report' => 'Rapport',
'title.send_report' => 'Rapport aan het versturen',
'title.timesheets' => 'Tijdenoverzichten',
'title.timesheet' => 'Tijdenoverzicht',
'title.timesheet_files' => 'Tijdenoverzichten bestanden',
'title.invoice' => 'Factuur',
'title.send_invoice' => 'Factuur verzenden',
'title.charts' => 'Grafieken',
'title.projects' => 'Projecten',
'title.project_files' => 'Project bestanden',
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
'title.add_timesheet' => 'Tijdenoverzicht toevoegen',
'title.edit_timesheet' => 'Tijdenoverzicht bewerken',
'title.delete_timesheet' => 'Tijdenoverzicht verwijderen',
'title.monthly_quotas' => 'Doelen per maand',
'title.export' => 'Exporteer groepsgegevens',
'title.import' => 'Importeer groepsgegevens',
'title.options' => 'Opties',
'title.display_options' => 'Beeld opties',
'title.profile' => 'Profiel',
'title.plugins' => 'Plugins',
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
'title.work_units' => 'Werk eenheid',
'title.templates' => 'Sjablonen',
'title.add_template' => 'Sjabloon toevoegen',
'title.edit_template' => 'Sjabloon bewerken',
'title.delete_template' => 'Sjabloon verwijderen',
'title.edit_file' => 'Bestand bewerken',
'title.delete_file' => 'Bestand verwijderen',
'title.download_file' => ' Bestand downloaden',
'title.work' => 'Werk',
'title.add_work' => 'Werk toevoegen',
'title.edit_work' => 'Werk bewerken',
'title.delete_work' => 'Werk verwijderen',
'title.active_work' => 'Actief werk',
'title.available_work' => 'Beschikbaar werk',
'title.inactive_work' => 'Inactief werk',
// TODO: translate the following.
// 'title.pending_work' => 'Pending Work', // Work items pending moderator approval.
// 'title.offer' => 'Offer',
'title.add_offer' => 'Aanbieding toevoegen',
'title.edit_offer' => 'Aanbieding bewerken',
'title.delete_offer' => 'Aanbieding verwijderen',
'title.active_offers' => 'Actieve aanbiedingen',
'title.available_offers' => 'Beschikbare aanbiedingen',
'title.inactive_offers' => 'Inactieve aanbiedingen',
// TODO: translate the following.
// 'title.pending_offers' => 'Pending Offers', // Offers pending moderator approval.

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
'dropdown.select_timesheet' => '--- kies tijdenoverzicht ---',
'dropdown.status_active' => 'actief',
'dropdown.status_inactive' => 'inactief',
'dropdown.delete' => 'verwijderen',
'dropdown.do_not_delete' => 'niet verwijderen',
// TODO: translate the following.
// 'dropdown.pending_approval' => 'pending approval',
'dropdown.approved' => 'goedgekeurd',
'dropdown.not_approved' => 'afgekeurd',
'dropdown.paid' => 'betaald',
'dropdown.not_paid' => 'niet betaald',
'dropdown.ascending' => 'oplopend',
'dropdown.descending' => 'aflopend',

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
'form.time.remaining_quota' => 'Nog te werken uren deze maand',
'form.time.over_quota' => 'Meer gewerkte uren deze maand',
'form.time.remaining_balance' => 'Minder gewerkte uren naar ratio',
'form.time.over_balance' => 'Meer gewerkte uren naar ratio',

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
'form.reports.include_assigned' => 'toegewezen',
'form.reports.include_not_assigned' => 'niet toegewezen',
'form.reports.include_pending' => 'in afwachting',
'form.reports.select_period' => 'Kies periode',
'form.reports.set_period' => 'of stel datums in',
'form.reports.show_fields' => 'Toon velden',
'form.reports.time_fields' => 'Tijd velden',
'form.reports.user_fields' => 'Medewerker velden',
'form.reports.group_by' => 'Groeperen op',
'form.reports.group_by_no' => '--- niet groeperen ---',
'form.reports.group_by_date' => 'datum',
'form.reports.group_by_user' => 'medewerker',
'form.reports.group_by_client' => 'klant',
'form.reports.group_by_project' => 'project',
'form.reports.group_by_task' => 'taak',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exporteer',
'form.report.assign_to_invoice' => 'Voeg toe aan factuur',
'form.report.assign_to_timesheet' => 'Wijs toe aan tijdenoverzicht',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php
'form.timesheets.active_timesheets' => 'Actieve tijdenoverzichten',
'form.timesheets.inactive_timesheets' => 'Inactieve tijdenoverzichten',

// Templates form. See example at https://timetracker.anuko.com/templates.php
'form.templates.active_templates' => 'Actieve sjablonen',
'form.templates.inactive_templates' => 'Inactieve sjablonen',

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
'form.export.hint' => 'U kunt alle groepsgegevens naar een xml bestand exporteren. Dit kan zinvol zijn als u gegevens migreert naar uw eigen server.',
'form.export.compression' => 'Compressie',
'form.export.compression_none' => 'geen',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importeer groepsgegevens uit een xml bestand.',
'form.import.file' => 'Kies bestand',
'form.import.success' => 'Importeren gelukt.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
'form.groups.hint' => 'Maak een nieuwe groep door een groeps manager account aan te maken.<br>U kunt ook groepsgegevens importeren uit een xml file van een andere Anuko Time Tracker server (login namen moeten uniek zijn).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 uurs',
'form.group_edit.24_hours' => '24 uurs',
'form.group_edit.display_options' => 'Beeld opties',
'form.group_edit.holidays' => 'Vakanties',
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
'form.group_edit.confirm_save' => 'Bevestigen dat je wilt opslaan',
'form.group_edit.allow_ip' => 'Toegestane IP adressen',
'form.group_edit.advanced_settings' => 'Geavanceerde instellingen',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
'form.group_delete.hint' => 'Bent u er zeker van dat u de hele groep wilt verwijderen?',

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
'form.quota.workday_hours' => 'Werkuren per dag',
'form.quota.hint' => 'Als de velden leeg worden gelaten, dan zullen de doelen worden berekend op bassis van het aantal werkuren per dag en vakantiedagen.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
'form.swap.hint' => 'Degradeer jezelf naar een lagere rol door een rol te verruilen met iemand anders. Dit kan niet ongedaan worden gemaakt.',
'form.swap.swap_with' => 'Verruil rol met',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
'form.work_units.minutes_in_unit' => 'Minuten per eenheid',
'form.work_units.1st_unit_threshold' => 'Drempel eerste eenheid',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Gebruiker',
'role.user.low_case_label' => 'gebruiker',
'role.user.description' => 'Een gebruiker zonder beheer rechten.',
'role.client.label' => 'Klant',
'role.client.low_case_label' => 'klant',
'role.client.description' => 'Een klant kan zijn eigen data inzien.',
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

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
'form.timesheet_view.submit_subject' => 'Verzoek goedkeuring tijdenoverzicht',
'form.timesheet_view.submit_body' => "Een nieuw tijdenoverzicht vereist goedkeuring.<p>User: %s.",
'form.timesheet_view.approve_subject' => 'Tijdenoverzicht goedgekeurd',
'form.timesheet_view.approve_body' => "Jouw tijdenoverzicht %s is goedgekeurd.<p>%s",
'form.timesheet_view.disapprove_subject' => 'Tijdenoverzicht afgekeurd',
'form.timesheet_view.disapprove_body' => "Jouw tijdenoverzicht %s is afgekeurd.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
'form.display_options.menu' => 'Menu',
'form.display_options.note_on_separate_row' => 'Notitie in aparte kolom',

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
