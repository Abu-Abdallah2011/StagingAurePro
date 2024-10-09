<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class profilesModel extends Model
{
    use HasFactory, Notifiable;

     //  Link this model to Marriage model
     public function husbandMarriages()
     {
        return $this->hasMany(marriagesModel::class, 'husband_id');
     }
 
     //  Link this model to Marriage model
     public function wifeMarriages()
     {
        return $this->hasMany(marriagesModel::class, 'wife_id');
     }
 
     //  Link this model to Marriage model
     public function wakil()
     {
        return $this->hasMany(marriagesModel::class, 'wakil_id');
     }
 
     //  Link this model to Marriage model
     public function waliyy()
     {
        return $this->hasMany(marriagesModel::class, 'waliyy_id');
     }
 
     //  Link this model to Masajid model
     public function imam()
     {
        return $this->hasMany(masajidModel::class, 'imam_id');
     }
 
     //  Link this model to Masajid model
     public function muazzin()
     {
        return $this->hasMany(masajidModel::class, 'muazzin_id');
     }
 
     //  Link this model to Masajid model
     public function chairman()
     {
        return $this->hasMany(masajidModel::class, 'chairman_id');
     }
 
     // Connect This Model to its User
     public function users()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     protected $table = 'profiles';
 
     protected $fillable = [
     'user_id',
     'first_name',
     'surname',
     'gender',
     'nin',
     'address',
     'phone',
     'email',
     'photo',
     'nin_slip',
     ];
 
     public function scopeFilter($query, array $filters){
         if($filters['search'] ?? false) {
             $query->where('first_name', 'like', '%' . request('search') . '%')
             ->orWhere('surname', 'like', '%' . request('search') . '%')
             ->orWhere('nin', 'like', '%' . request('search') . '%')
             ->orWhere('address', 'like', '%' . request('search') . '%')
             ->orWhere('phone', 'like', '%' . request('search') . '%')
             ->orWhere('email', 'like', '%' . request('search') . '%');
         }
     }

}
