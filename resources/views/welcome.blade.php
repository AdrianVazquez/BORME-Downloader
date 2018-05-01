@include('header')
                <div class="title m-b-md">
                    BORME Downloader
                </div>

                <div>
                       <form action="{{ route('descargar_pdf') }}" method="post">
                         {{ csrf_field() }}
                            <input type="text" name="pdf" placeholder="Escribe aquí la url: https://www.boe.es/borme/..." size="40">
                            <input type="submit" value="Procesar">
                       </form>
                </div>
 @include('footer')