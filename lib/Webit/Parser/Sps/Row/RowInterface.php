<?php 
namespace Webit\Parser\Sps\Row;
use Webit\Parser\FixedWidth\File\FileRowInterface;

interface RowInterface extends FileRowInterface {
	const ROW_TYPE_HEADER = 'H';
	const ROW_TYPE_SOURCE = 'S';
	const ROW_TYPE_RECIVE = 'R';
	const ROW_TYPE_CROSS = 'X';
	
	public function getType();
	public function setType($type);
}
?>
