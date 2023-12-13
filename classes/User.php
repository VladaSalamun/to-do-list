<?php
class User {
    private $id;
    private $username;
    private $password;

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}
?>
