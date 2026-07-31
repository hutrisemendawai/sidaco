<?php

namespace Tests\Feature;

use App\Models\SidatData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DashboardCountryScopeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_admin_dashboard_shows_only_approved_records_from_admin_country(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'country' => 'Indonesia',
        ]);

        $ownerA = User::factory()->create(['country' => 'Indonesia']);
        $ownerB = User::factory()->create(['country' => 'Philippines']);

        $this->createSidatRecord($ownerA, ['country' => 'Indonesia', 'province' => 'Papua', 'isapproved' => true]);
        $this->createSidatRecord($ownerB, ['country' => 'Indonesia', 'province' => 'Maluku', 'isapproved' => true]);
        $this->createSidatRecord($ownerB, ['country' => 'Philippines', 'province' => 'Cebu', 'isapproved' => true]);
        $this->createSidatRecord($ownerA, ['country' => 'Indonesia', 'province' => 'Aceh', 'isapproved' => false]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewHas('userCountry', 'Indonesia');
        $response->assertViewHas('countryScopeMissing', false);
        $response->assertViewHas('totalEntries', 2);
        $response->assertViewHas('uniqueCountry', 1);
    }

    public function test_regular_user_dashboard_shows_approved_records_from_own_country_only(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'country' => 'Myanmar',
        ]);

        $ownerA = User::factory()->create(['country' => 'Myanmar']);
        $ownerB = User::factory()->create(['country' => 'Vietnam']);

        $this->createSidatRecord($ownerA, ['country' => 'Myanmar', 'province' => 'Yangon', 'isapproved' => true]);
        $this->createSidatRecord($ownerB, ['country' => 'Myanmar', 'province' => 'Mandalay', 'isapproved' => true]);
        $this->createSidatRecord($ownerB, ['country' => 'Vietnam', 'province' => 'Hue', 'isapproved' => true]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewHas('userCountry', 'Myanmar');
        $response->assertViewHas('countryScopeMissing', false);
        $response->assertViewHas('totalEntries', 2);
        $response->assertViewHas('uniqueCountry', 1);
    }

    public function test_dashboard_is_empty_when_user_country_is_missing(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'country' => null,
        ]);

        $owner = User::factory()->create(['country' => 'Indonesia']);
        $this->createSidatRecord($owner, ['country' => 'Indonesia', 'province' => 'Bali', 'isapproved' => true]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewHas('countryScopeMissing', true);
        $response->assertViewHas('totalEntries', 0);
        $response->assertSeeText('profile country is not set');
    }

    public function test_get_provinces_endpoint_is_country_scoped_to_authenticated_user(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'country' => 'Indonesia',
        ]);

        $owner = User::factory()->create(['country' => 'Indonesia']);

        $this->createSidatRecord($owner, ['country' => 'Indonesia', 'province' => 'Banten', 'isapproved' => true]);
        $this->createSidatRecord($owner, ['country' => 'Philippines', 'province' => 'Davao', 'isapproved' => true]);

        $allowed = $this->actingAs($user)->getJson('/get-provinces/Indonesia');
        $blocked = $this->actingAs($user)->getJson('/get-provinces/Philippines');

        $allowed->assertOk()->assertExactJson(['Banten']);
        $blocked->assertOk()->assertExactJson([]);
    }

    private function createSidatRecord(User $owner, array $overrides = []): SidatData
    {
        $baseDate = now()->toDateString();

        $attributes = [
            'user_id' => $owner->id,
            'updated_by' => $owner->id,
            'date' => $baseDate,
            'day' => now()->format('l'),
            'month' => now()->format('F'),
            'country' => 'Indonesia',
            'province' => 'West Java',
            'regency' => 'Bandung',
            'district' => 'Coblong',
            'river' => 'Citarum',
            'stage' => 'Elver',
            'fisher_name' => 'Fisher One',
            'number_of_fisher' => 3,
            'type_of_fishing_gear' => 'Net',
            'number_of_fishing_gear' => 2,
            'species_name' => 'Anguilla bicolor',
            'operation_time' => 4.5,
            'total_weight_per_day' => 12.8,
            'price_per_kg' => 200000,
            'iscreatedbyenum' => false,
            'isapproved' => true,
        ];

        return SidatData::create(array_merge($attributes, $overrides));
    }
}
