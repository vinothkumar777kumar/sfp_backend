<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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
$routes->options('(:any)', 'OptionsController::options'); //one options method for all routes.
/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// $routes->post('userlogin','AuthController::userlogin');
$routes->group('api',['namespace' => 'App\Controllers'],function($routes){
	// authendication
	$routes->post('userlogin','AuthController::userlogin');
		$routes->post('register','AuthController::register');

	// get dashboard data
	$routes->get('getdashboarddata', 'SponsorsController::getdashboarddata');
	
	// get student profile data
	
	$routes->get('myaccount/(:any)', 'Home::getUsers/$1');

	// students crud
	$routes->get('getallstudent', 'StudentsController::getallstudent');
	$routes->post('addstudent','StudentsController::addstudent');
	$routes->get('editstudent/(:any)', 'StudentsController::editstudent/$1');
	$routes->post('updatestudent','StudentsController::updatestudent');
	$routes->post('updatestudentprofile','StudentsController::updatestudentprofile');
	
	$routes->get('deletestudent/(:any)', 'StudentsController::deletestudent/$1');
	
	$routes->get('getstudentsponsordata/(:any)', 'StudentsController::getstudentsponsordata/$1');


	

	// sponsors crud
	$routes->get('getallsponsors', 'SponsorsController::getallsponsors');
	$routes->post('addsponsor','SponsorsController::addsponsor');
	$routes->get('editsponsor/(:any)', 'SponsorsController::editsponsor/$1');
	$routes->post('updatsponsor','SponsorsController::updatsponsor');
	$routes->get('deletesponsor/(:any)', 'SponsorsController::deletesponsor/$1');
$routes->get('deletesponsorstudent/(:any)', 'SponsorsController::deletesponsorstudent/$1');

$routes->post('paysponsorship','SponsorsController::paysponsorship');


$routes->get('getpaidsponsorshipdata/(:any)', 'SponsorsController::getpaidsponsorshipdata/$1');




	
	$routes->get('getsponsorstudent/(:any)', 'SponsorsController::getsponsorstudent/$1');

	// feesstructure
	$routes->post('updatefees/(:any)','FeesController::updatefees/$1');
	$routes->get('getfeestype/(:any)', 'FeesController::getfeestype/$1');
	$routes->get('getstudentfeesdata/(:any)/(:any)', 'FeesController::getstudentfeesdata/$1/$2');

	// change password
	
	$routes->post('updatepassword','Home::update_mypassword');
	$routes->post('updatestudentpassword','Home::updatestudentpassword');


	// notification data start
	
	$routes->get('getsponsorshippaiddata', 'NotificationController::getsponsorshippaiddata');
	$routes->get('getallnotificationdata/(:any)', 'NotificationController::getnotificationdata/$1');
	
	// notification data end


	// pending student approval data
	$routes->get('getallpendingapprovalstudents', 'StudentsController::getallpendingapprovalstudents');
	$routes->post('approvalstudent/(:any)', 'StudentsController::approvalstudent/$1');
	$routes->post('pendingstudent/(:any)', 'StudentsController::pendingstudent/$1');
	$routes->post('rejectstudent/(:any)', 'StudentsController::rejectstudent/$1');

	// admin assign sponsor to students
	
	$routes->get('getstudentassignedsponsordata/(:any)', 'StudentsController::getstudentassignedsponsordata/$1');
	$routes->post('updatestudentassignsponsor','SponsorsController::updatestudentassignsponsor');

	// revel notification
	$routes->post('sponsorrevelrequest','NotificationController::sponsorrevelrequest');
	$routes->get('getrevelnotification', 'NotificationController::getrevelnotification');
	$routes->post('studentrevelstatusupdate','NotificationController::studentrevelstatusupdate');
	
	
	// sponsor wallet 
	$routes->get('getsponsorswallettransactiondetails/(:any)', 'SponsorsController::getsponsorswallettransactiondetails/$1');
	$routes->post('addsponsorwallet','SponsorsController::addsponsorwallet');
	$routes->get('editsponsorwallet/(:any)', 'SponsorsController::editsponsorwallet/$1');
	$routes->post('updatsponsorwallet','SponsorsController::updatsponsorwallet');
	$routes->get('deletesponsorwallet/(:any)', 'SponsorsController::deletesponsorwallet/$1');

$routes->get('getsponsoralltransaction/(:any)', 'SponsorsController::getsponsoralltransaction/$1');
$routes->get('getsponsoralltransaction', 'SponsorsController::getallsponsortransaction');


$routes->post('approvalsponsorfinanced','SponsorsController::approvalsponsorfinanced');
$routes->get('getbanktransaction', 'SponsorsController::getbanktransaction');



	

});

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
