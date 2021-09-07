<?php

namespace Database\Seeders;
use App\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $deliveryRecords = [
            ['id'=>1 , 'user_id'=> 1, 'name'=> 'Olawale Hammed', 'address'=> 'Test 123', 'city'=> 'New Ajah', 'state' => 'Lagos', 'country'=> 'Nigeria', 'pincode'=> 123456, 'mobile'=> 8168516930, 'status'=> 1],
            ['id'=> 2, 'user_id'=> 1, 'name'=> 'Olawale Hammed', 'address'=> 'ABC- Mall Road', 'city'=> 'New Ajah', 'state' => 'Lagos', 'country'=> 'Nigeria', 'pincode'=> 123456, 'mobile'=> 8168336930, 'status'=> 1],
           
        ];

        DeliveryAddress::insert($deliveryRecords);
    }
}
