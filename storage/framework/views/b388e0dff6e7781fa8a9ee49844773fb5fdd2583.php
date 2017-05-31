<meta charset="utf-8"/>

<script type="text/javascript">
    $('.id_grafica_mostrar').show();
</script>
<div id="container"  style="width:100%;margin: 0 auto"></div>

<input type="hidden" name="variable1" id="variable1" value="<?php echo e($ultimo_dia); ?>">
<input type="hidden" name="variable2" id="variable2" value="<?php echo e($ResultadoUnion); ?>">

<script type="text/javascript">
    CargarCOnsulta();


    function CargarCOnsulta(){

        var options={
         chart: {
            renderTo: 'container',
            // type: 'column'
            type: 'spline'
        },
        title: {
            text: 'PARAMETRO: <?php echo e($parametros_control); ?><br>Porcentaje Minimo ( <?php echo e($porcentaje_minimo); ?> )<br>Unidad ( <?php echo e($unidad); ?> )<br> Turno: ( <?php echo e($turno); ?> )'
        },
        subtitle: {
            text: 'Sucroal S.A'
        },
        xAxis: {
            categories: [],
            title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Valores Ingresados RUTA'
            }
        },
        tooltip: {
            // headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">El Parametro "<?php echo e($parametros_control); ?>" Tuvo un valor de: </td>' +
            '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'registros',
            data: []

        }]
    }
    $( document ).ready(function() {
        var totaldias=$('#variable1').val(); 
        var datosbd=$('#variable2').val();               
        var datos= $.parseJSON(datosbd);
        var i=0;      
        for(i=1;i<=totaldias;i++){
            options.xAxis.categories.push(i);                     
            options.series[0].data.push(datos[i]);           
        }
        chart = new Highcharts.Chart(options);
    });
}
</script>


