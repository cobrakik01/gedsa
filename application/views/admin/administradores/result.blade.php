@layout('admin.administradores.main')

@section('menu_admin')
    @parent
@endsection

@section('contenido_admin')
    <h3>{{$accion}}</h3>
    
    @foreach($users->results as $us)
        {{$us->id . ' ' . $us->nombre}}
        @if($us->activo)
            Activo
        @else
            No Activo
        @endif
        <br />
    @endforeach
    {{$users->links()}}
@endsection