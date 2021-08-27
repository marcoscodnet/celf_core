<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de Necrologica
 *  
 * @author Marcos
 *
 */
class FacturaCriteria extends Criteria{

	private $suministro;
	
	

	public function getSuministro()
	{
	    return $this->suministro;
	}

	public function setSuministro($suministro)
	{
	    $this->suministro = $suministro;
	}
}