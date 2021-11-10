<?php
namespace kzorluoglu\ChameleonConsole\Command;

use kzorluoglu\ChameleonConsole\Interfaces\LogoDrawerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command
{

    protected static $defaultName = 'chameleon:information';

    private string $logo = __DIR__.'/../Bitmap/logo.bmp';
    private string $data = '';
    private int $width = 0;
    private int $height = 0;
    private int $size = 0;
    private int $pixelLenPerChar = 3;
    private LogoDrawerInterface $logoDrawer;

    public function __construct(LogoDrawerInterface $logoDrawer)
    {
        parent::__construct();
        $this->logoDrawer = $logoDrawer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write($this->logoDrawer->draw());

        return 0;
    }

}