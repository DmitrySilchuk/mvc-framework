<?php


class UserController extends Main {

    public $layouts = "main";
    public function actionIndex() {

        $userModel = new UserModel([
            'order' => 'id ASC'
        ]);
        $usersInfo = $userModel->getAllRows();

        $departmentModel = new DepartmentModel([
            'order' => 'id ASC'
        ]);
        $departments = $departmentModel->getAllRows();

        $this->template->vars('departments', makeIndexedArrayById($departments));
        $this->template->vars('usersInfo', $usersInfo);
        $this->template->view('index');
    }
}