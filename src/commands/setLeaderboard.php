<?php

namespace TheDreWen\KillBoarder\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\particle\FloatingTextParticle;
use TheDreWen\KillBoarder\LeaderBoard;
use TheDreWen\KillBoarder\libs\FloatingTextApi\FloatingText;
use TheDreWen\KillBoarder\Main;

class setLeaderboard extends Command
{
    private Main $main;

    public function __construct(Main $main)
    {
        parent::__construct("setleaderboard", "Display kill top.", "/setleaderboard", []);
        $this->main = $main;
        $this->setPermission("killboarder.op");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        
        if($sender instanceof Player)
        {
            

            $entity = new LeaderBoard($sender->getLocation());
            $entity->spawnToAll();
            $entity->setNameTag($this->main->getConfig()->get("server-name") . "\nWaiting...");

            $sender->sendMessage("§c[§eKillBoarder§c]§a Entity spawn with succès !");
            

        }else{
            $sender->sendMessage("§c[§eKillBoarder§c]§c This command is unavailable through the console.");
        } 

    }
    
}