<?php
namespace Webit\Parser\Sps\Parser;

abstract class AbstractRowParser implements RowParserInterface {	
	abstract public function parse($line, $rowIndex);
	
	/**
	 * Record identification 1-1 A1 “S” or “R”
	 * 
	 * @param string $line
	 * @return string 
	 */
	protected function getRowType($line) {
		return substr($line, 0, 1);
	}
}
?>
