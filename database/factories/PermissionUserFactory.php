<?php

namespace Database\Factories;

use App\Domains\Models\Permission;
use App\Domains\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\PermissionUser>
 */
class PermissionUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->createOne()->id,
            'permission_id' => Permission::factory()->createOne()->id
        ];
    }
}
