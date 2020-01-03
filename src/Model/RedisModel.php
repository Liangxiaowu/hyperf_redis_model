<?php


namespace Rmodel\Model;



trait RedisModel
{

    private $expire;
    private function rmodelset($params){
        return $this->redis->set($this ->table, $params[0]);
    }

    private function rmodelget(){
        return $this->redis->get($this ->table);
    }

    private function rmodelhSet($params){
        return $this->redis->hSet($this ->table, $params[0], $params[1]);
    }

    private function rmodelhGet($params){

        return $this->redis ->hGet($this->table, $params[0]);
    }

    private function rmodelexpire($params){

        $this->expire = $params[0]?:60;
        return $this;
    }

    public function __destruct(){
        if(!empty($this->expire)){
            $this->redis ->expire($this->table, $this->expire);
            $this->expire = 0;
        }
    }
}