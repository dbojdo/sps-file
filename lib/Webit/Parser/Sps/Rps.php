<?php 
namespace Webit\Parser\Sps;

use Webit\Parser\Sps\Row\Row;
use Webit\Parser\Sps\Row\RowR;
use Webit\Parser\Sps\Row\RowX;

class Rps extends SpsAbstract {
	public function getType() {
		return Row::ROW_TYPE_RECIVE;
	}
	
	public function getRowsFor(RowX $rowX) {
		$arRows = array_filter($this->rows,function($rowR) use ($rowX) {
			if($rowR instanceof RowR) {
				return $rowR->isRelatedTo($rowX);
			}
			
			return false;
		});
	
		return $arRows;
	}
}
?>
