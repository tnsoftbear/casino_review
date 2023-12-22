@extends('admin.layout.default')

@section('content')

<style>
.casino-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.casino-table th, .casino-table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

.casino-action {
    margin-right: 10px;
    text-decoration: none;
    color: #007BFF;
}

</style>

<p><a href="{{ route('casino.create') }}">Create Casino</a></p>
<table class="casino-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Rubric</th>
            <th>Site URL</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($casinos as $casino)
            <tr>
                <td>
                    {{ $casino->name }}
                </td>
                <td>
                    {{ config('casino.rubric')[(int)$casino->rubric_id] }}
                </td>
                <td>
                    <a href="{{ $casino->site_url }}" target="_blank">{{ $casino->site_url }}</a>
                </td>
                <td>
                    <a href="{{ route('casino.show', ['id' => $casino->id]) }}" class="casino-action">Preview</a>
                    <a href="{{ route('casino.edit', ['id' => $casino->id]) }}" class="casino-action">Edit</a>
                    @include('admin.casino.delete_button', ['id' => $casino->id])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection