<?php
/*
Template Name: Espace utilisateur
Version: 1.0
Description: Page espace utilisateur
Author: Damien Hourriez
*/

get_template_part('template-parts/head');

// Récupérer l'ID de l'utilisateur connecté
$user_id = get_current_user_id();

// Traitement de la modification du contrat
if (isset($_POST['edit_contract'])) {
    if (!wp_verify_nonce($_POST['edit_contract_nonce'], 'edit_contract')) {
        wp_die('Invalid nonce');
    }

    $user_id = get_current_user_id();
    $contract_key = sanitize_text_field($_POST['contract_key']);

    // Vérifier que la clé du contrat existe
    if (get_user_meta($user_id, $contract_key, true)) {
        $contract_data = array(
            'nom_contrat' => sanitize_text_field($_POST['nom_contrat']),
            'categorie' => sanitize_text_field($_POST['categorie']),
            'date_debut' => sanitize_text_field($_POST['date_debut']),
            'date_fin' => sanitize_text_field($_POST['date_fin']),
            'adresse_societe' => sanitize_textarea_field($_POST['adresse_societe']),
            'identifiant' => sanitize_text_field($_POST['identifiant']),
            'numero_contrat' => sanitize_text_field($_POST['numero_contrat']),
            'telephone_societe' => sanitize_text_field($_POST['telephone_societe']),
            'email_societe' => sanitize_email($_POST['email_societe']),
            'montant' => floatval($_POST['montant']),
            'description' => sanitize_textarea_field($_POST['description'])
        );

        update_user_meta($user_id, $contract_key, $contract_data);
        wp_redirect(add_query_arg('message', 'updated', get_permalink()));
        exit;
    }
}

// Traitement de la suppression du contrat
if (isset($_POST['delete_contract'])) {
    if (!wp_verify_nonce($_POST['delete_contract_nonce'], 'delete_contract')) {
        wp_die('Invalid nonce');
    }

    $user_id = get_current_user_id();
    $contract_key = sanitize_text_field($_POST['contract_key']);

    if (delete_user_meta($user_id, $contract_key)) {
        wp_redirect(add_query_arg('message', 'deleted', get_permalink()));
        exit;
    }
}

// Récupérer tous les contrats de l'utilisateur
$user_meta = get_user_meta($user_id);
$contrats = [];

foreach ($user_meta as $key => $value) {
    if (strpos($key, 'contrat_') === 0) {
        $contrats[$key] = maybe_unserialize($value[0]);
    }
}

// Fonction pour afficher les messages
function afficher_message() {
    if (isset($_GET['message'])) {
        $message = sanitize_text_field($_GET['message']);
        $class = '';
        $text = '';

        switch ($message) {
            case 'updated':
                $class = 'bg-green-100 text-green-700';
                $text = 'Le contrat a été mis à jour avec succès.';
                break;
            case 'deleted':
                $class = 'bg-red-100 text-red-700';
                $text = 'Le contrat a été supprimé avec succès.';
                break;
            // ...existing cases...
        }

        if ($text) {
            echo '<div class="mt-4 mb-4 p-4 rounded-lg ' . esc_attr($class) . '">' . esc_html($text) . '</div>';
        }
    }
}
?>

<style>
    .desktop-header {
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(59, 130, 246, 0.1);
        backdrop-filter: blur(0px);
    }

    header {
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(17, 24, 39, 0.8);
        backdrop-filter: blur(8px);
    }

    #mobileMenu {
        transition: transform 0.3s ease-in-out;
        background-color: rgba(17, 24, 39, 1);
    }

    #mobileMenu.open {
        transform: translateX(0);
    }

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
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(10px);
        }
    }

    .modal.closing {
        animation: modalBackdropFadeOut 0.2s ease-in forwards;
    }

    @keyframes modalBackdropFadeOut {
        from {
            backdrop-filter: blur(8px);
            background-color: rgba(0, 0, 0, 0.5);
        }

        to {
            backdrop-filter: blur(0px);
            background-color: rgba(0, 0, 0, 0);
        }
    }

    /* Ajout des styles pour l'effet blur */
    main.blur {
        filter: blur(4px);
        transition: filter 0.3s ease;
        pointer-events: none;
    }

    header.blur {
        filter: blur(4px);
        transition: filter 0.3s ease;
        pointer-events: none;
    }
