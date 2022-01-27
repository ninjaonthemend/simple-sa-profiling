<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['name' => 'English (US)'],
            ['name' => 'British English'],
            ['name' => 'Australian English'],
            ['name' => 'Indian English'],
            ['name' => 'French'],
            ['name' => 'French Canadian'],
            ['name' => 'Italian'],
            ['name' => 'Spanish'],
            ['name' => 'Spanish (Mexico)'],
            ['name' => 'Portuguese (Brazil)'],
            ['name' => 'Portuguese (Portugal)'],
            ['name' => 'Catalan'],
            ['name' => 'Croatian'],
            ['name' => 'German'],
            ['name' => 'Dutch'],
            ['name' => 'Danish'],
            ['name' => 'Swedish'],
            ['name' => 'Finnish'],
            ['name' => 'Norwegian (Bokmål)'],
            ['name' => 'Russian'],
            ['name' => 'Czech'],
            ['name' => 'Slovak'],
            ['name' => 'Polish'],
            ['name' => 'Croatian'],
            ['name' => 'Romanian'],
            ['name' => 'Turkish'],
            ['name' => 'Ukrainian'],
            ['name' => 'Hungarian'],
            ['name' => 'Traditional Chinese'],
            ['name' => 'Traditional Chinese (Hong Kong)'],
            ['name' => 'Simplified Chinese'],
            ['name' => 'Korean'],
            ['name' => 'Japanese'],
            ['name' => 'Vietnamese'],
            ['name' => 'Arabic'],
            ['name' => 'Thai'],
            ['name' => 'Greek'],
            ['name' => 'Hebrew'],
            ['name' => 'Indonesian'],
            ['name' => 'Malay'],
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate($language);
        }
    }
}
