<?php

// Définir les attributs et leurs domaines
$colors = ['red', 'green', 'white', 'yellow', 'blue'];
$nationalities = ['brit', 'swede', 'dane', 'norwegian', 'german'];
$drinks = ['tea', 'coffee', 'milk', 'beer', 'water'];
$cigars = ['pall_mall', 'dunhill', 'blend', 'bluemaster', 'prince'];
$pets = ['dogs', 'birds', 'cats', 'horse', 'fish'];

// Initialiser les maisons
$houses = [
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
];

// Fonction de vérification des contraintes
function isValid($houses) {
    foreach ($houses as $index => $house) {
        // Contraintes spécifiques
        if ($house['nationality'] === 'brit' && $house['color'] !== 'red') {
            return false;
        }
        if ($house['nationality'] === 'swede' && $house['pet'] !== 'dogs') {
            return false;
        }
        if ($house['nationality'] === 'dane' && $house['drink'] !== 'tea') {
            return false;
        }
        if ($house['color'] === 'green') {
            if ($house['drink'] !== 'coffee') return false;
            // La maison verte doit être immédiatement à gauche de la maison blanche
            if (!isset($houses[$index + 1]) || $houses[$index + 1]['color'] !== 'white') {
                return false;
            }
        }
        if ($house['color'] === 'white') {
            // La maison blanche doit avoir une maison verte immédiatement à sa gauche
            if (!isset($houses[$index - 1]) || $houses[$index - 1]['color'] !== 'green') {
                return false;
            }
        }
        if ($house['cigar'] === 'pall_mall' && $house['pet'] !== 'birds') {
            return false;
        }
        if ($house['color'] === 'yellow' && $house['cigar'] !== 'dunhill') {
            return false;
        }
        if ($index === 2 && $house['drink'] !== 'milk') { // Maison du centre
            return false;
        }
        if ($house['nationality'] === 'german' && $house['cigar'] !== 'prince') {
            return false;
        }
    }

    // Contraintes globales
    // Le Norvégien habite dans la première maison
    if ($houses[0]['nationality'] !== 'norwegian') {
        return false;
    }

    // Le Norvégien vit juste à côté de la maison bleue
    $norwegian_index = array_search('norwegian', array_column($houses, 'nationality'));
    if ($norwegian_index !== false) {
        $next_to_blue = false;
        if ($norwegian_index > 0 && $houses[$norwegian_index - 1]['color'] === 'blue') {
            $next_to_blue = true;
        }
        if ($norwegian_index < 4 && $houses[$norwegian_index + 1]['color'] === 'blue') {
            $next_to_blue = true;
        }
        if (!$next_to_blue) {
            return false;
        }
    }

    // La personne qui fume des blend vit à côté de celle qui a des chats
    $blend_index = array_search('blend', array_column($houses, 'cigar'));
    if ($blend_index !== false) {
        $has_cats = false;
        if ($blend_index > 0 && $houses[$blend_index - 1]['pet'] === 'cats') {
            $has_cats = true;
        }
        if ($blend_index < 4 && $houses[$blend_index + 1]['pet'] === 'cats') {
            $has_cats = true;
        }
        if (!$has_cats) {
            return false;
        }
    }

    // L'homme qui a un cheval est le voisin de celui qui fume des Dunhill
    $horse_index = array_search('horse', array_column($houses, 'pet'));
    $dunhill_index = array_search('dunhill', array_column($houses, 'cigar'));
    if ($horse_index !== false && $dunhill_index !== false) {
        $is_neighbor = false;
        if (abs($horse_index - $dunhill_index) === 1) {
            $is_neighbor = true;
        }
        if (!$is_neighbor) {
            return false;
        }
    }

    // Celui qui fume des Bluemaster boit de la bière
    foreach ($houses as $house) {
        if ($house['cigar'] === 'bluemaster' && $house['drink'] !== 'beer') {
            return false;
        }
    }

    // Celui qui fume des blend a un voisin qui boit de l'eau
    $blend_index = array_search('blend', array_column($houses, 'cigar'));
    if ($blend_index !== false) {
        $has_water_neighbor = false;
        if ($blend_index > 0 && $houses[$blend_index - 1]['drink'] === 'water') {
            $has_water_neighbor = true;
        }
        if ($blend_index < 4 && $houses[$blend_index + 1]['drink'] === 'water') {
            $has_water_neighbor = true;
        }
        if (!$has_water_neighbor) {
            return false;
        }
    }

    return true;
}

