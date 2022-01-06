<?php

namespace Ping;


use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, String $label, Array $args) : bool {
		switch($command->getName()){
			case 'ping':
			if(!isset($args[0])){
				if ($sender instanceof Player) {
					$ping = $sender->getPing();
					$pingMsg = "§eYour Ping: §f" . $ping . "§ems";
					$sender->sendMessage($pingMsg);
				}
			} else {
				$player = $this->getServer()->getPlayer($args[0]);
				if($player instanceof Player) {
					$ping = $player->getPing();
					$name = $player->getName();
					$pingMsg = "§6" . $name . "§e's Ping: §f" . $ping . "§ems";
					$sender->sendMessage($pingMsg);
				} else {
					$sender->sendMessage("§cPlayer is not online!");
				}
			}
			break;
		}
		return true;
	}
}