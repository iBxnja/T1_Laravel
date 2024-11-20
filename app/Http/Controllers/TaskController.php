<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    #---------------------------------------------------------------#
    #                          IMPORTANTE                           #
    #---------------------------------------------------------------#

    # La consulta para obtener los datos y representarlos en la view 
    # se puede hacer de dos formas:
    # 1) Creando una consulta manual.
    # 2) Utilizando el Query Builder

    # En el este controlador se deja de muestra las dos consultas
    # a mi gusto personal prefiero realizar query builder.

    # Queda ejecutando la version manual para que se pueda ver
    # el resultado final de la prueba tecnica.

    # Para mayor rapidez, en la ejecucion del query builder
    # deje un filtro ($dateFormat = '2023-10';) activo para que
    # se pueda ver el resultado de la consulta. Es mejor practica
    # realizar un search donde el usuario proporcione los datos
    # y que a partir de eso se realice el filtro.

    # Muchas gracias por la oportunidad. Att. Benjamin Vallory.

    #---------------------------------------------------------------#


    public function index()
    {
        $results = DB::select(DB::raw("
    SELECT 
        CONCAT(resource.firstname, ' ', resource.lastname) AS nombre_completo_recurso,
        work_order.project_id AS nro_proyecto,
        DATE_FORMAT(work_order.created, '%m-%d-%Y') AS fecha_orden_trabajo,
        task.id AS nro_tarea,
        task_count.unit_price AS precio_unitario_tarea,
        task_count.count AS cantidad,
        (task_count.unit_price * task_count.count) AS monto,
        work_order.id AS nro_orden_trabajo
    FROM 
        task
    JOIN 
        task_count ON task.id = task_count.task_id
    JOIN 
        work_order_item_detail ON task.work_order_item_detail_id = work_order_item_detail.id
    JOIN 
        work_order_item ON work_order_item_detail.work_order_item_id = work_order_item.id
    JOIN 
        work_order ON work_order_item.work_order_id = work_order.id
    JOIN 
        resource ON task.resource_id_assigned = resource.id
    WHERE 
        DATE_FORMAT(work_order.created, '%Y-%m') = :date_format
    AND 
        (task_count.unit_price * task_count.count) > (
            SELECT AVG(tc.unit_price * tc.count)
            FROM task_count tc
            JOIN task t ON tc.task_id = t.id
            JOIN work_order_item_detail wod ON t.work_order_item_detail_id = wod.id
            JOIN work_order_item woi ON wod.work_order_item_id = woi.id
            JOIN work_order wo ON woi.work_order_id = wo.id
            WHERE t.resource_id_assigned = task.resource_id_assigned
        )
    ORDER BY 
        resource.firstname, resource.lastname, work_order.created
"), [
            'date_format' => '2023-10',
        ]);
        if (empty($results)) {
            return view('T1_Laravel')->with('message', 'No hay resultados para el mes y año especificados.');
        }
        return view('T1_Laravel', ['results' => $results]);
    }


    // public function index()
    // {
    //     // Dato hardcodeado para el mes/año (es mejor practica realizar un filtro donde el usuario proporcione esas variables).
    //     $dateFormat = '2023-10';

    //     $results = DB::table('task')
    //         ->select(
    //             DB::raw("CONCAT(resource.firstname, ' ', resource.lastname) AS nombre_completo_recurso"),
    //             'work_order.project_id AS nro_proyecto',
    //             DB::raw("DATE_FORMAT(work_order.created, '%m-%d-%Y') AS fecha_orden_trabajo"),
    //             'task.id AS nro_tarea',
    //             'task_count.unit_price AS precio_unitario_tarea',
    //             'task_count.count AS cantidad',
    //             DB::raw('(task_count.unit_price * task_count.count) AS monto'),
    //             'work_order.id AS nro_orden_trabajo'
    //         )
    //         ->join('task_count', 'task.id', '=', 'task_count.task_id')
    //         ->join('work_order_item_detail', 'task.work_order_item_detail_id', '=', 'work_order_item_detail.id')
    //         ->join('work_order_item', 'work_order_item_detail.work_order_item_id', '=', 'work_order_item.id')
    //         ->join('work_order', 'work_order_item.work_order_id', '=', 'work_order.id')
    //         ->join('resource', 'task.resource_id_assigned', '=', 'resource.id')
    //         ->whereRaw("DATE_FORMAT(work_order.created, '%Y-%m') = ?", [$dateFormat])
    //         ->whereRaw('(task_count.unit_price * task_count.count) > (
    //             SELECT AVG(tc.unit_price * tc.count)
    //             FROM task_count tc
    //             JOIN task t ON tc.task_id = t.id
    //             JOIN work_order_item_detail wod ON t.work_order_item_detail_id = wod.id
    //             JOIN work_order_item woi ON wod.work_order_item_id = woi.id
    //             JOIN work_order wo ON woi.work_order_id = wo.id
    //             WHERE t.resource_id_assigned = task.resource_id_assigned
    //         )')
    //         ->orderBy('resource.firstname')
    //         ->orderBy('resource.lastname')
    //         ->orderBy('work_order.created')
    //         ->get();

    //     return view('T1_Laravel', ['results' => $results]);
    // }


    public function exportToCsv()
{
    $results = DB::select(DB::raw("
        SELECT 
            CONCAT(resource.firstname, ' ', resource.lastname) AS nombre_completo_recurso,
            work_order.project_id AS nro_proyecto,
            DATE_FORMAT(work_order.created, '%m-%d-%Y') AS fecha_orden_trabajo,
            task.id AS nro_tarea,
            task_count.unit_price AS precio_unitario_tarea,
            task_count.count AS cantidad,
            (task_count.unit_price * task_count.count) AS monto,
            work_order.id AS nro_orden_trabajo
        FROM 
            task
        JOIN 
            task_count ON task.id = task_count.task_id
        JOIN 
            work_order_item_detail ON task.work_order_item_detail_id = work_order_item_detail.id
        JOIN 
            work_order_item ON work_order_item_detail.work_order_item_id = work_order_item.id
        JOIN 
            work_order ON work_order_item.work_order_id = work_order.id
        JOIN 
            resource ON task.resource_id_assigned = resource.id
        WHERE 
            DATE_FORMAT(work_order.created, '%Y-%m') = :date_format
        AND 
            (task_count.unit_price * task_count.count) > (
                SELECT AVG(tc.unit_price * tc.count)
                FROM task_count tc
                JOIN task t ON tc.task_id = t.id
                JOIN work_order_item_detail wod ON t.work_order_item_detail_id = wod.id
                JOIN work_order_item woi ON wod.work_order_item_id = woi.id
                JOIN work_order wo ON woi.work_order_id = wo.id
                WHERE t.resource_id_assigned = task.resource_id_assigned
            )
        ORDER BY 
            resource.firstname, resource.lastname, work_order.created
    "), [
        'date_format' => '2023-10',
    ]);

    if (empty($results)) {
        return redirect()->back()->with('message', 'No hay datos para exportar.');
    }

    $fileName = 'reporte_' . now()->format('Y_m_d') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    $callback = function () use ($results) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Nombre Completo Recurso',
            'Número Proyecto',
            'Fecha Orden Trabajo',
            'Número Tarea',
            'Precio Unitario Tarea',
            'Cantidad',
            'Monto',
            'Número Orden Trabajo',
        ]);

        foreach ($results as $row) {
            fputcsv($file, [
                $row->nombre_completo_recurso,
                $row->nro_proyecto,
                $row->fecha_orden_trabajo,
                $row->nro_tarea,
                $row->precio_unitario_tarea,
                $row->cantidad,
                $row->monto,
                $row->nro_orden_trabajo,
            ]);
        }

        fclose($file);
    };
    return response()->stream($callback, 200, $headers);
}


}
