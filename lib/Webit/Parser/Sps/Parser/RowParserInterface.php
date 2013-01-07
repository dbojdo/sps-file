<?php 
namespace Webit\Parser\Sps\Parser;

interface RowParserInterface {
	public function parse($line, $rowIndex);
}
?>
