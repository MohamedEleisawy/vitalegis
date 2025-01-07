<?php
/**
 * Template for the login form
 *
 * This template can be overridden by copying it to your-theme/ultimate-member/templates/login.php
 *
 * Page: "Login"
 *
 * @version 2.7.0
 *
 * @var string $mode
 * @var int    $form_id
 * @var array  $args
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">
	<div class="um-form grid gap-6 p-8 bg-white rounded-lg shadow-md max-w-3xl mx-auto w-full" data-mode="<?php echo esc_attr( $mode ); ?>">
		<style>
			/* Styles personnalisés */
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

			.um-alert {
				padding: 1rem;
				border-left: 4px solid #ff6f61;
				background-color: #ffe7e5;
				border-radius: 8px;
				color: #e74c3c;
				margin-bottom: 1.5rem;
			}

			.um-login-footer {
				text-align: center;
				margin-top: 1.5rem;
				color: #6c757d;
			}

			.um-login-footer a {
				color: #3498db;
				text-decoration: underline;
			}
		</style>

		<!-- Titre -->
		<h1>Se connecter</h1>

		<!-- Formulaire -->
		<form method="post" action="" autocomplete="off">
			<?php
			do_action( 'um_before_form', $args );
			do_action( "um_before_{$mode}_fields", $args );
			do_action( "um_main_{$mode}_fields", $args );
			do_action( 'um_after_form_fields', $args );
			do_action( "um_after_{$mode}_fields", $args );
			do_action( 'um_after_form', $args );
			?>
		</form>

		<!-- Footer -->
		<div class="um-login-footer">
			<p>Vous n'avez pas de compte ? <a href="<?php echo get_template_directory_uri(); ?>/inscription" >Inscrivez-vous ici</a>.</p>
		</div>
	</div>
</div>
