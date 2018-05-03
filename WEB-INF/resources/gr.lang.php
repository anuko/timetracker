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

$i18n_language = 'Greek (Ελληνικά)';
$i18n_months = array('Ιανουάριος', 'Φεβρουάριος', 'Μάρτιος', 'Απρίλιος', 'Μάιος', 'Ιούνιος', 'Ιούλιος', 'Αύγουστος', 'Σεπτέμβριος', 'Οκτώβριος', 'Νοέμβριος', 'Δεκέμβριος');
$i18n_weekdays = array('Κυριακή', 'Δευτέρα', 'Τρίτη', 'Τετάρτη', 'Πέμπτη', 'Παρασκευή', 'Σάββατο');
$i18n_weekdays_short = array('Kυ', 'Δε', 'Τρ', 'Τε', 'Πε', 'Πα', 'Σα');
// format mm/dd
$i18n_holidays = array('01/01', '01/06', '03/25', '08/15', '10/28', '12/25', '12/26');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Είσοδος',
'menu.logout' => 'Αποσύνδεση',
'menu.forum' => 'Φόρουμ',
'menu.help' => 'Βοήθεια',
'menu.create_group' => 'Δημιουργία ομάδας',
'menu.profile' => 'Προφίλ',
'menu.group' => 'Ομάδα',
'menu.time' => 'Χρόνος',
'menu.expenses' => 'Έξοδα',
'menu.reports' => 'Αναφορές',
'menu.charts' => 'Διαγράμματα',
'menu.projects' => 'Έργα',
'menu.tasks' => 'Εργασίες',
'menu.users' => 'Χρήστες',
'menu.groups' => 'Ομάδες',
'menu.export' => 'Εξαγωγή',
'menu.clients' => 'Πελάτες',
'menu.options' => 'Επιλογές',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Μπορείτε να συμβάλλετε στο Time Tracker με διάφορους τρόπους.',
'footer.credits' => 'Πιστώσεις',
'footer.license' => 'Άδεια',
'footer.improve' => 'Βελτίωση',

// Error messages.
'error.access_denied' => 'Δεν επιτρέπεται η πρόσβαση.',
'error.sys' => 'Σφάλμα συστήματος.',
'error.db' => 'Σφάλμα βάσης δεδομένων.',
// TODO: translate the following.
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Λανθασμένο "{0}" δεδομένο.',
'error.empty' => 'Το πεδίο "{0}" είναι κενό.',
'error.not_equal' => 'Το πεδίο "{0}" δεν είναι ίσο με το πεδίο "{1}".',
'error.interval' => 'Το πεδίο "{0}" πρέπει να είναι μεγαλύτερο από "{1}".',
'error.project' => 'Επιλογή έργου.',
'error.task' => 'Επιλογή εργασίας.',
'error.client' => 'Επιλογή πελάτη.',
'error.report' => 'Επιλογή αναφοράς.',
'error.record' => 'Επιλογή εγγραφής.',
'error.auth' => 'Λανθασμένο όνομα εισόδου ή κωδικός.',
'error.user_exists' => 'Ο χρήστης με αυτήν τη σύνδεση υπάρχει ήδη.',
'error.object_exists' => 'Το αντικείμενο με αυτό το όνομα υπάρχει ήδη.',
'error.project_exists' => 'Το έργα με αυτό το όνομα υπάρχει ήδη.',
'error.task_exists' => 'Η εργασία με αυτό το όνομα υπάρχει ήδη.',
'error.client_exists' => 'Ο πελάτης με αυτό το όνομα υπάρχει ήδη.',
'error.invoice_exists' => 'Το τιμολόγιο με αυτόν τον αριθμό υπάρχει ήδη.',
'error.role_exists' => 'Ο ρόλος σε αυτή τη σειρά υπάρχει ήδη.',
'error.no_invoiceable_items' => 'Δεν υπάρχουν στοιχεία προς τιμολόγηση.',
'error.no_login' => 'Δεν υπάρχει χρήστης με αυτά τα στοιχεία.',
'error.no_groups' => 'Η βάση δεδομένων σας είναι κενή. Συνδεθείτε ως διαχειριστής και δημιουργήστε μια νέα ομάδα.',
'error.upload' => 'Σφάλμα φόρτωσης αρχείου.',
'error.range_locked' => 'Το χρονικό διάστημα είναι κλειδωμένο.',
'error.mail_send' => 'Σφάλμα κατά την αποστολή του μηνύματος.',
'error.no_email' => 'Δεν βρέθηκε διεύθυνση ηλεκτρονικού ταχυδρομείου που να αντιστοιχεί σε αυτή την σύνδεση.',
'error.uncompleted_exists' => 'Η μη ολοκληρωμένη καταχώρηση υπάρχει ήδη. Κλείσιμο ή διαγραφή του.',
'error.goto_uncompleted' => 'Μεταβείτε στην μη ολοκληρωμένη καταχώρηση.',
'error.overlap' => 'Το χρονικό διάστημα επικαλύπτει υπάρχουσες καταχωρήσεις.',
'error.future_date' => 'Η ημερομηνία είναι στο μέλλον.',

