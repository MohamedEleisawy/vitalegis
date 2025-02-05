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

// Ajouter au début du fichier, après la vérification de connexion
session_start();

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

    // Fonction pour stocker les données du formulaire en session
    function store_form_data() {
        $_SESSION['contract_form_data'] = array(
            'nom_contrat' => $_POST['nom_contrat'] ?? '',
            'categorie' => $_POST['categorie'] ?? '',
            'date_debut' => $_POST['date_debut'] ?? '',
            'date_fin' => $_POST['date_fin'] ?? '',
            'adresse_societe' => $_POST['adresse_societe'] ?? '',
            'identifiant' => $_POST['identifiant'] ?? '',
            'numero_contrat' => $_POST['numero_contrat'] ?? '',
            'telephone_societe' => $_POST['telephone_societe'] ?? '',
            'email_societe' => $_POST['email_societe'] ?? '',
            'montant' => $_POST['montant'] ?? '',
            'description' => $_POST['description'] ?? ''
        );
    }

    // Validation des champs obligatoires
    if (empty($nom_contrat) || empty($categorie) || empty($date_debut) || empty($adresse_societe)) {
        store_form_data();
        wp_redirect(esc_url(add_query_arg('message', 'missing_fields', get_permalink())));
        exit;
    }

    // Ajouter après la validation des champs obligatoires existants
    if (empty($identifiant) && empty($numero_contrat)) {
        store_form_data();
        wp_redirect(esc_url(add_query_arg('message', 'missing_id_or_number', get_permalink())));
        exit;
    }

    // Vérifier que les dates sont valides
    if (!strtotime($date_debut) || ($date_fin && !strtotime($date_fin))) {
        store_form_data();
        wp_redirect(esc_url(add_query_arg('message', 'invalid_date', get_permalink())));
        exit;
    }

    // Vérifier que la date de fin est postérieure à la date de début
    if ($date_fin && strtotime($date_fin) < strtotime($date_debut)) {
        store_form_data();
        wp_redirect(esc_url(add_query_arg('message', 'invalid_date_range', get_permalink())));
        exit;
    }

    // Vérifier que l'e-mail est valide
    if ($email_societe && !is_email($email_societe)) {
        store_form_data();
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
    if (update_user_meta($user_id, 'contrat_' . time(), $contract_data)) {
        // Nettoyer toutes les données de session
        unset($_SESSION['contract_form_data']);
        session_destroy();
        wp_redirect(esc_url(add_query_arg('message', 'success', get_permalink())));
        exit;
    }
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
            case 'missing_id_or_number':
                $class = 'bg-red-100 text-red-700';
                $text = 'Veuillez remplir au moins l\'identifiant ou le numéro de contrat.';
                break;
        }

        if ($text) {
            echo '<div class="mt-4 p-4 rounded-lg ' . esc_attr($class) . '" id="alert-message">' . esc_html($text) . '</div>';
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
<!-- HEADER -->
<?php get_template_part('template-parts/user-navigation'); ?>


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
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['nom_contrat'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required 
                                   placeholder="ex: Assurance vie">
                        </div>
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Catégorie *</label>
                            <input type="text" 
                                   name="categorie"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['categorie'] ?? ''); ?>"
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
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['date_debut'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                        </div>

                        <!-- Date de fin (optionnelle) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Date de fin</label>
                            <input type="date" 
                                   name="date_fin"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['date_fin'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Adresse postale de la société -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Adresse postale de la société *</label>
                            <textarea name="adresse_societe" 
                                      class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      rows="4"
                                      required><?php echo esc_textarea($_SESSION['contract_form_data']['adresse_societe'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step-content" data-step="3">
                    <h2 class="text-2xl font-bold mb-12 text-gray-900">Détails du contrat</h2>
                    <div class="space-y-8">
                        <!-- Identifiant (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Identifiant *</label>
                            <input type="text" 
                                   name="identifiant"
                                   data-required-group="id-contract"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['identifiant'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <p class="text-sm text-gray-500">Remplir au moins l'identifiant ou le numéro de contrat</p>
                        </div>

                        <!-- Numéro de contrat (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Numéro de contrat *</label>
                            <input type="text" 
                                   name="numero_contrat"
                                   data-required-group="id-contract"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['numero_contrat'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Numéro de téléphone de la société (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Numéro de téléphone de la société</label>
                            <input type="tel" 
                                   name="telephone_societe"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['telephone_societe'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Adresse e-mail de la société (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Adresse e-mail de la société</label>
                            <input type="email" 
                                   name="email_societe"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['email_societe'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Montant (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Montant</label>
                            <input type="number" 
                                   name="montant"
                                   value="<?php echo esc_attr($_SESSION['contract_form_data']['montant'] ?? ''); ?>"
                                   class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Description (optionnel) -->
                        <div class="space-y-4">
                            <label class="block text-base text-gray-700">Description</label>
                            <textarea name="description" 
                                      class="w-full p-4 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      rows="4"><?php echo esc_textarea($_SESSION['contract_form_data']['description'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Modifier le bouton "Suivant/Soumettre" -->
                <div class="pt-8">
                    <button type="button" 
                            id="nextBtn" 
                            class="w-full md:w-auto md:ml-auto md:block px-6 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition-all duration-300 ease-in-out">
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
            let formData = {};

            // Sauvegarder les valeurs du formulaire
            function saveFormData() {
                const inputs = form.querySelectorAll('input, textarea');
                const formDataObj = {};
                inputs.forEach(input => {
                    formData[input.name] = input.value;
                    formDataObj[input.name] = input.value;
                });
                sessionStorage.setItem('contractFormData', JSON.stringify(formDataObj));
            }

            // Restaurer les valeurs du formulaire
            function restoreFormData() {
                const inputs = form.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    if (formData[input.name]) {
                        input.value = formData[input.name];
                    }
                });
            }

            // Ajouter une fonction pour charger les données au chargement
            function loadSavedData() {
                const savedData = sessionStorage.getItem('contractFormData');
                if (savedData) {
                    const parsedData = JSON.parse(savedData);
                    Object.keys(parsedData).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            input.value = parsedData[key];
                        }
                    });
                }
            }

            // Fonction pour nettoyer l'URL des paramètres de message
            function cleanURL() {
                const url = new URL(window.location.href);
                if(url.searchParams.has('message')) {
                    url.searchParams.delete('message');
                    window.history.replaceState({}, '', url);
                }
            }

            // Nettoyer les messages d'erreur après 5 secondes
            setTimeout(() => {
                const messages = document.querySelectorAll('.bg-red-100, .bg-green-100');
                messages.forEach(message => {
                    message.style.transition = 'opacity 0.5s ease-out';
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.remove();
                        cleanURL();
                    }, 500);
                });
            }, 5000);

            // Fonction de validation des champs
            function validateFields(stepElement) {
                // Nettoyer tous les anciens messages d'erreur
                document.querySelectorAll('.error-message').forEach(msg => msg.remove());
                
                const inputs = stepElement.querySelectorAll('input[required], textarea[required]');
                let isValid = true;

                // Supprime tous les messages d'erreur existants
                stepElement.querySelectorAll('.error-message').forEach(msg => msg.remove());

                inputs.forEach(input => {
                    let errorMessage = '';
                    input.classList.remove('border-red-500');

                    if (!input.value || !input.value.trim()) {
                        errorMessage = 'Ce champ est obligatoire';
                    } else {
                        switch(input.name) {
                            case 'email_societe':
                                if (input.value && !input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                                    errorMessage = 'Adresse email invalide';
                                }
                                break;
                            case 'telephone_societe':
                                if (input.value && !input.value.match(/^[0-9+\s-]{10,}$/)) {
                                    errorMessage = 'Numéro de téléphone invalide';
                                }
                                break;
                            case 'date_fin':
                                const dateDebut = formData['date_debut'] || document.querySelector('[name="date_debut"]').value;
                                if (input.value && dateDebut && new Date(input.value) < new Date(dateDebut)) {
                                    errorMessage = 'La date de fin doit être postérieure à la date de début';
                                }
                                break;
                            case 'montant':
                                if (input.value && parseFloat(input.value) <= 0) {
                                    errorMessage = 'Le montant doit être supérieur à 0';
                                }
                                break;
                        }
                    }

                    if (errorMessage) {
                        isValid = false;
                        input.classList.add('border-red-500');
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                        errorDiv.textContent = errorMessage;
                        input.parentNode.appendChild(errorDiv);
                    }
                });

                // Ajouter la validation du groupe required
                if (currentStep === 3) {
                    const idField = form.querySelector('[name="identifiant"]');
                    const numField = form.querySelector('[name="numero_contrat"]');
                    
                    if (!idField.value.trim() && !numField.value.trim()) {
                        idField.classList.add('border-red-500');
                        numField.classList.add('border-red-500');
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-sm mt-1';
                        errorDiv.textContent = 'Veuillez remplir au moins l\'identifiant ou le numéro de contrat';
                        idField.parentNode.appendChild(errorDiv);
                        isValid = false;
                    }
                }

                return isValid;
            }

            nextBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Empêcher la soumission par défaut
                const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
                saveFormData();
                
                if (validateFields(currentStepElement)) {
                    if (currentStep < 3) {
                        currentStep++;
                        updateUI();
                        restoreFormData();
                    } else if (currentStep === 3) {
                        // À l'étape finale, vérifier tous les champs requis avant de soumettre
                        const allRequiredFields = form.querySelectorAll('input[required], textarea[required]');
                        let isFormValid = true;
                        
                        allRequiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                isFormValid = false;
                                field.classList.add('border-red-500');
                            }
                        });

                        if (isFormValid) {
                            // Nettoyer sessionStorage avant la soumission
                            sessionStorage.removeItem('contractFormData');
                            form.submit(); // Soumettre le formulaire seulement si tout est valide
                        }
                    }
                }
            });

            backBtn.addEventListener('click', () => {
                if (currentStep > 1) {
                    saveFormData(); // Sauvegarder les données avant de reculer
                    currentStep--;
                    updateUI();
                    restoreFormData(); // Restaurer les données après le changement d'étape
                }
            });

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
                    nextBtn.type = 'button'; // Garder le type button pour gérer la validation
                } else {
                    nextBtn.textContent = 'Suivant';
                    nextBtn.type = 'button';
                }
                backBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
            }

            // Ajouter un événement pour empêcher la soumission par défaut du formulaire
            form.addEventListener('submit', (e) => {
                const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
                if (currentStep !== 3 || !validateFields(currentStepElement)) {
                    e.preventDefault();
                }
            });

            // Ajouter un gestionnaire pour le cas où le formulaire est soumis avec succès
            if (document.querySelector('.bg-green-100')) {
                // Si message de succès présent, nettoyer le stockage
                sessionStorage.removeItem('contractFormData');
                formData = {};
            }

            // Ajouter un écouteur pour enlever les erreurs quand l'un des champs est rempli
            document.querySelectorAll('[data-required-group="id-contract"]').forEach(input => {
                input.addEventListener('input', function() {
                    const otherInput = this.name === 'identifiant' 
                        ? document.querySelector('[name="numero_contrat"]')
                        : document.querySelector('[name="identifiant"]');
                        
                    if (this.value.trim()) {
                        this.classList.remove('border-red-500');
                        otherInput.classList.remove('border-red-500');
                        const errorMessages = this.parentNode.querySelectorAll('.error-message');
                        errorMessages.forEach(msg => msg.remove());
                    }
                });
            });

            // Initialiser le formulaire
            updateUI();
            restoreFormData();
            loadSavedData(); // Charger les données sauvegardées au chargement
        });
    </script>

    <?php 
    // Afficher les messages
    afficher_message();
    get_footer(); 
    ?>