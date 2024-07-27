<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtudiantModel;

class EtudiantController extends BaseController
{


    public function log()
    {
        return view('Pages/loginetudiant');
    }

    public function loginEtudiant()
    {
        $model = new EtudiantModel();
        $etu = $this->request->getPost('etu');
        $etudiant = $model->getEtudiantByEtu($etu);

        if ($etudiant) {   
            $session = session();
            $session->set('user', $etudiant);
            return redirect()->to('/etudiant/listesemestre');
        } 
        else {
            return redirect()->to('/etudiant')->with('error', 'Votre numero ITU est incorrecte!');
        }
    }



//     public function testGetChiffreAffaire()
// {
  
//     $locationModel = new LocationModel();
//     $Model = new LocationDetailModel();
//     $difference = $locationModel->getAllLocationIDs();

//     echo '<pre>';
//     print_r($difference);
//     echo '</pre>';
//     $Model->genererdetailslocations($difference);
// }

    public function logout()
    {
        // Déconnectez l'administrateur en supprimant sa session
        $session = session();
        $session->remove('proprietaire_id');
        return redirect()->to('/proprio');
    }


}