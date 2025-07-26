<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">🛒 Your Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php $total = 0; @endphp

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Subtotal (₹)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                    @csrf
                               <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control me-2" style="width: 80px;">
                                    <button class="btn btn-sm btn-outline-success">Update</button>
                                </form>
                            </td>
                            <td>{{ $subtotal }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <h4><strong>Total: ₹{{ $total }}</strong></h4>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="btn btn-outline-warning">Clear Cart</button>
            </form>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success">Checkout</button>
            </form>
        </div>
    @else
        <div class="alert alert-info text-center">
            Your cart is empty. Go add some products!
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">← Back to Products</a>
    </div>
</div>

</body>
</html>