// Fonction de Backtracking
function solve($houses, $colors, $nationalities, $drinks, $cigars, $pets, $position = 0) {
    if ($position == 5) {
        if (isValid($houses)) {
            return $houses;
        }
        return null;
    }

    // Assignation des valeurs possibles pour chaque attribut
    foreach ($colors as $color) {
        if (!in_array($color, array_column($houses, 'color'))) {
            $houses[$position]['color'] = $color;

            foreach ($nationalities as $nationality) {
                if (!in_array($nationality, array_column($houses, 'nationality'))) {
                    $houses[$position]['nationality'] = $nationality;

                    foreach ($drinks as $drink) {
                        if (!in_array($drink, array_column($houses, 'drink'))) {
                            $houses[$position]['drink'] = $drink;

                            foreach ($cigars as $cigar) {
                                if (!in_array($cigar, array_column($houses, 'cigar'))) {
                                    $houses[$position]['cigar'] = $cigar;

                                    foreach ($pets as $pet) {
                                        echo "plouf!";
                                        if (!in_array($pet, array_column($houses, 'pet'))) {
                                            $houses[$position]['pet'] = $pet;

                                            // Vérifier les contraintes partielles
                                            if (isPartialValid($houses, $position)) {
                                                $result = solve($houses, $colors, $nationalities, $drinks, $cigars, $pets, $position + 1);
                                                if ($result !== null) {
                                                    return $result;
                                                }
                                            }

                                            // Réinitialiser l'animal si la contrainte n'est pas respectée
                                            $houses[$position]['pet'] = null;
                                        }
                                    }

                                    // Réinitialiser le cigare si nécessaire
                                    $houses[$position]['cigar'] = null;
                                }
                            }

                            // Réinitialiser la boisson si nécessaire
                            $houses[$position]['drink'] = null;
                        }
                    }

                    // Réinitialiser la nationalité si nécessaire
                    $houses[$position]['nationality'] = null;
                }
            }

            // Réinitialiser la couleur si nécessaire
            $houses[$position]['color'] = null;
        }
    }

    return null;
}

// Fonction de vérification des contraintes partielles
function isPartialValid($houses, $position) {
    // Vérifier les contraintes pour les maisons assignées jusqu'à 'position'
    // Ici, vous pouvez ajouter des vérifications pour s'assurer que les contraintes ne sont pas violées partiellement

    // Exemple simplifié : on peut vérifier certaines contraintes dès qu'une variable est assignée
    $house = $houses[$position];

    // Si la couleur est verte, vérifier si elle est à gauche de la blanche
    if ($house['color'] === 'green') {
        if (!isset($houses[$position + 1]['color']) || $houses[$position + 1]['color'] !== 'white') {
            // Si la maison verte n'est pas la dernière et la suivante n'est pas blanche, cela pourrait être incorrect
            // Mais on ne sait pas encore la couleur de la maison suivante
            // Donc on laisse passer pour le moment
        }
    }

    // Autres contraintes partielles peuvent être ajoutées ici

    return true;
}

// Fonction principale pour lancer la résolution
function findSolution() {
    global $houses, $colors, $nationalities, $drinks, $cigars, $pets;
    $solution = solve($houses, $colors, $nationalities, $drinks, $cigars, $pets);
    if ($solution !== null) {
        return $solution;
    } else {
        return "Aucune solution trouvée.";
    }
}

// Trouver et afficher la solution
$solution = findSolution();
if (is_array($solution)) {
    foreach ($solution as $index => $house) {
        echo "Maison " . ($index + 1) . ":\n";
        echo "  Couleur: " . $house['color'] . "\n";
        echo "  Nationalité: " . $house['nationality'] . "\n";
        echo "  Boisson: " . $house['drink'] . "\n";
        echo "  Cigare: " . $house['cigar'] . "\n";
        echo "  Animal: " . $house['pet'] . "\n\n";
    }

    // Trouver qui a le poisson
    foreach ($solution as $house) {
        if ($house['pet'] === 'fish') {
            echo "Le propriétaire du poisson est de nationalité : " . $house['nationality'] . "\n";
            break;
        }
    }
} else {
    echo $solution;
}

?>
