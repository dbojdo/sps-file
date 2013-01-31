<?php 
namespace Webit\Parser\Sps\File;

use Webit\Parser\FixedWidth\File\File;
use Webit\Parser\Sps\Row\Row;

abstract class SpsAbstract extends File implements SpsFileInterface {
	/**
	 * @return array
	 */
	public function getHeaders() {
		return $this->getRowsByType(RowInterface::ROW_TYPE_HEADER);
	}

	/**
	 *
	 * @param string $canonicalType
	 * @param bool $firstOnly
	 * @return array|NULL
	 */
	public function getHeaderByCanonicalType($canonicalType, $firstOnly = true) {
		$result = array_filter($this->rows,
				function ($row) use ($type) {
			return ($row instanceof RowH
					&& $row->getHeaderTypeCanonical() == $canonicalType);
		});

		if ($firstOnly) {
			$result = count($arResult) > 0 ? array_shift($arResult) : null;
		}

		return $result;
	}

	/**
	 *
	 * @param string $type
	 * @return array
	 */
	public function getRowsByType($type) {
		$arResult = array_filter($this->rows,
				function ($row) use ($type) {
			return $row->getType() == $type;
		});

		return $arResult;
	}

	/**
	 *
	 * @return DateTime|NULL
	 */
	public function getSurveyDateFrom() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_SURVEY);
		if ($value) {
			$arValue = explode(',', $value);
			return \DateTime::createFromFormat('d.m.Y', $arValue[0]);
		}

		return null;
	}

	/**
	 *
	 * @return DateTime|NULL
	 */
	public function getSurveyDataTo() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_SURVEY);
		if ($value) {
			$arValue = explode(',', $value);
			return \DateTime::createFromFormat('d.m.Y', $arValue[1]);
		}

		return null;
	}

	/**
	 *
	 * @return DateTime|NULL
	 */
	public function getIssueDate() {
		$value = $this->getHeaderByCanonicalType(RowH::TYPE_DATE_OF_ISSUE);
		if ($value) {
			return \DateTime::createFromFormat('d.m.Y', $value);
		}

		return null;
	}
	
	abstract function getSpsType();
}
?>