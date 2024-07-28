
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
    n.id_note,
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
    n.notes,
    n.session
FROM 
    notes n
JOIN 
    etudiant e ON n.id_etudiant = e.id_etudiant
JOIN 
    matiere m ON n.id_matiere = m.id_matiere
JOIN 
    semestre s ON m.id_semestre = s.id_semestre
JOIN
    promotion p ON e.id_prom = p.id_prom;

