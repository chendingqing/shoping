<?php
/**
 * Created by PhpStorm.
 * User: 80h4ck@gmail.com
 * Date: 2018/5/11
 * Time: 10:08
 * 公司：源码时代重庆校区
 */

class Db
{
    private $host = "127.0.0.1";//主机
    private $user = "root";//用户名
    private $password = "root";//密码
    private $database = "myshop";//数据库
    private $port = 3306;//端口
    private $charset = "utf8";//字符集

    //3.声明一个私有的静态属性用来存第2步创建的对象  语义化
    private static $obj = null;

    private $link;//用来存MYSQL连接成功的资源

    //1.私有化 构造方法
    private function __construct($config = [])
    {
        //初始化
        foreach ($config as $key => $value) {

            //批量赋值
            $this->$key = $value;

        }

        //自动调用数据库连接
        $this->connect();
        //自动设置字符集
        $this->setCharset();
    }

    //2.声明一个公开静态的方法用来在内部创建对象
    public static function getObject($config = [])
    {

        //判断是否已经存在对象
        if (self::$obj === null) {
            //如果还没有创建过对象，第一次进来，则创建对象
            self::$obj = new self($config);
        }

//返回
        return self::$obj;
    }

//定义一个方法用来连接数据库
    private function connect()
    {
      //  var_dump($this);
        //连接数据库
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);
//判断是否连接成功
        if ($this->link === false) {
            echo "连接数据库失败<br>" .
                "错误信息：" . mysqli_connect_error() .
                "<br>错误编号：" . mysqli_connect_errno();
            exit;

        }
    }

    //定义一个设置字符集的方法
    private function setCharset()
    {
        $result = mysqli_query($this->link, "set names {$this->charset}");
        //如果执行错误
        if ($result === false) {
            echo "设置字符集失败<br>" .
                "错误信息：" . mysqli_error($this->link) .
                "<br>错误编号：" . mysqli_errno($this->link);
            exit;

        }
    }

    //定义一个query方法专门用来执行SQL语句 得到结果集
    public function query($sql)
    {

        //执行SQL语句
        $result = mysqli_query($this->link, $sql);
        //如果执行错误
        if ($result === false) {
            echo "执行SQL语句失败<br>" .
                "错误信息：" . mysqli_error($this->link) .
                "<br>错误编号：" . mysqli_errno($this->link) .
                "<br>SQL语句:" . $sql;
            exit;

        }

        //返回结果集
        return $result;
    }

    //返回一个一维数组
    public function fetchRow($sql)
    {
        //3.执行SQL语句得到结果集
        $result = $this->query($sql);
        //4.通过结果集得到一维数组
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // var_dump($row);
        //5.返回数据
        return $row;

    }

//返回一个二维数组
    public function fetchAll($sql)
    {

        //4.执行SQL语句,得到结果集
        $result = $this->query($sql);
        //5.整理结果集
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //6.返回结果集
        return $rows;
    }

    //返回当前数据第一行第一列的数据
    public function fetchColumn($sql)
    {
        //得到第一行 这个数组第一个元素
        $row = $this->fetchRow($sql);
        //返回数组的第一个元素
        return current($row);
    }

    //4.私有克隆的魔术方法
    private function __clone()
    {
    }

    /**
     * 得到最后生成id
     * @return int|string
     */
    public function getLastId(){
        return mysqli_insert_id($this->link);
    }
    //析构方法
    public function __destruct()
    {
        mysqli_close($this->link);
    }
}