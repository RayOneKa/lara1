<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function profile (Request $request)
    {
        // Auth::loginUsingId(1);
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function profileUpdate (Request $request)
    {
        $request->validate([
            'picture' => 'mimes:jpg,bmp,png',
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        $user = User::find(Auth::user()->id);

        $file = $request->file('picture');
        $input = $request->all();

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . rand(1000, 9999) . '.' . $ext;
            $file->storeAs('public/users', $fileName);
            $user->picture = $fileName;
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        return back();
    }
}
