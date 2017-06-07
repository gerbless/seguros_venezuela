@foreach($menus as $menu)
    <fieldset>
       @if($usuario->tipo=="AGENTES")
            <legend><span style="color:#31708f"><i class="{{$menu->icon}}"></i>  {{$menu->nombre}}</span></legend>
            @foreach($submenus[$menu->nombre] as $submenu)
                @if($usuario->tipo==$submenu->tipo)
                <div class="form-group col-xs-3">
                     {!! Form::checkbox('perfil',$submenu->id,$submenu->ck,['id'=>$submenu->id,'class'=>'','onclick'=>'marcar(this)']) !!} <i class='{{ $submenu->icon  }}' aria-hidden='true'></i>-{!!Form::label($submenu->id,$submenu->nombre)!!}
                </div>
                @endif
            @endforeach
           @else
            <legend><span style="color:#31708f"><i class="{{$menu->icon}}"></i>  {{$menu->nombre}}</span></legend>
            @foreach($submenus[$menu->nombre] as $submenu)
                <div class="form-group col-xs-3">
                {!! Form::checkbox('perfil',$submenu->id,$submenu->ck,['id'=>$submenu->id,'class'=>'','onclick'=>'marcar(this)']) !!} <i class='{{ $submenu->icon  }}' aria-hidden='true'></i>-{!!Form::label($submenu->id,$submenu->nombre)!!}
            </div>
            @endforeach
        @endif
    </fieldset>
@endforeach



