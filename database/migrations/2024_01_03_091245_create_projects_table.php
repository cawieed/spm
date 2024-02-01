<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\progress;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->unique();
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->string('methodology');
            $table->string('platform');
            $table->string('deployment');
            $table->boolean('is_approved')->default(false);
            $table->string('status')->nullable();
            $table->Integer('duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('lead_developer_id')->constrained('lead_developers')->nullable();
            $table->foreignId('owner_id')->constrained('owners')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
