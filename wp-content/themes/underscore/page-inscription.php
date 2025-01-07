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
<header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800">Inscription</h1>
    </div>
</header>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">

            <!-- Formulaire Ultimate Member -->
            <div class="test">
                <?php echo do_shortcode('[ultimatemember form_id="322"]'); ?>
            </div>
        </div>
    </main>
</body>
<?php get_footer(); ?>