// Labels for buttons.
'button.login' => 'Σύνδεση',
'button.now' => 'Τώρα',
'button.save' => 'Αποθήκευση',
'button.copy' => 'Αντιγραφή',
'button.cancel' => 'Ακύρωση',
'button.submit' => 'Υποβολή',
'button.add' => 'Προσθήκη',
'button.delete' => 'Διαγραφή',
'button.generate' => 'Δημιουργία',
'button.reset_password' => 'Επαναφορά κωδικού πρόσβασης',
'button.send' => 'Αποστολή',
'button.send_by_email' => 'Αποστολή μέσω email',
'button.create_group' => 'Δημιουργία ομάδας',
'button.export' => 'Εξαγωγη ομάδας',
'button.import' => 'Εισαγωγή ομάδας',
'button.close' => 'Κλείσιμο',
'button.stop' => 'Τέλος',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.group_name' => 'Όνομα ομάδας',
'label.address' => 'Διεύθυνση',
'label.currency' => 'Νόμισμα',
'label.manager_name' => 'Όνομα διαχειριστή',
'label.manager_login' => 'Σύνδεση διαχειριστή',
'label.person_name' => 'Όνομα',
'label.thing_name' => 'Όνομα',
'label.login' => 'Σύνδεση',
'label.password' => 'Κωδικός',
'label.confirm_password' => 'Επιβεβαίωση κωδικού',
'label.email' => 'Email',
'label.cc' => 'Κοινοποίηση',
'label.bcc' => 'Κρυφή κοινοποίηση',
'label.subject' => 'Θέμα',
'label.date' => 'Ημερομηνία',
'label.start_date' => 'Ημερομηνία έναρξης',
'label.end_date' => 'Ημερομηνία λήξης',
'label.user' => 'Χρήστης',
'label.users' => 'Χρήστες',
'label.roles' => 'Ρόλους',
'label.client' => 'Πελάτης',
'label.clients' => 'Πελάτες',
'label.option' => 'Επιλογή',
'label.invoice' => 'Τιμολόγιο',
'label.project' => 'Έργο',
'label.projects' => 'Έργα',
'label.task' => 'Εργασία',
'label.tasks' => 'Εργασίες',
'label.description' => 'Περιγραφή',
'label.start' => 'Αρχή',
'label.finish' => 'Τέλος',
'label.duration' => 'Διάρκεια',
'label.note' => 'Σημείωση',
'label.notes' => 'Σημειώσεις',
'label.item' => 'Αντικείμενο',
'label.cost' => 'Κόστος',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Σύνολο ημέρας',
'label.week_total' => 'Σύνολο εβδομάδας',
'label.month_total' => 'Σύνολο μήνα',
'label.today' => 'Σήμερα',
'label.view' => 'Προβολή',
'label.edit' => 'Επεξεργασία',
'label.delete' => 'Διαγραφή',
'label.configure' => 'Διαμόρφωση',
'label.select_all' => 'Επιλογή όλων',
'label.select_none' => 'Μη επιλογή',
'label.day_view' => 'Προβολή ημέρας',
'label.week_view' => 'Προβολή εβδομάδας',
'label.id' => 'ID',
'label.language' => 'Γλώσσα',
'label.decimal_mark' => 'Δεκαδική ένδειξη',
'label.date_format' => 'Μορφή ημερομηνίας',
'label.time_format' => 'Μορφή ώρας',
'label.week_start' => 'Πρώτη ημέρα εβδομάδας',
'label.comment' => 'Σχόλια',
'label.status' => 'Κατάσταση',
'label.tax' => 'Φόρος',
'label.subtotal' => 'Μερικό σύνολο',
'label.total' => 'Συνολικά',
'label.client_name' => 'Όνομα πελάτη',
'label.client_address' => 'Διεύθυνση πελάτη',
'label.or' => 'ή',
'label.error' => 'Σφάλμα',
'label.ldap_hint' => 'Εισάγετε το <b>όνομα σύνδεσης των Windows</b> και <b>κωδικό πρόσβασης</b> στα παρακάτω πεδία.',
'label.required_fields' => '* - υποχρεωτικά πεδία',
'label.on_behalf' => 'εκ μέρους του',
'label.role_manager' => '(Διευθυντής)',
'label.role_comanager' => '(Υποδιευθυντής)',
'label.role_admin' => '(Διαχειριστής)',
'label.page' => 'Σελίδα',
'label.condition' => 'Κατάσταση',
'label.yes' => 'ναι',
'label.no' => 'όχι',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Προσαρμοσμένα πεδία',
'label.monthly_quotas' => 'Μηνιαίες ποσοστώσεις',
'label.type' => 'Τύπος',
'label.type_dropdown' => 'Αναπτυσσόμενο',
'label.type_text' => 'Κείμενο',
'label.required' => 'Απαιτείται',
'label.fav_report' => 'Αγαπημένη αναφορά',
'label.schedule' => 'Χρονοδιάγραμμα',
'label.what_is_it' => 'Τι είναι αυτό;',
'label.expense' => 'Δαπάνη',
'label.quantity' => 'Ποσότητα',
'label.paid_status' => 'Κατάσταση πληρωμής',
'label.paid' => 'Πληρωμένο',
'label.mark_paid' => 'Σήμανση πληρωμένα',
'label.week_note' => 'Σημείωση εβδομάδας',
'label.week_list' => 'Λίστα εβδομάδων',

