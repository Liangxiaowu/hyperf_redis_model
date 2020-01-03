### hyperf - redis的简单封装

#### 安装
    composer require xiaowu/hyperf-redis-model

#### 使用
    继承Rmodel类
    namespace App\Rmodel;
    use Rmodel\Rmodel;
    class CardStock extends Rmodel
    {
        
    }
    
#### 方式
    CardStock::keys("*")            // 查询所有KEY 
    CardStock::get($key)            // 查询key值
    CardStock::set($key, $value)    // 设置key值  
    CardStock::hGet($key);          // 
    CardStock::sGet($key, $value);   
    CardStock::expire(100)->set($key, $value);  // 设置key的过期时间
    ...

#### 地址
    https://packagist.org/packages/xiaowu/hyperf-redis-model
