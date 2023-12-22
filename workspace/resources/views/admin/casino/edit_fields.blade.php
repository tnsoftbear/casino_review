<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{!!$name!!}" required
        @error('name') is-invalid @enderror>
    @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div>
    <label for="rubric_id">Rubric</label>
    <select name="rubric_id" id="rubric_id" @error('rubric_id') is-invalid @enderror>
        @foreach(config('casino.rubric') as $rubricId => $rubricName)
            <option value="{{$rubricId}}" @if($rubric_id == $rubricId) selected @endif>{{$rubricName}}</option>
        @endforeach
        {{-- <option value="100">AAA</option> --}}
    </select>
    @error('rubric_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div>
    <label for="site_url">Site URL</label>
    <input type="text" name="site_url" id="site_url" value="{!!$site_url!!}"
        @error('site_url') is-invalid @enderror>
    @error('site_url') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div>
    <label for="description">Description</label>
    <textarea name="description" id="description"
        @error('description') is-invalid @enderror>{!!$description!!}</textarea>
    @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>