// Form titles.
'title.login' => 'Σύνδεση',
'title.groups' => 'Ομάδες',
'title.create_group' => 'Δημιουργία ομάδας',
'title.edit_group' => 'Επεξεργασία ομάδας',
'title.delete_group' => 'Διαγραφή ομάδας',
'title.reset_password' => 'Επαναφορά κωδικού πρόσβασης',
'title.change_password' => 'Αλλαγή κωδικού πρόσβασης',
'title.time' => 'Χρόνος',
'title.edit_time_record' => 'Επεξεργασία χρόνου',
'title.delete_time_record' => 'Διαγραφή χρόνου',
'title.expenses' => 'Δαπάνες',
'title.edit_expense' => 'Επεξεργασία δαπάνης',
'title.delete_expense' => 'Διαγραφή δαπάνης',
'title.predefined_expenses' => 'Προκαθορισμένες δαπάνες',
'title.add_predefined_expense' => 'Προσθήκη προκαθορισμένης δαπάνης',
'title.edit_predefined_expense' => 'Επεξεργασία προκαθορισμένης δαπάνης',
'title.delete_predefined_expense' => 'Διαγραφή προκαθορισμένης δαπάνης',
'title.reports' => 'Αναφορές',
'title.report' => 'Αναφορά',
'title.send_report' => 'Αποστολή αναφοράς',
'title.invoice' => 'Τιμολόγιο',
'title.send_invoice' => 'Αποστολή τιμολόγιου',
'title.charts' => 'Γραφήματα',
'title.projects' => 'Έργο',
'title.add_project' => 'Προσθήκη έργου',
'title.edit_project' => 'Επεξεργασία έργου',
'title.delete_project' => 'Διαγραφή έργου',
'title.tasks' => 'Εργασίες',
'title.add_task' => 'Προσθήκη εργασίας',
'title.edit_task' => 'Επεξεργασία εργασίας',
'title.delete_task' => 'Διαγραφή εργασίας',
'title.users' => 'Χρήστες',
'title.add_user' => 'Προσθήκη χρήστη',
'title.edit_user' => 'Επεξεργασία χρήστη',
'title.delete_user' => 'Διαγραφή χρήστη',
'title.roles' => 'Ρόλους',
'title.add_role' => 'Προσθήκη ρόλου',
'title.edit_role' => 'Επεξεργασία ρόλου',
'title.delete_role' => 'Διαγραφή ρόλου',
'title.clients' => 'Πελάτες',
'title.add_client' => 'Προσθήκη πελάτη',
'title.edit_client' => 'Επεξεργασία πελάτη',
'title.delete_client' => 'Διαγραφή πελάτη',
'title.invoices' => 'Τιμολόγια',
'title.add_invoice' => 'Προσθήκη τιμολόγιου',
'title.view_invoice' => 'Προβολή τιμολόγιου',
'title.delete_invoice' => 'Διαγραφή τιμολόγιου',
'title.notifications' => 'Ειδοποιήσεις',
'title.add_notification' => 'Προσθήκη ειδοποίησης',
'title.edit_notification' => 'Επεξεργασία ειδοποίησης',
'title.delete_notification' => 'Διαγραφή ειδοποίησης',
'title.monthly_quotas' => 'Μηνιαίες ποσοστώσεις',
'title.export' => 'Εξαγωγή δεδομένων ομάδας',
'title.import' => 'Εισαγωγή δεδομένων ομάδας',
'title.options' => 'Επιλογές',
'title.profile' => 'Προφίλ',
// TODO: translate the following.
// 'title.group' => 'Group Settings',
'title.cf_custom_fields' => 'Προσαρμοσμένα πεδία',
'title.cf_add_custom_field' => 'Προσθήκη προσαρμοσμένου πεδίου',
'title.cf_edit_custom_field' => 'Επεξεργασία προσαρμοσμένου πεδίου',
'title.cf_delete_custom_field' => 'Διαγραφή προσαρμοσμένου πεδίου',
'title.cf_dropdown_options' => 'Επιλογές',
'title.cf_add_dropdown_option' => 'Προσθήκη επιλογής',
'title.cf_edit_dropdown_option' => 'Επεξεργασία επιλογής',
'title.cf_delete_dropdown_option' => 'Διαγραφή επιλογής',
'title.locking' => 'Κλείδωμα',
'title.week_view' => 'Προβολή εβδομάδας',
// TODO: translate the following.
// 'title.swap_roles' => 'Swapping Roles',

