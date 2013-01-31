<?php
use Webit\Parser\Sps\File\SpsSet;

namespace Webit\Parser\Sps\File;

class SpsSetFactory {
	/**
	 * @var array
	 */
	private $types = array('S'=>null,'X'=>null,'R'=>null);
	
	/**
	 * 
	 * @param SpsFileInterface $sps1
	 * @param SpsFileInterface $sps2
	 * @param SpsFileInterface $sps3
	 * @return \Webit\Parser\Sps\File\SpsSet
	 */
	public function createSpsSet(SpsFileInterface $sps1, SpsFileInterface $sps2 = null, SpsFileInterface $sps3 = null) {		
		if($sps3) {
			$this->checkType($sps3);
			$this->types[$sps3->getSpsType()] = $sps3;
		}
		
		if($sps2) {
			$this->checkType($sps2);
			$this->types[$sps2->getSpsType()] = $sps2;
		}
		
		$this->checkType($sps1);
		$this->types[$sps1->getSpsType()] = $sps1;
		
		$spsSet = new SpsSet($this->types['S'], $this->types['X'], $this->types['R']);
		
		return $spsSet;
	}
	
	private function checkType(SpsFileInterface $sps) {
		$type = $sps->getSpsType();
		if(!key_exists($type, $this->types)) {
			throw new \InvalidArgumentException('SPS File type '.$type.' is not allowed.');
		}
			
		if($this->types[$type]) {
			throw new \InvalidArgumentException('SPS File type '.$type.' has already beed added.');
		}
		
		return true;
	}
}
?>
