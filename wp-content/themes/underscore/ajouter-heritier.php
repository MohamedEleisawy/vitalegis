<?php
/**
 * Template Name: Ajouter un héritier
 * version: 1.0
 * Description: Page d'ajout d'héritier
 * author: Damien Hourriez
 */

get_template_part('template-parts/head');
?>

<style>
/* Styles pour la modal */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.5);
    place-items: center;
    z-index: 50;
    backdrop-filter: blur(8px);
}

.modal.active {
    display: grid;
}

.modal-content {
    animation: modalFadeIn 0.3s ease-out forwards;
}

.modal-content.closing {
    animation: modalFadeOut 0.2s ease-in forwards;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes modalFadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(10px); }
}

.blur {
    filter: blur(4px);
    transition: filter 0.3s ease;
    pointer-events: none;
}
</style>

<?php
// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

// Traitement du formulaire
if (isset($_POST['submit_heir'])) {
    // Vérifier le nonce pour la sécurité
    if (!wp_verify_nonce($_POST['heir_nonce'], 'save_heir')) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_nonce', get_permalink())));
        exit;
    }

    // Récupérer l'ID de l'utilisateur connecté
    $user_id = get_current_user_id();

    // Sanitizer et valider les données du formulaire
    $nom = sanitize_text_field($_POST['nom']);
    $prenom = sanitize_text_field($_POST['prenom']);
    $email = sanitize_email($_POST['email']);

    // Validation des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($email)) {
        wp_redirect(esc_url(add_query_arg('message', 'missing_fields', get_permalink())));
        exit;
    }

    // Vérifier que l'e-mail est valide
    if (!is_email($email)) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_email', get_permalink())));
        exit;
    }

    // Préparer les données de l'héritier
    $heir_data = array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'date_ajout' => current_time('mysql'),
    );

    // Enregistrer les données dans les métadonnées de l'utilisateur
    update_user_meta($user_id, 'heritier_' . time(), $heir_data);

    

    // Générer un token  d'invitation
    $token = wp_generate_password(32, false);
    update_user_meta($user_id, 'heritier_token_' . time(), $token);


    // Rediriger avec un message de succès
    wp_redirect(esc_url(add_query_arg('message', 'success', get_permalink())));
    exit;
}

// Ajouter le traitement de la suppression après les autres traitements de formulaire
if (isset($_POST['delete_heir'])) {
    if (!wp_verify_nonce($_POST['delete_heir_nonce'], 'delete_heir')) {
        wp_redirect(esc_url(add_query_arg('message', 'invalid_nonce', get_permalink())));
        exit;
    }

    $heir_key = sanitize_text_field($_POST['heir_key']);
    $user_id = get_current_user_id();

    if (delete_user_meta($user_id, $heir_key)) {
        wp_redirect(esc_url(add_query_arg('message', 'deleted', get_permalink())));
    } else {
        wp_redirect(esc_url(add_query_arg('message', 'error', get_permalink())));
    }
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
                $text = 'L\'héritier a été ajouté avec succès.';
                break;
            case 'missing_fields':
                $class = 'bg-red-100 text-red-700';
                $text = 'Veuillez remplir tous les champs obligatoires.';
                break;
            case 'invalid_email':
                $class = 'bg-red-100 text-red-700';
                $text = 'L\'adresse e-mail est invalide.';
                break;
            case 'invalid_nonce':
                $class = 'bg-red-100 text-red-700';
                $text = 'Une erreur s\'est produite. Veuillez réessayer.';
                break;
            case 'deleted':
                $class = 'bg-red-100 text-red-700';
                $text = 'L\'héritier a été supprimé avec succès.';
                break;
            case 'error':
                $class = 'bg-red-100 text-red-700';
                $text = 'Une erreur s\'est produite lors de la suppression.';
                break;
        }

        if ($text) {
            echo '<div class="mt-4 p-4 rounded-lg ' . esc_attr($class) . '">' . esc_html($text) . '</div>';
        }
    }
}

get_template_part('template-parts/head');
?>

