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

$i18n_language = 'Hebrew (עברית)';
$i18n_months = array('ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר');
$i18n_weekdays = array('ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת');
$i18n_weekdays_short = array('א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ז');
// format mm/dd
$i18n_holidays = array('02/10', '04/09', '04/15', '04/29', '05/29', '09/19', '09/20', '09/28', '10/03', '10/10');

$i18n_key_words = array(
'language.rtl' => 'true', // Right-to-left language. Do not remove this line from RTL language files. This is the only string that is not found in the master English file.

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'כניסה',
'menu.logout' => 'יציאה',
'menu.forum' => 'פורום',
'menu.help' => 'עזרה',
// TODO: translate the following.
// 'menu.create_group' => 'Create Group',
'menu.profile' => 'פרופיל',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.time' => 'זמן',
// TODO: translate the following.
// 'menu.expenses' => 'Expenses',
'menu.reports' => 'דוחות',
'menu.charts' => 'תרשימים',
'menu.projects' => 'פרוייקטים',
'menu.tasks' => 'משימות',
'menu.users' => 'משתמשים',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
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
// TODO: All error messages should be complete sentences with a period (full stop) in the end. Put them there.
// TODO: translate the following.
// 'error.access_denied' => 'Access denied.',
'error.sys' => 'שגיאת מערכת',
'error.db' => 'שגיאה של בסיס הנתונים',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'נתון "{0}" שגוי',
'error.empty' => 'השדה "{0}" ריק',
'error.not_equal' => 'השדה "{1}" אינו שווה לשדה "{0}"',
// TODO: add quotes around field names in error.interval.
'error.interval' => 'השדדה {0} צריך להיות גדול יותר מהשדה {1}',
// TO TEST: change the string on a local Time Tracker and then try to enter a time with
// end time less than start time. For example: Start time: 09:00, End time: 08:00.
// Then you should see the error on screen and the problems will be clearly visible.
// Currently the output is as:
// השדדה סיום צריך להיות גדול יותר מהשדה התחלה
// Compare the above with English, where the field names are surrounded with quotes,
// and it is easier to identify which fields the error is about.
// English variation: Field "Finish" must be greater than "Start".
'error.project' => 'בחר פרוייקט',
'error.task' => 'בחר משימה',
'error.client' => 'בחר לקוח',
// TODO: translate the following.
// 'error.report' => 'Select report.'
// 'error.record' => 'Select record.',
'error.auth' => 'שם משתמש או סיסמה שגויים',
'error.user_exists' => 'שם משתמש כבר קיים',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.project_exists' => 'שם פרוייקט כבר קיים',
'error.task_exists' => 'קיימת משימה עם שם דומה',
'error.client_exists' => 'שם לקוח כבר קיים',
'error.invoice_exists' => 'קיימת חשבונית עם מספר זה',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'אין פריטים לחיוב',
'error.no_login' => 'משתמש זה אינו קיים',
'error.no_groups' => 'בסיס הנתונים שלך ריק. התחבר כמנהל וצור צוות חדש', // TODO: replace "team" with "group".
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
'button.add' => 'הוסף',
'button.delete' => 'מחק',
'button.generate' => 'הרץ',
'button.reset_password' => 'איפוס סיסמה',
'button.send' => 'שלח',
'button.send_by_email' => 'שלח בדואר אלקטרוני',
'button.create_group' => 'צור צוות', // TODO: replace "team" with "group".
'button.export' => 'ייצא צוות', // TODO: replace "team" with "group".
'button.import' => 'ייבא צוות', // TODO: replace "team" with "group".
'button.close' => 'סגור',
'button.stop' => 'עצור',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'שם הצוות', // TODO: replace "team" with "group".
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
// TODO: translate the following.
// 'label.roles' => 'Roles',
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
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'סיכום יומי',
'label.week_total' => 'סיכום שבועי',
// TODO: translate the following.
// 'label.month_total' => 'Month total',
'label.today' => 'היום',
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
// 'label.schedule' => 'Schedule',
// 'label.what_is_it' => 'What is it?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',

// Form titles.
'title.login' => 'כניסה',
'title.groups' => 'צוותים', // TODO: change "teams" to "groups".
'title.create_group' => 'יצירת צוות', // TODO: change "team" to "group".
// TODO: translate the following.
// 'title.edit_group' => 'Editing Group',
'title.delete_group' => 'מחיקת צוות', // TODO: change "team" to "group".
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
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
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
'title.export' => 'ייצוא נתוני צוות', // TODO: replace "team" with "group".
'title.import' => 'ייבוא נתוני צוות', // TODO: replace "team" with "group".
'title.options' => 'אפשרויות',
'title.profile' => 'פרופיל',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'שדות אישיים',
'title.cf_add_custom_field' => 'הוספת שדה אישי',
'title.cf_edit_custom_field' => 'עריכת שדה אישי',
'title.cf_delete_custom_field' => 'מחיקת שדה אישי',
'title.cf_dropdown_options' => 'אפשרויות רשימה',
'title.cf_add_dropdown_option' => 'הוספת אפשרות',
'title.cf_edit_dropdown_option' => 'עריכת אפשרות',
'title.cf_delete_dropdown_option' => 'מחיקת אפשרות',
// NOTE TO TRANSLATORS: Locking is a feature to lock records from modifications (ex: weekly on Mondays we lock all previous weeks).
// It is also a name for the Locking plugin on the group settings page.
// TODO: translate the following.
// 'title.locking' => 'Locking',
// 'title.week_view' => 'Week View',
// 'title.swap_roles' => 'Swapping Roles',

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
// 'dropdown.delete' => 'delete',
// 'dropdown.do_not_delete' => 'do not delete',
// 'dropdown.paid' => 'paid',
// 'dropdown.not_paid' => 'not paid',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'שכחת סיסמה?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> הינה מערכת פשוטה, קלה לשימוש וחינמית לניהול זמן.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'הבקשה לאיפוס בסיסמה נשלחה בדואר אלקטרוני.',
'form.reset_password.email_subject' => 'בקשה לאיפוס סיסמה למערכת Anuko Time Tracker',
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// Older translation is below.
// 'form.reset_password.email_body' => "משתמש יקר,\n\n התקבלה בקשה לאיפוס סיסמתך. נא ללחוץ על קישור זה אם ברצונך לאפס את הסיסמה.\n\n%s\n\n. Anuko Time Tracker הינה מערכת לניהול זמן פשוטה וחינמית. בקר באתרנו בכתובת https://www.anuko.com לפרטים נוספים.\n\n",

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
// TODO: translate the following.
// 'form.report.assign_to_invoice' => 'Assign to invoice',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'מספר חשבונית',
'form.invoice.person' => 'משתמש',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
// TODO: translate the following.
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
'form.clients.active_clients' => 'לקוחות פעילים',
'form.clients.inactive_clients' => 'לקוחות לא פעילים',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
// TODO: translate the following.
// 'form.client.client_to_delete' => 'Client to delete',
// 'form.client.client_entries' => 'Client entries',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'ניתן לייצא את כל נתוני הצוות בקובץ XML. זה מאד שימושי אם ברצונך להשתמש בשרת משלך.',
'form.export.compression' => 'דחיסה',
'form.export.compression_none' => 'ללא',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'ייבא נתוני צוות מתוך קובץ XML.', // TODO: replace "team" with "group".
'form.import.file' => 'בחר קובץ',
'form.import.success' => 'הייבוא הושלם בהצלחה.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below. Also improve formatting, as multiple spaces or no spaces look a bit weird.
'form.groups.hint' => 'ניתן ליצור צוות חדש על-ידי יצירת מנהל צוות חדש.<br>ניתן לייבא נתוני צוות מקובץ XML משרת Anuko Time Tracker אחר (אין אפשרות לשמות משתמש זהים)',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 שעות',
'form.group_edit.24_hours' => '24 שעות',
// TODO: translate the following.
// 'form.group_edit.show_holidays' => 'Show holidays',
'form.group_edit.tracking_mode' => 'סוג מעקב',
'form.group_edit.mode_time' => 'זמן',
'form.group_edit.mode_projects' => 'פרוייקטים',
'form.group_edit.mode_projects_and_tasks' => 'פרוייקטים ומשימות',
'form.group_edit.record_type' => 'סוג רישום',
'form.group_edit.type_all' => 'הכל',
'form.group_edit.type_start_finish' => 'התחלה וסיום',
'form.group_edit.type_duration' => 'משך זמן',
// TODO: translate the following.
// 'form.group_edit.punch_mode' => 'Punch mode',
// 'form.group_edit.allow_overlap' => 'Allow overlap',
// 'form.group_edit.future_entries' => 'Future entries',
// 'form.group_edit.uncompleted_indicators' => 'Uncompleted indicators',
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'תוספים',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'מאת',
'form.mail.to' => 'אל',
'form.mail.report_subject' => 'דוח Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker הינה מערכת פשוטה, קלה לשימוש וחינמית לניהול זמן. בקר באתר <a href="https://www.anuko.com">www.anuko.com</a> לפרטים נוספים.',
'form.mail.report_sent' => 'הדוח נשלח.',
'form.mail.invoice_sent' => 'החשבונית נשלחה.',

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
