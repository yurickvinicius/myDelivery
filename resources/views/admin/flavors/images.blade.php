@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.flavors.images.create', ['id'=>$flavor->id]) }}"  class="btn btn-default">Novo Imagen</a>
      <a href="{{ route('admin.flavors.index') }}" class="btn btn-default">Voltar</a>
      <br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Imagens de {{ $flavor->name }}</div>
        <div class="panel-body">

          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Extension</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($flavor->images as $image)
                <tr>
                  <td>{{ $image->id }}</td>
                  <td>
                    <img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" width="80">
                  </td>
                  <td>{{ $image->extension }}</td>
                  <td>
                    <a href="{{ route('admin.flavor.image.destroy', ['id'=>$image->id]) }}" class="btn btn-default btn-sm">
                      Remover
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

@endsection
