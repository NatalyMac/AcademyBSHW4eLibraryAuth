<?php
/**
 * Created by PhpStorm.
 * User: natali
 * Date: 15.07.16
 * Time: 13:03
 */

use Illuminate\Database\Seeder;
use App\Lend as Lend;
use App\User as User;
use App\Book as Book;

class LendSeeder extends Seeder {

    public function run()
    {
        DB::table('lends')->delete();

        factory(Lend::class, 10)->create();

        for ($i=1; $i<=10; $i++)

        {
            $book_id =  Book::all()->random(1)->id;
            $book = Book::find($book_id);
            
            if ( $book->is_charged == false)
            {
                $user_id =  User::all()->random(1)->id;

                $lend = new Lend();
                $lend->user_id = $user_id;
                $lend->book_id = $book_id;
                $lend->date_getin_plan = date ('Y:m:d H:m:s', (time()+60000));

                $lend->save();
                $book->is_charged = true;
                $book->save();
            };
          
        }
        

    }

}