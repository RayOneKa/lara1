<?php

namespace App\Http\Controllers;

use App\Jobs\ExportCategories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index ()
    {
        $users = User::get();
        return view('admin.home', compact('users'));
    }

    public function enterAsUser ($userId)
    {
        Auth::loginUsingId($userId);
        return redirect()->route('home');
    }

    public function exportCategories ()
    {
        $exportColumns = true;
        ExportCategories::dispatch($exportColumns);
    }

    public function users ()
    {
        $length = request('length');
        $query = User::query();
        $filters = request('filters');
        $sortColumn = request('sortColumn');
        foreach ($filters as $column => $filter) {
            if ($filter['value']) {
                $value = $filter['type'] == 'like' ? "%{$filter['value']}%" : $filter['value'];
                $query->where($column, $filter['type'], $value);
            }
        }
        return $query->orderBy($sortColumn['column'], $sortColumn['direction'])->paginate($length);
    }
}
