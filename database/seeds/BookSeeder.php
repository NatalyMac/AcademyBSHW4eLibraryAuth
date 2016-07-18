<?php
/**
 * Created by PhpStorm.
 * User: natali
 * Date: 15.07.16
 * Time: 12:59
 */
use Illuminate\Database\Seeder;
use App\Book as Book;

class BookSeeder extends Seeder {

    public function run()
    {
        DB::table('books')->delete();

        factory(Book::class, 20)->create();

    }

}