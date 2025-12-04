<?php

namespace Tests\Feature;

use App\Contracts\AIActorInterface;
use App\DTO\ActorProfileData;
use App\Exceptions\IncompleteActorDataException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery\MockInterface;

class ActorSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_actor_and_data_is_extracted()
    {
        $this->mock(AIActorInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('extractData')
                ->once()
                ->with('My name is John Doe living in NY')
                ->andReturn(new ActorProfileData(
                    first_name: 'John',
                    last_name: 'Doe',
                    address: 'NY',
                    height: '180cm'
                ));
        });

        $response = $this->post(route('actors.store'), [
            'email' => 'john@example.com',
            'description' => 'My name is John Doe living in NY',
        ]);

        $response->assertRedirect(route('actors.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('actors', [
            'email' => 'john@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => 'NY',
            'height' => '180cm',
        ]);
    }

    public function test_validation_fails_if_ai_cannot_extract_required_fields()
    {
        $this->mock(AIActorInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('extractData')
                ->andThrow(IncompleteActorDataException::missingFields());
        });

        $response = $this->post(route('actors.store'), [
            'email' => 'bad@example.com',
            'description' => 'Just some random text',
        ]);

        $response->assertSessionHasErrors(['description']);
        $this->assertDatabaseCount('actors', 0);
    }

    public function test_api_prompt_validation_endpoint_works()
    {
        $response = $this->getJson('/api/actors/prompt-validation');

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }
}
