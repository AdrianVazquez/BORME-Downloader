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
    	$archivo = $request->input("pdf");
    	try{
	        Storage::disk('public')->put('BORME.pdf', fopen($archivo, 'r'));
	        return redirect()->route('ver_pdf', [], 301);
    	}catch(Exception $e){
    		die("Error en la descarga:".$e);
    	}
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
		$parser = new \Smalot\PdfParser\Parser();
		$pdf    = $parser->parseFile('./BORME.pdf');
		 
		$text = $pdf->getText();
		 
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
