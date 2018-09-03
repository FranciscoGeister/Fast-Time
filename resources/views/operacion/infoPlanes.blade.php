@extends('layouts.menu')

@section('content')

<h1>Plan socio {{ $member->name }}</h1>
<div id="Plan" class="tabcontent">
    <table class="table table-bordered">
    	<thead>
            <tr>
                <th>Nombre Plan</th>
            </tr>
        </thead>
        <tbody>
        	<tr>
        		<td>{{ $plan->nombre }}</td>
        	</tr>
        </tbody>
    </table>
</div>

<h1>Sesiones</h1>
<div id="Sesiones" class="tabcontent">
    <table class="table table-bordered">
    	<thead>
            <tr>
                <th>Tipo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($sesions as $sesion)
	        	<tr>
	        		<td>{{ $sesion->id }}</td>
	        		<td>{{ $sesion->cantidad }}</td>
	        	</tr>
	        @endforeach
        </tbody>
    </table>
</div>
@endsection
