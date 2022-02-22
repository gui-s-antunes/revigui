<?php

class Area extends Model {
    protected static $tableName = 'areas';
    protected static $columns = [
        'id',
        'name',
        'users_id'
    ];

    public function getAreas($userId){
        $areas = self::get(['users_id' => $userId]);
        return $areas;
    }

    public static function verifySelectedArea($areaId, $areas){
        $areasID = [];
        foreach($areas as $area){
            array_push($areasID, $area->users_id);
        }

        if(!in_array($areaId, $areasID)){
            throw new ValidationException([], 'Área inválida');
        }
    }

    public function getOneArea($areaId){
        $area = self::getOne(['id' => $areaId]);
        return $area;
    }

    private function validate(){
        if(!$this->name){
            throw new ValidationException([], 'Deve preencher a área');
        }
    }

    private function setUser($userId){
        $this->users_id = $userId;
    }

    public function setNewArea($userId){
        $this->validate();
        $this->setUser($userId);
        $this->insert();
    }
}