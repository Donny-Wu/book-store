<?php
namespace App\Traits\Tests;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
trait HasSanctumAuth{
    public function actingAsAdmin(){
        Sanctum::actingAs(
            User::factory()->as_admin()->create()
        );
    }
    public function actingAsUser(){
        Sanctum::actingAs(
            User::factory()->as_user()->create()
        );
    }
}
