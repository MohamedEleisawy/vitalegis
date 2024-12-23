<!DOCTYPE html>
<html class="scroll-smooth" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Personnalisation Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                        'fredoka': ['Fredoka', 'sans-serif'],
                        'gogh': ['Gogh', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1D4ED8',
                        secondary: '#9333EA',
                    },
                }
            }
        };
    </script>
    
    <!-- WordPress Head -->
    <?php wp_head(); ?>

    <!-- Custom Fonts -->
    <style>
        @font-face {
            font-family: 'gogh';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Gogh-ExtraBold.otf');
        }
    </style>
</head>
