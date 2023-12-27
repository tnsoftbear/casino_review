<div class="mb-3">
    <label for="login" class="form-label">Login</label>
    <input type="text" name="login" id="login" value="{{ old('login', $user->login) }}" class="form-control" required>
    @error('login') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control">
    @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
    @error('password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="form-check">
    <label for="is_admin" class="form-check-label">Is Admin</label>
    <input type="checkbox" name="is_admin" value="1" @checked(old('is_admin', $user->is_admin)) class="form-check-input" />
    @error('is_admin') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="form-check">
    <label for="is_author" class="form-check-label">Is Author</label>
    <input type="checkbox" name="is_author" value="1" @checked(old('is_author', $user->is_author)) class="form-check-input" />
    @error('is_author') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="first_name" class="form-label">First name</label>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $userPersonal->first_name) }}" class="form-control">
    @error('first_name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="last_name" class="form-label">Last name</label>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $userPersonal->last_name) }}" class="form-control">
    @error('last_name') <div class="alert alert-danger">{{ $message }}</div> @enderror
</div>

