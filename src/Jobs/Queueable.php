<?php

namespace SebastiaanLuca\Flow\Jobs;

use Illuminate\Bus\Queueable as IlluminateQueueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Trait Job
 *
 * Implement the Illuminate\Contracts\Queue\ShouldQueue interface to allow this job to be queued.
 *
 * @package SebastiaanLuca\Flow\Jobs
 */
trait Queueable
{
    use Dispatchable, InteractsWithQueue, IlluminateQueueable, SerializesModels;
}


