<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use App\Models\UserTypeTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Admin' => [
                'en' => 'Admin',
                'ar' => 'مسئول'
            ],
            'Customer' => [
                'en' => 'Customer',
                'ar' => 'مشتري'
            ],
            'Seller' => [
                'en' => 'Seller',
                'ar' => 'بائع'
            ],
        ];
        DB::beginTransaction();
        foreach ($types as $mainKey => $type) {
            // Check Existence of User Type to prevent duplications
            $userType = UserType::whereHas('translations', function ($query) use ($mainKey) {
                return $query->where('name', '=', $mainKey);
            })->first();
            // If Exists => Don't Create
            if ($userType) {
                continue;
            }
            $userType = UserType::create([]);
            foreach ($type as $key => $value) {
                // Check Existence of User Type Translation to prevent duplications
                $userTypeTranslation = UserTypeTranslation::where('name', '=', $value)
                    ->where('user_type_id', '=', $userType->id)
                    ->first();
                // If Exists => Don't Create
                if ($userTypeTranslation) {
                    continue;
                }
                $userType->translations()->create([
                    'locale' => $key,
                    'name' => $value
                ]);
            }
        }
        DB::commit();
    }
}
