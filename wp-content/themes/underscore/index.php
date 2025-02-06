<?php
/*
Template Name: Vitalegis
Version: 1.0

*/
?>
<?php get_template_part('template-parts/head'); ?>
<style>
    .desktop-header {
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(59, 130, 246, 0.1);
        backdrop-filter: blur(0px);
    }

    header {
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(17, 24, 39, 0.8);
        backdrop-filter: blur(8px);
    }

    #mobileMenu {
        transition: transform 0.3s ease-in-out;
        background-color: rgba(17, 24, 39, 1);
    }

    #mobileMenu.open {
        transform: translateX(0);
    }
    .parallax-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.parallax-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    will-change: transform;
    transition: transform 0.3s ease-out;
}
</style>
</head>
<?php
get_header();
?>
<main class="site-main container mx-auto px-4 py-8">
    <!-- Section 1: Image à gauche, texte à droite (mobile: image en premier) -->
    <section id="A-propos" class="py-12 bg-[#001a2b] ">
        <?php
        $image1 = get_field('image_avantage_1') ?: 'URL_IMAGE_PAR_DEFAUT';
        $alt_image_1 = get_post_meta($image1, '_wp_attachment_image_alt', true) ?: 'Texte alternatif par défaut';
        $titre1 = get_field('titre_avantage_1') ?: 'Gestion des héritiers';
        $description1 = get_field('description_avantage_1') ?: ' Ajouter et modifier les héritiers de vos documents enregistrés pour leur donner accès et ainsi faciliter leur travail de recherche.';

        $image2 = get_field('image_avantage_2') ?: 'URL_IMAGE_PAR_DEFAUT';
        $alt_image_2 = get_post_meta($image2, '_wp_attachment_image_alt', true) ?: 'Texte alternatif par défaut';
        $titre2 = get_field('titre_avantage_2') ?: 'Gestion de contrats';
        $description2 = get_field('description_avantage_2') ?: 'Ajouter et modifiez vos contrats avec des démarches simplifiées et adaptés selon vos besoins';

        $image3 = get_field('image_avantage_3') ?: 'URL_IMAGE_PAR_DEFAUT';
        $alt_image_3 = get_post_meta($image3, '_wp_attachment_image_alt', true) ?: 'Texte alternatif par défaut';
        $titre3 = get_field('titre_avantage_3') ?: 'Résiliation simplifiée';
        $description3 = get_field('description_avantage_3') ?: 'Résilié vos contrats à tout moment avec notre système de résiliation automatique.';

        $couleur_titre = get_field('couleur_titre_section_services') ?: '#ffffff';
        ?>
        <!-- Section 1 -->
        <div class="grid md:grid-cols-2 gap-4 mb-16 items-center px-16">
            <div
                class="relative w-full max-w-sm mx-auto h-72 md:h-80 overflow-hidden rounded-lg shadow-md">
                <?php if ($image1): ?>
                    <img src="<?php echo esc_url($image1); ?>" alt="<?php echo esc_attr($alt_image_1); ?>"
                        class="w-full h-full object-cover" />
                <?php else: ?>
                    <div class="bg-gray-200 w-full h-full flex items-center justify-center text-gray-500">
                        Image non disponible
                    </div>
                <?php endif; ?>
            </div>
            <div class="space-y-6 px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-blue-300">
                    <?php echo esc_html($titre1 ?: 'Titre non disponible'); ?>
                </h2>
                <p class="text-white leading-relaxed">
                    <?php echo esc_html($description1 ?: 'Description non disponible'); ?>
                </p>
            </div>
        </div>

        <!-- Section 2 -->
        <div class="grid md:grid-cols-2 gap-8 mb-16 items-center px-16">
            <div class="space-y-6 px-4 md:px-0 order-2 md:order-none">
                <h2 class="text-2xl font-semibold text-blue-300"><?php echo esc_html($titre2); ?></h2>
                <p class="text-white leading-relaxed"><?php echo esc_html($description2); ?></p>
            </div>

            <div
                class="parallax-container relative w-full max-w-sm mx-auto h-72 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
                <img src="<?php echo esc_url($image2); ?>" alt="<?php echo esc_attr($alt_image_2) ?>"
                    class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
            </div>
        </div>
        <!-- Section 3 -->
        <div class="grid md:grid-cols-2 gap-8 mb-16 items-center px-16">
            <div
                class="parallax-container relative w-full max-w-sm mx-auto h-72 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
                <img src="<?php echo esc_url($image3); ?>" alt="<?php echo esc_attr($alt_image_3) ?>"
                    class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
            </div>

            <div class="space-y-6 px-4 md:px-0">
                <h2 class="text-2xl font-semibold text-blue-300"><?php echo esc_html($titre3); ?></h2>
                <p class="text-white leading-relaxed"><?php echo esc_html($description3); ?></p>
            </div>
        </div>
    </section>



    <!-- Section services  -->
    <section class="py-20 bg-gray-800 relative">
        <div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/Fond-services-avantages.png');"
            class="absolute inset-0 bg-cover bg-center">
        </div>
        <div class="container mx-auto px-4 relative">
            <!-- Titre et sous-titre dynamiques -->
            <div class="grid gap-4 text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white"
                    style="color: <?php echo esc_attr($couleur_titre); ?>;">
                    <?php echo get_field('titre_section_services') ?: 'On vous accompagne'; ?>
                </h2>
                <p class="text-gray-300">
                    <?php echo get_field('sous_titre_section_services') ?: 'Solutions pour faciliter votre succession'; ?>
                </p>
            </div>

            <!-- Avantages dynamiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Avantage 1 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                        <?php echo get_field('icone_services_1') ?: '<svg width="86" height="99" viewBox="0 0 86 99" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M82.2836 51.6851L77.0772 48.7826C77.2617 47.4871 77.3518 46.1753 77.3518 44.8675C77.3764 43.5966 77.2535 42.3299 76.9829 41.0918L82.1401 38.0992C83.5094 37.3407 84.5671 36.1314 85.1369 34.676C85.7067 33.2207 85.7559 31.6137 85.2722 30.1296C83.3864 24.7223 80.4921 19.725 76.7533 15.3918C75.7407 14.2398 74.3592 13.4773 72.8423 13.2436C71.3255 13.0058 69.7759 13.3133 68.464 14.1045L63.8561 16.8225H63.397C61.3226 15.3508 59.0433 14.1988 56.6245 13.4158V8.02487C56.7393 6.37275 56.2638 4.73703 55.2717 3.40877C54.2837 2.08052 52.8529 1.15402 51.2377 0.793263C45.65 -0.264421 39.9189 -0.264421 34.3312 0.793263C32.8266 1.10073 31.4697 1.92064 30.494 3.11361C29.5224 4.30658 28.9895 5.79881 28.9895 7.33614V13.1862C26.6363 14.2357 24.439 15.6008 22.4466 17.2407L17.8387 14.5677C16.4818 13.6126 14.8173 13.1862 13.1652 13.3666C11.5131 13.5429 9.98397 14.3136 8.86069 15.5352C5.1301 19.8193 2.23992 24.7715 0.333631 30.1296C-0.146016 31.5973 -0.10912 33.1879 0.448418 34.6309C1.00186 36.074 2.03494 37.2833 3.3714 38.0541L8.43844 41.0959V44.8716C8.41794 46.1302 8.55323 47.3805 8.85659 48.6022L3.46569 51.6441C2.14973 52.4353 1.13714 53.6487 0.604201 55.0877C0.0712597 56.5266 0.0384633 58.1049 0.51811 59.5644C2.25632 64.5822 4.85953 69.2598 8.21296 73.384C4.57666 78.5207 2.58018 84.6413 2.50229 90.9341C2.51459 93.07 3.3673 95.1116 4.87183 96.6202C6.38456 98.1288 8.42614 98.9816 10.5579 98.9939H75.0438C77.1797 98.9816 79.2212 98.1288 80.7299 96.6202C82.2426 95.1116 83.0953 93.0659 83.1076 90.9341C83.0953 84.6167 81.1685 78.4469 77.5814 73.2446C80.939 69.1327 83.5504 64.451 85.2722 59.425C85.7026 57.9861 85.6411 56.4446 85.1 55.0426C84.5589 53.6405 83.5627 52.4599 82.2795 51.6851H82.2836ZM75.0479 92.082H10.562C10.2545 92.082 9.96757 91.959 9.75029 91.7458C9.52892 91.5286 9.41413 91.2375 9.41413 90.93C9.42643 84.5183 11.9763 78.3772 16.5063 73.8431C21.0404 69.309 27.1857 66.7591 33.5933 66.7468H52.0166C58.4283 66.7591 64.5695 69.309 69.1036 73.8431C73.6377 78.3772 76.1917 84.5183 76.204 90.93C76.204 91.2334 76.081 91.5286 75.8678 91.7458C75.6546 91.9631 75.3595 92.082 75.052 92.082H75.0479ZM42.805 59.8391C39.8451 59.8391 36.9508 58.9618 34.4911 57.3178C32.0272 55.6739 30.1128 53.3331 28.9772 50.5987C27.8457 47.8643 27.5464 44.8511 28.1286 41.9486C28.7066 39.0461 30.1291 36.3773 32.224 34.2825C34.3189 32.1876 36.9836 30.7651 39.8902 30.187C42.7886 29.609 45.8058 29.9083 48.5361 31.0397C51.2705 32.1712 53.6073 34.0939 55.2553 36.5536C56.8992 39.0134 57.7806 41.9117 57.7806 44.8716C57.7683 48.84 56.1818 52.6403 53.3818 55.4443C50.5736 58.2484 46.7733 59.8309 42.805 59.8432V59.8391ZM72.9284 67.8988C68.751 64.0698 63.6061 61.4543 58.0553 60.3433C60.1419 58.3427 61.8064 55.9404 62.9501 53.2798C64.0857 50.6192 64.676 47.7577 64.6883 44.8634C64.6883 39.0625 62.3803 33.4954 58.2766 29.3917C54.173 25.2881 48.6099 22.9841 42.805 22.9841C37 22.9841 31.4369 25.2881 27.3333 29.3917C23.2296 33.4954 20.9257 39.0625 20.9257 44.8634C20.9216 47.7741 21.5037 50.652 22.6434 53.329C23.7871 56.006 25.4557 58.4206 27.5587 60.4335C22.012 61.5199 16.8671 64.0985 12.6774 67.8947C10.234 64.7175 8.24986 61.2165 6.78222 57.4859L12.2182 54.4441C13.2554 53.7553 14.0794 52.7919 14.6001 51.6605C15.1166 50.529 15.3134 49.2786 15.1658 48.0406V41.8215C15.3503 40.5056 15.1494 39.1691 14.5714 37.9721C14.0015 36.775 13.0832 35.7747 11.9436 35.0983L6.87651 32.4254C8.44254 27.9815 10.7342 23.8245 13.649 20.1267C13.8826 20.1636 14.104 20.2579 14.2926 20.4014L18.9005 23.1194C20.0361 23.7753 21.352 24.0787 22.6598 23.9885C23.9757 23.8983 25.2261 23.4187 26.2715 22.6152C27.9728 21.3853 29.8135 20.3481 31.7485 19.5282C32.9701 19.0363 34.0155 18.1876 34.7575 17.0972C35.4955 16.0067 35.889 14.7194 35.8931 13.4035L35.5733 7.55342C40.2304 6.70071 45.0064 6.70071 49.6676 7.55342C49.6922 7.7215 49.6922 7.89368 49.6676 8.06176V13.4035C49.6676 14.703 50.0489 15.9739 50.7745 17.0562C51.4919 18.1385 52.5168 18.983 53.722 19.4831C55.6365 20.3317 57.4608 21.3812 59.1581 22.6152C60.3264 23.4146 61.6998 23.845 63.1182 23.845C64.5367 23.845 65.9141 23.4187 67.0784 22.6152L71.6863 19.7578C74.7322 23.4146 77.1141 27.5797 78.7293 32.0564L73.527 35.0983C72.416 35.7788 71.5305 36.7709 70.9853 37.9516C70.44 39.1322 70.2473 40.4441 70.44 41.7314V44.8634C70.4359 45.9129 70.3539 46.9583 70.2145 47.9955C70.067 49.2909 70.2924 50.6028 70.8787 51.7711C71.4567 52.9395 72.3668 53.9152 73.4819 54.5834L78.7334 57.3014C77.4051 61.1304 75.4415 64.7134 72.9284 67.8947V67.8988Z" fill="#E7C77A"/>
