<?php
namespace Tests\Feature;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class EtudiantTest extends TestCase
{
 use RefreshDatabase;
 private function actingAsUser()
 {
 $user = User::factory()->create();
 $token = $user->createToken('test')->plainTextToken;
 return ['Authorization' => 'Bearer '.$token];
 }
 /** @test */
 public function acces_sans_token_retourne_401()
 {
 $response = $this->getJson('/api/v1/etudiants');
 $response->assertStatus(401);
 }
 /** @test */
public function creation_etudiant_retourne_201()
 {
 $headers = $this->actingAsUser();
 $response = $this->postJson('/api/v1/etudiants', [
 'prenom' => 'Amadou',
 'nom' => 'Ba',
 'email' => 'amadou.ba@test.com',
 'date_naissance' => '2001-03-10',
 ], $headers);
 $response->assertStatus(201)
 ->assertJsonPath('data.email', 'amadou.ba@test.com');
 }
 /** @test */
 public function attach_cours_retourne_200()
 {
 $headers = $this->actingAsUser();
 $etudiant = Etudiant::factory()->create();
 $cours = Cours::factory()->create();
 $response = $this->postJson(
 "/api/v1/etudiants/{$etudiant->id}/cours/attach",
 ['cours_ids' => [$cours->id]],
 $headers
 );
 $response->assertStatus(200);
 $this->assertDatabaseHas('cours_etudiant', [
 'etudiant_id' => $etudiant->id,
 'cours_id' => $cours->id,
 ]);
 }
 /** @test */
 public function sync_cours_retourne_200()
 {
 $headers = $this->actingAsUser();
 $etudiant = Etudiant::factory()->create();
 $cours1 = Cours::factory()->create();
 $cours2 = Cours::factory()->create();
 $etudiant->cours()->attach([$cours1->id]);
 $response = $this->postJson(
 "/api/v1/etudiants/{$etudiant->id}/cours/sync",
 ['cours_ids' => [$cours2->id]],
$headers
 );
 $response->assertStatus(200);
 $this->assertDatabaseMissing('cours_etudiant', ['cours_id' => $cours1->id]);
 $this->assertDatabaseHas('cours_etudiant', ['cours_id' => $cours2->id]);
 }
}