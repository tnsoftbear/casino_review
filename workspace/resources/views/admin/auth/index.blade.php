@include('admin.layout.header_base', ['pageTitle' => 'Login'])

@include('admin.layout.alerts')

<div class="container-fluid">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 text-left">

            <form action="{{ route('admin.auth.login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="login">Username or e-mail</label>
                    <input type="text" class="form-control" name="login" placeholder="Enter login or e-mail">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Login</button>
            </form>
            
        </div>
    </div>
</div>

@include('admin.layout.footer')
