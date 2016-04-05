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

// Note to translators: Please use proper capitalization rules for your language.

$i18n_language = 'Türkçe';
$i18n_months = array('ocak', 'şubat', 'mart', 'nisan', 'mayis', 'haziran', 'temmuz', 'ağustos', 'eylük', 'ekim', 'kasım', 'aralık');
$i18n_weekdays = array('pazar', 'pazartesi', 'salı', 'çarşamba', 'perşembe', 'cuma', 'cumartesi');
$i18n_weekdays_short = array('p', 'pt', 's', 'ç', 'p', 'c', 'ct');
// format mm/dd
$i18n_holidays = array('01/01', '04/23', '05/01', '05/19', '08/30', '09/20', '09/21', '09/22', '10/29', '11/27', '11/28', '11/29', '11/30');

$i18n_key_words = array(

// Menus.
'menu.login' => 'giriş',
'menu.logout' => 'çıkış',
// TODO: translate the following:
// 'menu.forum' => 'Forum',
'menu.help' => 'yardım',
// Note to translators: menu.create_team needs a more accurate translation.
'menu.create_team' => 'yeni yönetici hesabı yarat',
'menu.profile' => 'profili',
'menu.my_time' => 'zamanım',
// TODO: translate the following:
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'raporlar',
// TODO: translate the following:
// 'menu.charts' => 'Charts',
'menu.projects' => 'projeler',
// TODO: translate the following:
// 'menu.tasks' => 'Tasks',
// 'menu.users' => 'Users',
'menu.teams' => 'ekipler',
// TODO: translate the following:
// 'menu.export' => 'Export',
'menu.clients' => 'müşteriler',
// TODO: translate the following:
// 'menu.options' => 'Options',

// Footer - strings on the bottom of most pages.
// TODO: translate the following:
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
// 'footer.credits' => 'Credits',
// 'footer.license' => 'License',
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following:
// 'error.access_denied' => 'Access denied.',
// 'error.sys' => 'System error.',
'error.db' => 'veritabanı hatası',
'error.field' => 'hatalı veri "{0}"',
'error.empty' => 'alan "{0}" boştur',
'error.not_equal' => 'alan "{0}" "{1}" alanıyla aynı değildir',
'error.interval' => 'hatalı aralık',
'error.project' => 'proje seç',
'error.activity' => 'faaliyet seç',
'error.auth' => 'hatalı kullanıcı adı veya parola',
// Note to translators: this string needs to be translated.
// 'error.user_exists' => 'user with this login already exists',
'error.project_exists' => 'bu isimde proje zaten vardır',
'error.activity_exists' => 'bu isimli faaliyet zaten vardır',
// TODO: translate error.client_exists.
// 'error.client_exists' => 'client with this name already exists',
// Note to translators: this string needs to be properly translated (e-mail replaced with login).
// 'error.no_login' => 'bu e-posta adresini kullanan kullanıcı yoktur',
'error.upload' => 'dosya yükleme hatası',
// TODO: Translate the following:
// 'error.range_locked' => 'Date range is locked.',
// 'error.mail_send' => 'error sending mail',
// 'error.no_email' => 'no email associated with this login',
// 'error.uncompleted_exists' => 'uncompleted entry already exists. close or delete it.',
// 'error.goto_uncompleted' => 'go to uncompleted entry.',

// labels for various buttons
'button.login' => 'giriş',
'button.now' => 'şimdi',
// 'button.set' => 'ayarla',
'button.save' => 'kaydet',
'button.delete' => 'sil',
'button.cancel' => 'iptal',
'button.submit' => 'gönder',
'button.add_user' => 'kullanıcı ekle',
'button.add_project' => 'proje ekle',
'button.add_activity' => 'faaliyet ekle',
'button.add_client' => 'müşteri ekle',
'button.add' => 'ekle',
'button.generate' => 'yarat',
// Note to translators: button.reset_password needs an improved translation.
'button.reset_password' => 'git',
'button.send' => 'gönder',
'button.send_by_email' => 'e-posta ile gönder',
'button.save_as_new' => 'yeni olarak kaydet',
'button.create_team' => 'ekip yarat',
// TODO: improve translation of button.export
// 'button.export' => 'ekibi dılarıya aktar',
'button.import' => 'ekibi içeri aktar',
'button.apply' => 'uygula',

// labels for controls on various forms
// TODO: translate label.team_name
// 'label.team_name' => 'team name',
'label.currency' => 'para birimi',
// TODO: translate label.manager_name and label.manager_login.
// 'label.manager_name' => 'manager name',
// 'label.manager_login' => 'manager login',
'label.password' => 'parola',
'label.confirm_password' => 'parolayı tekrala',
'label.email' => 'e-posta',
'label.total' => 'toplam',
// Translate the following string.
// 'label.page' => 'Page',

// Form titles.
// TODO: the entire title section is missing here. See the English file.

"form.filter.project" => 'proje',
"form.filter.filter" => 'sık kullanılan rapor',
"form.filter.filter_new" => 'sık kullanılan olarak kaydet',
// Note to translators: the string below is missing and must be translated and added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'giriş',
// Note to translators: "form.login.login" => 'e-posta', // e-mail has been changed to login

// password reminder form attributes
"form.fpass.title" => 'parolayı sıfırla',
// Note to translators: "form.fpass.login" => 'e-posta', // e-mail has been changed to login
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
"form.admin.lock.period" => 'günler olarak kilit aralığı',
// Note to translators: the strings below are missing and must be translated and added
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
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
"form.mytime.behalf" => 'kişiye yönelik günlük çalışma',
"form.mytime.daily" => 'günlük çalışma',
"form.mytime.total" => 'toplam saat: ',
"form.mytime.th.project" => 'proje',
"form.mytime.th.activity" => 'faaliyet',
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
"form.report.groupby_activity" => 'faaliyet',
"form.report.duration" => 'süre',
"form.report.start" => 'başlangıç',
"form.report.activity" => 'faaliyet',
"form.report.show_idle" => 'durağanı göster',
"form.report.finish" => 'son',
"form.report.note" => 'not',
"form.report.project" => 'proje',
"form.report.totals_only" => 'sadece toplamlar',
"form.report.total" => 'saat toplamı',
"form.report.th.empllist" => 'kullanıcı',
"form.report.th.date" => 'tarih',
"form.report.th.project" => 'proje',
"form.report.th.activity" => 'faaliyet',
"form.report.th.start" => 'başlangıç',
"form.report.th.finish" => 'son',
"form.report.th.duration" => 'süre',
"form.report.th.note" => 'not',

// mail form attributes
"form.mail.from" => 'kimden',
"form.mail.to" => 'kime',
"form.mail.cc" => 'bilgi',
"form.mail.subject" => 'konu',
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
"form.invoice.yourcoo" => 'isminiz<br> ve adresiniz',
"form.invoice.custcoo" => 'müşterinin ismi<br> ve adresi',
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
"form.client.yourcoo" => 'faturada isminiz<br> ve adresiniz',
"form.client.custcoo" => 'adres',
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

"label.pinfo" => '%, %',
"label.pinfo2" => '%',
"label.pbehalf_info" => '% % <b>% adına</b>',
"label.pminfo" => ' (yönetici)',
"label.pcminfo" => ' (yardımcı yönetici)',
"label.painfo" => ' (sistem yönetici)',
"label.time_noentry" => 'giriş yok',
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
// Note to translators: the strings below are missing and must be added and translated
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
// "label.calendar_today" => 'today',
// "label.calendar_close" => 'close',

// login hello text
// "login.hello.text" => "Anuko Time Tracker is a simple, easy to use, open source time tracking system.",
);
