<?php
/**
 * Created by PhpStorm.
 * User: 80h4ck@gmail.com
 * Date: 2018/5/28
 * Time: 9:38
 * 公司：源码时代重庆校区
 */

abstract class Model
{
    //声明一个属性用来存创建的Db对象
    protected $db;
    //声明一个属性用来存错误信息
    protected $error;
    //声明一个属性用来存表名
    public $table;
    //声明一个属性用来存表中字段
    public $fields = [];

    public function __construct()
    {
        //1.创建Db对象
        //require_once "FrameWork/Tools/DB.class.php";
        $this->db= DB::getObject($GLOBALS['config']['db']);
        //2.自动得到表名 调用getTable方法
        $this->getTable();
        //3.自动得到表的所有字段名
        $this->getField();
    }

    /**
     * 得到错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 得到所有数据
     * @param string $where where条件
     * @return array|null
     */
    public function all($where = "")
    {
        //通过对象得到类名 模型名  AdminModel
        //2.设置字符串集
        //3.构造SQL语句
        $sql = "select * from {$this->table} $where";
        //4.整理结果集
        $rows = $this->db->fetchAll($sql);
        //5.返回数据
        return $rows;
    }

    /**
     * 得到一条数据返回fetchRow
     * @param $id Id
     * @return array|null
     */
    public function one($id)
    {
        //通过对象得到类名 模型名  AdminModel
        //2.设置字符串集
        //3.构造SQL语句
        $sql = "select * from {$this->table} where id=$id";
        //4.整理结果集
        $rows = $this->db->fetchRow($sql);
        //5.返回数据
        return $rows;
    }

    /**
     * 添加数据
     * @param $data 接收的数据
     * @return bool|mysqli_result
     */
    public function insert($data)
    {
        //1.得到当前表的所有字段
        $sqlColumn = "desc $this->table";
        //2.得到所有字段
        $columns = $this->db->fetchAll($sqlColumn);
        //3.声明一个空数组用来装字段
        $fields = [];
        //4.循环取出字段
        foreach ($columns as $key => $column) {
            if ($column['Key'] === "PRI") {
                //这里是主键
                $fields['pk'] = $column['Field'];
            } else {
                //直接赋值
                $fields[] = $column['Field'];
            }
        }
        //循环$data 判断$data里key 有没有在$fields中
        foreach ($data as $k1 => $v1) {
            //判断提交过来的数据在没在数据库表中的字段中
            if (!in_array($k1, $fields)) {
                //如果不在就删除掉
                unset($data[$k1]);
            }
        }
        //声明一个空字符串用来存SET SQL语句
        $sqlSet = "";
        //循环赋值 拼接SQL语句
        foreach ($data as $k => $v) {
            $sqlSet = $sqlSet . "{$k}='{$v}',";
            var_dump($sqlSet);
        }
        //去掉最后一个,
        $sqlSet = rtrim($sqlSet, ",");
        //1.构造SQL语句
        $sql = "insert into {$this->table} set $sqlSet";
        //2.执行SQL语句 并返回
        return $this->db->query($sql);
    }

    /**
     * 修改数据
     * @param $data 接收数据
     * @return bool|mysqli_result
     */
    public function update($data)
    {
        //取出主键
        $pk = $this->fields['pk'];
        //取出主键的值
        $value = $data[$pk];
        //删除主键
        unset($data[$pk]);
        //循环$data 判断$data里key 有没有在$fields中
        foreach ($data as $k1 => $v1) {
            //如果是主键 删除掉data中的数据
            //判断提交过来的数据在没在数据库表中的字段中
            if (!in_array($k1, $this->fields)) {
                //如果不在就删除掉
                unset($data[$k1]);
            }
        }
        //声明一个空字符串用来存SET SQL语句
        $sqlSet = "";
        //循环赋值 拼接SQL语句
        foreach ($data as $k => $v) {
            $sqlSet = $sqlSet . "{$k}='{$v}',";
        }
        //去掉最后一个,
        $sqlSet = rtrim($sqlSet, ",");
        //1.构造SQL语句
        // $sql = "insert into admin(username,password) values ('{$data['username']}','{$data['password']}')";
        $sql = "update {$this->table} set $sqlSet where {$pk}={$value}";
        //2.执行SQL语句 并返回
        return $this->db->query($sql);
    }

    /**
     * 删除一条数据
     * @param $id id
     * @return bool|mysqli_result
     */
    public function delete($id)
    {
        //2.构造SQL语句
        $sql = "delete from {$this->table} where id=$id";
        //3.执行SQL语句
        $result = $this->db->query($sql);
        //4.返回结果
        return $result;
    }

    /**
     * 得到当前模型对应的表名
     */
    private function getTable()
    {
        //1.通过对象得到类名  MyAdminModel
        $className = get_class($this);
        //2.去掉右边的Model  MyAdmin
        $className = str_replace("Model", "", $className);
        //3.驼身转成下划线 Model转表名 并小写  MyAdmin====>my_admin
        $this->table = PublicTool::toUnderline($className);
    }

    /**
     * 得到表中所有字段
     */
    public function getField()
    {
        //1.得到当前表的所有字段
        $sqlColumn = "desc $this->table";//'desc admin'
//        var_dump($sqlColumn);exit;
        //2.得到所有字段
        $columns = $this->db->fetchAll($sqlColumn);//
        //3.声明一个空数组用来装字段===》声明一个属性fields来存字段
        //4.循环取出字段
        foreach ($columns as $key => $column) {
            if ($column['Key'] === "PRI") {
                //这里是主键
                $this->fields['pk'] = $column['Field'];
            } else {
                //不是主键直接赋值
                $this->fields[] = $column['Field'];
            }
        }
    }

    /**
     * 添加和修改
     * @param $data接收的值
     */
    public function save($data)
    {
        //判断$data 中有没有主键
        //1.取出主键
        $pk = $this->fields['pk'];
        //2.取出data中所的key
        $keys = array_keys($data);
        //3.判断主键在不在$keys中
        if (in_array($pk, $keys)) {
            //修改
            $this->update($data);
        } else {
            //添加
            $this->insert($data);
        }
        //如果有主键 则调用 update
        //否则调用 insert
    }
}