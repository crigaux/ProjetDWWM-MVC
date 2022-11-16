<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Home
any('/accueil', 'controllers/homeCtrl.php');
get('/', 'controllers/homeCtrl.php');
get('/menu', 'controllers/menuCtrl.php');
get('/commentaires', 'controllers/reviewCtrl.php');
get('/galerie', 'controllers/galeryCtrl.php');
any('/connexion', 'controllers/connectionCtrl.php');
any('/inscription', 'controllers/registerCtrl.php');
any('/oubli-mot-de-passe', 'controllers/forgotPwdCtrl.php');
any('/admin/menu', 'controllers/admin/dbMenuCtrl.php');
any('/admin/commentaires', 'controllers/admin/dbReviewsCtrl.php');
any('/admin/membres', 'controllers/admin/dbRegistersCtrl.php');
any('/admin/reservations', 'controllers/admin/dbReservationsCtrl.php');
any('/reservation/add', 'controllers/admin/dbReservationAllCtrl.php');
// get('/accueil#reservation', 'controllers/homeCtrl.php#reservation');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
any('/admin/menu/edit/$id', 'controllers/admin/dbMenuAllCtrl.php');
any('/admin/menu/add/$type', 'controllers/admin/dbMenuAllCtrl.php');
any('/admin/menu/delete/$id', 'controllers/admin/dbMenuAllCtrl.php');
any('/admin/reservation/edit/$id', 'controllers/admin/dbReservationAllCtrl.php');
any('/admin/reservation/delete/$id', 'controllers/admin/dbReservationAllCtrl.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
get('/detail-rdv/$edit/$id', 'controllers/appointmentDetailsController.php');
get('/rendez-vous/$del/$id', 'controllers/allAppointmentController.php');
get('/patient/$edit/$id', 'controllers/patientProfileController.php');
get('/patients/$del/$id', 'controllers/allPatientsController.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
get('/product/$type/color/$color', 'product.php');

// A route with a callback
get('/callback', function(){
  echo 'Callback executed';
});

// A route with a callback passing a variable
// To run this route, in the browser type:
// http://localhost/user/A
get('/callback/$name', function($name){
  echo "Callback executed. The name is $name";
});

// A route with a callback passing 2 variables
// To run this route, in the browser type:
// http://localhost/callback/A/B
get('/callback/$name/$last_name', function($name, $last_name){
  echo "Callback executed. The full name is $name $last_name";
});

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','/404.php');
