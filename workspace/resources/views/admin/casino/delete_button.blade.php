<form action="{{ route('casino.destroy', ['id' => $id]) }}" method="POST" class="casino-action-form">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" class="btn btn-danger @isset($small) btn-sm @endif" onclick="return confirm('Are you sure you want to delete this casino?')">
</form>