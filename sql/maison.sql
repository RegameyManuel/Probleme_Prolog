-- Requête pour résoudre le problème des cinq maisons en SQL

SELECT 
    Maison1.nationality AS Maison1_Nationalite,
    Maison1.color AS Maison1_Couleur,
    Maison1.drink AS Maison1_Boisson,
    Maison1.cigar AS Maison1_Cigare,
    Maison1.pet AS Maison1_Animal,
    
    Maison2.nationality AS Maison2_Nationalite,
    Maison2.color AS Maison2_Couleur,
    Maison2.drink AS Maison2_Boisson,
    Maison2.cigar AS Maison2_Cigare,
    Maison2.pet AS Maison2_Animal,
    
    Maison3.nationality AS Maison3_Nationalite,
    Maison3.color AS Maison3_Couleur,
    Maison3.drink AS Maison3_Boisson,
    Maison3.cigar AS Maison3_Cigare,
    Maison3.pet AS Maison3_Animal,
    
    Maison4.nationality AS Maison4_Nationalite,
    Maison4.color AS Maison4_Couleur,
    Maison4.drink AS Maison4_Boisson,
    Maison4.cigar AS Maison4_Cigare,
    Maison4.pet AS Maison4_Animal,
    
    Maison5.nationality AS Maison5_Nationalite,
    Maison5.color AS Maison5_Couleur,
    Maison5.drink AS Maison5_Boisson,
    Maison5.cigar AS Maison5_Cigare,
    Maison5.pet AS Maison5_Animal
    
