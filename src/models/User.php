<?php

class User extends Model {
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'name',
        'email',
        'password',
        'create_date',
        'is_admin',
        'is_deleted'
    ];

    function setRows(){
        $create_date = new DateTime();
        $array = [
            'create_date' => $create_date->format('Y-m-d'),
            'is_admin' => 0,
            'is_deleted' => 0        
        ];
        $this->loadFromArray($array);
    }

    function insert(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::insert();
    }

    function getRevise(){
        $date = new Datetime();
        $date->modify('-3 day');
        $date = $date->format('Y-m-d');
        $revises = $this->getResultFromSelected(['date' => $date]);
        return $revises;
    }
}