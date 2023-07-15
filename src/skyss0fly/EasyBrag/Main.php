<?php

namespace skyss0fly\EasyBrag;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\inventory\PlayerInventory;

class Main extends PluginBase implements Listener {

  
public function onLoad(): void {
$this->saveDefaultConfig();
}
public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
    switch ($command->getName()) {
            case "brag":
    if(!$sender instanceof Player){
  $sender->sendMessage("Error, must be in game");
    return false;
    }
      $cooldown = $this->getConfig()->get("Cooldown");
      if ($cooldown < 0) {
      $sender->sendMessage("Please wait until your cooldown ends!");
      return false;
}
      else {    
    $item = $player->getInventory()->getItemInHand();
        if ($item !== null) {
          $message =  $this->getConfig()->get("Message");
          $player = $this->getServer()->getPlayerByPrefix($sender);
    $bc = "$player . $message . $item";
    $this->getServer()->broadcastMessage($bc);
      return true;
} else {
$sender->sendMessage("Error you dont have anything in your hand");          
          return false;
}
      } 
}
  return true;
}
  
}
