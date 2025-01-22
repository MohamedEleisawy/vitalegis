<footer style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fond-footer.png');"
    class="bg-gray-900 py-8 px-6"> <!-- Reduced padding from py-12 to py-8 -->
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Div du logo à gauche -->
            <div class="grid gap-2">
                <div class="px-6 py-2">
                    <a href="<?php echo home_url(); ?>" class="font-bold text-blue-600">
                        <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-20 md:h-20" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dore.png" alt="Logo du site Vitalegis">
                    </a>
                </div>
                <!-- met le texte en gras  -->
                <p class="text-gray-300 font-semibold">
                    <?php echo get_field('slogan') ?: 'Simplifiez vos démarches administratives après un décès.'; ?>
                </p>
                <p class="text-gray-300">
                    <a href="mailto:<?php echo get_field('email') ?: 'contact@exemple.com'; ?>" class="__cf_email__">
                        <?php echo get_field('email') ?: 'contact@exemple.com'; ?>
                    </a>
                </p>
                <p class="text-gray-300">
                    <?php echo get_field('telephone') ?: '01 23 45 67 89'; ?>
                </p>
            </div>

            <!-- Div des Réseaux sociaux et Légal à droite -->
            <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Réseaux sociaux -->
                <div class="grid gap-2 border-l border-gray-700 pl-8">
                    <h3 class="font-semibold text-white">Réseaux sociaux</h3>
                    <ul class="grid gap-2 text-gray-300">
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_x') ?: '#'; ?>" class="inline-block">
                                <i class="fab fa-twitter mr-2"></i> X
                            </a>
                        </li>
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_linkedin', 'option') ?: '#'; ?>" class="inline-block">
                                <i class="fab fa-linkedin mr-2"></i> LinkedIn
                            </a>
                        </li>
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_facebook', 'option') ?: '#'; ?>" class="inline-block">
                                <i class="fab fa-facebook mr-2"></i> Facebook
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Légal -->
                <div class="grid gap-2 border-l border-gray-700 pl-8">
                    <h3 class="font-semibold text-white">Légal</h3>
                    <ul class="grid gap-2 text-gray-300">
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_cookies', 'option') ?: '#'; ?>" class="inline-block">
                                Cookies
                            </a>
                        </li>
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_mentions_legales', 'option') ?: '#'; ?>" class="inline-block">
                                Mentions légales
                            </a>
                        </li>
                        <li class="hover:text-white transition-colors duration-300">
                            <a href="<?php echo get_field('lien_conditions_utilisation', 'option') ?: '#'; ?>" class="inline-block">
                                Conditions d'utilisations
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto text-center mt-8">
        <p class="text-gray-300">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tous droits réservés.</p>
        <?php wp_footer(); ?>
    </div>
</footer>

<!-- Intégration de Font Awesome -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>