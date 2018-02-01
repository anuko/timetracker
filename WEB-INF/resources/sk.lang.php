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

$i18n_language = 'Slovenčina';
$i18n_months = array('Január', 'Február', 'Marec', 'Apríl', 'Máj', 'Jún', 'Júl', 'August', 'September', 'Október', 'November', 'December');
$i18n_weekdays = array('Nedeľa', 'Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota');
$i18n_weekdays_short = array('Ne', 'Po', 'Ut', 'St', 'Št', 'Pi', 'So');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '03/29', '04/01', '05/01', '05/08', '06/05', '08/29', '09/01', '09/15', '11/01', '11/17', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Príhlásenie',
'menu.logout' => 'Odhlásenie',
'menu.forum' => 'Fórum',
'menu.help' => 'Pomoc',
'menu.create_team' => 'Vytvoriť tím',
'menu.profile' => 'Profil',
'menu.time' => 'Časový záznam',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Zostavy',
'menu.charts' => 'Grafy',
'menu.projects' => 'Projekty',
'menu.tasks' => 'Úlohy',
'menu.users' => 'Používatelia',
'menu.teams' => 'Tímy',
'menu.export' => 'Export',
'menu.clients' => 'Klienti',
'menu.options' => 'Nastavenia',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'Vývojový tím',
'footer.license' => 'Licencia',
// TODO: translate the following.
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
'error.sys' => 'Systémová chyba.',
'error.db' => 'Databázová chyba.',
'error.field' => 'Nesprávne "{0}" údaje.',
'error.empty' => 'Pole "{0}" je prázdne.',
'error.not_equal' => 'Pole "{0}" nie je zhodné s poľom "{1}".',
'error.interval' => 'Hodnota v poli "{0}" musí byť väčšia než "{1}".',
'error.project' => 'Vyberte projekt.',
'error.task' => 'Vyberte úlohy.',
'error.client' => 'Vyberte klienta.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Nesprávne prihlasovacie meno alebo heslo.',
'error.user_exists' => 'Používateľ s týmto prihlasovacím menom už existuje.',
'error.project_exists' => 'Projekt s týmto názvom už existuje.',
'error.task_exists' => 'Úloha s týmto názvom už existuje.',
'error.client_exists' => 'Klient s týmto menom už existuje.',
'error.invoice_exists' => 'Faktúra s týmto číslom už existuje.',
'error.no_invoiceable_items' => 'Neexistujú položky, ktoré by bolo možné fakturovať.',
'error.no_login' => 'Neexistuje používateľ s týmto prihlasovacím menom.',
'error.no_teams' => 'Vaša databáza je prázdna. Prihláste sa ako admin a vytvorte nový tím.',
'error.upload' => 'Prenos súboru bol neúspešný.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'Chyba v odosielaní e-mailu.',
'error.no_email' => 'K tomuto prihlasovaciemu menu nie je priradený žiadny e-mail.',
'error.uncompleted_exists' => 'Nekompletný záznam už existuje. Zatvorte ho alebo ho vymažte.',
'error.goto_uncompleted' => 'Ísť na nekompletný záznam.',
// TODO: translate the following.
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Prihlásiť',
'button.now' => 'Teraz',
'button.save' => 'Uložiť',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Zrušiť',
'button.submit' => 'Odoslať',
'button.add_user' => 'Pridať používateľa',
'button.add_project' => 'Pridať projekt',
'button.add_task' => 'Pridať úlohy',
'button.add_client' => 'Pridať klienta',
'button.add_invoice' => 'Pridať faktúru',
'button.add_option' => 'Pridať vlastné pole',
'button.add' => 'Pridať',
'button.generate' => 'Generovať',
'button.reset_password' => 'Obnoviť heslo',
'button.send' => 'Odoslať',
'button.send_by_email' => 'Odoslať na e-mail',
'button.create_team' => 'Vytvoriť tím',
'button.export' => 'Exportovať tím',
'button.import' => 'Importovať tím',
'button.close' => 'Zatvoriť',
// TODO: translate the following. 
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Názov tímu',
'label.address' => 'Adresa',
'label.currency' => 'Mena',
'label.manager_name' => 'Meno manažéra',
'label.manager_login' => 'Prihlasovacie meno manažéra',
'label.person_name' => 'Meno',
'label.thing_name' => 'Meno',
'label.login' => 'Prihlasovacie meno',
'label.password' => 'Heslo',
'label.confirm_password' => 'Potvrdenie hesla',
'label.email' => 'E-mail',
'label.cc' => 'Kópia',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Predmet',
'label.date' => 'Dátum',
'label.start_date' => 'Dátum začiatku',
'label.end_date' => 'Dátum konca',
'label.user' => 'Používateľ',
'label.users' => 'Používatelia',
'label.client' => 'Klient',
'label.clients' => 'Klienti',
'label.option' => 'Možnosť',
'label.invoice' => 'Fakttúra',
'label.project' => 'Projekt',
'label.projects' => 'Projekty',
'label.task' => 'Úloha',
'label.tasks' => 'Úlohy',
'label.description' => 'Popis',
'label.start' => 'Začiatok',
'label.finish' => 'Koniec',
'label.duration' => 'Dĺžka',
'label.note' => 'Poznámka',
// TODO: translate the following.
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
'label.cost' => 'Náklady',
// TODO: translate the following.
// 'label.day_total' => 'Day total',
'label.week_total' => 'Týždeň celkom',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Dnes',
'label.total_hours' => 'Hodín celkom',
'label.total_cost' => 'Náklady celkom',
'label.view' => 'Zobraziť',
'label.edit' => 'Upraviť',
'label.delete' => 'Vymazať',
'label.configure' => 'Nastaviť',
'label.select_all' => 'Označiť všetky',
'label.select_none' => 'Odznačiť všetky',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Jazyk',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'Formát dátumu',
'label.time_format' => 'Formát času',
'label.week_start' => 'Prvý deň v týždni',
'label.comment' => 'Komentáre',
'label.status' => 'Stav',
'label.tax' => 'Daň',
'label.subtotal' => 'Medzisúčet',
'label.total' => 'Celkovo',
'label.client_name' => 'Názov klienta',
'label.client_address' => 'Adresa klienta',
'label.or' => 'alebo',
'label.error' => 'Chyba',
'label.ldap_hint' => 'Zadajte <b>prihlasovacie meno do Windowsu</b> a <b>heslo</b> do polí nižšie.',
'label.required_fields' => '* - povinné polia',
'label.on_behalf' => 'v zastúpení',
'label.role_manager' => '(manažér)',
'label.role_comanager' => '(spolu-manažér)',
'label.role_admin' => '(administrátor)',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Vlastné polia',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'Typ',
'label.type_dropdown' => 'rozbaľovacie pole',
'label.type_text' => 'text',
'label.required' => 'Povinné',
'label.fav_report' => 'Obľúbená zostava',
// TODO: translate the following.
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'button.mark_paid' => 'Mark paid',

