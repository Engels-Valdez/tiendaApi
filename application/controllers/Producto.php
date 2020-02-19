<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'libraries/REST_Controller.php' );
use Restserver\libraries\REST_Controller;

class Producto extends REST_Controller {

    public function __construct(){

        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

        parent::__construct();

        $this->load->database();

    }

    public function index_get(){

       $query = $this->db->query(' select * from producto ');

       $respuesta = array( 'error' => FALSE, 'productos' => $query->result_array() );

       $this->response( $respuesta, REST_Controller::HTTP_OK );

    }

    public function nombre_get( $nombre = false ){

        if( !$nombre ){

             $respuesta = array( 'error'=> true, 'mensaje'=> 'Debes especificar el producto');

             return $this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );

        }else{

            $query = $this->db->query( "select * from producto where nombre like '%$nombre%'" );

            $respuesta = array( 'error' => false, 'producto' => $query->result_array());

            $this->response($respuesta, REST_Controller::HTTP_OK);
        }

    }

    public function id_get( $id = false ){

        if( !$id ){

             $respuesta = array( 'error'=> true, 'mensaje'=> 'Debes especificar el producto');

             return $this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );

        }else{

            $query = $this->db->query( "select * from producto where id = '$id'" );

            $respuesta = array( 'error' => false, 'producto' => $query->result_array());

            $this->response($respuesta, REST_Controller::HTTP_OK);
        }

    }

}