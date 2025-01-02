<?php

/**
 * UM register override
 *
 * @version 2.7.0
 */
if (! defined('ABSPATH')) {
    exit;
}
if (! is_user_logged_in()) {
    um_reset_user();
}

?>
<div class="um <?php echo esc_attr($this->get_class($mode)); ?> um-<?php echo esc_attr($form_id); ?>">
    <div class="um-form grid gap-6 p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-xl max-w-4xl mx-auto w-full" data-mode="<?php echo esc_attr($mode); ?>">

        <style>
            /* Styles spécifiques au formulaire */
            .um-field {
                margin-bottom: 1.5rem !important;
            }

            .um-field-label label {
                font-weight: 600 !important;
                color: #1E40AF !important;
            }

            .um-field-area input {
                width: 100% !important;
                padding: 0.75rem !important;
                border: 1px solid #CBD5E1 !important;
                border-radius: 0.5rem !important;
                background: white !important;
            }

            .um-field-area input:focus {
                border: 5px solid #3B82F6 !important;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
                outline: none !important;
            }
        </style>

        <button class="justify-self-start mt-4 text-blue-600 hover:text-blue-800 transition-transform transform hover:-translate-y-1 focus:outline-none">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900 text-center mb-8 font-gogh">
            S'inscrire
        </h1>

        <form method="post" action="" class="grid w-full">
            <div class="mb-2 w-full">
                <?php do_action('um_before_form', $args); ?>
            </div>

            <div class="mb-2 w-full">
                <?php do_action("um_before_{$mode}_fields", $args); ?>
            </div>

            <div class="grid grid-cols-1 gap-4 w-full">
                <?php do_action("um_main_{$mode}_fields", $args); ?>
            </div>

            <div class="mt-6 bg-white p-6 rounded-lg shadow-inner border-l-4 border-blue-300 w-full">
                <?php do_action('um_after_form_fields', $args); ?>
                <?php do_action("um_after_{$mode}_fields", $args); ?>
            </div>

            <div class="mt-4 flex justify-center w-full">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-colors focus:ring-2 focus:ring-blue-400">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>
</div>