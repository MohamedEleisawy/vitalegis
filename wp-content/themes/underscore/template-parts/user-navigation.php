<header class="bg-slate-900 px-4 sm:px-6 py-4">
    <div class="container mx-auto">
        <div class="flex justify-between items-center gap-4 md:gap-10">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="shrink-0">
                <img class="w-20 md:w-24 transition-all"
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-dore.png"
                    alt="<?php bloginfo('name'); ?>">
            </a>

            <!-- Navigation desktop -->
            <nav class="hidden lg:flex flex-1 justify-between items-center max-w-4xl mx-8">
                <div class="flex gap-6 xl:gap-8 items-center">
                    <a href="<?php echo esc_url(home_url('/acces-heritier')); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base <?php echo (is_page('acces-heritier')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Accès Héritier
                    </a>
                    <a href="<?php echo esc_url(home_url('/account')); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base <?php echo (is_page('account') || is_page('ajouter-contrat')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Mon compte
                    </a>
                    <a href="<?php echo esc_url(um_user_profile_url()); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base <?php echo (is_page('user')) ? 'border-b-2 border-yellow-400' : ''; ?>">
                        Profile
                    </a>
                </div>

                <!-- Déconnexion desktop -->
                <div class="flex items-center gap-4">
                <?php if(is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(um_user_profile_url()); ?>" class="flex items-center gap-3 group">
                            <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>" 
                                 alt="Avatar utilisateur"
                                 class="w-8 h-8 rounded-full object-cover border-2 border-transparent group-hover:border-yellow-400 transition-all">
                        </a>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"
                        class="text-white hover:text-yellow-400 transition-colors text-sm xl:text-base">
                        Déconnexion
                    </a>
                </div>
            </nav>

            <!-- Menu Burger mobile -->
            <button id="burger-btn" class="lg:hidden text-white text-2xl hover:text-yellow-400 transition-colors">
                ☰
            </button>
        </div>
    </div>

    <!-- Volet mobile -->
    <div id="mobile-menu"
        class="lg:hidden fixed top-0 right-0 h-full w-64 bg-slate-800 transform translate-x-full transition-transform duration-300 z-50 shadow-2xl">
        <div class="p-6 relative h-full">
            <button id="close-menu" class="text-white text-2xl mb-6 hover:text-yellow-400">✕</button>
            <div class="flex flex-col gap-6">
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
                        <div class="flex items-center gap-4 mb-8">
                            <a href="<?php echo esc_url(um_user_profile_url()); ?>">
                                <img src="<?php echo esc_url(get_avatar_url(get_current_user_id())); ?>"
                                    alt="Avatar utilisateur"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-yellow-400">
                            </a>
                            <div class="text-white">
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