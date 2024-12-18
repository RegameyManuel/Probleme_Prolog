Ce code Prolog met en place et résout un puzzle logique (souvent connu sous le nom de « l’énigme d’Einstein » ou « le puzzle des cinq maisons »). L’objectif du puzzle est de déterminer, à partir d’un ensemble d’indices, la répartition de caractéristiques (couleur de la maison, nationalité de l’habitant, boisson, animal de compagnie, marque de cigare) dans cinq maisons distinctes, alignées et disposées dans un ordre déterminé.

Voici une analyse détaillée des différents éléments du code :

### Structure des données

Le code définit d’abord une structure de données représentant les maisons :

```prolog
maisons([
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_)
]).
```

Ici, `maisons` est un prédicat qui, lorsqu’il est appelé, renvoie une liste de 5 éléments, chacun étant une structure `maison(Couleur, Nationalité, Animal, Boisson, Cigare)`. Les underscores (`_`) indiquent des variables libres non encore unifiées. L’idée est que ces 5 maisons seront déterminées par unification avec les contraintes ultérieures.

### Affichage de la liste

```prolog
afficher_liste([]).
afficher_liste([X|L]) :-
    writeln(X),
    afficher_liste(L).
```

`afficher_liste` est un prédicat utilitaire qui prend une liste et l’affiche élément par élément. Il sert en fin de résolution pour visualiser la solution trouvée.

### Vérification de l’appartenance et relations de position

Le code définit des prédicats utiles pour exprimer les contraintes logiques :

```prolog
appartient_a(X, [X|_]).
appartient_a(X, [_|L]) :- appartient_a(X, L).
```

- `appartient_a(X, Liste)` : Ce prédicat est vrai si `X` est un élément de `Liste`. Il s’agit d’un simple membre/2 réimplémenté.

```prolog
a_gauche_de(A, B, [A, B|_]).
a_gauche_de(A, B, [_|Y]) :- a_gauche_de(A, B, Y).
```

- `a_gauche_de(A, B, Maisons)` : Ce prédicat est vrai si dans la liste `Maisons`, l’élément `A` se trouve immédiatement à gauche de l’élément `B`.  
  Exemple : `a_gauche_de(maison(verte,...), maison(blanche,...), MAISONS)` indique que la maison verte est immédiatement à gauche de la maison blanche.

```prolog
a_cote_de(A, B, [A, B|_]).
a_cote_de(A, B, [B, A|_]).
a_cote_de(A, B, [_|Y]) :- a_cote_de(A, B, Y).
```

- `a_cote_de(A, B, Maisons)` : Ce prédicat est vrai si `A` et `B` sont deux éléments adjacents (dans un ordre quelconque) dans la liste `Maisons`.

### Les contraintes (le cœur du puzzle)

La partie `solution` énonce toutes les conditions du puzzle :

```prolog
solution :-
    maisons(MAISONS),

    % Le Norvégien habite la première maison (maison n°1)
    nth1(1, MAISONS, maison(_, norvegien, _, _, _)),

    % La maison du centre (3e) a du lait
    nth1(3, MAISONS, maison(_, _, _, lait, _)),

    % Chaque "appartient_a" force l'unification d'une maison spécifique dans le tableau
    appartient_a(maison(rouge, anglais, _, _, _), MAISONS),
    appartient_a(maison(_, suedois, chien, _, _), MAISONS),
    appartient_a(maison(_, danois, _, thé, _), MAISONS),

    % La maison verte est à gauche de la maison blanche
    a_gauche_de(maison(verte, _, _, _, _), maison(blanche, _, _, _, _), MAISONS),

    % La maison verte a du café
    appartient_a(maison(verte, _, _, café, _), MAISONS),

    % L'habitant qui fume Pall Mall a des oiseaux
    appartient_a(maison(_, _, oiseaux, _, pall_mall), MAISONS),

    % La maison jaune a des Dunhill
    appartient_a(maison(jaune, _, _, _, dunhill), MAISONS),

    % La maison dont l'habitant fume Blend est à côté de celle où il y a des chats
    a_cote_de(maison(_, _, _, _, blend), maison(_, _, chats, _, _), MAISONS),

    % La maison dont l'habitant a un cheval est à côté de celle qui a des Dunhill
    a_cote_de(maison(_, _, cheval, _, _), maison(_, _, _, _, dunhill), MAISONS),

    % Celui qui boit de la bière fume Blue Master
    appartient_a(maison(_, _, _, biere, blue_master), MAISONS),

    % L'allemand fume Prince
    appartient_a(maison(_, allemand, _, _, prince), MAISONS),

    % Le norvégien est à côté de la maison bleue
    a_cote_de(maison(_, norvegien, _, _, _), maison(bleue, _, _, _, _), MAISONS),

    % Celui qui fume Blend est à côté de celui qui boit de l’eau
    a_cote_de(maison(_, _, _, _, blend), maison(_, _, _, eau, _), MAISONS),

    % On cherche à déterminer le propriétaire du poisson
    appartient_a(maison(_, _, poisson, _, _), MAISONS),

    % Afficher la solution une fois toutes les contraintes satisfaites
    afficher_liste(MAISONS).
```

Chaque ligne impose une contrainte sur la liste `MAISONS`. Les prédicats `nth1/3` fixent une maison précise (1ère, 3ème, etc.), `appartient_a/2` indique qu’une maison répondant à certains critères doit être présente dans la liste, et `a_gauche_de/3`, `a_cote_de/3` imposent des relations spatiales entre les maisons.

Toutes ces contraintes combinées vont permettre à Prolog d’unifier les variables dans `MAISONS` avec des valeurs cohérentes (couleur, nationalité, animal, boisson, marque de cigare) de façon à ce que tous les prédicats soient vrais simultanément.

Une fois l’ensemble des contraintes satisfaites, `afficher_liste(MAISONS)` affichera la liste finale des maisons, révélant l’arrangement correct et, ainsi, la solution au puzzle (notamment qui possède le poisson).

### En résumé

- Le code définit la structure de cinq maisons.
- Il impose un ensemble de contraintes logiques (nationalités, boissons, animaux, marques de cigare, couleurs, positions relatives).
- Prolog tente d’unifier toutes ces conditions pour trouver une solution unique.
- La solution est alors affichée, montrant quelle maison a quelle caractéristique.  

Ce code illustre l’utilisation de Prolog pour résoudre un puzzle logique par la simple expression de contraintes.
