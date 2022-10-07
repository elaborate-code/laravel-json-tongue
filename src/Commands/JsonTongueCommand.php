<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use Illuminate\Console\Command;

class JsonTongueCommand extends Command
{
    public $signature = 'json-tongue';

    public $description = 'Merge JSON files';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
