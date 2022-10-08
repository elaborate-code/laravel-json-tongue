<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\TongueFacade;
use Illuminate\Console\Command;

class JsonTongueCommand extends Command
{
    public $signature = 'json-tongue
                            {--F|force : Remove existing JSON files}';

    public $description = 'Merge JSON files';

    public function handle(): int
    {
        $force = $this->option('force');

        $lang_path = new File(config('json-tongue.lang-path', '/lang'));

        if ($old_jsons = $lang_path->getDirectoryJsonContent()) {
            $this->comment('The root of lang folder is populated with JSON files.');

            if ($force || $this->confirm('Do you wish to remove JSON files that already exist in the root of the lang folder?')) {
                $this->removeOldJsonFiles($old_jsons);
            } else {
                $this->warn('Remove the JSON files in the root of Lang folder manually, or instruct the command to remove them!');

                return self::FAILURE;
            }
        }

        $jsons_list = (new TongueFacade($lang_path))->transcribe();

        foreach ($jsons_list as $json_name => $content) {
            file_put_contents("{$lang_path}/{$json_name}.json", json_encode($content));
        }

        $this->info('JSON files from locale folders are merged in the root of lang Folder!');

        return self::SUCCESS;
    }

    protected function removeOldJsonFiles(array $json_list)
    {
        foreach ($json_list as $file_name => $abs_path) {
            unlink($abs_path);
        }
    }
}
