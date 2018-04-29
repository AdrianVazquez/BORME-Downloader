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
    	$archivo = $request->input("pdf");
    	//Comprobamos que tenga https, y sino se la añadimos
    	if(strpos($archivo, ':')===false){
    		$archivo = "https://".$archivo;
    	}

    	//Comprobamos que el dominio es exclusivamente el que queremos usar para descargar
    	if(strstr(parse_url($archivo, PHP_URL_HOST), 'www.boe.es')){
    		//Comprobamos que es un PDF 
    		if(strstr(substr(parse_url($archivo, PHP_URL_PATH), -4),'.pdf')){
		    	//Intentamos realizar la descarga
		    	try{
		    		//Guardamos en disco el archivo PDF
			        Storage::disk('public')->put('BORME.pdf', fopen($archivo, 'r'));
			        //Redirigimos al visor de pdfs
			        return redirect()->route('ver_pdf', [], 301);
		    	}catch(\Exception $e){
		    		//En caso de error en la descarga, mensaje de error
		    		die("Error en la descarga");
		    	}
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
