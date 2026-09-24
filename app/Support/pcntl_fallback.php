<?php

/**
 * Shared hosts such as Hostinger load the pcntl extension but list pcntl_signal,
 * pcntl_alarm and friends in `disable_functions`. Laravel's queue worker only checks
 * extension_loaded('pcntl'), so `php artisan queue:work` dies with
 * "Call to undefined function Illuminate\Queue\pcntl_signal()" and no job ever runs.
 *
 * Laravel calls these functions without a leading backslash, so PHP looks in the
 * Illuminate\Queue namespace first. The stand-ins below are only declared when the real
 * function is missing; the worker then behaves as on a system without pcntl (no signal
 * handling and no per-job timeout; --max-time and --stop-when-empty still work).
 */

namespace Illuminate\Queue {
    if (! \function_exists('pcntl_async_signals')) {
        function pcntl_async_signals(?bool $enable = null): bool
        {
            return false;
        }
    }

    if (! \function_exists('pcntl_signal')) {
        function pcntl_signal(int $signal, $handler, bool $restart_syscalls = true): bool
        {
            return true;
        }
    }

    if (! \function_exists('pcntl_alarm')) {
        function pcntl_alarm(int $seconds): int
        {
            return 0;
        }
    }
}