</svg>
'; ?> <!-- Icône avantage 1-->

                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_services_1')) ?: 'titre service 1 '; ?>
                        <!-- Titre avantage 1 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_services_1')) ?: 'description services 2'; ?>
                        <!-- Description avantage 1 -->
                    </p>
                </div>

                <!-- Avantage 2 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                        <?php echo get_field('icone_services_2') ?: '<svg width="98" height="98" viewBox="0 0 98 98" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_732_313)" filter="url(#filter0_d_732_313)">
<path d="M82.4878 12.5591H61.8478C61.017 12.533 60.2011 12.3095 59.4709 11.8997C58.7407 11.4898 58.1185 10.9124 57.6639 10.2157L54.2773 5.14882C53.2267 3.56543 51.8035 2.26891 50.1307 1.37103C48.4542 0.473155 46.5877 0 44.6876 0H15.5122C12.4572 0 9.52883 1.21455 7.37169 3.37169C5.21455 5.52883 4 8.45718 4 11.5122V61.7448C4 64.7961 5.21455 67.7282 7.37169 69.8816C9.52883 72.0425 12.4572 73.2533 15.5122 73.2533H23.2988C24.2525 75.5148 25.523 77.6309 27.0654 79.5384C27.9744 80.6151 29.2374 81.3416 30.6308 81.5875C32.0242 81.8334 33.4585 81.5838 34.6843 80.8722L36.4428 79.829C37.4077 80.5034 38.4285 81.092 39.4978 81.5875V83.6813C39.5052 85.1604 40.0492 86.5836 41.0253 87.6938C42.0014 88.8004 43.3501 89.5194 44.8143 89.7094C47.5936 90.1006 50.4064 90.1006 53.1857 89.7094C54.6387 89.497 55.9613 88.7705 56.9188 87.6678C57.88 86.5612 58.4128 85.1492 58.4128 83.6813V81.5875C59.4783 81.0846 60.4991 80.4922 61.4715 79.829L63.312 80.8722C64.5415 81.5801 65.9758 81.8334 67.3655 81.5875C68.7626 81.3416 70.0219 80.6151 70.9309 79.5384C72.4919 77.6346 73.7736 75.5185 74.7385 73.2533H82.4841C85.5354 73.2533 88.4674 72.0425 90.6208 69.8816C92.7817 67.7282 93.9925 64.7961 93.9925 61.7448V24.0713C93.9925 21.02 92.7817 18.0917 90.6208 15.9308C88.4674 13.7736 85.5354 12.5591 82.4841 12.5591H82.4878ZM64.4036 58.8985C64.6048 59.8373 64.6979 60.7911 64.6942 61.7448C64.6979 62.6986 64.6011 63.6524 64.4036 64.5912C64.2993 65.232 64.3887 65.8989 64.6644 66.4838C64.9364 67.0762 65.3909 67.568 65.9497 67.8959L69.5487 69.6134C68.7179 71.6625 67.6673 73.611 66.4117 75.4365L62.7681 73.3427C62.2092 73.0149 61.561 72.8696 60.9164 72.9292C60.2756 72.9851 59.6609 73.2458 59.1691 73.678C57.7012 74.9 56.0284 75.8612 54.2289 76.5244C53.6142 76.7368 53.0851 77.1429 52.7126 77.6756C52.34 78.2047 52.1388 78.8417 52.1388 79.4937V83.6813C50.1345 83.849 48.1189 83.849 46.1108 83.6813H45.7382V79.4937C45.7382 78.8417 45.5445 78.2047 45.1645 77.6756C44.7919 77.1466 44.2591 76.7368 43.6481 76.5244C41.8449 75.8761 40.1721 74.9112 38.708 73.678C38.2087 73.2533 37.5903 72.9925 36.9383 72.9292C36.2863 72.8733 35.6306 73.0111 35.0643 73.3427L31.8006 75.5595C30.4743 73.8755 29.338 72.0499 28.4103 70.1163L32.054 68.0225C32.6165 67.7096 33.0673 67.2252 33.3393 66.6329C33.6113 66.0479 33.6858 65.3922 33.5629 64.7589C33.3915 63.7641 33.3095 62.7545 33.3132 61.7448C33.317 60.7911 33.4027 59.8373 33.5629 58.8985C33.7119 58.28 33.6672 57.6317 33.4362 57.0394C33.2052 56.447 32.7954 55.9403 32.2663 55.5864L28.6674 53.8726C29.487 51.8235 30.5227 49.875 31.7634 48.0494L35.407 50.1432C35.9771 50.4674 36.6291 50.6052 37.281 50.5456C37.933 50.486 38.5477 50.2289 39.0507 49.8079C40.5 48.5524 42.1765 47.5874 43.9909 46.9653C44.5982 46.7417 45.1309 46.3356 45.5035 45.8029C45.8761 45.2738 46.0772 44.6368 46.0847 43.9885V40.0132C47.1688 39.8419 48.2567 39.7562 49.3483 39.7562H52.4853V43.9438C52.489 44.5958 52.6902 45.2291 53.0665 45.7619C53.4391 46.2909 53.9718 46.6933 54.5791 46.9168C56.3935 47.5427 58.0738 48.5077 59.5193 49.7632C60.0148 50.1768 60.6258 50.4338 61.2704 50.4934C61.9112 50.5493 62.5594 50.4152 63.1183 50.0985L66.4266 47.8371C67.6822 49.5546 68.7551 51.4099 69.6083 53.3622L65.9646 55.456C65.3723 55.7838 64.8991 56.2942 64.6197 56.9127C64.3403 57.5312 64.2732 58.2241 64.4185 58.8873L64.4036 58.8985ZM87.7186 61.7448C87.7186 63.1345 87.1709 64.4645 86.1911 65.4444C85.2075 66.428 83.8812 66.9793 82.4915 66.9793H74.9583C74.4628 65.9734 73.6953 65.1314 72.7378 64.5502L70.8974 63.4996V59.9826L72.7006 58.932C73.9338 58.2278 74.8838 57.1176 75.3793 55.7838C75.8748 54.4538 75.8934 52.9933 75.4166 51.6521C74.3659 48.8393 72.8533 46.2201 70.9421 43.9065C70.033 42.8224 68.7663 42.1033 67.3692 41.8649C65.9721 41.6264 64.5377 41.891 63.3232 42.6137L61.4827 43.6569C60.5103 42.9938 59.4895 42.4014 58.424 41.8984V39.8046C58.424 38.3367 57.8875 36.9247 56.93 35.8182C55.9688 34.7117 54.6462 33.9889 53.1969 33.7765C50.4176 33.3965 47.6048 33.3965 44.8254 33.7765C43.3762 33.9889 42.0498 34.7154 41.0886 35.8182C40.1274 36.9247 39.5984 38.3367 39.5909 39.8046V41.8984C38.5254 42.4014 37.5046 42.9938 36.5359 43.6569L34.6954 42.6137C33.4734 41.8984 32.0428 41.6413 30.6494 41.8761C29.256 42.1145 27.993 42.8298 27.0765 43.9065C25.1653 46.2239 23.649 48.8393 22.5983 51.6521C22.1326 52.9859 22.1438 54.4426 22.6319 55.7727C23.1199 57.1027 24.0551 58.2167 25.2771 58.932L27.1175 59.9826C27.0765 60.5675 27.0765 61.1562 27.1175 61.7411C27.0765 62.3111 27.0765 62.8849 27.1175 63.4549L25.2771 64.5055C24.3196 65.1016 23.5484 65.9585 23.0603 66.9793H15.5271C14.1412 66.9793 12.8074 66.428 11.8275 65.4444C10.8477 64.4608 10.2963 63.1345 10.2963 61.7448V11.5122C10.2963 10.1263 10.8477 8.79248 11.8275 7.81264C12.8074 6.8328 14.1412 6.28141 15.5271 6.28141H44.5348C45.3731 6.30749 46.1853 6.53103 46.9192 6.94085C47.6495 7.35066 48.2716 7.92814 48.7224 8.62483L52.1165 13.6917C53.1671 15.2751 54.5903 16.5716 56.2631 17.4695C57.9359 18.3673 59.8025 18.8368 61.6988 18.8405H82.5064C83.8961 18.8405 85.2261 19.3919 86.206 20.3717C87.1895 21.3516 87.7335 22.6816 87.7335 24.0713V61.7448H87.7186Z" fill="#E7C77A"/>
</g>
<defs>
<filter id="filter0_d_732_313" x="0" y="0" width="98" height="98" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="4"/>
<feGaussianBlur stdDeviation="2"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_732_313"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_732_313" result="shape"/>
</filter>
<clipPath id="clip0_732_313">
<rect width="90" height="90" fill="white" transform="translate(4)"/>
</clipPath>
</defs>
</svg>
'; ?> <!-- Icône avantage 1-->

                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_services_2')) ?: 'titre avantage 2'; ?>
                        <!-- Titre avantage 2 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_services_2')); ?> <!-- Description avantage 2 -->
                    </p>
                </div>

                <!-- Avantage 3 -->
                <div class="grid gap-4 text-center group">
                    <div
                        class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110">
                        <?php echo get_field('icone_services_3') ?: '<svg width="99" height="99" viewBox="0 0 99 99" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M98.5793 44.0221C98.3828 42.0364 97.4575 40.1941 95.9795 38.8635C94.4933 37.5247 92.5691 36.7918 90.5753 36.7959H87.6807C87.0994 34.9249 86.2805 33.1276 85.2406 31.4613L87.4474 29.2546C88.8721 27.838 89.7155 25.9424 89.8138 23.9363C89.9161 21.9302 89.2692 19.9568 88.0001 18.3969C85.7565 15.6007 83.2099 13.0541 80.4137 10.8105C78.862 9.54136 76.9009 8.89858 74.8989 9.00093C72.9009 9.09919 71.0095 9.94667 69.6011 11.3632L67.5786 13.4799C65.855 12.5546 64.0167 11.8545 62.1088 11.4083V8.32949C62.1088 6.33566 61.3678 4.41142 60.0372 2.92116C58.7066 1.43499 56.8725 0.497436 54.8868 0.276353C51.2799 -0.0921178 47.6443 -0.0921178 44.0292 0.276353C42.0476 0.497436 40.2094 1.43499 38.8788 2.92116C37.5482 4.41142 36.8112 6.33566 36.8112 8.32949V11.224C34.9402 11.8259 33.1511 12.6406 31.4766 13.6641L29.2207 11.4574C27.8083 10.0408 25.9209 9.19335 23.9229 9.0951C21.925 8.99274 19.9598 9.63552 18.4164 10.9047C15.6487 13.1565 13.1349 15.703 10.9159 18.4911C9.64674 20.051 8.99577 22.0243 9.10222 24.0305C9.20457 26.0366 10.048 27.9322 11.4686 29.3487L13.5853 31.3303C12.6395 33.0457 11.9476 34.8922 11.5178 36.8H8.34071C6.35507 36.7959 4.43492 37.5247 2.95694 38.8471C1.47896 40.1736 0.545503 41.9996 0.336703 43.9729C0.0992441 45.7948 -0.0112973 47.6208 0.000985096 49.4468C-0.0112973 51.2605 0.0910558 53.0701 0.320327 54.8756C0.516845 56.8612 1.44212 58.7036 2.92828 60.0342C4.40626 61.373 6.3305 62.1058 8.32434 62.0935H11.2271C11.8043 63.9686 12.6273 65.766 13.6631 67.4282L11.4563 69.6349C10.0316 71.0597 9.19229 72.9511 9.08994 74.9573C8.98759 76.9634 9.63446 78.9368 10.9036 80.4884C13.1472 83.2929 15.6938 85.8354 18.4982 88.083C20.0458 89.3522 22.0069 89.995 24.0048 89.8926C26.0028 89.7944 27.8942 88.9469 29.3026 87.5303L31.3251 85.4137C33.0487 86.3389 34.8952 87.039 36.8031 87.4812V90.6582C36.8031 92.6521 37.54 94.5763 38.8706 96.0666C40.2012 97.5527 42.0435 98.4903 44.021 98.7032C47.632 99.0757 51.2717 99.0757 54.8786 98.7032C56.8643 98.4903 58.6984 97.5486 60.029 96.0666C61.3596 94.5763 62.1006 92.6521 62.1006 90.6582V87.7555C63.9635 87.1618 65.7608 86.343 67.4353 85.3195L69.6871 87.5262C71.0995 88.9428 72.9869 89.7903 74.9848 89.8885C76.9828 89.9909 78.948 89.3481 80.4996 88.0789C83.2959 85.8353 85.8425 83.2888 88.086 80.4843C89.3552 78.9368 89.998 76.9757 89.8997 74.9777C89.7974 72.9798 88.9499 71.0883 87.5333 69.6799L85.4167 67.6574C86.3624 65.942 87.0584 64.0956 87.4883 62.1795H90.6613C92.6469 62.1918 94.567 61.463 96.045 60.1365C97.523 58.81 98.4606 56.9841 98.6653 55.0025C98.8618 53.1561 98.9396 51.2973 98.8986 49.4386C98.9027 47.6249 98.8004 45.8153 98.5752 44.0098L98.5793 44.0221ZM91.7298 54.0486C91.7053 54.3352 91.5701 54.6054 91.3613 54.8019C91.1485 54.9984 90.866 55.109 90.5753 55.1008H87.4023C86.0021 55.1171 84.6429 55.5716 83.5129 56.3945C82.3829 57.2174 81.5395 58.3761 81.0974 59.6985C80.5897 61.287 79.9387 62.8264 79.165 64.3003C78.4239 65.6022 78.1414 67.1047 78.3543 68.5827C78.5754 70.0607 79.2796 71.4158 80.3604 72.4476L82.6163 74.6993C82.8128 74.9204 82.9234 75.207 82.9234 75.51C82.9234 75.8129 82.8128 76.0913 82.6163 76.3124C80.6962 78.7361 78.5058 80.9265 76.0862 82.8425C75.8733 83.0513 75.5785 83.1742 75.2755 83.1742C74.9726 83.1742 74.686 83.0513 74.4731 82.8425L72.4506 80.3574C71.4434 79.3707 70.1497 78.7239 68.7577 78.511C67.3575 78.2981 65.9368 78.5232 64.6799 79.1619C63.202 79.9357 61.6626 80.5867 60.0782 81.0944C58.7476 81.5365 57.593 82.3758 56.766 83.5099C55.9431 84.6399 55.4886 85.995 55.4764 87.3911V90.5682C55.4764 90.8547 55.3658 91.1372 55.1693 91.3542C54.9728 91.563 54.7026 91.6981 54.416 91.7145C51.3618 92.0707 48.2707 92.0707 45.2165 91.7145C44.9299 91.694 44.6597 91.563 44.4632 91.3542C44.2666 91.1413 44.1561 90.8588 44.1643 90.5682V87.3911C44.1438 85.9909 43.6976 84.6358 42.8705 83.5099C42.0476 82.3758 40.889 81.5365 39.5666 81.0944C37.9781 80.5867 36.4387 79.9357 34.9648 79.1619C34.0027 78.6911 32.9464 78.4373 31.8778 78.425C30.1542 78.4577 28.5043 79.1496 27.276 80.3574L25.0693 82.6092C24.8482 82.8098 24.5616 82.9203 24.2669 82.9203C23.9721 82.9203 23.6855 82.8098 23.4644 82.6092C21.0407 80.6972 18.8462 78.5069 16.9302 76.079C16.7296 75.8662 16.619 75.5755 16.619 75.2766C16.619 74.9777 16.7296 74.6952 16.9302 74.4742L18.5392 72.4517C19.5259 71.4404 20.1727 70.1508 20.3856 68.7588C20.5985 67.3586 20.3733 65.9379 19.7347 64.6728C18.9568 63.2071 18.3058 61.6595 17.8022 60.071C17.3601 58.7445 16.5208 57.5859 15.3867 56.7671C14.2567 55.9441 12.9016 55.4897 11.5055 55.4733H8.32843C8.15238 55.4774 7.97224 55.4447 7.81257 55.371C7.6529 55.2973 7.5137 55.1867 7.40316 55.0516C7.28852 54.9124 7.21483 54.7528 7.17798 54.5808C7.13704 54.4048 7.14114 54.2246 7.18617 54.0527C6.82998 50.9984 6.82998 47.9074 7.18617 44.8532C7.20664 44.5666 7.33765 44.2964 7.55464 44.0999C7.76344 43.9033 8.04594 43.7928 8.33253 43.7928H11.5096C12.9098 43.7805 14.2649 43.3261 15.3908 42.5031C16.5249 41.6802 17.3642 40.5216 17.8063 39.191C18.3099 37.6025 18.9609 36.0631 19.7388 34.5892C20.4634 33.2955 20.7377 31.7929 20.5248 30.319C20.3119 28.8451 19.6118 27.4859 18.5433 26.4501L16.2915 24.2434C16.0909 24.0223 15.9803 23.7357 15.9803 23.4409C15.9803 23.1461 16.0909 22.8514 16.2915 22.6303C18.2157 20.2761 20.4061 18.1472 22.8216 16.2803C23.0345 16.0715 23.3252 15.9568 23.6241 15.9568C23.9229 15.9568 24.2136 16.0715 24.4265 16.2803L26.449 18.5361C27.448 19.5351 28.7417 20.1861 30.1419 20.399C31.5421 20.6119 32.971 20.3785 34.2279 19.7316C35.7017 18.9578 37.2411 18.3069 38.8296 17.7992C40.1561 17.357 41.3148 16.5177 42.1336 15.3837C42.9606 14.2537 43.411 12.8985 43.4273 11.4943V8.32131C43.4233 8.14526 43.456 7.96512 43.5297 7.80545C43.6034 7.64578 43.7139 7.50658 43.849 7.39603C43.9882 7.2814 44.1479 7.20771 44.3199 7.16267C44.4959 7.12582 44.6761 7.12992 44.848 7.16676C47.9022 6.81876 50.9933 6.81876 54.0475 7.16676C54.3341 7.19133 54.6043 7.32643 54.8008 7.53523C54.9973 7.74813 55.1079 8.03062 55.1079 8.32131V11.4943C55.1202 12.8985 55.5746 14.2537 56.3975 15.3837C57.2245 16.5177 58.3791 17.357 59.7097 17.7992C61.2941 18.3069 62.8335 18.9578 64.3115 19.7316C65.6134 20.4563 67.1078 20.7306 68.5816 20.5177C70.0555 20.2966 71.4148 19.6047 72.4506 18.5361L74.6573 16.2803C74.8825 16.092 75.165 15.9855 75.4598 15.9855C75.7545 15.9855 76.0411 16.0879 76.2704 16.2803C78.6941 18.2004 80.8845 20.3908 82.8046 22.8104C83.0134 23.0315 83.1281 23.3181 83.1281 23.621C83.1281 23.924 83.0134 24.2106 82.8046 24.4235L80.3645 26.446C79.3778 27.4572 78.7351 28.7469 78.5181 30.1389C78.3052 31.5391 78.5304 32.9597 79.169 34.2166C79.9551 35.6905 80.5979 37.2299 81.1015 38.8184C81.5436 40.149 82.3911 41.3077 83.517 42.1306C84.647 42.9535 86.0062 43.4079 87.4064 43.4202H90.5794C90.866 43.4202 91.1485 43.5308 91.3654 43.7273C91.5742 43.9238 91.7093 44.194 91.7339 44.4806C92.0819 47.5348 92.0819 50.6259 91.7339 53.6801V54.0486H91.7298ZM65.6912 38.0815L54.3259 49.4468L65.6912 60.808C66.334 61.4589 66.6983 62.3351 66.6983 63.2481C66.6983 64.1611 66.3381 65.0372 65.6912 65.6841C65.0402 66.335 64.1641 66.6953 63.2511 66.6953C62.3381 66.6953 61.462 66.335 60.8151 65.6841L49.4498 54.3229L38.0886 65.6841C37.4376 66.335 36.5615 66.6953 35.6485 66.6953C34.7355 66.6953 33.8594 66.335 33.2125 65.6841C32.5615 65.0413 32.2013 64.1611 32.2013 63.2481C32.2013 62.3351 32.5615 61.4589 33.2125 60.808L44.5737 49.4468L33.2125 38.0815C32.5984 37.4305 32.2668 36.5667 32.2872 35.6701C32.2995 34.7734 32.6598 33.9219 33.2944 33.2914C33.9249 32.6609 34.7806 32.2965 35.6731 32.2842C36.5697 32.2637 37.4336 32.5954 38.0886 33.2054L49.4498 44.5707L60.8151 33.2054C61.4661 32.5995 62.3299 32.2678 63.2265 32.2842C64.1231 32.2965 64.9747 32.6568 65.6052 33.2914C66.2357 33.9219 66.6001 34.7775 66.6124 35.6701C66.6328 36.5667 66.3012 37.4305 65.6912 38.0815Z" fill="#E7C77A"/>
