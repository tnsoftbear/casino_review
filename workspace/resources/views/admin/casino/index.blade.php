@extends('admin.layout.default')

@section('content')

<div class="container mt-4">
    <p><a href="{{ route('casino.create') }}" class="btn btn-primary">Create Casino</a></p>
    @if (count($casinos) == 0) <p>No casinos found.</p>
    @else
    <table class="table casino-table">
        <thead>
            <tr>
                <th class="col">Name</th>
                <th>Site URL</th>
                <th class="col-auto">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($casinos as $casino)
                <tr>
                    <td>{{ $casino->name }}</td>
                    <td>
                        <a href="{{ $casino->site_url }}" target="_blank">{{ $casino->site_url }}</a>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('casino.show', ['id' => $casino->id]) }}" class="btn btn-info btn-sm" target="_blank">Preview</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('casino.edit', ['id' => $casino->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <form action="{{ route('casino.destroy', ['id' => $casino->id]) }}" method="POST" class="casino-action-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this casino?')">
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