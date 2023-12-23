<div class="mb-3">
    <label for="rubric_id" class="form-label">Rubric</label>
    <select name="rubric_id" id="rubric_id" class="form-select" @error('rubric_id') is-invalid @enderror>
        @foreach(config('casino.rubric') as $rubricId => $rubricName)
            <option value="{{ $rubricId }}" @if($rubric_id == $rubricId) selected @endif>{{ $rubricName }}</option>
        @endforeach
        {{-- <option value="100">AAA</option> --}}
    </select>
    @error('rubric_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>