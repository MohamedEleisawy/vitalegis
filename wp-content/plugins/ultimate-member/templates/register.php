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
    <div class="um-form grid gap-6 p-8 bg-white rounded-lg shadow-md max-w-3xl mx-auto w-full" data-mode="<?php echo esc_attr($mode); ?>">
        <style>
            /* Styles généraux */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f9fafa;
            }

            .um-form {
                padding: 2rem;
                background-color: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .um-form h1 {
                font-size: 1.875rem;
                font-weight: bold;
                color: #2c3e50;
                text-align: center;
                margin-bottom: 1.5rem;
            }

            /* Champs du formulaire */
            .um-field {
                margin-bottom: 1.5rem;
            }

            .um-field-label label {
                display: block;
                font-size: 0.875rem;
                font-weight: bold;
                color: #34495e;
                margin-bottom: 0.5rem;
            }

            .um-field-area input {
                width: 100%;
                padding: 0.875rem;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                background-color: #f8fafc;
                transition: border-color 0.3s, box-shadow 0.3s;
            }

            .um-field-area input:focus {
                border-color: #3498db;
                box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.2);
                outline: none;
            }

            .um-field-area input:hover {
                background-color: #e6f7ff;
            }

            /* Boutons */
            .um-form button[type="submit"] {
                display: inline-block;
                width: 100%;
                padding: 0.875rem;
                font-size: 1rem;
                font-weight: bold;
                text-align: center;
                background-color: #3498db;
                color: #fff;
                border: none;
                border-radius: 8px;
                transition: background-color 0.3s, transform 0.2s;
                cursor: pointer;
            }

            .um-form button[type="submit"]:hover {
                background-color: #2a80b9;
                transform: scale(1.02);
            }

            .um-form button[type="submit"]:focus {
                outline: none;
                box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.3);
            }

            /* Message ou boîte d'alerte */
            .um-alert {
                padding: 1rem;
                border-left: 4px solid #ff6f61;
                background-color: #ffe7e5;
                border-radius: 8px;
                color: #e74c3c;
                margin-bottom: 1.5rem;
            }
        </style>

        <!-- Titre -->
        <h1>S'inscrire</h1>

        <!-- Formulaire -->
        <form method="post" action="">
            <?php do_action('um_before_form', $args); ?>

            <div class="um-field">
                <?php do_action("um_before_{$mode}_fields", $args); ?>
                <?php do_action("um_main_{$mode}_fields", $args); ?>
            </div>


            <div class="um-field">
                <?php do_action('um_after_form_fields', $args); ?>
                <?php do_action("um_after_{$mode}_fields", $args); ?>
            </div>
        </form>
    </div>
</div>