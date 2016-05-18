<?php

namespace Matudelatower\UbicacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {
	public function getProvinciasAction( Request $request ) {

		$paisId     = $request->get( 'id' );
		$em         = $this->getDoctrine()->getManager();
		$pais       = $em->getRepository( 'UbicacionBundle:Pais' )->find( $paisId );
		$provincias = $em->getRepository( 'UbicacionBundle:Provincia' )->findByPais( $pais );

		if ( ! $provincias ) {
			$provincias = array();
		}

		return $this->render( 'UbicacionBundle:Ajax:provincias.html.twig',
			array( 'provincias' => $provincias ) );
	}

	public function getDepartamentosAction( Request $request ) {

		$provinciaId  = $request->get( 'id' );
		$em           = $this->getDoctrine()->getManager();
		$provincia    = $em->getRepository( 'UbicacionBundle:Provincia' )->find( $provinciaId );
		$departamentos = $em->getRepository( 'UbicacionBundle:Departamento' )->findByProvincia( $provincia );

		if ( ! $departamentos ) {
			$departamentos = array();
		}

		return $this->render( 'UbicacionBundle:Ajax:departamentos.html.twig',
			array( 'departamentos' => $departamentos ) );
	}

	public function getLocalidadesAction( Request $request ) {

		$departamentoId = $request->get( 'id' );
		$em             = $this->getDoctrine()->getManager();
		$departamento   = $em->getRepository( 'UbicacionBundle:Departamento' )->find( $departamentoId );
		$localidades    = $em->getRepository( 'UbicacionBundle:Localidad' )->findByDepartamento( $departamento );

		if ( ! $localidades ) {
			$localidades = array();
		}

		return $this->render( 'UbicacionBundle:Ajax:localidades.html.twig',
			array( 'localidades' => $localidades ) );
	}
}
