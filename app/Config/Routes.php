<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// # VACCINE RECEIVER ROUTES
$routes->get('/VaccineReceiver/(:num)', 'VaccineReceiverController::info/$1');
$routes->get('/VaccineReceiver/(:num)/edit', 'VaccineReceiverController::edit/$1');
$routes->post('/VaccineReceiver/editSubmit', 'VaccineReceiverController::editSubmit');

$routes->get('/VaccineReceiver/add', 'VaccineReceiverController::add');
$routes->post('/VaccineReceiver/addSubmit', 'VaccineReceiverController::addSubmit');

// # VACCINE ROUTES
$routes->get('/Vaccine/(:alphanum)', 'VaccineController::info/$1');

// # VACCINE MANUFACTURER ROUTES
$routes->get('/VaccineManufacturer/(:alphanum)/addVaccine', 'VaccineManufacturerController::addVaccine/$1');
$routes->post('/VaccineManufacturer/addVaccineSubmit', 'VaccineManufacturerController::addVaccineSubmit');

$routes->get('/VaccineManufacturer/add', 'VaccineManufacturerController::add');
$routes->post('/VaccineManufacturer/addSubmit', 'VaccineManufacturerController::addSubmit');
$routes->get('/VaccineManufacturer/(:alphanum)', 'VaccineManufacturerController::info/$1');

$routes->get('/VaccineManufacturer/(:alphanum)/edit', 'VaccineManufacturerController::edit/$1');
$routes->post('/VaccineManufacturer/editSubmit', 'VaccineManufacturerController::editSubmit');

$routes->post('/VaccineManufacturer/delete', 'VaccineManufacturerController::delete');

// # VACCINATION CENTER ROUTES
$routes->get('/VaccinationCenter/(:num)', 'VaccinationCenterController::info/$1');
$routes->get('/VaccinationCenter/(:num)/appointment/(:num)', 'VaccinationCenterController::appointmentInfo/$1/$2');

$routes->get('/VaccinationCenter/(:num)/schedule', 'VaccinationCenterController::schedule/$1');
$routes->post('/VaccinationCenter/scheduleSubmit', 'VaccinationCenterController::scheduleSubmit');

$routes->get('/VaccinationCenter/(:num)/appointment/(:num)/record', 'VaccinationCenterController::record/$1/$2');
$routes->post('/VaccinationCenter/recordSubmit', 'VaccinationCenterController::recordSubmit');

$routes->get('/VaccinationCenter/add', 'VaccinationCenterController::add');
$routes->post('/VaccinationCenter/addSubmit', 'VaccinationCenterController::addSubmit');
$routes->get('/VaccinationCenter/(:num)', 'VaccinationCenterController::info/$1');

$routes->get('/VaccinationCenter/(:num)/edit', 'VaccinationCenterController::edit/$1');
$routes->post('/VaccinationCenter/editSubmit', 'VaccinationCenterController::editSubmit');

$routes->get('/VaccinationCenter/(:num)/appointment/(:num)/cancel', 'VaccinationCenterController::cancel/$1/$2');
$routes->post('/VaccinationCenter/appointment/cancelSubmit', 'VaccinationCenterController::cancelSubmit');

// # HEALTH WORKER ROUTES
$routes->get('/HealthWorker/add', 'HealthWorkerController::add');
$routes->post('/HealthWorker/addSubmit', 'HealthWorkerController::addSubmit');
$routes->get('/HealthWorker/(:num)', 'HealthWorkerController::info/$1');

// # VACCINE ORDER ROUTES
$routes->get('/VaccineOrder/order', 'VaccineOrderController::order');
$routes->post('/VaccineOrder/orderSubmit', 'VaccineOrderController::orderSubmit');
$routes->get('/VaccineOrder/(:alphanum)/(:num)', 'VaccineOrderController::info/$1/$2');


// # SIDE EFFECT ROUTES
$routes->get('/SideEffect/add', 'SideEffectController::add');
$routes->post('/SideEffect/addSubmit', 'SideEffectController::addSubmit');
$routes->get('/SideEffect/(:alphanum)/(:alphanum)', 'SideEffectController::info/$1/$2');

// # LANDING PAGE | STATISTICS
$routes->get('/', 'StatisticsController::info');
$routes->post('/', 'StatisticsController::vaccinationCenterSearchSubmit');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
