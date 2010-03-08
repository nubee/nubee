<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(6, new lime_output_color());

$t->comment('::clean()');
$validator = new mdEstimateValidator();
$t->is($validator->clean('36:00'), 2160, '::clean(\'36:00\') returns 2160 minutes');
$t->is($validator->clean('2160'), 2160, '::clean(\'2160\') returns 2160 minutes');
$t->is($validator->clean('12:34:56'), 754, '::clean(\'12:34:56\') returns 754 minutes');

$t->comment('NB::formatEstimate()');
$t->is(NB::formatEstimate(12), '00:12', '::toDate(12) returns 12 minutes');
$t->is(NB::formatEstimate(754), '12:34', '::toDate(754) returns 12 hours and 34 minutes');
$t->is(NB::formatEstimate(2160), '36:00', '::toDate(2160) returns 36 hours');
