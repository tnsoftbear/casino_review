<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Bootstrap Layout Example</title>
</head>
<body>

<!-- Заголовок -->
<header class="bg-dark text-white text-center py-3">
    <h1>Заголовок вашего сайта</h1>
</header>

<!-- Контент -->
<div class="container mt-4">
    <div class="row">
        
@foreach ($articles as $article)

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $article['name'] }}</h5>
                    <p class="card-text">{{ $article['teaser'] }}</p>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $article['author'] }}</span>
                    <span>{{ $article['when'] }}</span>
                </div>
            </div>
        </div>

@endforeach

    </div>
</div>

<!-- Футер -->
<footer class="bg-dark text-white text-center py-3 mt-4">
    <p>Ваш футер &copy; 2023</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