// Section for common strings inside combo boxes on forms. Strings shared between forms shall be placed here.
// Strings that are used in a single form must go to the specific form section.
'dropdown.all' => '--- όλα ---',
'dropdown.no' => '--- χωρίς ---',
'dropdown.current_day' => 'σήμερα',
'dropdown.previous_day' => 'χθές',
'dropdown.selected_day' => 'ημέρα',
'dropdown.current_week' => 'τρέχουσα εβδομάδα',
'dropdown.previous_week' => 'προηγούμενη εβδομάδα',
'dropdown.selected_week' => 'εβδομάδα',
'dropdown.current_month' => 'τρέχων μήνας',
'dropdown.previous_month' => 'προηγούμενος μήνα',
'dropdown.selected_month' => 'μήνας',
'dropdown.current_year' => 'τρέχον έτος',
'dropdown.previous_year' => 'προηγούμενο έτος',
'dropdown.selected_year' => 'έτος',
'dropdown.all_time' => 'όλη την περίοδο',
'dropdown.projects' => 'έργα',
'dropdown.tasks' => 'εργασίες',
'dropdown.clients' => 'πελάτες',
'dropdown.select' => '--- επιλογή ---',
'dropdown.select_invoice' => '--- επιλογή τιμολόγιου ---',
'dropdown.status_active' => 'ενεργός',
'dropdown.status_inactive' => 'ανένεργος',
'dropdown.delete' => 'διαγραφή',
'dropdown.do_not_delete' => 'μη το διαγράψετε',
'dropdown.paid' => 'εξοφλημένο',
'dropdown.not_paid' => 'δεν έχει εξοφληθεί',

