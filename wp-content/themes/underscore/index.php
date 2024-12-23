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

    </style>
</head>
<?php
  get_header();
  ?>
  <main class="site-main container mx-auto px-4 py-8">
    <!-- section avec 3 images avec 1 texte description -->

    <!-- Section 1: Image à gauche, texte à droite (mobile: image en premier) -->
    <section id="A-propos" class="py-12">
      <?php
            $image1 = get_field('image_a_propos_1');
            $text1 = get_field('texte_a_propos_1');
            $image2 = get_field('image_a_propos_2');
            $text2 = get_field('texte_a_propos_2');
            $image3 = get_field('image_a_propos_3');
            $text3 = get_field('texte_a_propos_3');
      ?>
      <!-- Section 1 -->
      <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
        <!-- Image avec effet parallaxe -->
        <div class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
  <img
    src="<?php echo esc_url($image1['url']); ?>"
    alt="<?php echo esc_attr($image1['alt']); ?>"
    class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
</div>

        <!-- Texte -->
        <div class="space-y-6 px-4 md:px-0">
          <h2 class="text-2xl font-semibold text-blue-300">Seule</h2>
          <p class="text-white leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
        <!-- Texte -->
        <div class="space-y-6 px-4 md:px-0 order-2 md:order-none">
          <h2 class="text-2xl font-semibold text-blue-300">Nutrition Équilibrée</h2>
          <p class="text-white leading-relaxed">
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
            in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>

        <!-- Image avec effet parallaxe -->
        <div class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/duck.jpg"
            alt="Nutrition équilibrée"
            class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="grid md:grid-cols-2 gap-8 mb-16 items-center">
        <!-- Image avec effet parallaxe -->
        <div class="parallax-container relative w-full max-w-sm mx-auto h-64 md:h-80 overflow-hidden rounded-lg shadow-md transform transition-transform duration-300 ease-out">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/paperboat.jpg"
            alt="Fitness et Force"
            class="parallax-img w-full h-full object-cover transition-transform duration-300 ease-out" />
        </div>

        <!-- Texte -->
        <div class="space-y-6 px-4 md:px-0">
          <h2 class="text-2xl font-semibold text-blue-300">Fitness et Force</h2>
          <p class="text-white leading-relaxed">
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
            veritatis et quasi architecto beatae vitae dicta sunt explicabo.
          </p>
        </div>
      </div>
    </section>



    <!-- Advantages Section -->
    <section class="py-20 bg-gray-800 relative">
      <div
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/Fond-services-avantages.png');"
        class="absolute inset-0 opacity-10 bg-cover bg-center">
      </div>
      <div class="container mx-auto px-4 relative">
        <div class="grid gap-4 text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-white">
            Titre section avantages
          </h2>
          <p class="text-gray-300">
            Sous-titre descriptif de la section avantages
          </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="grid gap-4 text-center group">
            <svg
              class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h3
              class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
              Rapidité
            </h3>
            <p class="text-gray-300">
              Des performances optimales pour une expérience utilisateur fluide
            </p>
          </div>
          <div class="grid gap-4 text-center group">
            <svg
              class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <h3
              class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
              Sécurité
            </h3>
            <p class="text-gray-300">
              Protection avancée de vos données et de votre vie privée
            </p>
          </div>
          <div class="grid gap-4 text-center group">
            <svg
              class="w-24 h-24 justify-self-center text-blue-500 transition-transform duration-300 group-hover:scale-110"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor">
              <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
              <path
                d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
            </svg>
            <h3
              class="text-xl font-semibold text-white transition-colors duration-300 group-hover:text-blue-500">
              Support
            </h3>
            <p class="text-gray-300">
              Une équipe dédiée à votre écoute pour vous accompagner
            </p>
          </div>
        </div>
      </div>
    </section>
    </section>

    <!-- Contact Section -->
    <section id="Contact" class="py-20 bg-gray-100">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
          <div class="text-gray-900 grid gap-4">
            <h2 class="text-3xl font-bold">Contactez-nous !</h2>
            <p>
              Si vous souhaitez en savoir plus sur notre service ou pour
              répondre à vos besoins
            </p>
            <div class="grid gap-4">
              <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                <div
                  class="w-6 h-6 rounded-full bg-blue-600 grid place-items-center">
                  <svg
                    class="w-4 h-4 text-white"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Réponse en - de 24H</span>
              </div>
              <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                <div
                  class="w-6 h-6 rounded-full bg-blue-600 grid place-items-center">
                  <svg
                    class="w-4 h-4 text-white"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Support personnalisé</span>
              </div>
              <div class="grid grid-cols-[auto,1fr] gap-2 items-center">
                <div
                  class="w-6 h-6 rounded-full bg-blue-600 grid place-items-center">
                  <svg
                    class="w-4 h-4 text-white"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Satisfaction garantie</span>
              </div>
            </div>
          </div>
          <form class="bg-white shadow-lg rounded-lg p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <input
                type="text"
                placeholder="Nom"
                class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
              <input
                type="text"
                placeholder="Prénom"
                class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <input
              type="email"
              placeholder="Adresse mail"
              class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <input
              type="tel"
              placeholder="Téléphone"
              class="w-full px-3 py-2 rounded-full bg-gray-100 text-gray-900 transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <textarea
              placeholder="Expliquez-nous votre projet..."
              class="w-full px-3 py-2 rounded-2xl bg-gray-100 text-gray-900 min-h-[120px] transition-colors duration-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            <button
              type="submit"
              class="w-full py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
              Envoyer
            </button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <?php
  get_footer();
  ?>