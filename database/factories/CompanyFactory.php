<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'company_name' => '株式会社 佐藤',
            'company_name_kana' => 'カブシキガイシャ サトウ',
            'address' => $this->faker->address(),
            'tel' => $this->faker->phoneNumber(),
            'representative' => '佐藤 太郎',
            'representative_kana' => 'サトウ タロウ',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
