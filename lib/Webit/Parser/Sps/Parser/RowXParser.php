<?php
namespace Webit\Parser\Sps\Parser;
use Webit\Parser\Sps\Row\RowX;

class RowXParser extends AbstractRowParser {
	public function parse($line, $rowIndex) {
		$row = new RowX($rowIndex);
			$row->setSourceString($line);
			
			$line = rtrim($line,';');
			$row->setFieldTapeNumber($this->getFieldTapeNumber($line));
			$row->setFieldRecordNumber($this->getFieldTapeNumber($line));
			$row->setFieldRecordIncrement($this->getFieldRecordIncrement($line));
			$row->setInstrumentCode($this->getInsrumentCode($line));
			$row->setLineName($this->getLineName($line));			
			$row->setPointNumber($this->getPointNumber($line));
			$row->setPointIndex($this->getPointIndex($line));
			$row->setFromChannel($this->getFromChannel($line));
			$row->setToChannel($this->getToChannel($line));
			$row->setChannelIncrement($this->getChannelIncrement($line));
			$row->setReciverLineName($this->getReciverLineName($line));
			$row->setFromReciver($this->getFromReciver($line));
			$row->setToReciver($this->getToReciver($line));
			$row->setReciverIndex($this->getReciverIndex($line));
			
		return $row;
	}
	
	/**
	 * Line name 2-7 (right)
	 * @param string $line
	 * @return string
	 */
	protected function getFieldTapeNumber($line) {
		$num = trim(substr($line, 1, 6));
		if(!empty($num)) {
			return $num;
		}
		
		return null;
	}
	
	/**
	 * Field record number (8-15) 
	 * @param string $line
	 */
	protected function getFieldRecordNumber($line) {
		$num = trim(substr($line, 7, 8));
		if(!empty($num)) {
			return (int)$num;
		}
		
		return null;
	}
	
	/**
	 * Field record increment (16-16)
	 * @param string $line
	 */
	protected function getFieldRecordIncrement($line) {
		$num = trim(substr($line, 15, 1));
		if(!empty($num)) {
			return (int)$num;
		}
		
		return null;
	}
	
	/**
	 * Instrument code (17-17)
	 * @param string $line
	 */
	protected function getInsrumentCode($line) {
		$str = trim(substr($line, 16, 1));
		if(!empty($str)) {
			return $str;
		}
		
		return null;
	}
	
	/**
	 * Line name (18-27) 
	 * @param string $line
	 */
	protected function getLineName($line) {
		$num = trim(substr($line, 17, 10));
		if(!empty($num)) {
			return (float)$num;
		}
		
		return null;
	}
	
	/**
	 * Point number (28-37)
	 * @param string $line
	 */
	protected function getPointNumber($line) {
		$num = trim(substr($line, 27, 10));
		if(!empty($num)) {
			return (float)$num;
		}
		
		return null;
	}
	
	/**
	 * Point index (38-38)  
	 * @param string $line
	 */
	protected function getPointIndex($line) {
		$num = trim(substr($line, 37, 1));
		if(!empty($num)) {
			return (int)$num;
		}
		
		return null;
	}
	
	/**
	 * From channel (39-43)
	 * @param string $line
	 * @return int|null 
	 */
	protected function getFromChannel($line) {
		$num = trim(substr($line, 38, 5));
		if(!empty($num)) {
			return (int)$num;
		}
		
		return null;
	}
	
	/**
	 * To channel (44-48)
	 * @param string $line
	 * @return int|null
	 */
	protected function getToChannel($line) {
		$num = trim(substr($line, 43, 5));
		if(!empty($num)) {
			return (int)$num;
		}
	
		return null;
	}
	
	/**
	 * Channel increment (49-49)
	 * @param string $line
	 * @return int|null
	 */
	protected function getChannelIncrement($line) {
		$num = trim(substr($line, 48, 1));
		if(!empty($num)) {
			return (int)$num;
		}
	
		return null;
	}
	
	/**
	 * Reciver line name (50-59)
	 * @param string $line
	 * @return float|null
	 */
	protected function getReciverLineName($line) {
		$num = trim(substr($line, 49, 10));
		if(!empty($num)) {
			return (float)$num;
		}
		
		return null;
	}
	
	/**
	 * From reciver (60-69)
	 * @param string $line
	 * @return float|null
	 */
	protected function getFromReciver($line) {
		$num = trim(substr($line, 59, 10));
		if(!empty($num)) {
			return (float)$num;
		}
	
		return null;
	}
	
	/**
	 * To reciver (70-79)
	 * @param string $line
	 * @return float|null
	 */
	protected function getToReciver($line) {
		$num = trim(substr($line, 69, 10));
		if(!empty($num)) {
			return (float)$num;
		}
	
		return null;
	}
	
	/**
	 * Reciver index (80-80)
	 * @param string $line
	 * @return int|null
	 */
	protected function getReciverIndex($line) {
		$num = trim(substr($line, 79, 1));
		if(!empty($num)) {
			return (int)$num;
		}
		
		return null;
	}
}
?>
