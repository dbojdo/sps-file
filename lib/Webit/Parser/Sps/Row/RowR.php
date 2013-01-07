<?php
namespace Webit\Parser\Sps\Row;
class RowR extends RowS {
	public function __construct($rowIndex) {
		parent::__construct($rowIndex);
		
		$this->type = self::ROW_TYPE_RECIVE;
	}
}
?>
