<?php

class user {
    private $id ,$username , $role ;

    /**
     * @param $id
     * @param $username
     * @param $role
     */
    public function __construct($id, $username, $role){
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return user
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return user
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return user
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

}