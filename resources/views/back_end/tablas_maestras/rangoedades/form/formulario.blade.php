<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('minimo','Minimo:')!!}
    {!!Form::text('minimo',null,['class'=>'form-control','placeholder'=>'Minimo','maxlength'=>'2','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('maximo','Maximo:')!!}
    {!!Form::text('maximo',null,['class'=>'form-control','placeholder'=>'Maximo','maxlength'=>'2','required'=>'required'])!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('status_id','Status:')!!}
    {!!Form::select('status_id',$status_id, null, ['class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<script>
    (function(a){a.fn.validCampoFranz=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);
    $('#minimo').validCampoFranz('0123456789');
    $('#maximo').validCampoFranz('0123456789');
</script>