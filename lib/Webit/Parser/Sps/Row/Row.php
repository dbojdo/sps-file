<?php
namespace Webit\Parser\Sps\Row;
class Row {
	const ROW_TYPE_HEADER = 'H';
	const ROW_TYPE_SOURCE = 'S';
	const ROW_TYPE_RECIVE = 'R';
	const ROW_TYPE_CROSS = 'X';
	
	/**
	 * 
	 * @var int
	 */
	protected $rowIndex;

	/**
	 * 
	 * @var string
	 */
	protected $sourceString;
	
	/**
	 * 
	 * @var string
	 */
	protected $type;
	
	public function __construct($rowIndex) {
		$this->rowIndex = $rowIndex;
	}
	
	public function getRowIndex() {
		return $this->rowIndex;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setSourceString($sourceString) {
		$this->sourceString = $sourceString;
	}
	
	public function getSourceString() {
		return $this->sourceString;
	}
}
?>
