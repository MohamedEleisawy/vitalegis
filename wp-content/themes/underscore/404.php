<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package underscore
 */
?>
<?php get_template_part('template-parts/head'); ?>

<main class="min-h-screen bg-slate-900 py-20">
    <div class="container mx-auto px-4">
        <div class="grid place-items-center gap-8 text-center">
            <!-- Numéro d'erreur -->
            <h1 class="text-[120px] md:text-[200px] font-bold text-[#EEC66C]
			leading-none">
                404
            </h1>

            <!-- Message principal -->
            <h2 class="text-2xl md:text-4xl text-white font-semibold">
                <?php esc_html_e('Oops! Cette page est introuvable.', 'underscore'); ?>
            </h2>

            <!-- Message secondaire -->
            <p class="text-lg text-gray-300 max-w-2xl">
                <?php esc_html_e("Il semble que la page que vous recherchez n'existe plus ou a été déplacée. Nous vous invitons à retourner à l'accueil.", 'underscore'); ?>
            </p>

            <!-- Bouton de retour -->
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="inline-block px-8 py-4 bg-[#EEC66C] text-slate-900 font-semibold rounded-lg hover:bg-[#FEFEF5] transition-colors">
                <?php esc_html_e('Retour à l\'accueil', 'underscore'); ?>
            </a>
        </div>
    </div>
</main>


<?php
get_footer();
