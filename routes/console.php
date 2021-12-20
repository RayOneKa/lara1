<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Category;
use Carbon\Carbon;
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

Artisan::command('parseEkatalog', function () {

    $data = file_get_contents('https://www.e-katalog.ru/ek-list.php?katalog_=189&search_=3090');

    $dom = new DomDocument();
    @$dom->loadHTML('<?xml encoding="UTF-8">' . $data);

    $xpath = new DOMXpath($dom);
    $tables = $xpath->query("//table[@class='model-short-block']");

    foreach ($tables as $table) {
        $as = $xpath->query("descendant::a[@class='model-short-title no-u']", $table);
        if ($as->length == 1) {
            $name = $as[0]->nodeValue;
            dump($name);
        }
    }
});

Artisan::command('exportCategories', function () {
    $categories = Category::get()->toArray();
    $file = fopen('exportCategories.csv', 'w');
    $columns = [
        'id',
        'name',
        'description',
        'picture',
        'created_at',
        'updated_at'
    ];
    fputcsv($file, $columns, ';');
    foreach ($categories as $category) {
        $category['name'] = iconv('utf-8', 'windows-1251//IGNORE', $category['name']);
        $category['description'] = iconv('utf-8', 'windows-1251//IGNORE', $category['description']);
        $category['picture'] = iconv('utf-8', 'windows-1251//IGNORE', $category['picture']);
        fputcsv($file, $category, ';');
    }
    fclose($file);
});

Artisan::command('importCategories', function () {
    $fileName = 'categories.csv';
    $file = fopen($fileName, 'r');

    $carbon = new Carbon();
    $now = $carbon->now()->toDateTimeString();

    $i = 0;
    $insert = [];
    while ($data = fgetcsv($file, 1000, ';')) {
        if ($i++ == 0) continue;
        $insert[] = [
            'name' => $data[0],
            'description' => $data[1],
            'picture' => $data[2],
            'created_at' => $now,
            'updated_at' => $now
        ];
    }
    Category::insert($insert);
});

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
