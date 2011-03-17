<?php

define('BASEURL',dirname($_SERVER['SCRIPT_NAME']).'/');

require_once 'settings.php';
//Init session
SessionHandler::instance()->setSessionKey('SCRUMSID');
SessionHandler::instance()->setSession(new SessionModel());
SessionHandler::instance()->setExpires(3600*24*7);
SessionHandler::instance()->init();

//Init pimple
Pimple::instance()->run();
