<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorshipApplication extends Model
{
    use HasFactory;
    protected $fillable = [
    'first_name', 'last_name', 'team_name', 'email', 'cell_phone', 'street_address', 'street_address_2', 'city', 'state', 'zip_code', 'instagram_username', 'tiktok_username', 'vehicle_year', 'vehicle_make', 'vehicle_model', 'modifications', 'other_sponsors', 'agree_rules', 'agree_banner', 'date_submitted',
    'status', 
    'denial_reason',
    'approved_by' 
    ];

}
