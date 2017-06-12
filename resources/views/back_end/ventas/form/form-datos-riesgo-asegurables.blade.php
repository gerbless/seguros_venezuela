<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('campana_id','Campaña:')!!}
    {!!Form::select('campana_id',$campana_id, null, ['id' => 'campana_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('ramo_id','Ramo:')!!}
    {!!Form::select('ramo_id',array(), null, ['id' => 'ramo_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('producto_id','Producto:')!!}
    {!!Form::select('producto_id',array(), null, ['id' => 'producto_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('plan_id','Plan:')!!}
    {!!Form::select('plan_id',array(), null, ['id' => 'plan_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
<div class="form-group col-xs-12">
    <apan style="color:red">*</apan> {!!Form::label('frecuencia_pago_id','Frecuencia de pago:')!!}
    {!!Form::select('frecuencia_pago_id',$frecuencia_pago_id, null, ['id' => 'frecuencia_pago_id','class' => 'form-control','placeholder'=>'..:: SELECCIONE ::..','required'=>'required'] )!!}
</div>
{!!Form::hidden('clientes_id',$clientes->id,['class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('plan_cliente',str_replace(',','-',$clientes->plan),['id'=>'plan_cliente','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('ramo_cliente',str_replace(',','-',$clientes->ramo),['id'=>'ramo_cliente','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('producto_cliente',str_replace(',','-',$clientes->producto),['id'=>'producto_cliente','class'=>'form-control','required'=>'required'])!!}
{{--SE CARGAN CON JS EN EL ARCHIVO COMBOS AL SELECCIONAR LA FRECUENCIA DE PAGO--}}
{!!Form::hidden('tarifario_id',null,['id'=>'tarifario_id','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('valor_prima',null,['id'=>'valor_prima','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('valor_prima_golbal',null,['id'=>'valor_prima_golbal','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('nu_beneficiarios_requeridos',null,['id'=>'nu_beneficiarios_requeridos','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('asegurados_id',null,['id'=>'asegurados_id','class'=>'form-control','required'=>'required'])!!}
{!!Form::hidden('pagadorpli',null,['id'=>'pagadorpli','class'=>'form-control','required'=>'required'])!!}



