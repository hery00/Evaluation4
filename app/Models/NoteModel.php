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
    $inf6 = [];

    // Populate arrays based on note conditions
    foreach ($allNotes as $n) {
        // Initialize the 'resultat' key
        
        
        if ($n['notes'] < 10) {
            $inf10[] = $n;
            if ($n['notes'] < 6) {
                $inf6[] = $n;
            }
        }
    }

    $nb_inf10 = count($inf10);
    $nb_inf6 = count($inf6);

    

    // Apply conditions to each note
    foreach ($allNotes as &$n) {
        $noteValue = $n['notes'];

        if ($nb_inf10 <= 2) {
            if ($nb_inf6 == 0) {
                if ($noteValue < 10) {
                    $n['resultat'] = 'Compensée';
                } else {
                    $n['resultat'] = $this->classifyNote($noteValue);
                }
            } elseif ($nb_inf6 > 0) {
                if ($noteValue < 10) {
                    $n['resultat'] = 'Ajournée';
                    $n['credits'] = 0;
                } else {
                    $n['resultat'] = $this->classifyNote($noteValue);
                }
            }
        } elseif ($nb_inf10 > 2) {
            if ($noteValue < 10) {
                $n['resultat'] = 'Ajournée';
                $n['credits'] = 0;
            } else {
                $n['resultat'] = $this->classifyNote($noteValue);
            }
        } else {
            $n['resultat'] = $this->classifyNote($noteValue);
        }
    }
$allNotes = $this->filterMaxNotesBySubject($allNotes);
    $filteredNotes = $this->filterMaxOptionalNotes($allNotes);
    return $filteredNotes;
}

    private function filterMaxNotesBySubject($notes)
    {
        $maxNotes = [];
        foreach ($notes as $note) {
            $key = $note['id_matiere'];
            if (!isset($maxNotes[$key]) || $note['notes'] > $maxNotes[$key]['notes']) {
                $maxNotes[$key] = $note;
            }
        }
        return array_values($maxNotes);
    }

    private function filterMaxOptionalNotes($notes)
    {
        $groupedNotes = [];
        $groups = $this->getOptionalGroups();

        foreach ($groups as $group) {
            $optionalNotes = [];
            foreach ($notes as $note) {
                if (in_array($note['ue'], $group)) {
                    $optionalNotes[] = $note;
                }
            }

            if (!empty($optionalNotes)) {
                $maxNote = max(array_column($optionalNotes, 'notes'));
                foreach ($optionalNotes as $note) {
                    if ($note['notes'] == $maxNote) {
                        $groupedNotes[] = $note;
                        break; 
                    }
                }
            }
        }
        
        foreach ($notes as $note) {
            if (!in_array($note['ue'], array_merge(...$groups))) {
                $groupedNotes[] = $note;
            }
        }

        return $groupedNotes;
    }

    private function getOptionalGroups()
    {
        return [
            ['INF204', 'INF205', 'INF206'],
            ['MTH204', 'MTH205', 'MTH206'],
            ['INF302', 'INF303']
        ];
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

    public function getSumCredits($allNotes)
    {
        $sumCredits = 0;
        foreach ($allNotes as $note) {
            if (isset($note['resultat']) && $note['resultat'] !== 'Ajournée' && isset($note['credits'])) {
                $sumCredits += $note['credits'];
            }
        }

        return $sumCredits;
    }

    public function getMoyenne($allNotes, $id_semestre)
{
    $model = new MatiereModel();
    $totalNotesPonderees = 0;
    $totalCredits = 0;
    $matieres = $model->getMatieresBySemestre($id_semestre); // Obtenez les matières directement

    foreach ($allNotes as $note) {
        if (!isset($note['id_matiere']) || !isset($note['notes']) || !isset($note['credits'])) {
            continue; // Ignorez les notes sans 'id_matiere', 'notes', ou 'credits'
        }

        foreach ($matieres as $matiere) {
            if ($note['id_matiere'] == $matiere['id_matiere']) {
                $pondere = $note['notes'] * $matiere['credits'];
                $totalNotesPonderees += $pondere;
                $totalCredits += $matiere['credits'];
            }
        }
    }

    $moyenne = ($totalCredits > 0) ? $totalNotesPonderees / $totalCredits : 0;

    return round($moyenne, 2);
}

}
