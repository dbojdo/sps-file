<?php
namespace Webit\Parser\Sps\Row;
use Webit\Parser\Sps\Row\RowX;

class RowS extends Row {
	const POINT_CODE_PM = 'PM';
	const POINT_CODE_KL = 'KL';

	/**
	 * 
	 * @var string(2)
	 */
	protected $pointCode;

	/**
	 * Min to max: -999 to 999
	 * @var int
	 */
	protected $staticCorrection;

	/**
	 * Min to max: 0 to 99.9
	 * @var float(4.1)
	 */
	protected $pointDepth;

	/**
	 * Min to max: -999 to 9999
	 * @var int
	 */
	protected $seismicDatum;

	/**
	 * Min to max: 0 to 99
	 * @var int
	 */
	protected $upholeTime;

	/**
	 * Min to max: 0 to 9999.9
	 * @var float(6.1)
	 */
	protected $waterDepth;

	/**
	 * 
	 * @var float(9.1)
	 */
	protected $mapGridEasting;

	/**
	 * 
	 * @var float(10.1)
	 */
	protected $mapGridNorthing;

	/**
	 * Min to max: -999.9 to 9999.9
	 * @var float(6.1)
	 */
	protected $surfaceElevation;

	/**
	 * Min to max: 1 to 999
	 * @var int
	 */
	protected $dayOfYear;

	/**
	 * Min to max: 000000 to 235959
	 * @var int
	 */
	protected $time;

	public function __construct($rowIndex) {
		parent::__construct($rowIndex);
		
		$this->type = self::ROW_TYPE_SOURCE;
	}

	public function getPointCode() {
		return $this->pointCode;
	}

	public function setPointCode($pointCode) {
		$this->pointCode = $pointCode;
	}

	public function getStaticCorrection() {
		return $this->staticCorrection;
	}

	public function setStaticCorrection($staticCorrection) {
		$this->staticCorrection = $staticCorrection;
	}

	public function getPointDepth() {
		return $this->pointDepth;
	}

	public function setPointDepth($pointDepth) {
		$this->pointDepth = $pointDepth;
	}

	public function getSeismicDatum() {
		return $this->seismicDatum;
	}

	public function setSeismicDatum($seismicDatum) {
		$this->seismicDatum = $seismicDatum;
	}

	public function getUpholeTime() {
		return $this->upholeTime;
	}

	public function setUpholeTime($upholeTime) {
		$this->upholeTime = $upholeTime;
	}

	public function getWaterDepth() {
		return $this->waterDepth;
	}

	public function setWaterDepth($waterDepth) {
		$this->waterDepth = $waterDepth;
	}

	public function getMapGridEasting() {
		return $this->mapGridEasting;
	}

	public function setMapGridEasting($mapGridEasting) {
		$this->mapGridEasting = $mapGridEasting;
	}

	public function getMapGridNorthing() {
		return $this->mapGridNorthing;
	}

	public function setMapGridNorthing($mapGridNorthing) {
		$this->mapGridNorthing = $mapGridNorthing;
	}

	public function getSurfaceElevation() {
		return $this->surfaceElevation;
	}

	public function setSurfaceElevation($surfaceElevation) {
		$this->surfaceElevation = $surfaceElevation;
	}

	public function getDayOfYear() {
		return $this->dayOfYear;
	}

	public function setDayOfYear($dayOfYear) {
		$this->dayOfYear = $dayOfYear;
	}

	public function getTime() {
		return $this->time;
	}

	public function setTime($time) {
		$this->time = $time;
	}
	
	/**
	 * 
	 * @param int $year
	 * @return \DateTime
	 */
	public function getDate($year) {
		$time = sprintf('%d %d %06d',$year, $this->getDayOfYear() - 1, $this->getTime());
		$format = 'Y z His';
		
		$date = \DateTime::createFromFormat($format, $time);
		
		return $date;
	}
	
	/**
	 * 
	 * @param RowX $rowX
	 * @return boolean
	 */
	public function isRelatedTo(RowX $rowX) {
		return $rowX->getLineName() == $this->getLineName() 
						&& $rowX->getPointNumber() == $this->getPointNumber() 
						&& $rowX->getPointIndex() == $this->getPointIndex();
	}
}
?>