FROM 
    -- Génération des combinaisons pour chaque maison
    (SELECT 'Maison1' AS maison) AS M1
    CROSS JOIN 
    (SELECT color FROM (VALUES 
        ('red'), ('green'), ('white'), ('yellow'), ('blue')
    ) AS colors(color)) AS C1
    CROSS JOIN 
    (SELECT nationality FROM (VALUES 
        ('brit'), ('swede'), ('dane'), ('norwegian'), ('german')
    ) AS nationalities(nationality)) AS N1
    CROSS JOIN 
    (SELECT drink FROM (VALUES 
        ('tea'), ('coffee'), ('milk'), ('beer'), ('water')
    ) AS drinks(drink)) AS D1
    CROSS JOIN 
    (SELECT cigar FROM (VALUES 
        ('pall_mall'), ('dunhill'), ('blend'), ('bluemaster'), ('prince')
    ) AS cigars(cigar)) AS Cigar1
    CROSS JOIN 
    (SELECT pet FROM (VALUES 
        ('dogs'), ('birds'), ('cats'), ('horse'), ('fish')
    ) AS pets(pet)) AS P1

    CROSS JOIN 

    (SELECT 'Maison2' AS maison) AS M2
    CROSS JOIN 
    (SELECT color FROM (VALUES 
        ('red'), ('green'), ('white'), ('yellow'), ('blue')
    ) AS colors(color)) AS C2
    CROSS JOIN 
    (SELECT nationality FROM (VALUES 
        ('brit'), ('swede'), ('dane'), ('norwegian'), ('german')
    ) AS nationalities(nationality)) AS N2
    CROSS JOIN 
    (SELECT drink FROM (VALUES 
        ('tea'), ('coffee'), ('milk'), ('beer'), ('water')
    ) AS drinks(drink)) AS D2
    CROSS JOIN 
    (SELECT cigar FROM (VALUES 
        ('pall_mall'), ('dunhill'), ('blend'), ('bluemaster'), ('prince')
    ) AS cigars(cigar)) AS Cigar2
    CROSS JOIN 
    (SELECT pet FROM (VALUES 
        ('dogs'), ('birds'), ('cats'), ('horse'), ('fish')
    ) AS pets(pet)) AS P2

    CROSS JOIN 

    (SELECT 'Maison3' AS maison) AS M3
    CROSS JOIN 
    (SELECT color FROM (VALUES 
        ('red'), ('green'), ('white'), ('yellow'), ('blue')
    ) AS colors(color)) AS C3
    CROSS JOIN 
    (SELECT nationality FROM (VALUES 
        ('brit'), ('swede'), ('dane'), ('norwegian'), ('german')
    ) AS nationalities(nationality)) AS N3
    CROSS JOIN 
    (SELECT drink FROM (VALUES 
        ('tea'), ('coffee'), ('milk'), ('beer'), ('water')
    ) AS drinks(drink)) AS D3
    CROSS JOIN 
    (SELECT cigar FROM (VALUES 
        ('pall_mall'), ('dunhill'), ('blend'), ('bluemaster'), ('prince')
    ) AS cigars(cigar)) AS Cigar3
    CROSS JOIN 
    (SELECT pet FROM (VALUES 
        ('dogs'), ('birds'), ('cats'), ('horse'), ('fish')
    ) AS pets(pet)) AS P3

    CROSS JOIN 

    (SELECT 'Maison4' AS maison) AS M4
    CROSS JOIN 
    (SELECT color FROM (VALUES 
        ('red'), ('green'), ('white'), ('yellow'), ('blue')
    ) AS colors(color)) AS C4
    CROSS JOIN 
    (SELECT nationality FROM (VALUES 
        ('brit'), ('swede'), ('dane'), ('norwegian'), ('german')
    ) AS nationalities(nationality)) AS N4
    CROSS JOIN 
    (SELECT drink FROM (VALUES 
        ('tea'), ('coffee'), ('milk'), ('beer'), ('water')
    ) AS drinks(drink)) AS D4
    CROSS JOIN 
    (SELECT cigar FROM (VALUES 
        ('pall_mall'), ('dunhill'), ('blend'), ('bluemaster'), ('prince')
    ) AS cigars(cigar)) AS Cigar4
    CROSS JOIN 
    (SELECT pet FROM (VALUES 
        ('dogs'), ('birds'), ('cats'), ('horse'), ('fish')
    ) AS pets(pet)) AS P4

    CROSS JOIN 

    (SELECT 'Maison5' AS maison) AS M5
    CROSS JOIN 
    (SELECT color FROM (VALUES 
        ('red'), ('green'), ('white'), ('yellow'), ('blue')
    ) AS colors(color)) AS C5
    CROSS JOIN 
    (SELECT nationality FROM (VALUES 
        ('brit'), ('swede'), ('dane'), ('norwegian'), ('german')
    ) AS nationalities(nationality)) AS N5
    CROSS JOIN 
    (SELECT drink FROM (VALUES 
        ('tea'), ('coffee'), ('milk'), ('beer'), ('water')
    ) AS drinks(drink)) AS D5
    CROSS JOIN 
    (SELECT cigar FROM (VALUES 
        ('pall_mall'), ('dunhill'), ('blend'), ('bluemaster'), ('prince')
    ) AS cigars(cigar)) AS Cigar5
    CROSS JOIN 
    (SELECT pet FROM (VALUES 
        ('dogs'), ('birds'), ('cats'), ('horse'), ('fish')
    ) AS pets(pet)) AS P5

