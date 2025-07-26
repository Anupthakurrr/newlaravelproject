<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">🛍️ Product List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        @foreach($products as $id => $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">Price: ₹{{ $product['price'] }}</p>
                        <form method="POST" action="{{ route('cart.add', $id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">🛒 View Cart</a>
    </div>
</div>

</body>
</html>
