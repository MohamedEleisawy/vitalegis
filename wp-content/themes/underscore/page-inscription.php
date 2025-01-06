<?php
/**
 * Template Name: Inscription
 * version: 1.0
 * Description: Page d'inscription
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">
    <?php get_template_part('template-parts/navigation'); ?>
    <!-- Header -->
    <header class="grid grid-cols-2 items-center p-4 bg-white border-b border-gray-200">
        <div class="bg-gray-300 rounded-lg px-6 py-2 w-max">
            <span class="font-bold text-gray-800">LOGO</span>
        </div>
        <button class="bg-white text-black border border-black px-4 py-2 rounded-lg justify-self-end hover:bg-gray-100">
            Se connecter
        </button>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">

            <!-- Formulaire Ultimate Member -->
            <div class="test">
                <?php echo do_shortcode('[ultimatemember form_id="322"]'); ?>
            </div>
        </div>
    </main>
</body>
<?php get_footer(); ?>