<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

use Srmklive\PayPal\Facades\PayPal;

class HomepageController extends Controller
{

    public function home(){
        return view("users/home");
    }
    // Method to show the registration form
    public function showRegisterForm()
    {
        return view('users.userRegister'); // Ensure this matches your Blade file name
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('userproduct')->with('message', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('userproduct')->with('message', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function userproduct()
    {
        $products= Product::latest()->paginate(15);
        return view('users.template.userproduct',compact('products')); // This should match a blade view file
    }
    public function cart()
{
    $userId = Auth::id();
    $cartItems = Cart::with('product')->where('user_id', $userId)->get();

    // If no items, ensure it's an empty collection
    if ($cartItems === null) {
        $cartItems = collect(); // Or you can use an empty array: []
    }

    // Calculate total price
    $cartTotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    // Calculate total number of items (cart count)
    $cartCount = $cartItems->sum('quantity'); // This will sum the quantity of each item

    // Return the cart view with the cart items, total price, and cart count
    return view('users.template.usercart', compact('cartItems', 'cartTotal', 'cartCount'));
}


    public function add(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure the product exists
            'quantity' => 'required|integer|min:1' // Quantity must be a positive integer
        ]);

        $userId = Auth::id(); // Get the authenticated user's ID
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Check if the product already exists in the cart for the user
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // If the item already exists, increment the quantity
            $cartItem->quantity += $quantity; // Adjust quantity based on user input
            $cartItem->save();
        } else {
            // If the item does not exist, create a new cart entry
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => Product::find($productId)->price, // Fetch the product price
            ]);
        }

        return redirect()->route('usercart')->with('success', 'Product successfully added to cart!');
    }


        public function logout(Request $request)
{
    Auth::logout();
    return redirect('login')->with('message', 'Logged out successfully.');
}


    public function remove(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'cart_item_id' => 'required|exists:cart,id',
        ]);
        $userId = Auth::id();
        $cartItemId = $request->input('cart_item_id');

        // Log the cart item ID being removed
        Log::info('Attempting to remove cart item with ID: ' . $cartItemId);

        // Fetch the cart item
        $cartItem = Cart::where('user_id',  $userId)->where('id', $cartItemId)->first();

        // Check if the cart item was found
        if (!$cartItem) {
            Log::warning('Cart item not found for user ID ' .  $userId . ' and cart item ID ' . $cartItemId);
            return redirect()->route('usercart')->with('error', 'Item not found in cart.');
        }

        // If found, delete the cart item
        $cartItem->delete();
        Log::info('Cart item removed successfully', ['cartItemId' => $cartItemId]);

        return redirect()->route('usercart')->with('success', 'Item removed from cart.');
    }


    public function checkout(Request $request)
    {
        // Validate incoming address data
        $request->validate([
            'flat_no' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'state' => 'required|string|max:255',
        ]);

        // Create address entry
        UserAddress::create([
            'user_id' => Auth::id(),
            'flat_no' => $request->flat_no,
            'area' => $request->area,
            'location' => $request->location,
            'city' => $request->city,
            'district' => $request->district,
            'pincode' => $request->pincode,
            'state' => $request->state,
        ]);

        // Redirect to the payment page or perform the payment process
        return redirect()->route('payment')->with('message', 'Address saved successfully! Proceed to payment.');
    }
    public function payment()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        // Calculate total price
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('users.template.userpayment', compact('cartItems', 'cartTotal'));
    }
    public function paypal(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'price' => 'required|numeric',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if the user has a saved address
        $userId = Auth::id();
        $address = UserAddress::where('user_id', $userId)->first();

        if (!$address) {
            return redirect()->route('usercart')->withErrors('Please provide your address before proceeding to payment.');
        }

        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->quantity);
                    session()->put('user_id', $userId); // Store user ID for later use
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $payment = new Payment();
            $payment->payment_id = $response['id'];
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "paypal";
            $payment->user_id = session()->get('user_id'); // Store user ID
            $payment->save();

            // Clear session data
            session()->forget(['product_name', 'quantity', 'user_id']);

            return redirect()->route('usercart')->with("message", "Payment is successful") ;
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        return "Payment is cancelled";
    }
}


