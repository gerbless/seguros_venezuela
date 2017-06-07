@foreach($menus as $menu)
    @if(isset($botones[$menu->nombre]))
        <li class="treeview">
            <a href="#">
                <i class="{{$menu->icon}}"></i> <span>{{$menu->nombre}}</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @foreach($botones[$menu->nombre] as $botone)
                    @if($botone->status_id!=2)
                        <li class="active">
                            <a href="javascript:void(0);" onclick="cargarlistado('{{ $botone->ruta }}');" ><i class="{{$botone->icon}}" aria-hidden="true"></i>
                                @if($menu->id==3)
                                    <b  class="text-yellow" id="nro-home-{{$botone->status_id}}">
                                        @if($total_clientes[$botone->status_id] > 0)
                                            {{ $total_clientes[$botone->status_id]}}
                                        @endif</b> -
                                @endif
                                {{ $botone->nombre }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        <hr>
    @endif
@endforeach