// Form titles.
'title.login' => 'Prihlásenie',
'title.teams' => 'Tímy',
'title.create_team' => 'Vytváranie tímu',
// TODO: translate the following.
// 'title.edit_team' => 'Editing Team',
'title.delete_team' => 'Vymazávanie tímu',
'title.reset_password' => 'Obnovovanie hesla',
'title.change_password' => 'Menenie hesla',
'title.time' => 'Časový záznam',
'title.edit_time_record' => 'Upravovanie časového záznamu',
'title.delete_time_record' => 'Vymazávanie časového záznamu',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
'title.reports' => 'Zostavy',
'title.report' => 'Zostava',
'title.send_report' => 'Odosielanie zostavy',
'title.invoice' => 'Faktúra',
'title.send_invoice' => 'Odosielanie faktúry',
'title.charts' => 'Grafy',
'title.projects' => 'Projekty',
'title.add_project' => 'Pridávanie projektu',
'title.edit_project' => 'Upravovanie projektu',
'title.delete_project' => 'Vymazávanie projektu',
'title.tasks' => 'Úlohy',
'title.add_task' => 'Pridávanie úlohy',
'title.edit_task' => 'Upravovanie úlohy',
'title.delete_task' => 'Vymazávanie úlohy',
'title.users' => 'Používatelia',
'title.add_user' => 'Pridávanie používateľa',
'title.edit_user' => 'Upravovanie používateľa',
'title.delete_user' => 'Vymazávanie používateľa',
'title.clients' => 'Klienti',
'title.add_client' => 'Pridávanie klienta',
'title.edit_client' => 'Upravovanie klienta',
'title.delete_client' => 'Vymazávanie klienta',
'title.invoices' => 'Faktúry',
'title.add_invoice' => 'Pridávanie faktúry',
'title.view_invoice' => 'Priehliadanie faktúry',
'title.delete_invoice' => 'Vymazávanie faktúry',
// TODO: translate the following.
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'Exportovanie údajov o tíme',
'title.import' => 'Importovanie údajov o tíme',
'title.options' => 'Nastavenia',
'title.profile' => 'Profil',
'title.cf_custom_fields' => 'Vlastné polia',
'title.cf_add_custom_field' => 'Pridávanie vlastného poľa',
'title.cf_edit_custom_field' => 'Upravovanie vlastného poľa',
'title.cf_delete_custom_field' => 'Vymazávanie vlastného poľa',
'title.cf_dropdown_options' => 'Nastavenia rozbaľovacieho poľa',
'title.cf_add_dropdown_option' => 'Pridávanie možností',
'title.cf_edit_dropdown_option' => 'Upravovanie možností',
'title.cf_delete_dropdown_option' => 'Vymazávanie možností',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// TODO: translate the following.
// 'title.locking' => 'Locking',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- všetky ---',
'dropdown.no' => '--- žiadne ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
'dropdown.selected_day' => 'deň',
'dropdown.current_week' => 'tento týždeň',
'dropdown.previous_week' => 'minulý týždeň',
'dropdown.selected_week' => 'týždeň',
'dropdown.current_month' => 'tento mesiac',
'dropdown.previous_month' => 'minulý mesiac',
'dropdown.selected_month' => 'mesiac',
'dropdown.current_year' => 'tento rok',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'rok',
'dropdown.all_time' => 'celý čas',
'dropdown.projects' => 'projekty',
'dropdown.tasks' => 'úlohy',
// TODO: translate the following.
// 'dropdown.clients' => 'clients',
'dropdown.select' => '--- vyberte ---',
// TODO: translate the following.
// 'dropdown.select_invoice' => '--- select invoice ---',
'dropdown.status_active' => 'aktívny',
'dropdown.status_inactive' => 'neaktívny',
// TODO: translate the following.
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Zabudnuté heslo?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> je jednoduchý a ľahko použiteľný systém na sledovanie času s otvoreným zdrojovým kódom.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Žiadosť o obnovenie hesla bola odoslaná e-mailom.',
'form.reset_password.email_subject' => 'Žiadosť o obnovenie hesla do Anuko Time Tracker',
'form.reset_password.email_body' => "Vážený používateľ,\n\nniekto, pravdepodobne vy, si vyžiadal obnovenie vášho hesla do Anuko Time Tracker. Prosím kliknite na nasledujúcu linku, ak si prajete obnoviť heslo.\n\n%s\n\nAnuko Time Tracker je jednoduchý a ľahko použiteľný systém na sledovanie času s otvoreným zdrojovým kódom. Navštívte https://www.anuko.com pre viac informácií.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Zadajte nové heslo a kliknite na Uložiť.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm alebo 0,0h)',
'form.time.billable' => 'Faktúrovateľných',
'form.time.uncompleted' => 'Neukončené',
// TODO: translate the folllowing.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Tento záznam bol uložený iba s časom začiatku. Nie je to chyba.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Uložiť ako obľúbenú zostavu',
'form.reports.confirm_delete' => 'Ste si istý, že chcete vymazať túto obľúbenú zostavu?',
'form.reports.include_records' => 'Zahrnúť záznamy',
'form.reports.include_billable' => 'faktúrovateĺné',
'form.reports.include_not_billable' => 'nefaktúrovateľné',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Vyberte časový rozsah',
'form.reports.set_period' => 'alebo nastavte dátumy',
'form.reports.show_fields' => 'Zobraziť polia',
// TODO: translate the following.
// 'form.reports.group_by' => 'Group by',
// 'form.reports.group_by_no' => '--- no grouping ---',
'form.reports.group_by_date' => 'dátum',
'form.reports.group_by_user' => 'používateľ',
'form.reports.group_by_client' => 'klient',
'form.reports.group_by_project' => 'projekt',
'form.reports.group_by_task' => 'úloha',
'form.reports.totals_only' => 'Iba celkové',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exportovať',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Číslo faktúry',
'form.invoice.person' => 'Osoba',
// TODO: translate the following.
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Interval',
'form.charts.chart' => 'Graf',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Aktívne projekty',
'form.projects.inactive_projects' => 'Neaktívne projekty',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Aktívne úlohy',
'form.tasks.inactive_tasks' => 'Neaktívne úlohy',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Aktívny používatelia',
'form.users.inactive_users' => 'Neaktívny používatelia',
// TODO: translate the following.
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Rola',
'form.users.manager' => 'Manažér',
'form.users.comanager' => 'Spolumanažér',
'form.users.rate' => 'Sadzba',
'form.users.default_rate' => 'Predvolená hodinová sadzba',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Aktívny klienti',
'form.clients.inactive_clients' => 'Neaktívny klienti',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Môžete exportovať všetky údaje o tíme do xml súboru. Toto môže byť užitočné pri prenose údajov na iný server.',
'form.export.compression' => 'Kompresia',
'form.export.compression_none' => 'žiadna',
'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Importovať dáta o tíme z xml súboru.',
'form.import.file' => 'Vyberte súbor',
'form.import.success' => 'Import úspešne dokončený.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' =>  'Pomocou vytvorenia nového účtu tímového manažéra vytvorte nový tím.<br>Taktiež môžete importovať údaje o tíme z xml súboru z iného Anuko Time Tracker serveru (nie sú povolené kolízie v prihlasovacom mene).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12-hodinový',
'form.profile.24_hours' => '24-hodinový',
'form.profile.tracking_mode' => 'Režim sledovania',
'form.profile.mode_time' => 'čas',
'form.profile.mode_projects' => 'projekty',
'form.profile.mode_projects_and_tasks' => 'projekty a úlohy',
'form.profile.record_type' => 'Typ záznamu',
'form.profile.type_all' => 'všetky',
'form.profile.type_start_finish' => 'začiatok a koniec',
'form.profile.type_duration' => 'trvanie',
// TODO: translate the following.
// 'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.profile.uncompleted_indicators_none' => 'do not show',
// 'form.profile.uncompleted_indicators_show' => 'show',
'form.profile.plugins' => 'Doplnkové moduly',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Od',
'form.mail.to' => 'Komu',
'form.mail.report_subject' => 'Time Tracker zostava',
'form.mail.footer' => 'Anuko Time Tracker je jednoduchý a ľahko použiteľný systém na sledovanie času s otvoreným zdrojovým kódom.<br> Navštívte <a href="https://www.anuko.com">www.anuko.com</a> pre viac informácií.',
'form.mail.report_sent' => 'Zostava odoslaná.',
'form.mail.invoice_sent' => 'Faktúra odoslaná.',

// Quotas configuration form.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',
);
