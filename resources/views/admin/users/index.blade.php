@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.users.create') }}" class="btn btn-default">Novo Usuário</a><br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Usuários</div>
        <div class="panel-body">

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                    <a href="{{ route('admin.users.edit', ['id'=>$user->id]) }}" class="btn btn-default btn-xs">
                      Editar
                    </a>
                    <a href="#modal_delete_<?= $user->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                      Remover
                    </a>
                  </td>
                </tr>
                @include('admin.users.partials.modal_delete')
              @endforeach
            </tbody>

          </table>

        </div>
      </div>
      {!! $users->render() !!}
    </div>
  </div>

@endsection
