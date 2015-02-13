<?php 
            $parametros = array();
            $parametros['rut'] = '17.680.010-0';
            $parametros['password'] = '0685c94db7b73564b6d9b1c2f98ea88f5be4c449611d7a73d70d9783de6205b3';

            // usuario de webService
            $autenticacion = array('login' => '17.680.010-0',
                'password' => '3e6866191180ee47202970f0518db0e1778d0c6c');

            $cliente = new SoapClient("https://sepa.utem.cl/saap-rest/api?_wadl", $autenticacion);
            var_dump($cliente);
            $parametros['rut'] = '17.680.010-0';
            $parametros['password'] = '0685c94db7b73564b6d9b1c2f98ea88f5be4c449611d7a73d70d9783de6205b3';

            // usuario de webService
            $autenticacion = array('login' => 'sesparza',
                'password' => '54d6b211811cf8a22a735d3d071299ad94419900');

            $cliente = new SoapClient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl", $autenticacion);
        $objeto = $cliente->autenticar($parametros);
            var_dump($objeto);
 ?>