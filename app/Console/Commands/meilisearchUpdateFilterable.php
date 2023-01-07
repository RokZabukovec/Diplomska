<?php

namespace App\Console\Commands;

use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use http\Exception\InvalidArgumentException;
use http\Message;
use Illuminate\Console\Command as CommandAlias;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use MeiliSearch\Client;
use Symfony\Component\Console\Command\Command;

class meilisearchUpdateFilterable extends CommandAlias
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meilisearch:filterable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add filterable attributes to meilisearch index. The attributes are defined in the model.';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle()
    {
        $isMeilisearch = env("SCOUT_DRIVER", null) == "meilisearch";
        if (!$isMeilisearch){
            $this->warn("This command is meant for meilisearch scout driver.");
            return Command::FAILURE;
        }
        $meilisearchHost = env("MEILISEARCH_HOST", null);
        $meilisearchMasterKey = env("MEILISEARCH_KEY", null);

        if (empty($meilisearchHost)){
            $this->error("MEILISEARCH_HOST env variable is not set.");
            return Command::FAILURE;
        }

        $client = new Client($meilisearchHost, $meilisearchMasterKey);

        $modelClasses = collect(ClassFinder::getClassesInNamespace('App\Models'))
            ->filter(function($className){
                return is_subclass_of($className, Model::class);
            });

        foreach ($modelClasses as $model){
            $isSearchable = in_array(Searchable::class, class_uses_recursive($model));
            if (!$isSearchable){
                continue;
            }
            $fields =  get_class_vars($model);
            if (!empty($fields["filterable"]) && !empty($fields["index"])){
                $this->updateFilterableAttributes($client, $fields["index"], $fields["filterable"]);
            }
        }
        return Command::SUCCESS;
    }

    private function updateFilterableAttributes(Client $client, string $index, array $attributes){

        try {
            $client->index($index)->updateFilterableAttributes($attributes);
            $this->info('Successfully updated filterable attributes for ' . $index . ".");
        }catch (Exception){
            $this->error("The filterable attributes were not updated for index " . $index);
        }






    }
}
