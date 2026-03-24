<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cours extends Model
{
 use HasFactory; 
 

 protected $fillable = [
 'libelle', 'professeur', 'volume_horaire',
 ];
public function etudiants(): BelongsToMany
 {
 return $this->belongsToMany(Etudiant::class, 'cours_etudiant');
 }
}
