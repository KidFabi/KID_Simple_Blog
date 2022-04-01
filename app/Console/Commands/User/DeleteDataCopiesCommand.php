<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteDataCopiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kidblog:delete-user-data-copies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all data copies submitted by all users.';

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        File::cleanDirectory('storage/app/public/uploads/' . User::DATA_COPIES_FOLDER);

        return $this->info('All data copies have been successfully deleted!');
    }
}
