<?php
namespace Webit\Parser\Sps\Row;
use Webit\Parser\FixedWidth\File\FileRow;

class RowH extends FileRow implements RowInterface {
	const TYPE_DATE_OF_SURVEY = '02';
	const TYPE_DATE_OF_ISSUE = '021';

	const TYPE_023 = '023';
	const TYPE_26 = '26';

	/**
	 * 
	 * @var string
	 */
	protected $type;

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
	protected $value;

	public function __construct($rowIndex) {
		parent::__construct($rowIndex);

		$this->type = RowInterface::ROW_TYPE_HEADER;
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

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}
}
?>
