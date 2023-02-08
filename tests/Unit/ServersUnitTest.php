<?php


use App\Models\Server;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ServersUnitTest extends TestCase
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

        $this->assertTrue((bool)Server::find(1));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_servers_index(): void
    {
        $response = $this->get('/api/servers')->getContent();

        $object = json_decode($response);

        $this->assertTrue((bool)$object->servers->data[0]->id);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_servers_clear(): void
    {
        $response = $this->delete('/api/servers/clear');

        $this->assertFalse((bool)Server::find(1));
    }
}
