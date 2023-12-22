<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" value="{!! $name !!}" class="form-control" required>
    @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

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

<div class="mb-3">
    <label for="site_url" class="form-label">Site URL</label>
    <input type="text" name="site_url" id="site_url" value="{!! $site_url !!}" class="form-control">
    @error('site_url') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="10">@if($description) {!! $description !!} @endif</textarea>
    @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
