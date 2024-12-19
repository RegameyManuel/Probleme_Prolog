<?php

// Attributs possibles
$colors        = ["red", "green", "white", "yellow", "blue"];
$nationalities = ["brit", "swede", "dane", "norwegian", "german"];
$drinks        = ["tea", "coffee", "milk", "beer", "water"];
$cigars        = ["pall_mall", "dunhill", "blend", "bluemaster", "prince"];
$pets          = ["dogs", "birds", "cats", "horse", "fish"];

// Génération de permutations
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

// On sait déjà :
// 1. Le Norvégien habite dans la première maison.
// On va donc filtrer les permutations de nationalities pour ne garder que celles avec 'norwegian' en premier.
$allNationalities = [];
foreach (permutations($nationalities) as $perm) {
    if ($perm[0] == 'norwegian') {
        $allNationalities[] = $perm;
    }
}

// 2. La personne dans la maison du centre (index 2) boit du lait.
$allDrinksFiltered = [];
foreach (permutations($drinks) as $perm) {
    if ($perm[2] == 'milk') {
        $allDrinksFiltered[] = $perm;
    }
}

// 3. La maison verte est directement à gauche de la maison blanche.
// On ne garde que les permutations de couleurs où 'green' est juste à gauche de 'white'
$allColorsFiltered = [];
foreach (permutations($colors) as $perm) {
    for ($i=0; $i<4; $i++) {
        if ($perm[$i] == 'green' && $perm[$i+1] == 'white') {
            $allColorsFiltered[] = $perm;
            break;
        }
    }
}

// Maintenant, on a réduit :
// - Les couleurs : filtrées par la contrainte verte-blanche
// - Les nationalités : norvégien en première maison
// - Les boissons : lait au centre

$allCigars = permutations($cigars);
$allPets   = permutations($pets);

// Vérifie les contraintes sur la configuration
function checkConstraints($houses) {
    // 1. Britannique dans la maison rouge
    foreach ($houses as $h) {
        if ($h['nationality'] == 'brit' && $h['color'] != 'red') return false;
    }

    // 2. Suédois a des chiens
    foreach ($houses as $h) {
        if ($h['nationality'] == 'swede' && $h['pet'] != 'dogs') return false;
    }

    // 3. Danois boit du thé
    foreach ($houses as $h) {
        if ($h['nationality'] == 'dane' && $h['drink'] != 'tea') return false;
    }

    // 5. Le propriétaire de la maison verte boit du café
    foreach ($houses as $h) {
        if ($h['color'] == 'green' && $h['drink'] != 'coffee') return false;
    }

    // 6. Pall Mall -> oiseaux
    foreach ($houses as $h) {
        if ($h['cigar'] == 'pall_mall' && $h['pet'] != 'birds') return false;
    }

    // 7. La maison jaune fume Dunhill
    foreach ($houses as $h) {
        if ($h['color'] == 'yellow' && $h['cigar'] != 'dunhill') return false;
    }

    // 10. Blend à côté de chats
    if (!checkNeighbors($houses, 'cigar', 'blend', 'pet', 'cats')) return false;

    // 11. Celui qui a un cheval est voisin de celui qui fume Dunhill
    if (!checkNeighbors($houses, 'pet', 'horse', 'cigar', 'dunhill')) return false;

    // 12. Celui qui fume Bluemaster boit de la bière
    foreach ($houses as $h) {
        if ($h['cigar'] == 'bluemaster' && $h['drink'] != 'beer') return false;
    }

    // 13. L'Allemand fume Prince
    foreach ($houses as $h) {
        if ($h['nationality'] == 'german' && $h['cigar'] != 'prince') return false;
    }

    // 14. Le Norvégien à côté de la maison bleue
    if (!checkNeighbors($houses, 'nationality', 'norwegian', 'color', 'blue')) return false;

    // 15. Celui qui fume Blend a un voisin qui boit de l'eau
    if (!checkNeighbors($houses, 'cigar', 'blend', 'drink', 'water')) return false;

    return true;
}

function checkNeighbors($houses, $key1, $val1, $key2, $val2) {
    for ($i=0; $i<5; $i++) {
        if ($houses[$i][$key1] == $val1) {
            if ($i>0 && $houses[$i-1][$key2] == $val2) return true;
            if ($i<4 && $houses[$i+1][$key2] == $val2) return true;
        }
    }
    return false;
}

foreach ($allColorsFiltered as $colorPerm) {
    foreach ($allNationalities as $nationPerm) {
        foreach ($allDrinksFiltered as $drinkPerm) {
            foreach ($allCigars as $cigarPerm) {
                foreach ($allPets as $petPerm) {
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

                    if (checkConstraints($houses)) {
                        // Afficher qui a le poisson
                        foreach ($houses as $h) {
                            if ($h['pet'] == 'fish') {
                                echo "C'est le " . $h['nationality'] . " qui a le poisson.\n";
                                exit;
                            }
                        }
                    }
                }
            }
        }
    }
}
