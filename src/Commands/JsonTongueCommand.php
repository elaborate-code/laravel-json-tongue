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

        $lang_path = new File(config('json-tongue.lang-path'));

        $old_jsons = $lang_path->getDirectoryJsonContent();

        if ($old_jsons) {
            if (! $force && ! $this->confirm('Do you wish to remove JSON files that already exist in the lang folder?')) {
                return self::INVALID;
            } else {
                $this->removeOldJsonFiles($old_jsons);
            }
        }

        $localizaion = new TongueFacade($lang_path);

        $jsons_list = $localizaion->transcribe();

        foreach ($jsons_list as $json_name => $content) {
            file_put_contents("{$lang_path}/{$json_name}.json", json_encode($content));
        }

        $this->comment('All done');

        return self::SUCCESS;
    }

    protected function removeOldJsonFiles(array $json_list)
    {
        foreach ($json_list as $file_name => $abs_path) {
            unlink($abs_path);
        }
    }
}
