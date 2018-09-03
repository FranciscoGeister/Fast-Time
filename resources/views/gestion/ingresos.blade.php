@extends('layouts.menu')

@section('content')

<div class="container">
    <div class="tab">
        <button class="tablinks" onclick="openSucursal(event, 'FormasDePago')">Formas De Pago</button>
        <!--<button class="tablinks" onclick="openSucursal(event, 'DetalleVentas')">Detalle Ventas</button>-->
    </div>
    <br>

    <div id="FormasDePago" class="tabcontent">
        <form class="form-inline" action="informe_mensual" method="POST">
            {{csrf_field()}}
            {{method_field('GET')}}
            <label>&nbsp; Mes: &nbsp;</label>
            <select class="form-control" name="month">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <button class="btn btn-primary" type="submit">Aceptar</button>
        </form>
        <button class="btn btn-primary" onclick="exportTableToExcel('tblData')">Exportar a Exel</button>
        <table class="table table-bordered" id="tblData">
            <thead>
                <tr>
                    <th>Forma de pago</th>
                    @foreach($sedes as $sede)
                    <th>{{ $sede->nombre }}</th>
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>Efectivo</td>
                <td style="text-align:right">${{ number_format($p1s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s1+$p1s2+$p1s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Cheque</td>
                <td style="text-align:right">${{  number_format($p2s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p2s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p2s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p2s1+$p2s2+$p2s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Tarjeta de Crédito</td>
                <td style="text-align:right">${{  number_format($p3s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p3s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p3s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p3s1+$p3s2+$p3s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Tarjeta de Débito</td>
                <td style="text-align:right">${{  number_format($p4s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p4s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p4s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p4s1+$p4s2+$p4s3,0, "," , ".") }}</td
            </tr>
            <tr>
                <td>Canje</td>
                <td style="text-align:right">${{  number_format($p5s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p5s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p5s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p5s1+$p5s2+$p5s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Tansf. Bancaria</td>
                <td style="text-align:right">${{  number_format($p6s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p6s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p6s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p6s1+$p6s2+$p6s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Descuento</td>
                <td style="text-align:right">${{  number_format($p7s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p7s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p7s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p7s1+$p7s2+$p7s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Deuda</td>
                <td style="text-align:right">${{  number_format($p8s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p8s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p8s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p8s1+$p8s2+$p8s3,0, "," , ".") }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td style="text-align:right">${{  number_format($p1s1+$p2s1+$p3s1+$p4s1+$p5s1+$p6s1+$p7s1+$p8s1,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s2+$p2s2+$p3s2+$p4s2+$p5s2+$p6s2+$p7s2+$p8s2,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s3+$p2s3+$p3s3+$p4s3+$p5s3+$p6s3+$p7s3+$p8s3,0, "," , ".") }}</td>
                <td style="text-align:right">${{  number_format($p1s3+$p2s3+$p3s3+$p4s3+$p5s3+$p6s3+$p7s3+$p8s3,0, "," , ".") }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="DetalleVentas" class="tabcontent">
    	<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Socio</th>
                    <th>Sede</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->created_at }}</td>
                <td>{{ $sale->rut_socio }}</td>
                <td>{{ $sale->nombre_sede }}</td>
                <td>${{ number_format($sale->monto,0, "," , ".") }}</td>
                <td>
                	<form action="ingresos/{{$sale->id}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('GET')}}
                            <button class="btn btn-primary" type="submit">Info</button>
                    </form>
                </td>
            </tr>
            @endforeach
        	</tbody>
    	</table>
    </div>
</div>


<script>
function openSucursal(evt, sucursal) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(sucursal).style.display = "block";
    evt.currentTarget.className += " active";
}

    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

</script>
<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>

@endsection
