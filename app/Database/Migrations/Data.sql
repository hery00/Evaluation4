create table admin 
(
    id_admin serial primary key NOT NULL,
    nom VARCHAR(255),
    login VARCHAR(255),
    mdp VARCHAR(255),
    statut int default 1
);

INSERT INTO admin (nom,login,mdp) VALUES ('Admin', 'admin@gmail.com', '123');

create table promotion 
(
    id_prom serial primary key NOT NULL,
    nom_promotion VARCHAR(255)
);


INSERT INTO promotion (nom_promotion) VALUES ('P15');

create table etudiant 
(
    id_etudiant serial primary key NOT NULL,
    id_prom INT NOT NULL,
    etu INTEGER,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    dtn DATE,
    statut int default 2,
    FOREIGN KEY (id_prom) REFERENCES promotion(id_prom)
);

INSERT INTO etudiant (id_prom, etu, nom, prenom, dtn) VALUES (1,1610,'Rakoto','Jean','10-02-1997');

create table semestre 
(
    id_semestre serial primary key NOT NULL,
    nom_semestre VARCHAR(255)
);

INSERT INTO semestre (nom_semestre) VALUES ('S1');
INSERT INTO semestre (nom_semestre) VALUES ('S2');
INSERT INTO semestre (nom_semestre) VALUES ('S3');
INSERT INTO semestre (nom_semestre) VALUES ('S4');
INSERT INTO semestre (nom_semestre) VALUES ('S5');
INSERT INTO semestre (nom_semestre) VALUES ('S6');

create table matiere
(
    id_matiere serial primary key NOT NULL,
    id_semestre INT NOT NULL,
    UE VARCHAR(50),
    intitule VARCHAR(255),
    credits INTEGER,
    FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre)
);

-- Insertion des matières pour le semestre 1
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(1, 'INF101', 'Programmation procédurale', 7),
(1, 'INF104', 'HTML et Introduction au Web', 5),
(1, 'INF107', 'Informatique de Base', 4),
(1, 'MTH101', 'Arithmétique et nombres', 4),
(1, 'MTH102', 'Analyse mathématique', 6),
(1, 'ORG101', 'Techniques de communication', 4);

-- Insertion des matières pour le semestre 2
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(2, 'INF102', 'Bases de données relationnelles', 5),
(2, 'INF103', 'Bases de l''administration système', 5),
(2, 'INF105', 'Maintenance matériel et logiciel', 4),
(2, 'INF106', 'Compléments de programmation', 6),
(2, 'MTH103', 'Calcul Vectoriel et Matriciel', 6),
(2, 'MTH105', 'Probabilité et Statistique', 4);

-- Insertion des matières pour le semestre 3
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(3, 'INF201', 'Programmation orientée objet', 6),
(3, 'INF202', 'Bases de données objets', 6),
(3, 'INF203', 'Programmation système', 4),
(3, 'INF208', 'Réseaux informatiques', 6),
(3, 'MTH201', 'Méthodes numériques', 4),
(3, 'ORG201', 'Bases de gestion', 4);

-- Insertion des matières pour le semestre 4 (Parcours : Développement)
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(4, 'INF204', 'Système d''information géographique', 6),
(4, 'INF205', 'Système d''information', 6),
(4, 'INF206', 'Interface Homme/Machine', 6),
(4, 'INF207', 'Eléments d''algorithmique', 6),
(4, 'INF210', 'Mini-projet de développement', 10),
(4, 'MTH204', 'Géométrie', 4),
(4, 'MTH205', 'Equations différentielles', 4),
(4, 'MTH206', 'Optimisation', 4),
(4, 'MTH203', 'MAO', 4);

-- Insertion des matières pour le semestre 5 (Parcours : Développement)
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(5, 'INF301', 'Architecture logicielle', 6),
(5, 'INF304', 'Développement pour mobiles', 6),
(5, 'INF307', 'Conception en modèle orienté objet', 6),
(5, 'ORG301', 'Gestion d''entreprise', 5),
(5, 'ORG302', 'Gestion de projets', 4),
(5, 'ORG303', 'Anglais pour les affaires', 3);

-- Insertion des matières pour le semestre 6 (Parcours : Développement)
INSERT INTO matiere (id_semestre, UE, intitule, credits) VALUES
(6, 'INF310', 'Codage', 4),
(6, 'INF313', 'Programmation avancée, frameworks', 6),
(6, 'INF302', 'Technologies d''accès aux réseaux', 6),
(6, 'INF303', 'Multimédia', 6),
(6, 'INF316', 'Projet de développement', 10),
(6, 'ORG304', 'Communication d''entreprise', 4);

create table notes
(
    id_note serial primary key NOT NULL,
    id_etudiant INT,
    id_matiere INT,
    notes NUMERIC(5,2),
    session DATE,
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant),
    FOREIGN KEY (id_matiere) REFERENCES matiere(id_matiere)
);

-- Insertion de notes pour l'étudiant avec id_etudiant = 1
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 1, 0, '2024-06-15'),
    (1, 2, 16.00, '2024-06-15'),
    (1, 3, 14.75, '2024-06-15'),
    (1, 4, 13.25, '2024-06-15'),
    (1, 5, 17.00, '2024-06-15'),
    (1, 6, 18.50, '2024-06-15');

-- Insertion de notes pour l'étudiant avec id_etudiant = 1 pour le semestre 2
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 7, 9, '2024-07-10'), 
    (1, 8, 9, '2024-07-10'),
    (1, 9, 9, '2024-07-10'),
    (1, 10, 17.00, '2024-07-10'),
    (1, 11, 18.00, '2024-07-10'),
    (1, 12, 16.50, '2024-07-10');


-- Insertion de notes pour l'étudiant avec id_etudiant = 1 pour le semestre 3
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 13, 16.75, '2024-07-10'), 
    (1, 14, 5, '2024-07-10'), 
    (1, 15, 9.50, '2024-07-10'),
    (1, 16, 17.25, '2024-07-10'),
    (1, 17, 18.00, '2024-07-10'),
    (1, 18, 16.00, '2024-07-10');

-- Insérer les notes pour l'étudiant avec id_etudiant = 1 pour le semestre 4
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 19, 15.50, '2024-07-10'),
    (1, 20, 14.75, '2024-07-10'),
    (1, 21, 16.00, '2024-07-10'),
    (1, 22, 17.25, '2024-07-10'),
    (1, 23, 18.00, '2024-07-10'),
    (1, 24, 15.00, '2024-07-10'),
    (1, 25, 14.50, '2024-07-10'),
    (1, 26, 16.25, '2024-07-10'),
    (1, 27, 15.75, '2024-07-10');


-- Insérer les notes pour l'étudiant avec id_etudiant = 1 pour le semestre 5
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 28, 15.00, '2024-07-10'),
    (1, 29, 14.50, '2024-07-10'), 
    (1, 30, 16.25, '2024-07-10'), 
    (1, 31, 13.75, '2024-07-10'), 
    (1, 32, 14.00, '2024-07-10'),
    (1, 33, 15.50, '2024-07-10');



-- Insérer les notes pour l'étudiant avec id_etudiant = 1 pour le semestre 6
INSERT INTO notes (id_etudiant, id_matiere, notes, session)
VALUES
    (1, 34, 6, '2024-07-10'),  
    (1, 35, 9, '2024-07-10'),  
    (1, 36, 14.75, '2024-07-10'),
    (1, 37, 17.00, '2024-07-10'),
    (1, 38, 18.00, '2024-07-10'), 
    (1, 39, 15.00, '2024-07-10');

