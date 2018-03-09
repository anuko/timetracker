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

$i18n_language = 'Ελληνικά';
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
'menu.create_team' => 'Δημιουργία ομάδας',
'menu.profile' => 'Προφίλ',
'menu.time' => 'Χρόνος',
'menu.expenses' => 'Έξοδα',
'menu.reports' => 'Αναφορές',
'menu.charts' => 'Διαγράμματα',
 // TODO: Improve, as we need a plural of projects. Auto-translate gets it as a single project.
'menu.projects' => 'Πρότζεκτ',
'menu.tasks' => 'Έργα',
'menu.users' => 'Χρήστες',
'menu.teams' => 'Ομάδες',
'menu.export' => 'Εξαγωγή',
'menu.clients' => 'Πελάτες',
'menu.options' => 'Επιλογές',

// Footer - strings on the bottom of most pages.
// TODO: translate the following.
// 'footer.contribute_msg' => 'You can contribute to Time Tracker in different ways.',
'footer.credits' => 'Πιστώσεις',
'footer.license' => 'Άδεια',
'footer.improve' => 'Βελτίωση',

// Error messages.
'error.access_denied' => 'Δεν επιτρέπεται η πρόσβαση.',
'error.sys' => 'Σφάλμα συστήματος.',
'error.db' => 'Σφάλμα βάσης δεδομένων.',
'error.field' => 'Λανθασμένο "{0}" δεδομένο.',
'error.empty' => 'Το πεδίο "{0}" είναι κενό.',
'error.not_equal' => 'Το πεδίο "{0}" δεν είναι ίσο με το πεδίο "{1}".',
'error.interval' => 'Πεδίο "{0}"  πρέπει να έχει τιμή μεγαλύτερη από "{1}".',
// TODO: improve "project" and "task" translations throughout the file.
// Problem: 'menu.projects' => 'Πρότζεκτ', yet here we have εργασίας.
'error.project' => 'Επιλογή εργασίας.',
'error.task' => 'Επιλογή έργου.',
'error.client' => 'Επιλογή πελάτη.',
'error.report' => 'Επιλογή αναφοράς.',
'error.record' => 'Επιλογή εγγραφής.',
'error.auth' => 'Λανθασμένο όνομα εισόδου ή κωδικός.',
'error.user_exists' => 'Ο χρήστης με αυτήν τη σύνδεση υπάρχει ήδη.',
// TODO: 'error.object_exists' string is a future replacement for
// 'error.---something---_exists'. We have too many of those, and
// the goal is to simplify translation maintenance by replacing
// most of them with a single 'error.object_exists'.
// Here, OBJECT means many things, depending on context: project, task,
// client, role, etc.
// English string:
// 'error.object_exists' => 'Object with this name already exists.',
// 'error.object_exists' => 'Το έργο με αυτό το όνομα υπάρχει ήδη.', // TODO: έργο seems incorrect here.
'error.project_exists' => 'Το πρότζεκτ με αυτό το όνομα υπάρχει ήδη.',
'error.task_exists' => 'Το έργο με αυτό το όνομα υπάρχει ήδη.',
'error.client_exists' => 'Ο πελάτης με αυτό το όνομα υπάρχει ήδη.',
'error.invoice_exists' => 'Το τιμολόγιο με αυτόν τον αριθμό υπάρχει ήδη.',
'error.role_exists' => 'Ο ρόλος σε αυτή τη σειρά υπάρχει ήδη.',
// TODO: translate the folloiwng.
// 'error.no_invoiceable_items' => 'There are no invoiceable items.',
// The error occurs when we add a new invoice for a client, but there are
// no items (of time or expenses) to put into it.
// In other words, 'Δεν υπάρχουν τιμολόγια.' is incorrect.
'error.no_login' => 'Δεν υπάρχει χρήστης με αυτά τα στοιχεία.',
'error.no_teams' => 'Η βάση δεδομένων σας είναι κενή. Συνδεθείτε ως διαχειριστής και δημιουργήστε μια νέα ομάδα.',
'error.upload' => 'Σφάλμα φόρτωσης αρχείου.',
'error.range_locked' => 'Το χρονικό διάστημα είναι κλειδωμένο.',
'error.mail_send' => 'Σφάλμα κατά την αποστολή του μηνύματος.',
// TODO: translate the following.
// 'error.no_email' => 'No email associated with this login.',
// The meaning of the error is: we try to find an email for the account
// identified by user login, and there is no such email, as when user did not provide
// it when creating an account. Therefore, we can't email anything to such user,
// for example, when sending password reset email.
// Therefore, this appears incorrect, if we believe Google translator.
// error.no_email' => 'Δεν βρέθηκε λογαριασμός με αυτήν τη διεύθυνση ηλεκτρονικού ταχυδρομείου.',
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
'button.create_team' => 'Δημιουργία ομάδας',
'button.export' => 'Εξαγωγη ομάδας',
'button.import' => 'Εισαγωγή ομάδας',
'button.close' => 'Κλείσιμο',
'button.stop' => 'Τέλος',

