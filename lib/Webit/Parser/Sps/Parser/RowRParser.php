<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\Row\RowR;

class RowRParser extends RowSParser {
	protected function createRow($rowIndex) {
		return new RowR($rowIndex);
	}
}
?>
