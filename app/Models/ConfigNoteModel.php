<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigNoteModel extends Model
{
    protected $table = 'config_note';
    protected $primaryKey = 'id_conf';
    protected $allowedFields = ['code', 'config', 'valeur'];


    public function getConfigNote($code)
    {
        $result = $this->where('code', $code)->first(); 
        return $result ? $result['valeur'] : null; 
    }
}
