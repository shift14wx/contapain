<!-- Id Detalle Concepto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_detalle_concepto', 'Id Detalle Concepto:') !!}
    {!! Form::number('id_detalle_concepto', old('id_detalle_concepto'), ['class' => 'form-control']) !!}
</div>

<!-- Debe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('debe', 'Debe:') !!}
    {!! Form::number('debe', old('debe'), ['class' => 'form-control','min'=>0,'max'=>1])!!}
</div>

<!-- Haber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('haber', 'Haber:') !!}
    {!! Form::number('haber',old('haber'), ['class' => 'form-control','min'=>0,'max'=>1]) !!}
</div>

<!-- Concepto Detallado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concepto_detallado', 'Concepto Detallado:') !!}
    {!! Form::text('concepto_detallado', old('concepto detallado'), ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Id Rubro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_rubro', 'Id Rubro:') !!}
    {!! Form::number('id_rubro', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Asiento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_asiento', 'Id Asiento:') !!}
    {!! Form::number('id_asiento', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('registros.index') }}" class="btn btn-secondary">Cancel</a>
</div>
