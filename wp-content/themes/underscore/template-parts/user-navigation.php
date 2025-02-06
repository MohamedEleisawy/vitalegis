<header class="bg-slate-900 px-4 sm:px-6 py-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 items-center gap-4">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="col-span-3 lg:col-span-2">
                <img class="w-20 md:w-24 transition-all"
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-dore.png"
                    alt="<?php bloginfo('name'); ?>">
            </a>

            <!-- Navigation desktop -->
            <nav class="hidden lg:grid col-span-10 grid-cols-10 items-center gap-4">
                <div class="col-span-7 grid grid-cols-3 gap-6 xl:gap-8">
                    <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base text-center <?php echo (is_page('acces-heritier')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Accès Héritier
                    </a>
                    <a href="<?php echo esc_url(home_url('/account')); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base text-center <?php echo (is_page('account') || is_page('ajouter-contrat')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Mon compte
                    </a>
                    <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base text-center <?php echo (is_page('user')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Profile
                    </a>
                </div>

                <!-- Déconnexion desktop -->
                <div class="col-span-3 grid grid-cols-2 items-center gap-4 justify-self-end">
                    <?php if(is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(um_user_profile_url()); ?>" class="justify-self-end">
                            <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" 
                                 alt="Avatar utilisateur"
                                 class="w-8 h-8 rounded-full object-cover border-2 border-transparent hover:border-yellow-400 transition-all">
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base text-center">
                        Déconnexion
                    </a>
                </div>
            </nav>

            <!-- Menu Burger mobile -->
            <button id="burger-btn" class="lg:hidden col-start-12 justify-self-end text-white text-2xl hover:text-yellow-400 transition-colors">
                ☰
            </button>
        </div>
    </div>

    <!-- Volet mobile -->
    <div id="mobile-menu" 
        class=" lg:hidden fixed top-0 right-0 h-auto w-64 bg-slate-800 transform translate-x-full transition-transform duration-300 z-50 shadow-2xl">
        <div class="p-6 grid gap-6">
            <button id="close-menu" class="text-white text-2xl justify-self-end hover:text-yellow-400">✕</button>
            <div class="grid gap-6">
                <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                    class="text-white hover:text-yellow-400 transition-colors <?php echo (is_page('acces-heritier')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                    Accès Héritier
                </a>
                <a href="<?php echo esc_url(home_url('/account')); ?>"
                    class="text-white hover:text-yellow-400 transition-colors <?php echo (is_page('account') || is_page('ajouter-contrat')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                    Mon compte
                </a>
                <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                    class="text-white hover:text-yellow-400 transition-colors <?php echo (is_page('user')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                    Profile
                </a>
                <div class="border-t border-white/20 pt-6 mt-4">
                    <?php if (is_user_logged_in()): ?>
                        <div class="grid grid-cols-4 gap-4 mb-8 items-center">
                            <a href="<?php echo esc_url(um_user_profile_url()); ?>" class="col-span-1">
                                <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>"
                                    alt="Avatar utilisateur"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                            </a>
                            <div class="text-white col-span-3">
                                <p class="font-medium"><?php echo um_user('display_name'); ?></p>
                                <p class="text-sm opacity-75"><?php echo um_user('user_email'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                        class="text-white hover:text-yellow-400 transition-colors">
                        Se déconnecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
