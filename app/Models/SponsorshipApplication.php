<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorshipApplication extends Model
{
    use HasFactory;
        protected $fillable = [
            'first_name', 'last_name', 'team_name', 'email', 'cell_phone', 'city', 'state',
            'instagram_username', 'tiktok_username',
            'vehicle_year', 'vehicle_make', 'vehicle_model', 'modifications',
            'other_sponsors', 'agree_rules', 'agree_banner', 'date_submitted',
            'status', 'denial_reason', 'approved_by',
            
            // ✅ Add these:
            'car_categories', 'event_preferences', 'car_category_other', 'user_id',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
