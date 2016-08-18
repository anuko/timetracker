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

$i18n_language = 'Srpski';
$i18n_months = array('Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar');
$i18n_weekdays = array('Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Četvrtak', 'Petak', 'Subota');
$i18n_weekdays_short = array('Ne', 'Po', 'Ut', 'Sr', 'Če', 'Pe', 'Su');
// format dd/mm
$i18n_holidays = array('01/01', '02/01', '07/01', '15/01', '16/02', '29/04', '30/04', '01/05', '02/05', '03/05', '22/04', '09/05', '28/06', '21/10', '11/11');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on the top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Prijava',
'menu.logout' => 'Odjava',
'menu.forum' => 'Forum',
'menu.help' => 'Pomoć',
'menu.create_team' => 'Napravi tim',
'menu.profile' => 'Profil',
'menu.time' => 'Vreme',
'menu.expenses' => 'Troškovi',
'menu.reports' => 'Izveštaji',
'menu.charts' => 'Grafikoni',
'menu.projects' => 'Projekti',
'menu.tasks' => 'Zadaci',
'menu.users' => 'Korisnici',
'menu.teams' => 'Timovi',
'menu.export' => 'Izvoz',
'menu.clients' => 'Klijenti',
'menu.options' => 'Opcije',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Time Tracker-u možete doprineti i na drugi način.',
'footer.credits' => 'Zasluge',
'footer.license' => 'Licenca',
'footer.improve' => 'Unapredi',

// Error messages.
'error.access_denied' => 'Pristup odbijen.',
'error.sys' => 'Greška u sistemu.',
'error.db' => 'Greška u bazi podataka.',
'error.field' => 'Pogrešan "{0}" podatak.',
'error.empty' => 'Polje "{0}" je prazno.',
'error.not_equal' => 'Polje "{0}" nije jednak polju "{1}".',
'error.interval' => 'Polje "{0}" mora biti viši od "{1}".',
'error.project' => 'Odaberi projekat.',
'error.task' => 'Odaberi zadatak.',
'error.client' => 'Odaberi klijenta.',
'error.report' => 'Odaberi izveštaj.',
'error.auth' => 'Pogrešno korisničko ime ili lozinka.',
'error.user_exists' => 'Korisnik pod ovim imenom već postoji.',
'error.project_exists' => 'Projekat pod ovim nazivom već postoji.',
'error.task_exists' => 'Zadatak pod ovim nazivom već postoji.',
'error.client_exists' => 'Klijent pod ovim imenom već postoji.',
'error.invoice_exists' => 'Račun pod ovim brojem već postoji.',
'error.no_invoiceable_items' => 'Nema stavke za naplatu.',
'error.no_login' => 'Nema korisnika pod ovom prijavom',
'error.no_teams' => 'Vaša baza podataka je prazna. Prijavite se kao administrator i napravite novi tim.',
'error.upload' => 'Greška pri otpremanju podatka.',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Greška u slanju mejla.',
'error.no_email' => 'Nema imejla pod korisničkom imenom.',
'error.uncompleted_exists' => 'Unos već postoji ali je nekompletan. Zatvorite postojeći ili obrišite unos.',
'error.goto_uncompleted' => 'Prikaži postojeći unos.',
'error.overlap' => 'Navedeni vremenski interval se podudara sa već unetim vremenom.',
'error.future_date' => 'Naveli ste budući datum.',

