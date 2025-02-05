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

// Modifier le traitement PHP de la suppression
if (isset($_POST['delete_contract'])) {
    if (!wp_verify_nonce($_POST['delete_contract_nonce'], 'delete_contract')) {
        wp_die('Invalid nonce');
    }

    $user_id = get_current_user_id();
    $contract_keys = isset($_POST['contract_keys']) ? $_POST['contract_keys'] : [];
    
    if (!empty($contract_keys)) {
        $success = true;
        foreach ($contract_keys as $key) {
            if (!delete_user_meta($user_id, sanitize_text_field($key))) {
                $success = false;
            }
        }
        
        if ($success) {
            wp_redirect(add_query_arg('message', 'deleted', get_permalink()));
            exit;
        }
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

    /* Mettre à jour les styles pour les boutons de tri */
    #sortButton span,
    #sortMenu button {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #sortButton,
    #sortDirection {
        justify-content: space-between;
    }

    @media (max-width: 640px) {
        #sortButton,
        #sortDirection {
            font-size: 0.875rem;
        }
        
        #sortButton span {
            max-width: 120px;
        }
    }

    /* Mettre à jour les styles pour les boutons de tri */
    #sortButton,
    #sortDirection {
        width: 100%;
        justify-content: space-between;
    }

    @media (max-width: 768px) {
        #sortButton,
        #sortDirection {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        #sortButton,
        #sortDirection {
            font-size: 0.875rem;
        }
        
        #sortButton span {
            max-width: 150px;
        }
    }

    /* Ajouter ces styles pour la modal responsive */
    .modal-content {
        margin: 1rem;
        max-height: calc(100vh - 2rem);
        display: flex;
        flex-direction: column;
    }

    .modal-content form {
        flex: 1;
        overflow-y: auto;
    }

    @media (max-width: 640px) {
        .modal-content {
            margin: 0;
            max-height: 100vh;
            height: 100vh;
            border-radius: 0;
        }
    }

    /* Ajuster les styles du formulaire pour mobile */
    @media (max-width: 768px) {
        .modal-content form {
            padding: 1rem;
        }
        
        .modal-content input,
        .modal-content textarea {
            font-size: 16px; /* Empêche le zoom sur iOS */
        }
    }
</style>
</head>

