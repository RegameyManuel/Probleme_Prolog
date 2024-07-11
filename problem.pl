% Définition des maisons avec variables
maisons([
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_)
]).

% Fonction pour afficher la liste des maisons
afficher_liste([]).
afficher_liste([X|L]) :-
    writeln(X),
    afficher_liste(L).

% Fonctions pour vérifier l'appartenance et la position
appartient_à(X, [X|_]).
appartient_à(X, [_|L]) :- appartient_à(X, L).

est_à_gauche_de(A, B, [A, B|_]).
est_à_gauche_de(A, B, [_|Y]) :- est_à_gauche_de(A, B, Y).

est_à_côté_de(A, B, [A, B|_]).
est_à_côté_de(A, B, [B, A|_]).
est_à_côté_de(A, B, [_|Y]) :- est_à_côté_de(A, B, Y).

% Résoudre le problème
resoudre :-
    maisons(MAISONS),
    % Indices avec correction des placements et des variables
    nth1(1, MAISONS, maison(_, norvegien, _, _, _)), % Le Norvégien habite la première maison
    nth1(3, MAISONS, maison(_, _, _, lait, _)), % La maison du centre a du lait
    appartient_à(maison(rouge, anglais, _, _, _), MAISONS),
    appartient_à(maison(_, suedois, chien, _, _), MAISONS),
    appartient_à(maison(_, danois, _, thé, _), MAISONS),
    est_à_gauche_de(maison(verte, _, _, _, _), maison(blanche, _, _, _, _), MAISONS),
    appartient_à(maison(verte, _, _, café, _), MAISONS),
    appartient_à(maison(_, _, oiseaux, _, pall_mall), MAISONS),
    appartient_à(maison(jaune, _, _, _, dunhill), MAISONS),
    est_à_côté_de(maison(_, _, _, _, blend), maison(_, _, chats, _, _), MAISONS),
    est_à_côté_de(maison(_, _, cheval, _, _), maison(_, _, _, _, dunhill), MAISONS),
    appartient_à(maison(_, _, _, biere, blue_master), MAISONS),
    appartient_à(maison(_, allemand, _, _, prince), MAISONS),
    est_à_côté_de(maison(_, norvegien, _, _, _), maison(bleue, _, _, _, _), MAISONS),
    est_à_côté_de(maison(_, _, _, _, blend), maison(_, _, _, eau, _), MAISONS),
    appartient_à(maison(_, _, poisson, _, _), MAISONS),
    afficher_liste(MAISONS).

% Charger le programme (commenté pour éviter l'exécution immédiate)
% :- resoudre.
