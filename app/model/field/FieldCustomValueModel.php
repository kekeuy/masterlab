<?php

namespace main\app\model\field;

use main\app\model\CacheModel;

/**
 *  自定义字段的数据表模型
 *
 */
class FieldCustomValueModel extends CacheModel
{
    public $prefix = 'field_';

    public $table = 'custom_value';

    const   DATA_KEY = 'field_custom_value/';

    public $fields = '*';

    /**
     * 用于实现单例模式
     * @var self
     */
    protected static $instance;

    /**
     * 创建一个自身的单例对象
     * @param bool $persistent
     * @throws \PDOException
     * @return self
     */
    public static function getInstance($persistent = false)
    {
        $index = intval($persistent);
        if (!isset(self::$instance[$index]) || !is_object(self::$instance[$index])) {
            self::$instance[$index] = new self($persistent);
        }
        return self::$instance[$index];
    }
}
