<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeelamCashTable extends Migration
{
    public function up()
    {
        Schema::create('leelam_cash', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable()->comment('payee id');
            $table->unsignedBigInteger('amount');
            $table->string('transaction_id', 64);
            $table->text('response_data')->nullable(); // FROM Server
            $table->string('status', 16)->default(1); // mean sent to proivder but did not recevice any responce
            $table->string('service_provider', 64); // payment gateway provider


            $table->integer('cashable_id'); // Model id
            $table->string('cashable_type'); // Model namespace

            //$table->unsignedInteger('parent_id')->default(0)->nullable()->comment('cash id linked to parent_id,can be useful for th e slit amoount');
            $table->string('ip')->default(null)->nullable()->comment('payee or user ip address');


            $table->timestamps();
            $table->softDeletes();

            // Uncomment this if you want to link user ids to your users table
            //$table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );
        });
    }

    public function down()
    {
        // Uncomment this when you linked to user id to users table
        /*Schema::table('leelam_payment_gateway', function (Blueprint $table) {
            $table->dropForeign ( 'comments_user_id_foreign' );
        });*/

        Schema::drop('leelam_cash');
    }

}