<body>
    <?php get_template_part('template-parts/user-navigation'); ?>

    <main class="container mx-auto px-4 sm:px-6 py-8 min-h-[calc(100vh-300px)]">
        <?php afficher_message(); ?>
        <h1 class="text-2xl sm:text-3xl font-bold mb-8">Vos contrats</h1>

        <div class="grid grid-cols-1 md:grid-cols-[1fr_auto_auto] gap-4 mb-6">
            <!-- Barre de recherche -->
            <div class="relative">
                <input type="search" placeholder="Rechercher" class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Bouton de tri -->
            <div class="relative w-[200px]">
                <button id="sortButton" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 grid grid-cols-[1fr_auto] items-center gap-2">
                    <span class="truncate text-left">Trier par</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="sortMenu" class="hidden absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100 truncate" data-sort="nom_contrat">Nom du contrat</button>
                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100 truncate" data-sort="categorie">Catégorie</button>
                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100 truncate" data-sort="date_debut">Date de signature</button>
                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100 truncate" data-sort="date_ajout">Date d'ajout</button>
                </div>
            </div>

            <!-- Bouton de direction -->
            <button id="sortDirection" class="w-[140px] px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 grid grid-cols-[auto_1fr] items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span>Croissant</span>
            </button>
        </div>

        <!-- Ajouter après la barre de recherche et avant la liste des contrats -->
        <div class="flex justify-end mb-4">
            <button id="selectAllButton" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md border border-gray-300 inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>Tout sélectionner</span>
            </button>
        </div>

        <div id="contratsContainer" class="grid gap-4">
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
                                                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md disabled:opacity-50 disabled:cursor-not-allowed" 
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

        <div id="noResultsMessage" class="hidden">
            <p class="text-gray-500 text-center py-8">Aucun contrat trouvé.</p>
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
        <div class="modal-content bg-white w-[95%] max-w-5xl mx-auto rounded-lg shadow-xl overflow-y-auto max-h-[90vh]">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b sticky top-0 bg-white z-10">
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
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="grid gap-2">
                            <label class="font-medium">Nom du contrat *</label>
                            <input type="text" name="nom_contrat" id="modal_nom_contrat" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Catégorie *</label>
                            <input type="text" name="categorie" id="modal_categorie" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Date de début *</label>
                            <input type="date" name="date_debut" id="modal_date_debut" class="w-full p-2 border rounded-md" required>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Date de fin</label>
                            <input type="date" name="date_fin" id="modal_date_fin" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Identifiant *</label>
                            <input type="text" name="identifiant" id="modal_identifiant" data-required-group="id-contract" class="w-full p-2 border rounded-md">
                            <p class="text-sm text-gray-500">Remplir au moins l'identifiant ou le numéro de contrat</p>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Montant</label>
                            <input type="number" step="0.01" name="montant" id="modal_montant" class="w-full p-2 border rounded-md">
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="grid gap-2">
                            <label class="font-medium">Numéro de contrat *</label>
                            <input type="text" name="numero_contrat" id="modal_numero_contrat" data-required-group="id-contract" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Téléphone société</label>
                            <input type="tel" name="telephone_societe" id="modal_telephone_societe" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Email société</label>
                            <input type="email" name="email_societe" id="modal_email_societe" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Adresse société *</label>
                            <textarea name="adresse_societe" id="modal_adresse_societe" class="w-full p-2 border rounded-md" rows="3" required></textarea>
                        </div>
                        <div class="grid gap-2">
                            <label class="font-medium">Description</label>
                            <textarea name="description" id="modal_description" class="w-full p-2 border rounded-md" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-[auto_auto] justify-end gap-4 mt-6 pt-4 border-t sticky bottom-0 bg-white">
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
                <h2 class="text-xl font-semibold text-gray-900">Supprimer le(s) contrat(s)</h2>
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
                <div id="deleteConfirmText" class="text-gray-500 text-center mb-6"></div>
                <form method="POST" action="" class="space-y-6">
                    <?php wp_nonce_field('delete_contract', 'delete_contract_nonce'); ?>
                    <div id="deleteContractKeys"></div>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" 
                                onclick="closeDeleteModal()" 
                                class="w-full px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                name="delete_contract" 
                                class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200 font-medium">
                            Supprimer
                        </button>
                    </div>
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
            const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            const deleteContractKeys = document.getElementById('deleteContractKeys');
            deleteContractKeys.innerHTML = ''; // Nettoyer les anciens champs cachés
            
            let message = '';
            
            if (selectedCheckboxes.length > 0) {
                // Suppression multiple via les checkboxes
                const contractElements = Array.from(selectedCheckboxes).map(checkbox => {
                    const contractDiv = checkbox.closest('.bg-white');
                    const contractName = contractDiv.querySelector('div:nth-child(1) p:nth-child(2)').textContent;
                    const contractKey = contractDiv.querySelector('button[data-key]').dataset.key;
                    
                    // Ajouter un champ caché pour chaque contrat
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'contract_keys[]';
                    input.value = contractKey;
                    deleteContractKeys.appendChild(input);
                    
                    return `"${contractName}"`;
                });
                
                message = `Êtes-vous sûr de vouloir supprimer les contrats suivants ?\n${contractElements.join(', ')}\n\nCette action est irréversible.`;
            } else {
                // Suppression simple via le bouton supprimer
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'contract_keys[]';
                input.value = contractKey;
                deleteContractKeys.appendChild(input);
                
                message = `Êtes-vous sûr de vouloir supprimer le contrat "${contractName}" ? Cette action est irréversible.`;
            }
            
            document.getElementById('deleteConfirmText').innerHTML = message.replace(/\n/g, '<br>');
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

        // Fonction de validation des champs de la modal
        function validateModalFields() {
            const modal = document.getElementById('editModal');
            modal.querySelectorAll('.error-message').forEach(msg => msg.remove());
            
            let isValid = true;
            
            // Champs obligatoires
            const requiredFields = {
                'nom_contrat': 'Nom du contrat',
                'categorie': 'Catégorie',
                'date_debut': 'Date de début',
                'adresse_societe': 'Adresse société'
            };

            // Vérifier les champs obligatoires
            Object.entries(requiredFields).forEach(([fieldName, label]) => {
                const field = modal.querySelector(`[name="${fieldName}"]`);
                if (!field.value.trim()) {
                    showError(field, `Le champ ${label} est obligatoire`);
                    isValid = false;
                }
            });

            // Validation identifiant/numéro de contrat
            const idField = modal.querySelector('[name="identifiant"]');
            const numField = modal.querySelector('[name="numero_contrat"]');
            if (!idField.value.trim() && !numField.value.trim()) {
                showError(idField, 'Veuillez remplir au moins l\'identifiant ou le numéro de contrat');
                idField.classList.add('border-red-500');
                numField.classList.add('border-red-500');
                isValid = false;
            }

            // Validation email
            const emailField = modal.querySelector('[name="email_societe"]');
            if (emailField.value && !emailField.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showError(emailField, 'Adresse email invalide');
                isValid = false;
            }

            // Validation téléphone
            const telField = modal.querySelector('[name="telephone_societe"]');
            if (telField.value && !telField.value.match(/^[0-9+\s-]{10,}$/)) {
                showError(telField, 'Numéro de téléphone invalide');
                isValid = false;
            }

            // Validation dates
            const dateDebut = modal.querySelector('[name="date_debut"]');
            const dateFin = modal.querySelector('[name="date_fin"]');
            if (dateFin.value && new Date(dateFin.value) < new Date(dateDebut.value)) {
                showError(dateFin, 'La date de fin doit être postérieure à la date de début');
                isValid = false;
            }

            // Validation montant
            const montantField = modal.querySelector('[name="montant"]');
            if (montantField.value && parseFloat(montantField.value) <= 0) {
                showError(montantField, 'Le montant doit être supérieur à 0');
                isValid = false;
            }

            return isValid;
        }

        function showError(field, message) {
            field.classList.add('border-red-500');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-red-500 text-sm mt-1';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        }

        // Nettoyer les erreurs lors de la saisie
        document.querySelectorAll('#editModal input, #editModal textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                const errorMessages = this.parentNode.querySelectorAll('.error-message');
                errorMessages.forEach(msg => msg.remove());

                // Pour le groupe identifiant/numéro de contrat
                if (this.dataset.requiredGroup === 'id-contract') {
                    const otherInput = this.name === 'identifiant' 
                        ? document.querySelector('[name="numero_contrat"]')
                        : document.querySelector('[name="identifiant"]');
                    if (this.value.trim()) {
                        otherInput.classList.remove('border-red-500');
                        const groupErrors = document.querySelectorAll('[data-required-group="id-contract"] + .error-message');
                        groupErrors.forEach(msg => msg.remove());
                    }
                }
            });
        });

        // Modifier le gestionnaire de soumission du formulaire de la modal
        document.querySelector('#editModal form').addEventListener('submit', function(e) {
            if (!validateModalFields()) {
                e.preventDefault();
            }
        });

        // Ajouter des écouteurs pour les champs identifiant/numéro de contrat
        document.querySelectorAll('#editModal [name="identifiant"], #editModal [name="numero_contrat"]').forEach(input => {
            input.addEventListener('input', function() {
                const modal = document.getElementById('editModal');
                const otherInput = this.name === 'identifiant' 
                    ? modal.querySelector('[name="numero_contrat"]')
                    : modal.querySelector('[name="identifiant"]');
                    
                if (this.value.trim()) {
                    this.classList.remove('border-red-500');
                    otherInput.classList.remove('border-red-500');
                    const errorMessages = this.parentNode.querySelectorAll('.error-message');
                    errorMessages.forEach(msg => msg.remove());
                }
            });
        });

        // Ajouter des écouteurs pour nettoyer les erreurs lors de la saisie
        document.querySelectorAll('#editModal input, #editModal textarea').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                const errorMessages = this.parentNode.querySelectorAll('.error-message');
                errorMessages.forEach(msg => msg.remove());
            });
        });

        // Fonctionnalités de tri
        document.addEventListener('DOMContentLoaded', function() {
            const sortButton = document.getElementById('sortButton');
            const sortMenu = document.getElementById('sortMenu');
            const sortDirection = document.getElementById('sortDirection');
            const contratsContainer = document.getElementById('contratsContainer');
            let currentSort = 'nom_contrat';
            let isAscending = true;

            // Toggle menu de tri
            sortButton.addEventListener('click', () => {
                sortMenu.classList.toggle('hidden');
            });

            // Fermer le menu si on clique en dehors
            document.addEventListener('click', (e) => {
                if (!sortButton.contains(e.target) && !sortMenu.contains(e.target)) {
                    sortMenu.classList.add('hidden');
                }
            });

            // Toggle direction du tri
            sortDirection.addEventListener('click', () => {
                isAscending = !isAscending;
                sortDirection.querySelector('span').textContent = isAscending ? 'Croissant' : 'Décroissant';
                sortDirection.querySelector('svg').style.transform = isAscending ? 'rotate(0deg)' : 'rotate(180deg)';
                sortContrats(currentSort, isAscending);
            });

            // Gestionnaire de tri pour chaque option
            sortMenu.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', () => {
                    currentSort = button.dataset.sort;
                    const buttonText = button.textContent.trim();
                    sortButton.querySelector('span').textContent = `Trié par : ${buttonText}`;
                    sortButton.querySelector('span').title = `Trié par : ${buttonText}`; // Ajouter un tooltip
                    sortMenu.classList.add('hidden');
                    sortContrats(currentSort, isAscending);
                });
            });

            // Fonction de tri des contrats
            function sortContrats(sortBy, ascending) {
                const contrats = Array.from(contratsContainer.children);
                
                contrats.sort((a, b) => {
                    let valA, valB;
                    
                    switch(sortBy) {
                        case 'nom_contrat':
                            valA = a.querySelector('p:nth-child(2)').textContent.toLowerCase();
                            valB = b.querySelector('p:nth-child(2)').textContent.toLowerCase();
                            break;
                        case 'categorie':
                            valA = a.querySelector('div:nth-child(3) p:nth-child(2)').textContent.toLowerCase();
                            valB = b.querySelector('div:nth-child(3) p:nth-child(2)').textContent.toLowerCase();
                            break;
                        case 'date_debut':
                            valA = new Date(a.querySelector('div:nth-child(4) p:nth-child(2)').textContent);
                            valB = new Date(b.querySelector('div:nth-child(4) p:nth-child(2)').textContent);
                            break;
                        case 'date_ajout':
                            valA = new Date(a.querySelector('div:nth-child(5) p:nth-child(2)').textContent.split('/').reverse().join('-'));
                            valB = new Date(b.querySelector('div:nth-child(5) p:nth-child(2)').textContent.split('/').reverse().join('-'));
                            break;
                        default:
                            return 0;
                    }

                    if (sortBy.includes('date')) {
                        return ascending ? valA - valB : valB - valA;
                    }
                    
                    return ascending ? 
                        valA.localeCompare(valB) : 
                        valB.localeCompare(valA);
                });

                // Réinjecter les éléments triés
                contrats.forEach(contrat => {
                    contratsContainer.appendChild(contrat);
                });
            }

            // Initialiser le tri par défaut
            sortContrats(currentSort, isAscending);
        });

        // Fonctionnalité de recherche
        const searchInput = document.querySelector('input[type="search"]');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const contrats = document.querySelectorAll('#contratsContainer > div');
            const noResultsMessage = document.getElementById('noResultsMessage');
            let hasVisibleContracts = false;
            
            contrats.forEach(contrat => {
                const nom = contrat.querySelector('div:nth-child(1) p:nth-child(2)').textContent.toLowerCase();
                const categorie = contrat.querySelector('div:nth-child(3) p:nth-child(2)').textContent.toLowerCase();
                const email = contrat.querySelector('div:nth-child(2) p:nth-child(2)').textContent.toLowerCase();
                
                if (nom.includes(searchTerm) || categorie.includes(searchTerm) || email.includes(searchTerm)) {
                    contrat.style.display = '';
                    hasVisibleContracts = true;
                } else {
                    contrat.style.display = 'none';
                }
            });

            // Afficher ou masquer le message "Aucun contrat trouvé"
            noResultsMessage.style.display = hasVisibleContracts ? 'none' : 'block';
        });

        // Ajouter après les autres événements DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            // ... existing code ...

            // Gestion de la sélection multiple
            const selectAllButton = document.getElementById('selectAllButton');
            let isAllSelected = false;

            // Fonction pour mettre à jour l'état des boutons de modification
            function updateModifyButtons() {
                const checkedBoxes = document.querySelectorAll('input[type="checkbox"]:checked').length;
                const modifyButtons = document.querySelectorAll('button[onclick^="openModal"]');
                
                modifyButtons.forEach(button => {
                    if (checkedBoxes > 1) {
                        button.disabled = true;
                        button.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        button.disabled = false;
                        button.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
            }

            // Gérer le clic sur "Tout sélectionner"
            selectAllButton.addEventListener('click', function() {
                isAllSelected = !isAllSelected;
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                
                checkboxes.forEach(checkbox => {
                    checkbox.checked = isAllSelected;
                });

                // Mettre à jour le texte du bouton
                this.querySelector('span').textContent = isAllSelected ? 'Tout désélectionner' : 'Tout sélectionner';
                
                // Mettre à jour l'état des boutons de modification
                updateModifyButtons();
            });

            // Ajouter des écouteurs sur chaque checkbox
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allCheckboxes = document.querySelectorAll('input[type="checkbox"]');
                    const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                    
                    // Mettre à jour l'état du bouton "Tout sélectionner"
                    isAllSelected = allCheckboxes.length === checkedCheckboxes.length;
                    selectAllButton.querySelector('span').textContent = isAllSelected ? 'Tout désélectionner' : 'Tout sélectionner';
                    
                    // Mettre à jour l'état des boutons de modification
                    updateModifyButtons();
                });
            });
        });
    </script>

    <?php
    get_footer();
    ?>
</body>
</html>