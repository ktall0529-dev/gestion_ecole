<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Http\Resources\EtudiantResource;
use App\Models\Etudiant;
use Illuminate\Http\Request;
class EtudiantController extends Controller
{
 // GET /api/v1/etudiants
public function index(Request $request)
 {
 $query = Etudiant::query();
 // Filtre recherche ?q=
 if ($request->q) {
 $q = $request->q;
 $query->where(function($qb) use ($q) {
 $qb->where('nom', 'like', "%{$q}%")
 ->orWhere('prenom', 'like', "%{$q}%")
 ->orWhere('email', 'like', "%{$q}%");
 });
 }
 // Chargement eager des cours si demandé
 if ($request->include === 'cours') {
 $query->with('cours');
 }
 $perPage = $request->per_page ?? 15;
 return EtudiantResource::collection($query->paginate($perPage));
 }
 // POST /api/v1/etudiants
 public function store(StoreEtudiantRequest $request)
 {
 $etudiant = Etudiant::create($request->validated());
 return new EtudiantResource($etudiant);
 // Note: retourne 201 implicitement via Resource
 }
 // GET /api/v1/etudiants/{etudiant}
 public function show(Request $request, Etudiant $etudiant)
 {
 if ($request->include === 'cours') {
 $etudiant->load('cours');
 }
 return new EtudiantResource($etudiant);
 }
 // PUT/PATCH /api/v1/etudiants/{etudiant}
 public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
 {
 $etudiant->update($request->validated());
 return new EtudiantResource($etudiant);
 }
// DELETE /api/v1/etudiants/{etudiant}
 public function destroy(Etudiant $etudiant)
 {
 $etudiant->delete();
 return response()->noContent(); // 204
 }
}
