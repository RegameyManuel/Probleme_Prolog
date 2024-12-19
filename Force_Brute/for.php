<?php

// Définir le tableau à itérer
$plouf = [1, 2, 3, 4, 5]; // Vous pouvez ajuster la taille du tableau ici

$compteur = 0;    // Nombre de fois que la boucle for est exécutée

$start = microtime(true); // Enregistrer l'heure de début

while ((microtime(true) - $start) < 1) { // Boucle jusqu'à ce qu'une seconde soit écoulée
    for ($i = 0; $i < count($plouf); $i++) {
        // Opération minimale pour éviter que la boucle ne soit optimisée
        $dummy = $plouf[$i];
    }
    $compteur++;
}

echo "Nombre de boucles for exécutées en 1 seconde : $compteur\n";

?>
