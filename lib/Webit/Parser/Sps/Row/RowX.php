<?php
namespace Webit\Parser\Sps\Row;

class RowX extends RowDataAbstract {
	/**
	 * 
	 * @var string
	 */
	protected $fieldTapeNumber;

	/**
	 * 
	 * @var int
	 */
	protected $fieldRecordNumber;

	/**
	 * 
	 * @var int
	 */
	protected $fieldRecordIncrement;

	/**
	 * 
	 * @var string
	 */
	protected $instrumentCode;

	/**
	 * 
	 * @var int
	 */
	protected $fromChannel;

	/**
	 * 
	 * @var int
	 */
	protected $toChannel;

	/**
	 * 
	 * @var int
	 */
	protected $channelIncrement;

	/**
	 * 
	 * @var float
	 */
	protected $reciverLineName;

	/**
	 * 
	 * @var float
	 */
	protected $fromReciver;

	/**
	 * 
	 * @var float
	 */
	protected $toReciver;

	/**
	 * 
	 * @var int
	 */
	protected $reciverIndex;

	public function __construct($rowIndex) {
		parent::__construct($rowIndex);

		$this->type = self::ROW_TYPE_CROSS;
	}

	public function isRelatedToRowS(RowS $rowS) {
		return $rowS->isRelatedTo($this);
	}

	public function isRelatedToRowR(RowR $rowR) {
		return $rowR->isRelatedTo($this);
	}

	public function getFieldTapeNumber() {
		return $this->fieldTapeNumber;
	}

	public function setFieldTapeNumber($fieldTapeNumber) {
		$this->fieldTapeNumber = $fieldTapeNumber;
	}

	public function getFieldRecordNumber() {
		return $this->fieldRecordNumber;
	}

	public function setFieldRecordNumber($fieldRecordNumber) {
		$this->fieldRecordNumber = $fieldRecordNumber;
	}

	public function getFieldRecordIncrement() {
		return $this->fieldRecordIncrement;
	}

	public function setFieldRecordIncrement($fieldRecordIncrement) {
		$this->fieldRecordIncrement = $fieldRecordIncrement;
	}

	public function getInstrumentCode() {
		return $this->instrumentCode;
	}

	public function setInstrumentCode($instrumentCode) {
		$this->instrumentCode = $instrumentCode;
	}

	public function getFromChannel() {
		return $this->fromChannel;
	}

	public function setFromChannel($fromChannel) {
		$this->fromChannel = $fromChannel;
	}

	public function getToChannel() {
		return $this->toChannel;
	}

	public function setToChannel($toChannel) {
		$this->toChannel = $toChannel;
	}

	public function getChannelIncrement() {
		return $this->channelIncrement;
	}
	
	public function setChannelIncrement($channelIncrement) {
		$this->channelIncrement = $channelIncrement;
	}
	
	public function getReciverLineName() {
		return $this->reciverLineName;
	}

	public function setReciverLineName($reciverLineName) {
		$this->reciverLineName = $reciverLineName;
	}

	public function getFromReciver() {
		return $this->fromReciver;
	}

	public function setFromReciver($fromReciver) {
		$this->fromReciver = $fromReciver;
	}

	public function getToReciver() {
		return $this->toReciver;
	}

	public function setToReciver($toReciver) {
		$this->toReciver = $toReciver;
	}

	public function getReciverIndex() {
		return $this->reciverIndex;
	}

	public function setReciverIndex($reciverIndex) {
		$this->reciverIndex = $reciverIndex;
	}
}
?>
