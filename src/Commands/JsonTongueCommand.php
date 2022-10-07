<?php

namespace ElaborateCode\LaravelJsonTongue\Commands;

use ElaborateCode\JsonTongue\Strategies\File;
use ElaborateCode\JsonTongue\TongueFacade;
use Illuminate\Console\Command;

class JsonTongueCommand extends Command
{
    public $signature = 'json-tongue';

    public $description = 'Merge JSON files';

    public function handle(): int
    {
        $lang_path = new File(config('json-tongue.lang-path'));

        $localizaion = new TongueFacade($lang_path);

        $jsons_list = $localizaion->transcribe();

        foreach ($jsons_list as $json_name => $content) {
            // TODO: Throw exception when JSON with lang code already exists
            file_put_contents("{$lang_path}/{$json_name}.json", json_encode($content));
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
