<?php

namespace Matudelatower\UbicacionBundle\Services;

/**
 * Created by PhpStorm.
 * User: matias
 * Date: 18/5/16
 * Time: 6:38 PM
 */
class UbicacionConfigurator {

	/**
	 * @var $template template base para las views
	 */
	private $template;

	public function __construct( $template ) {
		$this->template = $template;
	}

	/**
	 * @return mixed
	 */
	public function getTemplate() {
		return $this->template;
	}
}
