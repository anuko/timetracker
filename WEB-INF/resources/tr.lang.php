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

$i18n_language = 'Türkçe';
$i18n_months = array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayis', 'Haziran', 'Temmuz', 'Ağustos', 'Eylük', 'Ekim', 'Kasım', 'Aralık');
$i18n_weekdays = array('Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi');
$i18n_weekdays_short = array('Pa', 'Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct');
// format mm/dd
$i18n_holidays = array('01/01', '04/23', '05/01', '05/19', '08/30', '09/20', '09/21', '09/22', '10/29', '11/27', '11/28', '11/29', '11/30');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Giriş',
'menu.logout' => 'Çıkış',
// TODO: translate the following.
// 'menu.forum' => 'Forum',
'menu.help' => 'Yardım',
// TODO: translate the following.
// 'menu.create_team' => 'Create Team',
'menu.profile' => 'Profili',
// TODO: translate the following.
// 'menu.time' => 'Time',
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'Raporlar',
// TODO: translate the following.
// 'menu.charts' => 'Charts',
'menu.projects' => 'Projeler',
// TODO: translate the following.
// 'menu.tasks' => 'Tasks',
'menu.users' => 'Kullanıcılar',
'menu.teams' => 'Ekipler',
// TODO: translate the following.
// 'menu.export' => 'Export',
'menu.clients' => 'Müşteriler',
// TODO: translate the following.
// 'menu.options' => 'Options',

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
'error.db' => 'Veritabanı hatası.',
'error.field' => 'Hatalı veri "{0}".',
'error.empty' => 'Alan "{0}" boştur.',
// TODO: confirm that error.not_equal is translated correctly.
// Test by changing password with not equal password value fields.
// English equivalent is:
// 'error.not_equal' => 'Field "{0}" is not equal to field "{1}".',
'error.not_equal' => 'Alan "{0}" "{1}" alanıyla aynı değildir.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'Proje seç.',
// TODO: translate the following.
// 'error.task' => 'Select task.',
'error.client' => 'Müşteri seç',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'Hatalı kullanıcı adı veya parola.',
// TODO: translate the following.
// 'error.user_exists' => 'User with this login already exists.',
'error.project_exists' => 'Bu isimde proje zaten vardır.',
// TODO: translate the following.
// 'error.task_exists' => 'Task with this name already exists.',
// 'error.client_exists' => 'Client with this name already exists.',
// 'error.invoice_exists' => 'Invoice with this number already exists.',
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// 'error.no_login' => 'No user with this login.',
// 'error.no_teams' => 'Your database is empty. Login as admin and create a new team.',
'error.upload' => 'Dosya yükleme hatası.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'Error sending mail.',
// 'error.no_email' => 'No email associated with this login.',
// 'error.uncompleted_exists' => 'Uncompleted entry already exists. Close or delete it.',
// 'error.goto_uncompleted' => 'Go to uncompleted entry.',
// 'error.overlap' => 'Time interval overlaps with existing records.',
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'Giriş',
'button.now' => 'Şimdi',
'button.save' => 'Kaydet',
// TODO: translate the following.
// 'button.copy' => 'Copy',
'button.cancel' => 'Iptal',
'button.submit' => 'Gönder',
'button.add_user' => 'Kullanıcı ekle',
'button.add_project' => 'Proje ekle',
// TODO: translate the following.
// 'button.add_task' => 'Add task',
'button.add_client' => 'Müşteri ekle',
// TODO: translate the following.
// 'button.add_invoice' => 'Add invoice',
// 'button.add_option' => 'Add option',
'button.add' => 'Ekle',
'button.generate' => 'Yarat',
// TODO: translate the following.
// 'button.reset_password' => 'Reset password',
'button.send' => 'Gönder',
'button.send_by_email' => 'E-posta ile gönder',
'button.create_team' => 'Ekip yarat',
// TODO: translate the following.
// 'button.export' => 'Export team',
'button.import' => 'Ekibi içeri aktar',
// TODO: translate the following.
// 'button.close' => 'Close',
// 'button.stop' => 'Stop',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.team_name' => 'Team name',
// 'label.address' => 'Address',
'label.currency' => 'Para birimi',
// TODO: translate the following.
// 'label.manager_name' => 'Manager name',
// 'label.manager_login' => 'Manager login',
'label.person_name' => 'Isim',
'label.thing_name' => 'Isim',
// TODO: translate the following.
// 'label.login' => 'Login',
'label.password' => 'Parola',
// TODO: translate the following.
// 'label.confirm_password' => 'Confirm password',
'label.email' => 'E-posta',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Konu',
'label.date' => 'Tarih',
'label.start_date' => 'Başlangıç tarihi',
'label.end_date' => 'Son tarihi',
'label.user' => 'Kullanıcı',
'label.users' => 'Kullanıcılar',
'label.client' => 'Müşteri',
'label.clients' => 'Müşteriler',
// TODO: translate the following.
// 'label.option' => 'Option',
'label.invoice' => 'Fatura',
'label.project' => 'Proje',
'label.projects' => 'Projeler',
// TODO: translate the following.
// 'label.task' => 'Task',
// 'label.tasks' => 'Tasks',
// 'label.description' => 'Description',
'label.start' => 'Başlat',
'label.finish' => 'Tamamla',
'label.duration' => 'Süre',
'label.note' => 'Not',
'label.notes' => 'Notlar',
// TODO: translate the following.
// 'label.item' => 'Item',
// 'label.cost' => 'Cost',
// 'label.day_total' => 'Day total',
'label.week_total' => 'Haftalık toplam',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'Bugün',
// TODO: translate the following.
// 'label.view' => 'View',
'label.edit' => 'Düzenle',
'label.delete' => 'Sil',
// TODO: translate the following.
// 'label.configure' => 'Configure',
'label.select_all' => 'Tümünü seç',
'label.select_none' => 'Hiçbirini seçme',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.id' => 'ID',
// 'label.language' => 'Language',
// 'label.decimal_mark' => 'Decimal mark',
// 'label.date_format' => 'Date format',
// 'label.time_format' => 'Time format',
// 'label.week_start' => 'First day of week',
'label.comment' => 'Yorum',
'label.status' => 'Durum',
'label.tax' => 'Vergi',
'label.subtotal' => 'Alt toplamı',
'label.total' => 'Toplam',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
'label.or' => 'ya da',
// TODO: translate the following.
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
'label.required_fields' => '* zorunlu bilgi',
'label.on_behalf' => 'adına',
'label.role_manager' => '(yönetici)',
'label.role_comanager' => '(yardımcı yönetici)',
'label.role_admin' => '(sistem yönetici)',
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
'label.fav_report' => 'Sık kullanılan rapor',
// TODO: translate the following.
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
// Form titles.
// TODO: Improve titles for consistency, so that each title explains correctly what each
// page is about and is "consistent" from page to page, meaning that correct grammar is used everywhere.
// Compare with English file to see how it is done there and do Romanian titles similarly.
// Specifically: compare project and client titles and see how they differ.
'title.login' => 'Giriş',
'title.teams' => 'Ekipler',
// TODO: translate the following.
// 'title.create_team' => 'Creating Team',
// 'title.edit_team' => 'Editing Team',
// 'title.delete_team' => 'Deleting Team',
'title.reset_password' => 'Parolayı sıfırla',
// TODO: translate the following.
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
'title.reports' => 'Raporlar',
'title.report' => 'Rapor',
// TODO: translate the following.
// 'title.send_report' => 'Sending Report',
'title.invoice' => 'Fatura',
// TODO: translate the following.
// 'title.send_invoice' => 'Sending Invoice',
// 'title.charts' => 'Charts',
'title.projects' => 'Projeler',
'title.add_project' => 'Proje ekleniyor',
'title.edit_project' => 'Proje düzenleniyor',
'title.delete_project' => 'Proje siliniyor',
// TODO: translate the following.
// 'title.tasks' => 'Tasks',
// 'title.add_task' => 'Adding Task',
// 'title.edit_task' => 'Editing Task',
// 'title.delete_task' => 'Deleting Task',
'title.users' => 'Kullanıcılar',
'title.add_user' => 'Kullanıcı yarat', // TODO: we need consistency with all titles. Why not ekleniyor?
'title.edit_user' => 'Kullanıcı düzenleniyor',
'title.delete_user' => 'Kullanıcı siliniyor',
'title.clients' => 'Müşteriler',
'title.add_client' => 'Müşteri ekle',
'title.edit_client' => 'Müşteriyi düzenle',
'title.delete_client' => 'Müşteriyi sil',
'title.invoices' => 'Faturalar',
// TODO: translate the following.
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
'title.profile' => 'Profili',
// TODO: translate the following.
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
'dropdown.all' => '--- tümü ---',
'dropdown.no' => '--- hiç ---',
'dropdown.current_day' => 'bugün',
'dropdown.previous_day' => 'dün',
'dropdown.selected_day' => 'gün',
'dropdown.current_week' => 'bu hafta',
'dropdown.previous_week' => 'geçen hafta',
'dropdown.selected_week' => 'hafta',
'dropdown.current_month' => 'bu ay',
'dropdown.previous_month' => 'geçen ay',
'dropdown.selected_month' => 'ay',
// TODO: translate the following.
// 'dropdown.current_year' => 'this year',
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => 'tüm zamanlar',
'dropdown.projects' => 'projeler',
// TODO: translate the following.
// 'dropdown.tasks' => 'tasks',
'dropdown.clients' => 'müşteriler',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
// 'dropdown.select_invoice' => '--- select invoice ---',
// 'dropdown.status_active' => 'active',
// 'dropdown.status_inactive' => 'inactive',
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Parolanızı unuttunuz mu?',
// TODO: translate the following.
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Parola sıfırlama talebi yollandı.', // TODO: add "by email" to match the English string.
'form.reset_password.email_subject' => 'Anuko Time Tracker parola sıfırlama talebi',
// TODO: translate the ending of the following.
'form.reset_password.email_body' => "Sayın Kullanıcı,\n\nBirisi, muhtemelen siz, Anuko Time Tracker parolanızın sıfırlanmasını istedi. Parolanızı sıfırlamak isterseniz lütfen bu bağlantıyı takip edin.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
'form.time.billable' => 'Faturalandırılabilir',
// TODO: translate the following.
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
// TODO: translate the following.
// 'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Sık kullanılan olarak kaydet',
// TODO: translate the following.
// 'form.reports.confirm_delete' => 'Are you sure you want to delete this favorite report?',
'form.reports.include_billable' => 'faturalandırılabilir',
'form.reports.include_not_billable' => 'faturalandırılamaz',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'Zaman aralığını seç',
'form.reports.set_period' => 'ya da tarihleri belirle',
'form.reports.show_fields' => 'Alanları göster',
'form.reports.group_by' => 'Gruplandırma kıstas',
'form.reports.group_by_no' => '--- gruplama yok ---',
'form.reports.group_by_date' => 'tarih',
'form.reports.group_by_user' => 'kullanıcı',
// TODO: translate the following.
// 'form.reports.group_by_client' => 'client',
'form.reports.group_by_project' => 'proje',
// TODO: translate the following.
// 'form.reports.group_by_task' => 'task',
'form.reports.totals_only' => 'Sadece toplamlar',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: translate the following.
// 'form.report.export' => 'Export',
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Fatura numarası',
'form.invoice.person' => 'Kişi',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
// TODO: translate the following.
// 'form.charts.interval' => 'Interval',
// 'form.charts.chart' => 'Chart',

