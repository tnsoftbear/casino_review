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

    <form action="{{ route('casino.update', ['id' => $id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.casino.edit_fields')
    
        <div>
            <input type="submit" class="action-button" value="Submit">
            <input type="button" class="action-button" value="Cancel" onclick="window.location='{{ route('casino.index') }}'">
        </div>
    </form>
    @include('admin.casino.delete_button')

@endSection