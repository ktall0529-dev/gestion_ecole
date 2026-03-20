<?php
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CoursController;
use App\Http\Controllers\Api\V1\EtudiantController;
use App\Http\Controllers\Api\V1\InscriptionController;
use Illuminate\Support\Facades\Route;
Route::prefix('v1')->group(function () {
 // ── Authentification (publiques) ─────────────────────
 Route::prefix('auth')->group(function () {
 Route::post('register', [AuthController::class, 'register']);
 Route::post('login', [AuthController::class, 'login']);
 Route::middleware('auth:sanctum')->group(function () {
 Route::post('logout', [AuthController::class, 'logout']);
 Route::get('me', [AuthController::class, 'me']);
 });
 });
 // ── Routes protégées ─────────────────────────────────
 Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
 // Étudiants CRUD
 Route::apiResource('etudiants', EtudiantController::class);
 // Many-to-Many inscriptions
 Route::post('etudiants/{etudiant}/cours/attach',
 [InscriptionController::class, 'attach']);
 Route::post('etudiants/{etudiant}/cours/detach',
 [InscriptionController::class, 'detach']);
 Route::post('etudiants/{etudiant}/cours/sync',
 [InscriptionController::class, 'sync']);
 // Cours CRUD
 Route::apiResource('cours', CoursController::class);
 });
});
