<header class="bg-slate-900 px-4 sm:px-6 py-4">
    <div class="container mx-auto">
        <!-- Grid principale : Logo | Menu | Avatar+Déconnexion -->
        <div class="grid grid-cols-[280px_1fr_auto] gap-[80px] items-center">
            
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="grid place-items-center">
                <img class="w-[100px]" 
                     src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-dore.png"
                     alt="<?php bloginfo('name'); ?>">
            </a>

            <!-- Navigation centrale pour desktop (masquée entre 340px et 1045px) -->
            <nav class="hidden min-[1080px]:grid items-center">
                <div class="grid grid-flow-col gap-20 items-center">
                    <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                       class="text-white hover:text-yellow-400 transition-colors">
                        Accès Héritier
                    </a>
                    <a href="<?php echo esc_url(home_url('/account')); ?>"
                       class="text-white hover:text-yellow-400 transition-colors">
                        Mon compte
                    </a>
                    <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                       class="text-white hover:text-yellow-400 transition-colors">
                        Profile
                    </a>
                    <a href="#" class="text-white hover:text-yellow-400 transition-colors">
                        Mafia
                    </a>
                </div>
            </nav>

            <!-- Menu Burger pour mobile (affiché uniquement entre 340px et 1045px) -->
            <div class="grid min-[340px]:grid max-[1045px]:grid hidden place-items-center">
                <button id="burger-btn" class="text-white text-2xl">
                    ☰
                </button>
            </div>

            <!-- Avatar et Déconnexion (masqués entre 340px et 1045px) -->
            <div class="hidden min-[1045px]:grid grid-flow-col gap-4 items-center px-12">
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                   class="text-white hover:text-yellow-400 transition-colors">
                    Se déconnecter
                </a>
            </div>

        </div>
    </div>

    <!-- Volet mobile -->
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-64 bg-slate-800 transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-6">
            <button id="close-menu" class="text-white text-2xl mb-6">✕</button>
            <div class="grid gap-6">
                <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                   class="text-white hover:text-yellow-400 transition-colors">
                    Accès Héritier
                </a>
                <a href="<?php echo esc_url(home_url('/account')); ?>"
                   class="text-white hover:text-yellow-400 transition-colors">
                    Mon compte
                </a>
                <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                   class="text-white hover:text-yellow-400 transition-colors">
                    Profile
                </a>
                <a href="#" class="text-white hover:text-yellow-400 transition-colors">
                    Mafia
                </a>
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                   class="text-white hover:text-yellow-400 transition-colors">
                    Se déconnecter
                </a>
            </div>
        </div>
    </div>
</header>