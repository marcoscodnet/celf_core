<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

use Celf\Core\utils\CelfUtils;

/**
 * Factura
 * 
 * 
 * 
 * @author Marcos
 */

class Factura extends Entity{

	

	
	private $suministro;


	
	public function getVerFactura()
	{
		
		return '<div class="fusion-fullwidth fullwidth-box nonhundred-percent-fullwidth" style="background-color: #ffffff;background-position: center center;background-repeat: no-repeat;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
					<div class="fusion-builder-row fusion-row "><div class="fusion-layout-column fusion_builder_column fusion_builder_column_1_1  fusion-one-full fusion-column-first fusion-column-last 1_1" style="margin-top:0px;margin-bottom:0px;">
					
					<div class="fusion-title title fusion-sep-none fusion-title-size-four fusion-border-below-title" style="margin-top:0px;margin-bottom:10px;">
					
					</div><p>'.$this->getSuministro().'</p>
					<div class="fusion-clearfix"></div>

				</div>
				</div></div></div>';	
	}
	

	public function getSuministro()
	{
	    return $this->suministro;
	}

	public function setSuministro($suministro)
	{
	    $this->suministro = $suministro;
	}
}
?>