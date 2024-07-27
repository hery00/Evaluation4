create table admin 
(
    id_admin serial primary key NOT NULL,
    nom VARCHAR(255),
    email VARCHAR(255),
    mdp VARCHAR(255)
);

INSERT INTO admin (nom, email, mdp) VALUES ('Admin', 'admin@gmail.com', '123');

create table promotion 
(
    id_prom serial primary key NOT NULL,
    nom_promotion VARCHAR(255)
);

INSERT INTO admin (nom_promotion) VALUES ('P15');

create table etudiant 
(
    id_etudiant serial primary key NOT NULL,
    id_prom INT NOT NULL,
    etu INTEGER,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    dtn DATE,
    FOREIGN KEY (id_prom) REFERENCES promotion(id_prom)
);

INSERT INTO admin (id_prom, etu, nom, prenom, dtn) VALUES (1,1610,'Rakoto','Jean','10/02/1997');

create table semestre 
(
    id_semestre serial primary key NOT NULL,
    nom_semestre VARCHAR(255)
);

INSERT INTO admin (nom_semestre) VALUES ('S1');
INSERT INTO admin (nom_semestre) VALUES ('S2');
INSERT INTO admin (nom_semestre) VALUES ('S3');
INSERT INTO admin (nom_semestre) VALUES ('S4');
INSERT INTO admin (nom_semestre) VALUES ('S5');
INSERT INTO admin (nom_semestre) VALUES ('S6');

create table matiere
(
    id_matiere serial primary key NOT NULL,
    id_semestre INT NOT NULL,
    UE VARCHAR(50),
    intitule VARCHAR(255),
    credits INTEGER,
    FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre)
);


create table notes
(
    id_note serial primary key NOT NULL,
    id_etudiant INT,
    id_matiere INT,
    notes NUMERIC(2,2),
    session DATE,
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant),
    FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere)
);