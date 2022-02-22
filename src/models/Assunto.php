<?php

class Assunto extends Model {
    protected static $tableName = 'assuntos';
    protected static $columns = [
        'id',
        'name',
        'description',
        'date',
        'date_revise',
        'revive_streak',
        'sub_areas_id'
    ];

    public static function getUserAssuntos($userId){
        $assuntos = [  
            'assuntos' => [
                'id'  => 'id', 
                'name' => 'name', 
                'description' => 'description', 
                'date' => 'date', 
                'date_revise' => 'date_revise', 
                'revive_streak' => 'revive_streak', 
                'sub_areas_id' => 'sub_areas_id', 
            ]
        ];
        $tableRelation = [
            'assuntos.sub_areas_id' => 'sub_areas.id',
            'sub_areas.areas_id' => 'areas.id',
            'areas.users_id' => $userId
        ];

        return self::getMultiple($assuntos, ['areas', 'sub_areas', 'assuntos'], $tableRelation);
    }

    private static function verifyIDAssunto($userId, $idAssunto){
        $assuntos = Assunto::getAllAssuntos($userId);
        $validIds = [];
        
        foreach($assuntos as $assunto){
            array_push($validIds, $assunto->id);
            if($assunto->id === $idAssunto) return $assunto;
        }

        if(!in_array($idAssunto, $validIds)){
            throw new ValidationException([], 'Erro ao validar assunto');
        }
    }

    public static function getOneAssunto($idAssunto){
        return self::getOne(['id' => $idAssunto]);
    }

    public static function getAssunto($userId, $idAssunto){
        return Assunto::verifyIDAssunto($userId, $idAssunto);
    }

    private static function getRequestedFields(){
        $areas = ['areas' => ['name' => 'area']];
        $sub_areas = ['sub_areas' => ['name' => 'sub_area']];
        $assuntos = [
            'assuntos' => [
                'id' => 'id',
                'name' => 'assunto',
                'description' => 'description',
                'date_revise' => 'date_revise',
                'is_disabled' => 'is_disabled'
            ]
        ];
        $fields = array_merge($areas, $sub_areas, $assuntos);
        return $fields;
    }

    public static function getAllAssuntos($userId){
        $fields = self::getRequestedFields();
        $tables = ['areas', 'sub_areas', 'assuntos'];
        $tableRelation = [
            'assuntos.sub_areas_id' => 'sub_areas.id',
            'sub_areas.areas_id' => 'areas.id',
            'areas.users_id' => $userId
        ];

        return self::getMultiple($fields, $tables, $tableRelation);
    }

    private function validateAssunto(){
        $errors = [];

        if(!$this->sub_areas_id){
            $errors['sub_area'] = "A subárea deve ser preenchida!";
        }

        if(!$this->name){
            $errors['name'] = 'O nome do assunto precisa ser preenchido!';
        }
        
        if(!$this->description){
            $errors['description'] = "A descrição precisa ser preenchida!";
        }

        if(!$this->date){
            $errors['date'] = "A data de estudo do assunto deve ser preenchido!";
        }

        if(count($errors) > 0){
            throw new ValidationException($errors);
        }
    }

    private function setSpecialFields(){
        $date = DateTime::createFromFormat('Y-m-d', $this->date);
        $date_revise = $date;
        $date_revise->modify('+1 day');
        $this->date_revise = $date_revise->format('Y-m-d');
        $this->revive_streak = 1;
    }

    private function validateSubArea($userSubAreas){
        $userAreasID = [];
        foreach($userSubAreas as $userSubArea){
            array_push($userAreasID, $userSubArea->id);
        }
        if(!in_array($this->sub_areas_id, $userAreasID)){
            throw new ValidationException([], 'Subárea inválida');
        }
    }

    public function setAssunto($userSubAreas){
        $this->validateSubArea($userSubAreas);
        $this->validateAssunto();
        $this->setSpecialFields();
    }

    public function changeSubArea($subAreaId){
        $this->sub_areas_id = $subAreaId;
    }

    public function setNewAssuntoFields($assuntoNew){
        $this->name = $assuntoNew->name;
        $this->description = $assuntoNew->description;
        $this->date = $assuntoNew->date;
    }

    public function update(){
        $this->validateAssunto();
        parent::update();
    }

    public function setNewReviseDate($newReviseDate, $revive_streak){
        $this->date_revise = $newReviseDate;
        $this->revive_streak = $revive_streak;
    }

}