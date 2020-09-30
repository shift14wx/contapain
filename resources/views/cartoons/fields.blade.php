<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Avalible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avalible', 'Avalible:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('avalible', 0) !!}
        {!! Form::checkbox('avalible', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cartoons.index') }}" class="btn btn-secondary">Cancel</a>
</div>
