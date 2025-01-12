<?php
/*
Template Name: Espace utilisateur
Version: 1.0
Description: Page espace utilisateur
Author: Damien Hourriez
*/

get_template_part('template-parts/head'); ?>

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
        animation: modalFadeIn 0.3s ease-out;
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
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="grid grid-cols-[2px_1fr]">
                    <div class="bg-slate-900"></div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Désignation</p>
                                    <p>Assurance vie</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Société</p>
                                    <p>Axa</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Catégorie</p>
                                    <p>Assurance</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">signature du contrat</p>
                                    <p>11 janvier 2024</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date d'ajout</p>
                                    <p>24 novembre 2024</p>
                                </div>
                            </div>
                            <div class="grid gap-2 items-center">
                                <label class="grid grid-cols-[auto_1fr] items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                                    <span class="sr-only">Sélectionner</span>
                                </label>
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md" onclick="openModal()">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?php echo esc_url(home_url('/ajouter-contrat')); ?>">

            <button class="w-full py-4 bg-gray-100 hover:bg-gray-200 rounded-lg text-center mt-4">
                <span class="text-2xl mr-2">+</span>
                Ajouter un contrat
            </button>
        </a>

        <!-- <div class="flex justify-end gap-2 mt-6">
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-50">1</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-50">2</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-50">3</button>
        </div> -->
    </main>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content bg-white w-full max-w-lg mx-4 rounded-lg shadow-xl">
            <div class="grid grid-cols-[1fr_auto] items-center p-4 border-b">
                <h2 class="text-xl font-semibold">Modifier le document</h2>
                <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-4 grid gap-4">
                <div class="grid gap-2">
                    <label class="font-medium">Désignation</label>
                    <input type="text" class="w-full p-2 border rounded-md" value="Assurance vie">
                </div>
                <div class="grid gap-2">
                    <label class="font-medium">Société</label>
                    <input type="text" class="w-full p-2 border rounded-md" value="Axa">
                </div>
                <div class="grid gap-2">
                    <label class="font-medium">Catégorie</label>
                    <select class="w-full p-2 border rounded-md">
                        <option>Assurance</option>
                        <option>Banque</option>
                        <option>Immobilier</option>
                    </select>
                </div>
                <div class="grid gap-2">
                    <label class="font-medium">Date de signature</label>
                    <input type="date" class="w-full p-2 border rounded-md">
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-md hover:bg-gray-50">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('editModal').classList.add('active');
            document.querySelector('main').classList.add('blur');
            document.querySelector('header').classList.add('blur');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('editModal').classList.remove('active');
            document.querySelector('main').classList.remove('blur');
            document.querySelector('header').classList.remove('blur');
            document.body.style.overflow = '';
        }

        // Fermer le modal en cliquant en dehors
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

    <?php
    get_footer();
    ?>