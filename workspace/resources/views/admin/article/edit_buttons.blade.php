<button type="submit" class="btn btn-success" name="save" value="save">Save</button>
<button type="submit" class="btn btn-success" name="save" value="save_and_new">Save & New</button>
<button type="submit" class="btn btn-success" name="save" value="save_and_exit">Save & Exit</button>
<a href="{{ route('public.article.show', ['slug' => $article->slug]) }}" class="btn btn-info" target="_blank">View</a>
<input type="reset" class="btn btn-warning" value="Reset the form" />
<button type="button" class="btn btn-warning" onclick="window.location='{{ route('article.index') }}'">Back</button>