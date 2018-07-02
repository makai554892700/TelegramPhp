<?php

namespace App\Console\Commands;

use App\Utils\TelegramUtils;
use Illuminate\Console\Command;

class TelegramGroupToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:group_to_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'telegram group to db.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $telegramUtils = TelegramUtils::getInstance();
        $groupList = $telegramUtils->getGroupList();
    }
}
