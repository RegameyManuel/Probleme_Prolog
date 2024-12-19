<?php

// Attributs possibles
$colors       = ["red", "green", "white", "yellow", "blue"];
$nationalities = ["brit", "swede", "dane", "norwegian", "german"];
$drinks       = ["tea", "coffee", "milk", "beer", "water"];
$cigars       = ["pall_mall", "dunhill", "blend", "bluemaster", "prince"];
$pets         = ["dogs", "birds", "cats", "horse", "fish"];

// Fonction pour générer toutes les permutations d'un tableau
function permutations($array) {
    if (count($array) <= 1) {
        return [$array];
    }
    $result = [];
    foreach ($array as $key => $item) {
        $remaining = $array;
        unset($remaining[$key]);
        foreach (permutations($remaining) as $perm) {
            $result[] = array_merge([$item], $perm);
        }
    }
    return $result;
}

// Génère toutes les permutations pour chaque attribut
$allColors = permutations($colors);
$allNationalities = permutations($nationalities);
$allDrinks = permutations($drinks);
$allCigars = permutations($cigars);
$allPets = permutations($pets);

// Vérifie les contraintes sur une configuration (5 maisons)
function checkConstraints($houses) {
    // houses est un tableau de 5 maisons, chaque maison est un tableau associatif :
    // index: 0 à 4 (de gauche à droite)
    // attributs: 'color', 'nationality', 'drink', 'cigar', 'pet'

    // 1. Le Britannique vit dans la maison rouge.
    foreach ($houses as $h) {
        if ($h['nationality'] == 'brit' && $h['color'] != 'red') return false;
    }

    // 2. Le Suédois a des chiens.
    foreach ($houses as $h) {
        if ($h['nationality'] == 'swede' && $h['pet'] != 'dogs') return false;
    }

    // 3. Le Danois boit du thé.
    foreach ($houses as $h) {
        if ($h['nationality'] == 'dane' && $h['drink'] != 'tea') return false;
    }

    // 4. La maison verte est directement à gauche de la maison blanche.
    // On cherche un index i tel que house[i] = green et house[i+1] = white
    $found = false;
    for ($i=0; $i<4; $i++) {
        if ($houses[$i]['color'] == 'green' && $houses[$i+1]['color'] == 'white') {
            $found = true;
            break;
        }
    }
    if (!$found) return false;

    // 5. Le propriétaire de la maison verte boit du café.
    foreach ($houses as $h) {
        if ($h['color'] == 'green' && $h['drink'] != 'coffee') return false;
    }

    // 6. La personne qui fume des Pall Mall élève des oiseaux.
    foreach ($houses as $h) {
        if ($h['cigar'] == 'pall_mall' && $h['pet'] != 'birds') return false;
    }

    // 7. Le propriétaire de la maison jaune fume des Dunhill.
    foreach ($houses as $h) {
        if ($h['color'] == 'yellow' && $h['cigar'] != 'dunhill') return false;
    }

    // 8. La personne qui vit dans la maison du centre boit du lait.
    // La maison du centre est houses[2]
    if ($houses[2]['drink'] != 'milk') return false;

    // 9. Le Norvégien habite dans la première maison.
    if ($houses[0]['nationality'] != 'norwegian') return false;

    // 10. L'homme qui fume des Blend vit à côté de celui qui a des chats.
    // On cherche deux maisons voisines : l'une fume blend, l'autre a des chats
    if (!checkNeighbors($houses, 'cigar', 'blend', 'pet', 'cats')) return false;

    // 11. L'homme qui a un cheval est le voisin de celui qui fume des Dunhill.
    if (!checkNeighbors($houses, 'pet', 'horse', 'cigar', 'dunhill')) return false;

    // 12. Celui qui fume des Bluemaster boit de la bière.
    foreach ($houses as $h) {
        if ($h['cigar'] == 'bluemaster' && $h['drink'] != 'beer') return false;
    }

    // 13. L'Allemand fume des Prince.
    foreach ($houses as $h) {
        if ($h['nationality'] == 'german' && $h['cigar'] != 'prince') return false;
    }

    // 14. Le Norvégien vit juste à côté de la maison bleue.
    if (!checkNeighbors($houses, 'nationality', 'norwegian', 'color', 'blue')) return false;

    // 15. L'homme qui fume des Blend a un voisin qui boit de l'eau.
    if (!checkNeighbors($houses, 'cigar', 'blend', 'drink', 'water')) return false;

    return true;
}

// Fonction pour vérifier s'il existe deux maisons voisines telles que:
// House A a (key1 = val1) et House B a (key2 = val2) ou l'inverse.
function checkNeighbors($houses, $key1, $val1, $key2, $val2) {
    for ($i=0; $i<5; $i++) {
        if ($houses[$i][$key1] == $val1) {
            // vérifier voisin gauche
            if ($i>0 && $houses[$i-1][$key2] == $val2) return true;
            // vérifier voisin droit
            if ($i<4 && $houses[$i+1][$key2] == $val2) return true;
        }
    }
    return false;
}

// Maintenant, on tente toutes les combinaisons
// On part du principe que chaque liste (couleurs, nationalités, etc.) est déjà permutée indépendamment
// et on essaie de construire des maisons maison[i] = combinaison des 5 attributs.
// Une solution plus rapide est de boucler sur un seul grand produit cartésien. Cela va être un peu long, mais ça fonctionne.

foreach ($allColors as $colorPerm) {
    foreach ($allNationalities as $nationPerm) {
        foreach ($allDrinks as $drinkPerm) {
            foreach ($allCigars as $cigarPerm) {
                foreach ($allPets as $petPerm) {
                    // Construire les maisons
                    $houses = [];
                    for ($i=0; $i<5; $i++) {
                    	echo "Plouf!";
                        $houses[] = [
                            'color'       => $colorPerm[$i],
                            'nationality' => $nationPerm[$i],
                            'drink'       => $drinkPerm[$i],
                            'cigar'       => $cigarPerm[$i],
                            'pet'         => $petPerm[$i]
                        ];
                    }

                    // Vérifier les contraintes
                    if (checkConstraints($houses)) {
                        // Trouver qui a le poisson
                        foreach ($houses as $h) {
                            if ($h['pet'] == 'fish') {
                                echo "Le propriétaire du poisson est de nationalité : " . $h['nationality'] . "\n";
                                exit;
                            }
                        }
                    }
                }
            }
        }
    }
}

