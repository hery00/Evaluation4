
CREATE VIEW v_etudiant_promotion AS
SELECT 
    e.id_etudiant,
    e.id_prom,
    e.etu,
    e.nom,
    e.prenom,
    e.dtn,
    e.statut,
    p.nom_promotion
FROM 
    etudiant e
JOIN 
    promotion p
ON 
    e.id_prom = p.id_prom;


CREATE VIEW v_notes_details AS
SELECT 
    e.id_etudiant,
    e.etu,
    e.nom AS nom_etudiant,
    e.prenom AS prenom_etudiant,
    m.id_matiere,
    m.UE,
    m.intitule AS intitule_matiere,
    m.credits,
    s.id_semestre,
    s.nom_semestre,
    p.nom_promotion,
    nr.notes,
    nr.session
FROM 
    v_notes_reels nr
JOIN 
    etudiant e ON nr.id_etudiant = e.id_etudiant
JOIN 
    matiere m ON nr.id_matiere = m.id_matiere
JOIN 
    semestre s ON m.id_semestre = s.id_semestre
JOIN
    promotion p ON e.id_prom = p.id_prom;



CREATE VIEW v_moyenne AS
SELECT ROUND((SUM(credits * notes)) / SUM(credits), 2) AS moyenne_ponderee
FROM v_notes_details;

create or replace view v_notes_reels as
select id_etudiant,id_matiere,0 as notes,current_date as session from etudiant,matiere union select id_etudiant,id_matiere,notes,session from notes;