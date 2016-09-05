<?php
// bootstrap.php
require_once "vendor/autoload.php";

session_start();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src/Entity");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'Pr0t0type',
    'dbname'   => 'doctrine',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);

if (isset($_SESSION['user'])) {
	$currentuser = $em->merge($_SESSION['user']);
}