<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id_note';
    protected $allowedFields = ['id_etudiant', 'id_matiere', 'notes', 'session'];

    public function insertNote($data)
    {
        return $this->insert($data);
    }
}
