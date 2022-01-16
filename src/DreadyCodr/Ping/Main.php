<?php

namespace DreadyCodr\Ping;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\network\NetworkSessionManager;

class Main extends PluginBase implements Listener {

    public function onEnable(): void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, String $label, Array $args) : bool {
		switch($command->getName()){
			case 'ping':
			if(!isset($args[0])){
				if ($sender instanceof Player) {
					$ping = $sender->getNetworkSession()->getPing();
					$pingMsg = "§eYour Ping: §f" . $ping . "§ems";
					$sender->sendMessage($pingMsg);
				}
			} else {
				foreach ($this->getServer()->getOnlinePlayers() as $player){
					if ($player->getDisplayName() === $args[0]){
						$ping = $player->getNetworkSession()->getPing();
						$name = $player->getName();
						$pingMsg = "§6" . $name . "§e's Ping: §f" . $ping . "§ems";
						$sender->sendMessage($pingMsg);
						return true;
					}
				}
				$sender->sendMessage("§cPlayer is not online!");
			}
			break;
		}
		return true;
	}
}