// Labels for buttons.
'button.login' => 'Prijava',
'button.now' => 'Sada',
'button.save' => 'Sačuvaj',
'button.copy' => 'Kopiraj',
'button.cancel' => 'Otkaži',
'button.submit' => 'Pošalji',
'button.add_user' => 'Dodaj korisnika',
'button.add_project' => 'Dodaj projekat',
'button.add_task' => 'Dodaj zadatak',
'button.add_client' => 'Dodaj klijenta',
'button.add_invoice' => 'Dodaj račun',
'button.add_option' => 'Dodaj opcije',
'button.add' => 'Dodaj',
'button.generate' => 'Napravi',
'button.reset_password' => 'Resetuj lozinku',
'button.send' => 'Pošalji',
'button.send_by_email' => 'Pošalji mejlom',
'button.create_team' => 'Napravi tim',
'button.export' => 'Izvezi tim',
'button.import' => 'Uvezi tim',
'button.close' => 'Zatvori',
'button.stop' => 'Stani',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Naziv tim-a',
'label.address' => 'Adresa',
'label.currency' => 'Valuta',
'label.manager_name' => 'Ime Menadžera',
'label.manager_login' => 'Menadžer prijava',
'label.person_name' => 'Ime',
'label.thing_name' => 'Naziv',
'label.login' => 'Prijava',
'label.password' => 'Lozinka',
'label.confirm_password' => 'Potvrdi lozinku',
'label.email' => 'Email',
'label.date' => 'Datum',
'label.start_date' => 'Početni datum',
'label.end_date' => 'Krajnji datum',
'label.user' => 'Korisnik',
'label.users' => 'Korisnici',
'label.client' => 'Klijent',
'label.clients' => 'Klijenti',
'label.option' => 'Opcije',
'label.invoice' => 'Račun',
'label.project' => 'Projekat',
'label.projects' => 'Projekti',
'label.task' => 'Zadatak',
'label.tasks' => 'Zadaci',
'label.description' => 'Opis',
'label.start' => 'Početak',
'label.finish' => 'Završetak',
'label.duration' => 'Trajanje',
'label.note' => 'Napomena',
'label.item' => 'Stavka',
'label.cost' => 'Cena',
'label.day_total' => 'Zbir časova dnevno',
'label.week_total' => 'Zbir časova nedeljno',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Danas',
'label.total_hours' => 'Ukupno časova',
'label.total_cost' => 'Ukupna cena',
'label.view' => 'Pregledaj',
'label.edit' => 'Izmeni',
'label.delete' => 'Obriši',
'label.configure' => 'Podesi',
'label.select_all' => 'Odaberi sve',
'label.select_none' => 'Poništi sve',
'label.id' => 'ID',
'label.language' => 'Jezik',
'label.decimal_mark' => 'Decimala',
'label.date_format' => 'Format datuma',
'label.time_format' => 'Format vremena',
'label.week_start' => 'Prvi dan u nedelji',
'label.comment' => 'Komentar',
'label.status' => 'Status',
'label.tax' => 'Porez',
'label.subtotal' => 'Međuzbir',
'label.total' => 'Ukupno',
'label.client_name' => 'Ime klijenta',
'label.client_address' => 'Adresa klijenta',
'label.or' => 'ili',
'label.error' => 'Greška',
'label.ldap_hint' => 'Unesi tvoju <b>Windows prijavu</b> i <b>lozinku</b> u polje ispod.',
'label.required_fields' => '* - obavezna polja',
'label.on_behalf' => 'ispred',
'label.role_manager' => '(menadžer)',
'label.role_comanager' => '(saradnik)',
'label.role_admin' => '(administrator)',
'label.page' => 'Strana',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Dodatna polja',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'Tipovi',
'label.type_dropdown' => 'odaberi',
'label.type_text' => 'text',
'label.required' => 'Obavezan',
'label.fav_report' => 'Omiljeni izveštaji',
'label.cron_schedule' => 'Sredi raspored',
'label.what_is_it' => 'Šta je ovo?',

