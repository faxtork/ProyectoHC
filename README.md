
Proyecto Horario de clases
===========
Intsrucciones de uso
1.- Descargar el repositorio y descomprimir en /var/www/ , con nombre ProyectoHC osea /var/www/ProyectoHC
    1.1.- hacer un chmod 777 -R ala carpeta ProyectoHC
2.- Descargar SubimeText3

    2.1.- Abrir sublime y  ir a view-> show console, se abrira una ventana abajo y pegar el siguiente codigo

          import urllib.request,os,hashlib; h = '7183a2d3e96f11eeadd761d777e62404' + 'e330c659d4bb41d3bdf022e94cab3cd0'; pf = 'Package Control.sublime-package'; ipp = sublime.installed_packages_path(); urllib.request.install_opener( urllib.request.build_opener( urllib.request.ProxyHandler()) ); by = urllib.request.urlopen( 'http://sublime.wbond.net/' + pf.replace(' ', '%20')).read(); dh = hashlib.sha256(by).hexdigest(); print('Error validating download (got %s instead of %s), please try manual install' % (dh, h)) if dh != h else open(os.path.join( ipp, pf), 'wb' ).write(by) 

    2.2.- cerrar sublime y abrir
    2.3.- presiona ctrl + shift + p  y digita install package enter y luego digita SFTP y enter
    2.4.- este se instalara
3.- hay un archivo cuando se descarga el repositorio llamado sftp-config.json
    este hace las conexiones sftp para la subida y bajada del proyecto que interactua con el servidor de informatica
    PD: en teoria a ustedes cuando modifiquen algo automaticamente se sube el server, ami me funciona asi
4.-http://146.83.181.9/~sesparza/ProyectoHC
5.-dudas aclarenclas ahoraaaa!              
