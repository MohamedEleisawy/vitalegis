<?php
/*
Template Name: Politique des cookies
*/

get_template_part('template-parts/head');
 get_template_part('template-parts/navigation');
?>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6 py-24">
        <h1 class="text-3xl font-bold text-center mb-6">Politique de Cookies</h1>

        <p class="text-sm text-gray-600 text-center mb-8">
            Dernière mise à jour : <?php echo date('d/m/Y'); ?>
        </p>

        <?php
        $sections = [
            [
                'title' => 'Introduction',
                'content' => 'Bienvenue sur <strong>Vitalegis</strong>. Cette politique explique comment nous utilisons des cookies et technologies similaires sur notre site web.',
                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            [
                'title' => '1. Qu\'est-ce qu\'un cookie ?',
                'content' => 'Un cookie est un petit fichier texte stocké sur votre appareil (ordinateur, tablette, smartphone) lorsque vous visitez un site web. Il permet de conserver des informations sur votre navigation afin d\'améliorer votre expérience utilisateur.',
                'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
            ],
            [
                'title' => '2. Quels cookies utilisons-nous ?',
                'content' => '
                    <p class="mb-4">Nous utilisons plusieurs types de cookies :</p>
                    <ul class="list-disc list-inside">
                        <li class="mb-2">
                            <strong>a) Cookies strictement nécessaires (obligatoires)</strong><br>
                            - Assurent le bon fonctionnement du site (connexion, sécurité).<br>
                            - Ne peuvent pas être désactivés.
                        </li>
                        <li class="mb-2">
                            <strong>b) Cookies de performance et d\'analyse</strong><br>
                            - Nous aident à comprendre comment vous utilisez notre site (statistiques anonymes).<br>
                            - Exemple : Google Analytics.
                        </li>
                        <li class="mb-2">
                            <strong>c) Cookies publicitaires et de réseaux sociaux</strong><br>
                            - Utilisés pour afficher des publicités ciblées et partager du contenu sur les réseaux sociaux.<br>
                            - Exemple : Facebook Pixel, Google Ads.
                        </li>
                    </ul>
                ',
                'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
            ],
            [
                'title' => '3. Comment gérer vos cookies ?',
                'content' => '
                    <p class="mb-4">Lors de votre première visite, une bannière vous permet d\'accepter ou de refuser certains cookies. Vous pouvez aussi :</p>
                    <ul class="list-disc list-inside mb-4">
                        <li>Paramétrer votre navigateur pour bloquer les cookies (certaines fonctionnalités du site pourraient être limitées).</li>
                    </ul>
                    <p class="mb-4"><strong>Paramétrage des cookies sur votre navigateur :</strong></p>
                    <ul class="list-disc list-inside">
                        <li><strong>Google Chrome</strong> : Paramètres > Confidentialité et sécurité > Cookies</li>
                        <li><strong>Mozilla Firefox</strong> : Options > Vie privée et sécurité</li>
                        <li><strong>Safari</strong> : Préférences > Confidentialité</li>
                        <li><strong>Microsoft Edge</strong> : Paramètres > Cookies et autorisations</li>
                    </ul>
                ',
                'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
            ],
            [
                'title' => '4. Durée de conservation des cookies',
                'content' => 'Les cookies sont stockés pour une durée maximale de 6 mois, puis supprimés automatiquement, sauf si vous les supprimez manuellement avant.',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            [
                'title' => '5. Modification de la politique des cookies',
                'content' => 'Nous nous réservons le droit de modifier cette politique à tout moment. Toute mise à jour sera indiquée sur cette page.',
                'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            ],
            [
                'title' => 'Contactez-nous',
                'content' => 'Pour toute question, écrivez-nous à <a href="mailto:Vitalegis.social@gmail.com" class="text-blue-500 hover:underline">Vitalegis.social@gmail.com</a>.',
                'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            ],
        ];

        foreach ($sections as $section) :
        ?>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $section['icon']; ?>"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold"><?php echo $section['title']; ?></h2>
                </div>
                <div class="text-gray-700">
                    <?php echo $section['content']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php get_footer(); ?>
