<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('test', function () {
    $str = 'En_en';

    $new_str = str_replace('_', '-', $str);
    dd($new_str);
});

Artisan::command('inspire', function () {

    // Создание записей в таблице
    $procs = new Category();
    $procs->name = 'Видеокарты';
    $procs->description = 'Описание видеокарт';
    $procs->picture = '2.jpg';
    // $procs->save();

    $procs = Category::find(1);

    $categories = Category::get();

    $videocards = Category::where('name', 'like', 'Видео%')->first();

    // Category::create([
    //     'name' => 'Жесткие диски',
    //     'description' => 'SSD, HDD',
    //     'picture' => '2.jpg'
    // ]);

    $drives = Category::firstOrNew([
        'name' => 'Процессоры3',
        'description' => 'Описание процессоров',
        'picture' => '1.jpg'
    ]);

    Category::where('id', '>', 4)->delete();

    Category::where('id', '<', 4)->update([
        'picture' => '4.jpg'
    ]);    

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
