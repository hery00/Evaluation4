<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table = 'etudiant';
    protected $primaryKey = 'id_etudiant';
    protected $allowedFields = ['id_prom', 'etu', 'nom', 'prenom', 'dtn'];
    protected $useTimestamps = false;

    public function getAllEtudiant()
    {
        return $this->findAll();
    }

    public function getEtudiantByEtu($etu)
    {
        $etudiant = $this->where('etu',$etu)
                        ->get()->getRowArray();
        if(!empty($etudiant))
        {
            return $etudiant;
        }
        return null;
    }

    
    public function getEtudiantByProm($id_prom)
    {
        return $this->where('id_prom', $id_prom)->findAll();
    }


    public function getEtudiantByName($name)
    {
        return $this->like('nom', $name)->orLike('prenom', $name)->findAll();
    }


    public function getEtudiantByPromAndName($id_prom, $name)
    {
        return $this->where('id_prom', $id_prom)
                    ->groupStart()
                    ->like('nom', $name, 'both')
                    ->orLike('prenom', $name, 'both')
                    ->groupEnd()
                    ->findAll();
    }

}
