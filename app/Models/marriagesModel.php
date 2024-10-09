<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marriagesModel extends Model
{
    use HasFactory;

    // Surrender Details to Profiles Model
    public function wife()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Surrender Details to Profiles Model
    public function husband()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Surrender Details to Profiles Model
    public function wakil()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Surrender Details to Profiles Model
    public function waliyy()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Surrender Details to Masajid Model
    public function masjid()
    {
        return $this->belongsTo(masajidModel::class, 'venue_id');
    }

    protected $table = 'marriage';

    protected $fillable = [
        'husband_id',
        'wife_id',
        'waliyy_id',
        'wakil_id',
        'date',
        'time',
        'venue',
        'dowry',
        'dowry_status',
        'husband_test',
        'wife_test',
        'venue_id',
        'status',
        'approved_by',
        'activated_by',
        'activation_date',
        'deactivated_by',
        'deactivation_date',
        ];


        public function scopeFilter($query, array $filters){
            if($filters['search'] ?? false) {
                $query->where('husband_id', 'like', '%' . request('search') . '%')
                ->orWhere('wife_id', 'like', '%' . request('search') . '%')
                ->orWhere('date', 'like', '%' . request('search') . '%')
                ->orWhere('time', 'like', '%' . request('search') . '%')
                ->orWhere('venue', 'like', '%' . request('search') . '%')
                ->orWhere('dowry', 'like', '%' . request('search') . '%')
                ->orWhere('dowry_status', 'like', '%' . request('search') . '%');
            }
        }

}
