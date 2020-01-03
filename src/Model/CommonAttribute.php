<?php


namespace Rmodel\Model;


trait CommonAttribute
{
    private function setTable($params){
        if(!empty($params)){
            $table = $this->table;
            if($params){

                $p = implode("_", $params);

                $table .= "_".$p;
            }
            $this->table = $table;
        }
        return $this;
    }
}