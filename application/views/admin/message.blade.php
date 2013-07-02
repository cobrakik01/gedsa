@layout('admin.main')

@section('menu')
@parent
@endsection

@section('contenido')
<div style="text-align: center; font-size: 24px; padding: 20px; border: solid 1px #cccccc; border-radius: 3px; box-shadow: #ccccff 1px 1px 10px 1px;">{{$msg}}</div>
@endsection
