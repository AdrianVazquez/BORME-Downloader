@include('header')
	<div class="texto">
		<div class="links">
    		<a href="{{ url('/') }}"> Volver al inicio (Procesar más pdfs del BORME)</a>
    	</div>
    	<h1> Lista de ficheros guardados:</h1>
    	<ul>
    	@foreach ($archivos_txt as $archivo)
    	<li><a href="{{ url('/') }}/txt/ver/?file={{$archivo}}" target="_blank">{{$archivo}}</a>  <a href="{{ url('/') }}/txt/descargar/?file={{$archivo}}">[Descargar]</a></li>
    	@endforeach
    	</ul>
    </div>
@include('footer')