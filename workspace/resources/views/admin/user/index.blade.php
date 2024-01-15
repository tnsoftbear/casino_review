@extends('admin.layout.default', ['pageTitle' => 'Users'])

@section('content')

<div class="container mt-4">
    <p><a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a></p>
    @if (count($users) == 0) <p>No users found.</p>
    @else
    <table class="table user-table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Username</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <span class="badge @if ($user->is_author) {{ 'bg-primary' }} @else {{ 'bg-background' }} @endif rounded-pill mr-2" title="Author">&nbsp;</span>
                        <span class="badge @if ($user->is_admin) {{ 'bg-danger' }} @else {{ 'bg-background' }} @endif rounded-pill mr-2" title="Admin">&nbsp;</span>
                    </td>
                    <td>
                        {{ $user->login }}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-info btn-sm" target="_blank">Preview</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" class="user-action-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection