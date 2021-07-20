<?php
namespace kzorluoglu\ChameleonConsole\Interfaces;

use Symfony\Component\Console\Output\OutputInterface;

interface LogoDrawerInterface
{
    public function draw(OutputInterface $output): void;
}