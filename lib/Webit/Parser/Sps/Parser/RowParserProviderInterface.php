<?php
namespace Webit\Parser\Sps\Parser;

interface RowParserProviderInterface {
	/**
	 * @param string $type
	 * @retrun RowParser
	 */
	public function getRowParser($type);
}
?>
