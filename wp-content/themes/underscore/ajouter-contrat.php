<?php
/**
 * Template Name: Ajouter un contrat
 * version: 1.0
 * Description: Page d'ajout de contrat
 * author: Damien Hourriez
 */

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

// Traitement du formulaire
if (isset($_POST['submit_contract'])) {
    // Vérifier le nonce pour la sécurité
    if (!wp_verify_nonce($_POST['contract_nonce'], 'save_contract')) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_nonce', get_permalink())));
        exit;
    }

    // Récupérer l'ID de l'utilisateur connecté
    $user_id = get_current_user_id();

    // Sanitizer et valider les données du formulaire
    $nom_contrat = sanitize_text_field($_POST['nom_contrat']);
    $categorie = sanitize_text_field($_POST['categorie']);
    $date_debut = sanitize_text_field($_POST['date_debut']);
    $date_fin = sanitize_text_field($_POST['date_fin']);
    $adresse_societe = sanitize_textarea_field($_POST['adresse_societe']);
    $identifiant = sanitize_text_field($_POST['identifiant']);
    $numero_contrat = sanitize_text_field($_POST['numero_contrat']);
    $telephone_societe = sanitize_text_field($_POST['telephone_societe']);
    $email_societe = sanitize_email($_POST['email_societe']);
    $montant = floatval($_POST['montant']);
    $description = sanitize_textarea_field($_POST['description']);

    // Validation des champs obligatoires
    if (empty($nom_contrat) || empty($categorie) || empty($date_debut) || empty($date_fin) || empty($adresse_societe) || empty($identifiant) || empty($numero_contrat) || empty($telephone_societe) || empty($email_societe) || empty($montant)) {
        wp_redirect(esc_url(add_query_arg('message', 'missing_fields', get_permalink())));
        exit;
    }

    // Vérifier que les dates sont valides
    if (!strtotime($date_debut) || !strtotime($date_fin)) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_date', get_permalink())));
        exit;
    }

    // Vérifier que la date de fin est postérieure à la date de début
    if (strtotime($date_fin) < strtotime($date_debut)) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_date_range', get_permalink())));
        exit;
    }

    // Vérifier que l'e-mail est valide
    if (!is_email($email_societe)) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_email', get_permalink())));
        exit;
    }

    // Préparer les données du contrat
    $contract_data = array(
        'nom_contrat' => $nom_contrat,
        'categorie' => $categorie,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'adresse_societe' => $adresse_societe,
        'identifiant' => $identifiant,
        'numero_contrat' => $numero_contrat,
        'telephone_societe' => $telephone_societe,
        'email_societe' => $email_societe,
        'montant' => $montant,
        'description' => $description
    );

    // Enregistrer les données dans les métadonnées de l'utilisateur
    update_user_meta($user_id, 'contrat_' . time(), $contract_data);

    // Rediriger avec un message de succès
    wp_redirect(esc_url(add_query_arg('message', 'success', get_permalink())));
    exit;
}

// Fonction pour afficher les messages
function afficher_message() {
    if (isset($_GET['message'])) {
        $message = sanitize_text_field($_GET['message']);
        $class = '';
        $text = '';

        switch ($message) {
            case 'success':
                $class = 'bg-green-100 text-green-700';
                $text = 'Le contrat a été enregistré avec succès.';
                break;
            case 'missing_fields':
                $class = 'bg-red-100 text-red-700';
                $text = 'Veuillez remplir tous les champs obligatoires.';
                break;
            case 'invalid_date':
                $class = 'bg-red-100 text-red-700';
                $text = 'La date de début ou de fin est invalide.';
                break;
            case 'invalid_date_range':
                $class = 'bg-red-100 text-red-700';
                $text = 'La date de fin doit être postérieure à la date de début.';
                break;
            case 'invalid_email':
                $class = 'bg-red-100 text-red-700';
                $text = 'L\'adresse e-mail de la société est invalide.';
                break;
            case 'invalid_nonce':
                $class = 'bg-red-100 text-red-700';
                $text = 'Une erreur s\'est produite. Veuillez réessayer.';
                break;
        }

        if ($text) {
            echo '<div class="mt-4 p-4 rounded-lg ' . esc_attr($class) . '">' . esc_html($text) . '</div>';
        }
    }
}

get_template_part('template-parts/head');
?>

<style>
    .step-content {
        display: none;
    }

    .step-content.active {
        display: block;
    }

    .nav-indicator {
        height: 2px;
        background-color: #1a237e;
        transition: all 0.3s ease;
    }

    .nav-item.active .nav-indicator {
        opacity: 1;
    }

    .nav-item .nav-indicator {
        opacity: 0;
    }
