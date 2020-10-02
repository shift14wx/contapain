<div class="table-responsive-sm">
    <table class="table table-striped" id="registros-table">
        <thead>
            <tr>
                <th>Id Detalle Concepto</th>
        <th>Debe</th>
        <th>Haber</th>
        <th>Concepto Detallado</th>
        <th>Id Rubro</th>
        <th>Id Asiento</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($registros as $registro)
            <tr>
                <td>{{ $registro->id_detalle_concepto }}</td>
            <td>{{ $registro->debe }}</td>
            <td>{{ $registro->haber }}</td>
            <td>{{ $registro->concepto_detallado }}</td>
            <td>{{ $registro->id_rubro }}</td>
            <td>{{ $registro->id_asiento }}</td>
                <td>
                    {!! Form::open(['route' => ['registros.destroy', $registro->id_registro], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('registros.show', [$registro->id_registro]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('registros.edit', [$registro->id_registro]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>