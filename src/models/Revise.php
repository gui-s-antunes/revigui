<?php

class Revise extends Model {

    function getRevise($user_id){
        $date = new Datetime();
        $date->modify('-3 day');
        $date = $date->format('Y-m-d');
        $revises = $this->getResultFromSelectedMultipleTables(
            [
                // 'users' => 'name',
                'assuntos' => 'date',
                'assuntos' => 'name',
                'assuntos' => 'description',
                'sub_areas' => 'name',
                'areas' => 'name'
            ],
            [
                'users',
                'assuntos',
                'sub_areas',
                'areas'
            ],
            [
                'assuntos.sub_areas_id' => 'sub_areas.id',
                'sub_areas.areas_id' => 'areas.id',
                'users.id' => $user_id
            ]
        );
        return $revises;
    }
}