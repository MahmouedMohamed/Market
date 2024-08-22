<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSubType;
use App\Models\UserSubTypeTranslation;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Customer' => [
                'Student' => [
                    'en' => 'Student',
                    'ar' => 'طالب'
                ],
                'Normal' => [
                    'en' => 'Normal',
                    'ar' => 'شخص عادي'
                ],
            ],
        ];
        DB::beginTransaction();
        foreach ($types as $mainKey => $subTypes) {
            // Check Existence of User Type to Start Creating It's Sub Types
            $userType = UserType::whereHas('translations', function ($query) use ($mainKey) {
                return $query->where('name', '=', $mainKey);
            })->first();
            // If Not Exists => Don't Create
            if (!$userType) {
                continue;
            }
            foreach ($subTypes as $subTypeKey => $subType) {
                // Check Existence of User Sub Type to prevent duplications
                $userSubType = UserSubType::whereHas('translations', function ($query) use ($subTypeKey) {
                    return $query->where('name', '=', $subTypeKey);
                })->first();
                // If Exists => Don't Create
                if ($userSubType) {
                    continue;
                }
                $userSubType = UserSubType::create([
                    'user_type_id' => $userType->getKey(),
                ]);
                foreach ($subType as $key => $value) {
                    // Check Existence of User Type Translation to prevent duplications
                    $userSubTypeTranslation = UserSubTypeTranslation::where('name', '=', $value)
                        ->where('user_sub_type_id', '=', $userType->id)
                        ->first();
                    // If Exists => Don't Create
                    if ($userSubTypeTranslation) {
                        continue;
                    }
                    $userSubType->translations()->create([
                        'locale' => $key,
                        'name' => $value
                    ]);
                }
            }
        }
        DB::commit();
    }
}
