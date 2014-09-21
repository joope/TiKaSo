CREATE TABLE Asiakas
(
	AsiakasID serial PRIMARY KEY,
	Nimimerkki VARCHAR(32) NOT NULL,
	Salasana VARCHAR(128) NOT NULL,
	Email VARCHAR(128) NOT NULL,
	Hakutarkoitus VARCHAR(64),
	Syntymapaiva DATE(),
	Teksti VARCHAR(512),
	Yllapitaja boolean,
	Kuva BYTEA(),
);
CREATE TABLE Laskutustiedot
(
	LaskutusID serial PRIMARY KEY,
	AsiakasID integer References Asiakas(AsiakasID) NOT NULL, 
	Etunimi VARCHAR(64),
	Sukunimi VARCHAR(64),
	Paikkakunta VARCHAR(64),
	Asuinkaupunki VARCHAR(64),
	Osoite VARCHAR(128)
);

CREATE TABLE Viesti
(
	ViestiID serial PRIMARY KEY,
	LahettajaID integer references Asiakas(AsiakasID) NOT NULL,
	VastaanottajaID integer references Asiakas(AsiakasID) NOT NULL,
	Sisalto varchar(256) NOT NULL,
	Lahetysaika timestamp() NOT NULL,
	Luettu boolean
);
CREATE TABLE Kiinnostus
(	
	KiinnostusID serial PRIMARY KEY,
	Nimi varchar(64) NOT NULL,
	AsiakasID integer references Asiakas(AsiakasID)
);
CREATE TABLE Julkinensivu
(
	JulkinenID serial PRIMARY KEY,
	OmistajaID integer references Asiakas(AsiakasID),
	Raportoitu boolean
);
CREATE TABLE Salainensivu
(
	SalainenID serial PRIMARY KEY,
	OmistajaID integer references Asiakas(AsiakasID)
);
CREATE TABLE SalaisetSivutNakevat
(
	NakyvyysID serial PRIMARY KEY,
	SalainenID integer references Salainensivu(SalainenID),
	AsiakasID integer references Asiakas(AsiakasID)
);
