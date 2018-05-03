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

$i18n_language = 'Polish (Polski)';
$i18n_months = array('Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
$i18n_weekdays = array('Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota');
$i18n_weekdays_short = array('Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob');
// format mm/dd
$i18n_holidays = array('01/01', '01/05', '04/05', '04/06', '05/01', '05/03', '05/24', '06/04', '08/15', '11/01', '11/11', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Zaloguj',
'menu.logout' => 'Wyloguj',
'menu.forum' => 'Forum',
'menu.help' => 'Pomoc',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'Czas',
'menu.expenses' => 'Wydatki',
'menu.reports' => 'Raporty',
'menu.charts' => 'Statystyki', // TODO: is this correct translation for Charts?
'menu.projects' => 'Projekty',
'menu.tasks' => 'Zadania',
'menu.users' => 'Użytkownicy',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
'menu.export' => 'Eksport',
'menu.clients' => 'Klienci',
'menu.options' => 'Opcje',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'Twórcy',
'footer.license' => 'Licencja',
// TODO: translate the following.
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
'error.access_denied' => 'Odmowa dostępu.',
'error.sys' => 'Błąd systemu.',
'error.db' => 'Błąd bazy danych.',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Niepoprawne dane: "{0}".',
'error.empty' => 'Pole "{0}" jest puste.',
'error.not_equal' => 'Wartość z pola "{0}" jest inna niż wartość z pola "{1}".',
'error.interval' => 'Wartość z pola "{0}" musi być większe niż wartość z pola "{1}".',
'error.project' => 'Wybierz projekt.',
'error.task' => 'Wybierz zadanie.',
'error.client' => 'Wybierz klienta.',
'error.report' => 'Wybierz raport.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Błędny login lub hasło.',
'error.user_exists' => 'Użytkownik o takiej nazwie już istnieje.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'Projekt o takiej nazwie już istnieje.',
'error.task_exists' => 'Zadanie o takiej nazwie już istnieje.',
'error.client_exists' => 'Klient o takiej nazwie już istnieje.',
'error.invoice_exists' => 'Faktura o tym numerze już istnieje.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Brak przedmiotów do faktury.',
'error.no_login' => 'Użytkownik o takiej nazwie nie istnieje.',
'error.no_groups' => 'Twoja baza danych jest pusta. Zaloguj się jako administrator i stwórz nowy zespół.', // TODO: replace "team" with "group".
'error.upload' => 'Błąd podczas wysyłania pliku.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Błąd podczas wysyłania wiadomości e-mail.',
'error.no_email' => 'Żaden adres e-mail nie jest skojarzony z tym loginem.',
'error.uncompleted_exists' => 'Istnieje niedokończony wpis. Zamknij go lub usuń.',
'error.goto_uncompleted' => 'Przejdź do niedokończonego wpisu.',
'error.overlap' => 'Okres czasowy nakłada się z istniejącymi wpisami.',
'error.future_date' => 'Data jest w przyszłości.',

// Labels for buttons
'button.login' => 'Login',
'button.now' => 'Teraz',
'button.save' => 'Zapisz',
'button.copy' => 'Kopiuj',
'button.cancel' => 'Anuluj',
'button.submit' => 'Zatwierdź',
'button.add' => 'Dodaj',
'button.delete' => 'Usuń',
'button.generate' => 'Wygeneruj',
'button.reset_password' => 'Resetuj hasło',
'button.send' => 'Wyślij',
'button.send_by_email' => 'Wyślij e-mail',
'button.create_group' => 'Stwórz zespół', // TODO: replace "team" with "group".
'button.export' => 'Eksportuj zespół', // TODO: replace "team" with "group".
'button.import' => 'Importuj zespół', // TODO: replace "team" with "group".
'button.close' => 'Zamknij',
'button.stop' => 'Zatrzymaj',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Nazwa zespołu',  // TODO: replace "team" with "group".
'label.address' => 'Adres',
'label.currency' => 'Waluta',
'label.manager_name' => 'Nazwa managera',
'label.manager_login' => 'Login managera',
'label.person_name' => 'Nazwa',
'label.thing_name' => 'Nazwa',
'label.login' => 'Login',
'label.password' => 'Hasło',
'label.confirm_password' => 'Potwierdź hasło',
'label.email' => 'E-mail',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Temat',
'label.date' => 'Data',
'label.start_date' => 'Data początkowa',
'label.end_date' => 'Data końcowa',
'label.user' => 'Użytkownik',
'label.users' => 'Użytkownicy',
// TODO: translate the following.
// 'label.roles' => 'Roles',
'label.client' => 'Klient',
'label.clients' => 'Klienci',
'label.option' => 'Opcja',
'label.invoice' => 'Faktura',
'label.project' => 'Projekt',
'label.projects' => 'Projekty',
'label.task' => 'Zadanie',
'label.tasks' => 'Zadania',
'label.description' => 'Opis',
'label.start' => 'Początek',
'label.finish' => 'Koniec',
'label.duration' => 'Czas trwania',
'label.note' => 'Uwagi',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Pozycja',
'label.cost' => 'Koszt',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Dziś',
'label.week_total' => 'W tym tygodniu',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Dziś',
'label.view' => 'Widok',
'label.edit' => 'Edycja',
'label.delete' => 'Usuń',
'label.configure' => 'Konfiguruj',
'label.select_all' => 'Zaznacz wszystko',
'label.select_none' => 'Odznacz wszystko',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Język',
'label.decimal_mark' => 'Znak dziesiętny',
'label.date_format' => 'Format daty',
'label.time_format' => 'Format godziny',
'label.week_start' => 'Początek tygodnia',
'label.comment' => 'Komentarz',
'label.status' => 'Status',
'label.tax' => 'Podatek',
'label.subtotal' => 'Suma netto',
'label.total' => 'Suma',
'label.client_name' => 'Nazwa klienta',
'label.client_address' => 'Adres klienta',
'label.or' => 'lub',
'label.error' => 'Błąd',
'label.ldap_hint' => 'Wpisz swoją <b> nazwę użytkownika Windows<b> i <b>hasło<b> w polach poniżej.',
'label.required_fields' => '* - pola wymagane',
'label.on_behalf' => 'w imieniu',
'label.role_manager' => '(Manager)',
'label.role_comanager' => '(Co-manager)',
'label.role_admin' => '(Administrator)',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Niestandardowe pola',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'Rodzaj',
'label.type_dropdown' => 'lista rozwijana',
'label.type_text' => 'tekst',
'label.required' => 'Wymagane',
'label.fav_report' => 'Ulubiony raport',
'label.schedule' => 'Harmonogram',
'label.what_is_it' => 'Co to jest?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Logowanie',
'title.groups' => 'Zespoły', // TODO: change "teams" to "groups".
'title.create_group' => 'Zakładanie zespołu', // TODO: change "team" to "group".
'title.edit_group' => 'Edytowanie zespołu', // TODO: change "team" to "group".
'title.delete_group' => 'Usuwanie zespołu', // TODO: change "team" to "group".
'title.reset_password' => 'Resetowanie hasła',
'title.change_password' => 'Zmiana hasła',
'title.time' => 'Wybrana data',
'title.edit_time_record' => 'Edytowanie wpisu',
'title.delete_time_record' => 'Usuwanie wpisu',
'title.expenses' => 'Wydatki',
'title.edit_expense' => 'Edytowanie wpisu',
'title.delete_expense' => 'Usuwanie wpisu',
'title.reports' => 'Raporty',
'title.report' => 'Raport',
'title.send_report' => 'Wysyłanie raportu',
'title.invoice' => 'Faktura',
'title.send_invoice' => 'Wysyłanie faktury',
'title.charts' => 'Statystyki',
'title.projects' => 'Projekty',
'title.add_project' => 'dodawanie projektu',
'title.edit_project' => 'Edytowanie projektu',
'title.delete_project' => 'Usuwanie projektu',
'title.tasks' => 'Zadania',
'title.add_task' => 'Dodawanie zadania',
'title.edit_task' => 'Edytowanie zadania',
'title.delete_task' => 'Usuwanie zadania',
'title.users' => 'Użytkownicy',
'title.add_user' => 'Dodawanie użytkownika',
'title.edit_user' => 'Edytowanie użytkownika',
'title.delete_user' => 'Usuwanie użytkownika',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Klienci',
'title.add_client' => 'Dodawanie klienta',
'title.edit_client' => 'Edytowanie klienta',
'title.delete_client' => 'Usuwanie klienta',
'title.invoices' => 'Faktury',
'title.add_invoice' => 'Dodawanie faktury',
'title.view_invoice' => 'Podgląd faktury',
'title.delete_invoice' => 'Usuwanie faktury',
'title.notifications' => 'Powiadomienia',
'title.add_notification' => 'Dodawanie powiadomienia',
'title.edit_notification' => 'Edytowanie powiadomienia',
'title.delete_notification' => 'Usuwanie powiadomienia',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Eksport danych zespołu', // TODO: replace "team" with "group".
'title.import' => 'Import danych zespołu', // TODO: replace "team" with "group".
'title.options' => 'Opcje',
'title.profile' => 'Profil',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Pola niestandardowe',
'title.cf_add_custom_field' => 'Dodawanie pola niestandardowego',
'title.cf_edit_custom_field' => 'Edytowanie pola niestandardowego',
'title.cf_delete_custom_field' => 'Usuwanie pola niestandardowego',
'title.cf_dropdown_options' => 'Opcje listy rozwijanej',
'title.cf_add_dropdown_option' => 'Dodawanie opcji',
'title.cf_edit_dropdown_option' => 'Edytowanie opcji',
'title.cf_delete_dropdown_option' => 'Usuwanie opcji',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// TODO: translate the following.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- wszystkie ---',
'dropdown.no' => '--- żaden ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'dzień',
'dropdown.current_week' => 'ten tydzień',
'dropdown.previous_week' => 'poprzedni tydzień',
'dropdown.selected_week' => 'tydzień',
'dropdown.current_month' => 'ten miesiąc',
'dropdown.previous_month' => 'poprzedni miesiąc',
'dropdown.selected_month' => 'miesiąc',
'dropdown.current_year' => 'ten rok',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'rok',
'dropdown.all_time' => 'od początku',
'dropdown.projects' => 'projekty',
'dropdown.tasks' => 'zadania',
'dropdown.clients' => 'klienci',
'dropdown.select' => '--- wybierz ---',
'dropdown.select_invoice' => '--- wybierz fakturę ---',
'dropdown.status_active' => 'aktywny',
'dropdown.status_inactive' => 'nieaktywny',
'dropdown.delete' => 'usuń',
'dropdown.do_not_delete' => 'nie usuwaj',
// TODO: translate the following.
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Nie pamiętasz hasła?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> jest prostym, łatwym w użyciu, otwartoźródłowym systemem śledzenia czasu.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Instrukcje zmiany hasła zostały wysłane na adres e-mail połączony z kontem.',
'form.reset_password.email_subject' => 'Anuko Time Tracker - żądanie zmiany hasła',
// TODO: English string has changed. "from IP" added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Drogi Użytkowniku,\n\nktoś, IP %s, poprosił o zmianę hasła w aplikacji Anuko Time Tracker. Aby ustawić nowe hasło, proszę kliknąć na poniższy link lub go skopiować i otworzyć w oknie przeglądarki WWW.\n\n%s\n\nJeśli to nie Ty poprosiłeś o zmianę hasła, zignoruj tą wiadomość.\n\nAnuko Time Tracker jest prostym, łatwym w użyciu, otwartoźródłowym systemem do śledzenia czasu. Odwiedź https://www.anuko.com aby uzyskać więcej informacji.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Wpisz nowe hasło i kliknij Zapisz.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Płatne dla klienta',
'form.time.uncompleted' => 'Nieukończone',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Ten wpis ma określony jedynie czas rozpoczęcia. To nie jest błąd.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Zapisz jako ulubiony',
'form.reports.confirm_delete' => 'Czy na pewno chcesz usunąć ten ulubiony raport?',
'form.reports.include_billable' => 'płatne',
'form.reports.include_not_billable' => 'bezpłatne',
'form.reports.include_invoiced' => 'fakturowane',
'form.reports.include_not_invoiced' => 'nie fakturowane',
'form.reports.select_period' => 'Wybierz okres',
'form.reports.set_period' => 'lub ustaw daty',
'form.reports.show_fields' => 'Pokaż pola',
'form.reports.group_by' => 'Grupowanie wg',
'form.reports.group_by_no' => '--- bez grupowania ---',
'form.reports.group_by_date' => 'daty',
'form.reports.group_by_user' => 'użytkowników',
'form.reports.group_by_client' => 'klientów',
'form.reports.group_by_project' => 'projektów',
'form.reports.group_by_task' => 'zadań',
'form.reports.totals_only' => 'Tylko sumy',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Eksport',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Numer faktury',
'form.invoice.person' => 'Osoba',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Faktura do usunięcia',
'form.invoice.invoice_entries' => 'Wpisy dot. faktury',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.phpp
'form.charts.interval' => 'Okres',
'form.charts.chart' => 'Wykres',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktywne projekty',
'form.projects.inactive_projects' => 'Nieaktywne projekty',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktywne zadania',
'form.tasks.inactive_tasks' => 'Nieaktywne zadania',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktywni użytkownicy',
'form.users.inactive_users' => 'Nieaktywni użytkownicy',
 // TODO: translate the following.
 // 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Rola',
'form.users.manager' => 'Manager',
'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Stawka',
'form.users.default_rate' => 'Domyślna stawka godzinowa',

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

// Clients form. See example at https://timetracker.anuko.com/clients.phpp
'form.clients.active_clients' => 'Aktywni klienci',
'form.clients.inactive_clients' => 'Nieaktywni klienci',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php.
'form.client.client_to_delete' => 'Klient do usunięcia',
'form.client.client_entries' => 'Wpisy dot. klienta',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Możesz wyeksportować wszystkie dane zespołu do pliku xml. Przydatne przy migracji danych na własny serwer.',
'form.export.compression' => 'Kompresja',
'form.export.compression_none' => 'brak',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Import danych zespołu z pliku xml.', // TODO: replace "team" with "group".
'form.import.file' => 'Wybierz plik',
'form.import.success' => 'Import zakończony powodzeniem.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Załóż nowy zespół najpierw tworząc konto managera.<br>Możesz także zaimportować plik xml z danymi zespołu z innego serwera Anuko Time Tracker (nazwy loginów nie mogą się powtarzać).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 godzin',
'form.group_edit.24_hours' => '24 godziny',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
'form.group_edit.tracking_mode' => 'Tryb śledzenia',
'form.group_edit.mode_time' => 'czas',
'form.group_edit.mode_projects' => 'projekty',
'form.group_edit.mode_projects_and_tasks' => 'projekty i zadania',
'form.group_edit.record_type' => 'Rejestrowanie czasu',
'form.group_edit.type_all' => 'wszystko',
'form.group_edit.type_start_finish' => 'początek i koniec',
'form.group_edit.type_duration' => 'czas trwania',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Dodatkowe moduły',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Od',
'form.mail.to' => 'Do',
'form.mail.report_subject' => 'Raport Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker jest prostym, łatwym w użyciu, otwartoźródłowym<br>systemem śledzenia czasu. Odwiedź <a href="https://www.anuko.com">www.anuko.com</a>, aby uzyskać więcej informacji.',
'form.mail.report_sent' => 'Wysłano raport',
'form.mail.invoice_sent' => 'Wysłano fakturę',

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
