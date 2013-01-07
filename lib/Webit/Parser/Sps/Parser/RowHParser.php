<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\Parser\RowH\RowHFactory;
use Webit\Parser\Sps\Parser\RowH\RowHFactoryInterface;
use Webit\Parser\Sps\Row\RowH;

class RowHParser extends AbstractRowParser {
	/**
	 * 
	 * @var RowHFactoryInterface
	 */
	protected $rowFactory;
	
	public function __construct(RowHFactoryInterface $rowFactory = null) {
		$rowFactory = $rowFactory ?: new RowHFactory();
		$this->rowFactory = $rowFactory;
	}
	
	public function parse($line, $rowIndex) {
		$type = $this->getHeaderType($line);
		$modifier = $this->getHeaderTypeModifier($line);
		$canon = $type.$modifier;
		
		$row = $this->rowFactory->createRow($canon, $rowIndex);
		$row->setSourceString($line);
		$row->setHeaderType($type);
		$row->setHeaderTypeModifier($modifier);
		
		$row->setDescription($this->getDescription($line,$row->getHeaderTypeCanonical()));
		$row->setValue($this->getValue($line,$row->getHeaderTypeCanonical()));
		
		return $row;
	}
	
	private function getHeaderType($line) {
		return substr($line, 1, 2);
	}
	
	private function getHeaderTypeModifier($line) {
		return substr($line, 3, 1);
	}
	
	private function getDescription($line, $headerTypeCanonical) {
		$desc = null;
		switch($headerTypeCanonical) {
			case RowH::TYPE_26:
				$desc = null;
			break;
			default: // 5-32
				$desc = trim(substr($line, 4, 28));
		}
		
		return $desc;
	}
	
	private function getValue($line, $headerTypeCanonical) {
		switch($headerTypeCanonical) {
			// Line sequence number: I5
			case RowH::TYPE_023:
				$value = trim(substr($line, 32, 48));
				if(!empty($value)) {
					$value = (int)$value;
				}
			break;
			case RowH::TYPE_26:
				$value = trim(substr($line, 4, 76));
				break;
			default:
				$value = trim(substr($line, 32, 48));
		}
		
		return $value;
	}
	
	private function makeFloat($string,$decimal) {
		$lead = substr($string,0 , -$decimal);
		$dec = substr($string, -$decimal);
		
		return (float)($lead.'.'.$dec);
	}
}
?>
