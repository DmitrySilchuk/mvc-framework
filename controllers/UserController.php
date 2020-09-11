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

    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['name'])) {
                $userModel = new UserModel();
                $userModel->email = $_POST['email'];
                $userModel->name = $_POST['name'];
                $userModel->address = $_POST['address'];
                $userModel->phone = $_POST['phone'];
                $userModel->comment = $_POST['comment'];
                $userModel->department_id = (int)$_POST['department'];

                if ($userModel->save()) {
                    header('Location: /user/view/' . $userModel->id);
                }
                else {
                    die ('Nothing has been saved');
                }
            }
            else {
                die('Nothing has been saved');
            }
        }
        else {
            $departmentModel = new DepartmentModel([
                'order' => 'id ASC',
            ]);
            $departments = $departmentModel->getAllRows();

            $this->template->vars('departments', makeIndexedArrayById($departments));
            $this->template->view('add');
        }
    }

    public function actionDelete($args)
    {
        if (!empty($args[0])) {
            $id = (int)$args[0];

            $userModel = new UserModel([
                'where' => "id = $id",
            ]);

            if ($userModel->fetchOne()) {
                $userModel->deleteRow();
                header('Location: /user/');
            } else {
                die('404 Not Found');
            }
        } else {
            die('Please pass an ID');
        }
    }

    public function actionView($args)
    {
        if (!empty($args[0])) {
            $id = (int)$args[0];

            $userModel = new UserModel([
                'where' => "id = $id",
            ]);

            if ($userModel->fetchOne()) {
                $departmentModel = new DepartmentModel([
                'order' => "id = $id",
                ]);
                $departments = $departmentModel->getAllRows();

                $this->template->vars('departments', makeIndexedArrayById($departments));
                $this->template->vars('user', $userModel);
                $this->template->view('view');
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

            $userModel = new UserModel([
                'where' => "id = $id",
            ]);

            if ($userModel->fetchOne()) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!empty($_POST['email']) && !empty($_POST['name'])) {
                        $userModel->email = $_POST['email'];
                        $userModel->name = $_POST['name'];
                        $userModel->address = $_POST['address'];
                        $userModel->phone = $_POST['phone'];
                        $userModel->comment = $_POST['comment'];
                        $userModel->department_id = (int)$_POST['department'];

                        if ($userModel->update()) {
                            header('Location: /user/view/' . $userModel->id);
                        }
                        else {
                            die ('Nothing has been update');
                        }
                    }
                    else {
                        die('Email or name are empty');
                    }
                } else {
                    $departmentModel = new DepartmentModel([
                        'order' => 'id ASC',
                    ]);
                    $departments = $departmentModel->getAllRows();

                    $this->template->vars('departments', makeIndexedArrayById($departments));
                    $this->template->vars('user', $userModel);
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