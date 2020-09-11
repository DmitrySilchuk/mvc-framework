<?php

class DepartmentController extends Main
{

    public $layouts = "main";

    public function actionIndex()
    {

        $departmentModel = new DepartmentModel([
            'order' => 'id ASC'
        ]);
        $departments = $departmentModel->getAllRows();

        $this->template->vars('departments', $departments);
        $this->template->view('index');
    }

    public function actionView($args)
    {
        if (!empty($args[0])) {
            $id = (int)$args[0];

            $departmentModel = new DepartmentModel([
                'where' => "id = $id",
            ]);

            if ($departmentModel->fetchOne()) {
                $this->template->vars('department', $departmentModel);
                $this->template->view('view');
            } else {
                die('404 Not Found');
            }
        } else {
            die('Please pass an ID');
        }
    }

    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['name'])) {
                $departmentModel = new DepartmentModel();
                $departmentModel->name = $_POST['name'];

                if ($departmentModel->save()) {
                    header('Location: /department/view/' . $departmentModel->id);
                } else {
                    die ('Nothing has been saved');
                }
            }
        } else {
            $this->template->view('add');
        }
    }

    public function actionDelete($args)
    {
        if (!empty($args[0])) {
            $id = (int)$args[0];

            $departmentModel = new DepartmentModel([
                'where' => "id = $id",
            ]);

            if ($departmentModel->fetchOne()) {
                $result = $departmentModel->deleteRow();
                header('Location: /department/');
            } else {
                die('404 Not Found');
            }
        } else {
            die('Please pass an ID');
        }
    }

    public function actionUpdate($args)
    {
        if (!empty($args[0])) {
            $id = (int)$args[0];

            $departmentModel = new DepartmentModel([
                'where' => "id = $id",
            ]);

            if ($departmentModel->fetchOne()) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $departmentModel->name = $_POST['name'];

                    if ($departmentModel->update()) {
                        header('Location: /department/view/' . $departmentModel->id);
                    } else {
                        die('Nothing has been update');
                    }
                } else {
                    $this->template->vars('department', $departmentModel);
                    $this->template->view('update');
                }
            } else {
                die('404 Not Found');
            }
        } else {
            die ('Please pass an ID');
        }
    }
}

