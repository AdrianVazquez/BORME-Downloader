<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class PdfParserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
		    	//Intentamos realizar la descarga
		    	//try{
		    		//Guardamos en disco el archivo PDF
			        Storage::disk('public')->put('BORME.pdf', fopen($url_archivo, 'r'));

			        //Usamos la clase PDFParse
					$parser = new \Smalot\PdfParser\Parser();
					//Abrimos el PDF guardado anteriormente
					$pdf    = $parser->parseFile('./BORME.pdf');
					//Obtenemos el texto del PDF
					$texto = $pdf->getText();
					//Obtenemos el nombre original del PDF y le quitamos la extensión
					$nombre_descarga = basename($archivo, '.' . pathinfo($archivo, PATHINFO_EXTENSION));
					//Guardamos el texto en un archivo TXT con el nombre original del PDF
			        Storage::disk('public')->put($nombre_descarga.".txt", $texto);

			        //Redirigimos al visor de pdfs
			        return redirect()->route('ver_pdf', [], 301);
		    	//}catch(\Exception $e){
		    		//En caso de error en la descarga, mensaje de error
		    	//	die("Error en la descarga");
		    	//}
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //Usamos la clase PDFParse
		$parser = new \Smalot\PdfParser\Parser();
		//Abrimos el PDF guardado anteriormente
		$pdf    = $parser->parseFile('./BORME.pdf');
		//Obtenemos el texto del PDF
		$text = $pdf->getText();
		//Mostramos el texto por pantalla
		dd($text);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
