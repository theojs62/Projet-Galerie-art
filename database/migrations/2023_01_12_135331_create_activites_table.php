<?php

use App\Models\Salle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->json('disponibilites')->nullable(true);
            $table->float('cout')->default(10.100);
            $table->foreignIdFor(Salle::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('sport', 50);
            $table->string('localisation', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('activites');
    }
};
