INSERT INTO Asiakas (Nimimerkki, Salasana, Email, Sukupuoli, Hakutarkoitus, Syntymapaiva, Teksti, Yllapitaja) 
VALUES ('Jonne', 'superman', 'jonnejonneton@gmail.com', true, 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Janita', 'superwoman', 'janita@hotmail.com', false, 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true), 
('Jonne2', 'superman', 'jonnejonneton@gmail.com', true, 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Jp', 'superwoman', 'janita@hotmail.com', true, 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', false),
('Hilla', 'superman', 'jonnejonneton@gmail.com', false, 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Hermione', 'superwoman', 'janita@hotmail.com', false, 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', false),
('Ikii', 'superman', 'jonnejonneton@gmail.com', true, 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Onni', 'superwoman', 'janita@hotmail.com', true, 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', false),
('Elisa', 'superman', 'jonnejonneton@gmail.com', false, 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Hanneli', 'superwoman', 'janita@hotmail.com', false, 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', false);

INSERT INTO Viesti (LahettajaID, VastaanottajaID, Sisalto, Lahetysaika)
VALUES (1, 2, 'tykkääks kissoista?' , TIMESTAMP '1999-01-08 04:05:06
'),
(2, 1, 'joo ;)' , TIMESTAMP '1999-01-08 04:05:12
');

INSERT INTO Salainensivu (OmistajaID, Otsikko, Sisalto)
VALUES (1, 'Salaisuuteni', 'Tämä on jonnen salaisuus, jonne salaisesti tykkää php:stä'), (2, ':3:3:3', 'Tämä on jonnan salaisuus, jonna on salaisesti ihastunut Jonneen :3');

INSERT INTO SalaistenNakyvyys(SalainenID, AsiakasID)
VALUES (1, 2), (2, 1), (1, 6);
