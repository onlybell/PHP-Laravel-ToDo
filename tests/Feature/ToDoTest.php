<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ToDo;

class ToDoTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Auth user profile data
     *
     * @return void
     */
    public function testToDoListData()
    {
        $todo = ToDo::factory()->create();

        $response = $this->actingAs($todo,'api')
            ->getJson('/api/todolist');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => true,
            ]);
    }

    /**
     * Store ToDo
     *
     * @return void
     */
    public function testStoreToDo()
    {
        $todo = ToDo::factory()->create();

        $data = [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'title'=> $this->faker->word,
            'description'=> $this->faker->text,
            'due_at'=> '2021-01-08',
        ];

        $response = $this->actingAs($todo, 'api')
            ->postJson('/api/todos', $data);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    /**
     * Update ToDo
     *
     * @return void
     */
    public function testUpdateToDo()
    {
        $todo = ToDo::factory()->create();

        $data = [
            'title'=> $this->faker->word,
            'description'=> $this->faker->text,
            'due_at'=> '2021-01-20',
        ];

        $response = $this->actingAs($todo, 'api')
            ->postJson('/api/todoUpdate/' . $todo->id, $data);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    /**
     * Update complete ToDo
     *
     * @return void
     */
    public function testUpdateCompleteToDo()
    {
        $todo = ToDo::factory()->create();

        $data = [
            'completed'=> 'Y'
        ];

        $response = $this->actingAs($todo, 'api')
            ->postJson('/api/todoComplete/' . $todo->id, $data);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    /**
     * Delete ToDo
     *
     * @return void
     */
    public function testDeleteToDo()
    {
        $todo = ToDo::factory()->create();

        $response = $this->actingAs($todo, 'api')
            ->deleteJson('/api/todoDelete/' . $todo->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }
}
