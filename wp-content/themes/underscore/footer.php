<footer
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/fond-footer.png');"
    class="bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="grid gap-2">
                <div class="px-6 py-2">
                    <a href="<?php echo home_url(); ?>" class="font-bold text-blue-600">
                        <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 " src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dore.png" alt="">
                    </a>
                </div>
                <p class="text-gray-300">Phrase type slogan</p>
                <p class="text-gray-300"><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                        data-cfemail="6b1b190406042b0c060a020745080406">[email&#160;protected]</a></p>
                <p class="text-gray-300">09 03 93 04 83</p>
            </div>
            <div class="grid gap-2">
                <h3 class="font-semibold text-white">Réseaux sociaux</h3>
                <ul class="grid gap-2 text-gray-300">
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">Twitter</a>
                    </li>
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">LinkedIn</a>
                    </li>
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">Facebook</a>
                    </li>
                </ul>
            </div>
            <div class="grid gap-2">
                <h3 class="font-semibold text-white">Légal</h3>
                <ul class="grid gap-2 text-gray-300">
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">Cookies</a>
                    </li>
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">Mentions légales</a>
                    </li>
                    <li class="hover:text-white transition-colors duration-300">
                        <a href="#" class="inline-block">Conditions d'utilisations</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container mx-auto text-center">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tous droits réservés.</p>
        <?php wp_footer(); ?>
    </div>
</footer>
<script>
 
</script>
</body>

</html>