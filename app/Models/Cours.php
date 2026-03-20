<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Cours extends Model
{
 protected $fillable = [
 'libelle', 'professeur', 'volume_horaire',
 ];
public function etudiants(): BelongsToMany
 {
 return $this->belongsToMany(Etudiant::class, 'cours_etudiant');
 }
}
