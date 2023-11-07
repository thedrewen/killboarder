<?php

namespace TheDreWen\KillBoarder;

use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;

class LeaderBoard extends Entity
{
    public function __construct(Location $location, $nbt = null)
    {
        parent::__construct($location, $nbt);

        $this->setNameTagVisible();
        $this->setNameTagAlwaysVisible();
    }

    public function getGravity(): float
    {
        return 0;
    }

    protected function getInitialGravity(): float
    {
        return 0;
    }

    protected function getInitialDragMultiplier() : float {
        return 0;
    }

    public function getInitialSizeInfo() : EntitySizeInfo
    {
        return new EntitySizeInfo(1.5, 1);
    }
    
    public static function getNetworkTypeId() : string
    {
        return "killboarder:scoreboard";
    }
}