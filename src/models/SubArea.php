<?php

class SubArea extends Model {
    protected static $tableName = 'sub_areas';
    protected static $columns = [
        'id',
        'name',
        'areas_id'
    ];

    public function verifySelectedSubArea($areaId, $areas){
        // is the selected area from user?
        $userAreasID = []; // user's valid areas
        foreach($areas as $area){
            array_push($userAreasID, $area->id);
        }

        if(!in_array($areaId, $userAreasID)){
            throw new ValidationException([], 'Área não encontrada');
        }
    }

    public static function getOneSubArea($subAreaId){
        return self::getOne(['id' => $subAreaId]);
    }

    public function getSubAreas($areaId, $areas){
        $this->verifySelectedSubArea($areaId, $areas);
        $subareas = self::get(['areas_id' => $areaId]);
        return $subareas;
    }

    private function validate(){
        if(!$this->name){
            throw new ValidationException([], 'Deve preencher a sub-área');
        }
    }

    private function setArea(){
        $this->areas_id = $this->area;
    }

    public function setNewSubArea($areas){
        $this->verifySelectedSubArea($this->area, $areas);
        $this->validate();
        $this->setArea();
        $this->insert();
    }
}