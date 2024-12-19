<?php

// Définir les attributs et leurs domaines
$colors = ['red', 'green', 'white', 'yellow', 'blue'];
$nationalities = ['brit', 'swede', 'dane', 'norwegian', 'german'];
$drinks = ['tea', 'coffee', 'milk', 'beer', 'water'];
$cigars = ['pall_mall', 'dunhill', 'blend', 'bluemaster', 'prince'];
$pets = ['dogs', 'birds', 'cats', 'horse', 'fish'];

// Initialiser les maisons avec contraintes connues
$houses = [
    ['color' => null, 'nationality' => 'norwegian', 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => null, 'cigar' => null, 'pet' => null],
    ['color' => null, 'nationality' => null, 'drink' => 'milk', 'cigar' => null, 'pet' => null],
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
            if (!isset($houses[$index + 1]['color']) || $houses[$index + 1]['color'] !== 'white') {
                return false;
            }
        }
        if ($house['color'] === 'white') {
            // La maison blanche doit avoir une maison verte immédiatement à sa gauche
            if (!isset($houses[$index - 1]['color']) || $houses[$index - 1]['color'] !== 'green') {
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

// Fonction de vérification des contraintes partielles
function isPartialValid($houses, $position) {
    // Vérifier les contraintes pour les maisons assignées jusqu'à 'position'
    $house = $houses[$position];

    // Si la couleur est verte, la maison suivante doit être blanche
    if ($house['color'] === 'green') {
        if ($position < 4) {
            if ($houses[$position + 1]['color'] !== null && $houses[$position + 1]['color'] !== 'white') {
                return false;
            }
        } else {
            // La maison verte ne peut pas être la dernière
            return false;
        }
    }

    // Si la couleur est blanche, la maison précédente doit être verte
    if ($house['color'] === 'white') {
        if ($position == 0 || $houses[$position - 1]['color'] !== 'green') {
            return false;
        }
    }

    // Si une maison a déjà un attribut assigné, vérifier les contraintes locales
    if ($house['nationality'] === 'brit' && $house['color'] !== 'red') {
        return false;
    }
    if ($house['nationality'] === 'swede' && $house['pet'] !== 'dogs') {
        return false;
    }
    if ($house['nationality'] === 'dane' && $house['drink'] !== 'tea') {
        return false;
    }
    if ($house['cigar'] === 'pall_mall' && $house['pet'] !== 'birds') {
        return false;
    }
    if ($house['color'] === 'yellow' && $house['cigar'] !== 'dunhill') {
        return false;
    }
    if ($house['nationality'] === 'german' && $house['cigar'] !== 'prince') {
        return false;
    }

    return true;
}

// Fonction de Backtracking optimisée
function solveOptimized($houses, $colors, $nationalities, $drinks, $cigars, $pets, $position = 0) {
    if ($position == 5) {
        if (isValid($houses)) {
            return $houses;
        }
        return null;
    }

    // Définir les attributs à assigner
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
                                                $result = solveOptimized($houses, $colors, $nationalities, $drinks, $cigars, $pets, $position + 1);
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

// Fonction principale pour lancer la résolution optimisée
function findOptimizedSolution() {
    global $houses, $colors, $nationalities, $drinks, $cigars, $pets;
    $solution = solveOptimized($houses, $colors, $nationalities, $drinks, $cigars, $pets);
    if ($solution !== null) {
        return $solution;
    } else {
        return "Aucune solution trouvée.";
    }
}

// Trouver et afficher la solution optimisée
$solution = findOptimizedSolution();
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
