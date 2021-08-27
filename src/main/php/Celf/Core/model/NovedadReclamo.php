<?php
namespace Celf\Core\model;

use Cose\model\impl\Entity;
use Celf\Core\utils\CelfUtils;


/**
 * Instancia Reclamo
 *
 * @Entity @Table(name="celf_novedades_reclamo")
 */
class NovedadReclamo extends Entity{
   

   

   
    
    /**
     * @var \DateTime|null
     *
     * @Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;
    
   
    
    /**
     * @var string|null
     *
     * @Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;
    
   

    /**
     * @var \Reclamo
     *
     * @ManyToOne(targetEntity="Reclamo", cascade={"remove"})
     * @JoinColumns({
     *   @JoinColumn(name="reclamo_oid", referencedColumnName="oid")
     * })
     */
    private $reclamo;

   
    
    /**
     * @var \Estado
     *
     * @ManyToOne(targetEntity="EstadoReclamo")
     * @JoinColumns({
     *   @JoinColumn(name="estado_oid", referencedColumnName="oid")
     * })
     */
    private $estadoReclamo;
    
    /** @Column(type="boolean") **/
	private $procesado;
    
  
	public function __construct(){
	}

	

    
    

	



    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    public function getReclamo()
    {
        return $this->reclamo;
    }

    public function setReclamo($reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function getEstadoReclamo()
    {
        return $this->estadoReclamo;
    }

    public function setEstadoReclamo($estadoReclamo)
    {
        $this->estadoReclamo = $estadoReclamo;
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
