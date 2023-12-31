<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/i/logo/navbar-logo.png" alt="Chips"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @foreach (config('public.menu') as $key => $value)
                    @if(is_array($value))
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown">{{ __('menu.' . $key) }}</a>
                            <ul class="dropdown-menu">
                                @foreach ($value as $arr)
                                <li><a class="dropdown-item" href="{!! route($arr[1]) !!}">{{ __('menu.' . $arr[0]) }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{!! route($value) !!}">{{ __('menu.' . $key)  }}</a> </li>
                    @endif
                @endforeach
            </ul>
        </div> <!-- navbar-collapse.// -->
    </div> <!-- container-fluid.// -->
</nav>

<style>
    @media all and (min-width: 992px) {
        .navbar .nav-item .dropdown-menu {
            display: none;
        }
        .navbar .nav-item:hover .nav-link {}
        .navbar .nav-item:hover .dropdown-menu {
            display: block;
        }
        .navbar .nav-item .dropdown-menu {
            margin-top: 0;
        }
        .navbar-custom {
            background-color: #450101; /* Темный бордовый цвет фона */
            border-color: #000; /* Цвет бордюра */
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // make it as accordion for smaller screens
        if (window.innerWidth > 992) {
            document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem) {
                everyitem.addEventListener('mouseover', function(e) {
                    let el_link = this.querySelector('a[data-bs-toggle]');
                    if (el_link != null) {
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.add('show');
                        nextEl.classList.add('show');
                    }

                });
                everyitem.addEventListener('mouseleave', function(e) {
                    let el_link = this.querySelector('a[data-bs-toggle]');
                    if (el_link != null) {
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.remove('show');
                        nextEl.classList.remove('show');
                    }
                })
            });
        }
        // end if innerWidth
    });
</script>
