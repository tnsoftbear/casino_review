<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" id="name" value="{!! old('name', $article->name) !!}" class="form-control" required>
    @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="meta_title" class="form-label">Meta Title</label>
    <input type="text" name="meta_title" id="meta_title" value="{!! old('meta_title', $article->meta_title) !!}" class="form-control">
    @error('meta_title') <div class="alert alert-danger">{{ $message }}</div> @enderror
    <a href="#" onclick="document.getElementById('meta_title').value = document.getElementById('name').value; return false;">Copy name</a>
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">Meta Description</label>
    <input type="text" name="meta_description" id="meta_description" value="{!! old('meta_description', $article->meta_description) !!}" class="form-control">
    @error('meta_description') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">Meta Keywords</label>
    <input type="text" name="meta_keywords" id="meta_keywords" value="{!! old('meta_keywords', $article->meta_keywords) !!}" class="form-control">
    @error('meta_keywords') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" id="slug" value="{!! old('slug') ?: session('failed_slug') ?: $article->slug !!}" class="form-control">
    @error('slug') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="rubric_id" class="form-label">Rubric</label>
    <select name="rubric_id" id="rubric_id" class="form-select" @error('rubric_id') is-invalid @enderror>
        @foreach(config('article.rubric') as $id => $name)
            <option value="{{ $id }}" @if($id == old('rubric_id', $article->rubric_id)) selected @endif>{{ $name }}</option>
        @endforeach
    </select>
    @error('rubric_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="author_user_id" class="form-label">Author</label>
    <select name="author_user_id" id="author_user_id" class="form-select" @error('author_user_id') is-invalid @enderror>
        @foreach($authorUsers as $userId => $name)
            <option value="{{ $userId }}" @if($userId == old('author_user_id', $article->author_user_id)) selected @endif>{{ $name }}</option>
        @endforeach
        {{-- <option value="100">AAA</option> --}}
    </select>
    @error('author_user_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="publish_at" class="form-label">Publish Date</label>
    <input type="datetime-local" name="publish_at" id="publish_at" value="{!! old('publish_at', $article->publish_at) !!}" class="form-control">
    @error('publish_at') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="unpublish_at" class="form-label">Unpublish Date</label>
    <input type="datetime-local" name="unpublish_at" id="unpublish_at" value="{!! old('unpublish_at', $article->unpublish_at) !!}" class="form-control">
    @error('unpublish_at') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea name="content" id="content" class="form-control" rows="10">{!!old('content', $article->content)!!}</textarea>
    @error('content') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="teaser" class="form-label">Teaser</label>
    <textarea name="teaser" id="teaser" class="form-control" rows="3">{!!old('teaser', $article->teaser)!!}</textarea>
    @error('teaser') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>
