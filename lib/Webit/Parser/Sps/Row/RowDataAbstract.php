<?php
namespace Webit\Parser\Sps\Row;
use Webit\Parser\FixedWidth\File\FileRow;

abstract class RowDataAbstract extends FileRow implements RowInterface {
	/**
	 *
	 * @var string
	 */
	protected $type;
	
	/**
	 * Min to max: -999999.99 to 9999999.99
	 * @var float(10.2)
	 */
	protected $lineName;

	/**
	 * Min to max: -999999.99 to 9999999.99
	 * @var float(10.2)
	 */
	protected $pointNumber;

	/**
	 * Min to max: 1 to 9
	 * @var int
	 */
	protected $pointIndex;
	
	/**
	 * 
	 * @var string
	 */
	protected $sourceString;
	
	public function getType() {
		return $this->type;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function getLineName() {
		return $this->lineName;
	}
	
	public function setLineName($lineName) {
		$this->lineName = $lineName;
	}
	
	public function getPointNumber() {
		return $this->pointNumber;
	}
	
	public function setPointNumber($pointNumber) {
		$this->pointNumber = $pointNumber;
	}
	
	public function getPointIndex() {
		return $this->pointIndex;
	}
	
	public function setPointIndex($pointIndex) {
		$this->pointIndex = $pointIndex;
	}
	
	public function setSourceString($sourceString) {
		$this->sourceString = $sourceString;
	}
	
	public function getSourceString() {
		return $this->sourceString;
	}
}
?>
