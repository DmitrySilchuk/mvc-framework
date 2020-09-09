<?php



class DefaultController extends Main {

    public $layouts = "main";
    public function actionIndex() {

        $hello = 'Hello Dmitrik';
        $this->template->vars('hello', $hello);
        $this->template->view('index');
    }
}