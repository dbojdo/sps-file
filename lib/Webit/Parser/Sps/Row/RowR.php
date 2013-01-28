<?php
namespace Webit\Parser\Sps\Row;
class RowR extends RowS {
	public function __construct($rowIndex) {
		parent::__construct($rowIndex);
		
		$this->type = self::ROW_TYPE_RECIVE;
	}
	
	/**
	 *
	 * @param RowX $rowX
	 * @return boolean
	 */
	public function isRelatedTo(RowX $rowX) {
		return $this->getLineName() == $rowX->getReciverLineName()
						&& $this->getPointNumber() >= $rowX->getFromReciver() 
						&& $this->getPointNumber() <= $rowX->getToReciver() 
						&& $this->getPointIndex() == $rowX->getReciverIndex(); // sprawdź ostatni warunek
	}
}
?>