WHERE
    -- Toutes les valeurs doivent être uniques par attribut
    C1.color <> C2.color AND C1.color <> C3.color AND C1.color <> C4.color AND C1.color <> C5.color AND
    C2.color <> C3.color AND C2.color <> C4.color AND C2.color <> C5.color AND
    C3.color <> C4.color AND C3.color <> C5.color AND
    C4.color <> C5.color AND

    N1.nationality <> N2.nationality AND N1.nationality <> N3.nationality AND N1.nationality <> N4.nationality AND N1.nationality <> N5.nationality AND
    N2.nationality <> N3.nationality AND N2.nationality <> N4.nationality AND N2.nationality <> N5.nationality AND
    N3.nationality <> N4.nationality AND N3.nationality <> N5.nationality AND
    N4.nationality <> N5.nationality AND

    D1.drink <> D2.drink AND D1.drink <> D3.drink AND D1.drink <> D4.drink AND D1.drink <> D5.drink AND
    D2.drink <> D3.drink AND D2.drink <> D4.drink AND D2.drink <> D5.drink AND
    D3.drink <> D4.drink AND D3.drink <> D5.drink AND
    D4.drink <> D5.drink AND

    Cigar1.cigar <> Cigar2.cigar AND Cigar1.cigar <> Cigar3.cigar AND Cigar1.cigar <> Cigar4.cigar AND Cigar1.cigar <> Cigar5.cigar AND
    Cigar2.cigar <> Cigar3.cigar AND Cigar2.cigar <> Cigar4.cigar AND Cigar2.cigar <> Cigar5.cigar AND
    Cigar3.cigar <> Cigar4.cigar AND Cigar3.cigar <> Cigar5.cigar AND
    Cigar4.cigar <> Cigar5.cigar AND

    P1.pet <> P2.pet AND P1.pet <> P3.pet AND P1.pet <> P4.pet AND P1.pet <> P5.pet AND
    P2.pet <> P3.pet AND P2.pet <> P4.pet AND P2.pet <> P5.pet AND
    P3.pet <> P4.pet AND P3.pet <> P5.pet AND
    P4.pet <> P5.pet AND

    -- Contraintes spécifiques
    -- 1. Le Britannique vit dans la maison rouge
    (N1.nationality = 'brit' AND C1.color = 'red') OR
    (N2.nationality = 'brit' AND C2.color = 'red') OR
    (N3.nationality = 'brit' AND C3.color = 'red') OR
    (N4.nationality = 'brit' AND C4.color = 'red') OR
    (N5.nationality = 'brit' AND C5.color = 'red') AND

    -- 2. Le Suédois a des chiens
    (N1.nationality = 'swede' AND P1.pet = 'dogs') OR
    (N2.nationality = 'swede' AND P2.pet = 'dogs') OR
    (N3.nationality = 'swede' AND P3.pet = 'dogs') OR
    (N4.nationality = 'swede' AND P4.pet = 'dogs') OR
    (N5.nationality = 'swede' AND P5.pet = 'dogs') AND

    -- 3. Le Danois boit du thé
    (N1.nationality = 'dane' AND D1.drink = 'tea') OR
    (N2.nationality = 'dane' AND D2.drink = 'tea') OR
    (N3.nationality = 'dane' AND D3.drink = 'tea') OR
    (N4.nationality = 'dane' AND D4.drink = 'tea') OR
    (N5.nationality = 'dane' AND D5.drink = 'tea') AND

    -- 4. La maison verte est directement à gauche de la maison blanche
    (
        (C1.color = 'green' AND C2.color = 'white') OR
        (C2.color = 'green' AND C3.color = 'white') OR
        (C3.color = 'green' AND C4.color = 'white') OR
        (C4.color = 'green' AND C5.color = 'white')
    ) AND

    -- 5. Le propriétaire de la maison verte boit du café
    (C1.color = 'green' AND D1.drink = 'coffee') OR
    (C2.color = 'green' AND D2.drink = 'coffee') OR
    (C3.color = 'green' AND D3.drink = 'coffee') OR
    (C4.color = 'green' AND D4.drink = 'coffee') OR
    (C5.color = 'green' AND D5.drink = 'coffee') AND

    -- 6. La personne qui fume des Pall Mall élève des oiseaux
    (Cigar1.cigar = 'pall_mall' AND P1.pet = 'birds') OR
    (Cigar2.cigar = 'pall_mall' AND P2.pet = 'birds') OR
    (Cigar3.cigar = 'pall_mall' AND P3.pet = 'birds') OR
    (Cigar4.cigar = 'pall_mall' AND P4.pet = 'birds') OR
    (Cigar5.cigar = 'pall_mall' AND P5.pet = 'birds') AND

    -- 7. Le propriétaire de la maison jaune fume des Dunhill
    (C1.color = 'yellow' AND Cigar1.cigar = 'dunhill') OR
    (C2.color = 'yellow' AND Cigar2.cigar = 'dunhill') OR
    (C3.color = 'yellow' AND Cigar3.cigar = 'dunhill') OR
    (C4.color = 'yellow' AND Cigar4.cigar = 'dunhill') OR
    (C5.color = 'yellow' AND Cigar5.cigar = 'dunhill') AND

    -- 8. La personne qui vit dans la maison du centre boit du lait
    D3.drink = 'milk' AND

    -- 9. Le Norvégien habite dans la première maison
    N1.nationality = 'norwegian' AND

    -- 10. L'homme qui fume des Blend vit à côté de celui qui a des chats
    (
        (Cigar1.cigar = 'blend' AND P2.pet = 'cats') OR
        (Cigar2.cigar = 'blend' AND (P1.pet = 'cats' OR P3.pet = 'cats')) OR
        (Cigar3.cigar = 'blend' AND (P2.pet = 'cats' OR P4.pet = 'cats')) OR
        (Cigar4.cigar = 'blend' AND (P3.pet = 'cats' OR P5.pet = 'cats')) OR
        (Cigar5.cigar = 'blend' AND P4.pet = 'cats')
    ) AND

    -- 11. L'homme qui a un cheval est le voisin de celui qui fume des Dunhill
    (
        (P1.pet = 'horse' AND Cigar2.cigar = 'dunhill') OR
        (P2.pet = 'horse' AND (Cigar1.cigar = 'dunhill' OR Cigar3.cigar = 'dunhill')) OR
        (P3.pet = 'horse' AND (Cigar2.cigar = 'dunhill' OR Cigar4.cigar = 'dunhill')) OR
        (P4.pet = 'horse' AND (Cigar3.cigar = 'dunhill' OR Cigar5.cigar = 'dunhill')) OR
        (P5.pet = 'horse' AND Cigar4.cigar = 'dunhill')
    ) AND

    -- 12. Celui qui fume des Bluemaster boit de la bière
    (Cigar1.cigar = 'bluemaster' AND D1.drink = 'beer') OR
    (Cigar2.cigar = 'bluemaster' AND D2.drink = 'beer') OR
    (Cigar3.cigar = 'bluemaster' AND D3.drink = 'beer') OR
    (Cigar4.cigar = 'bluemaster' AND D4.drink = 'beer') OR
    (Cigar5.cigar = 'bluemaster' AND D5.drink = 'beer') AND

    -- 13. L'Allemand fume des Prince
    (N1.nationality = 'german' AND Cigar1.cigar = 'prince') OR
    (N2.nationality = 'german' AND Cigar2.cigar = 'prince') OR
    (N3.nationality = 'german' AND Cigar3.cigar = 'prince') OR
    (N4.nationality = 'german' AND Cigar4.cigar = 'prince') OR
    (N5.nationality = 'german' AND Cigar5.cigar = 'prince') AND

    -- 14. Le Norvégien vit juste à côté de la maison bleue
    (
        (N1.nationality = 'norwegian' AND C2.color = 'blue') OR
        (N2.nationality = 'norwegian' AND (C1.color = 'blue' OR C3.color = 'blue')) OR
        (N3.nationality = 'norwegian' AND (C2.color = 'blue' OR C4.color = 'blue')) OR
        (N4.nationality = 'norwegian' AND (C3.color = 'blue' OR C5.color = 'blue')) OR
        (N5.nationality = 'norwegian' AND C4.color = 'blue')
    ) AND

    -- 15. L'homme qui fume Blend a un voisin qui boit de l'eau
    (
        (Cigar1.cigar = 'blend' AND D2.drink = 'water') OR
        (Cigar2.cigar = 'blend' AND (D1.drink = 'water' OR D3.drink = 'water')) OR
        (Cigar3.cigar = 'blend' AND (D2.drink = 'water' OR D4.drink = 'water')) OR
        (Cigar4.cigar = 'blend' AND (D3.drink = 'water' OR D5.drink = 'water')) OR
        (Cigar5.cigar = 'blend' AND D4.drink = 'water')
    )

LIMIT 1; -- Nous limitons à une seule solution

