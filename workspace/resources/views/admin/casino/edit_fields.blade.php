<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="@isset ($casino){!! $casino->name !!}@endisset" required>
</div>

<div>
    <label for="site_url">Site URL</label>
    <input type="text" name="site_url" id="site_url" value="@isset ($casino){!! $casino->site_url !!}@endisset">
</div>

<div>
    <label for="description">Description</label>
    <textarea name="description" id="description">@isset ($casino){!! $casino->description !!}@endisset</textarea>
</div>