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
<?php get_template_part('template-parts/user-navigation'); ?>
    </header>
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