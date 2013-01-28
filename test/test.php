<?php
spl_autoload_register(function($class) {
	$path = preg_replace('#\\\\#','/',$class).'.php';
	require_once __DIR__.'/../lib/'.$path;
});

use Webit\Parser\Sps\Parser\Parser;
use Webit\Parser\Sps\Row\Row;

$parser = new Parser();
$sps = $parser->parse('20121210_01.sps');
$rps = $parser->parse('20121210_01.rps');
$xps = $parser->parse('20121210_01.xps');

$xRows = array_values($xps->getRowsByType(Row::ROW_TYPE_CROSS));
$sRows = array_values($sps->getRowsByType(Row::ROW_TYPE_SOURCE));
$rRows = array_values($rps->getRowsByType(Row::ROW_TYPE_RECIVE));

echo count($xRows) ."\n";
echo count($sRows) ."\n";
echo count($rRows) ."\n";
$s0 = $sps->getRowsFor($xRows[0]);
$r0 = $rps->getRowsFor($xRows[0]);

echo count($s0) ."\n";
echo count($r0) ."\n";