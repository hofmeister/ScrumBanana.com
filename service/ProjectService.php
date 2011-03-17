<?php
class ProjectService {

    public static function listAll() {
        $userId = SessionHandler::user()->getUserId();
        return CouchDB::client()->limit(200)->key($userId)->include_docs(true)->getView('projects','by-user');
    }
    public static function save($projectDoc) {
        $userId = SessionHandler::user()->getUserId();
        if (!$projectDoc->_id)
            $projectDoc->_id = String::GUID();
        $projectDoc->type = 'project';
        if (!is_array($projectDoc->users))
            $projectDoc->users = array();
        if (!in_array($userId,$projectDoc->users))
            $projectDoc->users[] = $userId;
        CouchDB::client()->storeDoc($projectDoc);
        return $projectDoc;
    }
    public static function delete($projectId) {
        $projectDoc = self::get($projectId);
        $userId = SessionHandler::user()->getUserId();
        if ($projectDoc->type == 'project' && in_array($projectDoc->users,$userId)) {
            CouchDB::client()->deleteDoc($projectDoc);
            return true;
        }
        return false;
    }
    public static function get($projectId) {
        return CouchDB::client()->getDoc($projectId);
    }

}