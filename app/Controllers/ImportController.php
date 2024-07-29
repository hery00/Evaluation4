<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ImportModel;
use App\Models\ImportNoteModel;
use App\Models\ImportConfigNoteModel;
use CodeIgniter\Files\File;

class ImportController extends BaseController
{
    public function index(): string
    {
        $data = [
            'content' => view('Pages/Import')
        ];
        return view('LayoutAdmin/layout',$data);
    }

    public function importcsv()
    {
        helper(['form', 'url']);
        $importModel = new ImportModel();
        
        $file = $this->request->getFile('config_note');
        $cheminTemporaire = $file->getTempName();
        
        $file2 = $this->request->getFile('note');
        $cheminTemporaire2 = $file2->getTempName();

        $tab1 = $importModel -> import_csv($cheminTemporaire);
        $tab2 = $importModel -> import_csv($cheminTemporaire2);


        for ($i = 1; $i < count($tab1); $i++) 
        {
            $ConfigNote = new ImportConfigNoteModel();

            $code = $tab1[$i][0];
            $config = $tab1[$i][1];
            $valeur = $tab1[$i][2];

            $ConfigNote -> insertCsvData($code, $config, $valeur); 
        }

        for ($i = 1; $i < count($tab2); $i++) 
        {
            $NoteModel = new ImportNoteModel();

            $numETU = $tab2[$i][0];
            $nom = $tab2[$i][1];
            $prenom = $tab2[$i][2];
            $genre = $tab2[$i][3];
            $datedenaissance = $tab2[$i][4];
            $promotion = $tab2[$i][5];
            $codeMatiere = $tab2[$i][6];
            $semestre = $tab2[$i][7];
            $note = $this->nettoyer_note($tab2[$i][8]);

            $NoteModel -> insertCsvData($numETU, $nom, $prenom, $genre, $datedenaissance, $promotion, $codeMatiere, $semestre, $note);
        }

        $importModel->insertCsvConfigNote();

        $importModel->insertCsvPromotion();
        $importModel->insertCsvEtudiant();
        $importModel->insertCsvNotes();


        return redirect()->to('admin/import');
    }

    public function nettoyer_note($note)
    {
        $note = trim($note); // Nettoie les espaces
        if (strpos($note, '%') !== false) {
            $note = str_replace('%', '', $note); // Enlève le caractère '%'
        }
        $note = str_replace(',', '.', $note); // Remplace la virgule par un point si nécessaire
        return (float)$note;
    }

}
