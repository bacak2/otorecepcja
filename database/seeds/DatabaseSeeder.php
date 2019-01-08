<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder to add prices
        /*
        $i=0;
        while ($i<365){
            DB::table('apartament_prices')->insert([
                'apartament_id' => 12,
                'currency_id' => 1,
                'price_value' => 79.00,
                'date_of_price' => date("Y-m-d", time() + 86400*$i),
                'price_discount' => 0,
            ]);

            $i++;
        }

*/
        //seeder to add names of photo from all dir
        //add main.jp, main_big.jpg, mail.jpg and polecane.jpg after this seed
/*
        $apartamentId = 12;
        $dirName = "/home/adminartplus/Pulpit/htdocs/Homerent/httpdocs/public/images/apartaments/$apartamentId";
        $scanned_directory = array_diff(scandir($dirName), array('..', '.'));
        foreach($scanned_directory as $photoName){
            DB::table('apartament_photos')->insert([
                'apartament_id' => $apartamentId,
                'photo_link' => $photoName,
            ]);
        }
*/


        //seeder to add names of photo from whole dir
        $groupId = 3;
        $dirName = "/home/adminartplus/Pulpit/htdocs/Homerent/httpdocs/public/images/apartaments_group/$groupId";
        $scanned_directory = array_diff(scandir($dirName), array('..', '.'));
        foreach($scanned_directory as $photoName){
            DB::table('apartament_group_photos')->insert([
                'group_id' => $groupId,
                'photo_link' => $photoName,
            ]);
        }

    }
}
