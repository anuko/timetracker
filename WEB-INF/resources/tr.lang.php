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
// 'menu.users' => 'Users',
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
// 'error.client' => 'Select client.',
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
// 'label.person_name' => 'Name',
// 'label.thing_name' => 'Name',
// 'label.login' => 'Login',
'label.password' => 'Parola',
// TODO: translate the following.
// 'label.confirm_password' => 'Confirm password',
'label.email' => 'E-posta',
// TODO: translate the following.
// 'label.cc' => 'Cc',
// 'label.bcc' => 'Bcc',
'label.subject' => 'Konu',
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
// 'label.project' => 'Project',
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
'label.today' => 'Bugün',
// TODO: translate the following.
// 'label.total_hours' => 'Total hours',
// 'label.total_cost' => 'Total cost',
// 'label.view' => 'View',
// 'label.edit' => 'Edit',
'label.delete' => 'Sil',
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
'label.total' => 'Toplam',
// TODO: translate the following.
// 'label.client_name' => 'Client name',
// 'label.client_address' => 'Client address',
// 'label.or' => 'or',
// 'label.error' => 'Error',
// 'label.ldap_hint' => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// 'label.required_fields' => '* - required fields',
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
'title.login' => 'Giriş',
// TODO: translate the following.
// 'title.teams' => 'Teams',
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
// 'title.reports' => 'Reports',
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

// Login form. See example at https://timetracker.anuko.com/login.php.
// TODO: translate the following.
// 'form.login.forgot_password' => 'Forgot password?',
// 'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is a simple, easy to use, open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
// TODO: translate the following.
// 'form.reset_password.message' => 'Password reset request sent by email.',
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
// TODO: translate the following.
// 'form.change_password.tip' => 'Type new password and click on Save.',

// Time form. See example at https://timetracker.anuko.com/time.php.
// TODO: translate the following.
// 'form.time.duration_format' => '(hh:mm or 0.0h)',
// 'form.time.billable' => 'Billable',
// 'form.time.uncompleted' => 'Uncompleted',
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',



// TODO: refactoring ongoing down from here.

"form.filter.project" => 'proje',
"form.filter.filter" => 'sık kullanılan rapor',
"form.filter.filter_new" => 'sık kullanılan olarak kaydet',

// password reminder form attributes
"form.fpass.send_pass_str" => 'parola sıfırlama talebi yollandı',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker parola sıfırlama talebi',
// Note to translators: the ending of this string needs to be translated.
"form.fpass.send_pass_body" => "Sayın Kullanıcı,\n\nBirisi, muhtemelen siz, Anuko Time Tracker parolanızın sıfırlanmasını istedi. Parolanızı sıfırlamak isterseniz lütfen bu bağlantıyı takip edin.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
"form.fpass.reset_comment" => "parolanızı sıfırlamak için lütfen parolanızı yazın ve kaydedin",

// administrator form
"form.admin.title" => 'yönetici',
"form.admin.duty_text" => 'yeni bir ekip yönetimi hesabı yaratarak yeni bir ekibi yaratın.<br>ayrıca başka bir Anuko Time Tracker sunucusundan ekip bilgilerini bir xml dosyasından aktarabilirsiniz (e-posta çakışmalarına izin verilmemekte).',

"form.admin.change_pass" => 'yönetici hesabın parolasını değiştir',
"form.admin.profile.title" => 'ekipler',
"form.admin.profile.noprofiles" => 'veritabanınız boş. yeni bir ekip yaratmak için yönetici olarak giriş yapın.',
"form.admin.profile.comment" => 'ekibi sil',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'isim',
"form.admin.profile.th.edit" => 'düzenle',
"form.admin.profile.th.del" => 'sil',
"form.admin.profile.th.active" => 'aktif',
// Note to translators: the strings below are missing and must be translated and added
// "form.admin.options" => 'options',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'zamanım',
"form.mytime.edit_title" => 'zaman kaydını düzenliyor',
"form.mytime.del_str" => 'zaman kaydını siliyor',
"form.mytime.time_form" => ' (ss:dd)',
"form.mytime.date" => 'tarih',
"form.mytime.project" => 'proje',
"form.mytime.activity" => 'faaliyet',
"form.mytime.start" => 'başlat',
"form.mytime.finish" => 'tamamla',
"form.mytime.duration" => 'süre',
"form.mytime.note" => 'not',
"form.mytime.daily" => 'günlük çalışma',
"form.mytime.total" => 'toplam saat: ',
"form.mytime.th.project" => 'proje',
"form.mytime.th.start" => 'başlat',
"form.mytime.th.finish" => 'tamamla',
"form.mytime.th.duration" => 'süre',
"form.mytime.th.note" => 'not',
"form.mytime.th.edit" => 'düzenle',
"form.mytime.th.delete" => 'sil',
"form.mytime.del_yes" => 'zaman kaydı başarıyla silindi',
"form.mytime.no_finished_rec" => 'bu kayıt sadece başlangıç zamanıyla silindi. bu hata değildir. gerekirse çıkış yapın.',
"form.mytime.billable" => 'faturalandırılabilir',
"form.mytime.warn_tozero_rec" => 'bu zaman kaydı silinmeli çünkü zaman aralığı kilitli',
// Note to translators: the string below is missing and must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
// Note to translators: we need a more accurate translation of form.profile.create_title
"form.profile.create_title" => 'yeni yönetici hesabı yarat',
"form.profile.edit_title" => 'profili düzenliyor',
"form.profile.name" => 'isim',
// Note to translators: "form.profile.login" => 'e-posta', // email has been changed to login

