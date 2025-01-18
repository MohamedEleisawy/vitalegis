<?php
/*
Plugin Name: Analytics Dashboard
Description: Affiche des données analytiques dans l'admin panel de WordPress.
Version: 1.0
Author: Ton Nom
*/

// Vérification de sécurité
if (!defined('ABSPATH')) {
    exit;
}

// Ajouter le menu dans la barre latérale
function ad_add_admin_menu() {
    add_menu_page(
        'Analytics Dashboard', // Titre de la page
        'Analytics', // Texte du menu
        'manage_options', // Capacité requise
        'analytics-dashboard', // Slug du menu
        'ad_admin_page', // Fonction de callback
        'dashicons-chart-area', // Icône
        25 // Position dans le menu
    );
}
add_action('admin_menu', 'ad_add_admin_menu');

// Fonction de callback pour afficher la page
function ad_admin_page() {
    // Enqueue Chart.js
    wp_enqueue_script('chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '4.4.0', true);
    wp_enqueue_style('analytics-dashboard-style', plugins_url('style.css', __FILE__));
    
    $period = isset($_GET['period']) ? sanitize_text_field($_GET['period']) : '12';
    $contracts_data = ad_get_contracts_by_months($period);
    $contracts_status = ad_get_contracts_status();
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <!-- Ajout des filtres de période -->
        <div class="period-filter">
            <a href="?page=analytics-dashboard&period=1" 
               class="filter-btn <?php echo $period === '1' ? 'active' : ''; ?>">1 mois</a>
            <a href="?page=analytics-dashboard&period=3" 
               class="filter-btn <?php echo $period === '3' ? 'active' : ''; ?>">3 mois</a>
            <a href="?page=analytics-dashboard&period=6" 
               class="filter-btn <?php echo $period === '6' ? 'active' : ''; ?>">6 mois</a>
            <a href="?page=analytics-dashboard&period=12" 
               class="filter-btn <?php echo $period === '12' ? 'active' : ''; ?>">1 an</a>
        </div>

        <div class="analytics-dashboard">
            <div class="analytics-card">
                <h3>Utilisateurs</h3>
                <p>Total <strong><?php echo ad_get_users_count(); ?></strong></p>
                <p>Actifs <strong><?php echo ad_get_active_users_count(); ?></strong></p>
                <p>Moyenne contrats/utilisateur <strong><?php echo ad_get_average_contracts(); ?></strong></p>
            </div>
            <div class="analytics-card with-chart">
                <h3>Contrats par mois</h3>
                <p>Total <strong><?php echo ad_get_contracts_count(); ?></strong></p>
                <p>Ce mois <strong><?php echo ad_get_contracts_this_month(); ?></strong></p>
                <div class="chart-container">
                    <canvas id="contractsChart"></canvas>
                </div>
            </div>
            <div class="analytics-card with-chart">
                <h3>État des contrats</h3>
                <div class="chart-container">
                    <canvas id="contractsStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Premier graphique (existant)
        const ctx = document.getElementById('contractsChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_keys($contracts_data)); ?>,
                datasets: [{
                    label: 'Contrats par mois',
                    data: <?php echo json_encode(array_values($contracts_data)); ?>,
                    borderColor: '#1e40af',
                    backgroundColor: 'rgba(30, 64, 175, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Nouveau graphique pour les statuts
        const ctxStatus = document.getElementById('contractsStatusChart');
        new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: ['Actifs', 'Expirés'],
                datasets: [{
                    label: 'Nombre de contrats',
                    data: [
                        <?php echo $contracts_status['active']; ?>,
                        <?php echo $contracts_status['expired']; ?>
                    ],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.2)',
                        'rgba(239, 68, 68, 0.2)'
                    ],
                    borderColor: [
                        'rgb(34, 197, 94)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
    </script>
    <?php
}

// Ajouter cette nouvelle fonction pour obtenir les contrats par mois
function ad_get_contracts_by_months($period = 12) {
    $args = array('fields' => 'ID');
    $users = get_users($args);
    $contracts_by_month = array();
    
    // Initialiser les X derniers mois selon la période
    for ($i = ($period - 1); $i >= 0; $i--) {
        $month = date('M Y', strtotime("-$i months"));
        $contracts_by_month[$month] = 0;
    }

    foreach ($users as $user_id) {
        $all_meta = get_user_meta($user_id);
        foreach ($all_meta as $key => $value) {
            if (strpos($key, 'contrat_') === 0) {
                $contract_data = maybe_unserialize($value[0]);
                $contract_date = date('M Y', strtotime($contract_data['date_debut']));
                if (isset($contracts_by_month[$contract_date])) {
                    $contracts_by_month[$contract_date]++;
                }
            }
        }
    }
    
    return $contracts_by_month;
}

// Récupérer le nombre total de contrats
function ad_get_contracts_count() {
    $args = array(
        'fields' => 'ID', // On ne récupère que les IDs des utilisateurs
    );
    $users = get_users($args); // Récupérer tous les utilisateurs
    $total_contracts = 0;

    // Parcourir chaque utilisateur
    foreach ($users as $user_id) {
        $all_meta = get_user_meta($user_id); // Récupérer les métadonnées de l'utilisateur

        // Compter les contrats pour cet utilisateur
        foreach ($all_meta as $key => $value) {
            if (strpos($key, 'contrat_') === 0) { // Vérifier si la clé commence par "contrat_"
                $total_contracts++;
            }
        }
    }

    return $total_contracts;
}

// Récupérer le nombre de contrats ce mois-ci
function ad_get_contracts_this_month() {
    $args = array(
        'fields' => 'ID', 
    );
    $users = get_users($args); 
    $current_month = date('m'); 
    $current_year = date('Y'); 
    $contracts_this_month = 0;

    // Parcourir chaque utilisateur
    foreach ($users as $user_id) {
        $all_meta = get_user_meta($user_id); // Récupérer les métadonnées de l'utilisateur

        // Parcourir les métadonnées pour trouver les contrats
        foreach ($all_meta as $key => $value) {
            if (strpos($key, 'contrat_') === 0) { // Vérifier si la clé commence par "contrat_"
                $contract_data = maybe_unserialize($value[0]); // Désérialiser les données du contrat
                $contract_date = strtotime($contract_data['date_debut']); // Convertir la date de début en timestamp

                // Vérifier si le contrat a été créé ce mois-ci
                if (date('m', $contract_date) == $current_month && date('Y', $contract_date) == $current_year) {
                    $contracts_this_month++;
                }
            }
        }
    }

    return $contracts_this_month;
}

// Fonction pour compter le nombre total d'utilisateurs
function ad_get_users_count() {
    $users = count_users();
    return $users['total_users'];
}

// Nouvelle fonction pour compter les utilisateurs actifs
function ad_get_active_users_count() {
    $args = array('fields' => 'ID');
    $users = get_users($args);
    $active_users = 0;

    foreach ($users as $user_id) {
        $all_meta = get_user_meta($user_id);
        foreach ($all_meta as $key => $value) {
            if (strpos($key, 'contrat_') === 0) {
                $active_users++;
                break; // Si l'utilisateur a au moins un contrat, on passe au suivant
            }
        }
    }

    return $active_users;
}

// Nouvelle fonction pour calculer la moyenne de contrats par utilisateur
function ad_get_average_contracts() {
    $total_users = ad_get_active_users_count();
    if ($total_users === 0) return '0';
    
    $total_contracts = ad_get_contracts_count();
    return number_format($total_contracts / $total_users, 1);
}

// Nouvelle fonction pour compter les contrats actifs vs expirés
function ad_get_contracts_status() {
    $args = array('fields' => 'ID');
    $users = get_users($args);
    $active = 0;
    $expired = 0;
    $today = strtotime('today');

    foreach ($users as $user_id) {
        $all_meta = get_user_meta($user_id);
        foreach ($all_meta as $key => $value) {
            if (strpos($key, 'contrat_') === 0) {
                $contract_data = maybe_unserialize($value[0]);
                $end_date = strtotime($contract_data['date_fin']);
                
                if ($end_date >= $today) {
                    $active++;
                } else {
                    $expired++;
                }
            }
        }
    }

    return array(
        'active' => $active,
        'expired' => $expired
    );
}