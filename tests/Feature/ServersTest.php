<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ServersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_servers_import(): void
    {
        $file = new UploadedFile(storage_path('excel/servers.xlsx'), 'servers');

        $response = $this->call('POST', '/api/servers/import', [], [], ['file' => $file], ['Accept' => 'application/json']);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_servers_index(): void
    {
        $response = $this->get('/api/servers');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_servers_clear(): void
    {
        $response = $this->delete('/api/servers/clear');

        $response->assertStatus(204);
    }
}
