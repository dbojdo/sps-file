<?php
namespace Webit\Parser\Sps\Parser;

use Webit\Parser\Sps\Row\RowS;

class RowSParser extends AbstractRowParser {
	/**
	 * (non-PHPdoc)
	 * @see Webit\Parser\Sps\Parser.AbstractRowParser::parse()
	 */	
	public function parse($line, $rowIndex) {
		$row = new RowS($rowIndex);
			$row->setSourceString($line);
			$line = rtrim($line,';');
			
			$row->setLineName($this->getLineName($line));
			$row->setPointNumber($this->getPointNumber($line));
			$row->setPointIndex($this->getPointIndex($line));
			$row->setPointCode($this->getPointCode($line));
			$row->setStaticCorrection($this->getStaticCorrection($line));
			$row->setPointDepth($this->getPointDepth($line));
			$row->setSeismicDatum($this->getSeismicDatum($line));
			$row->setUpholeTime($this->getUpholeTime($line));
			$row->setWaterDepth($this->getWaterDepth($line));
			$row->setMapGridEasting($this->getMapGridEasting($line));
			$row->setMapGridNorthing($this->getMapGridNorthing($line));
			$row->setSurfaceElevation($this->getSurfaceElevation($line));
			$row->setDayOfYear($this->getDayOfYear($line));
			$row->setTime($this->getTime($line));
			
		return $row;
	}
	
	/**
   * Line name 2-11 (right) F10.2 -999999.99 9999999.99 
   * @param string $line
   * @return float
	 */
	protected function getLineName($line) {
		$line = trim(substr($line, 1, 10));
		if($line) {
			$line = (float)$line;
		}
		
		return $line;
	}
	
	/**
   * Point number 12-21 (right) F10.2 -999999.99 to 9999999.99
   * @param string $line
   * @return float
	 */
	protected function getPointNumber($line) {
		$number = trim(substr($line, 11, 10));
		if($number) {
			$number = (float)$number;
		}
		
		return $number;
	}
	
	/**
   * Point index 24-24 (right) I1 1 to 9
   * @param string $line
   * @return int
	 */
	protected function getPointIndex($line) {
		$index = trim(substr($line, 23, 1));
		if($index) {
			$index = (int)$index;
		}
	
		return $index;
	}
	
	/**
   * Point code 25-26 (left) A2
   * @param string $line
   * @return string
	 */
	protected function getPointCode($line) {
		$code = trim(substr($line, 24, 2));
		
		return $code;
	}
	
	/**
   * Static correction 27-30 (right) I4 -999 to 999
   * @param string $line
   * @return int
	 */
	protected function getStaticCorrection($line) {
		$corr = trim(substr($line, 26, 4));
		if($corr) {
			$corr = (int)$corr;
		}
		
		return $corr;
	}
	
	/**
   * Point depth 31-34 (right) F4.1 0 to 99.9
   * @param string $line
   * @return float
	 */
	protected function getPointDepth($line) {
		$depth = trim(substr($line, 30, 4));
		if($depth) {
			$depth = (float)$depth;
		}
		
		return $depth;
	}
	
	/**
   * Seismic datum 35-38 (right) I4 -999 to 9999
   * @param string $line
   * @return int
	 */
	protected function getSeismicDatum($line) {
		$datum = trim(substr($line, 34, 4));
		if($datum) {
			$datum = (int)$datum;
		}
		
		return $datum;
	}
	
	/**
	 * Uphole time 39-40 (right) I2 0 to 99
	 * @param string $line
	 * @return int
	 */
	protected function getUpholeTime($line) {
		$time = trim(substr($line, 38,2));
		if($time) {
			$time = (int)$time;
		}
		
		return $time;
	}

	/**
	 * Water depth 41-46 (right) F6.1 0 to 9999.9
	 * @param string $line
	 * @return float
	 */
	protected function getWaterDepth($line) {
		$depth = trim(substr($line, 40,6));
		if($depth) {
			$depth = (float)$depth;
		}
		
		return $depth;
	}
	
	/**
	 * Map grid easting 47-55 F9.1 none none right
	 * @param string $line
	 * @return float
	 */
	protected function getMapGridEasting($line) {
		$east = trim(substr($line, 46,9));
		if($east) {
			$east = (float)$east;
		}
		
		return $east;
	}
	
	/**
	 * Map grid northing 56-65 F10.1 none none right
   * @param string $line
   * @return float
	 */
	protected function getMapGridNorthing($line) {
		$nor = trim(substr($line, 55,10));
		if($nor) {
			$nor = (float)$nor;
		}
		
		return $nor;
	}
	
	/**
	 * Surface elevation 66-71 F6.1 -999.9 to 9999.9 none right header
	 * @param string $line
	 * @return float
	 */
	protected function getSurfaceElevation($line) {
		$elev = trim(substr($line, 65,6));
		if($elev) {
			$elev = (float)$elev;
		}
		
		return $elev;
	}
	
	/**
	 * Day of year 72-74 I3 1 to 999 none right
	 * @param string $line
	 * @return int
	 */
	protected function getDayOfYear($line) {
		$doy = trim(substr($line, 71,3));
		if($doy) {
			$doy = (int)$doy;
		}
		
		return $doy;
	}
	
	/**
	 * Time “hhmmss” 75-80 3I2 000000 to 235959
	 * @param string $line
	 * @return int
	 */
	protected function getTime($line) {
		$time = trim(substr($line, 74,6));
		
		return $time;
	}
}
?>
