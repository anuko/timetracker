<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: escape apostrophes with THREE backslashes, like here:  choisir l\\\'option.
// Other characters (such as double-quotes in http links, etc.) do not have to be escaped.
$i18n_language = 'Persian (فارسی)';
// TODO: translate the following.
$i18n_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$i18n_weekdays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$i18n_weekdays_short = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');

$i18n_key_words = array(
'language.rtl' => 'true', // Right-to-left language. Do not remove this line from RTL language files. This is the only string that is not found in the master English file.

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'ورود',
'menu.logout' => 'خروج',
'menu.forum' => 'فروم',
'menu.help' => 'راهنما',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'پروفايل',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.plugins' => 'پلاگین ها',
'menu.time' => 'زمان',
// TODO: translate the following.
// 'menu.puncher' => 'Punch',
// 'menu.week' => 'Week',
'menu.expenses' => 'هزينه ها',
'menu.reports' => 'گزارشات',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
'menu.charts' => 'نمودارها',
'menu.projects' => 'پروژه ها',
'menu.tasks' => 'وظايف',
'menu.users' => 'کاربران',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
'menu.export' => 'پشتیبانی',
'menu.clients' => 'مشتری ها',
'menu.options' => 'تنظیمات',

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
'error.sys' => 'خطا در سیستم.',
'error.db' => 'خطا در پایگاه داده.',
// TODO: translate the following.
// 'error.registered_recently' => 'Registered recently.',
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'داده اشتباه در "{0}".',
'error.empty' => 'فیلد "{0}" خالیست.',
'error.not_equal' => 'فیلد "{0}" با فیلد "{1}" برابر نیست.',
// TODO: translate the following.
// 'error.interval' => 'Field "{0}" must be greater than "{1}".',
'error.project' => 'انتخاب پروژه.',
'error.task' => 'انتخاب وظیفه.',
'error.client' => 'انتخاب مشتری.',
// TODO: translate the following.
// 'error.report' => 'Select report.',
// 'error.record' => 'Select record.',
'error.auth' => 'نام کاربری یا رمز عبور اشتباه است.',
'error.user_exists' => 'کاربری با این نام کاربری موجود است.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.invoice_exists' => 'فاکتوری با این شماره هم اکنون موجود است.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'آیتمی جهت فاکتور کردن وجود ندارد.',
// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
'error.no_login' => 'کاربری با این نام کاربری موجود نیست.',
'error.no_groups' => 'پایگاه داده شما خالی است با کاربر admin وارد شوید و تیم ایجاد کنید.',  // TODO: replace "team" with "group".
'error.upload' => 'خطا در آپلود فایل.',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'خطا در ارسال ایمیل.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => 'ایمیل مرتبط با این نام کاربری موجود نیست.',
// TODO: check translation and punctuation of error.uncompleted_exists. Is the sentence ending dot in the right place?
'error.uncompleted_exists' => 'قسمت ناتمامی موجود است. آن را تمام یا حذف کنید.',
'error.goto_uncompleted' => 'مراجعه به قسمت ناتمام.',
'error.overlap' => 'بازه زمانی با سوابق موجود هم پوشانی دارد.',
// TODO: translate the following.
// 'error.future_date' => 'Date is in future.',
// 'error.xml' => 'Error in XML file at line %d: %s.',
// 'error.cannot_import' => 'Cannot import: %s.',
// 'error.format' => 'Invalid file format.',
// 'error.user_count' => 'Limit on user count.',
// 'error.expired' => 'Expiration date reached.',
// TODO: translate the following.
// 'error.file_storage' => 'File storage server error.', // See comment in English file.
// 'error.remote_work' => 'Remote work server error.',   // See comment in English file.

// Warning messages.
// TODO: translate the following.
// 'warn.sure' => 'Are you sure?',
// 'warn.confirm_save' => 'Date has changed. Confirm saving, not copying this item.',

// Success messages.
// TODO: translate the following.
// 'msg.success' => 'Operation completed successfully.',

// Labels for buttons.
'button.login' => 'ورود',
'button.now' => 'هم اکنون',
'button.save' => 'ذخیره',
'button.copy' => 'کپی',
'button.cancel' => 'لغو',
'button.submit' => 'ثبت',
'button.add' => 'درج',
'button.delete' => 'حذف',
'button.generate' => 'تولید',
'button.reset_password' => 'بازسازی رمزعبور',
'button.send' => 'ارسال',
'button.send_by_email' => 'ارسال به ایمیل',
'button.create_group' => 'ایجاد تیم', // TODO: replace "team" with "group".
'button.export' => 'ایجاد پشتیبان از تیم', // TODO: replace "team" with "group".
'button.import' => 'وارد کردن تیم', // TODO: replace "team" with "group".
'button.close' => 'بستن',
// TODO: translate the following.
// 'button.start' => 'Start',
'button.stop' => 'توقف',
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',
// 'button.sync' => 'Sync', // Used in Android app. The meaning is to synchronize offline time records with server.

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
'label.group_name' => 'نام تیم', // TODO: replace "team" with "group".
'label.address' => 'آدرس',
'label.currency' => 'واحد پول',
'label.manager_name' => 'نام مدیر',
'label.manager_login' => 'نام کاربری مدیر',
'label.person_name' => 'نام',
'label.thing_name' => 'نام',
'label.login' => 'نام کاربری',
'label.password' => 'رمز عبور',
'label.confirm_password' => 'تکرار رمزعبور',
'label.email' => 'ایمیل',
'label.cc' => 'کپی',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'موضوع',
'label.date' => 'تاریخ',
'label.start_date' => 'تاریخ شروع',
'label.end_date' => 'تاریخ اتمام',
'label.user' => 'کاربر',
'label.users' => 'کاربران',
// TODO: translate the following.
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
// 'label.roles' => 'Roles',
'label.client' => 'مشتری',
'label.clients' => 'مشتریان',
// TODO: translate the following.
// 'label.option' => 'Option',
'label.invoice' => 'فاکتور',
'label.project' => 'پروژه',
'label.projects' => 'پروژه ها',
'label.task' => 'وظیفه',
'label.tasks' => 'وظیفه ها',
'label.description' => 'شرح',
'label.start' => 'شروع',
'label.finish' => 'اتمام',
'label.duration' => 'مدت زمان',
'label.note' => 'توضیح',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'آیتم',
'label.cost' => 'هزینه',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'کل روز',
'label.week_total' => 'کل هفته',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'امروز',
'label.view' => 'نمایش',
'label.edit' => 'ویرایش',
'label.delete' => 'حذف',
'label.configure' => 'پیکربندی',
'label.select_all' => 'انتخاب همه',
'label.select_none' => 'لغو انتخاب همه',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
// 'label.puncher' => 'Puncher',
'label.id' => 'شناسه',
'label.language' => 'زبان',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'قالب تاریخ',
'label.time_format' => 'قالب زمان',
'label.week_start' => 'روز اول هفته',
'label.comment' => 'توضیح',
'label.status' => 'وضعیت',
'label.tax' => 'مالیات',
'label.subtotal' => 'جمع جز',
'label.total' => 'کل',
'label.client_name' => 'نام مشتری',
'label.client_address' => 'آدرس مشتری',
'label.or' => 'یا',
'label.error' => 'خطا',
'label.ldap_hint' => '<b>نام کاربری ویندوز</b>و <b>رمزعبور</b>خود را در فیلدهای زیر وارد کنید',
'label.required_fields' => '* - فیلد های اجباری',
'label.on_behalf' => 'از دیدگاه',
'label.role_manager' => '(مدیر)',
'label.role_comanager' => '(دستیار مدیر)',
'label.role_admin' => '(مدیر ارشد)',
// Translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'فیلدهای سفارشی',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
// TODO: translate the following.
// 'label.entity' => 'Entity',
'label.type' => 'نوع',
'label.type_dropdown' => 'منو کشویی',
'label.type_text' => 'متن',
'label.required' => 'اجباری',
'label.fav_report' => 'گزارش های برگزیده',
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
// 'label.totals_only' => 'Totals only',
// 'label.quota' => 'Quota',
// 'label.timesheet' => 'Timesheet',
// 'label.submitted' => 'Submitted',
// 'label.approved' => 'Approved',
// 'label.approval' => 'Report approval',
// 'label.mark_approved' => 'Mark approved',
// 'label.template' => 'Template',
// 'label.bind_templates_with_projects' => 'Bind templates with projects',
// 'label.prepopulate_note' => 'Prepopulate Note field',
// 'label.attachments' => 'Attachments',
// 'label.files' => 'Files',
// 'label.file' => 'File',
'label.active_users' => 'کاربران فعال',
'label.inactive_users' => 'کاربران غیرفعال',
// TODO: translate the following.
// 'label.details' => 'Details',
// 'label.budget' => 'Budget',
// 'label.work' => 'Work',   // Table column header for work items, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.offer' => 'Offer', // Table column header for offers, see https://www.anuko.com/time_tracker/what_is/work_plugin.htm
// 'label.contractor' => 'Contractor', // Table column header for offers (contractor is someone who offers to do work).
                                       // Technically, it is either an org name or a combination of org and group names
                                       // because both work items and offers are owned by Time Tracker groups of users.
// 'label.how_to_pay' => 'How to pay', // Label for the "How to pay" field on offers, which allows contractors to specify
                                       // how to pay them, for example: paypal email, check by mail to a specific address, etc.
// 'label.moderator_comment' => 'Moderator comment', // Label for "Moderator comment" field that explains something.

// Entity names. We use lower case (in English) because they are used in dropdowns, too.
// They are used to associate a custom field with an entity type.
// TODO: translate the following.
// 'entity.time' => 'time',
// 'entity.user' => 'user',
// 'entity.project' => 'project',

// Form titles.
'title.error' => 'خطا',
// TODO: Translate the following.
// 'title.success' => 'Success',
'title.login' => 'ورود',
'title.groups' => 'تیم ها', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.add_group' => 'Adding Group',
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => 'حذف تیم', // TODO: change "team" to "group".
'title.reset_password' => 'بازیابی رمزعبور',
'title.change_password' => 'تغییر رمزعبور',
'title.time' => 'زمان',
'title.edit_time_record' => 'ویرایش رکورد زمان',
'title.delete_time_record' => 'حذف رکورد زمان',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
// 'title.puncher' => 'Puncher',
'title.expenses' => 'هزینه ها',
'title.edit_expense' => 'ویرایش آیتم هزینه ها',
'title.delete_expense' => 'حذف آیتم هزینه ها',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.reports' => 'گزارشات',
'title.report' => 'گزارش',
'title.send_report' => 'ارسال گزارش',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'فاکتور',
'title.send_invoice' => 'ارسال فاکتور',
'title.charts' => 'نمودارها',
'title.projects' => 'پروژه ها',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
'title.add_project' => 'درج پروژه',
'title.edit_project' => 'ویرایش پروژه',
'title.delete_project' => 'حذف پروژه',
'title.tasks' => 'وظایف',
'title.add_task' => 'درج وظیفه',
'title.edit_task' => 'ویرایش وظیفه',
'title.delete_task' => 'حذف وظیفه',
'title.users' => 'کاربران',
'title.add_user' => 'درج کاربر',
'title.edit_user' => 'ویرایش کاربر',
'title.delete_user' => 'حذف کاربر',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'مشتریان',
'title.add_client' => 'درج مشتری',
'title.edit_client' => 'ویرایش مشتری',
'title.delete_client' => 'حذف مشتری',
'title.invoices' => 'فاکتورها',
'title.add_invoice' => 'درج فاکتور',
'title.view_invoice' => 'نمایش فاکتور',
'title.delete_invoice' => 'حذف فاکتور',
// TODO: translate the following.
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'پشتیانی گرفتن از اطلاعات تیم', // TODO: replace "team" with "group".
'title.import' => 'وارد کردن اطلاعات تیم', // TODO: replace "team" with "group".
'title.options' => 'گزینه ها',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
'title.profile' => 'پروفایل',
'title.plugins' => 'پلاگین ها',
'title.cf_custom_fields' => 'فیلدهای سفارشی',
'title.cf_add_custom_field' => 'درج فیلد سفارشی',
'title.cf_edit_custom_field' => 'ویرایش فیلد سفارشی',
'title.cf_delete_custom_field' => 'حذف فیلد سفارشی',
'title.cf_dropdown_options' => 'گزینه های منو کشویی',
'title.cf_add_dropdown_option' => 'درج گزینه',
'title.cf_edit_dropdown_option' => 'ویرایش گزینه',
'title.cf_delete_dropdown_option' => 'حذف گزینه',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// TODO: translate the following.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',
// 'title.work_units' => 'Work Units',
// 'title.templates' => 'Templates',
// 'title.add_template' => 'Adding Template',
// 'title.edit_template' => 'Editing Template',
// 'title.delete_template' => 'Deleting Template',
// 'title.edit_file' => 'Editing File',
// 'title.delete_file' => 'Deleting File',
// 'title.download_file' => 'Downloading File',
// 'title.work' => 'Work',
// 'title.add_work' => 'Adding Work',
// 'title.edit_work' => 'Editing Work',
// 'title.delete_work' => 'Deleting Work',
// 'title.active_work' => 'Active Work', // Active work items this group outsources to other groups.
// 'title.available_work' => 'Available Work', // Available work items from other organizations.
// 'title.inactive_work' => 'Inactive Work', // Inactive work items this group was outsourcing to other groups.
// 'title.pending_work' => 'Pending Work', // Work items pending moderator approval.
// 'title.offer' => 'Offer',
// 'title.add_offer' => 'Adding Offer',
// 'title.edit_offer' => 'Editing Offer',
// 'title.delete_offer' => 'Deleting Offer',
// 'title.active_offers' => 'Active Offers', // Active offers this group makes available to other groups.
// 'title.available_offers' => 'Available Offers', // Available offers from other organizations.
// 'title.inactive_offers' => 'Inactive Offers', // Inactive offers for group.
// 'title.pending_offers' => 'Pending Offers', // Offers pending moderator approval.

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- همه ---',
'dropdown.no' => '--- هیچکدام ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
'dropdown.current_week' => 'هفته جاری',
'dropdown.previous_week' => 'هفته آخر',
// TODO: translate the following.
// 'dropdown.selected_week' => 'week',
'dropdown.current_month' => 'ماه جاری',
'dropdown.previous_month' => 'ماه آخر',
// TODO: translate the following.
// 'dropdown.selected_month' => 'month',
'dropdown.current_year' => 'سال جاری',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
// 'dropdown.selected_year' => 'year',
'dropdown.all_time' => 'همه زمان ها',
'dropdown.projects' => 'پروژه ها',
'dropdown.tasks' => 'وظایف',
'dropdown.clients' => 'مشتریان',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
'dropdown.select_invoice' => '--- انتخاب فاکتور ---',
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'فعال',
'dropdown.status_inactive' => 'غیرفعال',
// TODO: translate the following.
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.pending_approval' => 'pending approval',
// 'dropdown.approved' => 'approved',
// 'dropdown.not_approved' => 'not approved',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',
// 'dropdown.ascending' => 'ascending',
// 'dropdown.descending' => 'descending',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'بازیابی رمز عبور؟',
// TODO: translate form.login.about.
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> is an open source time tracking system.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'درخواست بازیابی رمزعبور به ایمیل فرستاده شد.',
// TODO: check translation of form.reset_password.email_subject. This is the subject for email message for password reset. Below is the English original.
// 'form.reset_password.email_subject' => 'Anuko Time Tracker password reset request',
'form.reset_password.email_subject' => 'درخواست بازیابی رمزعبور فرستاده شد',
// TODO: English string has changed. Re-translate.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is an open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// Older translation is below.
// 'form.reset_password.email_body' => "کاربران گرامی\n\n یک نفر، شاید خودتان، درخواست بازیابی رمزعبور نرم افزار رهگیری زمان شما را داشته است.لطفا برای تغییر رمزعبور روی لینک زیر کلیک کنید: \n\n%s\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'رمز عبور جدید را وارد کنید سپس روی ذخیره کلیک کنید',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm یا 0.0h)',
'form.time.billable' => 'قابل پرداخت',
'form.time.uncompleted' => 'ناتمام',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
// TODO: translate form.time_edit.uncompleted. 
'form.time_edit.uncompleted' => 'This record was saved with only start time. It is not an error.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'ذخیره به عنوان برگزیده',
'form.reports.confirm_delete' => 'آیا می خواهید گزارش برگزیده حذف شود؟',
'form.reports.include_billable' => 'قابل پرداخت',
'form.reports.include_not_billable' => 'غیرقابل پرداخت',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'انتخاب بازه زمانی',
'form.reports.set_period' => 'یا تعیین تاریخ',
'form.reports.show_fields' => 'نمایش فیلدها',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'گروه بندی شده با',
'form.reports.group_by_no' => '--- بدون گروه ---',
'form.reports.group_by_date' => 'تاریخ',
'form.reports.group_by_user' => 'کاربر',
'form.reports.group_by_client' => 'مشتری',
'form.reports.group_by_project' => 'پروژه',
'form.reports.group_by_task' => 'وظیفه',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'پشتیبانی',
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',
// 'form.report.assign_to_timesheet' => 'Assign to timesheet',

// Timesheets form. See example at https://timetracker.anuko.com/timesheets.php
// TODO: translate the following.
// 'form.timesheets.active_timesheets' => 'Active Timesheets',
// 'form.timesheets.inactive_timesheets' => 'Inactive Timesheets',

// Templates form. See example at https://timetracker.anuko.com/templates.php
// TODO: translate the following.
// 'form.templates.active_templates' => 'Active Templates',
// 'form.templates.inactive_templates' => 'Inactive Templates',

// Invoice form. See example at https://timetracker.anuko.com/invoice_view.php
// (you can get to this form after generating an invoice).
'form.invoice.number' => 'شماره فاکتور',
'form.invoice.person' => 'شخص',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// TODO: translate the following stings.
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'بازه',
'form.charts.chart' => 'نمودار',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'پروژه های فعال',
'form.projects.inactive_projects' => 'پروژه های غیرفعال',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'وظایف فعال',
'form.tasks.inactive_tasks' => 'وظایف غیرفعال',

// Users form. See example at https://timetracker.anuko.com/users.php
 // TODO: translate the following.
 // 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'سمت',
'form.users.manager' => 'مدیر',
'form.users.comanager' => 'دستیار مدیر',
'form.users.rate' => 'نرخ',
'form.users.default_rate' => 'نرخ ساعتی پیش فرض',

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

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'مشتری های فعال',
'form.clients.inactive_clients' => 'مشتری های غیرفعال',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'می توانید از همه اطلاعات تیم یک پشتیبان به فرمت xml تهیه کنید. اگر میخواهید داده ها را به سرور خودتان منتقل کنید این قسمت می تواند مفید باشد.',
'form.export.compression' => 'فشرده سازی',
'form.export.compression_none' => 'هیچ کدام',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'وارد کردن اطلاعات تیم از یک فایل xml', // TODO: replace "team" with "group".
'form.import.file' => 'انتخاب فایل',
'form.import.success' => 'وارد کردن اطلاعات با موفقیت انجام شد',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: translate form.groups.hint.
// 'form.groups.hint' => 'Create a new group by creating a new group manager account.<br>You can also import group data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 ساعت',
'form.group_edit.24_hours' => '24 ساعت',
// TODO: translate the following.
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
'form.group_edit.tracking_mode' => 'حالت رهگیری',
'form.group_edit.mode_time' => 'زمان',
'form.group_edit.mode_projects' => 'پروژه ها',
'form.group_edit.mode_projects_and_tasks' => 'پروژه ها و وظایف',
'form.group_edit.record_type' => 'نوع رکورد',
'form.group_edit.type_all' => 'همه',
'form.group_edit.type_start_finish' => 'شروع و اتمام',
'form.group_edit.type_duration' => 'مدت زمان',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.confirm_save' => 'Confirm saving',
// 'form.group_edit.allow_ip' => 'Allow IP',
// 'form.group_edit.advanced_settings' => 'Advanced settings',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.to' => 'به',
'form.mail.report_subject' => 'گزارش تایم شیت',
// TODO: translate form.mail.footer.
// 'form.mail.footer' => 'Anuko Time Tracker is an open source<br>time tracking system. Visit <a href="https://www.anuko.com">www.anuko.com</a> for more information.',
'form.mail.report_sent' => 'گزارش ارسال شد.',
'form.mail.invoice_sent' => 'فاکتور ارسال شد.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Work Units configuration form. See example at https://timetracker.anuko.com/work_units.php after enabling Work units plugin.
// TODO: translate the following.
// 'form.work_units.minutes_in_unit' => 'Minutes in unit',
// 'form.work_units.1st_unit_threshold' => '1st unit threshold',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
// TODO: translate the following.
// 'role.user.label' => 'User',
// 'role.user.low_case_label' => 'user',
// 'role.user.description' => 'A regular member without management rights.',
// 'role.client.label' => 'Client',
// 'role.client.low_case_label' => 'client',
// 'role.client.description' => 'A client can view its own data.',
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

// Timesheet View form. See example at https://timetracker.anuko.com/timesheet_view.php.
// TODO: translate the following.
// 'form.timesheet_view.submit_subject' => 'Timesheet approval request',
// 'form.timesheet_view.submit_body' => "A new timesheet requires approval.<p>User: %s.",
// 'form.timesheet_view.approve_subject' => 'Timesheet approved',
// 'form.timesheet_view.approve_body' => "Your timesheet %s was approved.<p>%s",
// 'form.timesheet_view.disapprove_subject' => 'Timesheet not approved',
// 'form.timesheet_view.disapprove_body' => "Your timesheet %s was not approved.<p>%s",

// Display Options form. See example at https://timetracker.anuko.com/display_options.php.
// TODO: translate the following.
// 'form.display_options.note_on_separate_row' => 'Note on separate row',
// 'form.display_options.not_complete_days' => 'Not complete days',
// 'form.display_options.inactive_projects' => 'Inactive projects',
// 'form.display_options.custom_css' => 'Custom CSS',

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
