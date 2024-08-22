<?php

namespace Database\Seeders;

use App\Models\Nationality;
use App\Models\NationalityTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nationalities = [
            'Egypt' => [
                'en' => 'Egypt',
                'ar' => 'مصر'
            ],
        ];
        DB::beginTransaction();
        foreach ($nationalities as $mainKey => $type) {
            // Check Existence of Nationality to prevent duplications
            $nationality = Nationality::whereHas('translations', function ($query) use ($mainKey) {
                return $query->where('name', '=', $mainKey);
            })->first();
            // If Exists => Don't Create
            if ($nationality) {
                continue;
            }
            $nationality = Nationality::create([]);
            foreach ($type as $key => $value) {
                // Check Existence of Nationality Translation to prevent duplications
                $nationalityTranslation = NationalityTranslation::where('name', '=', $value)
                    ->where('nationality_id', '=', $nationality->id)
                    ->first();
                // If Exists => Don't Create
                if ($nationalityTranslation) {
                    continue;
                }
                $nationality->translations()->create([
                    'locale' => $key,
                    'name' => $value
                ]);
            }
        }
        DB::commit();
    }
}
