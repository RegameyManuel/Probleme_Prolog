Voici quelques exemples simples de code en SWI-Prolog, illustrant différents aspects du langage. Les exemples supposent que vous utilisez SWI-Prolog dans un terminal ou un éditeur compatible.

### 1. Base de faits et règles

Un premier exemple est de définir une petite base de connaissances sur les relations familiales :

```prolog
% Faits
homme(pierre).
homme(jean).
femme(marie).
femme(anne).

parent(marie, jean).
parent(pierre, jean).
parent(jean, anne).

% Règle : X est le père de Y si X est un homme et X est parent de Y
pere(X, Y) :-
    homme(X),
    parent(X, Y).

% Règle : X est la mère de Y si X est une femme et X est parent de Y
mere(X, Y) :-
    femme(X),
    parent(X, Y).
```

#### Requêtes possibles :
- `?- pere(pierre, jean).` devrait retourner `true`.
- `?- mere(marie, jean).` devrait retourner `true`.
- `?- pere(X, anne).` devrait retourner `X = jean`.
- `?- mere(X, anne).` devrait échouer, car aucune femme n'est définie comme parent d’anne.

### 2. Listes et récursion

Un exemple d’utilisation des listes et d’une règle récursive pour calculer la longueur d’une liste :

```prolog
% Calcul de la longueur d'une liste
longueur([], 0).
longueur([_|Reste], N) :-
    longueur(Reste, N1),
    N is N1 + 1.
```

#### Requêtes possibles :
- `?- longueur([], L).` donne `L = 0`.
- `?- longueur([a, b, c], L).` donne `L = 3`.

### 3. Règles pour la recherche dans une liste

Vérifier si un élément est membre d’une liste :

```prolog
membre(X, [X|_]).
membre(X, [_|R]) :-
    membre(X, R).
```

#### Requêtes possibles :
- `?- membre(a, [a, b, c]).` donne `true`.
- `?- membre(d, [a, b, c]).` échoue.

### 4. Opérateurs et unifications

Un exemple simple montrant un predicat qui compare deux nombres :

```prolog
plus_grand(X, Y) :-
    X > Y.
```

#### Requêtes possibles :
- `?- plus_grand(5, 3).` donne `true`.
- `?- plus_grand(2, 4).` donne `false`.

### 5. Utilisation de prédicats intégrés

SWI-Prolog fournit des prédicats intégrés utiles, comme `append/3` pour concaténer des listes :

```prolog
% Utilisation de append/3 pour concaténer deux listes
fusion_listes(L1, L2, L3) :-
    append(L1, L2, L3).
```

#### Requêtes possibles :
- `?- fusion_listes([1,2],[3,4],L).` retourne `L = [1,2,3,4].`

### 6. Backtracking et multiple réponses

Prolog peut renvoyer plusieurs solutions en explorant le backtracking. Par exemple :

```prolog
couleur(rouge).
couleur(vert).
couleur(bleu).

test_couleur(C) :- couleur(C).
```

#### Requête :
- `?- test_couleur(X).`  
  Proposera successivement `X = rouge; X = vert; X = bleu`.

---

Ces exemples ne représentent qu’une fraction des possibilités de SWI-Prolog, mais ils constituent une bonne base pour comprendre la syntaxe, la représentation des connaissances, l’inférence par backtracking et la manipulation des listes.