<?php


namespace kzorluoglu\ChameleonConsole\Command;

use Symfony\Component\Console\Command\ListCommand;

class ChameleonListCommand
{

    private ListCommand $decoratedListCommand;
    private ConsoleCommand $chameleonConsoleCommand;

    public function __construct(ListCommand $decoratedListCommand, ConsoleCommand $chameleonConsoleCommand)
    {
        $this->decoratedListCommand = $decoratedListCommand;
        $this->chameleonConsoleCommand = $chameleonConsoleCommand;
    }
}