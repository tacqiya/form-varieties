<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'frontpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['submission-portal'] = 'frontpage/submission_simple';
$route['multi-bookings'] = 'frontpage/body_museum_bookings';