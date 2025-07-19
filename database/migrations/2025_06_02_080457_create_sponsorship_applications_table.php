<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sponsorship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('team_name')->nullable();
            $table->string('email');
            $table->string('cell_phone');
            $table->string('city');
            $table->string('state');
            $table->string('instagram_username');
            $table->string('tiktok_username')->nullable();
            $table->string('vehicle_year');
            $table->string('vehicle_make');
            $table->string('vehicle_model');
            $table->text('modifications');
            $table->text('other_sponsors');
            $table->boolean('agree_rules')->default(false);
            $table->boolean('agree_banner')->default(false);
            $table->timestamp('date_submitted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship_applications');
    }
};
