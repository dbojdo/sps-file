<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\Row\Row;

use Webit\Parser\Sps\Sps;

class Parser {
	/**
	 * 
	 * @var array
	 */
	protected $rowParsers = array();
	
	public function __construct() {
		$this->registerRowParser(new RowHParser(), Row::ROW_TYPE_HEADER);
		$this->registerRowParser(new RowSParser(), Row::ROW_TYPE_SOURCE);
		$this->registerRowParser(new RowRParser(), Row::ROW_TYPE_RECIVE);
		$this->registerRowParser(new RowXParser(), Row::ROW_TYPE_CROSS);
	}	
	
	public function registerRowParser(RowParserInterface $rowParser, $type) {
		$this->rowParsers[$type] = $rowParser;
	}
	
	public function parse($filename) {
		$file = new \SplFileInfo($filename);
		$fh = fopen($file->getPathname(),'r');
		
		$sps = new Sps($file->getFilename());
		
		$i = 0;
		while($line = fgets($fh)) {
			$line = trim($line);
			if(empty($line)) {
				$i++;
				continue;
			}
			
			$type = $this->getRowType($line);
			$rowParser = $this->getRowParser($type);
			$row = $rowParser->parse($line,$i);
			$sps->addRow($row);

			$i++;
		}
		fclose($fh);
		
		return $sps;
	}
	
	private function getRowParser($type) {
		if(key_exists($type,$this->rowParsers)) {
			return $this->rowParsers[$type];
		}
		
		throw new \Exception('Cannot find parser for row type: '.$type);
	}
	
	private function getRowType($line) {
		return $line[0];
	}
}
?>
