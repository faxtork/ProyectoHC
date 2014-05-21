<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Copyright (C) 2014 Gente Rata S.A
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Description of ws_dirdoc
 *
 * @author pperez
 * @author ssalazar
 */
class WS_Dirdoc {

    private function verificar($datos) {
        return trim(strip_tags($datos));
    }

    /**
     * 
     * @author Sebastián Salazar Molina <sebasalazar@gmail.com>
     * @param string $rut
     * @param string $contrasena
     * @return boolean
     * Valida contra el webservices de la unidad de informática, si el rut (con dígito verificador) 
     * y la contraseña proporcionada (en mayúsculas y hasheada en sha256) es válida o no lo es.
     */
    function autenticar($rut, $contrasena) {
        $resultado = false;

        try {

            // Creacion de un arreglo con los parámetros de entrada.
            $parametros = array();
            $parametros['rut'] = $rut;
            $parametros['password'] = $contrasena;

            $CI = & get_instance();
            $login = $CI->config->item('dirdoc_ws_user');
            $pw = $CI->config->item('dirdoc_ws_password');
            $url = $CI->config->item('dirdoc_ws_url');

            // usuario de webService
            $autenticacion = array('login' => $login,
                'password' => $pw);

            $cliente = new SoapClient($url, $autenticacion);
            $objeto = $cliente->autenticar($parametros);
            $codigo = (int) $objeto->return->codigo;
            $descripcion = (string) $this->verificar($objeto->return->descripcion);

            if ($codigo > 0) {
                $resultado = true;
            } else {
                error_log("Servicio WEB respondió: $descripcion ($codigo)");
            }
        } catch (Exception $e) {
            $resultado = false;
            error_log("Error en autenticacion: {$e->getMessage()}");
        }
        return $resultado;
    }

    /**
     * @author pperez
     * @param string rut
     * @return array
     * Retorna los datos de un estudiante
     */
    function getEstudiante($rut) {
        $resultado = array();

        try {
            // Creacion de un arreglo       
            $parametros = array();
            $parametros['rut'] = $rut;

            $CI = & get_instance();
            $login = $CI->config->item('dirdoc_ws_user');
            $pw = $CI->config->item('dirdoc_ws_password');
            $url = $CI->config->item('dirdoc_ws_url');

            // usuario de webService
            $autenticacion = array('login' => $login,
                'password' => $pw);

            $cliente = new SoapClient($url, $autenticacion);
            $objeto = $cliente->consultarFichasEstudiantes($parametros);
            if (!array_key_exists('return', $objeto)) { // Veo si hay respuesta!
                $resultado = array(); // Vacio ...
            } else {
                if (is_array($objeto->return)) { // Veo si hay más de un match
                    $resultado = $objeto->return[0]; // Obtengo la info del ultimo ingreso
                } // Ruego porque esta sea la ultima la verdad ...
                else { // Si no es un array, es el objeto en si
                    $resultado = $objeto->return;
                }
            }
        } catch (Exception $e) {
            $resultado = array();
            error_log("Error en autenticacion: {$e->getMessage()}");
        }
        return $resultado;
    }

    /**
     * @author pperez
     * @param string rut
     * @return array
     * Retorna los datos de un estudiante
     */
    function getAcademico($rut) {
        $resultado = array();

        try {
            // Creacion de un arreglo       
            $parametros = array();
            $parametros['rut'] = $rut;

            $CI = & get_instance();
            $login = $CI->config->item('dirdoc_ws_user');
            $pw = $CI->config->item('dirdoc_ws_password');
            $url = $CI->config->item('dirdoc_ws_url');

            // usuario de webService
            $autenticacion = array('login' => $login,
                'password' => $pw);

            $cliente = new SoapClient($url, $autenticacion);
            $objeto = $cliente->consultarDocente($parametros);
            if (!array_key_exists('return', $objeto)) { // Veo si hay respuesta!
                $resultado = array(); // Vacio ...
            } else {
                if (is_array($objeto->return)) { // Veo si hay más de un match
                    $resultado = $objeto->return[0]; // Obtengo la info del ultimo ingreso
                } // Ruego porque esta sea la ultima la verdad ...
                else { // Si no es un array, es el objeto en si
                    $resultado = $objeto->return;
                }
            }
        } catch (Exception $e) {
            $resultado = array();
            error_log("Error en autenticacion: {$e->getMessage()}");
        }
        return $resultado;
    }

    /**
     * 
     * @author Sebastián Salazar Molina <sebasalazar@gmail.com>
     * @param string $rut
     * @param int $semestre
     * @param int $anio
     * @return array
     * Retorna los cursos de un docente segun semestre y año
     */
    function cursos_semestre_anio($rut, $semestre, $anio) {
        $resultado = array();

        try {
            // Creacion de un arreglo       
            $parametros = array();
            $parametros['rut'] = $rut;
            $parametros['semestre'] = $semestre;
            $parametros['anio'] = $anio;

            $CI = & get_instance();
            $login = $CI->config->item('dirdoc_ws_user');
            $pw = $CI->config->item('dirdoc_ws_password');
            $url = $CI->config->item('dirdoc_ws_url');

            // usuario de webService
            $autenticacion = array('login' => $login,
                'password' => $pw);

            $cliente = new SoapClient($url, $autenticacion);
            $objeto = $cliente->consultarCursosPorRutDocenteYSemestre($parametros);
            $respuesta = $objeto->return;
            if (count($respuesta) > 1) {
                foreach ($respuesta as $obj) {
                    $resultado[] = (object) $obj;
                }
            } else {
                $resultado[] = $respuesta;
            }
        } catch (Exception $e) {
            $resultado = array();
            error_log("Error en autenticacion: {$e->getMessage()}");
        }
        return $resultado;
    }

}
