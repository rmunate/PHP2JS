<?php

namespace Rmunate\Php2Js\Commands;

use Illuminate\Console\Command;
use Rmunate\Php2Js\Traits\CommandUtilities;

/**
 * Class PHP2JSClear.
 *
 * Command to clear the current PHP2JS settings on the Blade directives.
 */
class PHP2JSClear extends Command
{
    use CommandUtilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'php2js:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the current PHP2JS settings on the Blade directives and providers.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Clear cache, views, and configuration
        $this->call('cache:clear');
        $this->call('view:clear');
        $this->call('config:clear');

        // Notify success
        $this->notifyInfo('Cleaned up PHP2JS settings on Blade directives. The ones in force in the current version will be taken.');
    }
}
