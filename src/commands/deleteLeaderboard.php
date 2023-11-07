<?php

namespace TheDreWen\KillBoarder\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use TheDreWen\KillBoarder\LeaderBoard;
use TheDreWen\KillBoarder\Main;

class deleteLeaderboard extends Command
{
    private Main $main;

    public function __construct(Main $main)
    {
        parent::__construct("deleteleaderboard", "Remove leaderboard.", "/deleteleaderboard", []);
        $this->main = $main;
        $this->setPermission("killboarder.op");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            
            foreach($sender->getLocation()->getWorld()->getEntities() as $entity)
            {
                if($entity->getPosition()->distance($sender->getPosition()) < 3 && $entity instanceof LeaderBoard)
                {
                    $entity->kill();
                }
            }

        }else{
            $sender->sendMessage("§c[§eKillBoarder§c]§c This command is unavailable through the console.");
        } 

    }
    
}