<body class="min-h-screen bg-gray-50">
    <?php get_template_part('template-parts/header'); ?>

    <main class="min-h-[calc(100vh-64px-180px)] pb-8"> <!-- 64px header, 180px footer -->
        <div class="container mx-auto px-4 sm:px-6 py-8">
            <div class="grid gap-4 mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold">Vos héritiers</h1>
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                    <p class="text-sm text-blue-700">
                        <span class="font-medium">Information :</span> Un mail leur sera adressé tous les 6 mois,
                        permettant ainsi l'accès des héritiers après vérification.
                    </p>
                </div>
            </div>
            
            <div class="flex justify-end mb-6">
                <button onclick="openHeirModal()" 
                        class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-800 transition-colors">
                    + Ajouter un héritier
                </button>
            </div>

            <!-- Liste des héritiers -->
            <div class="grid gap-4 mb-8">
                <?php
                $user_id = get_current_user_id();
                $user_meta = get_user_meta($user_id);
                $heritiers = [];

                foreach ($user_meta as $key => $value) {
                    if (strpos($key, 'heritier_') === 0) {
                        $heritiers[$key] = maybe_unserialize($value[0]);
                    }
                }

                if (!empty($heritiers)) :
                    foreach ($heritiers as $key => $heritier) :
                ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="grid grid-cols-[2px_1fr]">
                            <div class="bg-slate-900"></div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Nom</p>
                                            <p><?php echo esc_html($heritier['nom']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Prénom</p>
                                            <p><?php echo esc_html($heritier['prenom']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <p><?php echo esc_html($heritier['email']); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <button onclick="deleteHeir('<?php echo esc_js($key); ?>')" 
                                                class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                else:
                ?>
                    <p class="text-gray-500 text-center py-8">Aucun héritier ajouté pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Modal d'ajout d'héritier -->
    <div id="heirModal" class="modal">
        <div class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b">
                <h2 class="text-xl font-semibold">Ajouter un héritier</h2>
                <button onclick="closeHeirModal()" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="" class="p-6">
                <?php wp_nonce_field('save_heir', 'heir_nonce'); ?>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                        <input type="text" name="nom" required
                               class="w-full p-2 border rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
                        <input type="text" name="prenom" required
                               class="w-full p-2 border rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" required
                               class="w-full p-2 border rounded-md">
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button type="button" onclick="closeHeirModal()"
                            class="px-4 py-2 border rounded-md hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" name="submit_heir"
                            class="px-4 py-2 bg-blue-900 text-white rounded-md hover:bg-blue-800">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-900">Supprimer l'héritier</h2>
                <button onclick="closeDeleteModal()" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div class="grid justify-center mb-4">
                    <div class="w-16 h-16 rounded-full bg-red-100 grid place-items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <p class="text-lg font-medium text-gray-900 text-center mb-2">Confirmer la suppression</p>
                <p class="text-gray-500 text-center mb-6">Êtes-vous sûr de vouloir supprimer cet héritier ? Cette action est irréversible.</p>
                <form method="POST" action="" class="grid grid-cols-2 gap-3">
                    <?php wp_nonce_field('delete_heir', 'delete_heir_nonce'); ?>
                    <input type="hidden" name="heir_key" id="delete_heir_key">
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" 
                            name="delete_heir" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200 font-medium">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openHeirModal() {
            document.getElementById('heirModal').classList.add('active');
            document.querySelector('main').classList.add('blur');
            document.body.style.overflow = 'hidden';
        }

        function closeHeirModal() {
            const modal = document.getElementById('heirModal');
            modal.classList.add('closing');
            
            setTimeout(() => {
                modal.classList.remove('active', 'closing');
                document.querySelector('main').classList.remove('blur');
                document.body.style.overflow = '';
            }, 200);
        }

        function deleteHeir(heirKey) {
            document.getElementById('delete_heir_key').value = heirKey;
            document.getElementById('deleteModal').classList.add('active');
            document.querySelector('main').classList.add('blur');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('closing');
            
            setTimeout(() => {
                modal.classList.remove('active', 'closing');
                document.querySelector('main').classList.remove('blur');
                document.body.style.overflow = '';
            }, 200);
        }

        // Fermer les modals en cliquant en dehors
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    if (modal.id === 'deleteModal') {
                        closeDeleteModal();
                    } else {
                        closeHeirModal();
                    }
                }
            });
        });
    </script>

    <?php afficher_message(); ?>
    <?php get_footer(); ?>
</body>
</html>
