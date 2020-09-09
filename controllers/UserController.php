<?php


class UserController extends Main {

    public $layouts = "main";
    public function actionIndex() {
        $model = new UserModel();
        $userInfo = $model->getUser();
        $this->template->vars('userInfo', $userInfo);
        $this->template->view('index');
    }
}