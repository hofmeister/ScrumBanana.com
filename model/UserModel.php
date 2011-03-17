<?php
class UserModel implements IUser {
    private $doc;
    public function  __construct($doc) {
        $this->doc = $doc;
    }
    public function getUserId() {
        return $this->doc->_id;
    }
    public function getUsername() {
        return $this->doc->email;
    }
    public function isValid() {
        return ($this->doc->_id != null);
    }
    public function getFullName() {
        return $this->doc->name;
    }
}