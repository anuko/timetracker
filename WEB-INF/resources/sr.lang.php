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

$i18n_language = 'Serbian (Srpski)';
$i18n_months = array('Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar');
$i18n_weekdays = array('Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Četvrtak', 'Petak', 'Subota');
$i18n_weekdays_short = array('Ne', 'Po', 'Ut', 'Sr', 'Če', 'Pe', 'Su');
// format dd/mm
$i18n_holidays = array('01/01', '02/01', '07/01', '15/01', '16/02', '29/04', '30/04', '01/05', '02/05', '03/05', '22/04', '09/05', '28/06', '21/10', '11/11');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Prijava',
'menu.logout' => 'Odjava',
'menu.forum' => 'Forum',
'menu.help' => 'Pomoć',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'Vreme',
'menu.expenses' => 'Troškovi',
'menu.reports' => 'Izveštaji',
'menu.charts' => 'Grafikoni',
'menu.projects' => 'Projekti',
'menu.tasks' => 'Zadaci',
'menu.users' => 'Korisnici',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
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
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Pogrešan "{0}" podatak.',
'error.empty' => 'Polje "{0}" je prazno.',
'error.not_equal' => 'Polje "{0}" nije jednak polju "{1}".',
'error.interval' => 'Polje "{0}" mora biti viši od "{1}".',
'error.project' => 'Odaberi projekat.',
'error.task' => 'Odaberi zadatak.',
'error.client' => 'Odaberi klijenta.',
'error.report' => 'Odaberi izveštaj.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Pogrešno korisničko ime ili lozinka.',
'error.user_exists' => 'Korisnik pod ovim imenom već postoji.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Projekat pod ovim nazivom već postoji.',
'error.task_exists' => 'Zadatak pod ovim nazivom već postoji.',
'error.client_exists' => 'Klijent pod ovim imenom već postoji.',
'error.invoice_exists' => 'Račun pod ovim brojem već postoji.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Nema stavke za naplatu.',
'error.no_login' => 'Nema korisnika pod ovom prijavom',
'error.no_groups' => 'Vaša baza podataka je prazna. Prijavite se kao administrator i napravite novi tim.', // TODO: replace "team" with "group".
'error.upload' => 'Greška pri otpremanju podatka.',
// TODO: translate the following.
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
'button.add' => 'Dodaj',
'button.delete' => 'Obriši',
'button.generate' => 'Napravi',
'button.reset_password' => 'Resetuj lozinku',
'button.send' => 'Pošalji',
'button.send_by_email' => 'Pošalji mejlom',
'button.create_group' => 'Napravi tim', // TODO: replace "team" with "group".
'button.export' => 'Izvezi tim', // TODO: replace "team" with "group".
'button.import' => 'Uvezi tim', // TODO: replace "team" with "group".
'button.close' => 'Zatvori',
'button.stop' => 'Stani',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Naziv tim-a', // TODO: replace "team" with "group".
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
'label.cc' => 'Cc',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Naslov',
'label.date' => 'Datum',
'label.start_date' => 'Početni datum',
'label.end_date' => 'Krajnji datum',
'label.user' => 'Korisnik',
'label.users' => 'Korisnici',
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Stavka',
'label.cost' => 'Cena',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Zbir časova dnevno',
'label.week_total' => 'Zbir časova nedeljno',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Danas',
'label.view' => 'Pregledaj',
'label.edit' => 'Izmeni',
'label.delete' => 'Obriši',
'label.configure' => 'Podesi',
'label.select_all' => 'Odaberi sve',
'label.select_none' => 'Poništi sve',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
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
// TODO: translate the following.
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Dodatna polja',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'Tipovi',
'label.type_dropdown' => 'odaberi',
'label.type_text' => 'text',
'label.required' => 'Obavezan',
'label.fav_report' => 'Omiljeni izveštaji',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
'label.what_is_it' => 'Šta je ovo?',
// TODO: Translate the following.
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'button.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Prijava',
'title.groups' => 'Timovi', // TODO: change "teams" to "groups".
'title.create_group' => 'Napravi tim', // TODO: change "team" to "group".
'title.edit_group' => 'Izmeni tim', // TODO: change "team" to "group".
'title.delete_group' => 'Obriši tim', // TODO: change "team" to "group".
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
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
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
'title.export' => 'Izvoz podataka tim-a', // TODO: replace "team" with "group".
'title.import' => 'Uvoz podataka tim-a', // TODO: replace "team" with "group".
'title.options' => 'Opcije',
'title.profile' => 'Profil',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Dodatna polja',
'title.cf_add_custom_field' => 'Dodavanje dodatnih polja',
'title.cf_edit_custom_field' => 'Izmena dodatnih polja',
'title.cf_delete_custom_field' => 'Brisanje dodatnih polja',
'title.cf_dropdown_options' => 'Ocije mogućnosti odabira',
'title.cf_add_dropdown_option' => 'Dodavanje opcija',
'title.cf_edit_dropdown_option' => 'Izmena opcija',
'title.cf_delete_dropdown_option' => 'Brisanje opcija',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// TODO: translate the following.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- svi ---',
'dropdown.no' => '--- ništa ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'dan',
'dropdown.current_week' => 'ova nedelja',
'dropdown.previous_week' => 'prošla nedelja',
'dropdown.selected_week' => 'nedelja',
'dropdown.current_month' => 'ovaj mesec',
'dropdown.previous_month' => 'prošli mesec',
'dropdown.selected_month' => 'mesec',
'dropdown.current_year' => 'ova godina',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'godina',
'dropdown.all_time' => 'svi datumi',
'dropdown.projects' => 'projekti',
'dropdown.tasks' => 'zadaci',
'dropdown.clients' => 'klijenti',
'dropdown.select' => '--- odaberi ---',
'dropdown.select_invoice' => '--- odaberi račun ---',
'dropdown.status_active' => 'aktivan',
'dropdown.status_inactive' => 'neaktivan',
'dropdown.delete' => 'obriši',
'dropdown.do_not_delete' => 'nemoj obrisati',
// TODO: translate the following.
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Forma prijave. Pogledajte primer na https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Zaboravili ste lozinku?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> je jednostavan i lak za korišćenje za praćenje radnog vremena.',

