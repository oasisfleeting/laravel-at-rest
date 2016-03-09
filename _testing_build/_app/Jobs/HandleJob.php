<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class HandleJob
 *
 * @package App\Jobs
 */
class HandleJob extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
