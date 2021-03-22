<?php

namespace Tests\Feature\Api;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\TestHelper;
use Tests\Traits\UserActingAs;

class RecordTest extends TestHelper
{
    use RefreshDatabase;
    use UserActingAs;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnauthenticated()
    {
        $response = $this->getJson(route('api.record.index', ['procedure_id' => 2]));
        $response->assertStatus(401);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetRecords()
    {
        $count = 1;
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $date = Carbon::now();
        factory(Record::class, $count)->create([
            'business_id' => $business->id,
            'procedure_id' => $procedure->id,
            'price' => $procedure->price,
            'client_id' => $user->id,
            'date_start' => $date,
            'date_end' => $date,
        ]);

        $this->userActingAs($user, 'api');

        $response = $this->json("GET", route('api.record.index', ['procedure_id' => $procedure->id,]), [
            'date_start' => $date->format("d.m.Y"),
            'date_end' => $date->addDay()->format("d.m.Y"),
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['success', 'records'])
            ->assertJsonCount($count, 'records');
    }

    public function testCreateRecord()
    {
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $date = Carbon::now();
        $this->userActingAs($user, 'api');

        $response = $this->json("POST", route('api.record.store'), [
            'procedure_id' => $procedure->id,
            'client_id' => $user->id,
            'date_start' => $date->format("Y-m-d H:i"),
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['success', 'record']);
    }

    public function testCreateRecordErrorBusyTime()
    {
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $date = Carbon::now();
        factory(Record::class)->create([
            'business_id' => $business->id,
            'procedure_id' => $procedure->id,
            'price' => $procedure->price,
            'client_id' => $user->id,
            'date_start' => $date,
            'date_end' => $date,
        ]);

        $this->userActingAs($user, 'api');

        $response = $this->json("POST", route('api.record.store'), [
            'procedure_id' => $procedure->id,
            'client_id' => $user->id,
            'date_start' => $date->format("Y-m-d H:i"),
        ]);

        $response->assertStatus(500)
            ->assertJsonFragment([
                'message' => "It's time busy",
                'exception' => 'InvalidArgumentException'
            ]);
    }

    public function testUpdateRecord()
    {
        $newDate = '2020-01-01 00:00';
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $date = Carbon::now();
        $record = factory(Record::class)->create([
            'business_id' => $business->id,
            'procedure_id' => $procedure->id,
            'price' => $procedure->price,
            'client_id' => $user->id,
            'date_start' => $date,
            'date_end' => $date,
        ]);

        $this->userActingAs($user, 'api');

        $response = $this->json("PUT", route('api.record.update', ['record' => $record->id]), [
            'procedure_id' => $procedure->id,
            'client_id' => $user->id,
            'date_start' => $newDate,
        ]);

        $this->assertDatabaseHas('records', [
            'procedure_id' => $procedure->id,
            'client_id' => $user->id,
            'date_start' => $newDate,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['success' => true]);
    }

    public function testDeleteRecord()
    {
        $newDate = '2020-01-01 00:00';
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $date = Carbon::now();
        $record = factory(Record::class)->create([
            'business_id' => $business->id,
            'procedure_id' => $procedure->id,
            'price' => $procedure->price,
            'client_id' => $user->id,
            'date_start' => $date,
            'date_end' => $date,
        ]);
        $this->userActingAs($user, 'api');

        $response = $this->json("DELETE", route('api.record.destroy', ['record' => $record->id]));

        $this->assertDatabaseMissing('records', [
            'procedure_id' => $procedure->id,
            'client_id' => $user->id,
            'date_start' => $newDate,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['success' => true]);
    }
}
