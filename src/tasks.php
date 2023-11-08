<?php

namespace TheDreWen\KillBoarder;

use pocketmine\scheduler\Task;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\Server;

class tasks extends Task
{
    private Main $main;
    public function __construct(Main $main) { 
        $this->main = $main;
    }

    public function onRun(): void
    {
        foreach(Server::getInstance()->getWorldManager()->getWorlds() as $world)
        {
            foreach($world->getEntities() as $entity)
            {
                if($entity instanceof LeaderBoard)
                {
                    $conf = $this->main->getConfig();
                    $texteFormat = $conf->get("text-format");
                    $players = $conf->get("players");
                    $text = "";
                    $i = 0;
                    if($players != \null)
                    {
                        foreach($players as $playerName => $kill)
                        {
                            $i++;
                            $texte = \str_replace("{player}", $playerName, $texteFormat);
                            $texte = \str_replace("{number}", $kill, $texte);
                            $texte = \str_replace("{place}", $i, $texte);
                            $text = $text . "\n" . $texte;//"\n" . $playerName." : ".$kill."Kills\n";

                            if($i == $conf->get("max-place"))
                            {
                                break;
                            }
                        }
                    }
                    $entity->setNameTag($conf->get("server-name") . $text);
                }
            }
        }

    }
}