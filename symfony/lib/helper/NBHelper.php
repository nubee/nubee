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

function format_timestamp($timestamp, $format = 'h') {
  $weeks = 0;
  $days = 0;
  $hours = 0;
  switch($format) {
    case 'w':
      if($timestamp >= 60 * 8 * 7) {
        $days = (int)($timestamp / (60 * 8 * 7));
        $timestamp %= 8 * 7;
      }
    case 'd':
      if($timestamp >= 60 * 8) {
        $days = (int)($timestamp / (60*8));
        $timestamp %= 8;
      }
    case 'h':
      if($timestamp >= 60) {
        $hours = (int)($timestamp / 60);
        $timestamp %= 60;
      }
    case 'm':
      $minutes = $timestamp;
  }

  switch($format) {
    case 'w':
      if($weeks > 0)
        return sprintf("%dw %dd %dh %dm", $weeks, $days, $hours, $minutes);  
    case 'd':
      if($days > 0)
        return sprintf("%dd %dh %dm", $days, $hours, $minutes);  
    case 'h':
      if($hours > 0)
        return sprintf("%dh %dm", $hours, $minutes);  
    case 'm':
      return sprintf("%dm", $minutes);  
  }

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

function get_estimate_class($object) {
  if($object->getOriginalEstimate() < $object->getCurrentEstimate())
    return 'red';
    
  if($object->getOriginalEstimate() > $object->getCurrentEstimate())
    return 'green';
  
  return '';
}

function format_efforts($item, $children, $length, $debug = false) {
  $currentEstimate = $item->getCurrentEstimate() / $length;
  $originalEstimate = $item->getOriginalEstimate() / $length;
  $spent = 0;
  $offset = 0;
  
  $str = sprintf('[[%s, %s]', $spent, $originalEstimate);
  if($debug)
    echo '<table>';
  foreach($children as $child) {
    $es = $child->getEffortSpent() / $length;
    $el = $child->getEffortLeft() / $length;
    $oe = $child->getOriginalEstimate() / $length;
    $ce = $child->getCurrentEstimate() / $length;

    $diff = $ce - $oe;
    $currentEstimate -= $es;
    $originalEstimate -= ($es - $diff);
    $spent += $es;
    $offset += $diff - $es;
    $str .= sprintf(', [%s, %s]', $spent, $originalEstimate);
    if($debug)
      echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>(%s)</td></tr>", $es, $currentEstimate, $originalEstimate, $offset);
  }
  if($debug)
    echo '</table>';
  
  $str .= ']';
  
  return $str;
}

function count_months($start, $end) {
  $start = strtotime($start);
  $end = strtotime($end);
  
  $m1 = date('n', $start);
  $m2 = date('n', $end);
  
  $y1 = date('y', $start);
  $y2 = date('y', $end);
  
//  echo $m1 . ' ' . $m2 . "<br />";
//  echo $y1 . ' ' . $y2 . "<br />";

  return ($m2 - $m1) + ($y2 - $y1) * 12;
}

function format_flot_dates($item, $value) {
  $startDate = strtotime($item->getStartDate()) * 1000;
  $endDate = strtotime($item->getEndDate()) * 1000;

  return sprintf('[[%s, %s], [%s, %s]]', $startDate, $value, $endDate, $value);
}