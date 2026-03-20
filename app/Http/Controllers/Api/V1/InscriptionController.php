<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Resources\EtudiantResource;
use App\Models\Etudiant;
use Illuminate\Http\Request;
class InscriptionController extends Controller
{
 // POST /api/v1/etudiants/{etudiant}/cours/attach
public function attach(Request $request, Etudiant $etudiant)
 {
 $request->validate([
 'cours_ids' => 'required|array',
 'cours_ids.*' => 'exists:cours,id',
 ]);
 $etudiant->cours()->attach($request->cours_ids);
 $etudiant->load('cours');
 return new EtudiantResource($etudiant);
 }
 // POST /api/v1/etudiants/{etudiant}/cours/detach
 public function detach(Request $request, Etudiant $etudiant)
 {
 $request->validate([
 'cours_ids' => 'required|array',
 'cours_ids.*' => 'exists:cours,id',
 ]);
 $etudiant->cours()->detach($request->cours_ids);
 $etudiant->load('cours');
 return new EtudiantResource($etudiant);
 }
 // POST /api/v1/etudiants/{etudiant}/cours/sync
 public function sync(Request $request, Etudiant $etudiant)
 {
 $request->validate([
 'cours_ids' => 'required|array',
 'cours_ids.*' => 'exists:cours,id',
 ]);
 $etudiant->cours()->sync($request->cours_ids);
 $etudiant->load('cours');
 return new EtudiantResource($etudiant);
 }
}