// Labels for controls on forms. Labels in this section are used on multiple forms.
'label.team_name' => 'Όνομα ομάδας',
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
'label.bcc' => 'Κρυφή κοινοποίηση', // TODO: this is taken from roundcube mail - check for accuracy anyway.
                                    // This is a "blind carbon copy" label on emails, see https://en.wiktionary.org/wiki/blind_carbon_copy
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
'label.project' => 'Πρότζεκτ',
'label.projects' => 'Πρότζεκτ', // TODO: no plural form for projects? As this is the same as 'label.project'.
'label.task' => 'Έργο',
'label.tasks' => 'Εργα',
'label.description' => 'Περιγραφή',
'label.start' => 'Αρχή',
'label.finish' => 'Τέλος',
'label.duration' => 'Διάρκεια',
'label.note' => 'Σημείωση',
'label.notes' => 'Σημειώσεις',
'label.item' => 'Αντικείμενο',
'label.cost' => 'Κόστος',
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
// TODO: translate the following.
// 'label.schedule' => 'Schedule',
'label.what_is_it' => 'Τι είναι αυτό?',
'label.expense' => 'Δαπάνη',
'label.quantity' => 'Ποσότητα',
'label.paid_status' => 'Κατάσταση πληρωμής',
'label.paid' => 'Πληρωμένο',
// TODO: translate the following.
// 'label.mark_paid' => 'Mark paid',
// The meaning is "Go ahead and mark the selected items as paid." Mark is a verb here (to mark as paid).
'label.week_note' => 'Σημείωση εβδομάδας',
// TODO: translate the following.
// 'label.week_list' => 'Week list',
// This is a list of entries for the whole week on the bottom of week view.
// See https://www.anuko.com/time_tracker/week_list.htm - I suggest trying the week view to see it.
// It is similar to a list of entries in day view. The difference is that week list is for 7 days.

// Form titles.
'title.login' => 'Σύνδεση',
'title.teams' => 'Ομάδες',
'title.create_team' => 'Δημιουργία ομάδας',
'title.edit_team' => 'Επεξεργασία ομάδας',
'title.delete_team' => 'Διαγραφή ομάδας',
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
'title.projects' => 'Πρότζεκτ',
'title.add_project' => 'Προσθήκη πρότζεκτ',
'title.edit_project' => 'Επεξεργασία πρότζεκτ',
'title.delete_project' => 'Διαγραφή πρότζεκτ',
'title.tasks' => 'Έργα',
'title.add_task' => 'Προσθήκη έργου',
'title.edit_task' => 'Επεξεργασία έργου',
'title.delete_task' => 'Διαγραφή έργου',
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
// TODO: translate the following. The meaning is to output all existing records (not just for "this month", etc.).
// 'dropdown.all_time' => 'all time',
'dropdown.projects' => 'πρότζεκτ',
'dropdown.tasks' => 'έργα',
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
'form.login.forgot_password' => 'Ξεχάσατε τον κωδικό πρόσβασης?', // TODO: Should the question mark be the Greek symbol ; instead?
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Το αίτημα  επαναφοράς κωδικού πρόσβασης αποστέλλεται μέσω ηλεκτρονικού ταχυδρομείου.',
'form.reset_password.email_subject' => 'Αίτημα επαναφοράς κωδικού Anuko Time Tracker',
// TODO: Translate the second part in the following string: "Someone from IP %s requested your Anuko Time Tracker password reset."
'form.reset_password.email_body' => "Αγαπητέ χρήστη,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Πατήστε στον ακόλουθο σύνδεσμο για επαναφορά του κωδικού σας.\n\n%s\n\nΤο Anuko Time Tracker είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου. Επισκεφθείτε τη διεύθυνση https://www.anuko.com για περισσότερες πληροφορίες.\n\n",

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
'form.reports.group_by_project' => 'πρότζεκτ',
'form.reports.group_by_task' => 'έργο',
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
'form.projects.active_projects' => 'Ενεργά πρότζεκτ',
'form.projects.inactive_projects' => 'Ανενεργά πρότζεκτ',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Ενεργά έργα',
'form.tasks.inactive_tasks' => 'Ανενεργά έργα',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.active_users' => 'Ενεργοί χρήστες',
'form.users.inactive_users' => 'Ανενεργοί χρήστες',
'form.users.uncompleted_entry' => 'Ο χρήστης έχει μια μη ολοκληρωμένη εισαγωγή χρόνου',
'form.users.role' => 'Ρόλος',
'form.users.manager' => 'Διευθυντής',
'form.users.comanager' => 'Υποδιευθυντής',
'form.users.rate' => 'Τιμή',
'form.users.default_rate' => 'Προκαθορισμένη ωριαία τιμή',

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

