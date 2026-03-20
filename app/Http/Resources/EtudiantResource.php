<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class EtudiantResource extends JsonResource
{
 public function toArray(Request $request): array
 {
 return [
 'id' => $this->id,
 'prenom' => $this->prenom,
 'nom' => $this->nom,
 'email' => $this->email,
 'date_naissance' => $this->date_naissance,
 'created_at' => $this->created_at,
 // inclure les cours seulement si demandé via ?include=cours
 'cours' => $this->when(
 $this->relationLoaded('cours'),
 CoursResource::collection($this->cours)
 ),
 ];
 }
}
