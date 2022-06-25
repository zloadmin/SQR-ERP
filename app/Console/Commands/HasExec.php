<?php

namespace App\Console\Commands;


use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

trait HasExec
{

    public function exec($command)
    {
        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
