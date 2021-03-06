<?php

namespace CleaniqueCoders\LaravelDB2DOC\Tests;

use Illuminate\Support\Arr;

class CommandTest extends TestCase
{
    /** @test */
    public function it_has_LaravelDb2DocCommand_class()
    {
        $this->assertTrue(class_exists(\CleaniqueCoders\LaravelDB2DOC\Console\Commands\LaravelDb2DocCommand::class));
    }

    /** @test */
    public function it_has_artisan_db2doc_command_registered()
    {
        $this->assertTrue(Arr::has(\Artisan::all(), 'db:2doc'));
    }

    /** @test */
    public function it_can_generate_document()
    {
        // assert can generate file - md & json
        $this->artisan('db:2doc', ['--database' => 'testbench']);
        $name = config('app.name') . ' Database Schema.md';
        $this->assertFileExists(storage_path('app/db2doc/' . $name));
        unlink(storage_path('app/db2doc/' . $name));
        $this->assertFileDoesNotExist(storage_path('app/db2doc/' . $name));

        $this->artisan('db:2doc', ['--database' => 'testbench', '--format' => 'json']);
        $name = config('app.name') . ' Database Schema.json';
        $this->assertFileExists(storage_path('app/db2doc/' . $name));
        unlink(storage_path('app/db2doc/' . $name));
        $this->assertFileDoesNotExist(storage_path('app/db2doc/' . $name));
    }
}