// Note to translators: the string below is missing and must be translated and added
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",

// people form attributes
"form.people.ppl_str" => 'insanlar',
"form.people.createu_str" => 'yeni kullanıcı yarat',
"form.people.edit_str" => 'kullanıcı düzenleniyor',
"form.people.del_str" => 'kullanıcı siliniyor',
"form.people.th.name" => 'isim',
// Note to translators: "form.people.th.login" => 'e-posta', // email has been changed to login
"form.people.th.role" => 'rol',
"form.people.th.edit" => 'düzenle',
"form.people.th.del" => 'sil',
"form.people.th.status" => 'durum',
"form.people.th.project" => 'proje',
"form.people.th.rate" => 'tarife',
"form.people.manager" => 'yönetici',
"form.people.comanager" => 'yardımcı yönetici',
"form.people.empl" => 'kullanıcı',
"form.people.name" => 'isim',
// Note to translators: "form.people.login" => 'e-posta', // email has been changed to login

"form.people.rate" => 'varsayılan saat ücreti',
"form.people.comanager" => 'yardımcı yönetici',
"form.people.projects" => 'projeler',

// projects form attributes
"form.project.proj_title" => 'projeler',
"form.project.edit_str" => 'proje düzenleniyor',
"form.project.add_str" => 'yeni proje ekleniyor',
"form.project.del_str" => 'proje siliniyor',
"form.project.th.name" => 'isim',
"form.project.th.edit" => 'düzenle',
"form.project.th.del" => 'sil',
"form.project.name" => 'isim',

// activities form attributes
"form.activity.act_title" => 'faaliyetler',
"form.activity.add_title" => 'yeni faaliyetler ekleniyor',
"form.activity.edit_str" => 'faaliyetler düzenleniyor',
"form.activity.del_str" => 'faaliyetler siliniyor',
"form.activity.name" => 'isim',
"form.activity.project" => 'proje',
"form.activity.th.name" => 'isim',
"form.activity.th.project" => 'proje',
"form.activity.th.edit" => 'düzenle',
"form.activity.th.del" => 'sil',

// report attributes
"form.report.title" => 'raporlar',
"form.report.from" => 'başlangıç tarihi',
"form.report.to" => 'son tarihi',
"form.report.groupby_user" => 'kullanıcı',
"form.report.groupby_project" => 'proje',
"form.report.duration" => 'süre',
"form.report.start" => 'başlangıç',
"form.report.finish" => 'son',
"form.report.note" => 'not',
"form.report.project" => 'proje',
"form.report.totals_only" => 'sadece toplamlar',
"form.report.total" => 'saat toplamı',
"form.report.th.empllist" => 'kullanıcı',
"form.report.th.date" => 'tarih',
"form.report.th.project" => 'proje',
"form.report.th.start" => 'başlangıç',
"form.report.th.finish" => 'son',
"form.report.th.duration" => 'süre',
"form.report.th.note" => 'not',

// mail form attributes
"form.mail.from" => 'kimden',
"form.mail.to" => 'kime',
"form.mail.comment" => 'yorum',
"form.mail.above" => 'bu raporu e-posta ile yolla',
// Note to translators: this string needs to be translated.
// "form.mail.footer_str" => 'Anuko Time Tracker is a simple, easy to use, open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
"form.mail.sending_str" => '<b>ileti yollandı</b>',

