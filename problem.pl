% Définition d'une "liste" maisons contenant cinq "objets-tableau" maison 
maisons([
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_),
    maison(_,_,_,_,_)
]).

% Fonction pour afficher la liste maisons
afficher_liste([]).
afficher_liste([X|L]) :-
    writeln(X),
    afficher_liste(L).

% Fonctions pour vérifier l'appartenance et la position
appartient_a(X, [X|_]).
appartient_a(X, [_|L]) :- appartient_a(X, L).

a_gauche_de(A, B, [A, B|_]).
a_gauche_de(A, B, [_|Y]) :- a_gauche_de(A, B, Y).

a_cote_de(A, B, [A, B|_]).
a_cote_de(A, B, [B, A|_]).
a_cote_de(A, B, [_|Y]) :- a_cote_de(A, B, Y).

% Résoudre le problème
solution :-
    maisons(MAISONS),
    nth1(1, MAISONS, maison(_, norvegien, _, _, _)),            % Le Norvégien habite la première maison
    nth1(3, MAISONS, maison(_, _, _, lait, _)),                 % La maison du centre a du lait ....
    appartient_a(maison(rouge, anglais, _, _, _), MAISONS),
    appartient_a(maison(_, suedois, chien, _, _), MAISONS),
    appartient_a(maison(_, danois, _, thé, _), MAISONS),
    a_gauche_de(maison(verte, _, _, _, _), maison(blanche, _, _, _, _), MAISONS),
    appartient_a(maison(verte, _, _, café, _), MAISONS),
    appartient_a(maison(_, _, oiseaux, _, pall_mall), MAISONS),
    appartient_a(maison(jaune, _, _, _, dunhill), MAISONS),
    a_cote_de(maison(_, _, _, _, blend), maison(_, _, chats, _, _), MAISONS),
    a_cote_de(maison(_, _, cheval, _, _), maison(_, _, _, _, dunhill), MAISONS),
    appartient_a(maison(_, _, _, biere, blue_master), MAISONS),
    appartient_a(maison(_, allemand, _, _, prince), MAISONS),
    a_cote_de(maison(_, norvegien, _, _, _), maison(bleue, _, _, _, _), MAISONS),
    a_cote_de(maison(_, _, _, _, blend), maison(_, _, _, eau, _), MAISONS),
    appartient_a(maison(_, _, poisson, _, _), MAISONS),
    afficher_liste(MAISONS).

