<style>
.delete-button {
    background-color: red;
    color: black;
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    width: 80px;
}
</style>

<form action="{{ route('casino.destroy', ['id' => $casino->id]) }}" method="POST" class="casino-action-form">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete" class="delete-button" onclick="return confirm('Are you sure you want to delete this casino?')">
</form>