<?php


class UserController extends Main {

    public $layouts = "main";
    public function actionIndex() {
        $select = array(
            'order' => 'id ASC'
        );
        $model = new UserModel($select);
        $usersInfo = $model->getAllRows();

        $this->template->vars('usersInfo', $usersInfo);
        $this->template->view('index');
    }
}