<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'admin')->first();
        $employee = new User();
        $employee->name = 'Admin';
        $employee->email = 'admin@example.com';
        $employee->memberid = 'ADMINID';
        $employee->password = bcrypt('123');
        $employee->sponserid = 0;
        $employee->mobile = '9996665554';
        $employee->state = 'Har';
        $employee->country = 'Rewari';
        $employee->account_type = 'bank';
        $employee->bname = '';
        $employee->bifsc = '';
        $employee->baccno = '122';
        $employee->fake_password = '123';
        $employee->save();
        $employee->roles()->attach($role_employee);
        
    }
}
