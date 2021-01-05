<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // $this->call(PageSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(UserAccessSeeder::class);
        
       //USER
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123') , 
            'role' => 'member' , 
            'logo' => 'user/default.jpg'
        ]);

        DB::table('users')->insert([
            'username' => 'jevin',
            'email' => 'jevin@gmail.com',
            'password' => bcrypt('jevin123') , 
            'role' => 'member' , 
            'logo' => 'user/default.jpg'
        ]);

        DB::table('users')->insert([
            'username' => 'adrian',
            'email' => 'adrian@gmail.com',
            'password' => bcrypt('adrian123') , 
            'role' => 'member' , 
            'logo' => 'user/default.jpg'
        ]);
    
        //ITEM 
        DB::table('item')->insert([
            'name' => 'product1',
            'SKU' => 'SPT001' ,
            'user_id' => 1 ,
            'buy_price' => 150000,
            'sell_price' => 10000 , 
            'image' => 'items/1.jpg',
            'stock' => 100

        ]);

        DB::table('item')->insert([
            'name' => 'product2',
            'SKU' => 'SPT002' , 
            'user_id' => 1 ,
            'buy_price' => 200000,
            'sell_price' => 10000 , 
            'image' => 'items/2.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product3',
            'SKU' => 'SPT003' , 
            'user_id' => 1 ,
            'buy_price' => 1000000,
            'sell_price' => 10000 , 
            'image' => 'items/3.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product4',
            'SKU' => 'SPT004' , 
            'user_id' => 1 ,
            'buy_price' => 400000,
            'sell_price' => 10000 , 
            'image' => 'items/4.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product5',
            'SKU' => 'SPT005' , 
            'user_id' => 1 ,
            'buy_price' => 650000,
            'sell_price' => 10000 , 
            'image' => 'items/5.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product6',
            'SKU' => 'SPT006' , 
            'user_id' => 1 ,
            'buy_price' => 250000,
            'sell_price' => 10000 , 
            'image' => 'items/6.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product7',
            'SKU' => 'SPT007' , 
            'user_id' => 1 ,
            'buy_price' => 650000,
            'sell_price' => 10000 , 
            'image' => 'items/7.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product8',
            'SKU' => 'SPT008' , 
            'user_id' => 1 ,
            'buy_price' => 250000,
            'sell_price' => 10000 , 
            'image' => 'items/8.jpg',
            'stock' => 100
        ]);

        DB::table('item')->insert([
            'name' => 'product9',
            'SKU' => 'SPT009' , 
            'user_id' => 1 ,
            'buy_price' => 250000,
            'sell_price' => 10000 , 
            'image' => 'items/9.jpg',
            'stock' => 100
        ]);

        
        //marketplace
        DB::table('marketplace')->insert([
            'name' => 'lazada',
            'initials' => 'LZ',
            'logo' => 'marketplace/lazada.png'
        ]);

        DB::table('marketplace')->insert([
            'name' => 'tokopedia',
            'initials' => 'TP',
            'logo' => 'marketplace/tokopedia.png'
        ]);

        DB::table('marketplace')->insert([
            'name' => 'shopee',
            'initials' => 'SP',
            'logo' => 'marketplace/shopee.png'
        ]);

        //courier
        DB::table('courier')->insert([
            'name' => 'JNE',
            'logo' => 'courier/jne.jpg'
        ]);

        DB::table('courier')->insert([
            'name' => 'JNT',
            'logo' => 'courier/jnt.jpg'
        ]);

        DB::table('courier')->insert([
            'name' => 'SICEPAT',
            'logo' => 'courier/sicepat.jpg'
        ]);

        //transaction status
        DB::table('transaction_status')->insert([
            'name' => 'PENDING'
        ]);

        DB::table('transaction_status')->insert([
            'name' => 'PROCESSED'
        ]);

        DB::table('transaction_status')->insert([
            'name' => 'SHIPPED'
        ]);

        DB::table('transaction_status')->insert([
            'name' => 'DELIVERED'
        ]);

        DB::table('transaction_status')->insert([
            'name' => 'RETURN'
        ]);

        
        DB::table('transaction_status')->insert([
            'name' => 'CANCELLED'
        ]);
        

    }
}
