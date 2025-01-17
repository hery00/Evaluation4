<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\EtudiantModel;
use App\Models\SemestreModel;
use App\Models\MatiereModel;
use App\Models\NoteModel;
use App\Models\NotesModel;


class AdminController extends BaseController
{

    public function log()
    {
            return view('Pages/login');
    }

    public function dashboard()
    {
        $etudiantmodel = new EtudiantModel();
        $semestremodel = new SemestreModel();
        $notemodel = new NoteModel();
        
        $data['nb_etudiant'] = $etudiantmodel->countAllEtudiants();
        $semestres = $semestremodel->getSemestres();
        $etudiants = $etudiantmodel->getAllEtudiant();

        $nb_admis = 0;
        $nb_ajournee = 0;

        foreach ($etudiants as $etudiant) {
            $allSemestersPassed = true;

            foreach ($semestres as $semestre) {
                $id_semestre = $semestre['id_semestre'];
                $notes = $notemodel->getNoteBySemesterByEtu($id_semestre, $etudiant['etu']);
                $moyenne = $notemodel->getMoyenne($notes, $id_semestre);

                if ($moyenne < 10) {
                    $allSemestersPassed = false;
                    break; // Si la moyenne d'un semestre est inférieure à 10, il n'est pas nécessaire de vérifier davantage
                }
            }

            if ($allSemestersPassed) {
                $nb_admis++;
            } else {
                $nb_ajournee++;
            }
        }

        $data['nb_admis'] = $nb_admis;
        $data['nb_ajournee'] = $nb_ajournee;

        $content = view('Pages/dashboard', $data);
        $layout_data = [
            'content' => $content
        ];

        return view('LayoutAdmin/layout', $layout_data);
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
            if ($user['mdp'] === $passe)
            {
                $session = session();
                $session->set('id_user', $user['id_admin']);
                $session->set('nom', $user['nom']);
                $session->set('login', $user['login']);
                $session->set('statut', $user['statut']);

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
    $session = session();
    $user_statut = $session->get('statut');
    $session_etu = $session->get('etu');
    $noteModel = new NoteModel();
    $etudiantModel = new EtudiantModel();
    $semestreModel = new SemestreModel();
    
    $data['semestres'] = $semestreModel->getSemestres();
    $etu = $this->request->getGet('etu');
    
    if ($user_statut == 1) {
        $data['etudiant'] = $etudiantModel->getEtudiantByEtu($etu);
    } elseif ($user_statut == 2) {
        $data['etudiant'] = $etudiantModel->getEtudiantByEtu($session_etu);
    }

    $data['notes'] = [];
    $data['moyenne'] = [];
    
    foreach ($data['semestres'] as $semestre) {
        $id_semestre = $semestre['id_semestre']; 
        $notes = $noteModel->getNoteBySemesterByEtu($id_semestre,  $data['etudiant']['etu']);
        $data['moyenne'][$id_semestre] = $noteModel->getMoyenne($notes, $id_semestre);
    }
    
    $content = view('Pages/listeSemestre', $data);

    $layout_data = [
        'content' => $content
    ];
    
    if ($user_statut == 1) {
        return view('LayoutAdmin/layout', $layout_data);
    } elseif ($user_statut) {
        return view('LayoutEtudiant/layout', $layout_data);
    }
}

    public function listeMatiereBySemestre($id_semestre)
    {
        $matiereModel = new MatiereModel();
        $data['matieres'] = $matiereModel->getMatieresBySemestre($id_semestre);

        $semestreModel = new SemestreModel();
        $data['semestre'] = $semestreModel->find($id_semestre);

        return view('Pages/', $data);
    }

    public function addNoteForm()
    {
        
        $matiereModel = new MatiereModel();
        $data['matieres'] = $matiereModel->getMatieres();
        $content =  view('Pages/formulaireNote', $data);

        $layout_data = [
            'content' => $content
        ];

        return view('LayoutAdmin/layout', $layout_data);

    }


    public function addNote()
    {
        
        $etu = $this->request->getPost('etu');
        $id_matiere = $this->request->getPost('id_matiere');
        $notes = $this->request->getPost('notes');
        $session = $this->request->getPost('session');

        $etudiantModel = new EtudiantModel();
        $etudiant = $etudiantModel->getEtudiantByEtu($etu);

        if ($etudiant) {
            $id_etudiant = $etudiant['id_etudiant'];

            $noteModel = new NotesModel();
            $noteData = [
                'id_etudiant' => $id_etudiant,
                'id_matiere' => $id_matiere,
                'notes' => $notes,
                'session' => $session,
            ];


        $noteModel = new NotesModel();
        if ($noteModel->insert($noteData)) {
            return redirect()->to('admin/formulairenote')->with('success', 'Note ajoutée avec succès.');
        } else {
            return redirect()->to('admin/formulairenote')->with('error', 'Erreur lors de l\'ajout de la note.');
        }
    } else {
        return redirect()->to('admin/formulairenote')->with('error', 'ÉTUDIANT introuvable');
    }
}
}
