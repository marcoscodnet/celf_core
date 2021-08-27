<?php
namespace Celf\Core\criteria;

use Cose\criteria\impl\Criteria;

/**
 * criteria de novedad
 *  
 *  @author Marcos
 * @since 17-07-2020
 *
 */
class NovedadReclamoCriteria extends Criteria{

	private $fecha;

	

	private $reclamo;
	
	
	private $procesado;
	
	

	

	

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getReclamo()
    {
        return $this->reclamo;
    }

    public function setReclamo($reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function getProcesado()
    {
        return $this->procesado;
    }

    public function setProcesado($procesado)
    {
        $this->procesado = $procesado;
    }
}