<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\TongueFacade;
use Illuminate\Console\Command;

class JsonTongueMergeCommand extends Command
{
    public $signature = 'json-tongue:merge
                            {--F|force : Remove existing JSON files}';

    public $description = 'Copy and merge JSON files from locale folders';

    public function handle(): int
    {
        $lang_path = new File(config('json-tongue.lang-path', '/lang'));

        if (! $this->handleOldFiles($lang_path->getDirectoryJsonContent())) {
            return self::FAILURE;
        }

        $this->line('Loading localization data...');

        $jsons_list = (new TongueFacade($lang_path))->transcribe();
        // TODO: list loaded JSON files

        $this->line('Loaded localization data.');

        $this->line('Creating new JSON files...');

        foreach ($jsons_list as $json_name => $content) {
            file_put_contents("{$lang_path}/{$json_name}.json", json_encode($content));
        }

        $this->info('JSON files from locale folders are merged in the root of lang Folder!');

        $this->table(
            ['Generated JSON files'],
            collect($jsons_list)->keys()->map(fn ($name) => ['Generated JSON files' => "{$name}.json"])->toArray()
        );

        return self::SUCCESS;
    }

    protected function handleOldFiles(array $old_jsons): bool
    {
        if (! $old_jsons) {
            return true;
        }

        $this->warn('The root of lang folder is populated with JSON files.');

        if (
            $this->option('force') ||
            $this->confirm('Do you wish to remove JSON files that already exist in the root of the lang folder?')
        ) {
            $this->removeOldJsonFiles($old_jsons);

            return true;
        }

        $this->warn('Remove the JSON files in the root of Lang folder manually, or instruct the command to remove them!');

        return false;
    }

    protected function removeOldJsonFiles(array $json_list)
    {
        $this->line('Removing old JSON files...');

        foreach ($json_list as $file_name => $abs_path) {
            unlink($abs_path);
        }

        $this->line('Removed old JSON files.');
    }
}
