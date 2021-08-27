<?php

namespace Celf\Core\model;

use Cose\model\impl\Entity;

use Cose\utils\Logger;

use Rasty\i18n\Locale;

/**
 * Abonado
 * 
 * @Entity @Table(name="celf_abonado")
 * 
 * @author Marcos
 */

class Abonado extends Entity{

	//variables de instancia.

	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $apellido;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	private $nombre;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $calle;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $numero;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $complemento;

	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $piso;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $depto;
	
	/**
	 * @Column(type="string", nullable=true)
	 * @var string
	 */
	private $telefono;
	
	/**
	 * @Column(type="integer", nullable=true)
	 * @var Categoria
	 */
	private $categoria;
	
	/** @Column(type="boolean") **/
	private $pbx;
		
	public function __construct(){
	}
	
	public function __toString(){
		 return $this->getApellido().', '.$this->getNombre();
	}


	

	public function getApellido()
	{
	    return $this->apellido;
	}

	public function setApellido($apellido)
	{
	    $this->apellido = $apellido;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getCalle()
	{
	    return $this->calle;
	}

	public function setCalle($calle)
	{
	    $this->calle = $calle;
	}

	public function getNumero()
	{
	    return $this->numero;
	}

	public function setNumero($numero)
	{
	    $this->numero = $numero;
	}

	public function getComplemento()
	{
	    return $this->complemento;
	}

	public function setComplemento($complemento)
	{
	    $this->complemento = $complemento;
	}

	public function getPiso()
	{
	    return $this->piso;
	}

	public function setPiso($piso)
	{
	    $this->piso = $piso;
	}

	public function getDepto()
	{
	    return $this->depto;
	}

	public function setDepto($depto)
	{
	    $this->depto = $depto;
	}

	public function getTelefono()
	{
	    return $this->telefono;
	}

	public function setTelefono($telefono)
	{
	    $this->telefono = $telefono;
	}

	public function getCategoria()
	{
	    return $this->categoria;
	}

	public function setCategoria($categoria)
	{
	    $this->categoria = $categoria;
	}

	public function getPbx()
	{
	    return $this->pbx;
	}

	public function setPbx($pbx)
	{
	    $this->pbx = $pbx;
	}
	
	public function getDomicilio()
	{
	    return $this->getCalle().' '.$this->getNumero().' '.$this->getPiso().' '.$this->getDepto();
	}
	
	public function getGuiaTelefonica()
	{
		$apellido = ($this->getNombre()!='')?$this->getApellido().', '.$this->getNombre():$this->getApellido();
		return '<tr><td width="616" height="20" valign="top"> <table border="0" cellpadding="5" cellspacing="8" bgcolor="#FFFFFF"  class="t11">
												<tr> 
													<td width="576" height="20" valign="top"> <table border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
															
															<tr> 
																<th width="576" height="20" valign="top" bgcolor="#FFFFFF" scope="col"><div align="left"><font color="#990000"><font color="#003366" size="2">'.$apellido.'</font></font></div></th>
																<th height="20" valign="top" bgcolor="#FFFFFF" scope="col"><div align="left"><font color="#990000"><font color="#003366" size="2">'.$this->getTelefono().'</font></font></div></th>
															</tr>
														</table></td>
												</tr>
											</table></td>
									</tr>
									<tr> 
										<td valign="top"> <table border="0" cellpadding="0" cellspacing="0">
												
												<tr> 
													<td width="616" valign="top"> 
														<table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF"  class="t11">
															
															<tr> 
																<td width="5" height="70" valign="top">&nbsp;</td>
																<td width="*" valign="top">
																	<p class="txtcentralgrisjust">'.$this->getDomicilio().'
																	<br><br>
																	'.Locale::localize("abonado.categoria").': '.Locale::localize( Categoria::getLabel( $this->getCategoria() ) ).'
																	<br><br>
																	'.Locale::localize("abonado.complemento").': '.$this->getComplemento().'<br><br></p>
																	</td>
																<td width="10" valign="top">&nbsp;</td>
															</tr>
														</table></td>
												</tr>
											</table></td>
									</tr>';	
	}
}
?>