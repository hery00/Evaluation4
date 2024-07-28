<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'v_notes_details';
    protected $primaryKey = 'id_note';
    protected $allowedFields = [
        'id_note',
        'id_etudiant',
        'etu',
        'nom_etudiant',
        'prenom_etudiant',
        'id_matiere',
        'ue',
        'intitule_matiere',
        'credits',
        'id_semestre',
        'nom_semestre',
        'nom_promotion',
        'notes',
        'session'
    ];

    public function getNoteBySemesterByEtu($id_semestre, $etu)
    {
        $allNotes = $this->where('id_semestre', $id_semestre)
                        ->where('etu', $etu)
                        ->findAll();

        // Initialize arrays for different conditions
        $inf10 = [];
        $sup6 = [];
        $inf6 = [];

        // Populate arrays based on note conditions
        foreach ($allNotes as $n) {
            if ($n['notes'] < 10) {
                $inf10[] = $n;
                if ($n['notes'] >= 6) {
                    $sup6[] = $n;
                }
                if ($n['notes'] < 6) {
                    $inf6[] = $n;
                }
            }
        }

        $nb_inf10 = count($inf10);
        $nb_sup6 = count($sup6);
        $nb_inf6 = count($inf6);

        // Apply conditions to each note
        foreach ($allNotes as &$n) {
            $noteValue = $n['notes'];

            if($nb_inf10<=2)
            {
                if($nb_inf6==0)
                {
                    if($noteValue<10)
                    {
                        $n['resultat'] = 'Compensée';
                    }
                    else{
                        $n['resultat'] = $this->classifyNote($noteValue);
                    }  
                }

                elseif($nb_inf6>0)
                {
                    if($noteValue<10)
                    {
                        $n['resultat'] = 'Ajournée';
                        $n['credits'] = 0;
                    }
                    else{
                        $n['resultat'] = $this->classifyNote($noteValue);
                    }  
                } 
            }
            elseif($nb_inf10>2)
            {
                if($noteValue<10)
                {
                    $n['resultat'] = 'Ajournée';
                    $n['credits'] = 0;
                }
                else {
                    $n['resultat'] = $this->classifyNote($noteValue);
                }
                
            }
             else {
                $n['resultat'] = $this->classifyNote($noteValue);
            }
        }
        
        return $allNotes;
    }

    private function classifyNote($noteValue)
    {
        if ($noteValue >= 16) {
            return 'Très bien';
        } elseif ($noteValue >= 14) {
            return 'Bien';
        } elseif ($noteValue >= 13) {
            return 'Assez bien';
        } elseif ($noteValue >= 10) {
            return 'Passable';
        } else {
            return 'Ajournée';
        }
    }
}
