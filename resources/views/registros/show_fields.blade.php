<!-- Id Detalle Concepto Field -->
<div class="form-group">
    {!! Form::label('id_detalle_concepto', 'Id Detalle Concepto:') !!}
    <p>{{ $registro->id_detalle_concepto }}</p>
</div>

<!-- Debe Field -->
<div class="form-group">
    {!! Form::label('debe', 'Debe:') !!}
    <p>{{ $registro->debe }}</p>
</div>

<!-- Haber Field -->
<div class="form-group">
    {!! Form::label('haber', 'Haber:') !!}
    <p>{{ $registro->haber }}</p>
</div>

<!-- Concepto Detallado Field -->
<div class="form-group">
    {!! Form::label('concepto_detallado', 'Concepto Detallado:') !!}
    <p>{{ $registro->concepto_detallado }}</p>
</div>

<!-- Id Rubro Field -->
<div class="form-group">
    {!! Form::label('id_rubro', 'Id Rubro:') !!}
    <p>{{ $registro->id_rubro }}</p>
</div>

<!-- Id Asiento Field -->
<div class="form-group">
    {!! Form::label('id_asiento', 'Id Asiento:') !!}
    <p>{{ $registro->id_asiento }}</p>
</div>

