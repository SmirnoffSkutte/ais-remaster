@extends('layouts.master')

@section('content')

    <h1 class="mb-3">Laravel Soft Delete Example - codeanddeploy.com</h1>

    <div class="bg-light p-4 rounded">
        <h1>Users</h1>
        <div class="lead">
            Manage your users here.
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
        </div>

        <div class="mt-2">
            @include('partials.messages')

            <br>
            <a href="{{ route('user.index') }}">All users</a> | <a href="{{ route('user.index') }}?status=archived">Archived users</a>

            <br><br>
            @if(request()->get('status') == 'archived')
                {!! Form::open(['method' => 'POST','route' => ['user.restore-all'],'style'=>'display:inline']) !!}
                {!! Form::submit('Restore All', ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            @endif
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Username</th>
                <th scope="col" width="1%" colspan="4"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td><a href="{{ route('user.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                            @if(request()->get('status') == 'archived')
                                {!! Form::open(['method' => 'POST','route' => ['user.restore', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Восстановить', ['class' => 'btn btn-primary btn-sm']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            @if(request()->get('status') == 'archived')
                                {!! Form::open(['method' => 'DELETE','route' => ['user.force-delete', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Принудительно удалить', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {!! $users->links() !!}
        </div>

    </div>
@endsection
