<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="Nombre"> Nombre </label>
            <input class="form-control" type="text" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre: '' }}" id="Nombre">
        </div>
        <div class="form-group">
            <label for="ApellidoPaterno"> Apellido Paterno </label>
            <input class="form-control"  type="text" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno: '' }}" id="ApellidoPaterno">
        </div>
        <div class="form-group">
            <label for="ApellidoMaterno"> Apellido Materno </label>
            <input class="form-control"  type="text" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno: '' }}" id="ApellidoMaterno">
        </div>
        <div class="form-group">
            <label for="Correo"> Correo </label>
            <input class="form-control"  type="text" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo: '' }}" id="Correo">
        </div>
        <div class="form-group">
            {{ Form::label('Empleo') }}
            {{ Form::select('id_empleo', $empleo ,$empleado->id_empleo, ['class' => 'form-control' . ($errors->has('id_empleo') ? ' is-invalid' : ''), 'placeholder' => 'Empleo']) }}
            {!! $errors->first('id_empleo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
        <label for="Foto"> Foto </label>
            @if(isset($empleado->Foto))
            <img src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" height="100" alt="">
            @endif
            <input class="form-control"  type="file" name="Foto" value="" id="Foto">
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
        $('#email-error').remove();
        jQuery.ajax({
            url: "{{ url('/empleados-store') }}",
            type: 'POST',
            data: {
                Correo: jQuery('#Correo').val(),
            },
            success: function(data){

            if (data.success == false) {
                $('#Correo').after('<div id="email-error" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
            }else {
                $('#Correo').after('<div id="email-error" class="text-success" <strong>'+data.message+'<strong></div>');
            }
        }});
    });
});
</script>