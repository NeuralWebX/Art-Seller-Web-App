<?php

use App\Models\Role;
use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

// to check if the route has any permission to the auth user
if (!function_exists('hasAnyPermissions')) {

    function hasAnyPermissions($permission)
    {
        return auth()->user()->hasPermission($permission);
    }
}
if (!function_exists('roles')) {

    function roles()
    {
        return Role::all();
    }
}
// generate all routes as permission
if (!function_exists('getAllRoutesInArray')) {
    function getAllRoutesInArray(): array
    {
        $data = [];
        foreach (Route::getRoutes() as $key => $route) {
            if ($route->getName() && $route->getPrefix() != '' && $route->getPrefix() != '_ignition') {
                $data[$key] = [
                    'name' => $route->getName(),
                    'prefix' => $route->getPrefix(),
                ];
            }
        }
        $arr = array();
        foreach ($data as $key => $item) {
            $arr[$item['prefix']][$key] = $item;
        }
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }
}
if (!function_exists('settings')) {
    function settings()
    {
        return Settings::first();
    }
}
if (!function_exists('getNumber')) {
    function getNumber()
    {
        $number = substr(uniqid(), 0, 6);
        return $number;
    }
}
if (!function_exists('categories')) {
    function categories()
    {
        $categories = Category::all();
        return $categories;
    }
}
if (!function_exists('availableWithDraw')) {
    function availableWithDraw()
    {
        $transaction = Transaction::where('author_id', auth()->user()->id)
            ->where('status', 0)
            ->sum('artist_payable');
        return $transaction;
    }
}
if (!function_exists('totalWithDraw')) {
    function totalWithDraw()
    {
        $transaction = Transaction::where('author_id', auth()->user()->id)
            ->where('status', 1)
            ->sum('artist_paid');
        return $transaction;
    }
}
if (!function_exists('sendJson')) {
    function sendJson($message, $data, $status)
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
            "status" => $status,
        ]);
    }
}
if (!function_exists('totalPayAble')) {
    function totalPayAble()
    {
        $totalPayAble = array_sum(array_column(session()->get('cart'), 'sub_total'));
        return $totalPayAble;
    }
}
if (!function_exists('totalCartCount')) {
    function totalCartCount()
    {
        $totalCart = count(session()->get('cart'));
        return $totalCart;
    }
}
if (!function_exists('totalViewCount')) {
    function totalViewCount($id)
    {
        $product = Product::with('productView')->find($id);
        return $product->productView->sum('views');
    }
}
if (!function_exists('payableDue')) {
    function payableDue()
    {
        $payableDue = Transaction::where('author_id', auth()->user()->id)
            ->where('status', 0)
            ->get();
        return $payableDue->sum('artist_payable');
    }
}
if (!function_exists('totalSold')) {
    function totalSold()
    {
        $totalSold = Transaction::where('author_id', auth()->user()->id)
            ->get();
        return count($totalSold);
    }
}
if (!function_exists('ownedItems')) {
    function ownedItems()
    {
        $ownedItems = Product::where('user_id', auth()->user()->id)
            ->get();
        return count($ownedItems);
    }
}
