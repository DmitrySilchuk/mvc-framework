<?php

class DepartmentController extends Main {

    public $layouts = "main";
    public function actionIndex() {

        $departmentModel = new DepartmentModel([
            'order' => 'id ASC'
        ]);
        $departments = $departmentModel->getAllRows();

        $this->template->vars('departments', makeIndexedArrayById($departments));
        $this->template->view('index');
    }
}
