<?php 
namespace Webit\Parser\Sps\File;

use Webit\Parser\Sps\Row\RowInterface;

use Webit\Parser\Sps\Row\RowX;
use Webit\Parser\Sps\Row\RowS;
use Webit\Parser\Sps\Row\Row;

class Sps extends SpsAbstract {
	public function getSpsType() {
		return RowInterface::ROW_TYPE_SOURCE;
	}
	
	public function getRowsFor(RowX $rowX) {
		$arRows = array_filter($this->rows,function($rowS) use ($rowX) {
			if($rowS instanceof RowS) {
				return $rowS->isRelatedTo($rowX);
			}
			
			return false;
		}); 
		
		return $arRows;
	}
}
?>
