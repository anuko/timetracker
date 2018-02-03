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

$i18n_language = 'Magyar';
$i18n_months = array('Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December');
$i18n_weekdays = array('Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat');
$i18n_weekdays_short = array('V', 'H', 'K', 'Sz', 'Cs', 'P', 'Sz');
// format mm/dd
$i18n_holidays = array('01/01', '01/02', '03/15', '04/12', '04/13', '05/01', '05/31', '06/01', '08/20', '08/21', '10/23', '11/01', '12/24', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Bejelentkezés',
'menu.logout' => 'Kijelentkezés',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Segítség',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profil',
'menu.time' => 'Munkaidő',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Riportok',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projektek',
// 'menu.tasks' => 'Tasks',
// TODO: translate the following.
// 'menu.users' => 'Users',
'menu.teams' => 'Csoportok',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Ügyfelek',
'menu.options' => 'Opciók',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'Adatbázis hiba.',
'error.field' => 'Hibás "{0}" mező tartalma.',
'error.empty' => 'A "{0}" mező üres.',
'error.not_equal' => 'A "{0}" mező tartalma nem egyezik meg a "{1}" mező tartalmával.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Válassz projektet.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
// 'error.client' => 'Select client.',
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
// 'error.auth' => 'Incorrect login or password.',
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Ilyen nevű projekt már létezik.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'File feltöltési hiba.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Bejelentkezés',
'button.now' => 'Most',
'button.save' => 'Mentés',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Vissza',
'button.submit' => 'Mentés',
'button.add_user' => 'Felhasználó felvétele',
'button.add_project' => 'Projekt felvétele',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Ügyfél hozzáadása',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Hozzáadás',
'button.generate' => 'Generálás',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Küld',
'button.send_by_email' => 'Küldés e-mail-ben',
'button.create_team' => 'Csoport létrehozása',
'button.export' => 'Csoport exportálása',
'button.import' => 'Csoport importálása',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Pénznem',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Név',
'label.thing_name' => 'Név',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Jelszó',
'label.confirm_password' => 'Jelszó megerősítése',
'label.thing_name' => 'Név',
// TODO: translate the following.
// 'label.email' => 'Email',
'label.cc' => 'Másolatot kap',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'Tárgy',
// TODO: translate the following.
// 'label.date' => 'Date',
// 'label.start_date' => 'Start date',
// 'label.end_date' => 'End date',
// 'label.user' => 'User',
// 'label.users' => 'Users',
// 'label.client' => 'Client',
// 'label.clients' => 'Clients',
// 'label.option' => 'Option',
// 'label.invoice' => 'Invoice',
'label.project' => 'Projekt',
// TODO: translate the following.
// 'label.projects' => 'Projects',
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
// 'label.start' => 'Start',
// 'label.finish' => 'Finish',
// 'label.duration' => 'Duration',
// 'label.note' => 'Note',
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
// 'label.week_total' => 'Week total',
// 'label.month_total' => 'Month total',
'label.today' => 'Ma',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
'label.edit' => 'Szerkesztés',
'label.delete' => 'Törlés',
// TODO: translate the following.
// 'label.configure' => 'Configure',
// 'label.select_all' => 'Select all',
// 'label.select_none' => 'Deselect all',
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
// 'label.comment' => 'Comment',
// 'label.status' => 'Status',
// 'label.tax' => 'Tax',
// 'label.subtotal' => 'Subtotal',
'label.total' => 'Összesen',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
// 'label.on_behalf' => 'on behalf of',
'label.role_manager' => '(vezető)',
'label.role_comanager' => '(helyettes)',
'label.role_admin' => '(adminisztrátor)',
// TODO: translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
// TODO: translate the following.
// 'label.custom_fields' => 'Custom fields',
// 'label.monthly_quotas' => 'Monthly quotas',
// 'label.type' => 'Type',
// 'label.type_dropdown' => 'dropdown',
// 'label.type_text' => 'text',
// 'label.required' => 'Required',
// 'label.fav_report' => 'Favorite report',
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'Bejelentkezés',
// TODO: translate the following.
// 'title.teams' => 'Teams',
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
// 'title.reset_password' => 'Resetting Password',
// 'title.change_password' => 'Changing Password',
// 'title.time' => 'Time',
// 'title.edit_time_record' => 'Editing Time Record',
// 'title.delete_time_record' => 'Deleting Time Record',
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
// 'title.predefined_expenses' => 'Predefined Expenses',
// 'title.add_predefined_expense' => 'Adding Predefined Expense',
// 'title.edit_predefined_expense' => 'Editing Predefined Expense',
// 'title.delete_predefined_expense' => 'Deleting Predefined Expense',
'title.reports' => 'Riportok',
// TODO: translate the following.
// 'title.report' => 'Report',
// 'title.send_report' => 'Sending Report',
// 'title.invoice' => 'Invoice',
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
// 'title.projects' => 'Projects',
// 'title.add_project' => 'Adding Project',
// 'title.edit_project' => 'Editing Project',
// 'title.delete_project' => 'Deleting Project',
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
// 'title.users' => 'Users',
// 'title.add_user' => 'Adding User',
// 'title.edit_user' => 'Editing User',
// 'title.delete_user' => 'Deleting User',
// 'title.clients' => 'Clients',
// 'title.add_client' => 'Adding Client',
// 'title.edit_client' => 'Editing Client',
// 'title.delete_client' => 'Deleting Client',
// 'title.invoices' => 'Invoices',
// 'title.add_invoice' => 'Adding Invoice',
// 'title.view_invoice' => 'Viewing Invoice',
// 'title.delete_invoice' => 'Deleting Invoice',
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
// 'title.export' => 'Exporting Team Data',
// 'title.import' => 'Importing Team Data',
// 'title.options' => 'Options',
// 'title.profile' => 'Profile',
// 'title.cf_custom_fields' => 'Custom Fields',
// 'title.cf_add_custom_field' => 'Adding Custom Field',
// 'title.cf_edit_custom_field' => 'Editing Custom Field',
// 'title.cf_delete_custom_field' => 'Deleting Custom Field',
// 'title.cf_dropdown_options' => 'Dropdown Options',
// 'title.cf_add_dropdown_option' => 'Adding Option',
// 'title.cf_edit_dropdown_option' => 'Editing Option',
// 'title.cf_delete_dropdown_option' => 'Deleting Option',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
// TODO: translate the following.
// 'dropdown.all' => '--- all ---',
// 'dropdown.no' => '--- no ---',
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
// 'dropdown.current_week' => 'this week',
// 'dropdown.previous_week' => 'previous week',
// 'dropdown.selected_week' => 'week',
// 'dropdown.current_month' => 'this month',
// 'dropdown.previous_month' => 'previous month',
// 'dropdown.selected_month' => 'month',
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
// 'dropdown.all_time' => 'all time',
// 'dropdown.projects' => 'projects',
// 'dropdown.tasks' => 'tasks',
// 'dropdown.clients' => 'clients',
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete'=>'delete',
// 'dropdown.do_not_delete'=>'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',



// TODO: refactoring ongoing down from here.

"form.filter.project" => 'projekt',
"form.filter.filter" => 'előre definiált riport formátum',
"form.filter.filter_new" => 'mentsük el ezt a riport formátumot',
// Note to translators: the string below is missing and must be added and translated
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// password reminder form attributes
"form.fpass.send_pass_str" => 'jelszó alap állapotra állítása megkezdve',
"form.fpass.send_pass_subj" => 'A jelszó alap állapotra állítása a Anuko TimeTracker-ben',
"form.fpass.reset_comment" => "a jelszót a megváltoztatásához írja be és mentse el",

// administrator form
"form.admin.title" => 'Adminisztrátor',
"form.admin.duty_text" => 'új csoport létrehozása egy csoport-vezetői jogosultsággal.<br>a csoport adatokat importálhatjuk XML-ből (csak az e-mail címek ne ütközzenek).',

"form.admin.change_pass" => 'az adminisztrátori jelszó megváltoztatása',
"form.admin.profile.title" => 'csoportok',
"form.admin.profile.noprofiles" => 'az adatbázis üres. lépj be adminisztrátorként és hozz létre egyet.',
"form.admin.profile.comment" => 'csoport törlése',
"form.admin.profile.th.id" => 'azonosító',
"form.admin.profile.th.active" => 'aktív',
"form.admin.options" => 'opciók',

// my time form attributes
"form.mytime.title" => 'munkaidőm',
"form.mytime.edit_title" => 'szerkesztés',
"form.mytime.del_str" => 'törlés',
"form.mytime.time_form" => ' (óó:pp)',
"form.mytime.date" => 'dátum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tevékenység',
"form.mytime.start" => 'kezdete',
"form.mytime.finish" => 'vége',
"form.mytime.duration" => 'hossz',
"form.mytime.note" => 'megjegyzés',
"form.mytime.behalf" => 'napi tevékenység lista, munkatárs:',
"form.mytime.daily" => 'napi munka',
"form.mytime.total" => 'összesített óraszám: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'tevékenység',
"form.mytime.th.start" => 'kezdete',
"form.mytime.th.finish" => 'vége',
"form.mytime.th.duration" => 'hossz',
"form.mytime.th.note" => 'megjegyzés',
"form.mytime.del_yes" => 'a bejegyzés törölve',
"form.mytime.no_finished_rec" => 'csak az munka kezdete lett megjelölve, ha később visszalépsz a rendszerbe beállíthatod a vég-időpontot...',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'új vezetői jogosultság létrehozása',
"form.profile.edit_title" => 'profil szerkesztése',
"form.profile.name" => 'név',

// people form attributes
"form.people.ppl_str" => 'munkatársak',
"form.people.createu_str" => 'új munkatárs hozzáadása',
"form.people.edit_str" => 'munkatárs adatainak szerkesztése',
"form.people.del_str" => 'munkatárs adatainak törlése',
"form.people.th.role" => 'szerepkör',
"form.people.th.status" => 'státusz',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'tarifa',
"form.people.manager" => 'vezető',
"form.people.comanager" => 'helyettes',
"form.people.empl" => 'dolgozó',

"form.people.rate" => 'általános óradíj',
"form.people.comanager" => 'helyettes',
"form.people.projects" => 'projektek',
// Note to translators: the string below is missing and must be added and translated 

// projects form attributes
"form.project.proj_title" => 'projektek',
"form.project.edit_str" => 'projekt adatainak szerkesztése',
"form.project.add_str" => 'új projekt hozzáadása',
"form.project.del_str" => 'projekt törlése',

// activities form attributes
"form.activity.project" => 'projekt',

// report attributes
"form.report.from" => 'kezdő időpont',
"form.report.to" => 'vég időpont',
"form.report.groupby_user" => 'személyek szerint',
"form.report.groupby_project" => 'projektek szerint',
"form.report.duration" => 'időtartam',
"form.report.start" => 'kezdet',
"form.report.finish" => 'befejezés',
"form.report.note" => 'megjegyzés',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'csak a teljes óraszám',
"form.report.total" => 'összesített óraszám',
"form.report.th.empllist" => 'dolgozó',
"form.report.th.date" => 'dátum',
"form.report.th.project" => 'projekt',
"form.report.th.start" => 'elkezdve',
"form.report.th.finish" => 'befejezve',
"form.report.th.duration" => 'időtartam',
"form.report.th.note" => 'megjegyzés',

// mail form attributes
"form.mail.from" => 'feladó',
"form.mail.to" => 'címzett',
"form.mail.comment" => 'megjegyzés',
"form.mail.above" => 'küldjük el ezt a riportot e-mail-ben...',
// Note to translators: the string below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>az üzenet elküldve</b>',

// invoice attributes
"form.invoice.title" => 'számla',
"form.invoice.caption" => 'Számla',
"form.invoice.above" => 'a számlához tartozó adatok',
"form.invoice.select_cust" => 'válassz ügyfelet',
"form.invoice.fillform" => 'töltsd ki a mezőket',
"form.invoice.date" => 'Dátum',
"form.invoice.number" => 'számla azonosító száma',
"form.invoice.tax" => 'adó',
"form.invoice.comment" => 'megjegyzés ',
"form.invoice.th.username" => 'személy',
"form.invoice.th.time" => 'óra',
"form.invoice.th.rate" => 'tarifa',
"form.invoice.th.summ" => 'darab',
"form.invoice.subtotal" => 'részösszeg',
"form.invoice.customer" => 'Ügyfél',
"form.invoice.mailinv_above" => 'küldjük el ezt a számlát e-mail-en',
"form.invoice.sending_str" => '<b>a számla elküldve</b>',

"form.migration.zip" => 'tömörítés',
"form.migration.file" => 'válassz file-nevet',
"form.migration.import.title" => 'adatok importálása',
"form.migration.import.success" => 'az importálás sikeresen véget ért',
"form.migration.import.text" => 'csoport adatok importja XML file-ból',
"form.migration.export.title" => 'az adatok exportálása',
"form.migration.export.success" => 'az exportálás sikeres volt',
"form.migration.export.text" => 'kimentheted az összes felvitt csoport adatait egy XML file-ba, ami megkönnyíti a TimeTracker szerverek közötti adatátvitelt...',

"form.client.title"=> 'ügyfelek',
"form.client.add_title" => 'új ügyfél hozzáadása',
"form.client.edit_title" => 'ügyfél adatainak szerkesztése',
"form.client.del_title" => 'ügyfél törlése',
"form.client.tax" => 'adó',
"form.client.comment" => 'megjegyzés ',

// miscellaneous strings
"forward.forgot_password" => 'elfelejtetted a jelszót?',
"forward.edit" => 'szerkesztés',
"forward.delete" => 'törlés',
"forward.tocsvfile" => 'az adatok exportálása CSV file-ba',
// Note to translators: the string below is missing and must be added and translated 
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'számla készítés',
"forward.change" => 'ügyfelek adatainak beállítása',

// strings inside contols on forms
"controls.select.project" => '--- válassz projektet ---',
"controls.select.activity" => '--- válassz tevékenységet ---',
"controls.select.client" => '--- válassz ügyfelet ---',
"controls.project_bind" => '--- összes ---',
"controls.all" => '--- összes ---',
"controls.notbind" => '--- nincs ---',
"controls.per_tm" => 'ebben a hónapban',
"controls.per_lm" => 'múlt hónapban',
"controls.per_tw" => 'ezen a héten',
"controls.per_lw" => 'múlt héten',
"controls.sel_period" => '--- válassz időszakot ---',
"controls.sel_groupby" => '--- csoportosítás nélkül ---',

// labels
"label.pbehalf_info" => '%s %s <b>helyett %s</b>',
"label.time_noentry" => 'nincs bejegyzés',
"label.req_fields" => '* kötelezően kitöltendő mezők',
"label.sel_project" => 'válassz projektet',
"label.sel_activity" => 'válassz tevékenységet',
"label.sel_tp" => 'jelölj meg egy időszakot',
"label.set_tp" => '... vagy állíts be konkrét dátumot',
"label.fields" => 'csak a kijelölt mezők fognak szerepelni a riportban',
"label.group_title" => 'csoportosítva',
// Note to translators: the string below is missing and must be added and translated 
// "label.include_title" => 'include records',
"label.inv_str" => 'számla',
"label.set_empl" => 'válassz dolgozót',
"label.sel_all" => 'mindenkit kijelöl',
"label.sel_none" => 'senkit nem jelöl ki',
"label.or" => 'vagy',
"label.disable" => 'tiltva',
"label.enable" => 'engedélyezve',
"label.filter" => 'szűrés',
// Note to translators: the strings below are missing and must be added and translated 
//"label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
