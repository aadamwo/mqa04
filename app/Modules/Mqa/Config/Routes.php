<?php
use Modules\Mqa\Controllers\MqaController;
use Modules\Mqa\Controllers\AdminController;
use Modules\Mqa\Controllers\Mqa04Controller;

// Admin Section & Item CRUD (dynamic, for all sections)
$routes->get('section/(:alpha)', '\Modules\Mqa\Controllers\Mqa04Controller::section/$1');
$routes->post('section/add', '\Modules\Mqa\Controllers\Mqa04Controller::addSection');
$routes->post('section/(:alpha)/add-item', '\Modules\Mqa\Controllers\Mqa04Controller::addItem/$1');
$routes->post('section/(:alpha)/edit-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editItem2/$1/$2');
$routes->post('section/(:alpha)/delete-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::deleteItem2/$1/$2');

// Legacy/Specific Section A/B routes (if still needed)
$routes->get('seca', '\Modules\Mqa\Controllers\Mqa04Controller::seca');
$routes->post('seca/upload', '\Modules\Mqa\Controllers\Mqa04Controller::upload');
$routes->post('seca/edit-upload/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editUpload/$1');
$routes->post('seca/add-item-a', '\Modules\Mqa\Controllers\Mqa04Controller::addItemA');
$routes->post('seca/add-item-b', '\Modules\Mqa\Controllers\Mqa04Controller::addItemB');
$routes->post('seca/delete-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::deleteItem/$1');
$routes->match(['get', 'post'], 'seca/edit-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editItem/$1');

// Admin program and section management
$routes->get('adminprog', '\Modules\Mqa\Controllers\Mqa04Controller::adminProg');

// Public routes
$routes->get('public', '\Modules\Mqa\Controllers\Pub04Controller::index');
$routes->post('public/upload', '\Modules\Mqa\Controllers\ProgramController::upload');
$routes->post('public/edit-responsibility/(:num)', '\Modules\Mqa\Controllers\ProgramController::editResponsibility/$1');
$routes->post('public/edit-message/(:num)', '\Modules\Mqa\Controllers\ProgramController::editMessage/$1');

// Program routes
$routes->get('program', '\Modules\Mqa\Controllers\ProgramController::index');
$routes->get('PubA.php', '\Modules\Mqa\Controllers\ProgramController::Pub04');
$routes->post('program/upload', '\Modules\Mqa\Controllers\ProgramController::upload');
$routes->post('program/edit-responsibility/(:num)', '\Modules\Mqa\Controllers\ProgramController::editResponsibility/$1');
$routes->post('program/edit-message/(:num)', '\Modules\Mqa\Controllers\ProgramController::editMessage/$1');
$routes->post('program/edit/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editProgram/$1');

// Admin section management (if you want a page to list/manage all sections)
$routes->get('admin/section/(:alpha)', '\Modules\Mqa\Controllers\Mqa04Controller::adminSection/$1');
$routes->post('admin/section/add', '\Modules\Mqa\Controllers\Mqa04Controller::addSection');
$routes->post('admin/section/(:alpha)/add-item', '\Modules\Mqa\Controllers\Mqa04Controller::addItem/$1');

$routes->get('AdminSec.php', '\Modules\Mqa\Controllers\Mqa04Controller::adminSec');
$routes->get('SecA.php', '\Modules\Mqa\Controllers\Mqa04Controller::seca');

// Optionally, remove or comment out any legacy or duplicate routes below this line.







