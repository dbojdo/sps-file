<?php
namespace Webit\Parser\Sps\Parser\RowH;

use Webit\Parser\Sps\Row\RowH;

interface RowHFactoryInterface {
	/**
	 * 
	 * @param string $canonicalType
	 * @return RowH
	 */
	public function createRow($canonicalType, $rowIndex);
}
?>
