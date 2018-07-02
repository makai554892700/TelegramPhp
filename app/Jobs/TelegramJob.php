<?php

namespace App\Jobs;

use App\Utils\TelegramUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class TelegramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $TelegramUtils;
    private $type;
    private $username;
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $username, $message)
    {
        Log::error("type=" . $type . ";username="
            . $username . ";message=" . $message);
        $this->type = $type;
        $this->username = $username;
        $this->message = $message;
        Log::error("job start init;");
        $this->TelegramUtils = TelegramUtils::getInstance();
        Log::error("job end init;");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::error("type=" . $this->type . ";username="
            . $this->username . ";message=" . $this->message);
        if ("sendMessage" == $this->type) {
            $this->TelegramUtils->sendMessage($this->username, $this->message);
        } else {
            Log::error("no such type.type=" . $this->type);
        }
    }
}
