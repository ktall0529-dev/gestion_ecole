<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
 // POST /api/v1/auth/register
 public function register(Request $request)
 {
 $data = $request->validate([
 'name' => 'required|string|max:100',
 'email' => 'required|email|unique:users,email',
 'password' => 'required|string|min:8|confirmed',
 ]);
 $user = User::create([
 'name' => $data['name'],
 'email' => $data['email'],
 'password' => Hash::make($data['password']),
 ]);
 $token = $user->createToken('api-token')->plainTextToken;
 return response()->json(['user' => $user, 'token' => $token], 201);
 }
 // POST /api/v1/auth/login
 public function login(Request $request)
 {
 $data = $request->validate([
 'email' => 'required|email',
 'password' => 'required',
 ]);
$user = User::where('email', $data['email'])->first();
 if (!$user || !Hash::check($data['password'], $user->password)) {
 throw ValidationException::withMessages([
 'email' => ['Les identifiants sont incorrects.'],
 ]);
 }
 $token = $user->createToken('api-token')->plainTextToken;
 return response()->json(['user' => $user, 'token' => $token]);
 }
 // POST /api/v1/auth/logout
 public function logout(Request $request)
 {
 $request->user()->currentAccessToken()->delete();
 return response()->json(['message' => 'Déconnecté avec succès.']);
 }
 // GET /api/v1/auth/me
 public function me(Request $request)
 {
 return response()->json($request->user());
 }
}
