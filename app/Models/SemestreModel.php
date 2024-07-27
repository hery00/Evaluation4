<?php

namespace App\Models;

use CodeIgniter\Model;

class SemestreModel extends Model
{
    protected $table = 'semestre';
    protected $primaryKey = 'id_semestre';
    protected $allowedFields = ['nom_semestre'];

    public function getSemestres()
    {
        return $this->findAll();
    }
}
