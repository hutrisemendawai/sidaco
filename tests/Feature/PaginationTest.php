<?php

namespace Tests\Feature;

use App\Models\SidatData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_index_is_paginated(): void
    {
        $admin = User::factory()->admin()->create();
        User::factory()->count(20)->create();

        $response = $this->actingAs($admin)->get(route('admin.users.index'));

        $response->assertOk();
        $response->assertViewHas('users');

        $users = $response->viewData('users');
        $this->assertTrue($users->hasPages());
        $this->assertCount(5, $users->items());
    }

    public function test_approvals_index_is_paginated(): void
    {
        $admin = User::factory()->admin()->create(['country' => 'Indonesia']);
        $user = User::factory()->create(['country' => 'Indonesia']);

        SidatData::factory()->count(20)->create([
            'user_id' => $user->id,
            'country' => 'Indonesia',
            'isapproved' => false,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.approvals.index'));

        $response->assertOk();
        $response->assertViewHas('pendingData');

        $pendingData = $response->viewData('pendingData');
        $this->assertTrue($pendingData->hasPages());
        $this->assertCount(15, $pendingData->items());
    }

    public function test_sidat_index_is_paginated(): void
    {
        $admin = User::factory()->admin()->create(['country' => 'Indonesia']);
        $user = User::factory()->create(['country' => 'Indonesia']);

        SidatData::factory()->count(20)->create([
            'user_id' => $user->id,
            'country' => 'Indonesia',
            'isapproved' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('sidat.index'));

        $response->assertOk();
        $response->assertViewHas('sidatData');

        $sidatData = $response->viewData('sidatData');
        $this->assertTrue($sidatData->hasPages());
        $this->assertCount(15, $sidatData->items());
    }
}
