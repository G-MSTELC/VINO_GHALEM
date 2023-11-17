<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        // Crée un utilisateur ou utilise un utilisateur existant
        $user = User::factory()->create();

        // Authentifie l'utilisateur
        $this->actingAs($user);

        // Accède à la route qui nécessite une authentification
        $response = $this->get('/admin/users');

        // Assurez-vous que la réponse est un code 200 (OK)
        $response->assertStatus(200);
    }
}