// Form titles.
'title.login' => 'Prijava',
'title.teams' => 'Timovi',
'title.create_team' => 'Napravi tim',
'title.edit_team' => 'Izmeni tim',
'title.delete_team' => 'Obriši tim',
'title.reset_password' => 'Resetuj Lozinku',
'title.change_password' => 'Promeni Lozinku',
'title.time' => 'Vreme',
'title.edit_time_record' => 'Izmeni unos vremena',
'title.delete_time_record' => 'Obriši unos vremena',
'title.expenses' => 'Troškovi',
'title.edit_expense' => 'Izmeni stavke troškova',
'title.delete_expense' => 'Obriši stavke troškova',
'title.reports' => 'Izveštaji',
'title.report' => 'Izveštaj',
'title.send_report' => 'Slanje izveštaja',
'title.invoice' => 'Račun',
'title.send_invoice' => 'Slanje računa',
'title.charts' => 'Grafikoni',
'title.projects' => 'Projekti',
'title.add_project' => 'Dodavanje projekta',
'title.edit_project' => 'Izmena projekta',
'title.delete_project' => 'Brisanje projekta',
'title.tasks' => 'Zadaci',
'title.add_task' => 'Dodavanje zadatka',
'title.edit_task' => 'Izmena zadatka',
'title.delete_task' => 'Brisanje zadatka',
'title.users' => 'Korisnik',
'title.add_user' => 'Dodavanje korisnika',
'title.edit_user' => 'Izmena korisnika',
'title.delete_user' => 'Brisanje korisnika',
'title.clients' => 'Klijenti',
'title.add_client' => 'Dodavanje klijenta',
'title.edit_client' => 'Izmena klijenta',
'title.delete_client' => 'Brisanje klijenta',
'title.invoices' => 'Računi',
'title.add_invoice' => 'Dodavanje računa',
'title.view_invoice' => 'Pregled računa',
'title.delete_invoice' => 'Brisanje računa',
'title.notifications' => 'Napomene',
'title.add_notification' => 'Dodavanje napomene',
'title.edit_notification' => 'Izmena napomene',
'title.delete_notification' => 'Brisanje napomene',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Izvoz podataka tim-a',
'title.import' => 'Uvoz podataka tim-a',
'title.options' => 'Opcije',
'title.profile' => 'Profil',
'title.cf_custom_fields' => 'Dodatna polja',
'title.cf_add_custom_field' => 'Dodavanje dodatnih polja',
'title.cf_edit_custom_field' => 'Izmena dodatnih polja',
'title.cf_delete_custom_field' => 'Brisanje dodatnih polja',
'title.cf_dropdown_options' => 'Ocije mogućnosti odabira',
'title.cf_add_dropdown_option' => 'Dodavanje opcija',
'title.cf_edit_dropdown_option' => 'Izmena opcija',
'title.cf_delete_dropdown_option' => 'Brisanje opcija',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// TODO: Translate the following:
// 'title.locking' => 'Locking',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- svi ---',
'dropdown.no' => '--- ništa ---',
'dropdown.this_day' => 'ovaj dan',
'dropdown.this_week' => 'ova nedelja',
'dropdown.last_week' => 'prošla nedelja',
'dropdown.this_month' => 'ovaj mesec',
'dropdown.last_month' => 'prošli mesec',
'dropdown.this_year' => 'ova godina',
'dropdown.all_time' => 'svi datumi',
'dropdown.projects' => 'projekti',
'dropdown.tasks' => 'zadaci',
'dropdown.clients' => 'klijenti',
'dropdown.select' => '--- odaberi ---',
'dropdown.select_invoice' => '--- odaberi račun ---',
'dropdown.status_active' => 'aktivan',
'dropdown.status_inactive' => 'neaktivan',
'dropdown.delete'=>'obriši',
'dropdown.do_not_delete'=>'nemoj obrisati',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Forma prijave. Pogledajte primer na https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Zaboravili ste lozinku?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> je jednostavan i lak za korišćenje za praćenje radnog vremena.',

// Izmena forme za lozinku. Pogledajte primer na https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Zahtev za izmenu lozinke je poslat mejlom.',
'form.reset_password.email_subject' => 'Anuko Time Tracker zahtev za izmenu lozinke',
'form.reset_password.email_body' => "Poštovani korisniče,\n\nneko, najverovatnije vi, ste poslali zahtev za izmenu lozinke na Anuko Time Tracker nalogu. Molimo da pratite link ako želite da izmenite lozinku.\n\n%s\n\nAnuko Time Tracker je jednostavan i lak za korišćenje za praćenje radnog vremena. Posetite nas na https://www.anuko.com za više informacija.\n\n",

// Forma za izmenu lozinke. Pogledajte primer na https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Unesite novu lozinku i sačuvajte isti.',

// Forma vremena. Pogledajte primer na https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Naplativ',
'form.time.uncompleted' => 'Nezavršen',
// TODO: translate the folllowing.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Izmena vremenske forme. Pogledajte primer na https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Ovaj zapis je sačuvan sa početnim vremenom i nije greška.',

