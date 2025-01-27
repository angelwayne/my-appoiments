<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCanlledByInCancelAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cancel_appointments', function (Blueprint $table) {
            //
            $table->renameColumn('cancelled_by','cancelled_by_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cancel_appointments', function (Blueprint $table) {
            //
            $table->renameColumn('cancelled_by_id','cancelled_by');
        });
    }
}
