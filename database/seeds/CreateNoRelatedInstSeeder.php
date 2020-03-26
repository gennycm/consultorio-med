<?php
  
use Illuminate\Database\Seeder;
use App\Institution;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateNoRelatedInstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institution = Institution::create([
            'id'=> 1,
        	'name' => 'Ninguna', 
        	'code' => '0',
        	'num_contract' => '0',
        	'rfc' => '0',
        	'cfdi' => '0',
        	'trade_name' => 'Ninguna'
        ]);
  

    }
}
