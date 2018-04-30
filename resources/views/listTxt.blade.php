@include('header')
	<div class="texto">
    	<a href="/"> Volver al inicio (Procesar más pdfs del BORME)</a>
    	<h1> Lista de ficheros guardados:</h1>
    	<ul>
    	@foreach ($archivos_txt as $archivo)
    	<li><a href="/txt/ver/?file={{$archivo}}" target="_blank">{{$archivo}}</a>  <a href="/txt/descargar/?file={{$archivo}}">[Descargar]</a></li>
    	@endforeach
    	</ul>
    </div>
@include('footer')