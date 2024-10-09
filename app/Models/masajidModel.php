<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masajidModel extends Model
{
    use HasFactory;

    // Connect This Masjid Model to its Imam
    public function imam()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Connect This Masjid Model to its Muazzin
    public function muazzin()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Connect This Masjid Model to its Chairman
    public function chairman()
    {
        return $this->belongsTo(profilesModel::class);
    }

    // Connect This Masjid Model to its Marriages
    public function marriages()
    {
        return $this->hasMany(marriagesModel::class, 'venue_id');
    }

    protected $table = 'masajid';

    protected $fillable = [
        'name',
        'address',
        'cac_reg',
        'email',
        'acct_no',
        'acct_name',
        'bank',
        'imam_id',
        'muazzin_id',
        'chairman_id',
    ];

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('address', 'like', '%' . request('search') . '%')
            ->orWhere('cac_reg', 'like', '%' . request('search') . '%')
            ->orWhere('email', 'like', '%' . request('search') . '%')
            ->orWhere('acct_no', 'like', '%' . request('search') . '%')
            ->orWhere('acct_name', 'like', '%' . request('search') . '%')
            ->orWhere('bank', 'like', '%' . request('search') . '%');
        }
    }

}
