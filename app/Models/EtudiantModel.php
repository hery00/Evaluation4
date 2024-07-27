<?php

namespace App\Models;

use CodeIgniter\Model;

class EtudiantModel extends Model
{
    protected $table = 'v_etudiant_promotion';
    protected $primaryKey = 'id_etudiant';
    protected $allowedFields = ['id_prom', 'etu', 'nom', 'prenom', 'dtn','nom_promotion'];
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


    public function getEtudiantByProm($prom)
    {
        $sql = "SELECT * FROM v_etudiant_promotion WHERE nom_promotion ILIKE ?";
        return $this->db->query($sql, ["%$prom%"])->getResultArray();
    }
    
    public function getEtudiantByName($name)
    {
        $sql = "SELECT * FROM v_etudiant_promotion
                WHERE nom ILIKE ? 
                OR prenom ILIKE ?";
        return $this->db->query($sql, ["%$name%", "%$name%"])->getResultArray();
    }

    public function getEtudiantByPromAndName($prom, $name)
{
    $prom = '%'. $prom .'%';
    $name = '%'. $name .'%';

    $sql = "SELECT * FROM v_etudiant_promotion
            WHERE nom_promotion ILIKE ? 
            AND (nom ILIKE ? OR prenom ILIKE ?)";
    return $this->db->query($sql, [$prom, $name, $name])->getResultArray();
}

    
    
    

}
