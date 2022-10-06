<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use Illuminate\Console\Command;

class JsonTongueCommand extends Command
{
    public $signature = 'laravel-json-tongue';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
