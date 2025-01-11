<?php
if (isset($_POST['submit'])) {
    // Récupérer et sanitizer les données
    $nom = sanitize_text_field($_POST['nom']);
    $prenom = sanitize_text_field($_POST['prenom']);
    $email = sanitize_email($_POST['email']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $projet = sanitize_textarea_field($_POST['projet']);

    // Validation
    $errors = array();
    if (empty($nom)) $errors[] = "Le nom est requis";
    if (empty($prenom)) $errors[] = "Le prénom est requis";
    if (empty($email)) $errors[] = "L'email est requis";
    if (!is_email($email)) $errors[] = "L'email n'est pas valide";
    if (empty($telephone)) $errors[] = "Le téléphone est requis";
    if (empty($projet)) $errors[] = "Le message est requis";

    // S'il n'y a pas d'erreurs
    if (empty($errors)) {
        $to = get_option('admin_email');
        // $to = 'esdigitalcampus@gmail.com'; 
        $subject = 'Nouveau message de contact de ' . $nom . ' ' . $prenom;
        $body = "Nouveau message de contact :\n\n";
        $body .= "Nom : " . $nom . "\n";
        $body .= "Prénom : " . $prenom . "\n";
        $body .= "E-mail : " . $email . "\n";
        $body .= "Téléphone : " . $telephone . "\n";
        $body .= "Projet :\n" . $projet;

        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        if (wp_mail($to, $subject, $body, $headers)) {
            echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">Message envoyé avec succès!</div>';
        } else {
            echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">Erreur lors de l\'envoi. Veuillez réessayer.</div>';
        }
    } else {
        echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">';
        foreach ($errors as $error) {
            echo esc_html($error) . '<br>';
        }
        echo '</div>';
    }
}
?>