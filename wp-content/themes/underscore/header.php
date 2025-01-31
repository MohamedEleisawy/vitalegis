<body <?php body_class('min-h-screen bg-gray-900 text-gray-100'); ?>>
    <?php get_template_part('template-parts/navigation'); ?>

    <header id="Accueil">
        <section
            id="hero"
            class="relative min-h-screen grid place-items-center text-center overflow-hidden"
            style="background-color: <?= esc_attr(get_field('hero_background_color')); ?>;">
            <?php
            $default_image = get_template_directory_uri() . '/assets/images/montagne.png';
            $image_data = get_field('image_hero') ? get_field('image_hero') : $default_image;
            $hero_title = get_field('hero_title')  ?: ' Faciliter vos démarches avec Vitalegis';
            $hero_subtitle = get_field('hero_subtitle' ) ?: ' Gestion de contrats et accompagnement';
            $hero_button_text = get_field('hero_button_text' ) ?: 'Commencer'; 
            $hero_title_color = get_field('hero_title_color' ?: '#000000');
            $hero_subtitle_color = get_field('hero_subtitle_color' ?: '#000000');
            $hero_button_bg_color = get_field('hero_button_background_color' ?: '#000000');
            $hero_button_text_color = get_field('hero_button_text_color' ?: '#000000');
            ?>
            <div id="parallaxBg" class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('<?= esc_url($image_data); ?>');"></div>
            <div class="relative z-10 space-y-8 bg-white/60 max-w-[850px] p-8 rounded-[30px]">
                <h1
                    class="text-3xl md:text-6xl font-bold font-gogh"
                    style="color: <?= esc_attr($hero_title_color); ?>;">
                    <?php echo esc_html($hero_title); ?>
                </h1>
                <p
                    class="text-xl md:text-xl font-montserrat"
                    style="color: <?= esc_attr($hero_subtitle_color); ?>;">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
                <button
                    class="px-8 py-3 rounded-lg text-lg hover:bg-opacity-80 transition-colors duration-300 min-w-[150px]"
                    style="background-color: <?= esc_attr($hero_button_bg_color); ?>; color: <?= esc_attr($hero_button_text_color); ?>;">
                    <a href="<?php echo get_template_directory_uri(); ?>/inscription">
                        <?php echo esc_html($hero_button_text); ?>
                    </a>
                </button>
            </div>
        </section>
    </header>
</body>