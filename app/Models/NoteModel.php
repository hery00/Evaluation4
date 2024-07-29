<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ConfigNoteModel;


class NoteModel extends Model
{
    protected $table = 'v_notes_details';
    protected $allowedFields = [
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
        $config = new ConfigNoteModel();
    
        $allNotes = $this->where('id_semestre', $id_semestre)
                        ->where('etu', $etu)
                        ->findAll();
    
        // Initialize arrays for different conditions
        $inf10 = [];
        $inf6 = [];
    
        $allNotes = $this->filterMaxNotesBySubject($allNotes);
        $filteredNotes = $this->filterMaxOptionalNotes($allNotes);
    
        $max_componsee = $config->getConfigNote('CONF2');
        $limite_ajournee = $config->getConfigNote('CONF1');
    
        // Populate arrays based on note conditions
        foreach ($filteredNotes as $n) {
            if ($n['notes'] < 10) {
                $inf10[] = $n;
                if ($n['notes'] < $limite_ajournee) {
                    $inf6[] = $n;
                }
            }
        }
    
        $nb_inf10 = count($inf10);
        $nb_inf6 = count($inf6);
    
        echo "<pre>";
        echo "Inf10 Count: " . $nb_inf10 . "\n";
        echo "Inf6 Count: " . $nb_inf6 . "\n";
        echo "</pre>";
    
        foreach ($filteredNotes as &$n)
        {
            $noteValue = $n['notes'];
    
            if ($noteValue < $limite_ajournee) {
                $n['resultat'] = 'Ajournée';
                $n['credits'] = 0;
            } elseif ($noteValue >= $limite_ajournee && $noteValue < 10) {
                if ($nb_inf6 > 0) {
                    $n['resultat'] = 'Ajournée';
                    $n['credits'] = 0;
                } else {
                    if ($nb_inf10 <= $max_componsee) {
                        $n['resultat'] = 'Compensée';
                    } else {
                        $n['resultat'] = 'Ajournée';
                        $n['credits'] = 0;
                    }
                }
            }
            else {
                if ($noteValue >= 16) {
                    $n['resultat'] = 'Excellent';
                } elseif ($noteValue >= 14) {
                    $n['resultat'] = 'Bien';
                } elseif ($noteValue >= 12) {
                    $n['resultat'] = 'Assez Bien';
                } elseif ($noteValue >= 10) {
                    $n['resultat'] = 'Passable';
                }
            }
        }
    
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
    $allGroupSubjects = [];

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

        // Collect all subjects from groups for later use
        $allGroupSubjects = array_merge($allGroupSubjects, $group);
    }

    foreach ($notes as $note) {
        if (!in_array($note['ue'], $allGroupSubjects)) {
            $groupedNotes[] = $note;
        }
    }

    return $groupedNotes;
}

    public function getOptionalGroups()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('groupes_matieres_optionelles');
        $builder->select('groups_options.nom_groupe, groupes_matieres_optionelles.ue');
        $builder->join('groups_options', 'groups_options.id_groupe = groupes_matieres_optionelles.id_groupe');
        $query = $builder->get();

        $groups = [];
        foreach ($query->getResult() as $row) {
            $groups[$row->nom_groupe][] = $row->ue;
        }

        return $groups;
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
