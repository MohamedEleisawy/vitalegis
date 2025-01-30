<?php

/**
 * Template Name: User Profile
 * version: 1.0
 * Description: Page de profil utilisateur
 * author: Damien Hourriez
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">

<?php get_template_part('template-parts/user-navigation'); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="relative z-10"> <!-- Ajout de z-index -->
            <style>
                /* Card Container */
                .um-profile {
                    position: relative !important;
                    z-index: 1 !important;
                    display: block !important;
                    opacity: 1 !important;
                    visibility: visible !important;
                    background: #ffffff;
                    border-radius: 24px;
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
                    padding: 0;
                    max-width: 800px;
                    margin: 40px auto;
                    overflow: hidden;
                    transition: transform 0.3s ease;
                }

                .um-profile:hover {
                    transform: translateY(-5px);
                }

                /* Header Section with Background */
                .um-header {
                    background: rgb(15, 23, 42);
                    background: linear-gradient(135deg, rgb(15, 23, 42), rgb(30, 41, 59));
                    padding: 50px 24px;
                    position: relative;
                    text-align: center;
                    border-bottom: none;
                }

                /* Profile Photo Style */
                .um-profile-photo {
                    margin-bottom: -60px;
                    position: relative;
                    z-index: 2;
                    transition: transform 0.3s ease;
                }

                .um-profile-photo:hover {
                    transform: scale(1.05);
                }

                .um-profile-photo-img img {
                    border-radius: 50%;
                    border: 6px solid rgba(255, 255, 255, 0.9);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                    width: 160px;
                    height: 160px;
                    object-fit: cover;
                    transition: all 0.3s ease;
                }

                /* Profile Meta Info */
                .um-profile-meta {
                    padding: 70px 30px 30px;
                    text-align: center;
                    background: transparent;
                    color: #ffffff;
                }

                .um-name a {
                    font-size: 32px;
                    font-weight: 800;
                    color: #ffffff;
                    text-decoration: none;
                    letter-spacing: -0.5px;
                    transition: color 0.3s ease;
                }

                .um-name a:hover {
                    color: rgba(255, 255, 255, 0.8);
                }

                /* Info Card Body */
                .um-profile-body {
                    padding: 30px;
                    background: #ffffff;
                }

                /* Field Styling */
                .um-field {
                    background: linear-gradient(145deg, #f8f9fa, #ffffff);
                    margin: 16px 0;
                    padding: 20px 28px;
                    border-radius: 16px;
                    border: 1px solid rgba(0, 0, 0, 0.05);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
                    transition: all 0.3s ease;
                }

                .um-field:hover {
                    transform: translateX(5px);
                    border-left: 3px solid rgb(15, 23, 42);
                }

                .um-field-label {
                    display: grid;
                    grid-template-columns: auto 1fr;
                    align-items: center;
                    margin-bottom: 12px;
                }

                .um-field-label-icon {
                    margin-right: 15px;
                }

                .um-field-label-icon i {
                    color: rgb(15, 23, 42);
                    font-size: 20px;
                    opacity: 0.9;
                }

                .um-field-label label {
                    color: #4a5568;
                    font-size: 13px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }

                .um-field-value {
                    color: #2d3748;
                    font-size: 16px;
                    font-weight: 500;
                    padding-left: 35px;
                    line-height: 1.6;
                }

                .um-field-value a {
                    color: #2271b1;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-bottom: 1px solid transparent;
                }

                .um-field-value a:hover {
                    color: #1a4c7c;
                    border-bottom: 1px solid #1a4c7c;
                }

                /* Hide Elements */
                .um-profile-status,
                .um-profile-nav-posts, 
                .um-profile-nav-comments, 
                .um-profile-nav {
                    display: none !important;
                }

                /* Empty Profile Note */
                .um-profile-note {
                    background: #fff8e6;
                    border-left: 4px solid #d97706;
                    padding: 20px;
                    margin: 20px 0;
                    border-radius: 12px;
                    color: #92400e;
                    font-size: 14px;
                    line-height: 1.6;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                }

                .um-profile-note i {
                    color: #d97706;
                    margin-right: 10px;
                }

                .um-profile-note a {
                    color: #2271b1;
                    font-weight: 600;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-bottom: 1px solid transparent;
                }

                .um-profile-note a:hover {
                    color: #1a4c7c;
                    border-bottom: 1px solid #1a4c7c;
                }

                @media (max-width: 768px) {
                    .um-profile {
                        margin: 20px auto;
                        border-radius: 20px;
                    }

                    .um-field {
                        padding: 16px 20px;
                    }

                    .um-name a {
                        font-size: 28px;
                    }

                    .um-profile-photo-img img {
                        width: 140px;
                        height: 140px;
                    }
                }
            </style>

            <?php echo do_shortcode('[ultimatemember form_id="324"]'); ?>
        </div>
    </main>
    <?php get_footer(); ?>