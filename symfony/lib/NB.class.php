<?php

class NB
{
  public static function getPriorities() {
    return array(
      'none' => '-',
      'p1'   => '+',
      'p2'   => '++',
      'p3'   => '+++',
      'p4'   => '++++',
      'p5'   => '+++++',
      'p6'   => '++++++'
    );
  }

  public static function formatEstimate($timestamp) {
    $hours = $timestamp / 60;
    $minutes = $timestamp % 60;

    return sprintf("%02d:%02d", $hours, $minutes);
  }
}