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

$i18n_language = 'עברית';
$i18n_months = array('ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר');
$i18n_weekdays = array('ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת');
$i18n_weekdays_short = array('א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ז');
// format mm/dd
$i18n_holidays = array('02/10', '04/09', '04/15', '04/29', '05/29', '09/19', '09/20', '09/28', '10/03', '10/10');

$i18n_key_words = array(
'language.rtl' => 'true', // Right-to-left language. Do not remove this line from RTL language files. This is the only string that is not found in the master English file.

// Menus - short selection strings that are displayed on the top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'כניסה',
'menu.logout' => 'יציאה',
'menu.forum' => 'פורום',
'menu.help' => 'עזרה',
'menu.create_team' => 'צור צוות',
'menu.profile' => 'פרופיל',
'menu.time' => 'זמן',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'דוחות',
'menu.charts' => 'תרשימים',
'menu.projects' => 'פרוייקטים',
'menu.tasks' => 'משימות',
'menu.users' => 'משתמשים',
'menu.teams' => 'צוותים',
'menu.export' => 'ייצוא',
'menu.clients' => 'לקוחות',
'menu.options' => 'אפשרויות',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'קרדיטס',
'footer.license' => 'רשיון',
// TODO: translate the following.
// 'footer.improve' => 'Contribute', // Translators: this could mean "Improve", if it makes better sense in your language.
                                     // This is a link to a webpage that describes how to contribute to the project.

// Error messages.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
'error.sys' => 'שגיאת מערכת',
'error.db' => 'שגיאה של בסיס הנתונים',
'error.field' => 'נתון "{0}" שגוי',
'error.empty' => 'השדה "{0}" ריק',
'error.not_equal' => 'השדה "{1}" אינו שווה לשדה "{0}"',
// TODO: add quotes around field names in error.interval.
'error.interval' => 'השדדה {0} צריך להיות גדול יותר מהשדה {1}',
// TO TEST: change the string on a local Time Tracker and then try to enter a time with
// end time less than start time. For example: Start time: 09:00, End time: 08:00.
// Then you should see the error on screen and the problems will be clearly visible.
'error.project' => 'בחר פרוייקט',
'error.task' => 'בחר משימה',
'error.client' => 'בחר לקוח',
// TODO: translate the following.
// 'error.report' => 'Select report.',
'error.auth' => 'שם משתמש או סיסמה שגויים',
'error.user_exists' => 'שם משתמש כבר קיים',
'error.project_exists' => 'שם פרוייקט כבר קיים',
'error.task_exists' => 'קיימת משימה עם שם דומה',
'error.client_exists' => 'שם לקוח כבר קיים',
'error.invoice_exists' => 'קיימת חשבונית עם מספר זה',
'error.no_invoiceable_items' => 'אין פריטים לחיוב',
'error.no_login' => 'משתמש זה אינו קיים',
'error.no_teams' => 'בסיס הנתונים שלך ריק. התחבר כמנהל וצור צוות חדש',
'error.upload' => 'שגיאה בהעלת קובץ',
// TODO: translate the following.
// 'error.range_locked' => 'Date range is locked.',
'error.mail_send' => 'שגיאה בשליחת הדואר אלקטרוני',
'error.no_email' => 'אין דואר אלקטרוני השייך לשם משתמש זה',
'error.uncompleted_exists' => 'רישום חלקי כבר קיים. סגור או מחק אותו.',
'error.goto_uncompleted' => 'פתח את הרישום החלקי.',
'error.overlap' => 'טווח הזמן מתנגש עם רישומים קיימים.',
// TODO: translate the following.
// 'error.future_date' => 'Date is in future.',

// Labels for buttons.
'button.login' => 'היכנס',
'button.now' => 'עכשיו',
'button.save' => 'שמור',
'button.copy' => 'העתק',
'button.cancel' => 'ביטול',
'button.submit' => 'שלח',
'button.add_user' => 'הוסף משתמש',
'button.add_project' => 'הוסף פרוייקט',
'button.add_task' => 'הוסף משימה',
'button.add_client' => 'הוסף לקוח',
'button.add_invoice' => 'הוסף חשבונית',
'button.add_option' => 'הוסף אפשרות',
'button.add' => 'הוסף',
'button.generate' => 'הרץ',
'button.reset_password' => 'איפוס סיסמה',
'button.send' => 'שלח',
'button.send_by_email' => 'שלח בדואר אלקטרוני',
'button.create_team' => 'צור צוות',
'button.export' => 'ייצא צוות',
'button.import' => 'ייבא צוות',
'button.close' => 'סגור',
'button.stop' => 'עצור',
// TODO: translate the following.
// 'button.mark_paid' => 'Mark paid',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'שם הצוות',
'label.address' => 'כתובת',
'label.currency' => 'מטבע',
'label.manager_name' => 'שם של המנהל',
'label.manager_login' => 'שם משתמש של המנהל',
'label.person_name' => 'שם',
'label.thing_name' => 'שם',
'label.login' => 'שם משתמש',
'label.password' => 'סיסמה',
'label.confirm_password' => 'בדיקת סיסמה',
'label.email' => 'דואר אלקטרוני',
'label.cc' => 'העתק',
// TODO: translate the following.
// 'label.bcc' => 'Bcc',
'label.subject' => 'נושא',
'label.date' => 'תאריך',
'label.start_date' => 'תאריך התחלה',
'label.end_date' => 'תאריך סיום',
'label.user' => 'משתמש',
'label.users' => 'משתמשים',
'label.client' => 'לקוח',
'label.clients' => 'לקוחות',
// TODO: translate the following.
// 'label.option' => 'Option',
'label.invoice' => 'חשבונית',
'label.project' => 'פרוייקט',
'label.projects' => 'פרוייקטים',
'label.task' => 'משימה',
'label.tasks' => 'משימות',
'label.description' => 'תיאור',
'label.start' => 'התחלה',
'label.finish' => 'סיום',
'label.duration' => 'משך זמן',
'label.note' => 'הערה',
// TODO: translate the following.
// 'label.notes' => 'Notes',
// 'label.item' => 'Item',
'label.cost' => 'עלות',
'label.day_total' => 'סיכום יומי',
'label.week_total' => 'סיכום שבועי',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'היום',
'label.total_hours' => 'סך הכל שעות',
'label.total_cost' => 'סך הכל עלות',
'label.view' => 'הצג',
'label.edit' => 'ערוך',
'label.delete' => 'מחק',
'label.configure' => 'הגדר',
'label.select_all' => 'בחר הכל',
'label.select_none' => 'בטל בחירה',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'מזהה',
'label.language' => 'שפה',
// TODO: translate the following.
// 'label.decimal_mark' => 'Decimal mark',
'label.date_format' => 'תבנית של תאריך',
'label.time_format' => 'תבנית של שעה',
'label.week_start' => 'היום הראשון בשבוע',
'label.comment' => 'הערה',
'label.status' => 'סטטוס',
'label.tax' => 'מעמ',
'label.subtotal' => 'סיכום חלקי',
'label.total' => 'סך הכל',
'label.client_name' => 'שם הלקוח',
'label.client_address' => 'כתובת הלקוח',
'label.or' => 'או',
'label.error' => 'שגיאה',
'label.ldap_hint' => 'הכנס את <b>שם המשתמש</b> ואת <b>הסיסמה</b> של ווינדוז בשדות.',
'label.required_fields' => '* - שדות חובה',
'label.on_behalf' => 'מטעם',
'label.role_manager' => '(מנהל)',
'label.role_comanager' => '(מנהל משנה)',
'label.role_admin' => '(מנהל המערכת)',
// Translate the following.
// 'label.page' => 'Page',
// 'label.condition' => 'Condition',
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'שדות אישיים',
// Translate the following.
// 'label.monthly_quotas' => 'Monthly quotas',
'label.type' => 'סוג',
'label.type_dropdown' => 'רשימה',
'label.type_text' => 'טקסט',
'label.required' => 'חובה',
'label.fav_report' => 'דוח מועדף',
// TODO: translate the following.
// 'label.cron_schedule' => 'Cron schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',

// Form titles.
'title.login' => 'כניסה',
'title.teams' => 'צוותים',
'title.create_team' => 'יצירת צוות',
// TODO: translate the following.
// 'title.edit_team' => 'Editing Team',
'title.delete_team' => 'מחיקת צוות',
'title.reset_password' => 'איפוס סיסמה',
'title.change_password' => 'שינוי סיסמה',
'title.time' => 'זמן',
'title.edit_time_record' => 'עריכת רשומה',
'title.delete_time_record' => 'מחיקת רשומה',
// TODO: translate the following.
// 'title.expenses' => 'Expenses',
// 'title.edit_expense' => 'Editing Expense Item',
// 'title.delete_expense' => 'Deleting Expense Item',
'title.reports' => 'דוחות',
'title.report' => 'דוח',
'title.send_report' => 'שליחת דוח',
'title.invoice' => 'חשבונית',
'title.send_invoice' => 'שליחת חשבונית',
'title.charts' => 'תרשימים',
'title.projects' => 'פרוייקטים',
'title.add_project' => 'הוסף פרוייקט',
'title.edit_project' => 'עריכת פרוייקט',
'title.delete_project' => 'מחיקת פרוייקט',
'title.tasks' => 'משימות',
'title.add_task' => 'הוסף משימה',
'title.edit_task' => 'ערוך משימה',
'title.delete_task' => 'מחק משימה',
'title.users' => 'משתמשים',
'title.add_user' => 'הוספת משתמש',
'title.edit_user' => 'עריכת משתמש',
'title.delete_user' => 'מחיקת משתמש',
'title.clients' => 'לקוחות',
'title.add_client' => 'הוספת לקוח',
'title.edit_client' => 'עריכת לקוח',
'title.delete_client' => 'מחיקת לקוח',
'title.invoices' => 'חשבוניות',
'title.add_invoice' => 'הוספת חשבונית',
'title.view_invoice' => 'הצגת חשבונית',
'title.delete_invoice' => 'מחיקת חשבונית',
// TODO: translate the following.
// 'title.notifications' => 'Notifications',
// 'title.add_notification' => 'Adding Notification',
// 'title.edit_notification' => 'Editing Notification',
// 'title.delete_notification' => 'Deleting Notification',
// 'title.monthly_quotas' => 'Monthly Quotas',
'title.export' => 'ייצוא נתוני צוות',
'title.import' => 'ייבוא נתוני צוות',
'title.options' => 'אפשרויות',
'title.profile' => 'פרופיל',
'title.cf_custom_fields' => 'שדות אישיים',
'title.cf_add_custom_field' => 'הוספת שדה אישי',
'title.cf_edit_custom_field' => 'עריכת שדה אישי',
'title.cf_delete_custom_field' => 'מחיקת שדה אישי',
'title.cf_dropdown_options' => 'אפשרויות רשימה',
'title.cf_add_dropdown_option' => 'הוספת אפשרות',
'title.cf_edit_dropdown_option' => 'עריכת אפשרות',
'title.cf_delete_dropdown_option' => 'מחיקת אפשרות',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the Team profile page.
// TODO: translate the following.
// 'title.locking' => 'Locking',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- כולם ---',
'dropdown.no' => '--- ללא ---',
// TODO: translate the following.
// 'dropdown.current_day' => 'today',
// 'dropdown.previous_day' => 'yesterday',
// 'dropdown.selected_day' => 'day',
'dropdown.current_week' => 'שבוע זה',
'dropdown.previous_week' => 'שבוע שעבר',
'dropdown.selected_week' => 'שבוע',
'dropdown.current_month' => 'חודש זה',
'dropdown.previous_month' => 'החודש שעבר',
'dropdown.selected_month' => 'החודש',
'dropdown.current_year' => 'שנה זו',
// TODO: translate the following.
// 'dropdown.previous_year' => 'previous year',
'dropdown.selected_year' => 'שנה',
'dropdown.all_time' => 'הכל',
'dropdown.projects' => 'פרוייקטים',
'dropdown.tasks' => 'משימות',
'dropdown.clients' => 'לקוחות',
// TODO: translate the following.
// 'dropdown.select' => '--- select ---',
'dropdown.select_invoice' => '--- בחר חשבונית ---',
'dropdown.status_active' => 'פעיל',
'dropdown.status_inactive' => 'לא פעיל',
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
'form.login.forgot_password' => 'שכחת סיסמה?',
'form.login.about' =>'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> הינה מערכת פשוטה, קלה לשימוש וחינמית לניהול זמן.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'הבקשה לאיפוס בסיסמה נשלחה בדואר אלקטרוני.',
'form.reset_password.email_subject' => 'בקשה לאיפוס סיסמה למערכת Anuko Time Tracker',
'form.reset_password.email_body' => "משתמש יקר,\n\n התקבלה בקשה לאיפוס סיסמתך. נא ללחוץ על קישור זה אם ברצונך לאפס את הסיסמה.\n\n%s\n\n. Anuko Time Tracker הינה מערכת לניהול זמן פשוטה וחינמית. בקר באתרנו בכתובת https://www.anuko.com לפרטים נוספים.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'הכנס סיסמה חדשה ולחץ על שמירה',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm או 0.0h)',
'form.time.billable' => 'לחיוב',
'form.time.uncompleted' => 'רישום חסר',
// TODO: translate the following.
// 'form.time.remaining_quota' => 'Remaining quota',
// 'form.time.over_quota' => 'Over quota',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'רישום זה נשמר עם שעת התחלה בלבד. זאת איננה טעות.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'שמור כמועדף',
'form.reports.confirm_delete' => 'האם ברצונך למחוק את הדוח המועדף הזה ?',
'form.reports.include_records' => 'כלול רישומים',
'form.reports.include_billable' => 'לחיוב',
'form.reports.include_not_billable' => 'לא לחיוב',
// TODO: translate the following.
// 'form.reports.include_invoiced' => 'invoiced',
// 'form.reports.include_not_invoiced' => 'not invoiced',
'form.reports.select_period' => 'בחר תקופת זמן',
'form.reports.set_period' => 'או הגדר תאריכים',
'form.reports.show_fields' => 'הראה שדות',
'form.reports.group_by' => 'סדר לפי',
'form.reports.group_by_no' => '--- ללא סדר ---',
'form.reports.group_by_date' => 'תאריך',
'form.reports.group_by_user' => 'משתמש',
'form.reports.group_by_client' => 'לקוח',
'form.reports.group_by_project' => 'פרוייקט',
'form.reports.group_by_task' => 'משימה',
'form.reports.totals_only' => 'סיכומים בלבד',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
// TODO: form.report.export is just "Export" now in the English file. Shorten this translation.
'form.report.export' => 'ייצא נתונים בתבנית',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'מספר חשבונית',
'form.invoice.person' => 'משתמש',
// TODO: translate the following stings.
// 'form.invoice.invoice_to_delete' => 'Invoice to delete',
// 'form.invoice.invoice_entries' => 'Invoice entries',
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'טווח',
'form.charts.chart' => 'תרשים',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'פרוייקטים פעילים',
'form.projects.inactive_projects' => 'פרוייקטים לא פעילים',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'משימות פעילות',
'form.tasks.inactive_tasks' => 'משימות לא פעילות',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'משתמשים פעילים',
'form.users.inactive_users' => 'משתמשים לא פעילים',
// TODO: translate the following.
// 'form.users.uncompleted_entry' => 'User has an uncompleted time entry',
'form.users.role' => 'תפקיד',
'form.users.manager' => 'מנהל',
'form.users.comanager' => 'מנהל משנה',
'form.users.rate' => 'תעריף',
'form.users.default_rate' => 'תעריף ברירת מחדל לשעה',

// Client delete form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'לקוחות פעילים',
'form.clients.inactive_clients' => 'לקוחות לא פעילים',

// Strings for Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'ניתן לייצא את כל נתוני הצוות בקובץ XML. זה מאד שימושי אם ברצונך להשתמש בשרת משלך.',
'form.export.compression' => 'דחיסה',
'form.export.compression_none' => 'ללא',
'form.export.compression_bzip' => 'bzip',

// Strings for Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'ייבא נתוני צוות מתוך קובץ XML.',
'form.import.file' => 'בחר קובץ',
'form.import.success' => 'הייבוא הושלם בהצלחה.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' => 'ניתן ליצור צוות חדש על-ידי יצירת מנהל צוות חדש.<br>ניתן לייבא נתוני צוות מקובץ XML משרת Anuko Time Tracker אחר (אין אפשרות לשמות משתמש זהים)',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12 שעות',
'form.profile.24_hours' => '24 שעות',
'form.profile.tracking_mode' => 'סוג מעקב',
'form.profile.mode_time' => 'זמן',
'form.profile.mode_projects' => 'פרוייקטים',
'form.profile.mode_projects_and_tasks' => 'פרוייקטים ומשימות',
'form.profile.record_type' => 'סוג רישום',
'form.profile.type_all' => 'הכל',
'form.profile.type_start_finish' => 'התחלה וסיום',
'form.profile.type_duration' => 'משך זמן',
'form.profile.plugins' => 'תוספים',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'מאת',
'form.mail.to' => 'אל',
'form.mail.report_subject' => 'דוח Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker הינה מערכת פשוטה, קלה לשימוש וחינמית לניהול זמן. בקר באתר <a href="https://www.anuko.com">www.anuko.com</a> לפרטים נוספים.',
'form.mail.report_sent' => 'הדוח נשלח.',
'form.mail.invoice_sent' => 'החשבונית נשלחה.',

// Quotas configuration form.
// TODO: translate the following.
// 'form.quota.year' => 'Year',
// 'form.quota.month' => 'Month',
// 'form.quota.quota' => 'Quota',
// 'form.quota.workday_hours' => 'Hours in a work day',
// 'form.quota.hint' => 'If values are empty, quotas are calculated automatically based on workday hours and holidays.',
);