</svg>
' ?> <!-- Icône avantage 1-->
                    </div>
                    <h3
                        class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
                        <?php echo esc_html(get_field('titre_services_3')) ?: 'titre avantage 3'; ?>
                        <!-- Titre avantage 3 -->
                    </h3>
                    <p class="text-gray-300">
                        <?php echo esc_html(get_field('description_services_3')) ?: 'description avantage 3'; ?>
                        <!-- Description avantage 3 -->
                    </p>
                </div>
            </div>
        </div>


    </section>
    </section>


    <?php
    // Récupération des champs ACF
    $titre = get_field('contact_titre' ?: 'Titre par défaut');
    $description = get_field('contact_description' ?: 'Description par défaut');
    $avantage_1 = get_field('contact_avantage_1' ?: 'Avantage 1');
    $avantage_2 = get_field('contact_avantage_2' ?: 'Avantage 2');
    $avantage_3 = get_field('contact_avantage_3' ?: 'Avantage 3');
    $placeholder_nom = get_field('contact_placeholder_nom' ?: 'Nom');
    $placeholder_prenom = get_field('contact_placeholder_prenom' ?: 'Prénom');
    $placeholder_email = get_field('contact_placeholder_email' ?: 'Email');
    $placeholder_telephone = get_field('contact_placeholder_telephone' ?: 'Téléphone');
    $placeholder_projet = get_field('contact_placeholder_projet' ?: 'Décrivez votre projet');
    $texte_bouton = get_field('contact_texte_bouton') ?: 'Envoyer';

    // Couleurs dynamiques
    $background_color = get_field('contact_background_color') ?: '#001a2b';
    $text_color = get_field('contact_text_color') ?: '#333333';
    $button_color = get_field('contact_button_color') ?: '#1e3a8a';
    // $button_hover_color = get_field('contact_button_hover_color') ?: '#2563eb';
    $couleur_contour_formulaire = get_field('contact_couleur_contour_formulaire') ?: '#e2e8f0';
    $button_text_color = get_field('contact_button_text_color') ?: '#000';
    $svg_background_color = get_field('contact_svg_color') ?: '#ffffff'; // Valeur par défaut : blanc
    ?>

    <!-- Contact Section -->
    <section id="Contact" class="py-20" style="background-color: <?php echo esc_attr($background_color); ?>;">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="grid gap-4" style="color: <?php echo esc_attr($text_color) ?: '#333333'; ?>;">
                    <h2 class="text-3xl font-bold"><?php echo esc_html($titre) ?: '
                        Titre par défaut
                    '; ?></h2>
                    <p><?php echo esc_html($description) ?: '
                        Description par défaut
                    '; ?></p>
                    <div class="grid gap-4">
                        <?php if ($avantage_1): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($svg_background_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_1) ?: '
                                    Avantage 1';

                                        ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($avantage_2): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($svg_background_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_2) ?: '
                                    Avantage 2'; ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($avantage_3): ?>
                            <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                                <div class="w-6 h-6 rounded-full grid place-items-center"
                                    style="background-color: <?php echo esc_attr($svg_background_color); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($avantage_3) ?: '
                                    Avantage 3'; ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <?php
                include 'form-contact-traitement.php';
                ?>

                <form method="post" class="bg-white shadow-lg rounded-lg p-6 grid gap-4 "
                    style="background-color: <?php echo esc_attr($couleur_contour_formulaire); ?>">
                    <!-- Message de confirmation/erreur -->
                    <div id="form-message" class="text-center "></div>
                    <div class="grid grid-cols-2 gap-4 ">
                        <input type="text" name="nom" required placeholder="<?php echo esc_attr($placeholder_nom); ?>"
                            class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <input type="text" name="prenom" required
                            placeholder="<?php echo esc_attr($placeholder_prenom); ?>"
                            class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <input type="email" name="email" required placeholder="<?php echo esc_attr($placeholder_email); ?>"
                        class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <input type="tel" name="telephone" required
                        placeholder="<?php echo esc_attr($placeholder_telephone); ?>"
                        class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <textarea name="projet" required placeholder="<?php echo esc_attr($placeholder_projet); ?>"
                        class="w-full px-3 py-2 rounded-2xl bg-gray-100 text-gray-900 min-h-[120px] transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <button type="submit" name="submit" class="w-full py-2 rounded-full transition-colors duration-300"
                        style="background-color: <?php echo esc_attr($button_color); ?>; 
           color: <?php echo esc_attr($button_text_color); ?>;"
                        >
                        <?php echo esc_html($texte_bouton); ?>
                        
                    </button>
                </form>

            </div>
        </div>

    </section>


</main>

<?php
get_footer();
?>