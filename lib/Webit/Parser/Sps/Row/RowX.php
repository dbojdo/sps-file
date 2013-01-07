<?php
namespace Webit\Parser\Sps\Row;
class RowX extends Row {
	public function __construct($rowIndex) {
		parent::__construct($rowIndex);
		
		$this->type = self::ROW_TYPE_CROSS;
	}
}
?>
