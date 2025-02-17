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
            $id = $_POST['id'] ?? null;
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
            unset($_SESSION['articles'][$id_to_delete]);
            $_SESSION['articles'] = array_values($_SESSION['articles']);
                    header("Location: ?controller=commandes&page=ajout");
                    exit;
            
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
            // Recharger la page pour vider les champs
            header("Location: " . $_SERVER['PHP_SELF'] . "?controller=commandes&page=ajout");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commander'])) {

           $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
           if (empty($tel)) {
            echo "Erreur : Numéro de téléphone manquant.";
            exit;
        }
    

    // Calcul du montant total
    $montantTotal = 0;
    if (!empty($_SESSION['articles'])) {
        foreach ($_SESSION['articles'] as $article) {
            $montantTotal += $article['prix'] * $article['quantite'];
        }
    }
        // recuperation de l'id
        $idCommande = uniqid();
        $commande = [
            'id' => $idCommande,
            'articles' => $_SESSION['articles'],
            'tel' => $tel,
            'date' => date('Y-m-d H:i:s'),
            ];
            $_SESSION['commandes'][$tel][] = $commande;
            redirect('commandes', 'Allcommandes');
            
        }
        $Allcommandes = $_SESSION['commandes'] ?? [];

        require_once "../views/form.commandes.html.php";
    } elseif ($page == "Allcommandes") {
        // unset($_SESSION['clients'],$_SESSION['commandes']);
        $Allcommandes = recupToutLesCommandedes();
        require_once "../views/Allcommandes.html.php";
    }
}
