<?php


class DepartmentModel extends MainModel {

    public $id;
    public $name;

    public function fieldsTable(){
        return [
            'id' => 'Id',
            'name' => 'Name',
        ];
    }

    public function getTableName()
    {
        return TABLE_PREFIX . 'department';
    }

}