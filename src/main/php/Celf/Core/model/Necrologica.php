<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

use Celf\Core\utils\CelfUtils;

/**
 * Necrologica
 * 
 * @Entity @Table(name="celf_necrologica")
 * 
 * @author Marcos
 */

class Necrologica extends Entity{

	

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;

	/**
	 * @Column(type="text", nullable=true)
	 * @var text
	 */
	private $texto;
	

	/**
	 * @Column(type="datetime")
	 * @var \Datetime
	 */
	private $fecha;
    

	
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getNombre().' Fecha: '.$this->getFecha()->format("d/m/Y");
	}


	

	
	
	

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	

	public function getTexto()
	{
	    return $this->texto;
	}

	public function setTexto($texto)
	{
	    $this->texto = $texto;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}
	
	public function getVerNecrologica()
	{
		
		return '<div class="fusion-fullwidth fullwidth-box nonhundred-percent-fullwidth" style="background-color: #ffffff;background-position: center center;background-repeat: no-repeat;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
					<div class="fusion-builder-row fusion-row "><div class="fusion-layout-column fusion_builder_column fusion_builder_column_1_1  fusion-one-full fusion-column-first fusion-column-last 1_1" style="margin-top:0px;margin-bottom:0px;">
					<div class="fusion-column-wrapper" style="background-position:left top;background-repeat:no-repeat;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;" data-bg-url="">
						<div class="fusion-title title fusion-title-size-three" style="margin-top:0px;margin-bottom:10px;">
							<h3 class="title-heading-left" data-fontsize="20" data-lineheight="29"><strong>'.CelfUtils::formatDateStr( $this->getFecha()) .'</strong></h3>
							<div class="title-sep-container"><div class="title-sep sep-single sep-solid" style="border-color:#ff9800;">
							</div>
						</div>
					</div>
					<div class="fusion-title title fusion-sep-none fusion-title-size-four fusion-border-below-title" style="margin-top:0px;margin-bottom:10px;">
					<h4 class="title-heading-left" data-fontsize="18" data-lineheight="27">
						<span style="color: #7a7777;"><strong>'.$this->getNombre().'</strong>
						</span>
					</h4>
					</div><p>'.$this->getTexto().'</p>
					<div class="fusion-clearfix"></div>

				</div>
				</div></div></div>';	
	}
	
}
?>