// Izmena forme za lozinku. Pogledajte primer na https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Zahtev za izmenu lozinke je poslat mejlom.',
'form.reset_password.email_subject' => 'Anuko Time Tracker zahtev za izmenu lozinke',
// TODO: English string has changed. "from IP" added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Poštovani korisniče,\n\nneko, IP %s, ste poslali zahtev za izmenu lozinke na Anuko Time Tracker nalogu. Molimo da pratite link ako želite da izmenite lozinku.\n\n%s\n\nAnuko Time Tracker je jednostavan i lak za korišćenje za praćenje radnog vremena. Posetite nas na https://www.anuko.com za više informacija.\n\n",

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

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Forma izveštaja. Pogledajte primer na https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Sačuvaj u omiljenima',
'form.reports.confirm_delete' => 'Da li ste sigurni da želite obrisati omiljene izveštaje?',
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
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Forma izveštaja. Pogledajte primer na https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Broj računa',
'form.invoice.person' => 'Osoba',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Račun za brisanje',
'form.invoice.invoice_entries' => 'Unos u račun',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

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
// TODO: translate the following.
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Funkcija',
'form.users.manager' => 'Menadžer',
'form.users.comanager' => 'Saradnik',
'form.users.rate' => 'Cena',
'form.users.default_rate' => 'Podrazumevana cena sati',

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

// Forma klijenata. Pogledajte primer na https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktivni klijent',
'form.clients.inactive_clients' => 'Neaktivni klijent',

// Forma brisanja klijenta. Pogledajte primer na  https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Klijent za brisanje',
'form.client.client_entries' => 'Unos klijenta',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Postoji mogućnost izvoza svih podataka od timova u xml fajlu. Može vam biti korisno ako imate internu bazu podataka.',
'form.export.compression' => 'Kompresija',
'form.export.compression_none' => 'ništa',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Uvezi podatke timova iz xml fajla.', // TODO: replace "team" with "group".
'form.import.file' => 'Odaberi datoteku',
'form.import.success' => 'Uvoz uspešan.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Napravite novi tim. Počnite sa otvaranjem naloga za Menadžera.<br>Takođe možete uvoziti podatke iz xml fajla sa drugog Anuko Time Tracker server-a (dupliranje prijava nisu dozvoljeni).',

// Forma profila. Pogledajte primer na at https://timetracker.anuko.com/profile_edit.php.
'form.group_edit.12_hours' => '12 časova',
'form.group_edit.24_hours' => '24 časova',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
'form.group_edit.tracking_mode' => 'Način evidencije',
'form.group_edit.mode_time' => 'vreme',
'form.group_edit.mode_projects' => 'projekti',
'form.group_edit.mode_projects_and_tasks' => 'projekti i zadaci',
'form.group_edit.record_type' => 'Način čuvanja',
'form.group_edit.type_all' => 'sve',
'form.group_edit.type_start_finish' => 'početak i kraj',
'form.group_edit.type_duration' => 'trajanje',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Dodaci',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Forma mejla. Pogledajte primer na https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Od',
'form.mail.to' => 'Za',
'form.mail.report_subject' => 'Evidencija vremena',
'form.mail.footer' => 'Anuko Time Tracker je jednostavan i lak za korišćenje za praćenje <br>radnog vremena. Posetite <a href="https://www.anuko.com">www.anuko.com</a> za više informacija.',
'form.mail.report_sent' => 'Izveštaj poslat.',
'form.mail.invoice_sent' => 'Račun poslat.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

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
