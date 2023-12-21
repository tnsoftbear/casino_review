@extends('admin.layout.default')

@section('content')

<style>
.action-button {
    background-color: rgb(38, 70, 251);
    color: rgb(255, 255, 255);
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    width: 80px;
}
</style>

    <form action="{{ route('casino.update', ['id' => $casino->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.casino.edit_fields')
    
        <div>
            <button type="submit" class="action-button">Submit</button>
            @include('admin.casino.delete_button')
            <button type="button" class="action-button" onclick="window.location='{{ route('casino.index') }}'">Cancel</button>
        </div>
    </form>

@endSection