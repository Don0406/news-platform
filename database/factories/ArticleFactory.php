<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        $categories = ['Business', 'Sports', 'Entertainment', 'Technology', 'Health', 'Science', 'Politics'];
        
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(6),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(10, true),
            'category' => $this->faker->randomElement($categories),
            'featured_image' => null,
            'status' => 'published',
            'user_id' => User::factory(),
            'views' => $this->faker->numberBetween(0, 1000),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 months', 'now'),
        ];
    }
    
    /**
     * Indicate that the article is a draft.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
    
    /**
     * Indicate that the article is pending review.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'published_at' => null,
        ]);
    }
    
    /**
     * Indicate that the article is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}