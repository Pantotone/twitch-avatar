<?php

namespace App\Console\Commands;

use App\Clients\TwitchClient;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manucu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(TwitchClient $twitchClient)
    {
        $response = $twitchClient->getCategories('#software-and-game-development')
            ->json();

        dd($response);
    }
}
