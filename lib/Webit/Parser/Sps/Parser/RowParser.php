<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\FixedWidth\Parser\RowDef;
use Webit\Parser\FixedWidth\RowConfig\YamlDriver;
use Webit\Parser\FixedWidth\Parser\Parser as FixedWidthParser;

class RowParser {
	/**
	 * 
	 * @var FixedWidthParser
	 */ 
	protected $fwParser;

	/**
	 * 
	 * @var array
	 */
	protected $rowDefs = array();

	public function __construct(FixedWidthParser $fwParser) {
		$this->fwParser = $fwParser;
	}
	
	public function registerRowDefinition(RowDef $rowDef, $key) {
		$this->rowDefs[$key] = $rowDef;
	}

	protected function getRowDefinition($line, $rowIndex) {
		if(count($this->rowDefs) == 1) {
			$keys = array_keys($this->rowDefs);
			$key = array_shift($keys);
			return $this->rowDefs[$key];
		}
		
		return null;
	}
	
	public function parse($line, $rowIndex) {
		$rowDef = $this->getRowDefinition($line, $rowIndex);
	
		$row = $this->fwParser->parseRow($line, $rowDef);
		$row->setRowIndex($rowIndex);

		return $row;
	}
}
?>
