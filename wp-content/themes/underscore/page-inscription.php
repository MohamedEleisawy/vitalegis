<?php
/**
 * Template Name: Inscription
 * version: 1.0
 * Description: Page d'inscription
 */
?>
<?php get_template_part('template-parts/head'); ?>
</head>

<body class="min-h-screen grid grid-rows-[auto,1fr,auto] bg-white">
    <?php get_template_part('template-parts/navigation'); ?>
    <!-- Header -->
    <header class="grid grid-cols-2 items-center p-4 bg-white border-b border-gray-200">
        <div class="bg-gray-300 rounded-lg px-6 py-2 w-max">
            <span class="font-bold text-gray-800">LOGO</span>
        </div>
        <button class="bg-white text-black border border-black px-4 py-2 rounded-lg justify-self-end hover:bg-gray-100">
            Se connecter
        </button>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8  ">
        <div class="max-w-2xl mx-auto">
            <button class="justify-self-start mt-4 ">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <!-- Form Title -->
            <h1 class="text-2xl md:text-3xl font-bold text-black text-center mb-8 font-gogh">
                S'inscrire
            </h1>

            <!-- Form -->
            <form class="grid gap-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-black mb-2">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" required class="w-full p-2 rounded-md border border-gray-300">
                    </div>
                    <div>
                        <label class="block text-black mb-2">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input type="text" required class="w-full p-2 rounded-md border border-gray-300">
                    </div>
                </div>

                <div>
                    <label class="block text-black mb-2">
                        Adresse postale
                    </label>
                    <input type="text" class="w-full p-2 rounded-md border border-gray-300">
                </div>

                <div>
                    <label class="block text-black mb-2">
                        Date de naissance <span class="text-red-500">*</span>
                    </label>
                    <input type="date" required class="w-full p-2 rounded-md border border-gray-300">
                </div>

                <div>
                    <label class="block text-black mb-2">
                        Adresse mail <span class="text-red-500">*</span>
                    </label>
                    <input type="email" required class="w-full p-2 rounded-md border border-gray-300">
                </div>

                <div>
                    <label class="block text-black mb-2">
                        N° de téléphone
                    </label>
                    <input type="tel" class="w-full p-2 rounded-md border border-gray-300">
                </div>

                <div>
                    <label class="block text-black mb-2">
                        Mot de passe <span class="text-red-500">*</span>
                    </label>
                    <input type="password" required class="w-full p-2 rounded-md border border-gray-300">
                </div>

                <p class="text-sm text-gray-500">
                    <span class="text-red-500">*</span> Obligatoire
                </p>

                <div class="grid justify-items-center">
                    <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-md hover:bg-gray-800">
                        Valider
                    </button>
                </div>

                <p class="text-center text-gray-600 text-sm">
                    Vous avez un compte ?
                    <a href="#" class="text-black underline hover:text-gray-600">
                        Connectez-vous ici
                    </a>
                </p>
            </form>
        </div>
    </main>
</body>
<?php get_footer(); ?>