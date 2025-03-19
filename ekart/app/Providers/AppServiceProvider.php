<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;  // Import Log Facade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Log cart count and total to make sure they are correct
        Log::info('Cart Count: ' . $this->getCartCount());
        Log::info('Cart Total: ' . $this->getCartTotal());

        // Share the data with all views
        View::share('cartCount', $this->getCartCount());
        View::share('cartTotal', $this->getCartTotal());
    }

    /**
     * Get the total count of items in the cart for the logged-in user.
     *
     * @return int
     */
    protected function getCartCount()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            return Cart::where('user_id', $userId)->sum('quantity');
        }
        return 0;  // If the user is not logged in, return 0
    }

    /**
     * Get the total price of items in the cart for the logged-in user.
     *
     * @return float
     */
    protected function getCartTotal()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = Cart::where('user_id', $userId)->get();

            // Log the cart items for debugging
            Log::info('Cart Items for User ' . $userId, $cartItems->toArray());

            // Calculate the total price of the cart
            return $cartItems->reduce(function ($total, $item) {
                return $total + ($item->price * $item->quantity);
            }, 0);
        }
        return 0.0;  // If the user is not logged in, return 0
    }
}
