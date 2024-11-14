<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->paginate(10);

        if ($products->count() == 0) {
            session()->flash('message', 'No products found for your search.');
            return redirect()->route('userproduct');
        }

        session()->flash('success', 'These are your products.');
        return view('users.template.userproduct', compact('products'));
    }

    // This method will return JSON data for autocomplete suggestions (AJAX)
    public function autocompleteSuggestions(Request $request)
    {
        // Ensure the request has a search term
        $searchTerm = $request->input('query');

        // Fetch products that match the search query
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->limit(5)->get();

        // Return products as a JSON response
        return response()->json($products);
    }
}
