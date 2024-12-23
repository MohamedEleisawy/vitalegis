<?php

/**
 * Template Name: Connexion
 * version: 1.0
 * Description: Page de connexion
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto_1fr_auto]">
<?php 
    // Récupération du titre de la page depuis le Personnaliseur
    $connexion_title = get_theme_mod('connexion_title', 'Connexion'); 
?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 grid mt-20 ">
        <div class="max-w-md mx-auto grid gap-8">
            <button class="justify-self-start mt-4 ">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
           
            <h1 class="text-2xl md:text-3xl font-bold text-center font-gogh">
    <?php echo esc_html($connexion_title); ?>
</h1>

            <form class="grid gap-6">
                <div class="grid gap-2">
                    <label>Adresse mail</label>
                    <input type="email" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
                </div>

                <div class="grid gap-2">
                    <label>Mot de passe</label>
                    <input type="password" class="w-full p-3 rounded-lg bg-gray-100 border border-gray-300" required>
                    <div class="justify-self-end">
                        <a href="#" class="text-sm italic text-gray-600">Mot de passe oublié ?</a>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-full hover:bg-gray-800">
                    Valider
                </button>
            </form>

            <div class="text-center text-gray-600 grid gap-1">
                <p>Vous n'avez pas de compte ?</p>
                <a href="#" class="underline">Créer votre compte ici</a>
            </div>
        </div>
    </main>
</body>

<?php get_footer(); ?>