<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" value="{!! $name !!}" class="form-control" required>
    @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="site_url" class="form-label">Site URL</label>
    <input type="url" name="site_url" id="site_url" placeholder="https://example.com" pattern="https://.*" size="30" class="form-control" value="{!! $site_url !!}" />
    @error('site_url') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="10">@if($description) {!! $description !!} @endif</textarea>
    @error('description') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
