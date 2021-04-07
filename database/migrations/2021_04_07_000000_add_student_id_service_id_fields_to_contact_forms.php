<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentIdServiceIdFieldsToContactForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->bigInteger('student_id')->default(0)->after('message');
            $table->string('service_id')->nullable()->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->dropColumn(['student_id', 'service_id']);
        });
    }
}
