<?php

namespace TheDreWen\KillBoarder\Listeners;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use TheDreWen\KillBoarder\Main;

class PlayerListeners implements Listener
{

    private Main $main;

    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    public function onEntityDamageByEntityEvent(EntityDamageByEntityEvent $event)
    {
        
        $entity = $event->getEntity();
        $damager = $event->getDamager();

        if ($damager instanceof Player)
        {
            
            if($entity instanceof Player || $this->main->getConfig()->get("isMobKill") == "true" || $this->main->getConfig()->get("isMobKill"))
            {
                $health = $entity->getHealth();
                if($entity->getHealth() - $event->getFinalDamage() <= 0)
                {
                    
                    $conf = $this->main->getConfig();

                    $damagerName = $damager->getName();
                    if($conf->exists("players"))
                    {
                        $kill_damager = $conf->getNested("players.$damagerName");
                        $conf->setNested("players.$damagerName", $kill_damager + 1);
                    }
                    else
                    {
                        $conf->setNested("players.$damagerName", 1);
                    }

                    $conf->save();


                }
            }
            
        }

    }

}