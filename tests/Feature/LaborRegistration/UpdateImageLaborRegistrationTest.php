<?php

namespace Tests\Feature\LaborRegistration;

use App\Models\LaborRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateImageLaborRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'X-Api-Key' => env('API_KEY'),
        ]);
    }

    public function testItShouldLoadImageLaborRegistration(): void
    {
        $labor = LaborRegistration::factory()->create();
        $imageJPG = UploadedFile::fake()->image('image.jpg', 640, 480, 'image/jpeg');
        $response = $this->postJson(route('labor-registration.update-image', ['id' => $labor->id]), [
            'image' => $imageJPG,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'image',
                    'name',
                    'email',
                    'age',
                    'address',
                    'height',
                ],
            ]);
    }

    public function testItShouldNotLoadImageLaborRegistrationWithInvalidData(): void
    {
        $labor = LaborRegistration::factory()->create();
        $imageJPG = UploadedFile::fake()->image('image.jpg', 640, 480, 'image/jpeg');
        $response = $this->postJson(route('labor-registration.update-image', ['id' => $labor->id]));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'image',
                ],
            ]);
    }
}
