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
        Schema::disableForeignKeyConstraints();
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained();
            $table->string("code");
            $table->string("nom");
            $table->boolean('EFM_R')->default(0);
            $table->float("MH_G")->nullable();
            $table->float("MH_G_realisé")->nullable();
            $table->boolean('achevé')->default(0);
            $table->integer("nb_cc")->nullable();
            $table->boolean('S_efm')->default(0);
            $table->boolean('validation')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
