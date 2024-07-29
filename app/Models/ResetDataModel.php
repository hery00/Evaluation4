<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ResetDataModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function resetData()
    {
        try {
            $db = \Config\Database::connect($this->DBGroup);
            
            $tables = [
                'etudiant', 
                'notes',   
                'promotion',
                'import_note',
                'import_config_note',
                'config_note',
            ];

            $db->query('SET CONSTRAINTS ALL DEFERRED');

        foreach ($tables as $table) {
            $db->query("TRUNCATE TABLE $table RESTART IDENTITY CASCADE");
        }

            return "Les données ont été réinitialisées avec succès.";
        } catch (\Exception $e) {
            return "Une erreur s'est produite : " . $e->getMessage();
        }
    }
}
?>