// Projects form. See example at https://timetracker.anuko.com/projects.php
// TODO: translate the following.
// 'form.projects.active_projects' => 'Active Projects',
// 'form.projects.inactive_projects' => 'Inactive Projects',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
// TODO: translate the following.
// 'form.tasks.active_tasks' => 'Active Tasks',
// 'form.tasks.inactive_tasks' => 'Inactive Tasks',

// Users form. See example at https://timetracker.anuko.com/users.php
// TODO: translate the following.
// 'form.users.active_users' => 'Active Users',
// 'form.users.inactive_users' => 'Inactive Users',
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'Rol',
// TODO: translate the following.
// 'form.users.manager' => 'Manager',
// 'form.users.comanager' => 'Co-manager',
'form.users.rate' => 'Tarife', // TODO: is this correct?
'form.users.default_rate' => 'Varsayılan saat ücreti',

// Clients form. See example at https://timetracker.anuko.com/clients.php
// TODO: translate the following.
// 'form.clients.active_clients' => 'Active Clients',
// 'form.clients.inactive_clients' => 'Inactive Clients',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Tüm ekip bilgilerinizi bir xml dosyasına aktarabilirsiniz. Bu, kendi sunucunuza bilgi aktarmak istediğinizde faydalı olabilir.',
'form.export.compression' => 'Sıkıştırma',
// TODO: translate the following.
// 'form.export.compression_none' => 'none',
// 'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Ekip bilgileri bir xml dosyasından içe aktar.',
'form.import.file' => 'Dosya seç',
'form.import.success' => 'Içe aktarma başarıyla tamamlandı.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
// TODO: check form.teams.hint for accuracy. I did not not how to translate "login", so this may be garbage now.
'form.teams.hint' => 'Yeni bir ekip yönetimi hesabı yaratarak yeni bir ekibi yaratın.<br>Ayrıca başka bir Anuko Time Tracker sunucusundan ekip bilgilerini bir xml dosyasından aktarabilirsiniz (login çakışmalarına izin verilmemekte).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
// TODO: translate the following.
// 'form.profile.12_hours' => '12 hours',
// 'form.profile.24_hours' => '24 hours',
// 'form.profile.tracking_mode' => 'Tracking mode',
// 'form.profile.mode_time' => 'time',
// 'form.profile.mode_projects' => 'projects',
// 'form.profile.mode_projects_and_tasks' => 'projects and tasks',
// 'form.profile.record_type' => 'Record type',
// 'form.profile.type_all' => 'all',
// 'form.profile.type_start_finish' => 'start and finish',
// 'form.profile.type_duration' => 'duration',
// 'form.profile.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.profile.uncompleted_indicators_none' => 'do not show',
// 'form.profile.uncompleted_indicators_show' => 'show',
// 'form.profile.plugins' => 'Plugins',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Kimden',
'form.mail.to' => 'Kime',
// TODO: translate the following.
// 'form.mail.report_subject' => 'Time Tracker Report',
// 'form.mail.footer' => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
// 'form.mail.report_sent' => 'Report sent.',
'form.mail.invoice_sent' => 'Fatura yollandı.',

// Quotas configuration form.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',



// TODO: refactoring ongoing down from here.

// administrator form
"form.admin.profile.title" => 'ekipler',
"form.admin.profile.noprofiles" => 'veritabanınız boş. yeni bir ekip yaratmak için yönetici olarak giriş yapın.',
"form.admin.profile.comment" => 'ekibi sil',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.active" => 'aktif',

// my time form attributes
"form.mytime.title" => 'zamanım',
"form.mytime.edit_title" => 'zaman kaydını düzenliyor',
"form.mytime.del_str" => 'zaman kaydını siliyor',
"form.mytime.time_form" => ' (ss:dd)',
"form.mytime.no_finished_rec" => 'bu kayıt sadece başlangıç zamanıyla silindi. bu hata değildir. gerekirse çıkış yapın.',

// people form attributes
"form.people.manager" => 'yönetici',
"form.people.comanager" => 'yardımcı yönetici',
);
