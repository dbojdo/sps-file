<?php
spl_autoload_register(function($class) {
	$path = preg_replace('#\\\\#','/',$class).'.php';
	require_once __DIR__.'/../lib/'.$path;
});

use Webit\Parser\Sps\Parser\Parser;

$parser = new Parser();
$sps = $parser->parse('20121210_01.sps');

die(var_dump($sps));