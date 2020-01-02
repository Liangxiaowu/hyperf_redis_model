<?php


namespace Rmodel\Model;



trait RedisModel
{

    private $expire;
    public function set($value){
        return $this->redis->set($this ->table, $value);
    }

    public function get(){
        return $this->redis->get($this ->table);
    }

    public function hSet($key){
        return $this->redis->get($this ->table, $key);
    }

    public function hGet($key){
        return $this->redis ->hGet($this->table, $key);
    }

    public function expire($tll = 60){
        $this->expire = $tll;
        return $this;
    }

    public function __destruct(){
        if(!empty($this->expire)){
            $this->redis ->expire($this->table, $this->expire);
        }
    }
}