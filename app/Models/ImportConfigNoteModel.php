<?php

namespace App\Models;

use CodeIgniter\Model;

class ImportConfigNoteModel extends Model
{
    protected $table = 'import_config_note'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'code',
        'config',
        'valeur'
    ];

    // Optionnel : Si vous avez des colonnes de création et de mise à jour automatiques
    protected $useTimestamps = false;
    
    // Si vous avez des colonnes created_at et updated_at, définissez-les ici
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';

    /**
     * Insert data from CSV.
     *
     * @param string $etape_rang
     * @param float $numero_dossard
     * @param int $nom
     * @param int $genre
     * @param string $date_naissance
     * @param string $equipe
     * @return bool
     */
    public function insertCsvData($code, $config, $valeur)
    {
        $sql = "INSERT INTO import_config_note VALUES ('%s','%s','%d')";
        $sql = sprintf($sql,$code, $config, $valeur);
        echo $sql;
        $this->db->query($sql);

    }
}
