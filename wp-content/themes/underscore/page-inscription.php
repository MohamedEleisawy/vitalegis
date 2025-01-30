<?php
/**
 * Template Name: Inscription
 * version: 1.0
 * Description: Page d'inscription
 * author: Damien Hourriez
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">
    <?php get_template_part('template-parts/navigation'); ?>
    <!-- Header -->
<header>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800">Inscription</h1>
    </div>
</header>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">
            <style>
                /* Container du formulaire */
                .um-322.um {
                    max-width: 800px;
                    background: #ffffff;
                    border-radius: 24px;
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
                    padding: 40px;
                    margin: 40px auto;
                }

                /* Header du formulaire */
                .um-322.um::before {
                    content: "Créer un compte";
                    display: block;
                    text-align: center;
                    font-size: 28px;
                    font-weight: 700;
                    color: rgb(15, 23, 42);
                    margin-bottom: 30px;
                }

                /* Layout des colonnes */
                .um-322 .um-row {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 20px;
                    margin-bottom: 20px;
                }

                .um-322 .um-row .um-col-1 {
                    grid-column: 1 / -1;
                }

                /* Champs de formulaire */
                .um-322 .um-field {
                    background: linear-gradient(145deg, #f8f9fa, #ffffff);
                    padding: 20px;
                    border-radius: 12px;
                    border: 1px solid rgba(0, 0, 0, 0.05);
                    transition: all 0.3s ease;
                }

                .um-322 .um-field:hover {
                    transform: translateX(5px);
                    border-left: 3px solid rgb(15, 23, 42);
                }

                /* Labels */
                #um-322 .um-field-label {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 12px;
                }

                .um-field-user_login{
                    width: 200% !important;
                }

                .um-field-last_name{
                    width: 200% !important;
                }

                /* Case à cocher si présente */
                .um-322 .um-field-checkbox {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    gap: 8px;
                    margin: 15px 0;
                }

                .um-322 .um-field-label label {
                    color: rgb(15, 23, 42);
                    font-size: 14px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .um-322 .um-field-label-icon i {
                    color: rgb(15, 23, 42);
                    font-size: 18px;
                }

                /* Inputs */
                .um-322 input[type="text"],
                .um-322 input[type="tel"],
                .um-322 input[type="password"],
                .um-322 .um-datepicker {
                    width: 100%;
                    padding: 12px 16px;
                    border: 2px solid #e2e8f0;
                    border-radius: 12px;
                    font-size: 16px;
                    transition: all 0.3s ease;
                }

                .um-322 input[type="text"]:focus,
                .um-322 input[type="tel"]:focus,
                .um-322 input[type="password"]:focus,
                .um-322 .um-datepicker:focus {
                    border-color: rgb(15, 23, 42);
                    outline: none;
                    box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
                }

                /* Datepicker */
                .um-322 .picker__table {
                    font-size: 14px;
                }

                .um-322 .picker__day--today {
                    color: rgb(15, 23, 42);
                    font-weight: bold;
                }

                /* Bouton Submit */
                .um-322 input[type="submit"].um-button {
                    background: rgb(15, 23, 42) !important;
                    color: white !important;
                    padding: 14px 28px;
                    border-radius: 12px;
                    font-weight: 600;
                    border: none !important;
                    cursor: pointer;
                    font-size: 16px;
                    letter-spacing: 0.5px;
                    width: auto;
                    min-width: 200px;
                }

                .um-322 input[type="submit"].um-button:hover {
                    background: rgb(15, 23, 42) !important;
                    transform: none !important;
                }

                /* Responsive */
                @media (max-width: 768px) {
                    .um-322.um {
                        padding: 30px 20px;
                    }

                    .um-322 .um-row {
                        grid-template-columns: 1fr;
                    }
                }
            </style>

            <?php echo do_shortcode('[ultimatemember form_id="322"]'); ?>
        </div>
    </main>
<?php get_footer(); ?>