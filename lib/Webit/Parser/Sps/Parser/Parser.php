<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\SpsAbstract;

use Webit\Parser\Sps\Xps;

use Webit\Parser\Sps\Rps;

use Webit\Parser\Sps\Sps;

use Webit\Parser\Sps\Row\Row;

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
	
	/**
	 * 
	 * @param string $filename
	 * @return SpsAbstract
	 */
	public function parse($filename) {
		$file = new \SplFileInfo($filename);
		$fh = fopen($file->getPathname(),'r');
		
		//$sps = new Sps($file->getPathname());
		
		$arRows = array();
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
			$arRows[] = $row;

			$i++;
		}
		fclose($fh);
		
		$sps = $this->buildSps($arRows);
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
	
	private function createSps($type, $pathname) {
		switch($type) {
			case Row::ROW_TYPE_SOURCE:
				return new Sps($pathname);
			break;
			case Row::ROW_TYPE_RECIVE:
				return new Rps($pathname);
			break;
			case Row::ROW_TYPE_CROSS:
				return new Xps($pathname);
			break;
		}
		
		return null;
	}
	
	private function buildSps(array $arRows, \SplFileInfo $file = null) {
		$row = count($arRows) > 0 ? $arRows[count($arRows) - 1] : null;
		if(!$row || $row->getType() == Row::ROW_TYPE_HEADER) {
			throw new \Exception('No sps data rows found.');
		}
		
		$sps = $this->createSps($row->getType(), ($file ? $file->getPathname() : null));
		if(!$sps) {
			throw new \Exception('Cannot create SPS file for type: ' . $row->getType());
		}
		
		foreach($arRows as $row) {
			$sps->addRow($row);
		}
		
		return $sps;
	}
}
?>
