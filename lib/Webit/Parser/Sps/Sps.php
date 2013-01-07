<?php
namespace Webit\Parser\Sps;

use Webit\Parser\Sps\Row\RowH;

use Webit\Parser\Sps\Row\Row;

class Sps {
	/**
	 * 
	 * @var string
	 */
	protected $filename;
	
	/**
	 * 
	 * @var array
	 */
	protected $rows = array();

	public function __construct($filename = null) {
		$this->filename = $filename;
	}
	
	public function addRow(Row $row) {
		$this->rows[$row->getRowIndex()] = $row;
	}
	
	/**
	 * @return array
	 */
	public function getRows() {
		return $this->rows;
	}
	
	/**
	 * 
	 * @param int $rowIndex
	 * @return Row|NULL
	 */
	public function getRow($rowIndex) {
		if(key_exists($rowIndex, $this->rows)) {
			return $this->rows[$rowIndex];
		}
		
		return null;
	}
	
	/**
	 * @return array
	 */
	public function getHeaders() {
		return $this->getRowsByType(Row::ROW_TYPE_HEADER);
	}
	
	/**
	 * 
	 * @param string $canonicalType
	 * @param bool $firstOnly
	 * @return array|NULL
	 */
	public function getHeaderByCanonicalType($canonicalType,$firstOnly = true) {
		$result = array_filter($this->rows,function($row) use ($type) {
			return ($row instanceof RowH && $row->getHeaderTypeCanonical() == $canonicalType);
		});
		
		if($firstOnly) {
			$result = count($arResult) > 0 ? array_shift($arResult) : null;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * @param string $type
	 * @return array
	 */
	public function getRowsByType($type) {
		$arResult = array_filter($this->rows,function($row) use ($type) {
			return $row->getType() == $type;
		});
		
		return $arResult;
	}
	
	/**
	 * 
	 * @return string|NULL
	 */
	public function getFilename() {
		return $this->filename;
	}
	
	/**
	 * 
	 * @return DateTime|NULL
	 */
	public function getSurveyDateFrom() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_SURVEY);
		if($value) {
			$arValue = explode(',',$value);
			return \DateTime::createFromFormat('d.m.Y', $arValue[0]);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return DateTime|NULL
	 */
	public function getSurveyDataTo() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_SURVEY);
		if($value) {
			$arValue = explode(',',$value);
			return \DateTime::createFromFormat('d.m.Y', $arValue[1]);
		}
		
		return null;
	}
	
	/**
	 * 
	 * @return DateTime|NULL
	 */
	public function getIssueDate() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_ISSUE);
		if($value) {
			return \DateTime::createFromFormat('d.m.Y', $value);
		}
		
		return null;
	}
}
?>
