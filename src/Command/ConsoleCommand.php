<?php
namespace kzorluoglu\ChameleonConsole\Command;

use kzorluoglu\ChameleonConsole\Interfaces\LogoDrawerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command implements LogoDrawerInterface {

    protected static $defaultName = 'chameleon:information';

    private string $logo = __DIR__.'/../Bitmap/logo.bmp';
    private string $data = '';
    private int $width = 0;
    private int $height = 0;
    private int $size = 0;
    private int $pixelLenPerChar = 3;

    private function prepare()
    {
        $this->data = file_get_contents($this->logo);
        $ret = unpack('v/Vsize/v/v/VpixelStart/V/Vwidth/Vheight/v/vbytePerPixel/V*6', substr($this->data, 0x0, 54));
        $this->width = $ret['width'];
        $this->height = $ret['height'];
        $this->size = $ret['size'];
//        $this->offset = $ret['pixelStart'];
//        $this->bitDepth = $ret['bytePerPixel'];
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->draw($output);
        return 0;
    }

    public function draw(OutputInterface $output): void
    {
        $this->prepare();

        $charImgWidth = (int) ($this->width / $this->pixelLenPerChar);
        $charImgHeight = (int) ($this->height / $this->pixelLenPerChar);

        for ($i = 0; $i !== $charImgHeight; $i++) {
            $buf = '';
            for ($j = 0; $j !== $charImgWidth; $j++) {
                $sum = 0;
                for ($k = 0; $k !== $this->pixelLenPerChar; $k++) {
                    for ($l = 0; $l !== $this->pixelLenPerChar; $l++) {
                        $sum += $this->getPixelColor($this->pixelLenPerChar * $i + $k, $this->pixelLenPerChar * $j + $l);
                    }
                }
                $sum = (int) ($sum / $this->pixelLenPerChar / $this->pixelLenPerChar);
                $buf = $this->getChar($sum) . $buf;
            }
            $output->write($buf . PHP_EOL);
        }
    }

    function getPixelColor($x, $y) {
        $b = ord($this->data[$this->size - 3 * ($this->width * $x + $y) - 3]);
        $g = ord($this->data[$this->size - 3 * ($this->width * $x + $y) - 2]);
        $r = ord($this->data[$this->size - 3 * ($this->width * $x + $y) - 1]);
        return (min($r, $g, $b) + max($r, $g, $b)) >> 1;
    }

    function getChar($colorValue) {
        $map = '@#mdohsy+/-:.` ';
        return $map[(int) ($colorValue / 18)];
    }
}