// Exporting Team Data form. See example at https://timetracker.anuko.com/export.php
'form.export.hint' => 'Μπορείτε να εξαγάγετε όλα τα δεδομένα μιας ομάδας σε ένα αρχείο xml. Θα είναι χρήσιμο εάν μετακινήσετε τα δεδομένα σε δικό σας διακομιστή.',
'form.export.compression' => 'Συμπίεση',
'form.export.compression_none' => 'χωρίς',
'form.export.compression_bzip' => 'bzip',

// Importing Team Data form. See example at https://timetracker.anuko.com/imort.php (login as admin first).
'form.import.hint' => 'Εισαγωγή δεδομένων ομάδας από αρχείο xml.',
'form.import.file' => 'Επιλογή αρχείου',
'form.import.success' => 'Η εισαγωγή ολοκληρώθηκε με επιτυχία.',

// Teams form. See example at https://timetracker.anuko.com/admin_teams.php (login as admin first).
'form.teams.hint' => 'Δημιουργήστε μια νέα ομάδα δημιουργώντας ένα νέο λογαριασμό διαχειριστή ομάδας.<br>Μπορείτε επίσης να εισαγάγετε δεδομένα ομάδας από ένα αρχείο xml από άλλο διακομιστή Anuko Time Tracker (δεν επιτρέπονται συγκρούσεις σύνδεσης).',

// Profile form. See example at https://timetracker.anuko.com/profile_edit.php.
'form.profile.12_hours' => '12 ώρες',
'form.profile.24_hours' => '24 ώρες',
'form.profile.show_holidays' => 'Προβολή διακοπών',
'form.profile.tracking_mode' => 'Λειτουργία καταγραφής',
'form.profile.mode_time' => 'χρόνος',
'form.profile.mode_projects' => 'πρότζεκτ',
'form.profile.mode_projects_and_tasks' => 'πρότζεκτ και έργα',
'form.profile.record_type' => 'Τύπος εγγραφής',
'form.profile.type_all' => 'όλα',
'form.profile.type_start_finish' => 'αρχή και τέλος',
'form.profile.type_duration' => 'διάρκεια',
'form.profile.punch_mode' => 'Λειτουργία διάτρησης',
'form.profile.allow_overlap' => 'Επικάλυψη επιτρεπτή',
'form.profile.future_entries' => 'Μελλοντικές καταχωρήσεις',
'form.profile.uncompleted_indicators' => 'Μη ολοκληρωμένες ενδείξεις',
'form.profile.plugins' => 'Πρόσθετα',

// Mail form. See example at https://timetracker.anuko.com/report_send.php when emailing a report.
'form.mail.from' => 'Από',
'form.mail.to' => 'Προς',
'form.mail.report_subject' => 'Time Tracker αναφορά',
'form.mail.footer' => 'Το Anuko Time Tracker είναι ένα απλό, εύχρηστο, ανοικτού κώδικα σύστημα παρακολούθησης χρόνου. Επισκεφθείτε τη διεύθυνση <a href="https://www.anuko.com">www.anuko.com</a> για περισσότερες πληροφορίες.',
'form.mail.report_sent' => 'Η αναφορά στάλθηκε.',
'form.mail.invoice_sent' => 'Το τιμολόγιο στάλθηκε.',

// Quotas configuration form.
'form.quota.year' => 'Χρόνος',
'form.quota.month' => 'Μήνας',
'form.quota.quota' => 'Ποσοστό',
'form.quota.workday_hours' => 'Ώρες ανά ημέρα εργασίας',
'form.quota.hint' => 'Εάν οι τιμές είναι κενές, οι ποσοστώσεις υπολογίζονται αυτόματα με βάση τις ώρες της εργάσιμης ημέρας και τις αργίες.',

// Roles and rights. These strings are used in multiple places. Grouped here to provide consistent translations.
'role.user.label' => 'Χρήστης',
'role.user.low_case_label' => 'χρήστης',
'role.user.description' => 'Μέλος χωρίς δικαιώματα διαχείρισης.',
'role.client.label' => 'Πελάτης',
'role.client.low_case_label' => 'πελάτης',
'role.client.description' => 'Ο πελάτης μπορεί να δει τις δικές του αναφορές, πίνακες και τιμολόγια.', // TODO: replace πίνακες with "charts" (Διάγραμμα)?
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
