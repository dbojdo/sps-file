<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\File\Xps;
use Webit\Parser\Sps\File\Rps;
use Webit\Parser\Sps\File\Sps;

use Webit\Parser\FixedWidth\RowConfig\YamlDriver;

use Webit\Parser\FixedWidth\Parser\PositionDef;

use Webit\Parser\Sps\File\SpsFileInterface;

use Webit\Parser\Sps\Row\RowInterface;

class Parser {
	/**
   * @var RowParserProviderInterface
	 */
	protected $rowParserProvider;
	
	/**
	 * 
	 * @var array
	 */
	protected $rowParsers = array();
	
	public function __construct(RowParserProviderInterface $rowParserProvider = null) {
		$this->rowParserProvider = $rowParserProvider ?: new RowParserProvider();
	}
	
	/**
	 * 
	 * @param string $filename
	 * @return SpsAbstract
	 */
	public function parse($filename) {
		$file = new \SplFileInfo($filename);
		$fh = fopen($file->getPathname(),'r');
		
		$arRows = array();
		$i = 0;
		while($line = fgets($fh)) {
			$line = trim($line);
			if(empty($line)) {
				$i++;
				continue;
			}
			
			$type = $this->getRowType($line);
			
			$rowParser = $this->rowParserProvider->getRowParser($type);

			$row = $rowParser->parse($line,$i);
			
			$arRows[] = $row;

			$i++;
		}
		fclose($fh);

		$sps = $this->buildSps($arRows, $file);
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
	
	protected function createSps($type, $pathname) {
		switch($type) {
			case RowInterface::ROW_TYPE_SOURCE:
				return new Sps($pathname);
			break;
			case RowInterface::ROW_TYPE_RECIVE:
				return new Rps($pathname);
			break;
			case RowInterface::ROW_TYPE_CROSS:
				return new Xps($pathname);
			break;
		}
		
		return null;
	}
	
	private function buildSps(array $arRows, \SplFileInfo $file = null) {
		$row = count($arRows) > 0 ? $arRows[count($arRows) - 1] : null;
		if(!$row || $row->getType() == RowInterface::ROW_TYPE_HEADER) {
			throw new \Exception('No sps data rows found.');
		}
		
		$sps = $this->createSps($row->getType(), ($file ? $file->getPathname() : null));
		
		if(!($sps instanceof SpsFileInterface)) {
			throw new \Exception('Cannot create SPS file for type: ' . $row->getType());
		}
		
		foreach($arRows as $row) {
			$sps->addRow($row);
		}
		
		return $sps;
	}
}
?>
