<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $empleado->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Apellido Paterno') }}
            {{ Form::text('ApellidoPaterno', $empleado->ApellidoPaterno, ['class' => 'form-control' . ($errors->has('ApellidoPaterno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Paterno']) }}
            {!! $errors->first('ApellidoPaterno', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Apellido Materno') }}
            {{ Form::text('ApellidoMaterno', $empleado->ApellidoMaterno, ['class' => 'form-control' . ($errors->has('ApellidoMaterno') ? ' is-invalid' : ''), 'placeholder' => 'Apellido Materno']) }}
            {!! $errors->first('ApellidoMaterno', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Correo') }}
            {{ Form::text('Correo', $empleado->Correo, ['class' => 'form-control' . ($errors->has('Correo') ? ' is-invalid' : ''), 'placeholder' => 'Correo', 'id'=>'Correo']),  }}
            {!! $errors->first('Correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Empleo') }}
            {{ Form::select('id_empleo', $empleo ,$empleado->id_empleo, ['class' => 'form-control' . ($errors->has('id_empleo') ? ' is-invalid' : ''), 'placeholder' => 'Empleo']) }}
            {!! $errors->first('id_empleo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Foto') }}
            {{ Form::text('Foto', $empleado->Foto, ['class' => 'form-control' . ($errors->has('Foto') ? ' is-invalid' : ''), 'placeholder' => 'Foto']) }}
            {!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>



<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
jQuery(document).ready(function(){
    jQuery('#Correo').focusout(function(e){
        e.preventDefault();
        console.log($('meta[name="csrf-token"]').attr('content'));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
                  url: "{{ url('/empleados/store') }}",
                  type: 'POST',
                  data: {
                     Correo: jQuery('#Correo').val(),
                  },
                  success: function(data){
                    // jQuery('.invalid-feedback').show();
                    // alert('invalid-feedback');
                    //Buscar alerts de bootstrap.

                    if (data.success == false) {
                            $('#Correo').after('<div id="email-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                    } else {
                            $('#Correo').after('<div id="email-error" class="text-success" <strong>'+data.message+'<strong></div>');
                    }


                  }});
               });
            });
</script>