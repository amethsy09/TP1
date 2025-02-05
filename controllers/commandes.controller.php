<?php
session_start(); // Démarrer la session

require_once "../model.php";

// Gestion de la page 
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    if ($page == "commandes") {
        $clientId = isset($_GET['client_id']) ? (int)$_GET['client_id'] : null;
        if ($clientId) {
            $client = findClientById($clientId);
            if ($client) {
                $commandes = isset($client['commandes']) ? $client['commandes'] : [];
                require_once "../views/list.commandes.html.php";
            } else {
                echo "Client non trouvé.";
                exit;
            }
        } else {
            echo "ID de client manquant.";
            exit;
        }
    } elseif ($page == "ajout") {
        $nom = '';
        $prenom = '';
        $tel = '';

        // Si un numéro de téléphone est passé dans l'URL, on effectue la recherche
        if (isset($_GET['tel'])) {
            $tel = $_GET['tel'];
            $clients = findAllClients();
            // Recherche du client en fonction du numéro de téléphone
            foreach ($clients as $client) {
                if ($client['telephone'] === $tel) {
                    $nom = $client['nom'];
                    $prenom = $client['prenom'];
                    break;  // Arrêter la boucle dès qu'on trouve le client
                }
            }
        }
        if (!isset($_SESSION['articles'])) {
            $_SESSION['articles'] = [];
        }
        $articles = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
            // Récupérer les valeurs du formulaire
            $id = $_POST['id'];
            $article = $_POST['article'];
            $prix_unitaire = $_POST['prix_unitaire'];
            $quantite = $_POST['quantite'];

            // Calculer le montant
            $montant = $prix_unitaire * $quantite;

            // Ajouter l'article au tableau
            $articles[] = [
                'id' => $id,
                'article' => $article,
                'prix_unitaire' => $prix_unitaire,
                'quantite' => $quantite,
                'montant' => $montant
            ];
        }
        if (isset($_GET['supprimer'])) {
            // Supprimer l'article par son ID
            $id_to_delete = $_GET['supprimer'];
            foreach ($_SESSION['articles'] as $key => $art) {
                if ($art['id'] == $id_to_delete) {
                    unset($_SESSION['articles'][$key]);
                    break;
                }
            }
            // Réindexer les clés du tableau après suppression
            $_SESSION['articles'] = array_values($_SESSION['articles']);
        }
        require_once "../views/form.commandes.html.php";
    }
}
