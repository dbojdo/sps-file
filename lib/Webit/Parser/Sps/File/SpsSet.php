<?php
namespace Webit\Parser\Sps\File;

use Webit\Parser\Sps\Row\RowH;
use Webit\Parser\Sps\Row\Row;

class SpsSet {
	/**
	 * 
	 * @var Sps
	 */
	private $sps;

	/**
	 *
	 * @var Xps
	 */
	private $xps;

	/**
	 * 
	 * @var Rps
	 */
	private $rps;

	public function __construct(Sps $sps, Xps $xps = null, Rps $rps = null) {
		$this->sps = $sps;
		$this->xps = $xps;
		$this->rps = $rps;
	}

	/**
	 * 
	 * @param Sps $sps
	 */
	public function setSps(Sps $sps) {
		$this->sps = $sps;
	}

	/**
	 * 
	 * @param Xps $xps
	 */
	public function setXps(Xps $xps) {
		$this->xps = $xps;
	}

	/**
	 * 
	 * @param Rps $rps
	 */
	public function setRps(Rps $rps) {
		$this->rps = $rps;
	}

	/**
	 * 
	 * @return \Webit\Parser\File\Sps\Sps
	 */
	public function getSps() {
		return $this->sps;
	}

	/**
	 * 
	 * @return \Webit\Parser\File\Sps\Xps
	 */
	public function getXps() {
		return $this->xps;
	}

	/**
	 * 
	 * @return \Webit\Parser\File\Sps\Rps
	 */
	public function getRps() {
		return $this->rps;
	}
	
	/**
	 * 
	 * @param SpsFileInterface $sps1
	 * @param SpsFileInterface $sps2
	 * @param SpsFileInterface $sps3
	 * 
	 * @return SpsSet
	 */
	static public function create(SpsFileInterface $sps1, SpsFileInterface $sps2 = null, SpsFileInterface $sps3 = null) {
		$factory = new SpsSetFactory();
		$spsSet = $factory->createSpsSet($sps1, $sps2, $sps3);
		
		return $spsSet;
	}
}
?>
