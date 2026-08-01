<?php

namespace Tests\Feature;

use App\Models\SidatData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAndSidatAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_approval_list_is_scoped_to_the_admin_country(): void
    {
        $admin = User::factory()->admin()->create(['country' => 'Indonesia']);
        $ownerIndonesia = User::factory()->create(['country' => 'Indonesia']);
        $ownerPhilippines = User::factory()->create(['country' => 'Philippines']);

        $indonesiaPending = SidatData::factory()->create([
            'user_id' => $ownerIndonesia->id,
            'country' => 'Indonesia',
            'isapproved' => false,
        ]);

        SidatData::factory()->create([
            'user_id' => $ownerPhilippines->id,
            'country' => 'Philippines',
            'isapproved' => false,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.approvals.index'));

        $response->assertOk();

        $pendingData = $response->viewData('pendingData');
        $this->assertCount(1, $pendingData->items());
        $this->assertSame('Indonesia', $pendingData->first()->country);
        $this->assertSame($indonesiaPending->id, $pendingData->first()->id);
    }

    public function test_regular_user_cannot_edit_another_users_sidat_record(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $record = SidatData::factory()->create([
            'user_id' => $owner->id,
            'country' => 'Indonesia',
        ]);

        $response = $this->actingAs($otherUser)->get(route('sidat.edit', $record));

        $response->assertForbidden();
    }

    public function test_enum_user_is_redirected_to_the_enum_create_page_from_dashboard(): void
    {
        $enumUser = User::factory()->enum()->create();

        $response = $this->actingAs($enumUser)->get(route('dashboard'));

        $response->assertRedirect(route('enum.sidat.create'));
    }
}
