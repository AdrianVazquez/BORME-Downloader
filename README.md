<p align="center"><h1>BORME Downloader</h1></p>

## ¿Qué es BORME Downloader?

BORME Downloader es una pequeña aplicación web escrita en PHP usando el Framework Laravel que nos permite guardar una copia en txt del texto del pdf del BORME del gobierno español. (Actualmente hay que proporcionar la url del pdf del BORME que queremos guardar como txt).


[**Probar la aplicación**](http://morepagerank.com/BORME/public/)


## ¿Qué hace exactamente?

Descargar BORME al servidor:
1) Comprueba que la url proporcionada es valida (Dominio, tipo de archivo)
2) Intenta descargar el PDF del BORME
3) Si lo consigue, lo guarda en local
4) Obtenemos el texto del PDF y lo guardamos en un archivo TXT. Si todo ha ido bien, borramos el PDF

Visualización de BORMEs descargados:
1) Lista los BORMEs descargados
2) Permite visualizar en el navegador o descargar en un archivo TXT el BORME seleccionado

## Requisitos mínimos

1) PHP >= 7.1.3
2) OpenSSL PHP Extension
3) PDO PHP Extension
4) Mbstring PHP Extension
5) Tokenizer PHP Extension
6) XML PHP Extension
7) Ctype PHP Extension
8) JSON PHP Extension

## Instalación

Cambiamos el nombre al archivo .env.example a .env, y lo editamos:
1) Si estamos en producción, cambiamos APP_ENV a production.
2) En APP_URL indicamos la url donde la web va a estar visible
3) Asegurate de no dejar ningún espacio en el archivo .env

A continuación ejecutamos los siguientes comandos estando en la raíz del directorio donde se instale la aplicación
```sh
$ composer global selfupdate
$ composer install --optimize-autoloader
$ composer update
$ composer dump-autoload
$ php artisan config:cache
```

Si utilizas un servidor cpanel con una versión antigua de PHP "por defecto", puedes instalar la versión de PHP 7.1, poner la siguiente línea al principio del .htaccess:
```
AddType application/x-httpd-ea-php71 .php .php5 .phtml
```

Y ejecutar estos comandos:
```sh
/opt/cpanel/ea-php71/root/usr/bin/php /opt/cpanel/composer/bin/composer global selfupdate
/opt/cpanel/ea-php71/root/usr/bin/php /opt/cpanel/composer/bin/composer install --optimize-autoloader
/opt/cpanel/ea-php71/root/usr/bin/php /opt/cpanel/composer/bin/composer update
/opt/cpanel/ea-php71/root/usr/bin/php /opt/cpanel/composer/bin/composer dump-autoload
/opt/cpanel/ea-php71/root/usr/bin/php artisan config:cache

```

**Ten en cuenta que el directorio en el que apache debe buscar la web es /public/**

Para usar esta aplicación en un hosting compartido aconsejo utilizar este [pequeño manual](https://medium.com/laravel-news/the-simple-guide-to-deploy-laravel-5-application-on-shared-hosting-1a8d0aee923e)

## License

BORME Downloader & The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
