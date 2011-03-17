<?php
//Load pimple
if ($_SERVER['PIMPLE_PATH'])
    require_once rtrim($_SERVER['PIMPLE_PATH'],'/').'/bootstrap.php';
elseif ($_ENV['PIMPLE_PATH'])
    require_once rtrim($_ENV['PIMPLE_PATH'],'/').'/bootstrap.php';
else
    die('PIMPLE_PATH NOT FOUND');

//Set url to pimple/www/
Settings::set(Pimple::URL,'/pimple/');

require_once 'CouchDb.php';
require_once 'model/SessionModel.php';
require_once 'model/UserModel.php';
require_once 'service/UserService.php';
require_once 'service/ProjectService.php';



//Check for local config file (db settings etc.)
if (isset($_SERVER['HOME']) && !isset($_ENV['HOME']))
	$_ENV['HOME'] = $_SERVER['HOME'];
$localconfig = $_ENV['HOME'].'/.pimple/scrumbanana.php';

if (isset($_ENV['HOME']) && file_exists($localconfig)) {
    require_once $localconfig;
}


Pimple::instance()->setSiteName('ScrumBanana.com');
Settings::set(Mail::FROM_NAME,'ScrumBanana.com');

//Overrule all mails to send to this address - if debug is enabled
Settings::set(Mail::TEST_MAIL,'scrumbanana@mailinator.com');

//Default date formats
Settings::set(Date::DATE_FORMAT,'d.m.Y');
Settings::set(Date::DATETIME_FORMAT,'d.m.Y H:i:s');
Settings::set(Date::TIME_FORMAT,'H:i:s');