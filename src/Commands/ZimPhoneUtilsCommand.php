<?php

namespace JoemagsApps\ZimPhoneUtils\Commands;

use Illuminate\Console\Command;

class ZimPhoneUtilsCommand extends Command
{
    public $signature = 'zim-phone-utils';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
