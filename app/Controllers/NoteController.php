<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtudiantModel;
use App\Models\NoteModel;


class NoteController extends BaseController
{
    public function getNoteSemestre()
    {
        $session = session();
        $user_statut =  $session->get('statut');
        $session_etu = $session ->get('etu');

        $id_semestre= $this->request->getGet('id_semestre');
         if($user_statut == 1)
        {
            $etu= $this->request->getGet('etu');
        }

        elseif($user_statut == 2)
        {
            $etu = $session_etu;
        }
        
        $etudiant_model = new EtudiantModel();
        $data['semestre'] = $id_semestre;
        $data['etudiant'] = $etudiant_model->getEtudiantByEtu($etu);
        $model = new NoteModel();
        $data['notes'] = $model->getNoteBySemesterByEtu($id_semestre,$etu);
        $data['sumCredits'] = $model->getSumCredits($data['notes']);
        $data['moyenne'] = $model->getMoyenne($data['notes']);


        if ($data['moyenne'] < 10) {
            $data['Color'] = '#fd3022';
            $data['mention'] = "Ajournée";
        } elseif ($data['moyenne'] >= 10 && $data['moyenne']< 15) {
            $data['Color'] = '#283a97';
            $data['mention'] = "Bien"; 
        } elseif ($data['moyenne'] >= 15) {
            $data['Color'] = '#b2d235'; 
            $data['mention'] = "Très Bien";
        }
        $content = view('Pages/noteetudiantparsemestre', $data);
        $layout_data = [
            'content' => $content
        ];
    
        if($user_statut == 1)
        {
            return view('LayoutAdmin/layout', $layout_data);
        }
        elseif($user_statut)
        {
            return view('LayoutEtudiant/layout', $layout_data);
        }
    }
}
