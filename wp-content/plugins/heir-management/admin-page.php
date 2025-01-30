<?php
/*
Plugin Name: Validation Héritiers
Description: Plugin pour valider les héritiers et gérer les demandes.
Version: 1.0
Author: Ton Nom
*/

if (!defined('ABSPATH')) {
    exit;
}

// Ajout du menu dans l'admin
function heir_admin_menu() {
    add_menu_page(
        'Validation Héritiers', // Titre de la page
        'Validation Héritiers', // Texte du menu
        'manage_options', // Capacité requise
        'heir-validation', // Slug du menu
        'heir_validation_page', // Fonction de callback
        'dashicons-groups', // Icône
        25 // Position dans le menu (même que Analytics)
    );
}
add_action('admin_menu', 'heir_admin_menu');

// Ajout des styles admin
function heir_admin_styles() {
    ?>
    <style>
        /* Style du menu */
        #toplevel_page_heir-validation .wp-menu-image {
            color: #2271b1 !important;
        }
        #toplevel_page_heir-validation:hover .wp-menu-image,
        #toplevel_page_heir-validation.current .wp-menu-image {
            color: #72aee6 !important;
        }
        
        /* Style de la page */
        .heir-dashboard {
            margin: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .heir-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .heir-table th,
        .heir-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .heir-table th {
            background-color: #f8fafc;
            font-weight: 600;
        }
    </style>
    <?php
}
add_action('admin_head', 'heir_admin_styles');

// Ajouter un nouvel intervalle de 6 mois
function add_sixmonthly_interval($schedules) {
    $schedules['sixmonthly'] = array(
        'interval' => 15778800, // 6 mois en secondes
        'display' => 'Une fois tous les 6 mois'
    );
    return $schedules;
}
add_filter('cron_schedules', 'add_sixmonthly_interval');

// Ajouter l'action pour la vérification périodique
add_action('check_heir_status', 'schedule_heir_verification');

// Fonction de la page principale
function heir_validation_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('Vous n\'avez pas les permissions suffisantes pour accéder à cette page.'));
    }
    
    // Traitement des actions
    if (isset($_POST['action']) && isset($_POST['request_id'])) {
        check_admin_referer('heir_action_nonce');
        
        $request_id = intval($_POST['request_id']);
        $action = sanitize_text_field($_POST['action']);
        
        if ($action === 'approve') {
            approve_heir_request($request_id);
            add_settings_error('heir_messages', 'heir_message', 'Demande approuvée avec succès.', 'updated');
        } elseif ($action === 'reject') {
            reject_heir_request($request_id);
            add_settings_error('heir_messages', 'heir_message', 'Demande rejetée avec succès.', 'updated');
        }
    }

    // Afficher les messages
    settings_errors('heir_messages');

    // Récupérer les demandes
    $requests = get_pending_heir_requests();
    ?>
    <div class="wrap heir-dashboard">
        <h1>Validation des héritiers</h1>
        <p>Bienvenue sur la page de validation des héritiers.</p>
        
        <?php if (empty($requests)) : ?>
            <div class="notice notice-info">
                <p>Aucune demande en attente de validation.</p>
            </div>
        <?php else : ?>
            <table class="heir-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Document</th>
                        <th>Date de demande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request) : ?>
                        <tr>
                            <td><?php echo esc_html($request->heir_email); ?></td>
                            <td>
                                <a href="<?php echo esc_url($request->death_certificate); ?>" 
                                   target="_blank" 
                                   class="button button-secondary">
                                    Voir le document
                                </a>
                            </td>
                            <td><?php echo esc_html(date_i18n('d/m/Y H:i', strtotime($request->created_at))); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <?php wp_nonce_field('heir_action_nonce'); ?>
                                    <input type="hidden" name="request_id" value="<?php echo esc_attr($request->id); ?>">
                                    <button type="submit" name="action" value="approve" 
                                            class="button button-primary">
                                        Approuver
                                    </button>
                                    <button type="submit" name="action" value="reject" 
                                            class="button">
                                        Rejeter
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

// Fonction pour obtenir les demandes en attente
function get_pending_heir_requests() {
    global $wpdb;
    return $wpdb->get_results(
        "SELECT * FROM {$wpdb->prefix}heir_requests 
        WHERE status = 'uploaded' 
        ORDER BY created_at DESC"
    );
}

// Fonction pour approuver une demande
function approve_heir_request($request_id) {
    global $wpdb;
    
    // Récupérer la demande
    $request = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}heir_requests WHERE id = %d",
        $request_id
    ));

    if ($request) {
        // Mettre à jour le statut
        $wpdb->update(
            "{$wpdb->prefix}heir_requests",
            array('status' => 'approved'),
            array('id' => $request_id)
        );

        // Créer un compte utilisateur pour l'héritier
        $user_data = array(
            'user_login' => $request->heir_email,
            'user_email' => $request->heir_email,
            'user_pass' => wp_generate_password(),
            'role' => 'heir'
        );

        $user_id = wp_insert_user($user_data);

        if (!is_wp_error($user_id)) {
            // Envoyer un email avec les identifiants
            wp_mail(
                $request->heir_email,
                'Accès héritier approuvé',
                "Votre accès héritier a été approuvé. Vous pouvez vous connecter avec votre email.\n\n" .
                "Pour définir votre mot de passe, veuillez suivre ce lien :\n" .
                wp_lostpassword_url()
            );
        }
    }
}

// Fonction pour rejeter une demande
function reject_heir_request($request_id) {
    global $wpdb;
    
    // Récupérer la demande
    $request = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}heir_requests WHERE id = %d",
        $request_id
    ));

    if ($request) {
        // Mettre à jour le statut
        $wpdb->update(
            "{$wpdb->prefix}heir_requests",
            array('status' => 'rejected'),
            array('id' => $request_id)
        );

        // Envoyer un email de rejet
        wp_mail(
            $request->heir_email,
            'Accès héritier refusé',
            "Votre demande d'accès héritier a été refusée. Pour plus d'informations, veuillez nous contacter."
        );
    }
}

