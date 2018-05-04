<?php

use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //'id','make','name','category','speed','acceleration','braking','cornering','stability','power','price','drive'
    public function run()
    {
        $file = public_path().'/csv/GT.csv';
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $power = substr($data[8], 0, strpos($data[8], " HP"));
                $power = $power == "??" ? "0" : $power;
                $power = filter_var($power, FILTER_SANITIZE_NUMBER_INT);

                $price = substr($data[9], 0, strpos($data[9], " Cr"));
                $price = $price == "??" ? "0" : $price;
                $price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);

                $car = new \App\Car([
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'make' => $data[0],
                    'name' => $data[1],
                    'category' => $data[2],
                    'speed' => $data[3],
                    'acceleration' => $data[4],
                    'braking' => $data[5],
                    'cornering' => $data[6],
                    'stability' => $data[7],
                    'power' => $power,
                    'price' => $price,
                    'drive' => $data[10],
                ]);
                $car->save();
            }
            fclose($handle);
        }
    }
}
