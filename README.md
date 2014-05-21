ProyectoHC
==========

Proyecto Horario de clases
===========
1. Para un servicio local

      1.- Ir a la carpeta script database, e importar la base de datos (potsgresql)
      
      2.- Ir a la carpeta ProyectoHC -> applicaction -> config y modificar los parametros del archivo database.php
      
                dentro del if parte local 
                
            $db['default']['hostname'] = 'localhost';
            
            $db['default']['username'] = 'usernamePostgres';
            
            $db['default']['password'] = 'passPostgres';
            
            $db['default']['database'] = 'dbPostgres';
            
            $db['default']['dbdriver'] = 'postgre';
            
      3.- Una vez hecho eso puedes entrar con la siguiente direccion 

            localhost/Proyecto_HC/ 
            
            
2.- Para un servicio global   


      1.- Descargar el repositorio 
      
      2.- Verificar que en ProyectoHC -> applicaction -> config -> database.php existan los siguientes parametros
              dentro del else parte remota
              ***los parametros del servidor ya estan listos***
      
      3.- Una vez hecho eso puedes entrar con la siguiente direccion 
            server/Proyecto_HC/
            
              >>>> EL ARCHIVO DATABASE.PHP DETECTA SI SE ESTA LOCALMENTE O REMOTAMENTE, SOLO MODIFICAR LA PARTE LOCAL<<<<
