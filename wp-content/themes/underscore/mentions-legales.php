<?php
/*
Template Name: Mentions légales
*/
?>

<?php get_template_part('template-parts/head'); ?>
<?php get_template_part('template-parts/navigation'); ?>
<div class="bg-gray-100 text-gray-800 font-sans min-h-screen">
    <div class="container mx-auto px-4 py-24">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-center mb-8">Mentions Légales</h1>

        <!-- Section 1: General Information -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold mb-4">1. Informations Générales</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><span class="font-semibold">Raison sociale :</span> <?php echo esc_html($companyName); ?></li>
                <li><span class="font-semibold">Statut juridique :</span> <?php echo esc_html($legalStatus); ?></li>
                <li><span class="font-semibold">Siège social :</span> <?php echo esc_html($headquarters); ?></li>
                <li><span class="font-semibold">Numéro SIRET :</span> <?php echo esc_html($siretNumber); ?></li>
                <li><span class="font-semibold">Directeur de publication :</span> <?php echo esc_html($publicationDirector); ?></li>
                <li>
                    <span class="font-semibold">Hébergeur du site :</span><br>
                </li>
            </ul>
        </div>

        <!-- Section 2: Site Purpose -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold mb-4">2. Objet du Site</h2>
            <p class="text-gray-700">
                Le site <span class="font-semibold"><?php echo esc_html($companyName); ?></span> a pour objectif de stocker et gérer des contrats ainsi que des informations personnelles pour vous permettre de vous alléger l'esprit en sécurisant vos différents documents.
            </p>
        </div>

        <!-- Section 3: Personal Data Protection -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold mb-4">3. Protection des Données Personnelles</h2>
            <p class="text-gray-700 mb-4">
                Conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi Informatique et Libertés, les informations personnelles collectées sur ce site sont traitées de manière sécurisée et confidentielle.
            </p>
            <h3 class="text-xl font-semibold mb-2">Données collectées :</h3>
            <ul class="list-disc list-inside text-gray-700 mb-4 space-y-1">
                <li>Nom, Prénom</li>
                <li>Adresse email</li>
                <li>Date de naissance</li>
                <li>Adresse postale</li>
                <li>N° de téléphone</li>
                <li>Noms et prénoms de familliers (héritiers)</li>
                <li>Adresse mail des héritiers</li>
                <li>N° de contrat</li>
                <li>Date de début de contrat</li>
                <li>Date de fin de contrat</li>
            </ul>
            <h3 class="text-xl font-semibold mb-2">Finalité du traitement :</h3>
            <p class="text-gray-700 mb-4">
                Gérer les informations des utilisateurs et assurer le bon fonctionnement du service.
            </p>
            <h3 class="text-xl font-semibold mb-2">Droit d'accès, de rectification et de suppression :</h3>
            <p class="text-gray-700 mb-4">
                Les utilisateurs peuvent exercer leurs droits en contactant <a href="mailto:Vitalegis.social@gmail.com" class="text-blue-500 hover:underline">Vitalegis.social@gmail.com</a>.
            </p>
            <h3 class="text-xl font-semibold mb-2">Conservation des données :</h3>
            <p class="text-gray-700 mb-4">
                Les données sont conservées pour une durée de 5 ans en ce qui concerne les données personnelles et 6 ans pour les contrats avant suppression.
            </p>
            <h3 class="text-xl font-semibold mb-2">Sécurité :</h3>
            <p class="text-gray-700">
                Les mesures nécessaires sont mises en place pour protéger les données contre les accès non autorisés.
            </p>
        </div>

        <!-- Section 4: Cookies -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold mb-4">4. Cookies</h2>
            <p class="text-gray-700">
                Le site utilise des cookies pour améliorer l'expérience utilisateur. L'utilisateur peut gérer ses préférences via les paramètres de son navigateur.
            </p>
        </div>

        <!-- Section 5: Responsibilities -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-semibold mb-4">5. Responsabilités</h2>
            <p class="text-gray-700">
                Le site ne saurait être tenu responsable en cas de mauvaise utilisation des services ou de perte de données consécutive à un cas de force majeure.
            </p>
        </div>

        <!-- Section 6: Contact -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">6. Contact</h2>
            <p class="text-gray-700">
                Pour toute question relative aux mentions légales ou à la gestion des données personnelles, veuillez contacter : <a href="mailto:Vitalegis.social@gmail.com" class="text-blue-500 hover:underline">Vitalegis.social@gmail.com</a>.
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>

