<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| PAGINATION
| -------------------------------------------------------------------------
|
*/

$config['full_tag_open'] = '<ul class="pagination">';
$config['full_tag_close'] = '</ul>';

$config['use_page_numbers'] = TRUE;
$config['num_links'] = 4;

$config['num_tag_open']    = '<li>';
$config['num_tag_close']   = '</li>';

$config['first_tag_open']  = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_tag_open']   = '<li>';
$config['last_tag_close']  = '</li>';

$config['next_tag_open']   = '<li>';
$config['next_tag_close']  = '</li>';

$config['prev_tag_open']   = '<li>';
$config['prev_tag_close']  = '</li>';

$config['cur_tag_open']    = '<li class="current"><a href="javascript:;">';
$config['cur_tag_close']   = '</a></li>';

$config['first_link'] = 'First';
$config['last_link'] = 'Last';
$config['next_link'] = 'Nex &gt;';
$config['prev_link'] = '&lt; Pre';