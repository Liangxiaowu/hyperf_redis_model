<?php

namespace Rmodel;

use Hyperf\Utils\ApplicationContext;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Rmodel\Model\CommonAttribute;
use Rmodel\Model\RedisModel;

abstract class Rmodel
{
    use RedisModel, CommonAttribute;

    protected $table;
    protected $redis;

    public function __construct(...$params)
    {
        $table = $this->header();
        if($params){

            $p = implode("_", $params);

            $table .= "_".$p;
        }

        // key
        $this->table = $table;

        if(is_null($this->redis)){
            $container = ApplicationContext::getContainer();
            $this->redis = $container ->get(\Redis::class);
        }

//        var_dump("入口：".$this->table);

    }

    public function __call($method, $arguments)
    {
        if($method == "table") return $this ->setTable($arguments);

        $method = "rmodel".$method;
        return $this->$method($arguments);
    }

    public static function __callStatic($method, $arguments)
    {
        if($method == "table") return (new static) ->setTable($arguments);

        $method = "rmodel".$method;
        return (new static) ->$method($arguments);
    }


    /**
     * 获取文件key头
     * @return string
     */
    public function header(){
        if(!empty($this->table)){
            return $this->table;
        }

        // 获取当前model名称
        $class = get_class($this);
        $model = end(explode("\\", $class));

        // 在小写字母和大写字母之间加上连接符号
        $keyHeader = strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $model));


        return $keyHeader;

    }




}