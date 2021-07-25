<?php


namespace kzorluoglu\ChameleonConsole\Helper;


use ComposerLocator;

class ChameleonPackageInfoHelper
{

    private const CHAMELEON_PACKAGE_NAME = 'chameleon-system/chameleon-system';

    public function getVersion(): string
    {

        $isChameleonInstalled = ComposerLocator::isInstalled(self::CHAMELEON_PACKAGE_NAME);
        if (false === $isChameleonInstalled) {
            return 'is not yet installed..';
        }

        return $this->findVersion(self::CHAMELEON_PACKAGE_NAME);

    }

    public function findVersion(string $packageName)
    {
        $installedPackages = require(ComposerLocator::getRootPath().'/vendor/composer/installed.php');

        if (true === array_key_exists($packageName, $installedPackages['versions'])) {
            return $installedPackages['versions'][$packageName]['version'];
        }

        return 'version can\'t be found.';

    }


}