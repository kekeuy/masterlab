<?php

namespace main\app\model\user;

use main\app\model\CacheModel;

/**
 *  与用户 1:1 关系的模型基类
 */
class BaseUserItemModel extends CacheModel
{
    public $prefix = '';

    public $table = '';

    public $fields = '*';

    public $uid = '';

    const   DATA_KEY = '';

    /**
     * 用于实现单例模式
     * @var self
     */
    protected static $instance;


    public function __construct($uid = '', $persistent = false)
    {
        parent::__construct($uid, $persistent);
        $this->uid = $uid;
    }

    /**
     * 创建一个自身的单例对象
     * @param string $uid
     * @param bool $persistent
     * @throws \PDOException
     * @return self
     */
    public static function getInstance($uid = '', $persistent = false)
    {
        $index = $uid . strval(intval($persistent));
        if (!isset(self::$instance[$index]) || !is_object(self::$instance[$index])) {
            self::$instance[$index] = new self($uid, $persistent);
        }
        return self::$instance[$index];
    }

    public function getItemByUid($uid)
    {
        return $this->getRow('*', ['uid' => $uid]);
    }

    public function insertItem($uid, $info)
    {
        $info['uid'] = $uid;
        return $this->insert($info);
    }

    public function updateItemByUid($uid, $info)
    {
        $conditions['uid'] = $uid;
        return $this->update($info, $conditions);
    }

    public function deleteByUid($uid)
    {
        $conditions = [];
        $conditions['uid'] = $uid;
        return $this->delete($conditions);
    }

}
