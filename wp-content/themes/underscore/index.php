<?php
/*
Template Name: Vitalegis
Version: 1.0

*/
?>
<?php get_template_part('template-parts/head'); ?>
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
</style>
</head>
<?php
get_header();
?>
<main class="site-main container mx-auto px-4 py-8">
    <!-- section avec 3 images avec 1 texte description -->

    <!-- Section 1: Image à gauche, texte à droite (mobile: image en premier) -->
    <section id="A-propos" class="py-12">
        <?php
        $image1 = get_field('image_a_propos_1');
        $alt_image_1 = get_post_meta(post_id: $image1, key: '_wp_attachment_image_alt', single: true);
        $titre1 = get_field('titre_a_propos_1');
        $description1 = get_field(selector: 'description_a_propos_1');


        $image2 = get_field('image_a_propos_2');
        $titre2 = get_field('titre_a_propos_2');
        $description2 = get_field('description_a_propos_2');
        $alt_image_2 = get_post_meta($image2, '_wp_attachment_image_alt', true);

        $image3 = get_field('image_a_propos_3');
        $titre3 = get_field('titre_a_propos_3');
        $description3 = get_field('description_a_propos_3');
        $alt_image_3 = get_post_meta($image3, '_wp_attachment_image_alt', single: true);
        ?>
        <!-- Section 1 -->
        <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
            <div
                class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md">
                <img src="<?php echo esc_url($image1); ?>" alt="<?php echo esc_attr($alt_image_1) ?>"
                    class="parallax-img w-full h-full object-cover" />
            </div>
            <div class="space-y-6 px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-blue-300"><?php
                echo esc_html($titre1); ?></h2>
                <p class="text-white leading-relaxed"><?php echo esc_html($description1); ?></p>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
            <div class="space-y-6 px-4 md:px-0 order-2 md:order-none">
                <h2 class="text-2xl font-semibold text-blue-300"><?php echo esc_html($titre2); ?></h2>
                <p class="text-white leading-relaxed"><?php echo esc_html($description2); ?></p>
            </div>

            <div
                class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
                <img src="<?php echo esc_url($image2); ?>" alt="<?php echo esc_attr($alt_image_2) ?>"
                    class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
            </div>
        </div>
        <!-- Section 3 -->
        <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
            <div
                class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
                <img src="<?php echo esc_url($image3); ?>" alt="<?php echo esc_attr($alt_image_3) ?>"
                    class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
            </div>

            <div class="space-y-6 px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-blue-300"><?php echo esc_html($titre3); ?></h2>
                <p class="text-white leading-relaxed"><?php echo esc_html($description3); ?></p>
            </div>
        </div>
    </section>



    <!-- Advantages Section -->
    <section class="py-20 bg-gray-800 relative">
        <div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/Fond-services-avantages.png');"
            class="absolute inset-0 opacity-10 bg-cover bg-center">
        </div>
        <div class="container mx-auto px-4 relative">
            <!-- Titre et sous-titre dynamiques -->
            <div class="grid gap-4 text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white">
                    <?php the_field('titre_section_avantages'); ?> <!-- Récupérer le titre -->
                </h2>
                <p class="text-gray-300">
                    <?php the_field('sous_titre_section_avantages'); ?> <!-- Récupérer le sous-titre -->
                </p>
            </div>

            <!-- Avantages dynamiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Avantage 1 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                        <?php echo get_field('icone_avantage_01'); ?> <!-- Icône avantage 2 -->

                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_avantage_1')); ?> <!-- Titre avantage 1 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_avantage_1')); ?> <!-- Description avantage 1 -->
                    </p>
                </div>

                <!-- Avantage 2 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_avantage_2')); ?> <!-- Titre avantage 2 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_avantage_2')); ?> <!-- Description avantage 2 -->
                    </p>
                </div>

                <!-- Avantage 3 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_avantage_3')); ?> <!-- Titre avantage 3 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_avantage_3')); ?> <!-- Description avantage 3 -->
                    </p>
                </div>
            </div>
        </div>
    </section>


    <?php
    // Récupération des champs ACF
    $titre = get_field('contact_titre');
    $description = get_field('contact_description');
    $avantage_1 = get_field('contact_avantage_1');
    $avantage_2 = get_field('contact_avantage_2');
    $avantage_3 = get_field('contact_avantage_3');
    $placeholder_nom = get_field('contact_placeholder_nom');
    $placeholder_prenom = get_field('contact_placeholder_prenom');
    $placeholder_email = get_field('contact_placeholder_email');
    $placeholder_telephone = get_field('contact_placeholder_telephone');
    $placeholder_projet = get_field('contact_placeholder_projet');
    $texte_bouton = get_field('contact_texte_bouton');

    // Couleurs dynamiques
    $background_color = get_field('contact_background_color') ?: '#f7f7f7';
    $text_color = get_field('contact_text_color') ?: '#333333';
    $button_color = get_field('contact_button_color') ?: '#1e3a8a';
    $button_hover_color = get_field('contact_button_hover_color') ?: '#2563eb';
    ?>

    <!-- Contact Section -->
    <section id="Contact" class="py-20" style="background-color: <?php echo esc_attr($background_color); ?>;">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="grid gap-4" style="color: <?php echo esc_attr($text_color); ?>;">
                    <h2 class="text-3xl font-bold"><?php echo esc_html($titre); ?></h2>
                    <p><?php echo esc_html($description); ?></p>
                    <div class="grid gap-4">
                        <?php if ($avantage_1): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($button_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_1); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($avantage_2): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($button_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_2); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($avantage_3): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($button_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_3); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <form class="bg-white shadow-lg rounded-lg p-6 grid gap-4">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" placeholder="<?php echo esc_attr($placeholder_nom); ?>"
                            class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="text" placeholder="<?php echo esc_attr($placeholder_prenom); ?>"
                            class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <input type="email" placeholder="<?php echo esc_attr($placeholder_email); ?>"
                        class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <input type="tel" placeholder="<?php echo esc_attr($placeholder_telephone); ?>"
                        class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <textarea placeholder="<?php echo esc_attr($placeholder_projet); ?>"
                        class="w-full px-3 py-2 rounded-2xl bg-gray-100 text-gray-900 min-h-[120px] transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <button type="submit" class="w-full py-2 rounded-full text-white transition-colors duration-300"
                        style="background-color: <?php echo esc_attr($button_color); ?>; 
                           color: white;"
                        onmouseover="this.style.backgroundColor='<?php echo esc_attr($button_hover_color); ?>'"
                        onmouseout="this.style.backgroundColor='<?php echo esc_attr($button_color); ?>'">
                        <?php echo esc_html($texte_bouton); ?>
                    </button>
                </form>
            </div>
        </div>
    </section>


</main>

<?php
get_footer();
?>