// invoice attributes
"form.invoice.title" => 'fatura',
"form.invoice.caption" => 'fatura',
"form.invoice.above" => 'fatura için ek bilgi',
"form.invoice.select_cust" => 'müşteri seç',
"form.invoice.fillform" => 'alanları doldur',
"form.invoice.date" => 'tarih',
"form.invoice.number" => 'fatura numarası',
"form.invoice.tax" => 'vergi',
"form.invoice.comment" => 'yorum ',
"form.invoice.th.username" => 'kişi',
"form.invoice.th.time" => 'saatler',
"form.invoice.th.rate" => 'tarife',
"form.invoice.th.summ" => 'tutar',
"form.invoice.subtotal" => 'alt toplamı',
"form.invoice.customer" => 'müşteri',
"form.invoice.mailinv_above" => 'bu faturayı e-posta ile yolla',
"form.invoice.sending_str" => '<b>fatura yollandı</b>',

"form.migration.zip" => 'sıkıştırma',
"form.migration.file" => 'dosya seç',
"form.migration.import.title" => 'veri içe aktar',
"form.migration.import.success" => 'içe aktarma başarıyla tamamlandı',
"form.migration.import.text" => 'ekip bilgileri bir xml dosyasından içe aktar',
"form.migration.export.title" => 'dışarı aktar',
"form.migration.export.success" => 'dışarı aktarma başarıyla tamamlandı',
"form.migration.export.text" => 'tüm ekip bilgilerinizi bir xml dosyasına aktarabilirsiniz. bu, kendi sunucunuza bilgi aktarmak istediğinizde faydalı olabilir.',
// Note to translators: the strings below are missing and must be added and translated
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'müşteriler',
"form.client.add_title" => 'müşteri ekle',
"form.client.edit_title" => 'müşteriyi düzenle',
"form.client.del_title" => 'müşteriyi sil',
"form.client.th.name" => 'isim',
"form.client.th.edit" => 'düzenle',
"form.client.th.del" => 'sil',
"form.client.name" => 'isim',
"form.client.tax" => 'vergi',
"form.client.comment" => 'yorum ',

// miscellaneous strings
"forward.forgot_password" => 'parolanızı unuttunuz mu?',
"forward.edit" => 'düzenle',
"forward.delete" => 'sil',
"forward.tocsvfile" => 'bilgileri .csv dosyasına aktar',
"forward.toxmlfile" => 'bilgileri .xml dosyasına aktar',
"forward.geninvoice" => 'fatura yarat',
"forward.change" => 'müşterileri düzenle',

// strings inside contols on forms
"controls.select.project" => '--- proje seç ---',
"controls.select.activity" => '--- faaliyet seç ---',
"controls.select.client" => '--- müşteri seç ---',
"controls.project_bind" => '--- tümü ---',
"controls.all" => '--- tümü ---',
"controls.notbind" => '--- hiç ---',
"controls.per_tm" => 'bu ay',
"controls.per_lm" => 'geçen ay',
"controls.per_tw" => 'bu hafta',
"controls.per_lw" => 'geçen hafta',
"controls.per_td" => 'bugün',
"controls.per_at" => 'tüm zamanlar',
// Note to translators: the string below is missing and must be added and translated
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- zaman dönemi seç ---',
"controls.sel_groupby" => '--- gruplama yok ---',
"controls.inc_billable" => 'faturalandırılabilir',
"controls.inc_nbillable" => 'faturalandırılamaz',
// Note to translators: the string below is missing and must be added and translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'kullanıcı için faaliyetler',
// Note to translators: the string below is missing and must be added and translated
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'dönem için grafik',

"label.today" => 'bugün',
"label.req_fields" => '* zorunlu bilgi',
"label.sel_project" => 'proje seç',
"label.sel_activity" => 'faaliyet seç',
"label.sel_tp" => 'zaman aralığını seç',
"label.set_tp" => 'ya da tarihleri belirle',
"label.fields" => 'alanları göster',
"label.group_title" => 'gruplandırma kıstası',
"label.include_title" => 'kayıtları dahil et',
"label.inv_str" => 'fatura',
"label.set_empl" => 'kullanıcıları seç',
"label.sel_all" => 'tümünü seç',
"label.sel_none" => 'hiçbirini seçme',
"label.or" => 'ya da',
"label.disable" => 'devre dışı bırak',
"label.enable" => 'devreye sok',
"label.filter" => 'filtre',
"label.timeweek" => 'haftalık toplam',
);
