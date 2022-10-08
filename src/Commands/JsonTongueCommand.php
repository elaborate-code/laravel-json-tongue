<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\TongueFacade;
use Exception;
use Illuminate\Console\Command;

class JsonTongueCommand extends Command
{
    public $signature = 'json-tongue
                            {--F|force : remove existing JSON files}';

    public $description = 'Merge JSON files';

    public function handle(): int
    {
        $force = $this->option('force');

        $lang_path = new File(config('json-tongue.lang-path'));

        $old_jsons = $lang_path->getDirectoryJsonContent();

        if ($old_jsons) {
            if (! $force) {
                // TODO: prompt for clearing
                throw new Exception('The lang directory contains JSON files, make sure to clear it before running this command');
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