</style>
</head>

<body class="min-h-screen grid grid-rows-[auto_1fr_auto]">

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

    <main class="container mx-auto px-4 sm:px-6 py-8 min-h-[calc(100vh-300px)]">
        <?php afficher_message(); ?>
        <h1 class="text-2xl sm:text-3xl font-bold mb-8">Vos documents</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="relative col-span-1">
                <input type="search" placeholder="Rechercher" class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 col-span-1 md:col-span-2">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Trier par</button>
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">date d'ajout</button>
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Date de signature</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 justify-self-end">Tout sélectionner</button>
            </div>
        </div>

        <div class="grid gap-4">
            <?php if (!empty($contrats)) : ?>
                <?php foreach ($contrats as $key => $contrat) : ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="grid grid-cols-[2px_1fr]">
                            <div class="bg-slate-900"></div>
                            <div class="p-4">
                                <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Désignation</p>
                                            <p><?php echo esc_html($contrat['nom_contrat']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Société</p>
                                            <p><?php echo esc_html($contrat['email_societe']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Catégorie</p>
                                            <p><?php echo esc_html($contrat['categorie']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Signature du contrat</p>
                                            <p><?php echo esc_html($contrat['date_debut']); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Date d'ajout</p>
                                            <p><?php echo esc_html(date('d/m/Y', strtotime($contrat['date_fin']))); ?></p>
                                        </div>
                                    </div>
                                    <div class="grid gap-2 items-center">
                                        <label class="grid grid-cols-[auto_1fr] items-center">
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                                            <span class="sr-only">Sélectionner</span>
                                        </label>
                                        <div class="grid grid-cols-2 gap-2">
                                            <button type="button" 
                                                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md" 
                                                    onclick="openModal('<?php echo esc_js($key); ?>')"
                                                    data-contract='<?php echo json_encode($contrat); ?>'
                                                    data-key="<?php echo esc_attr($key); ?>">
                                                Modifier
                                            </button>
                                            <button type="button"
                                                    class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-md"
                                                    onclick="confirmDelete('<?php echo esc_js($key); ?>', '<?php echo esc_js($contrat['nom_contrat']); ?>')">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-gray-500">Aucun contrat trouvé.</p>
            <?php endif; ?>
        </div>

        <a href="<?php echo esc_url(home_url('/ajouter-contrat')); ?>">
            <button class="w-full py-4 bg-gray-100 hover:bg-gray-200 rounded-lg text-center mt-4">
                <span class="text-2xl mr-2">+</span>
                Ajouter un contrat
            </button>
        </a>
    </main>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content bg-white w-full max-w-5xl mx-4 rounded-lg shadow-xl">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b">
                <h2 class="text-xl font-semibold">Modifier le document</h2>
                <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-4" method="POST" action="">
                <input type="hidden" name="contract_key" id="contract_key">
                <?php wp_nonce_field('edit_contract', 'edit_contract_nonce'); ?>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="grid gap-2">
                            <label class="font-medium">Nom du contrat</label>
                            <input type="text" name="nom_contrat" id="modal_nom_contrat" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Catégorie</label>
                            <input type="text" name="categorie" id="modal_categorie" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Date de début</label>
                            <input type="date" name="date_debut" id="modal_date_debut" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Date de fin</label>
                            <input type="date" name="date_fin" id="modal_date_fin" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Identifiant</label>
                            <input type="text" name="identifiant" id="modal_identifiant" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Montant</label>
                            <input type="number" name="montant" id="modal_montant" class="w-full p-2 border rounded-md" required>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="grid gap-2">
                            <label class="font-medium">Numéro de contrat</label>
                            <input type="text" name="numero_contrat" id="modal_numero_contrat" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Téléphone société</label>
                            <input type="tel" name="telephone_societe" id="modal_telephone_societe" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Email société</label>
                            <input type="email" name="email_societe" id="modal_email_societe" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Adresse société</label>
                            <textarea name="adresse_societe" id="modal_adresse_societe" class="w-full p-2 border rounded-md" rows="3" required></textarea>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Description</label>
                            <textarea name="description" id="modal_description" class="w-full p-2 border rounded-md" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-[auto_auto] justify-end gap-4 mt-6 pt-4 border-t">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-md hover:bg-gray-50">Annuler</button>
                    <button type="submit" name="edit_contract" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content bg-white w-full max-w-md mx-4 rounded-lg shadow-xl">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b">
                <h2 class="text-xl font-semibold text-gray-900">Supprimer le contrat</h2>
                <button onclick="closeDeleteModal()" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                <p class="text-gray-500 text-center mb-6" id="deleteConfirmText"></p>
                <form method="POST" action="" class="grid grid-cols-2 gap-3">
                    <?php wp_nonce_field('delete_contract', 'delete_contract_nonce'); ?>
                    <input type="hidden" name="contract_key" id="delete_contract_key">
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" 
                            name="delete_contract" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200 font-medium">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(contractKey) {
            const button = document.querySelector(`button[data-key="${contractKey}"]`);
            const contractData = JSON.parse(button.dataset.contract);
            
            // Remplir les champs de la modal avec les données du contrat
            document.getElementById('contract_key').value = contractKey;
            document.getElementById('modal_nom_contrat').value = contractData.nom_contrat;
            document.getElementById('modal_categorie').value = contractData.categorie;
            document.getElementById('modal_date_debut').value = contractData.date_debut;
            document.getElementById('modal_date_fin').value = contractData.date_fin;
            document.getElementById('modal_adresse_societe').value = contractData.adresse_societe;
            document.getElementById('modal_identifiant').value = contractData.identifiant;
            document.getElementById('modal_numero_contrat').value = contractData.numero_contrat;
            document.getElementById('modal_telephone_societe').value = contractData.telephone_societe;
            document.getElementById('modal_email_societe').value = contractData.email_societe;
            document.getElementById('modal_montant').value = contractData.montant;
            document.getElementById('modal_description').value = contractData.description || '';

            // Afficher la modal (suppression de la création du bouton fixe)
            document.getElementById('editModal').classList.add('active');
            document.querySelector('main').classList.add('blur');
            document.querySelector('header').classList.add('blur');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            const modalContent = modal.querySelector('.modal-content');
            
            modal.classList.add('closing');
            modalContent.classList.add('closing');
            
            setTimeout(() => {
                modal.classList.remove('active', 'closing');
                modalContent.classList.remove('closing');
                document.querySelector('main').classList.remove('blur');
                document.querySelector('header').classList.remove('blur');
                document.body.style.overflow = '';
            }, 200);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.modal-content');
            
            modal.classList.add('closing');
            modalContent.classList.add('closing');
            
            setTimeout(() => {
                modal.classList.remove('active', 'closing');
                modalContent.classList.remove('closing');
                document.querySelector('main').classList.remove('blur');
                document.querySelector('header').classList.remove('blur');
                document.body.style.overflow = '';
            }, 200);
        }

        // Fermer le modal en cliquant en dehors
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this && !this.classList.contains('closing')) {
                closeModal();
            }
        });

        function confirmDelete(contractKey, contractName) {
            document.getElementById('delete_contract_key').value = contractKey;
            document.getElementById('deleteConfirmText').textContent = 
                `Êtes-vous sûr de vouloir supprimer le contrat "${contractName}" ? Cette action est irréversible et supprimera définitivement toutes les données associées.`;
            
            document.getElementById('deleteModal').classList.add('active');
            document.querySelector('main').classList.add('blur');
            document.querySelector('header').classList.add('blur');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('.modal-content');
            
            modal.classList.add('closing');
            modalContent.classList.add('closing');
            
            setTimeout(() => {
                modal.classList.remove('active', 'closing');
                modalContent.classList.remove('closing');
                document.querySelector('main').classList.remove('blur');
                document.querySelector('header').classList.remove('blur');
                document.body.style.overflow = '';
            }, 200);
        }

        // Fermer la modal de suppression en cliquant en dehors
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this && !this.classList.contains('closing')) {
                closeDeleteModal();
            }
        });
    </script>

    <?php
    get_footer();
    ?>