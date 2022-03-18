<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Billings;
use App\Models\Company;

class BillingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'billing_id' => Company::factory(),
            'billing_name' => '株式会社 佐藤',
            'billing_name_kana' => 'カブシキガイシャ サトウ',
            'address' => $this->faker->address(),
            'tel' => $this->faker->phoneNumber(),
            'department' => '営業部',
            'billing_address' => '佐藤 太郎',
            'billing_address_kana' => 'サトウ タロウ',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}