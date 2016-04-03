<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "access";
$route['404_override'] = '';
$route['/'] = "access/index";
$route['login'] = "access/login";
$route['register'] = "access/register";
$route['dashboard'] = "dashboard/index";
 


// $route['register'] = "access/register";
// $route['dashboard'] = "dashboard/index";

//end of routes.php
