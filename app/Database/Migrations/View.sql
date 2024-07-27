CREATE VIEW v_etudiant_promotion AS
SELECT 
    e.id_etudiant,
    e.id_prom,
    e.etu,
    e.nom,
    e.prenom,
    e.dtn,
    p.nom_promotion
FROM 
    etudiant e
JOIN 
    promotion p
ON 
    e.id_prom = p.id_prom;


