<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\EtudiantModel;
use App\Models\SemestreModel;


class AdminController extends BaseController
{

    public function log()
    {
            return view('Pages/login');
    }
    

    public function inscrir()
    {
        return view('Pages/inscription');
    }


    public function process()
    {
        $userModel = new AdminModel();
        $email = $this->request->getPost('email');
        $passe = $this->request->getPost('passe');
        
        // Vérifier si l'utilisateur avec cet email existe
        $user = $userModel->where('login', $email)->first();
    
        if ($user)
        {
            if ($user['passe'] === $passe)
            {
                $session = session();
                $session->set('id_user', $user['id_admin']);
                $session->set('nom', $user['nom']);
                $session->set('login', $user['login']);

                return redirect()->to('admin/listetudiant'); 
                // echo "tafiditra";
            } else {
                // Mot de passe incorrect
                return redirect()->to('/')->with('error', 'Mot de passe incorrect.');
            }
        } else {
            // Utilisateur non trouvé avec cet email
            return redirect()->to('/')->with('error', 'E-mail incorrect.');
        }
    }
    
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function listEtudiant()
    {
        $model = new EtudiantModel();
        $prom = $this->request->getGet('prom');
        $name = $this->request->getGet('name');

        if ($prom && $name) {
            $data['etudiants'] = $model->getEtudiantByPromAndName($prom, $name);
        } elseif ($prom) {
            $data['etudiants'] = $model->getEtudiantByProm($prom);
        } elseif ($name) {
            $data['etudiants'] = $model->getEtudiantByName($name);
        } else {
            $data['etudiants'] = $model->getAllEtudiant();
        }

        $content = view('Pages/ListeEtudiant', $data);

        $layout_data = [
            'content' => $content
        ];
    
        return view('LayoutAdmin/layout', $layout_data);
    }
    
    
    public function listesemestre()
    {
        $semestreModel = new SemestreModel();
        $data['semestres'] = $semestreModel->getSemestres();

        return view('Pages/listeSemestre', $data);
    }
}
