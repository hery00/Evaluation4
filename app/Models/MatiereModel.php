<?php

namespace App\Models;

use CodeIgniter\Model;

class MatiereModel extends Model
{
    protected $table = 'matiere';
    protected $primaryKey = 'id_matiere';
    protected $allowedFields = ['id_semestre','ue','intitule','credits'];

    public function getMatieres()
    { 
             return $this->findAll(); 
    }

    public function getMatieresBySemestre($id_semestre)
    {
        return $this->where('id_semestre', $id_semestre)->findAll();
    }

    
}
   
