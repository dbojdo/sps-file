<?php
namespace Webit\Parser\Sps\Row;
class RowH extends Row {
	const TYPE_DATE_OF_SURVEY = '02';
	const TYPE_DATE_OF_ISSUE = '021';
	
	const TYPE_023 = '023';
	const TYPE_26 = '26';	
	
	/**
	 * 
	 * @var string
	 */
	protected $headerType;

	/**
	 * 
	 * @var string
	 */
	protected $headerTypeModifier;
	
	/**
	 * 
	 * @var string
	 */
	protected $description;

	/**
	 * 
	 * @var mixed
	 */
	protected $value = array();

	public function __construct($rowIndex) {
		parent::__construct($rowIndex);
		
		$this->type = Row::ROW_TYPE_HEADER;
	}
	
	public function getHeaderType() {
		return $this->headerType;
	}

	public function setHeaderType($headerType) {
		$this->headerType = $headerType;
	}

	public function getHeaderTypeModifier() {
		return $this->headerTypeModifier;
	}

	public function setHeaderTypeModifier($headerTypeModifier) {
		$this->headerTypeModifier = $headerTypeModifier;
	}

	public function getHeaderTypeCanonical() {
		return $this->headerType . $this->headerTypeModifier;
	}
	
	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}
}
?>
