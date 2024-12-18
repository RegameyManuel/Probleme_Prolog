## Introduction à Prolog

Prolog est un langage de programmation logique. Au lieu de décrire la manière de résoudre un problème (approche impérative), on décrit les relations entre les faits et les règles, puis on interroge le système. Prolog s’occupe de la résolution par un processus appelé « résolution par retour sur trace » (backtracking).

### Conception du langage

- **Faits et règles** : Un programme Prolog est essentiellement une collection de faits et de règles sur un domaine.  
  *Exemple :*  
  
  ```prolog
  pigeon(socrate).
  mortel(X) :- pigeon(X).
  ```
  
  Ces deux lignes indiquent :  
  
  - `pigeon(socrate).` est un fait : Socrate est un pigeon.
  - `mortel(X) :- pigeon(X).` est une règle : X est mortel s’il est un pigeon.

- **Interrogations** : Pour poser une question (une requête), on tape quelque chose comme :  
  
  ```prolog
  ?- mortel(socrate).
  ```
  
  Prolog répondra `true` si la requête est satisfiable avec les faits et règles, `false` sinon.

### Variables, Unification et Backtracking

- **Variables** : Les variables en Prolog commencent par une majuscule (ex : `X`, `Personne`).
- **Unification** : L’unification est le processus d’appariement de deux termes. Par exemple, `X = 2` unifie `X` avec la valeur `2`.
- **Backtracking** : Si une solution ne fonctionne pas, Prolog revient en arrière pour tester d’autres options. Cela permet d’explorer un espace de solutions sans avoir à tout coder manuellement.

## Installation et utilisation de SWI-Prolog

- **Installation** :  

 ```bash
  sudo apt-get install swi-prolog
 ```


- **Lancement** :  
  Tapez `swipl` dans un terminal ou double-cliquez sur l’icône du programme. Vous obtiendrez le prompt Prolog :  
  
  ```prolog
  ?-
  ```

- **Charger un fichier** :  
  Si vous avez un fichier appelé `programme.pl`, vous pouvez le charger dans SWI-Prolog :  
  
  ```prolog
  ?- [programme].
  ```
  
  ou  
  
  ```prolog
  ?- consult('programme.pl').
  ```

## Notions de base du langage

1. **Faits** :  
   Un fait décrit une vérité de base, par exemple :  
   
   ```prolog
   aime(socrate, chocolat).
   ```
   
   indique que `socrate` aime le `chocolat`.

2. **Règles** :  
   Une règle se compose d’une tête et d’un corps séparés par le symbole `:-`.  
   
   ```prolog
   aime(X, pain) :- pigeon(X).
   ```
   
   signifie « X aime le pain si X est un pigeon ».

3. **Requêtes** :  
   Une fois les faits et règles chargés, vous pouvez interroger :  
   
   ```prolog
   ?- aime(socrate, chocolat).
   ```
   
   Si c’est vrai, Prolog répondra `true.`. Sinon `false.`  
   
   Ou encore, pour trouver qui aime le chocolat :
   
   ```prolog
   ?- aime(Personne, chocolat).
   ```
   
   Prolog va tenter de résoudre la variable `Personne`.

4. **Listes** :  
   Les listes sont une structure de données fondamentale en Prolog. Elles sont définies par récursivité :  
   
   - Liste vide : `[]`
   - Liste non vide : `[Tête|Reste]`  
     Exemple : `[a, b, c]` est équivalent à `[a|[b|[c|[]]]]`.
   
   Les prédicats courants pour les listes incluent `member/2`, `append/3`, etc. SWI-Prolog fournit `member/2` par défaut.

5. **Opérateurs courants** :  
   
   - `=` : unification (tenter de rendre deux termes égaux).
   - `\=` : vérification que deux termes ne peuvent pas être unifiés.
   - `==` : test d’égalité strict sans unification.
   - `\==` : test strict de différence sans unification.
   - `=..` : décompose un terme en liste `[Functeur|Arguments]`.


## Bonnes pratiques

1. **Commentaires** :  
   Les commentaires en Prolog se font avec `%` pour une ligne, ou `/* ... */` pour des commentaires sur plusieurs lignes.

2. **Nommage des prédicats** :  
   Utilisez des noms de prédicats descriptifs et des variables claires.

3. **Débogage** :  
   SWI-Prolog offre un mode débogage :
   
   - `trace.` passe en mode pas-à-pas.
   - `spy Predicat.` pose un point d’arrêt sur un prédicat.
   
   On peut ensuite utiliser `leap`, `skip`, `creep`, `abort` etc. pour naviguer dans l’exécution.

4. **Organisation du code** :  
   Regroupez vos faits, règles utilitaires et règles principales.  
   Utilisez plusieurs fichiers si nécessaire, et `consult/1` ou `use_module/1` pour importer des modules.

5. **Modules** :  
   SWI-Prolog permet d’organiser le code en modules. On déclare un module avec :  
   
   ```prolog
   :- module(nom_module, [public_predicat/2, ...]).
   ```
   
   Puis on peut importer ce module dans un autre fichier.
   

## Ressources complémentaires

- **Documentation officielle SWI-Prolog** :  
  [https://www.swi-prolog.org/pldoc/](https://www.swi-prolog.org/pldoc/)  
  Vous y trouverez la description de tous les prédicats intégrés, les modules, et les fonctionnalités avancées.

- **Communauté** :  
  
  - Forum SWI-Prolog : [https://swi-prolog.discourse.group/](https://swi-prolog.discourse.group/)  