// Below is a section for strings that are used on individual forms. When a string is used only on one form it should be placed here.
// One exception is for closely related forms such as "Time" and "Editing Time Record" with similar controls. In such cases
// a string can be defined on the main form and used on related forms. The reasoning for this is to make translation effort easier.
// Strings that are used on multiple unrelated forms should be placed in shared sections such as label.<stringname>, etc.

// Login form. See example at https://timetracker.anuko.com/login.php.
'form.login.forgot_password' => 'Ξεχάσατε τον κωδικό πρόσβασης;',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Το αίτημα  επαναφοράς κωδικού πρόσβασης αποστέλλεται μέσω ηλεκτρονικού ταχυδρομείου.',
'form.reset_password.email_subject' => 'Αίτημα επαναφοράς κωδικού Anuko Time Tracker',
'form.reset_password.email_body' => "Αγαπητέ χρήστη,\n\nΚάποιος από την IP %s ζήτησε επαναφορά του κωδικού πρόσβασης στο Anuko Time Tracker. Πατήστε στον ακόλουθο σύνδεσμο για επαναφορά του κωδικού σας.\n\n%s\n\nΤο Anuko Time Tracker είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου. Επισκεφθείτε τη διεύθυνση https://www.anuko.com για περισσότερες πληροφορίες.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Πληκτρολογήστε νέο κωδικό πρόσβασης και κάντε κλικ στην επιλογή Αποθήκευση.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(ωω:λλ ή 0.0)',
'form.time.billable' => 'Χρεώσιμο',
'form.time.uncompleted' => 'Μη ολοκληρωμένο',
'form.time.remaining_quota' => 'Υπολειπόμενη ποσόστωση',
'form.time.over_quota' => 'Πάνω από το όριο',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Η καταχώρηση αποθηκεύτηκε μόνο με ώρα έναρξης. Δεν είναι λάθος.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
'form.week.new_entry' => 'Νέα είσοδος',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Αποθήκευση ως αγαπημένο',
'form.reports.confirm_delete' => 'Διαγραφή της αγαπημένης αναφοράς;',
'form.reports.include_billable' => 'χρεώσιμο',
'form.reports.include_not_billable' => 'μη χρεώσιμο',
'form.reports.include_invoiced' => 'τιμολόγηση',
'form.reports.include_not_invoiced' => 'χωρίς τιμολόγηση',
'form.reports.select_period' => 'Επιλογή χρονικής περιόδου',
'form.reports.set_period' => 'ή εύρος ημερομηνιών',
'form.reports.show_fields' => 'Εμφάνιση πεδίων',
'form.reports.group_by' => 'Ομαδοποίηση με βάση',
'form.reports.group_by_no' => '--- χωρίς ομαδοποίηση ---',
'form.reports.group_by_date' => 'ημερομηνία',
'form.reports.group_by_user' => 'χρήστη',
'form.reports.group_by_client' => 'πελάτης',
'form.reports.group_by_project' => 'έργο',
'form.reports.group_by_task' => 'εργασία',
'form.reports.totals_only' => 'Σύνολα μόνο',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Εξαγωγή',
'form.report.assign_to_invoice' => 'Ανάθεση στο τιμολόγιο',

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Αριθμός τιμολογίου',
'form.invoice.person' => 'Άτομο',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Διαγραφή τιμολόγιου',
'form.invoice.invoice_entries' => 'Είσοδος τιμολόγιου',
'form.invoice.confirm_deleting_entries' => 'Επιβεβαιώστε τη διαγραφή καταχωρήσεων τιμολογίου από το Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Διάστημα',
'form.charts.chart' => 'Διάγραμμα',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Ενεργά έργα',
'form.projects.inactive_projects' => 'Ανενεργά έργα',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Ενεργές εργασίες',
'form.tasks.inactive_tasks' => 'Ανενεργές εργασίες',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Ενεργοί χρήστες',
'form.users.inactive_users' => 'Ανενεργοί χρήστες',
'form.users.uncompleted_entry' => 'Ο χρήστης έχει μια μη ολοκληρωμένη εισαγωγή χρόνου',
'form.users.role' => 'Ρόλος',
'form.users.manager' => 'Διευθυντής',
'form.users.comanager' => 'Υποδιευθυντής',
'form.users.rate' => 'Τιμή',
'form.users.default_rate' => 'Προκαθορισμένη ωριαία τιμή',

