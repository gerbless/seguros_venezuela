<div class="form-group col-xs-6">
    <apan style="color:red">*</apan> {!!Form::label('tpfnivel1_id','Marcador 1(UNO):')!!}
    {!!Form::select('tpfnivel1_id',$tpfnivel1, null, ['class' => 'form-control','placeholder'=>'Ingrese Marcador 1(UNO)','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('tpfnivel3_id','Tipificación 1(UNO):')!!}
    {!!Form::select('tpfnivel3_id',array(), null, ['id'=>'tpfnivel3_id','class' => 'form-control','placeholder'=>'Ingrese Tipificación 1(UNO)'] )!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('tpfnivel2_id','Marcador 2(DOS):')!!}
    {!!Form::select('tpfnivel2_id',array(), null, ['id'=>'tpfnivel2_id','class' => 'form-control','placeholder'=>'Ingrese Marcador 2(DOS)','required'=>'required'] )!!}
</div>

<div class="form-group col-xs-6">
    {!!Form::label('tpfnivel4_id','Tipificación 2(DOS):')!!}
    {!!Form::select('tpfnivel4_id',array(), null, ['class' => 'form-control','placeholder'=>'Ingrese Tipificación 1(DOS)'] )!!}
</div>

<div class="form-group col-xs-12">
    {!!Form::label('comentario','Comentario:')!!}
    {!!Form::textarea('comentario',null,['id'=>'comentario','class'=>'form-control','placeholder'=>'Ingrese Comentario','required'=>'required'])!!}
</div>





