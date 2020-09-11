<?php


Abstract Class MainModel {

    protected $db;
    private $dataResult;

    public function __construct($select = false) {
        // connection database object
        global $dbObject;
        $this->db = $dbObject;

        // processing a request if needed
        $sql = $this->_getSelect($select);
        if($sql) $this->_getResult("SELECT * FROM {$this->getTableName()}" . $sql);
    }

    // get table name
    abstract public function getTableName();
    abstract public function fieldsTable();

    // get all records
    function getAllRows(){
        if(empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    // get one record
    function getOneRow(){
        if(empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    // retrieve one record from the database
    function fetchOne(){
        if(empty($this->dataResult)) return false;
        foreach($this->dataResult[0] as $key => $val){
            $this->$key = $val;
        }
        return true;
    }

    // get record by id
    function getRowById($id){
        try{
            $db = $this->db;
            $stmt = $db->query("SELECT * from {$this->getTableName()} WHERE id = $id");
            $row = $stmt->fetch();
        }catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }

    // save to the database
    public function save() {
        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = [];
        $arrayData = [];
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;
            }
        }
        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);

        try {
            $db = $this->db;
            $stmt = $db->prepare("INSERT INTO {$this->getTableName()} ($forQueryFields) values ($forQueryPlace)");
            $result = $stmt->execute($arrayData);
            $this->id = $db->lastInsertId();
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO {$this->getTableName()} ($forQueryFields) values ($forQueryPlace)'";
            exit();
        }

        return $result;
    }

    // making a database query
    private function _getSelect($select) {
        if(is_array($select)){
            $allQuery = array_keys($select);
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val);
            });

            $querySql = "";
            if(in_array("WHERE", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "WHERE"){
                        $querySql .= " WHERE " . $val;
                    }
                }
            }

            if(in_array("GROUP", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "GROUP"){
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }

            if(in_array("ORDER", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "ORDER"){
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }

            if(in_array("LIMIT", $allQuery)){
                foreach($select as $key => $val){
                    if(strtoupper($key) == "LIMIT"){
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }

            return $querySql;
        }
        return false;
    }

    // executing a database query
    private function _getResult($sql){
        try{
            $db = $this->db;
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        }catch(PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return $rows;
    }

    // remove records from the database conditionally
    public function deleteBySelect($select){
        $sql = $this->_getSelect($select);
        try {
            $db = $this->db;
            $result = $db->exec("DELETE FROM {$this->getTableName()} " . $sql);
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'DELETE FROM {$this->getTableName()} " . $sql . "'";
            exit();
        }
        return $result;
    }

    // remove row from the database
    public function deleteRow(){
        $arrayAllFields = array_keys($this->fieldsTable());
        array_walk($arrayAllFields, function(&$val){
            $val = strtoupper($val);
        });
        if(in_array('ID', $arrayAllFields)){
            try {
                $db = $this->db;
                $result = $db->exec("DELETE FROM {$this->getTableName()} WHERE `id` = $this->id");
                foreach($arrayAllFields as $one){
                    unset($this->$one);
                }
            }catch(PDOException $e){
                echo 'Error : '.$e->getMessage();
                echo '<br/>Error sql : ' . "'DELETE FROM {$this->getTableName()} WHERE `id` = $this->id'";
                exit();
            }
        }else{
            echo "ID table `{$this->getTableName()}` not found!";
            exit;
        }
        return $result;
    }

    // updating the record occurs by ID
    public function update(){
        $arrayAllFields = array_keys($this->fieldsTable());
        $arrayForSet = [];
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                if(strtoupper($field) != 'ID'){
                    $arrayForSet[] = $field . ' = "' . $this->$field . '"';
                }else{
                    $whereID = $this->$field;
                }
            }
        }
        if(empty($arrayForSet)){
            echo "Array data table `{$this->getTableName()}` empty!";
            exit;
        }
        if(empty($whereID)){
            echo "ID table `{$this->getTableName()}` not found!";
            exit;
        }

        $strForSet = implode(', ', $arrayForSet);

        try {
            $db = $this->db;
            $stmt = $db->prepare("UPDATE {$this->getTableName()} SET $strForSet WHERE `id` = $whereID");
            $result = $stmt->execute();
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'UPDATE {$this->getTableName()} SET $strForSet WHERE `id` = $whereID'";
            exit();
        }
        return $result;
    }
}