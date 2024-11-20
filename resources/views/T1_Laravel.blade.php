<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de tareas entregadas</title>
</head>
<body>
    <h1>Listado de tareas entregadas</h1>
    <div class="divExport">
        <a class="buttonExport" href="{{ route('export.csv') }}" class="btn btn-primary">Exportar a CSV</a>
    </div>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <table border="4" cellpadding="10">
        <thead>
            <tr>
                <th>Nombre completo de recurso</th>
                <th>Nro de proyecto</th>
                <th>Fecha de la orden de trabajo</th>
                <th>Nro de tarea</th>
                <th>Precio unitario de la tarea</th>
                <th>Cantidad</th>
                <th>Monto</th>
                <th>Nro de orden de trabajo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->nombre_completo_recurso }}</td>
                    <td>{{ $result->nro_proyecto }}</td>
                    <td>{{ $result->fecha_orden_trabajo }}</td>
                    <td>{{ $result->nro_tarea }}</td>
                    <td>{{ $result->precio_unitario_tarea }}</td>
                    <td>{{ $result->cantidad }}</td>
                    <td>{{ $result->monto }}</td>
                    <td>{{ $result->nro_orden_trabajo }}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


<style>
body{
    background-color: rgb(230, 230, 230);
}
table{
    width: 100%;
}
h1{
    width: 100%;
    text-align: center;
}
.divExport{
    width: 100%;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.buttonExport{
    width: 300px;
    display: grid;
    place-items: center;
    background-color: rgb(141, 200, 255);
    height: 60px;
    text-decoration: none;
    color: white;
    border-radius: 20px;
}

</style>