<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\FixedWidth\Parser\Parser as FixedWidthParser;

use Webit\Parser\FixedWidth\Parser\PositionDef;

use Webit\Parser\FixedWidth\RowConfig\YamlDriver;

use Webit\Parser\FixedWidth\Parser\RowDef;
use Webit\Parser\Sps\Parser\RowH\RowHFactory;
use Webit\Parser\Sps\Parser\RowH\RowHFactoryInterface;
use Webit\Parser\Sps\Row\RowH;

class RowHParser extends RowParser {	
	protected function getRowDefinition($line, $rowIndex) {
		$position = new PositionDef();
			$position->setStart(1);
			$position->setEnd(4);
			
		$rowType = $this->fwParser->parsePosition($line, $position);
		if(key_exists($rowType, $this->rowDefs)) {
			return $this->rowDefs[$rowType];
		}

		return $this->rowDefs['H'];
	}
}
?>
