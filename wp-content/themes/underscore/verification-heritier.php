<?php
/**
 * Template Name: Vérification Héritier
 */

// Vérifier le token
$token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';
$request = $wpdb->get_row($wpdb->prepare(
    "SELECT * FROM wp_heir_requests WHERE heir_token = %s",
    $token
));

if (!$request || $request->status !== 'pending') {
    wp_die('Token invalide ou expiré');
}

// Traitement du formulaire d'upload
if (isset($_POST['submit_verification'])) {
    if (!wp_verify_nonce($_POST['verification_nonce'], 'heir_verification')) {
        wp_die('Nonce invalide');
    }

    // Gérer l'upload du fichier
    if (isset($_FILES['death_certificate'])) {
        $upload = wp_handle_upload($_FILES['death_certificate'], array('test_form' => false));
        
        if ($upload && !isset($upload['error'])) {
            // Mettre à jour la demande avec le certificat
            $wpdb->update(
                'wp_heir_requests',
                array(
                    'death_certificate' => $upload['url'],
                    'status' => 'uploaded'
                ),
                array('heir_token' => $token)
            );

            // Notifier l'admin
            wp_mail(
                get_option('admin_email'),
                'Nouvelle demande d\'accès héritier',
                'Un héritier a uploadé un certificat de décès qui nécessite votre validation.'
            );
        }
    }
}

get_header();
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Vérification d'accès héritier</h1>
        
        <form method="POST" enctype="multipart/form-data">
            <?php wp_nonce_field('heir_verification', 'verification_nonce'); ?>
            
            <div class="space-y-4">
                <p class="text-gray-600">Pour accéder aux contrats, veuillez fournir un justificatif de décès.</p>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Justificatif de décès (PDF/Image)</label>
                    <input type="file" 
                           name="death_certificate" 
                           accept=".pdf,.jpg,.jpeg,.png"
                           required
                           class="mt-1 block w-full">
                </div>
                
                <button type="submit" 
                        name="submit_verification"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                    Envoyer pour vérification
                </button>
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>
