<?php
/**
 * Template Name: Connexion
 * version: 1.0
 * Description: Page de connexion
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">
    <?php get_template_part('template-parts/navigation'); ?>
    <!-- Header -->
    <header class="grid grid-cols-2 items-center p-4 bg-white border-b border-gray-200">
        <button class="bg-white text-black border border-black px-4 py-2 rounded-lg justify-self-end hover:bg-gray-100">
            S'inscrire
        </button>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <style>
                /* Container du formulaire */
                .um-323.um {
                    max-width: 450px;
                    background: #ffffff;
                    border-radius: 24px;
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
                    padding: 40px;
                    margin: 40px auto;
                }

                /* Header du formulaire */
                .um-323.um::before {
                    content: "Connexion";
                    display: block;
                    text-align: center;
                    font-size: 28px;
                    font-weight: 700;
                    color: rgb(15, 23, 42);
                    margin-bottom: 30px;
                }

                /* Champs de formulaire */
                .um-323 .um-field {
                    margin: 20px 0;
                }

                .um-323 .um-field-label label {
                    color: rgb(15, 23, 42);
                    font-size: 14px;
                    font-weight: 600;
                    margin-bottom: 8px;
                }

                /* Inputs sans hover */
                .um-323 input[type="text"],
                .um-323 input[type="password"] {
                    width: 100%;
                    padding: 12px 16px;
                    border: 2px solid #e2e8f0;
                    border-radius: 12px;
                    font-size: 16px;
                }

                .um-323 input[type="text"]:focus,
                .um-323 input[type="password"]:focus {
                    border-color: rgb(15, 23, 42);
                    outline: none;
                    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
                }

                /* Case à cocher */
                .um-323 .um-field-checkbox {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    gap: 8px;
                    margin: 15px 0;
                }

                /* Field labels */
                .um-323 .um-field-label {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 12px;
                }

                /* Boutons */
                .um-323 .um-button,
                .um-323 input[type="submit"].um-button {
                    background: rgb(15, 23, 42) !important;
                    color: white !important;
                    padding: 12px 24px;
                    border-radius: 12px;
                    font-weight: 600;
                    border: none !important;
                    cursor: pointer;
                    width: 100%;
                    text-align: center;
                    font-size: 16px;
                    letter-spacing: 0.5px;
                }

                /* Suppression des effets hover pour le bouton principal */
                .um-323 .um-button:hover,
                .um-323 input[type="submit"].um-button:hover {
                    transform: none !important;
                    box-shadow: none !important;
                    background: rgb(15, 23, 42) !important;
                    color: white !important;
                    border: none !important;
                }

                .um-323 .um-button.um-alt {
                    background: white !important;
                    color: rgb(15, 23, 42) !important;
                    border: 2px solid rgb(15, 23, 42) !important;
                }

                .um-323 .um-button.um-alt:hover {
                    background: white !important;
                    color: rgb(15, 23, 42) !important;
                    border: 2px solid rgb(15, 23, 42) !important;
                }

                /* Lien mot de passe oublié */
                .um-323 .um-link-alt {
                    color: rgb(15, 23, 42);
                    text-decoration: none;
                    font-size: 14px;
                    opacity: 0.8;
                    transition: all 0.3s ease;
                    display: block;
                    text-align: center;
                    margin-top: 20px;
                }

                .um-323 .um-link-alt:hover {
                    opacity: 1;
                    text-decoration: underline;
                }

                /* Layout des boutons */
                .um-323 .um-col-alt {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 16px;
                    margin-top: 24px;
                }

                .um-323 .um-left,
                .um-323 .um-right {
                    width: 100%;
                }

                /* Responsive */
                @media (max-width: 640px) {
                    .um-323.um {
                        padding: 30px 20px;
                    }

                    .um-323 .um-col-alt {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <div class="test">
                <?php echo do_shortcode('[ultimatemember form_id="323"]');  ?>
            </div>
        </div>
    </main>
</body>
<?php get_footer(); ?>