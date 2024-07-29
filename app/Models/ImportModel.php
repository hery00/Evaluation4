<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportModel extends Model
{
    protected $table = 'import_note';

    protected $allowedFields = [
        'numETU',
        'nom',
        'prenom',
        'genre', 
        'datedenaissance',
        'promotion', 
        'codeMatiere',
        'semestre',
        'note'
    ];
    // Méthode pour insérer les données
    // public function insertCsvData($data)
    // {
    //     return $this->insert($data);
    // }
    public function import_csv($filepath, $ligneDeb = 1, $ligneFin = -1, $separateur = ',', $enclosure = '"')
        {
            if (!file_exists($filepath) || !is_readable($filepath)) {
                return false;
            }

            $donnees = [];
            if (($fichier_handle = fopen($filepath, 'r')) !== false) {
                $nligne = 1;
                while (($ligne = fgetcsv($fichier_handle, 1000, $separateur, $enclosure)) !== false) {
                    if ($ligneFin > 0) {
                        if ($nligne >= $ligneDeb && $nligne <= $ligneFin) {
                            $donnees[] = $ligne;
                        } 
                    } else {
                        if ($nligne >= $ligneDeb) {
                            $donnees[] = $ligne;
                        }
                    }
                    $nligne++;
                }
                fclose($fichier_handle);
            }

            return $donnees;
        }

    // INSERT CSV NOTES
    public function insertCsvPromotion()
    {
        $this->db->query('ALTER TABLE promotion DISABLE TRIGGER ALL;');

        $sql="INSERT INTO promotion (nom_promotion) 
        SELECT promotion
        FROM import_note 
        GROUP BY promotion";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE promotion ENABLE TRIGGER ALL;');
    }  

    public function insertCsvEtudiant()
    {
        $this->db->query('ALTER TABLE etudiant DISABLE TRIGGER ALL;');

        $sql = "INSERT INTO etudiant (id_prom, etu, nom, prenom, genre, dtn) 
                SELECT pr.id_prom, ino.numETU, ino.nom, ino.prenom, ino.genre, ino.datedenaissance 
                FROM import_note ino
                JOIN promotion pr ON pr.nom_promotion = ino.promotion
                GROUP BY pr.id_prom, ino.numETU, ino.nom, ino.prenom, ino.genre, ino.datedenaissance";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE etudiant ENABLE TRIGGER ALL;');
    }

    // public function insertCsvSemestre()
    // {
    //     $this->db->query('ALTER TABLE semestre DISABLE TRIGGER ALL;');

    //     $sql="INSERT INTO semestre (nom_semestre) 
    //     SELECT semestre
    //     FROM import_note 
    //     GROUP BY semestre ORDER BY semestre ASC";
        
    //     $this->db->query($sql);
    //     $this->db->query('ALTER TABLE semestre ENABLE TRIGGER ALL;');
    // }  
    

    public function insertCsvNotes()
    {
        $this->db->query('ALTER TABLE notes DISABLE TRIGGER ALL;');

        $sql= "INSERT INTO notes (id_etudiant, id_matiere, notes)
        SELECT e.id_etudiant, m.id_matiere, ino.note
        FROM import_note ino
        JOIN etudiant e ON e.etu = ino.numETU 
            AND e.nom = ino.nom
            AND e.prenom = ino.prenom
            AND e.genre = ino.genre
            AND e.dtn = ino.datedenaissance
        JOIN promotion pr ON pr.nom_promotion = ino.promotion
        JOIN matiere m ON m.ue = ino.codeMatiere
        JOIN semestre s ON s.nom_semestre = ino.semestre
        GROUP BY e.id_etudiant, m.id_matiere, ino.note";

        $this->db->query($sql);
        $this->db->query('ALTER TABLE notes DISABLE TRIGGER ALL;');

    }
    // INSERT CSV NOTES FIN

    public function insertCsvConfigNote()
    {
        $this->db->query('ALTER TABLE config_note DISABLE TRIGGER ALL;');

        $sql= "INSERT INTO config_note (code, config, valeur)
        SELECT ic.code, ic.config, ic.valeur
        FROM import_config_note ic
        GROUP BY ic.code, ic.config, ic.valeur";
        
        $this->db->query($sql);
        $this->db->query('ALTER TABLE config_note DISABLE TRIGGER ALL;');
    }

    // public function insertCsvCommission()
    // {
    //     $this->db->query('ALTER TABLE location DISABLE TRIGGER ALL;');
    //     $sql="INSERT INTO location (id_bien, id_client, date_debut, duree) 
    //     SELECT b.id_bien, c.id_client, il.date_debut, il.duree
    //     FROM import_location il 
    //     JOIN bien b ON b.reference = il.reference 
    //     JOIN client c ON c.email = il.client 
    //     GROUP BY b.id_bien, il.date_debut, il.duree, c.id_client";

    //     $this->db->query($sql);
    //     $this->db->query('ALTER TABLE location ENABLE TRIGGER ALL;');
    // }

}
