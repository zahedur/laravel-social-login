<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class CreateTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a task creator symple command';

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
     * @return int
     */
    public function handle()
    {
        $task = new Task();
        $task->user_id = 1;
        $task->name = 'this is a testing task';
        $task->save();
    }
}
