<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Storage;
use Response;

class BormeDownloader extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//Obtenemos todos los archivos almacenados
       $archivos = Storage::disk('local')->files();
       //Filtramos los archivos, y nos quedamos sólo con los txt
       $archivos_txt = array_filter($archivos, function ($item) {return strpos($item, 'txt');});
       //Les quitamos la extensión
       $archivos_txt = array_map(function ($item){return substr($item,0, -4);}, $archivos_txt);
       //Mostramos la vista
       return View::make("listTxt", compact('archivos_txt'));
    }

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadBorme(Request $request)
    {
     //Obtenemos el valor _POST del campo pdf de nuestro formulario
    	$url_archivo = $request->input("pdf");
    	//Comprobamos que tenga https, y sino se la añadimos
    	if(strpos($url_archivo, ':')===false){
    		$url_archivo = "https://".$url_archivo;
    	}

    	//Comprobamos que el dominio es exclusivamente el que queremos usar para descargar
    	if(strstr(parse_url($url_archivo, PHP_URL_HOST), 'www.boe.es')){
    		//Comprobamos que es un PDF 
    		$archivo = parse_url($url_archivo, PHP_URL_PATH);
    		if(strstr(substr($archivo, -4),'.pdf')){
    			$this->store($archivo, $url_archivo);
    			//Redirigimos a la lista de archivos guardados
				return redirect()->route('listar_txt', [], 301);
		    }else{
		    	//Si no es un PDF, mensaje de error
    		die("<h1>¡Error!</h1><br>Revisa la url, tienes que introducir la url del PDF del BORME.");
		    }
    	}else{
    		//En caso de intentar usar otro dominio para la descarga, mensaje de error
    		die("<h1>¡Error!</h1><br>Ojo, el dominio del que intentas descargar el BORME no es www.boe.es");
    	}	

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($archivo, $url_archivo)
    {

		    	//Intentamos realizar la descarga
		    	try{

					//Obtenemos el nombre original del PDF y le quitamos la extensión
					$nombre_archivo = basename($archivo, '.' . pathinfo($archivo, PATHINFO_EXTENSION));
		    		//Guardamos en disco el archivo PDF
			        Storage::disk('local')->put($nombre_archivo.'.pdf', fopen($url_archivo, 'r'));
			    }catch(\Exception $e){
		    		//En caso de error en la descarga, mensaje de error
		    		die("Error en la descarga");
		    	}

		    	try{
					//Usamos la clase PDFParse
					$parser = new \Smalot\PdfParser\Parser();
					//Abrimos el PDF guardado anteriormente
					$pdf    = $parser->parseFile('../storage/app/'.$nombre_archivo.'.pdf');
					//Obtenemos el texto del PDF
					$texto = $pdf->getText();
					//Guardamos el texto en un archivo TXT con el nombre original del PDF
			        Storage::disk('local')->put($nombre_archivo.".txt", $texto);
		    	}catch(\Exception $e){
		    		//En caso de error en la descarga, mensaje de error
		    		die("Problema al transformar a PDF, hemos conservado el PDF original.");
		    	}
		    	//Si no ha habido ningún problema, borramos el pdf
		    	Storage::disk('local')->delete($nombre_archivo.'.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	//Nombre archivo
    	$nombre_archivo = $request->input("file");
    	$existencia = Storage::disk('local')->exists($nombre_archivo.'.txt');
    	if($existencia){
			//Abrimos el txt guardado anteriormente
			$texto = Storage::disk('local')->get($nombre_archivo.'.txt');
			//Mostramos el texto por pantalla
			dd($texto);
		} else {
			die("El archivo no existe en nuestros sistemas. Prueba a descargarlo antes");
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        //Nombre archivo
    	$nombre_archivo = $request->input("file");
    	$existencia = Storage::disk('local')->exists($nombre_archivo.'.txt');
    	if($existencia){
			//Abrimos el txt guardado anteriormente
			$texto = Storage::disk('local')->get($nombre_archivo.'.txt');
			//Nombre del archivo a descargar
    		$nombre_descarga = $nombre_archivo.'.txt';

		    // Creamos los headers para generar la descarga
		    $headers = [
		      'Content-type' => 'text/plain', 
		      'Content-Disposition' => sprintf('attachment; filename="%s"', $nombre_descarga),
		      'Content-Length' => strlen($texto)
		    ];

		    // Enviamos la respuesta al navegador con el contenido y los headers
		    return Response::make($texto, 200, $headers);
		} else {
			die("El archivo no existe en nuestros sistemas. Prueba a descargarlo antes");
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
