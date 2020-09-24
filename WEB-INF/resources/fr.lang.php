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

$i18n_language = 'French (Français)';
$i18n_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'); 
$i18n_weekdays = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
$i18n_weekdays_short = array('Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa');

$i18n_key_words = array(

// Menus - short selection strings that are displayed on top of application web pages.
// Example: https://timetracker.anuko.com (black menu on top).
'menu.login' => 'Connexion',
'menu.logout' => 'Quitter',
'menu.forum' => 'Forum',
'menu.help' => 'Aide',
// TODO: translate the following.
// 'menu.register' => 'Register',
'menu.profile' => 'Profil',
// TODO: translate the following.
// 'menu.group' => 'Group',
'menu.plugins' => 'Plugins',
'menu.time' => 'Temps',
// TODO: translate the following.
// 'menu.week' => 'Week',
'menu.expenses' => 'Dépenses',
'menu.reports' => 'Rapports',
// TODO: translate the following.
// 'menu.timesheets' => 'Timesheets',
'menu.charts' => 'Graphiques',
'menu.projects' => 'Projets',
'menu.tasks' => 'Tâches',
'menu.users' => 'Utilisateurs',
// TODO: translate the following.
// 'menu.groups' => 'Groups',
// 'menu.subgroups' => 'Subgroups',
'menu.export' => 'Exporter',
'menu.clients' => 'Clients',
'menu.options' => 'Options',

// Footer - strings on the bottom of most pages.
'footer.contribute_msg' => 'Vous pouvez contribuer à Time Tracker de différentes façons.',
'footer.credits' => 'Crédits',
'footer.license' => 'License',
'footer.improve' => 'Contribuer',

// Error messages.
'error.access_denied' => 'Accès refusé.',
'error.sys' => 'Erreur système.',
'error.db' => 'Erreur de base de données.',
// TODO: translate the following.
// 'error.registered_recently' => 'Registered recently.',
// 'error.feature_disabled' => 'Feature is disabled.',
'error.field' => 'Donnée "{0}" incorrecte.',
'error.empty' => 'Le champ "{0}" est vide.',
'error.not_equal' => 'Le champ "{0}" n\\\'est pas égal au champ "{1}".',
'error.interval' => 'Le champ "{0}" doit être supérieur à "{1}".',
'error.project' => 'Sélectionner un projet.',
'error.task' => 'Sélectionner une tâche.',
'error.client' => 'Sélectionner un client.',
'error.report' => 'Sélectionner un rapport.',
// TODO: translate the following.
// 'error.record' => 'Select record.',
'error.auth' => 'Nom d\\\'utilisateur ou mot de passe incorrect.',
'error.user_exists' => 'Un utilisateur avec cet identifiant existe déjà.',
// TODO: translate the following.
// 'error.object_exists' => 'Object with this name already exists.',
'error.invoice_exists' => 'Une facture avec ce numéro existe déjà.',
// TODO: translate the following.
// 'error.role_exists' => 'Role with this rank already exists.',
'error.no_invoiceable_items' => 'Il n\\\'y a pas d\\\'éléments à facturer.',
// TODO: translate the following.
// 'error.no_records' => 'There are no records.',
'error.no_login' => 'Aucun utilisateur avec cet identifiant.',
'error.no_groups' => 'Votre base de données est vide. Connectez-vous comme administrateur et créez une nouvelle équipe.',  // TODO: replace "team" with "group".
'error.upload' => 'Erreur de chargement du fichier.',
'error.range_locked' => 'Plage de date vérouillée.',
'error.mail_send' => 'Erreur lors de l\\\'envoi du courriel.',
// TODO: improve the translation above by adding MAIL_SMTP_DEBUG part.
// 'error.mail_send' => 'Error sending mail. Use MAIL_SMTP_DEBUG for diagnostics.',
'error.no_email' => 'Aucune adresse courriel n\\\'est associée à cet identifiant.',
'error.uncompleted_exists' => 'Une entrée non terminée existe déjà. Fermer ou supprimer.',
'error.goto_uncompleted' => 'Aller à l\\\'entrée non terminée.',
'error.overlap' => 'Les heures des projets ne peuvent se chevaucher.',
'error.future_date' => 'Date ultérieure.',
// TODO: translate the following.
// 'error.xml' => 'Error in XML file at line %d: %s.',
// 'error.cannot_import' => 'Cannot import: %s.',
// 'error.format' => 'Invalid file format.',
// 'error.user_count' => 'Limit on user count.',
// 'error.expired' => 'Expiration date reached.',
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
'button.login' => 'Connexion',
'button.now' => 'Maintenant',
'button.save' => 'Sauvegarder',
'button.copy' => 'Copier',
'button.cancel' => 'Annuler',
'button.submit' => 'Soumettre',
'button.add' => 'Ajouter',
'button.delete' => 'Supprimer',
'button.generate' => 'Générer',
'button.reset_password' => 'Réinitialiser',
'button.send' => 'Envoyer',
'button.send_by_email' => 'Envoyer par courriel',
'button.create_group' => 'Créer une équipe', // TODO: replace "team" with "group".
'button.export' => 'Exporter l\\\'équipe', // TODO: replace "team" with "group".
'button.import' => 'Importer une équipe', // TODO: replace "team" with "group".
'button.close' => 'Fermer',
'button.stop' => 'Arrêter',
// TODO: translate the following.
// 'button.approve' => 'Approve',
// 'button.disapprove' => 'Disapprove',

// Labels for controls on forms. Labels in this section are used on multiple forms.
// TODO: translate the following.
// 'label.menu' => 'Menu',
'label.group_name' => 'Nom équipe', // TODO: replace "team" with "group".
'label.address' => 'Adresse',
'label.currency' => 'Devise',
'label.manager_name' => 'Nom du responsable',
'label.manager_login' => 'Identifiant du responsable',
'label.person_name' => 'Nom',
'label.thing_name' => 'Nom',
'label.login' => 'Identifiant',
'label.password' => 'Mot de passe',
'label.confirm_password' => 'Confirmez le mot de passe',
'label.email' => 'Adresse courriel',
'label.cc' => 'Cc',
'label.bcc' => 'Cci',
'label.subject' => 'Objet',
'label.date' => 'Date',
'label.start_date' => 'Date de début',
'label.end_date' => 'Date de fin',
'label.user' => 'Utilisateur',
'label.users' => 'Utilisateurs',
// TODO: translate the following.
// 'label.group' => 'Group',
// 'label.subgroups' => 'Subgroups',
// 'label.roles' => 'Roles',
'label.client' => 'Client',
'label.clients' => 'Clients',
'label.option' => 'Option',
'label.invoice' => 'Facture',
'label.project' => 'Projet',
'label.projects' => 'Projets',
'label.task' => 'Tâche',
'label.tasks' => 'Tâches',
'label.description' => 'Description',
'label.start' => 'Début',
'label.finish' => 'Fin',
'label.duration' => 'Durée',
'label.note' => 'Note',
// TODO: translate the following.
// 'label.notes' => 'Notes',
'label.item' => 'Item',
'label.cost' => 'Coût',
// TODO: translate the following.
// 'label.ip' => 'IP',
'label.day_total' => 'Total quotidien',
'label.week_total' => 'Total hebdomadaire',
'label.month_total' => 'Total mensuel',
'label.today' => 'Aujourd\\\'hui',
'label.view' => 'Visionner',
'label.edit' => 'Modifier',
'label.delete' => 'Supprimer',
'label.configure' => 'Configurer',
'label.select_all' => 'Tout sélectionner',
'label.select_none' => 'Aucun',
// TODO: translate the following.
// 'label.day_view' => 'Day view',
// 'label.week_view' => 'Week view',
'label.id' => 'ID',
'label.language' => 'Langage',
'label.decimal_mark' => 'Séparateur de décimal',
'label.date_format' => 'Format date',
'label.time_format' => 'Format heure',
'label.week_start' => '1er jour de la semaine',
'label.comment' => 'Commentaire',
'label.status' => 'Statut',
'label.tax' => 'Taxe',
'label.subtotal' => 'Sous-total',
'label.total' => 'Total',
'label.client_name' => 'Nom du client',
'label.client_address' => 'Adresse du client',
'label.or' => 'ou',
'label.error' => 'Erreur',
'label.ldap_hint' => 'Entrer votre <b>Identifiant Windows</b> et <b>votre mot de passe</b> dans les champs suivants.',
'label.required_fields' => '* - champs obligatoires',
'label.on_behalf' => 'de la part de',
'label.role_manager' => '(responsable)',
'label.role_comanager' => '(coresponsable)',
'label.role_admin' => '(administrateur)',
'label.page' => 'Page',
'label.condition' => 'Condition',
// TODO: translate the following.
// 'label.yes' => 'yes',
// 'label.no' => 'no',
// 'label.sort' => 'Sort',
// Labels for plugins (extensions to Time Tracker that provide additional features).
'label.custom_fields' => 'Champs personalisés',
'label.monthly_quotas' => 'Quotas mensuels',
// TODO: translate the following.
// 'label.entity' => 'Entity',
'label.type' => 'Type',
'label.type_dropdown' => 'Liste déroulante',
'label.type_text' => 'Texte',
'label.required' => 'Obligatoire',
'label.fav_report' => 'Rapport favori',
'label.schedule' => 'Horaire',
'label.what_is_it' => 'Qu\\\'est-ce que c\\\'est?',
// 'label.expense' => 'Expense',
// 'label.quantity' => 'Quantity',
// 'label.paid_status' => 'Paid status',
// 'label.paid' => 'Paid',
// 'label.mark_paid' => 'Mark paid',
// 'label.week_menu' => 'Week menu',
// 'label.week_note' => 'Week note',
// 'label.week_list' => 'Week list',
// 'label.work_units' => 'Work units',
// 'label.work_units_short' => 'Units',
'label.totals_only' => 'Totaux uniquement',
'label.quota' => 'Quota',
// TODO: translate the following.
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
// 'label.image' => 'Image',
// 'label.download' => 'Download',
'label.active_users' => 'Utilisateurs actifs',
'label.inactive_users' => 'Utilisateurs inactifs',
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
'title.error' => 'Erreur',
// TODO: Translate the following.
// 'title.success' => 'Success',
'title.login' => 'Connexion',
'title.groups' => 'Équipes', // TODO: change "teams" to "groups".
// TODO: translate the following.
// 'title.subgroups' => 'Subgroups',
// 'title.add_group' => 'Adding Group',
'title.edit_group' => 'Modification d\\\'une équipe', // TODO: change "team" to "group".
'title.delete_group' => 'Suppression d\\\'une équipe', // TODO: change "team" to "group".
'title.reset_password' => 'Réinitialisation du mot de passe',
'title.change_password' => 'Modification du mot de passe',
'title.time' => 'Temps',
'title.edit_time_record' => 'Modification de l\\\'entrée de temps',
'title.delete_time_record' => 'Suppression de l\\\'entrée de temps',
// TODO: Translate the following.
// 'title.time_files' => 'Time Record Files',
'title.expenses' => 'Dépenses',
'title.edit_expense' => 'Modification d\\\'une dépense',
'title.delete_expense' => 'Suppression d\\\'une dépense',
// TODO: translate the following.
// 'title.expense_files' => 'Expense Item Files',
'title.reports' => 'Rapports',
'title.report' => 'Rapport',
'title.send_report' => 'Envoi du rapport',
// TODO: Translate the following.
// 'title.timesheets' => 'Timesheets',
// 'title.timesheet' => 'Timesheet',
// 'title.timesheet_files' => 'Timesheet Files',
'title.invoice' => 'Facture',
'title.send_invoice' => 'Envoi de la facture',
'title.charts' => 'Graphiques',
'title.projects' => 'Projets',
// TODO: translate the following.
// 'title.project_files' => 'Project Files',
'title.add_project' => 'Ajout d\\\'un projet',
'title.edit_project' => 'Modification d\\\'un projet',
'title.delete_project' => 'Suppression d\\\'un projet',
'title.tasks' => 'Tâches',
'title.add_task' => 'Ajout d\\\'une tâche',
'title.edit_task' => 'Modification d\\\'une tâche',
'title.delete_task' => 'Suppression d\\\'une tâche',
'title.users' => 'Utilisateurs',
'title.add_user' => 'Création d\\\'un utilisateur',
'title.edit_user' => 'Modification d\\\'un utilisateur',
'title.delete_user' => 'Suppression d\\\'un utilisateur',
// TODO: translate the following.
// 'title.roles' => 'Roles',
// 'title.add_role' => 'Adding Role',
// 'title.edit_role' => 'Editing Role',
// 'title.delete_role' => 'Deleting Role',
'title.clients' => 'Clients',
'title.add_client' => 'Ajout d\\\'un client',
'title.edit_client' => 'Modification d\\\'un client',
'title.delete_client' => 'Suppression d\\\'un client',
'title.invoices' => 'Factures',
'title.add_invoice' => 'Ajout d\\\'une facture',
'title.view_invoice' => 'Visionnement d\\\'une facture',
'title.delete_invoice' => 'Suppression d\\\'une facture',
'title.notifications' => 'Notifications',
'title.add_notification' => 'Ajout d\\\'une notification',
'title.edit_notification' => 'Modification d\\\'une notification',
'title.delete_notification' => 'Suppression d\\\'une notification',
// TODO: translate the following.
// 'title.add_timesheet' => 'Adding Timesheet',
// 'title.edit_timesheet' => 'Editing Timesheet',
// 'title.delete_timesheet' => 'Deleting Timesheet',
'title.monthly_quotas' => 'Quotas mensuels',
'title.export' => 'Exportation des données',
'title.import' => 'Importation des données',
'title.options' => 'Options',
// TODO: translate the following.
// 'title.display_options' => 'Display Options',
'title.profile' => 'Profil',
'title.plugins' => 'Plugins',
'title.cf_custom_fields' => 'Champs personalisés',
'title.cf_add_custom_field' => 'Ajout d\\\'un champ',
'title.cf_edit_custom_field' => 'Édition d\\\'un champ',
'title.cf_delete_custom_field' => 'Suppression d\\\'un champ',
'title.cf_dropdown_options' => 'Options de liste',
'title.cf_add_dropdown_option' => 'Ajout d\\\'une option',
'title.cf_edit_dropdown_option' => 'Modification d\\\'une option',
'title.cf_delete_dropdown_option' => 'Suppression d\\\'une option',
'title.locking' => 'Vérouillage',
// TODO: translate the following.
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
'dropdown.all' => '--- tous ---',
'dropdown.no' => '--- aucun ---',
'dropdown.current_day' => 'aujourd\\\'hui',
'dropdown.previous_day' => 'hier',
'dropdown.selected_day' => 'jour',
'dropdown.current_week' => 'semaine en cours',
'dropdown.previous_week' => 'la semaine dernière',
'dropdown.selected_week' => 'semaine',
'dropdown.current_month' => 'mois en cours',
'dropdown.previous_month' => 'le mois dernier',
'dropdown.selected_month' => 'mois',
'dropdown.current_year' => 'année en cours',
'dropdown.previous_year' => 'année dernière',
'dropdown.selected_year' => 'année',
'dropdown.all_time' => 'depuis toujours',
'dropdown.projects' => 'Projets',
'dropdown.tasks' => 'Tâches',
'dropdown.clients' => 'Clients',
'dropdown.select' => '--- sélectionnez ---',
'dropdown.select_invoice' => '--- selectionnez facture ---',
// TODO: translate the following.
// 'dropdown.select_timesheet' => '--- select timesheet ---',
'dropdown.status_active' => 'actif',
'dropdown.status_inactive' => 'inactif',
'dropdown.delete' => 'supprimer',
'dropdown.do_not_delete' => 'ne pas supprimer',
// TODO: translate the following.
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
'form.login.forgot_password' => 'Mot de passe oublié?',
'form.login.about' => 'Anuko <a href="https://www.anuko.com/lp/tt_2.htm" target="_blank">Time Tracker</a> est un système de gestion du temps, open source, simple et facile à utiliser.',

// Resetting Password form. See example at https://timetracker.anuko.com/password_reset.php.
'form.reset_password.message' => 'Une demande de réinitialisation du mot de passe a été envoyé par courriel.',
'form.reset_password.email_subject' => 'Demande de réinitialisation de mot de passe Anuko Time Tracker',
// TODO: English string has changed. "from IP added. Re-translate the beginning.
// 'form.reset_password.email_body' => "Dear User,\n\nSomeone from IP %s requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nAnuko Time Tracker is a simple, easy to use, open source time tracking system. Visit https://www.anuko.com for more information.\n\n",
// "IP %s" probably sounds awkward.
'form.reset_password.email_body' => "Cher utilisateur,\n\nQuelqu\'un, IP %s, avez demandé une réinitialisation de votre mot de passe. Veuillez de suivre ce lien pour le réinitialiser\n\n%s\n\nAnuko Time Tracker est un système de gestion du temps, open source, simple et facile à utiliser. Visitez https://www.anuko.com pour plus d\'informations.\n\n",

// Changing Password form. See example at https://timetracker.anuko.com/password_change.php?ref=1.
'form.change_password.tip' => 'Saisissez votre nouveau mot de passe et cliquez sur Sauvegarder.',

// Time form. See example at https://timetracker.anuko.com/time.php.
'form.time.duration_format' => '(hh:mm ou 0.0h)',
'form.time.billable' => 'Facturable',
'form.time.uncompleted' => 'Non terminée',
'form.time.remaining_quota' => 'Quota restant',
'form.time.over_quota' => 'Quota dépassé',
// TODO: translate the following.
// 'form.time.remaining_balance' => 'Remaining balance',
// 'form.time.over_balance' => 'Over balance',

// Editing Time Record form. See example at https://timetracker.anuko.com/time_edit.php (get there by editing an uncompleted time record).
'form.time_edit.uncompleted' => 'Cet enregistrement a été sauvegardé avec une heure de début seulement. Il ne s\\\'agit pas d\\\'une erreur.',

// Week view form. See example at https://timetracker.anuko.com/week.php.
// TODO: translate the following.
// 'form.week.new_entry' => 'New entry',

// Reports form. See example at https://timetracker.anuko.com/reports.php
'form.reports.save_as_favorite' => 'Enregistrer comme favori',
'form.reports.confirm_delete' => 'Êtes-vous certain de vouloir supprimer ce rapport des favoris?',
'form.reports.include_billable' => 'facturables',
'form.reports.include_not_billable' => 'non facturables',
'form.reports.include_invoiced' => 'facturé',
'form.reports.include_not_invoiced' => 'non facturé',
// TODO: translate the following.
// 'form.reports.include_assigned' => 'assigned',
// 'form.reports.include_not_assigned' => 'not assigned',
// 'form.reports.include_pending' => 'pending',
'form.reports.select_period' => 'Sélectionner la période de temps',
'form.reports.set_period' => 'ou dates indiquées',
'form.reports.show_fields' => 'Afficher les champs',
// TODO: translate the following.
// 'form.reports.time_fields' => 'Time fields',
// 'form.reports.user_fields' => 'User fields',
'form.reports.group_by' => 'Regroupés par',
'form.reports.group_by_no' => '--- Aucun regroupement ---',
'form.reports.group_by_date' => 'Date',
'form.reports.group_by_user' => 'Utilisateur',
'form.reports.group_by_client' => 'Client',
'form.reports.group_by_project' => 'Projet',
'form.reports.group_by_task' => 'Tâche',

// Report form. See example at https://timetracker.anuko.com/report.php
// (after generating a report at https://timetracker.anuko.com/reports.php).
'form.report.export' => 'Exporter',
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

// Invoice form. See example at https://timetracker.anuko.com/invoice.php
// (you can get to this form after generating a report).
'form.invoice.number' => 'Numéro de facture',
'form.invoice.person' => 'Personne',

// Deleting Invoice form. See example at https://timetracker.anuko.com/invoice_delete.php
'form.invoice.invoice_to_delete' => 'Facture à supprimer',
'form.invoice.invoice_entries' => 'Entrées de facture',
// TODO: translate the following.
// 'form.invoice.confirm_deleting_entries' => 'Please confirm deleting invoice entries from Time Tracker.',

// Charts form. See example at https://timetracker.anuko.com/charts.php
'form.charts.interval' => 'Intervalle',
'form.charts.chart' => 'Graphique',

// Projects form. See example at https://timetracker.anuko.com/projects.php
'form.projects.active_projects' => 'Projets actifs',
'form.projects.inactive_projects' => 'Projets inactifs',

// Tasks form. See example at https://timetracker.anuko.com/tasks.php
'form.tasks.active_tasks' => 'Tâches actives',
'form.tasks.inactive_tasks' => 'Tâches inactives',

// Users form. See example at https://timetracker.anuko.com/users.php
'form.users.uncompleted_entry' => 'L\\\'utilisateur a une entrée incomplète',
'form.users.role' => 'Rôle',
'form.users.manager' => 'Responsable',
'form.users.comanager' => 'Coresponsable',
'form.users.rate' => 'Tarif',
'form.users.default_rate' => 'Tarif horaire par défaut',

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
'form.clients.active_clients' => 'Clients actifs',
'form.clients.inactive_clients' => 'Clients inactifs',

// Deleting Client form. See example at https://timetracker.anuko.com/client_delete.php
'form.client.client_to_delete' => 'Client à supprimer',
'form.client.client_entries' => 'Entrées de client',

// Exporting Group Data form. See example at https://timetracker.anuko.com/export.php
// TODO: replace "team" with "group" in the string below.
'form.export.hint' => 'Vous pouvez exporter toutes les données d\\\'une équipe dans un ficheir xml. Cela peut être utile si vous transférez des données vers votre serveur.',
'form.export.compression' => 'Compression',
'form.export.compression_none' => 'Aucune',
'form.export.compression_bzip' => 'bzip',

// Importing Group Data form. See example at https://timetracker.anuko.com/import.php (login as admin first).
'form.import.hint' => 'Importer les donnés des équipes depuis un fichier xml.', // TODO: replace "team" with "group". Also, it's about 1 group, not many.
'form.import.file' => 'Sélectionner le fichier',
'form.import.success' => 'Importation réussie.',

// Groups form. See example at https://timetracker.anuko.com/admin_groups.php (login as admin first).
// TODO: replace "team" with "group" in the string below.
'form.groups.hint' => 'Créez une nouvelle équipe en créant un nouveau compte de responsable d\\\'équipe.<br>Vous pouvez également importer des données d\\\'une équipe depuis un fichier xml provenant d\\\'un autre serveur Anuko Time Tracker (les doublons d\\\'identifiants ne sont pas autorisés).',

// Group Settings form. See example at https://timetracker.anuko.com/group_edit.php.
'form.group_edit.12_hours' => '12 heures',
'form.group_edit.24_hours' => '24 heures',
// TODO: translate the following.
// 'form.group_edit.display_options' => 'Display options',
// 'form.group_edit.holidays' => 'Holidays',
'form.group_edit.tracking_mode' => 'Mode suivi',
'form.group_edit.mode_time' => 'Heures',
'form.group_edit.mode_projects' => 'Projets',
'form.group_edit.mode_projects_and_tasks' => 'Projets et tâches',
'form.group_edit.record_type' => 'Type d\\\'enregistrement',
'form.group_edit.type_all' => 'Tous',
'form.group_edit.type_start_finish' => 'Début et fin',
'form.group_edit.type_duration' => 'Durée',
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
'form.mail.to' => 'À',
'form.mail.report_subject' => 'Rapport Time Tracker',
'form.mail.footer' => 'Anuko Time Tracker est un système de gestion du temps, open source, simple et facile à utiliser. Visitez <a href="https://www.anuko.com">www.anuko.com</a> pour plus d\\\'informations.',
'form.mail.report_sent' => 'Le rapport a été envoyé.',
'form.mail.invoice_sent' => 'La facture a été envoyée.',

// Quotas configuration form. See example at https://timetracker.anuko.com/quotas.php after enabling Monthly quotas plugin.
'form.quota.year' => 'Année',
'form.quota.month' => 'Mois',
'form.quota.workday_hours' => 'Heures journée de travail',
'form.quota.hint' => 'Si les valeurs sont vides, les quotas sont calculés automatiquement selon les heures des journées de travail et des congés.',

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
