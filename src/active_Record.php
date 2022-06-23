<?php

namespace root\ActiveRecord;
use PDO;

class active_Record
{
    private $id;
    private $login;
    private $pass;
    private $msg;

    public function __construct()
    {
        $this->l = new PDO('mysql:host=localhost;dbname=msgDB', 'delloys', 'delloyspass');
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    public function getMsg()
    {
        return $this->msg;
    }
    public function setMsg($msg)
    {
        $this->msg=$msg;
    }

    public function getAllAR()
    {
        $cmd = "select * from msgs";
        $dbh = $this->l->prepare($cmd);
        $dbh->execute();
        return $dbh->fetchAll();
    }
    public function getByIDAR($id) {
        $command = "select * from msgs where id = $id";
        $stmt = $this->l->prepare($command);
        $stmt->execute();
        $res = $stmt->fetchAll()[0];
        $NewInfo = null;

        if (isset($res)) {
            $NewInfo = new active_Record();
            $NewInfo->setId($res['id']);
            $NewInfo->setLogin($res['login']);
            $NewInfo->setPass($res['pass']);
            $NewInfo->setMsg($res['msg']);

            echo $NewInfo->login;
        }
        return $NewInfo;
    }
    public function getFilterAR($login)
    {
        $cmd = "select * from msgs where login like '%$login%'";
        $dbh = $this->l->prepare($cmd);
        $dbh->execute();
        return $dbh->fetchAll();
    }
    public function addInfoAR() {
        $login = $this->login;
        echo $login;
        $pass = $this->pass;
        $msg = $this->msg;

        if ($login != '' && $pass != '' &&  $msg != '')
        {
            $cmd = "insert into msgs(login,pass,msg) values('$login','$pass','$msg');";
            $dbh = $this->l->prepare($cmd);
            $dbh->execute();
        }
    }

    public function deleteInfoAR() {
        $id = $this->id;
        $cmd = "delete from msgs where id = $id";
        $dbh = $this->l->prepare($cmd);
        $dbh->execute();

    }


}
