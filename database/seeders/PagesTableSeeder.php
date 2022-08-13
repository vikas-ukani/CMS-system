<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $pages = [
            [
                // 'id' => 1,
                'title' => "Root Page",
                'slug' => 'root-page',
                'parent_id' => null,
                'content' => "<p>Root Page</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 2,
                'title' => "Main Page",
                'slug' => 'main-page',
                'parent_id' => 1,
                'content' => "<p>Main Page</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 3,
                'title' => "Home Page",
                'slug' => 'home-page',
                'parent_id' => 2,
                'content' => "<p>Home Page</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 4,
                'title' => "Sub Home Page",
                'slug' => 'sub-home-page',
                'parent_id' => 3,
                'content' => "<p>Sub Home Page</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 5,
                'title' => "Page 1",
                'slug' => 'page-1',
                'parent_id' => 3,
                'content' => "<p>Page 1</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 6,
                'title' => "Page 2",
                'slug' => 'page-2',
                'parent_id' => 5,
                'content' => "<p>Page 2</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 7,
                'title' => "Page 3",
                'slug' => 'page-3',
                'parent_id' => 6,
                'content' => "<p>Page 3</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 8,
                'title' => "Page 4",
                'slug' => 'page-4',
                'parent_id' => 7,
                'content' => "<p>Page 4</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 9,
                'title' => "Page 5",
                'slug' => 'page-5',
                'parent_id' => 8,
                'content' => "<p>Page 5</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                // 'id' => 10,
                'title' => "Home 1 Page",
                'slug' => 'home-1-page',
                'parent_id' => 2,
                'content' => "<p>Home 1 Page</p>",
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];
        \DB::table('pages')->insert($pages);
    }
}
