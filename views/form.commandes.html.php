<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Section Commande -->
        <div class="bg-white p-6 rounded-lg shadow-lg space-y-6">
            <h2 class="text-xl font-bold text-gray-800">Informations Client</h2>
            <form action="" method="get" class="space-y-4">
                <input type="hidden" name="controller" value="commandes">
                <input type="hidden" name="page" value="ajout">
                <div class="flex space-x-4 items-center">
                    <label for="tel" class="block text-sm text-gray-700">Téléphone</label>
                    <input type="text" name="tel" placeholder="Entrez le numéro de téléphone" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= isset($_GET['tel']) ? htmlspecialchars($_GET['tel']) : '' ?>"">
                    <button type=" submit" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300">OK</button>
                </div>

            </form>
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="nom" class="block text-sm text-gray-700">Nom</label>
                    <input type="text" id="nom" readonly name="nom" placeholder="Entrez le nom" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($nom) ?>">
                </div>
                <div class="flex-1">
                    <label for="prenom" class="block text-sm text-gray-700">Prénom</label>
                    <input type="text" id="prenom" readonly name="prenom" placeholder="Entrez le prénom" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($prenom) ?>">
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Ajouter un Article</h2>
            <form action="" method="POST" class="flex space-x-4 mb-6">
                <input type="number" name="id" placeholder="id" class="w-1/4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="article" placeholder="Nom de l'article" class="w-1/3 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" name="prix_unitaire" placeholder="Prix" class="w-1/4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" name="quantite" placeholder="Quantité" class="w-1/4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" name="ajouter" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">Ajouter</button>
            </form>

            <!-- Tableau des Articles -->
            <table class="w-full table-auto border-collapse border border-gray-300 shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-3">Article</th>
                        <th class="border p-3">Prix</th>
                        <th class="border p-3">Quantité</th>
                        <th class="border p-3">Montant</th>
                        <th class="border p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['articles'] as $art) : ?>
                        <tr>
                            <td class="border p-3"><?= htmlspecialchars($art['article']); ?></td>
                            <td class="border p-3"><?=number_format($art['prix_unitaire']); ?> FCFA</td>
                            <td class="border p-3"><?=htmlspecialchars($art['quantite']); ?></td>
                            <td class="border p-3">
                                <?=
                                $montant = $art['prix_unitaire'] * $art['quantite'];
                                 number_format($montant) . ' FCFA';
                                ?>
                            </td>
                            <td class="border p-3">
                                <a href="?supprimer=<?php echo $art['id']; ?>" class="text-red-600 hover:text-red-800">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Total & Commander -->
            <div class="mt-6 flex justify-between items-center">
                <span class="text-2xl font-bold text-gray-800">Total : FCFA</span>
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300">Commander</button>
            </div>
        </div>
    </div>
</body>

</html>