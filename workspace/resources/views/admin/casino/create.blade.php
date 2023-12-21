@extends('admin.layout.default')

@section('content')

    <form action="{{ route('casino.store') }}" method="POST">
        @csrf
        @include('admin.casino.edit_fields')
    
        <div>
            <button type="submit">Submit</button>
            <button type="button" onclick="window.location='{{ route('casino.index') }}'">Cancel</button>
        </div>
    </form>

@endSection