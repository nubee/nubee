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
    case 'p1' : $i = 1; break;
    case 'p2' : $i = 2; break;
    case 'p3' : $i = 3; break;
    case 'p4' : $i = 4; break;
    case 'p5' : $i = 5; break;
    case 'p6' : $i = 6; break;
    default   : $i = 0; break;//return 'None';
  }

  $str = '';
  for($j = 6; $j > $i; --$j)
    $str .= image_tag('icons/disabled-star.png');
  for(; $i > 0; --$i)
    $str .= image_tag('icons/star.png');

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