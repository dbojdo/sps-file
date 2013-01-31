<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\FixedWidth\Parser\Parser as FixedWidthParser;

use Webit\Parser\FixedWidth\RowConfig\YamlDriver;

class RowParserProvider implements RowParserProviderInterface {
	/**
	 * 
	 * @var string
	 */
	protected $definitionsDir;
	
	/**
	 * 
	 * @var Parser
	 */
	protected $fwParser;
	
	/**
	 * @var YamlDriver
	 */
	protected $driver;
	
	protected $parsers = array();
	
	public function __construct($definitionsDir = null) {
		$this->fwParser = new FixedWidthParser();
		$this->driver = new YamlDriver();
		
		$this->definitionsDir = $definitionsDir ?: realpath(__DIR__.'/../../../../../resources/row_definitions');
		
		$this->buildParsers();
	}

	private function buildParsers() {
		$hParser = new RowHParser($this->fwParser);
			$rowDef = $this->driver->buildRow($this->definitionsDir.'/RowH.yml');
			$hParser->registerRowDefinition($rowDef, 'H');
		
			$rowDef = $this->driver->buildRow($this->definitionsDir.'/RowH026.yml');
			$hParser->registerRowDefinition($rowDef, 'H026');
		$this->parsers['H'] = $hParser;
		
		$sParser = new RowParser($this->fwParser);
			$rowDef = $this->driver->buildRow($this->definitionsDir.'/RowSR.yml');
			$sParser->registerRowDefinition($rowDef, 'S');
		$this->parsers['S'] = $sParser;
		
		$rParser = new RowParser($this->fwParser);
			$rowDef = $this->driver->buildRow($this->definitionsDir.'/RowSR.yml');
			$rowDef->setResultType('Webit\Parser\Sps\Row\RowR');
			$rParser->registerRowDefinition($rowDef, 'R');
		$this->parsers['R'] = $rParser;
		
		$xParser = new RowParser($this->fwParser);
			$rowDef = $this->driver->buildRow($this->definitionsDir.'/RowX.yml');
			$xParser->registerRowDefinition($rowDef, 'X');
		$this->parsers['X'] = $xParser;
	}
	
	public function getRowParser($type) {
		if(!key_exists($type, $this->parsers)) {
			throw new \InvalidArgumentException('Type ' .$type.' not present in type map');
		}
		
		return $this->parsers[$type];
	}
}
?>
