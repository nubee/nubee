<?php

function action_link_to($image, $url, $object, $title = null, $attributes = array()) {
  return link_to(image_tag($image, array('alt_title' => $title)), $url, $object, $attributes);
}

function edit_link_to($url, $object, $attributes = array()) {
  return link_to(image_tag('icons/edit.png', array('alt_title' => 'Edit')), $url, $object, $attributes);
}

function edit_link_to2($title, $url, $object, $attributes = array()) {
  return
    edit_link_to($url, $object, $attributes) 
    . ' ' . link_to($title, $url, $object, $attributes);
}

function add_link_to($url, $attributes = array()) {
  return link_to(image_tag('icons/add.png', array('alt_title' => 'Add')), $url, $attributes);
}

function add_link_to2($title, $url, $attributes = array()) {
  return
    add_link_to($url, $attributes)
    . ' '. link_to($title, $url, $attributes);
}


function delete_link_to($url, $object, $attributes = array()) {
  $attributes = array_merge($attributes, array(
    'confirm' => 'Are you sure?',
     'method' => 'delete'
    ));
  return link_to(image_tag('icons/delete.png', array('alt_title' => 'Delete')), $url, $object, $attributes);
}

function delete_link_to2($title, $url, $object, $attributes = array()) {
  $attributes = array_merge($attributes, array(
    'confirm' => 'Are you sure?',
     'method' => 'delete'
    ));
  return link_to(image_tag('icons/delete.png', array('alt_title' => 'Delete')), $url, $object, $attributes)
    . ' ' . link_to($title, $url, $object, $attributes);
}

function format_priority($priority) {
  switch($priority) {
    case 'p1' : $num = 1; break;
    case 'p2' : $num = 2; break;
    case 'p3' : $num = 3; break;
    case 'p4' : $num = 4; break;
    case 'p5' : $num = 5; break;
    case 'p6' : $num = 6; break;
    default   : $num = 0; break;//return 'None';
  }

  $str = '';
  for($i = $num; $i > 0; --$i)
    $str .= image_tag('icons/star.png');
  for($j = 6; $j > $num; --$j)
    $str .= image_tag('icons/disabled-star.png');

  return $str;
}

function format_timestamp($timestamp) {
  $hours = $timestamp / 60;
  $minutes = $timestamp % 60;

  return sprintf("%02d:%02d", $hours, $minutes);  
}

function format_status($status) {
  return ($status
    ? image_tag('icons/enabled.png', array('alt_title' => 'Enabled'))
    : image_tag('icons/disabled.png', array('alt_title' => 'Disabled')));
}

function format_task_status($status) {
  switch($status) {
    case 'not_started': return image_tag('icons/idle.png', array('alt_title' => 'Not Started'));
    case 'started'    : return image_tag('icons/started.png', array('alt_title' => 'Started'));
    case 'done'       : return image_tag('icons/done.png', array('alt_title' => 'Done'));
  }
}

function format_text($text) {
  return nl2br($text);
}