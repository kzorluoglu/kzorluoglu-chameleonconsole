<?php
namespace kzorluoglu\ChameleonConsole\Drawer;

use kzorluoglu\ChameleonConsole\Helper\ChameleonPackageInfoHelper;
use kzorluoglu\ChameleonConsole\Interfaces\LogoDrawerInterface;

class StaticLogoDrawer implements LogoDrawerInterface
{

    private ChameleonPackageInfoHelper $chameleonPackageInfoHelper;

    public function __construct(ChameleonPackageInfoHelper $chameleonPackageInfoHelper)
    {
        $this->chameleonPackageInfoHelper = $chameleonPackageInfoHelper;
    }

    public function draw(): string
    {

        return sprintf("

 _____ _                          _                  
/  __ \ |                        | |                 
| /  \/ |__   __ _ _ __ ___   ___| | ___  ___  _ __  
| |   | '_ \ / _` | '_ ` _ \ / _ \ |/ _ \/ _ \| '_ \ 
| \__/\ | | | (_| | | | | | |  __/ |  __/ (_) | | | |
 \____/_| |_|\__,_|_| |_| |_|\___|_|\___|\___/|_| |_| %s
", $this->chameleonPackageInfoHelper->getVersion());
    }
}