</style>
</head>
<body class="bg-white min-h-screen">
<header class="bg-slate-900 px-4 sm:px-6 py-4 grid grid-cols-[auto_1fr] items-center">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="font-bold text-blue-600">
        <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16"
            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-dore.png"
            alt="<?php bloginfo('name'); ?>">
    </a>
    <div class="grid grid-flow-col auto-cols-max gap-2 sm:gap-4 justify-end items-center">
        <a href="<?php echo esc_url(um_get_core_page('logout')); ?>"
            class="text-white hidden sm:block hover:text-gray-300">
            Se déconnecter
        </a>
        <div class="relative group">
            <?php
            $current_user_id = get_current_user_id();
            echo get_avatar($current_user_id, 40, '', '', array('class' => 'w-10 h-10 rounded-full cursor-pointer'));
            ?>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block z-50">
                <nav class="grid gap-1 py-2">
                    <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                        class="px-4 py-2 hover:bg-gray-100">
                        Profile
                    </a>
                    <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                        class="px-4 py-2 hover:bg-gray-100">
                        Accès Héritier
                    </a>
                    <a href="<?php echo esc_url(um_get_core_page('logout')); ?>"
                        class="px-4 py-2 hover:bg-gray-100">
                        Se déconnecter
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
    <div class="container mx-auto p-6">
        <!-- Back Button -->
        <button type="button" id="backBtn" class="mb-6 text-gray-600 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Navigation -->
        <nav class="mb-12">
            <div class="flex justify-between items-center text-base mb-2">
                <div class="nav-item active flex-1">
                    <span class="text-blue-900 font-medium cursor-pointer">Nom du contrat</span>
                    <div class="nav-indicator mt-2"></div>
                </div>
                <div class="nav-item flex-1 text-center">
                    <span class="text-gray-400">Dates et adresse</span>
                    <div class="nav-indicator mt-2"></div>
                </div>
                <div class="nav-item flex-1 text-right">
                    <span class="text-gray-400">Détails du contrat</span>
                    <div class="nav-indicator mt-2"></div>
                </div>
            </div>
        </nav>

        <!-- Form Container -->
        <div class="max-w-2xl mx-auto">
            <form id="multiStepForm" class="space-y-12" method="POST" action="">
                <?php wp_nonce_field('save_contract', 'contract_nonce'); ?>
                
                <!-- Step 1 -->
                <div class="step-content active" data-step="1">
                    <h2 class="text-2xl font-bold mb-12 text-gray-900">Donnez un nom à votre contrat</h2>
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Nom du contrat *</label>
                            <input type="text" 
                                   name="nom_contrat"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required 
                                   placeholder="ex: Assurance vie">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Catégorie *</label>
                            <input type="text" 
                                   name="categorie"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required 
                                   placeholder="ex: Assurance">
                        </div>
                        <p class="text-sm text-gray-500">* obligatoire</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step-content" data-step="2">
                    <h2 class="text-2xl font-bold mb-12 text-gray-900">Dates et adresse</h2>
                    <div class="space-y-8">
                        <!-- Date de début -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Date de début *</label>
                            <input type="date" 
                                   name="date_debut"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Date de fin -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Date de fin *</label>
                            <input type="date" 
                                   name="date_fin"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Adresse postale de la société -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Adresse postale de la société *</label>
                            <textarea name="adresse_societe" 
                                      class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      rows="4"
                                      required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-content" data-step="3">
                    <h2 class="text-2xl font-bold mb-12 text-gray-900">Détails du contrat</h2>
                    <div class="space-y-8">
                        <!-- Identifiant -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Identifiant *</label>
                            <input type="text" 
                                   name="identifiant"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Numéro de contrat -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Numéro de contrat *</label>
                            <input type="text" 
                                   name="numero_contrat"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Numéro de téléphone de la société -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Numéro de téléphone de la société *</label>
                            <input type="tel" 
                                   name="telephone_societe"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Adresse e-mail de la société -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Adresse e-mail de la société *</label>
                            <input type="email" 
                                   name="email_societe"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Montant -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Montant *</label>
                            <input type="number" 
                                   name="montant"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Description -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Description</label>
                            <textarea name="description" 
                                      class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Navigation Button -->
                <div class="pt-8">
                    <button type="button" 
                            id="nextBtn" 
                            class="w-full md:w-auto md:ml-auto md:block px-8 py-4 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition-colors">
                        Suivant
                    </button>
                    <input type="hidden" name="submit_contract" value="1">
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const form = document.getElementById('multiStepForm');
            const backBtn = document.getElementById('backBtn');
            const nextBtn = document.getElementById('nextBtn');
            const steps = document.querySelectorAll('.step-content');
            const navItems = document.querySelectorAll('.nav-item');

            function updateUI() {
                // Update step visibility
                steps.forEach(step => step.classList.remove('active'));
                document.querySelector(`[data-step="${currentStep}"]`).classList.add('active');

                // Update navigation
                navItems.forEach((item, index) => {
                    const span = item.querySelector('span');
                    if (index + 1 === currentStep) {
                        span.classList.remove('text-gray-400');
                        span.classList.add('text-blue-900');
                        item.classList.add('active');
                    } else {
                        span.classList.remove('text-blue-900');
                        span.classList.add('text-gray-400');
                        item.classList.remove('active');
                    }
                });

                // Update button text and type for last step
                if (currentStep === 3) {
                    nextBtn.textContent = 'Soumettre';
                    nextBtn.type = 'submit';
                } else {
                    nextBtn.textContent = 'Suivant';
                    nextBtn.type = 'button';
                }
                backBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
            }

            backBtn.addEventListener('click', () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });

            nextBtn.addEventListener('click', () => {
                const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
                const inputs = currentStepElement.querySelectorAll('input[required], textarea[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('border-red-500');
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                if (!isValid) return;

                if (currentStep < 3) {
                    currentStep++;
                    updateUI();
                }
                // Supprimez le else { form.submit(); } car le formulaire sera soumis naturellement
            });

            updateUI();
        });
    </script>

    <?php 
    // Afficher les messages
    afficher_message();
    get_footer(); 
    ?>