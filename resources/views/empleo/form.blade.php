<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('empleo') }}
            {{ Form::text('empleo', $empleo->empleo, ['class' => 'form-control' . ($errors->has('empleo') ? ' is-invalid' : ''), 'placeholder' => 'Empleo']) }}
            {!! $errors->first('empleo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>