<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rutas', function (Blueprint $table) {
            $table->string('boat_type')->nullable()->after('asientos_disponibles');
        });
    }

    public function down()
    {
        Schema::table('rutas', function (Blueprint $table) {
            $table->dropColumn('boat_type');
        });
    }
}; 