<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/','AdminController::log');
$routes->post('/login', 'AdminController::process');
$routes->get('admin/resetables', 'ResetData_Controller::resetdata');

$routes->post('admin/logout', 'AdminController::logout');
$routes->get('admin/listetudiant', 'AdminController::listetudiant');
$routes->get('/listesemestre', 'AdminController::listesemestre');
$routes->get('admin/formulairenote', 'AdminController::addNoteForm');
$routes->post('/addnote', 'AdminController::addNote');

$routes->get('note/semestre', 'NoteController::getnotesemestre');

$routes->get('admin/import','ImportController::index');
$routes->post('importcsv', 'ImportController::importcsv');

$routes->get('/etudiant', 'EtudiantController::log');
$routes->post('/etudiant/login', 'EtudiantController::loginetudiant');
// $routes->get('/etudiant/listesemestre', 'EtudiantController::getsemestre');
$routes->post('/etudiant/logout', 'EtudiantController::logout');



// routes teste pour fonctions -------------------------------------------

$routes->get('/test', 'ProprietaireController::testgetchiffreaffaire');

// fin routes teste pour fonctions ---------------------------------------

$routes->get('/client', 'ClientController::index');
$routes->post('/client/login', 'ClientController::loginclient');
$routes->get('/client/logout', 'ClientController::logout');






// $routes->post('clientcontroller/authentification', 'ClientController::authentification');
// $routes->get('clientcontroller/listdevis', 'ClientController::listdevis');
// $routes->get('clientcontroller/newdevis', 'ClientController::newdevis');
// $routes->get('clientcontroller/insertdevis', 'ClientController::insertdevis');

// $routes->get('formcontroller/choix_login', 'FormController::choix_login');
// $routes->get('template/temple', 'Template::temple');