// Forma izveštaja. Pogledajte primer na https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Sačuvaj u omiljenima',
'form.reports.confirm_delete' => 'Da li ste sigurni da želite obrisati omiljene izveštaje?',
'form.reports.include_records' => 'Uključi zapise',
'form.reports.include_billable' => 'naplativo',
'form.reports.include_not_billable' => 'ne naplativo',
'form.reports.include_invoiced' => 'obračunato',
'form.reports.include_not_invoiced' => 'nije obračunato',
'form.reports.select_period' => 'Odaberi vremenski raspon',
'form.reports.set_period' => 'ili podesi datum',
'form.reports.show_fields' => 'Prikaži polja u izveštaju',
'form.reports.group_by' => 'Grupiši po',
'form.reports.group_by_no' => '--- nemoj grupisati ---',
'form.reports.group_by_date' => 'datum',
'form.reports.group_by_user' => 'korisnik',
'form.reports.group_by_client' => 'klijent',
'form.reports.group_by_project' => 'projekat',
'form.reports.group_by_task' => 'zadatak',
'form.reports.totals_only' => 'Samo zbirno',

// Forma izveštaja. Pogledajte primer na https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Izvoz',

// Forma izveštaja. Pogledajte primer na https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Broj računa',
'form.invoice.person' => 'Osoba',
'form.invoice.invoice_to_delete' => 'Račun za brisanje',
'form.invoice.invoice_entries' => 'Unos u račun',

// Forma grafikona. Pogledajte primer na https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Intervali',
'form.charts.chart' => 'Grafikon',

// Forma projekata. Pogledajte primer na https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktivni projekti',
'form.projects.inactive_projects' => 'Neaktivni projekti',

// Forma zadataka. Pogledajte primer na https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktivni zadaci',
'form.tasks.inactive_tasks' => 'Neaktivni zadaci',

// Korisnička forma. Pogledajte primer na https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktivni korisnik',
'form.users.inactive_users' => 'Neaktivni korisnik',
'form.users.role' => 'Funkcija',
'form.users.manager' => 'Menadžer',
'form.users.comanager' => 'Saradnik',
'form.users.rate' => 'Cena',
'form.users.default_rate' => 'Podrazumevana cena sati',

// Forma brisanja klijenta. Pogledajte primer na  https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Klijent za brisanje',
'form.client.client_entries' => 'Unos klijenta',

// Forma klijenata. Pogledajte primer na https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktivni klijent',
'form.clients.inactive_clients' => 'Neaktivni klijent',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Postoji mogućnost izvoza svih podataka od timova u xml fajlu. Može vam biti korisno ako imate internu bazu podataka.',
'form.export.compression' => 'Kompresija',
'form.export.compression_none' => 'ništa',
'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Uvezi podatke timova iz xml fajla.',
'form.import.file' => 'Odaberi datoteku',
'form.import.success' => 'Uvoz uspešan.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' =>  'Napravite novi tim. Počnite sa otvaranjem naloga za Menadžera.<br>Takođe možete uvoziti podatke iz xml fajla sa drugog Anuko Time Tracker server-a (dupliranje prijava nisu dozvoljeni).',

// Forma profila. Pogledajte primer na at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12 časova',
'form.profile.24_hours' => '24 časova',
'form.profile.tracking_mode' => 'Način evidencije',
'form.profile.mode_time' => 'vreme',
'form.profile.mode_projects' => 'projekti',
'form.profile.mode_projects_and_tasks' => 'projekti i zadaci',
'form.profile.record_type' => 'Način čuvanja',
'form.profile.type_all' => 'sve',
'form.profile.type_start_finish' => 'početak i kraj',
'form.profile.type_duration' => 'trajanje',
'form.profile.plugins' => 'Dodaci',

// Forma mejla. Pogledajte primer na https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Od',
'form.mail.to' => 'Za',
'form.mail.cc' => 'Cc',
'form.mail.subject' => 'Naslov',
'form.mail.report_subject' => 'Evidencija vremena',
'form.mail.footer' => 'Anuko Time Tracker je jednostavan i lak za korišćenje za praćenje <br>radnog vremena. Posetite <a href="https://www.anuko.com">www.anuko.com</a> za više informacija.',
'form.mail.report_sent' => 'Izveštaj poslat.',
'form.mail.invoice_sent' => 'Račun poslat.',

// Quotas configuration form.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',
);
