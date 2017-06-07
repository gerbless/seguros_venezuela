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
        font-size: 55px;
        margin-bottom: 40px;
    }

    .title2 {
        font-size: 35px;
        margin-bottom: 40px;
    }
</style>
<div class="container">
    <div class="content">
        <div class="title">debe iniciar sesión nuevamente</div>
        <div class="title2">{{link_to('cerrar-panel','Presione para iniciar')}}</div>
    </div>
</div>