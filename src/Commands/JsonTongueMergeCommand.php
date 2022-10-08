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
        $force = $this->option('force');

        $lang_path = new File(config('json-tongue.lang-path', '/lang'));

        if ($old_jsons = $lang_path->getDirectoryJsonContent()) {
            $this->warn('The root of lang folder is populated with JSON files.');

            if ($force || $this->confirm('Do you wish to remove JSON files that already exist in the root of the lang folder?')) {
                $this->line('Removing old JSON files...');

                $this->removeOldJsonFiles($old_jsons);

                $this->line('Removed old JSON files.');
            } else {
                $this->warn('Remove the JSON files in the root of Lang folder manually, or instruct the command to remove them!');

                return self::FAILURE;
            }
        }

        $this->line('Loading localization data...');

        $jsons_list = (new TongueFacade($lang_path))->transcribe();
        // TODO: list loaded JSON files

        $this->line('Localization data is loaded.');

        $this->line('Creating new JSON files...');

        foreach ($jsons_list as $json_name => $content) {
            file_put_contents("{$lang_path}/{$json_name}.json", json_encode($content));
        }

        $this->info('JSON files from locale folders are merged in the root of lang Folder!');

        $this->table(
            ['Generated JSON files'],
            array_map(fn ($name) => ['Generated JSON files' => "{$name}.json"], array_keys($jsons_list))
        );

        return self::SUCCESS;
    }

    protected function removeOldJsonFiles(array $json_list)
    {
        foreach ($json_list as $file_name => $abs_path) {
            unlink($abs_path);
        }
    }
}
