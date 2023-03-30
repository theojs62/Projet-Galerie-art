<?php

use App\Models\Activite;
use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $d = new DateTime('now');
            $table->dateTime('debut')->default($d->format("Y-m-d\\TH:i:sO"));
            $d = $d->add(new DateInterval('P1M'));
            $table->dateTime('fin')->default($d->format("Y-m-d\\TH:i:sO"));
            $table->integer('participants')->default(1);
            $table->foreignIdFor(Client::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Activite::class)->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
