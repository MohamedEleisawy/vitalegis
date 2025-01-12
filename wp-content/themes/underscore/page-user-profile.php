<?php

/**
 * Template Name: User Profile
 * version: 1.0
 * Description: Page de profil utilisateur
 * author: Damien Hourriez
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">

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
                        <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                            class="px-4 py-2 hover:bg-gray-100">
                            Accès Héritier
                        </a>
                        <a href="<?php echo esc_url(home_url('/account')); ?>"
                            class="px-4 py-2 hover:bg-gray-100">
                            Mon compte
                        </a>
                        <a href="<?php echo esc_url(um_get_core_page('logout')); ?>"
                            class="px-4 py-2 hover:bg-gray-100">
                            Se déconnecter
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>*
    <!-- Header -->
    <header>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-4xl font-bold text-center text-gray-800">Profil utilisateur</h1>
        </div>
    </header>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="relative z-10"> <!-- Ajout de z-index -->
            <style>
                /* Force l'affichage du formulaire UM */
                .um-profile {
                    position: relative !important;
                    z-index: 1 !important;
                    display: block !important;
                    opacity: 1 !important;
                    visibility: visible !important;
                }

                .um-profile-body {
                    position: relative !important;
                    z-index: 2 !important;
                }
                .um-profile-nav-posts, .um-profile-nav-comments {
                    display: none !important;
                }
            </style>

            <?php echo do_shortcode('[ultimatemember form_id="324"]'); ?>
        </div>
    </main>
    <?php get_footer(); ?>