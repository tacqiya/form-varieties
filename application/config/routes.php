<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'frontpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['cfp'] = 'frontpage/cfp';
$route['submission-portal'] = 'frontpage/submission';
$route['call-documents'] = 'frontpage/call_documents';