<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Laravolt\Avatar\Facade as Avatar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/public/avatars/');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        // Director
        $userDirector = User::create([
            'name' => 'DONI',
            'email' => 'doni@gmail.com',
            'nip' => '1234',
            'password' => bcrypt('123456'),
        ]);
        $userDirector->addRole('director');
        $avatarDirectorName = 'avatar-' . $userDirector->id . '-' . $userDirector['name'] . '.png';
        Avatar::create($userDirector->name)->save($path . $avatarDirectorName);
        Profile::create([
            'user_id' => $userDirector->id,
            'avatar' => 'avatars/' . $avatarDirectorName,
            'jabatan' => "DIREKTUR",
        ]);

        // Finance
        $userFinance = User::create([
            'name' => 'DONO',
            'email' => 'dono@gmail.com',
            'nip' => '1235',
            'password' => bcrypt('123456'),
        ]);
        $userFinance->addRole('finance');
        $avatarFinanceName = 'avatar-' . $userFinance->id . '-' . $userFinance['name'] . '.png';
        Avatar::create($userFinance->name)->save($path . $avatarFinanceName);
        Profile::create([
            'user_id' => $userFinance->id,
            'avatar' => 'avatars/' . $avatarFinanceName,
            'jabatan' => "FINANCE",
        ]);

        // Waste Manager
        $userStaff = User::create([
            'name' => 'DONA',
            'email' => 'dona@gmail.com',
            'nip' => '1236',
            'password' => bcrypt('123456'),
        ]);
        $userStaff->addRole('staff');
        $avatarStaffName = 'avatar-' . $userStaff->id . '-' . $userStaff['name'] . '.png';
        Avatar::create($userStaff->name)->save($path . $avatarStaffName);
        Profile::create([
            'user_id' => $userStaff->id,
            'avatar' => 'avatars/' . $avatarStaffName,
            'jabatan' => "STAFF",
        ]);
    }
}