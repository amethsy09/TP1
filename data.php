<?php
$clients = [
    [
        "id" => 1,
        "nom" => "DIOP",
        "prenom" => "Mahmoud",
        "telephone" => "777777777",
        "adresse" => "Dakar",
        "commandes" => [
            [
                "id" => 1,
                "date" => "2025-01-14",
                "montant" => 1000, // 200 * 5
                "statut" => "Confirmée",
                "articles" => [
                    [
                        "id" => 1,
                        "titre" => "Produit A",
                        "prix_unitaire" => 200,
                        "quantite" => 5
                    ]
                ]
            ]
        ]
    ],
    [
        "id" => 2,
        "nom" => "DIAGNE",
        "prenom" => "Marie",
        "telephone" => "763103176", // Vérifier s'il y a un doublon avec Aicha
        "adresse" => "Keur Massar",
        "commandes" => [
            [
                "id" => 2,
                "date" => "2025-01-13",
                "montant" => 1200, // 300 * 4
                "statut" => "En attente",
                "articles" => [
                    [
                        "id" => 2,
                        "article" => "Produit B",
                        "prix_unitaire" => 300,
                        "quantite" => 4
                    ]
                ]
            ]
        ]
    ],
    [
        "id" => 3,
        "nom" => "LY",
        "prenom" => "Aicha",
        "telephone" => "764567890", // Nouveau numéro pour éviter le doublon
        "adresse" => "Keur Mbaye Fall",
        "commandes" => [
            [
                "id" => 3,
                "date" => "2025-01-12",
                "montant" => 1200, // 400 * 3
                "statut" => "Confirmée",
                "articles" => [
                    [
                        "id" => 3,
                        "titre" => "Produit C",
                        "prix_unitaire" => 400,
                        "quantite" => 3
                    ]
                ]
            ]
        ]
    ],
    [
        "id" => 4,
        "nom" => "Bernard",
        "prenom" => "Sophie",
        "telephone" => "781926700",
        "adresse" => "Paris",
        "commandes" => [
            [
                "id" => 4,
                "date" => "2025-01-12",
                "montant" => 3000, // 1500 * 2
                "statut" => "En attente",
                "articles" => [
                    [
                        "id" => 4,
                        "titre" => "Produit D",
                        "prix_unitaire" => 1500,
                        "quantite" => 2
                    ]
                ]
            ]
        ]
    ]
];
