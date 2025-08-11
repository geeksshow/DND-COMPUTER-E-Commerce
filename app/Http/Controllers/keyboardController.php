<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyboard;

class keyboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Check if keyboards table exists and has data
            $keyboardsExist = \Schema::hasTable('keyboards');
            
            if (!$keyboardsExist) {
                // Table doesn't exist, show coming soon page
                return view('keyboard', [
                    'keyboards' => collect([]),
                    'brands' => collect([]),
                    'layouts' => collect([]),
                    'connectivityTypes' => collect([]),
                    'priceRange' => ['min' => 0, 'max' => 0],
                    'comingSoon' => true
                ]);
            }

            $query = Keyboard::active()->inStock();

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('brand', 'like', "%{$search}%")
                      ->orWhere('switch_type', 'like', "%{$search}%");
                });
            }

            // Filter by brand
            if ($request->filled('brand')) {
                $query->where('brand', $request->brand);
            }

            // Filter by price range
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Filter by layout
            if ($request->filled('layout')) {
                $query->where('layout', $request->layout);
            }

            // Filter by connectivity
            if ($request->filled('connectivity')) {
                $query->where('connectivity', $request->connectivity);
            }

            // Sort functionality
            $sort = $request->get('sort', 'name');
            $direction = $request->get('direction', 'asc');
            
            if (in_array($sort, ['name', 'price', 'brand', 'created_at'])) {
                $query->orderBy($sort, $direction);
            }

            $keyboards = $query->paginate(12)->withQueryString();

            // Get unique values for filters
            $brands = Keyboard::active()->distinct()->pluck('brand')->sort();
            $layouts = Keyboard::active()->distinct()->pluck('layout')->sort();
            $connectivityTypes = Keyboard::active()->distinct()->pluck('connectivity')->sort();
            $priceRange = [
                'min' => Keyboard::active()->min('price') ?? 0,
                'max' => Keyboard::active()->max('price') ?? 0
            ];

            return view('keyboard', compact('keyboards', 'brands', 'layouts', 'connectivityTypes', 'priceRange'));

        } catch (\Exception $e) {
            // If any error occurs, show coming soon page
            return view('keyboard', [
                'keyboards' => collect([]),
                'brands' => collect([]),
                'layouts' => collect([]),
                'connectivityTypes' => collect([]),
                'priceRange' => ['min' => 0, 'max' => 0],
                'comingSoon' => true
            ]);
        }
    }
}
