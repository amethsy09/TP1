<?php
session_start(); // Démarrer la session
// session_destroy();
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
            $client = getClientByTel($tel);
            $_SESSION['client'] = $client;
        //  var_dump($_SESSION['client']);  
        }
        if (!isset($_SESSION['articles'])) {
            $_SESSION['articles'] = [];
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
            // Récupérer les valeurs du formulaire
            $id = $_POST['id']?? null;
            $article = $_POST['article'];
            $prix_unitaire = $_POST['prix_unitaire'];
            $quantite = $_POST['quantite'];
        
            if (isset($_POST['prix_unitaire']) && isset($_POST['quantite'])) {
                $prix_unitaire = (float) $_POST['prix_unitaire'];
                $quantite = (int) $_POST['quantite'];
                
                if (is_numeric($prix_unitaire) && is_numeric($quantite)) {
                    $montant = $prix_unitaire * $quantite;
                } else {
                    echo "Erreur : Le prix ou la quantité n'est pas valide.";
                    exit;
                }
            } else {
                echo "Erreur : Prix ou quantité manquants.";
                exit;
            }
            // Calculer le montant
            $prix_unitaire = (float) $_POST['prix_unitaire']; 
            $quantite = (int) $_POST['quantite']; 
            // Calculer le montant
            $montant = $prix_unitaire * $quantite;
            
            // Ajouter l'article au tableau de session
            $_SESSION['articles'][] = [
                'id' => $id,
                'article' => $article,
                'prix_unitaire' => $prix_unitaire,
                'quantite' => $quantite,
                'montant' => $montant
            ];
             
        }
         // calculer le total
              $total = array_sum(array_column($_SESSION['articles'], 'montant'));
               number_format($total) . ' FCFA';
              $_SESSION['total'] = $total;
        
        if (isset($_GET['supprimer'])) {
            $id_to_delete = $_GET['supprimer'];
            foreach ($_SESSION['articles'] as $key => $art) {
                if ($art['id'] == $id_to_delete) {
                    unset($_SESSION['articles'][$key]);
                    $_SESSION['articles'] = array_values($_SESSION['articles']);
                    header("Location: ?controller=commandes&page=ajout"); 
                    exit;
                }
            }
        }
        // recuperation de l'id
        if (isset($_GET['modifier'])) {
            $idModifier = $_GET['modifier'];
            foreach ($_SESSION['articles'] as $art) {
                if ($art['id'] == $idModifier) {
                    $articleModifier = $art;
                    break;
                }
            }
        }
        // je met a jour l'article a modifier 
        if (isset($_POST['modifier_article'])) {
            foreach ($_SESSION['articles'] as &$art) {
                if ($art['id'] == $_POST['id']) {
                    $art['article'] = $_POST['article'];
                    $art['prix_unitaire'] = $_POST['prix_unitaire'];
                    $art['quantite'] = $_POST['quantite'];
                    break;
                }
            }
        }
         

        require_once "../views/form.commandes.html.php";
    }
}
