<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Page;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call([
        //    PageSeeder::class,
        //]);
        $role = Role::updateOrCreate([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Administrator Akses',
        ]);
        $user = User::updateOrCreate(
            [
                'email' => 'admin@email.com'
            ],
            [
                'name' => 'Administrator',
                'password' => bcrypt('#B1mill4h@')
            ],
        );
        if(!$user->hasRole('admin')){
            $user->addRole($role);
        }
    }
}