// Editing User form. See example at https://timetracker.anuko.com/user_edit.php
// TODO: translate the following.
// 'form.user_edit.swap_roles' => 'Swap roles',

// Roles form. See example at https://timetracker.anuko.com/roles.php
'form.roles.active_roles' => 'Ενεργοί ρόλοι',
'form.roles.inactive_roles' => 'Ανενεργοί ρόλοι',
'form.roles.rank' => 'Τάξη',
'form.roles.rights' => 'Δικαιώματα',
'form.roles.assigned' => 'Ανατέθηκε',
'form.roles.not_assigned' => 'Δεν έχει ανατεθεί',

// Clients form. See example at https://timetracker.anuko.com/clients.php
'form.clients.active_clients' => 'Ενεργοί πελάτες',
'form.clients.inactive_clients' => 'Ανενεργοί πελάτες',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Διαγραφή πελάτη',
'form.client.client_entries' => 'Είσοδος πελάτη',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Μπορείτε να εξαγάγετε όλα τα δεδομένα μιας ομάδας σε ένα αρχείο xml. Θα είναι χρήσιμο εάν μετακινήσετε τα δεδομένα σε δικό σας διακομιστή.',
'form.export.compression' => 'Συμπίεση',
'form.export.compression_none' => 'χωρίς',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Εισαγωγή δεδομένων ομάδας από αρχείο xml.',
'form.import.file' => 'Επιλογή αρχείου',
'form.import.success' => 'Η εισαγωγή ολοκληρώθηκε με επιτυχία.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
'form.groups.hint' => 'Δημιουργήστε μια νέα ομάδα δημιουργώντας ένα νέο λογαριασμό διαχειριστή ομάδας.<br>Μπορείτε επίσης να εισαγάγετε δεδομένα ομάδας από ένα αρχείο xml από άλλο διακομιστή Anuko Time Tracker (δεν επιτρέπονται συγκρούσεις σύνδεσης).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 ώρες',
'form.group_edit.24_hours' => '24 ώρες',
'form.group_edit.show_holidays' => 'Προβολή διακοπών',
'form.group_edit.tracking_mode' => 'Λειτουργία καταγραφής',
'form.group_edit.mode_time' => 'χρόνος',
'form.group_edit.mode_projects' => 'έργα',
'form.group_edit.mode_projects_and_tasks' => 'έργα και εργασίες',
'form.group_edit.record_type' => 'Τύπος εγγραφής',
'form.group_edit.type_all' => 'όλα',
'form.group_edit.type_start_finish' => 'αρχή και τέλος',
'form.group_edit.type_duration' => 'διάρκεια',
'form.group_edit.punch_mode' => 'Λειτουργία διάτρησης',
'form.group_edit.allow_overlap' => 'Επικάλυψη επιτρεπτή',
'form.group_edit.future_entries' => 'Μελλοντικές καταχωρήσεις',
'form.group_edit.uncompleted_indicators' => 'Μη ολοκληρωμένες ενδείξεις',
// TODO: translate the following.
// 'form.group_edit.allow_ip' => 'Allow IP',
'form.group_edit.plugins' => 'Πρόσθετα',

