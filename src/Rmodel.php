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

        $container = ApplicationContext::getContainer();
        $this->redis = $container ->get(\Redis::class);

    }


    public static function __callStatic($name, $arguments)
    {
        switch ($name){
            case "table":
                return (new static) ->setTable($arguments);
            default:
                return (new static) ->$name($arguments);
        }
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