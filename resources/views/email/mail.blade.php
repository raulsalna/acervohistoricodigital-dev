<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>acervo</title>
    <style type="text/css">

    .header{
        background: #9f1e47;
        padding:10px;
    }
    .cintillo{
        background: #b69262;
        padding:2px;
    }
    .cuerpo{
        background: #f9f9f9;
        padding:50px;
    }
    .contenido{
        background:#f9f9f9;
        padding:10px;
    }
    .footer{
        background:#f9f9f9;
    }
    .break-word{
        word-break: break-all;
    }
    p{
        padding: 2px;
    }
    </style>

</head>
<body>

     <div class="header">
        <div style="text-align: left; padding:5px;">
             <img  width="10%" height="10%" src="{{ $message->embed(public_path().'/img/logo.png') }}" alt="">
        </div>
    </div>
    <div class="cuerpo">




    <div class="contenido">
      @if ($type === 1)
        <strong> <b>Nueva licitación</b></strong>
      @else
        <strong> <b>Nuevo Evento</b></strong>
      @endif
    <br>

    <p>

    <?php /*echo html_entity_decode($notice->notice); */?>

    </p>


    </div>


    <div class="contenido">
            <p>Estimado(a)</p>

            @if ($type === 1)
              <p>
                Para poder ver la licitación hacer clic al siguiente enlace
                <a href="{{ $url }}" >aqu&iacute;.</a><br>
              </p>
            @else
              <p>
                Para poder ver el evento hacer clic al siguiente enlace
                <a href="{{ $url }}" >aqu&iacute;.</a><br>
              </p>
            @endif


            <hr>

            <p>

            </p>
            <p class="break-word">
                <font color="black" size="2">

                </font>
            </p>
        </div>


        <div class="footer">
            <br>
            <center>
                {{-- <img  width="15%" height="15%" src="{{ $message->embed(public_path().'/img/logo_black.png') }}" alt=""> --}}
            </center>
            <center>
                <font color="black" size="2">
                    Algunos Derechos Reservados
                    {{-- <a target="_blank" href="http://www.gob.mx/privacidad">
                        <font color="black">
                            Política de privacidad
                        </font>
                    </a> --}}
                </font>
                <br>
            </center>
            <center>
                <font color="black" size="2">
                     La informaci&oacute;n contenida en el presente sistema es susceptible de estar clasificadas en t&eacute;rminos de La Ley Federal de Transparencia y Acceso a la Informaci&oacute;n P&uacute;blica Gubernamental por la unidad administrativa que la gener&oacute;
                </font>
            </center>
        </div>
    </div>
</body>
</html>






