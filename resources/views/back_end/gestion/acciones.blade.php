@if(Auth::user()->tipo!="AGENTES")
    <td>{{$item->users->name}}</td>
@endif
<td>
@if ($ruta_actual=="clientes-ventas")
  <button class="btn  btn-info btn-xs" onclick="modalFicha([{{ $item->id }},'venta-aprobada']);" ><i class="fa fa-plus"></i> Más</button>
    @if($item->contactos->count()>0)<button class="btn  btn-yahoo btn-xs" onclick="modalFicha([{{ $item->id }},'historia-cliente']);" ><i class="fa fa-history"></i> Hist - <span class="text-yellow text-bold">{{$item->contactos()->count()}}</span></button>@endif
@elseif ($ruta_actual=="clientes-noventa")
    @if($item->contactos->count()>0)<button class="btn  btn-yahoo btn-xs" onclick="modalFicha([{{ $item->id }},'historia-cliente']);" ><i class="fa fa-history"></i> Hist - <span class="text-yellow text-bold">{{$item->contactos()->count()}}</span></button>@endif
@else
    @if((Auth::user()->tipo=="AGENTES") && $ruta_actual!="cliente-ya-es-cliente"  && $ruta_actual!="clientes-enviadas")
        <button class="btn  btn-info btn-xs" onclick="modalFicha([{{ $item->id }},'editar-gesion-cliente']);" ><i class="fa fa-hand-pointer-o"></i> Gest</button>
    @endif
    @if($item->contactos->count()>0)<button class="btn  btn-yahoo btn-xs" onclick="modalFicha([{{ $item->id }},'historia-cliente']);" ><i class="fa fa-history"></i> Hist - <span class="text-yellow text-bold">{{$item->contactos()->count()}}</span></button>@endif
@endif
</td>