// Deleting Group form. See example at https://timetracker.anuko.com/delete_group.php
// TODO: translate the following.
// 'form.group_delete.hint' => 'Are you sure you want to delete the entire group?',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Από',
'form.mail.to' => 'Προς',
'form.mail.report_subject' => 'Time Tracker αναφορά',
'form.mail.footer' => 'Το Anuko Time Tracker είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου. Επισκεφθείτε τη διεύθυνση <a href="https://www.anuko.com">www.anuko.com</a> για περισσότερες πληροφορίες.',
'form.mail.report_sent' => 'Η αναφορά στάλθηκε.',
'form.mail.invoice_sent' => 'Το τιμολόγιο στάλθηκε.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Χρόνος',
'form.quota.month' => 'Μήνας',
'form.quota.quota' => 'Ποσοστό',
'form.quota.workday_hours' => 'Ώρες ανά ημέρα εργασίας',
'form.quota.hint' => 'Εάν οι τιμές είναι κενές, οι ποσοστώσεις υπολογίζονται αυτόματα με βάση τις ώρες της εργάσιμης ημέρας και τις αργίες.',

// Swap roles form. See example at https://timetracker.anuko.com/swap_roles.php.
// TODO: translate the following.
// 'form.swap.hint' => 'Demote yourself to a lower role by swapping roles with someone else. This cannot be undone.',
// 'form.swap.swap_with' => 'Swap roles with',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Χρήστης',
'role.user.low_case_label' => 'χρήστης',
'role.user.description' => 'Μέλος χωρίς δικαιώματα διαχείρισης.',
'role.client.label' => 'Πελάτης',
'role.client.low_case_label' => 'πελάτης',
'role.client.description' => 'Ο πελάτης μπορεί να δει τις δικές του αναφορές, διαγράμματα και τιμολόγια.',
'role.supervisor.label' => 'Επόπτης',
'role.supervisor.low_case_label' => 'επόπτης',
'role.supervisor.description' => 'Άτομο με μικρό σύνολο δικαιωμάτων διαχείρισης.',
'role.comanager.label' => 'Υποδιευθυντής',
'role.comanager.low_case_label' => 'υποδιευθυντής',
'role.comanager.description' => 'Άτομο με μεγάλο εύρος λειτουργιών διαχείρισης.',
'role.manager.label' => 'Διευθυντής',
'role.manager.low_case_label' => 'διευθυντής',
'role.manager.description' => 'Διευθυντής ομάδας. Μπορεί να κάνει τα περισσότερα πράγματα σε μια ομάδα.',
'role.top_manager.label' => 'Γενικός διευθυντής',
'role.top_manager.low_case_label' => 'γενικός διευθυντής',
'role.top_manager.description' => 'Γενικός διευθυντής ομάδας. Πλήρη δικαιώματα σε εύρος ομάδων.',
'role.admin.label' => 'Διαχειριστής',
'role.admin.low_case_label' => 'διαχειριστής',
'role.admin.description' => 'Διαχειριστής δικτυακού τόπου.',
);
