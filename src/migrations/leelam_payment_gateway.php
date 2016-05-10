<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeelamPaymentGateTable extends Migration
{
    public function up()
    {
        Schema::create('leelam_payment_gateway',function(Blueprint $table){
            $table->increments('id');
            $table->string('transaction_id',64);
            $table->text('responce_data');
            $table->string('status',16)->default(null);

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

        Schema::drop('leelam_payment_gateway');
    }

}