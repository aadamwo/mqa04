<?php
use Modules\Mqa\Controllers\MqaController;
use Modules\Mqa\Controllers\AdminController;
use Modules\Mqa\Controllers\Mqa04Controller;
//admin routes
$routes->get('seca', '\Modules\Mqa\Controllers\Mqa04Controller::seca');
$routes->post('seca/upload', '\Modules\Mqa\Controllers\Mqa04Controller::upload');
$routes->post('seca/edit-upload/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editUpload/$1');
$routes->post('seca/add-item-a', '\Modules\Mqa\Controllers\Mqa04Controller::addItemA');
$routes->post('seca/add-item-b', '\Modules\Mqa\Controllers\Mqa04Controller::addItemB');
$routes->post('seca/delete-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::deleteItem/$1');
$routes->match(['get', 'post'], 'seca/edit-item/(:num)', '\Modules\Mqa\Controllers\Mqa04Controller::editItem/$1');

$routes->get('AdminSec.php', '\Modules\Mqa\Controllers\Mqa04Controller::adminSec');
$routes->get('SecA.php', '\Modules\Mqa\Controllers\Mqa04Controller::seca');


//public routes
$routes->get('public', '\Modules\Mqa\Controllers\Pub04Controller::index');


$routes->get('program', '\Modules\Mqa\Controllers\ProgramController::index');
$routes->get('PubA.php', '\Modules\Mqa\Controllers\ProgramController::Pub04');
$routes->post('program/upload', '\Modules\Mqa\Controllers\ProgramController::upload');
$routes->post('program/edit-responsibility/(:num)', '\Modules\Mqa\Controllers\ProgramController::editResponsibility/$1');
$routes->post('program/edit-message/(:num)', '\Modules\Mqa\Controllers\ProgramController::editMessage/$1');

// NEW (use ProgramController)
$routes->post('public/upload', '\Modules\Mqa\Controllers\ProgramController::upload');
$routes->post('public/edit-responsibility/(:num)', '\Modules\Mqa\Controllers\ProgramController::editResponsibility/$1');
$routes->post('public/edit-message/(:num)', '\Modules\Mqa\Controllers\ProgramController::editMessage/$1');












// $routes->group('mqa', function ($routes) {

//     $routes->get('/', [MqaController::class, 'index']); // For 'mqa/'

//     $routes->get('admin', [AdminController::class, 'admin']);

//     $routes->get('public', [MqaController::class, 'public']);
//   $routes->get('section-a', [MqaController::class, 'sectionA']);
// $routes->post('section-a/save', [MqaController::class, 'saveSectionA']);





//     $routes->get('section-b', [MqaController::class, 'sectionB']); 
//     $routes->get('section-c', [MqaController::class, 'sectionC']);

//     // ADD THIS INSIDE THE GROUP:
//     $routes->post('admin/sectiona/add', [AdminController::class, 'addSectionA']);
// 	$routes->post('admin/sectiona/edit/(:num)', [AdminController::class, 'editSectionA/$1']);
// 	$routes->post('admin/sectiona/delete/(:num)', [AdminController::class, 'deleteSectionA/$1']);
// 	$routes->get('admin/sectiona', [AdminController::class, 'adminA']);
// 	$routes->get('admin/sectionb', [AdminController::class, 'adminB']);
// 	$routes->post('admin/sectionb/add', [AdminController::class, 'addSectionB']);
// 	$routes->post('admin/sectionb/edit/(:num)', [AdminController::class, 'editSectionB/$1']);
// 	$routes->post('admin/sectionb/delete/(:num)', [AdminController::class, 'deleteSectionB/$1']);
// 	$routes->post('section-b/upload/(:num)', [MqaController::class, 'uploadSectionB/$1']);
// 	$routes->post('section-b/save', [MqaController::class, 'saveSectionB']);
// 	$routes->get('admin/sectionc', [AdminController::class, 'adminC']);
// $routes->post('admin/sectionc/add', [AdminController::class, 'addSectionC']);
// $routes->post('admin/sectionc/edit/(:num)', [AdminController::class, 'editSectionC/$1']);
// $routes->post('admin/sectionc/delete/(:num)', [AdminController::class, 'deleteSectionC/$1']);
// $routes->post('section-c/save', [MqaController::class, 'saveSectionC']);
// });







