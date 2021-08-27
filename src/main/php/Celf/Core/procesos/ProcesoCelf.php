<?php
namespace Celf\Core\procesos;


use Celf\Core\conf\CelfConfig;

use Celf\Core\service\ServiceFactory;

use Cose\Security\model\Usergroup;
use Cose\Security\model\User;

use Cose\utils\CoseUtils;
use Cose\persistence\PersistenceContext;

use Celf\Core\conf\CelfTestEnviroment;
use Celf\Core\conf\CelfLocalEnviroment;

/**
 * Proceso genérico
 *
 * inicializamos el contexto 
 * 
 * @author Marcos
 * @since 17-07-2020
 */
abstract class ProcesoCelf {

	private $logPath;
	
	public function process($cronPath){

		$this->init($cronPath);
		
		$persistenceContext =  PersistenceContext::getInstance();
		
		$this->doProcess();
		
		$persistenceContext->close();
	}
	
	protected  function init( $cronPath ){

		$this->setLogPath("$cronPath");
		
		
		CelfConfig::getInstance()->initialize();
		
	
		
		
	}
	
	
	protected abstract function doProcess();
		

	public function getLogPath()
	{
	    return $this->logPath;
	}

	public function setLogPath($logPath)
	{
	    $this->logPath = $logPath;
	}
}
