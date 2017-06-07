<!DOCTYPE html>
<html>
<head>
    <title>Ups...</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
        .title2 {
            font-size: 18px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Sin roles asignados</div>
        <div class="title2">Su usuario no tienes roles definidos en el sistema, por favor contacte  al supervior para que  defina sus tareas dentro del sistema</div>
        <div class="title2"> {{link_to('cerrar-panel','SALIR DEL SISTEMA')}} </div>
    </div>
</div>
</body>
</html>
