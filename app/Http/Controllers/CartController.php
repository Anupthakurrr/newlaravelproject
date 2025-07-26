<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Step 1: Hardcoded products (ID => [Name, Price])
    private $products = [
        1 => ['name' => 'Laptop', 'price' => 1000],
        2 => ['name' => 'Phone', 'price' => 500],
        3 => ['name' => 'Headphones', 'price' => 150],
    ];

    // Step 2: Show all products
    public function index()
    {
        return view('products', ['products' => $this->products]);
    }

    // Step 3: Show cart
    public function cart()
    {
        $cart = session('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    // Step 4: Add item to cart
    public function add(Request $request, $id)
{
    $cart = session('cart', []);

    if (isset($this->products[$id])) {
        $product = $this->products[$id];

        if (isset($cart[$id])) {
            // Increase quantity if product exists
            $cart[$id]['quantity']++;
        } else {
            // Add product with quantity 1 if not exists
            $cart[$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        session()->flash('success', 'Product added to cart!');
    }

    return redirect()->route('products.index');
}


    // Step 5: Update quantity
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
            session(['cart' => $cart]);
            session()->flash('success', 'Cart updated!');
        }

        return redirect()->route('cart.index');
    }

    // Step 6: Remove product from cart
    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            session()->flash('success', 'Product removed from cart!');
        }

        return redirect()->route('cart.index');
    }

    // Step 7: Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        session()->flash('success', 'Cart cleared!');
        return redirect()->route('cart.index');
    }

    // Step 8: Fake checkout
    public function checkout()
    {
        session()->forget('cart');
        session()->flash('success', 'Thank you for your purchase!');
        return redirect()->route('products.index');
    }
}
