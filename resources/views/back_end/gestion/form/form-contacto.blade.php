<div class="form-group col-xs-12" >
    <div id="mensaje-formtelefono" style="display: none"></div>
</div>
@foreach($campos as  $x=>$campo)
  @if(isset($toques))
        @if(array_key_exists($gestionar[$campo->COLUMN_NAME],$toques)=="true")
            <div class="form-group col-xs-1 " data-id="{{$campo->COLUMN_NAME}}" data-max="{{$toques[$gestionar[$campo->COLUMN_NAME]]['max_toques']}}" data-toque="{{$toques[$gestionar[$campo->COLUMN_NAME]]['toques']}}">
                <label  class="@if($toques[$gestionar[$campo->COLUMN_NAME]]['toques'] >= $toques[$gestionar[$campo->COLUMN_NAME]]['max_toques']) text-red @else text-blue @endif  aperturas">{{$toques[$gestionar[$campo->COLUMN_NAME]]['toques']}}</label>
                {!! Form::radio('telefono',($x + 1),false,['class'=>'radios','id'=>$campo->COLUMN_NAME.'-rad','required'=>'required',$toques[$gestionar[$campo->COLUMN_NAME]]['readonly']]) !!}
            </div>

            <div class="form-group col-xs-3">
                {!!Form::text($campo->COLUMN_NAME,$gestionar[$campo->COLUMN_NAME],['id'=>$campo->COLUMN_NAME,'class'=>'form-control formtelefono',$toques[$gestionar[$campo->COLUMN_NAME]]['readonly']])!!}
            </div>
           @else
            <div class="form-group col-xs-1">
                <label for="{{$campo->COLUMN_NAME}}" class="fa fa-volume-control-phone text-blue" aria-hidden="true"> </label> {!! Form::radio('telefono',($x + 1),false,['class'=>'radios','required'=>'required']) !!}
            </div>

            <div class="form-group col-xs-3">
                {!!Form::text($campo->COLUMN_NAME,$gestionar[$campo->COLUMN_NAME],['id'=>$campo->COLUMN_NAME,'class'=>'form-control formtelefono'])!!}
            </div>
        @endif
      @else
          <div class="form-group col-xs-1">
              <label for="{{$campo->COLUMN_NAME}}" class="fa fa-volume-control-phone" aria-hidden="true"> </label> {!! Form::radio('telefono',($x + 1),false,['class'=>'radios','required'=>'required']) !!}
          </div>

          <div class="form-group col-xs-3">
              {!!Form::text($campo->COLUMN_NAME,$gestionar[$campo->COLUMN_NAME],['id'=>$campo->COLUMN_NAME,'class'=>'form-control formtelefono'])!!}
          </div>
    @endif

@endforeach
