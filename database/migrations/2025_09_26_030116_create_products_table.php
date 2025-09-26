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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->double('price');
            $table->unsignedInteger('condition_type')->nullable();
            $table->boolean('is_negotiable')->default(0);
            $table->datetime('expiry_period');
            $table->unsignedInteger('expiry_period_type');
            $table->text('features')->nullable();
            $table->boolean('is_sold')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('status')->default(0);

            //Automobiles Only
            $table->unsignedInteger('kilometer_run')->nullable();
            $table->unsignedInteger('make_year')->nullable();
            $table->string('color')->nullable();

            //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
            $table->string('manufacturer')->nullable();

            //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
            $table->double('usedFor_period')->nullable();
            $table->unsignedInteger('usedFor_period_type')->nullable();
            $table->unsignedInteger('warranty_type')->nullable();
            $table->double('warranty_period')->nullable();
            $table->unsignedInteger('warranty_period_type')->nullable();

            //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games & Food-Drinks & Pet-PetCare
            $table->boolean('has_home_delivery')->default(0);
            $table->unsignedInteger('delivery_area')->nullable();
            $table->double('delivery_charge')->nullable();

            //Fashion-Wear Only
            $table->unsignedInteger('quantity')->nullable();

            //Fashion-Wear & Real State
            $table->string('size')->nullable();

            //Real State Only
            $table->string('location')->nullable();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
