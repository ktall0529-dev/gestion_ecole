<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Etudiant extends Model
{
use HasFactory; // <-- ajouter cette ligne
// ... reste du code
 protected $fillable = [
 'prenom', 'nom', 'email', 'date_naissance',
 ];
 public function cours(): BelongsToMany
 {
 return $this->belongsToMany(Cours::class, 'cours_etudiant');
 }
}
