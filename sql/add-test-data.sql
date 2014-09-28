INSERT INTO Asiakas (Nimimerkki, Salasana, Email, Hakutarkoitus, Syntymapaiva, Teksti, Yllapitaja) 
VALUES ('Jonne', 'superman', 'jonnejonneton@gmail.com', 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Janita', 'superwoman', 'janita@hotmail.com', 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true), 
('Jonne', 'superman', 'jonnejonneton@gmail.com', 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Jp', 'superwoman', 'janita@hotmail.com', 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true),
('Hilla', 'superman', 'jonnejonneton@gmail.com', 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Hermione', 'superwoman', 'janita@hotmail.com', 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true),
('Ikii', 'superman', 'jonnejonneton@gmail.com', 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('Onni', 'superwoman', 'janita@hotmail.com', 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true),
('Elisa', 'superman', 'jonnejonneton@gmail.com', 'Ystäviä', DATE '1993-07-12', 'Oon ihan hyvä jätkä, tuu sanoo moi', false),
('', 'superwoman', 'janita@hotmail.com', 'Ystäviä', DATE '1993-03-09', 'Oon ihan hyvä typy, tuu sanoo moi :)', true);

INSERT INTO Viesti (LahettajaID, VastaanottajaID, Sisalto, Lahetysaika)
VALUES (1, 2, 'tykkääks kissoista?' , TIMESTAMP '1999-01-08 04:05:06
'),
(2, 1, 'joo ;)' , TIMESTAMP '1999-01-08 04:05:12
');

INSERT INTO Kiinnostus (Nimi, AsiakasID)
VALUES ('Uiminen', 1), ('Urheilu', 1);

INSERT INTO Julkinensivu (OmistajaID, Raportoitu)
VALUES (1, false);

INSERT INTO Salainensivu (OmistajaID)
VALUES (1);

INSERT INTO SalaisetSivutNakevat(SalainenID, AsiakasID)
VALUES (1, 2);
