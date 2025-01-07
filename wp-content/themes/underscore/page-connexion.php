<?php
/**
 * Template Name: Connexion
 * version: 1.0
 * Description: Page de connexion
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">
    <?php get_template_part('template-parts/navigation'); ?>
    <!-- Header -->
    <header class="grid grid-cols-2 items-center p-4 bg-white border-b border-gray-200">
        <button class="bg-white text-black border border-black px-4 py-2 rounded-lg justify-self-end hover:bg-gray-100">
            S'inscrire
        </button>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Formulaire Ultimate Member -->
            <div class="test">
                <?php echo do_shortcode('[ultimatemember form_id="323"]'); // Remplacez "123" par l'ID de votre formulaire de connexion ?>
            </div>
        </div>
    </main>
</body>
<?php get_footer(); ?>