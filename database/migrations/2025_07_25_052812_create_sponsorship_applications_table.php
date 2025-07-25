<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sponsorship_applications', function (Blueprint $table) {
            $table->id();

            // Original application fields
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

            // Patched-in fields (now consolidated)
            $table->unsignedBigInteger('user_id')->nullable()->index(); // Link to user if applicable
            $table->string('status')->default('pending'); // 'pending', 'approved', 'denied'
            $table->string('denial_reason')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable(); // ID of approving admin

            $table->json('car_categories')->nullable();
            $table->string('car_category_other')->nullable();
            $table->json('event_types')->nullable();
            $table->json('event_preferences')->nullable();

            $table->timestamps();

            // Foreign keys (optional – disable if not using strict FKs)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorship_applications');
    }
};
