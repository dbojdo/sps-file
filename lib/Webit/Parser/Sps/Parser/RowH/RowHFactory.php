<?php
namespace Webit\Parser\Sps\Parser\RowH;

use Webit\Parser\Sps\Row\RowH;

class RowHFactory implements RowHFactoryInterface {
	
	/**
	 * 
	 * @param string $canonicalType
	 * @param int $rowIndex
	 * @return RowH
	 */
	public function createRow($canonicalType, $rowIndex) {
		switch($canonicalType) {
			default:
				$row = new RowH($rowIndex);
		}
		
		return $row;
	}
}
?>
