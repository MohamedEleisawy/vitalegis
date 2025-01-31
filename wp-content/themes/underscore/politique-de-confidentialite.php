<?php
/*
Template Name: politique de confidentialite
*/
?>
<?php get_template_part('template-parts/head'); ?>
<?php get_template_part('template-parts/navigation'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <!-- En-tête avec effet de vague -->
        <div class="relative max-w-4xl mx-auto mb-16 text-center">
            <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-lg blur opacity-15"></div>
            <div class="relative bg-white rounded-xl p-8 shadow-lg">
                <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-3">
                    Politique de Confidentialité
                </h1>
                <div class="inline-flex items-center text-sm font-medium text-slate-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" />
                    </svg>
                    Dernière mise à jour : 01/01/2025
                </div>
            </div>
        </div>

        <!-- Contenu principal en grille -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Table des matières -->
            <div class="lg:col-span-3 space-y-4 lg:sticky lg:top-20 lg:self-start">
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-600 mb-3">Navigation rapide</h3>
                    <nav class="space-y-2">
                        <?php
                        $sections = [
                            '1. Responsable' => '#responsable',
                            '2. Données' => '#donnees',
                            '3. Finalités' => '#finalites',
                            '4. Base légale du traitement' => '#base-legale-du-traitement',
                            '5. Durée de conservation' => '#duree-de-conservation',
                            '6. Sécurité des données' => '#securite-des-donnees',
                            '7. Vos droits' => '#vos-droits',
                            '8. Cookies et technologies similaires' => '#cookies-et-technologies-similaires',
                            // ... Ajouter toutes les sections
                        ];
                        foreach ($sections as $title => $anchor): ?>
                            <a href="<?= $anchor ?>"
                                class="group grid text-sm text-slate-600 hover:text-blue-600 transition-colors">
                                <span class="truncate"><?= $title ?></span>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>

            <!-- Contenu des sections -->
            <div class="lg:col-span-9 grid gap-8">
                <!-- Section type -->
                <section id="responsable" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="grid grid-cols-[3rem,1fr] gap-4 mb-6 items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg grid place-items-center">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-slate-900">1. Responsable du traitement des données
                            </h2>
                        </div>

                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Le responsable du traitement des données personnelles est :</p>
                        <div class="bg-slate-50/50 p-5 rounded-lg border border-slate-200">
                            <div class="font-medium text-slate-900">Vitalegis</div>
                            <a href="mailto:Vitalegis.social@gmail.com"
                                class="inline-flex items-center mt-2 text-blue-600 hover:text-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Vitalegis.social@gmail.com
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Section 2 -->
                <section id="donnees" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg grid place-items-center">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">2. Données collectées</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Nous collectons et traitons les types de données suivants :</p>
                        <div class="bg-slate-50/50 p-5 rounded-lg border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Données d'identification : nom, prénom, âge, adresse e-mail, numéro de
                                    téléphone.</li>
                                <li class="pl-5">Données contractuelles : numéros de contrats, dates de début et de fin.
                                </li>
                                <li class="pl-5">Données personnelles sensibles : nom et prénoms des membres de votre
                                    famille (si applicable) et leurs adresse mail.</li>
                                <li class="pl-5">Données techniques : adresse IP, type de navigateur, cookies, logs de
                                    connexion.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Section 3 -->
                <section id="finalites" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">3. Finalités du traitement</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Vos données sont collectées pour les raisons suivantes :</p>
                        <div class="bg-slate-50/50 p-5 rounded-lg border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Gestion des comptes utilisateurs et contrats.
                                </li>
                                <li class="pl-5">Communication avec les utilisateurs (informations, assistance,
                                    notifications). </li>
                                <li class="pl-5">Sécurisation et bon fonctionnement du site.
                                </li>
                                <li class="pl-5">Respect des obligations légales et réglementaires.
                                </li>
                                <li class="pl-5">Nous ne vendons ni ne partageons vos données à des tiers sans votre
                                    consentement, sauf en cas d’obligation légale.
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Section 4 -->
                <!-- base légale du traitement -->
                <section id="base-legale-du-traitement"
                    class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zm0 16a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
</svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">4. Base légale du traitement</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Le traitement de vos données est basé sur les fondements juridiques suivants :</p>
                        <div class="bg-slate-50/50 p-5 rounded-lg
                        border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Votre consentement (acceptation des cookies, formulaire de contact).
                                </li>
                                <li class="pl-5">L’exécution d’un contrat (gestion des numéros de contrat et comptes
                                    utilisateurs).</li>
                                <li class="pl-5">Nos obligations légales (conservation des données pour la facturation
                                    ou la sécurité).</li>
                                <li class="pl-5">Notre intérêt légitime (amélioration du site et prévention de la
                                    fraude).</li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Section 5 -->
                <!-- Durée de conservation -->
                <section id="duree-de-conservation" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
</svg>

                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">5. Durée de conservation</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Nous conservons vos données uniquement le temps nécessaire aux finalités définies ci-dessus :
                        </p>
                        <div class="bg-slate-50/50 p-5 rounded-lg
                        border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Données de compte : 5 ans sauf sous votre demande personnelle.</li>
                                <li class="pl-5">Données contractuelles : durée légale de conservation des contrats (6
                                    ans).</li>
                                <li class="pl-5">Données techniques : 1 an.</li>
                                <li class="pl-5">Données collectées par cookies : 6 mois.</li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Section 6 -->
                <!-- Sécurité des données -->
                <section id="securite-des-donnees" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z" clip-rule="evenodd" />
</svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">6. Sécurité des données</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Nous mettons en place des mesures de sécurité adaptées pour protéger vos données contre la
                            perte, l’accès non autorisé, la divulgation ou l’altération.
                        </p>
                        <p>Ces mesures incluent :</p>
                        <div class="bg-slate-50/50 p-5 rounded-lg
                        border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Chiffrement des données.</li>
                                <li class="pl-5">Accès restreint aux informations personnelles.</li>
                                <li class="pl-5">Hébergement sécurisé des serveurs.</li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Section 7 -->
                <!-- Vos droits -->
                <section id="vos-droits" class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
</svg>

                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">7. Vos droits</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Conformément au RGPD et à la loi applicable, vous disposez des droits suivants :
                        </p>
                        <div class="bg-slate-50/50 p-5 rounded-lg
                        border border-slate-200">
                            <ul class="list-disc pl-5 grid gap-2">
                                <li class="pl-5">Droit d’accès : obtenir une copie de vos données.</li>
                                <li class="pl-5">Droit de rectification : modifier ou corriger vos informations.</li>
                                <li class="pl-5">Droit à l’effacement : demander la suppression de vos données.</li>
                                <li class="pl-5">Droit à la limitation du traitement : restreindre temporairement
                                    l’utilisation de vos données.</li>
                                <li class="pl-5">Droit d’opposition : refuser l’utilisation de vos données dans certains
                                    cas.</li>
                                <li class="pl-5">Droit à la portabilité : récupérer vos données dans un format lisible.
                                </li>
                                <li class="pl-5">Pour exercer vos droits, contactez-nous à Vitalegis.social@gmail.com
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Section 8 -->
                <!-- Cookies et technologies similaires -->
                <section id="cookies-et-technologies-similaires"
                    class="bg-white rounded-xl p-8 shadow-lg border border-slate-100">
                    <div class="grid grid-cols-[auto,1fr] gap-4 mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg grid place-items-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 9a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-slate-900">8. Cookies et technologies similaires</h2>
                        </div>
                    </div>
                    <div class="space-y-4 text-slate-600">
                        <p>Nous utilisons des cookies pour améliorer votre expérience sur notre site.
                        </p>
                        <p>Si vous avez des questions, n’hésitez pas à nous contacter à Vitalegis.social@gmail.com.</p>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>

<div class="fixed bottom-6 right-6">
    <a href="#"
        class="grid place-items-center w-12 h-12 bg-white rounded-full shadow-lg border border-slate-200 hover:bg-slate-50 transition-colors tooltip"
        title="Retour en haut">
        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </a>
</div>

<?php
get_footer();
?>