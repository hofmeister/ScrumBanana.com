<?php
class UserService {

    public static function byAuth($email,$password) {
        $result = CouchDB::client()->key($email)->getView('users','by-email');
        if (count($result->rows) > 0) {
            foreach($result->rows as $row) {
                if ($row->value->password == md5($password)) {
                    return $row->value;
                }
            }
        }
        return null;
    }
    public static function byEmail($email) {
        $result = CouchDB::client()->key($email)->getView('users','by-email');
        if (count($result->rows) > 0) {
            foreach($result->rows as $row) {
                return $row->value;
            }
        }
        return null;
    }
    public static function save($userDoc) {
        if (!$userDoc->email) return false;
        //Ensure that type is always user
        $userDoc->type = 'user';

        $result = CouchDB::client()->key($userDoc->email)->getView('users','by-email');
        if (count($result->rows)) {
            return false;
        }
        CouchDB::client()->storeDoc($userDoc);
        return self::byEmail($userDoc->email);
    }
}