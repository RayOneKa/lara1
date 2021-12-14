<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $date = date('d.m.Y H:i:s');
        Storage::append('ownLog.log', "[HomePageEnter] $date {$user->name} зашел на страницу home");
        $categories = Category::get();

        $data = [
            'categories' => $categories,
            'title' => 'Список категорий',
            'showTitle' => true
        ];
        return view('home', $data);
    }

    public function category (Category $category)
    {
        $test = 'Тестовое значение';
        return view('category', ['category' => $category, 'test' => $test]);
    }

    public function profile ()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
