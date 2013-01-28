<?php 
namespace Webit\Parser\Sps;

use Webit\Parser\Sps\Row\RowX;
use Webit\Parser\Sps\Row\RowS;
use Webit\Parser\Sps\Row\RowR;
use Webit\Parser\Sps\Row\Row;

class Xps extends SpsAbstract {
	public function getType() {
		return Row::ROW_TYPE_CROSS;
	}
	
	/**
	 * @param RowS $rowS
	 * @return array
	 */
	public function getRowsForRowS(RowS $rowS) {
		$arRowsX = array_filter($this->rows,function($rowX) use ($rowS){
			if($rowX->getType() != Row::ROW_TYPE_CROSS) {
				return false;
			}
			
			return $rowS->isRelatedTo($rowX);
		});
		
		return $arRowsX;
	}
	
	/**
	 * @param RowR $rowR
	 * @return array
	 */
	public function getRowsForRowR(RowR $rowR) {
		$arRowsX = array_filter($this->rows,function($rowX) use ($rowR){
			if($rowX instanceof RowX) {
				return $rowR->isRelatedTo($rowX);
			}
			
			return false;
		});
	
		return $arRowsX;
	}
}
?>
