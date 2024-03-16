<?php

namespace Database\Factories;

use App\Domains\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Models\Imagem>
 */
class ImagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'caminho' => Str::random(45),
            'produto_id' => Produto::factory()->createOne()->id,
            'ativo' => true,
        ];
    }
}
