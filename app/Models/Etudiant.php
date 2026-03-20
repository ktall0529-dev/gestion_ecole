<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Etudiant extends Model
{
 protected $fillable = [
 'prenom', 'nom', 'email', 'date_naissance',
 ];
 public function cours(): BelongsToMany
 {
 return $this->belongsToMany(Cours::class, 'cours_etudiant');
 }
}
