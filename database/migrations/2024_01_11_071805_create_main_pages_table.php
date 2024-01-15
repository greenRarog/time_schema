<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('main_pages', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('admin_id');
        //     $table->string('title')->nullable()->default(null);
        //     $table->text('seo_description')->nullable()->default(null);
        //     $table->string('header')->nullable()->default(null);
        //     $table->string('activity_kind')->nullable()->default(null);
        //     $table->string('path_image')->nullable()->default(null);
        //     $table->text('description')->nullable()->default(null);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('main_pages');
    }
};
