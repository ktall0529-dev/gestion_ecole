<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Http\Resources\CoursResource;
use App\Models\Cours;
use Illuminate\Http\Request;
class CoursController extends Controller
{
 // GET /api/v1/cours
 public function index(Request $request)
 {
 $query = Cours::query();
 if ($request->professeur) {
 $query->where('professeur', 'like', '%'.$request->professeur.'%');
 }
 if ($request->include === 'etudiants') {
 $query->with('etudiants');
 }
 $perPage = $request->per_page ?? 15;
 return CoursResource::collection($query->paginate($perPage));
 }
 // POST /api/v1/cours
 public function store(StoreCoursRequest $request)
 {
$cours = Cours::create($request->validated());
 return new CoursResource($cours);
 }
 // GET /api/v1/cours/{cours}
 public function show(Request $request, Cours $cours)
 {
 if ($request->include === 'etudiants') {
 $cours->load('etudiants');
 }
 return new CoursResource($cours);
 }
 // PUT/PATCH /api/v1/cours/{cours}
 public function update(UpdateCoursRequest $request, Cours $cours)
 {
 $cours->update($request->validated());
 return new CoursResource($cours);
 }
 // DELETE /api/v1/cours/{cours}
 public function destroy(Cours $cours)
 {
 $cours->delete();
 return response()->noContent();
 }
}