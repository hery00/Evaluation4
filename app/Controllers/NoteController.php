<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NoteModel;


class NoteController extends BaseController
{
    public function getNoteSemestre()
    {
        $id_semestre= $this->request->getGet('id_semestre');
        $etu= $this->request->getGet('etu');
        $model = new NoteModel();
        $data['notes'] = $model->getNoteBySemesterByEtu($id_semestre,$etu);
        $data['sumCredits'] = $model->getSumCredits($data['notes']);
        $data['moyenne'] = $model->getMoyenne($data['notes']);
        $content = view('Pages/noteetudiantparsemestre', $data);
        $layout_data = [
            'content' => $content
        ];
    
        return view('LayoutAdmin/layout', $layout_data);
    }
}
