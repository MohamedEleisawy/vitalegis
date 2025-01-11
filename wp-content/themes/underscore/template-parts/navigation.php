<div class="fixed top-0 left-0 w-full z-50 bg-gray-800">

    <!-- Navigation Bar -->
    <div class="container mx-auto px-4 py-2 grid grid-cols-[auto,1fr,auto] gap-4 items-center relative z-10">
        <!-- Logo -->
        <div class="px-6 py-2">
            <a href="<?php echo home_url(); ?>" class="font-bold text-blue-600">
                <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dore.png" alt="">
            </a>
        </div>

        <!-- Desktop Menu -->
        <nav class="hidden md:grid grid-flow-col gap-4 text-white justify-self-center">
            <?php if (!is_page(['inscription', 'connexion'])): ?>
                <?php
                // Menu principal (Accueil, À propos, etc.)
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'items_wrap' => '<ul class="grid grid-flow-col gap-5">%3$s</ul>',
                    'link_before' => '<span class="text-white hover:text-blue-500 transition-colors duration-300">',
                    'link_after' => '</span>',
                ));
                ?>
            <?php endif; ?>
        </nav>

        <!-- Buttons for Desktop -->
        <div class="hidden md:grid grid-flow-col gap-4 justify-self-end">
            <?php if (is_user_logged_in()): ?>
                <a href="<?php echo get_permalink(get_page_by_path('profil')); ?>"
                    class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
                    Mon Profil
                </a>
                <a href="<?php echo wp_logout_url(home_url()); ?>"
                    class="px-4 py-2 rounded-full text-gray-100 border border-gray-100 hover:bg-gray-800 hover:text-white transition-colors duration-300">
                    Déconnexion
                </a>
            <?php else: ?>
                <?php if (!is_page('connexion')): ?>
                    <a href="<?php echo get_template_directory_uri(); ?>/connexion"
                        class="px-4 py-2 rounded-full text-gray-100 border border-gray-100 hover:bg-gray-800 hover:text-white transition-colors duration-300">
                        Se connecter
                    </a>
                <?php endif; ?>

                <?php if (!is_page('inscription')): ?>
                    <a href="<?php echo get_template_directory_uri(); ?>/inscription"
                        class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
                        S'inscrire
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuButton" class="md:hidden text-white focus:outline-none justify-self-end"
            aria-label="Toggle mobile menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="md:hidden fixed inset-y-0 right-0 w-64 bg-gray-900 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-[60]">
        <div class="p-6 grid gap-4">
            <!-- Close Button -->
            <div class="grid justify-items-end">
                <button id="closeMobileMenu"
                    class="text-white focus:outline-none hover:text-blue-500 transition-colors duration-300"
                    aria-label="Close mobile menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Links -->
            <nav>
                <?php if (!is_page(['inscription', 'connexion'])): ?>
                    <?php
                    // Menu pour mobile (Accueil, À propos, etc.)
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'container' => false,
                        'items_wrap' => '<ul class="grid gap-4">%3$s</ul>',
                        'link_before' => '<span class="text-white hover:text-blue-500 transition-colors duration-300">',
                        'link_after' => '</span>',
                    ));
                    ?>
                <?php endif; ?>
            </nav>

            <!-- Buttons for Mobile -->
            <div class="grid gap-4">
                <?php if (!is_page('connexion')): ?>
                    <a href="<?php echo get_template_directory_uri(); ?>/connexion"
                        class="w-full px-4 py-2 rounded-full text-gray-100 border border-gray-100 hover:bg-gray-800 hover:text-white transition-colors duration-300">
                        Se connecter
                    </a>
                <?php endif; ?>

                <?php if (!is_page('inscription')): ?>
                    <a href="<?php echo get_template_directory_uri(); ?>/inscription"
                        class="w-full px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
                        S'inscrire
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>