<p align="center"><h1>BORME Downloader</h1></p>

## ¿Qué es BORME Downloader?

BORME Downloader es una pequeña aplicación web escrita en PHP usando el Framework Laravel que nos permite guardar una copia en txt del texto del pdf del BORME del gobierno español. (Actualmente hay que proporcionar la url del pdf del BORME que queremos guardar como txt).

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

Para usar esta aplicación en un hosting compartido aconsejo utilizar este [pequeño manual](https://medium.com/laravel-news/the-simple-guide-to-deploy-laravel-5-application-on-shared-hosting-1a8d0aee923e)

## License

BORME Downloader & The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
