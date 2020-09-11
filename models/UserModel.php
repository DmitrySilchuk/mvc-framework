<?php


Class UserModel Extends MainModel {

    public $id;
    public $email;
    public $name;
    public $address;
    public $phone;
    public $comment;
    public $department_id;

    public function fieldsTable(){
        return [
            'id' => 'Id',
            'email' => 'Email',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'comment' => 'Comment',
            'department_id' => 'Department_id',
        ];
    }

    public function getTableName()
    {
        return TABLE_PREFIX . 'user';
    }

}