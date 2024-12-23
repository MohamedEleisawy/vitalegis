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
            $hero_title = get_field('hero_title');
            $hero_subtitle = get_field('hero_subtitle');
            $hero_button_text = get_field('hero_button_text');
            $hero_title_color = get_field('hero_title_color');
            $hero_subtitle_color = get_field('hero_subtitle_color');
            $hero_button_bg_color = get_field('hero_button_background_color');
            $hero_button_text_color = get_field('hero_button_text_color');
            ?>
            <div id="parallaxBg" class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('<?= esc_url($image_data); ?>');"></div>
            <div class="relative z-10 space-y-8">
                <h1
                    class="text-4xl md:text-6xl font-bold font-gogh"
                    style="color: <?= esc_attr($hero_title_color); ?>;">
                    <?php echo esc_html($hero_title); ?>
                </h1>
                <p
                    class="text-xl md:text-2xl font-montserrat"
                    style="color: <?= esc_attr($hero_subtitle_color); ?>;">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
                <button
                    class="px-8 py-3 rounded-full text-lg hover:bg-opacity-80 transition-colors duration-300"
                    style="background-color: <?= esc_attr($hero_button_bg_color); ?>; color: <?= esc_attr($hero_button_text_color); ?>;">
                    <?php echo esc_html($hero_button_text); ?>
                </button>
            </div>
        </section>
    </header>
</body>
