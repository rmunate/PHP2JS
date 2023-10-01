<?php

namespace Rmunate\Php2Js\Traits;

trait CommandUtilities
{
    /**
     * Check if the 'components' property exists and is not null.
     *
     * @return bool
     */
    private function validateComponents()
    {
        return property_exists($this, 'components') && $this->components !== null;
    }

    /**
     * Display an error message using the 'components' property if available, otherwise use the default 'error' method.
     *
     * @param string $message
     *
     * @return void
     */
    private function notifyError($message)
    {
        if ($this->validateComponents()) {
            $this->components->error($message);
        } else {
            $this->error($message);
        }
    }

    /**
     * Display an info message using the 'components' property if available, otherwise use the default 'info' method.
     *
     * @param string $message
     *
     * @return void
     */
    private function notifyInfo($message)
    {
        $this->validateComponents() ? $this->components->info($message) : $this->info($message);
    }
}
