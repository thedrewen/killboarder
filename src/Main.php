<?php 

namespace TheDreWen\KillBoarder;

use customiesdevs\customies\entity\CustomiesEntityFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\utils\Config;
use Symfony\Component\Filesystem\Path;
use TheDreWen\KillBoarder\commands\deleteLeaderboard;
use TheDreWen\KillBoarder\commands\setLeaderboard;
use TheDreWen\KillBoarder\Listeners\PlayerListeners;

class Main extends PluginBase { 

	protected function onEnable(): void {

		$this->saveResource("KillBoarder.zip");
		$rpManager = $this->getServer()->getResourcePackManager();
		$rpManager->setResourceStack(array_merge($rpManager->getResourceStack(), [new ZippedResourcePack(Path::join($this->getDataFolder(), "KillBoarder.zip"))]));
		(new \ReflectionProperty($rpManager, "serverForceResources"))->setValue($rpManager, true);

		$this->getLogger()->info("Plugin Enabled");
		$this->saveResource('config.yml');

		$this->getServer()->getCommandMap()->registerAll('commands', [
			new setLeaderboard($this),
			new deleteLeaderboard($this)
		]);
		$this->getServer()->getPluginManager()->registerEvents(new PlayerListeners($this), $this);

		CustomiesEntityFactory::getInstance()->registerEntity(LeaderBoard::class, "killboarder:scoreboard");

		$tasks = new tasks($this);
		$this->getScheduler()->scheduleRepeatingTask($tasks, 3*20);
	}

	protected function onDisable(): void {
		$this->getLogger()->info("Plugin Disabled");
	}

}