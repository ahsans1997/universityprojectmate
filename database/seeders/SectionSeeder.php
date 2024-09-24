<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['code' => 'A', 'name' => 'Section A'],
            ['code' => 'B', 'name' => 'Section B'],
            ['code' => 'C', 'name' => 'Section C'],
            ['code' => 'D', 'name' => 'Section D'],
            ['code' => 'E', 'name' => 'Section E'],
        ];

        foreach ($sections as $section) {
            if(Section::where('code', $section['code'])->count() === 0) {
                Section::create($section);
            }
        }
    }
}
