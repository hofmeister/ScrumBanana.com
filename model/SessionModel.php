<?php
class SessionModel implements ISession {
    /**
     *
     * @var couchDocument
     */
    private $document;
    
    public function commit() {
        if ($this->document) {
            CouchDB::client()->storeDoc($this->document);
        }
    }
    public function get($key) {
        if ($this->document->$key)
            return unserialize($this->document->$key);
    }
    public function loadFromSID($SID) {
        $result = CouchDB::client()->key($SID)->include_docs(true)->getView("session",'all');
        
        if (count($result->rows) > 0)
            $this->document = current($result->rows)->doc;

        if(!$this->document) {
            $this->document = new stdClass();   
        }
        
        $this->document->SID = $SID;
        $this->document->type = 'session';
        $this->document->expires = SessionHandler::instance()->getExpires();
        return $this;
    }
    public function set($key, $value) {
        return $this->document->$key = serialize($value);
    }
    public function setUser(IUser $user) {
        $this->set('user',$user->getUserId());
    }
}