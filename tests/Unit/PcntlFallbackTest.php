<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class PcntlFallbackTest extends TestCase
{
    private const DISABLED = 'pcntl_signal,pcntl_alarm,pcntl_async_signals';

    private function run_php(string $code, string $disabled = ''): Process
    {
        $process = new Process([PHP_BINARY, '-d', 'disable_functions='.$disabled, '-r', $code]);
        $process->run();

        return $process;
    }

    public function test_stand_ins_make_the_queue_worker_calls_work_when_pcntl_functions_are_disabled(): void
    {
        $file = var_export(dirname(__DIR__, 2).'/app/Support/pcntl_fallback.php', true);

        $process = $this->run_php(
            "require $file;".
            'var_dump(\Illuminate\Queue\pcntl_async_signals(true), \Illuminate\Queue\pcntl_signal(2, fn () => null), \Illuminate\Queue\pcntl_alarm(5));',
            self::DISABLED
        );

        $this->assertTrue($process->isSuccessful(), $process->getErrorOutput().$process->getOutput());
        $this->assertSame("bool(false)\nbool(true)\nint(0)\n", $process->getOutput());
    }

    public function test_real_pcntl_functions_are_left_alone_when_they_are_available(): void
    {
        $process = $this->run_php('echo function_exists("pcntl_signal") ? "yes" : "no";');
        if ($process->getOutput() !== 'yes') {
            $this->markTestSkipped('pcntl is not available in this PHP build.');
        }

        $file = var_export(dirname(__DIR__, 2).'/app/Support/pcntl_fallback.php', true);
        $process = $this->run_php("require $file; echo function_exists('Illuminate\\\\Queue\\\\pcntl_signal') ? 'shadowed' : 'untouched';");

        $this->assertSame('untouched', $process->getOutput());
    }
}
