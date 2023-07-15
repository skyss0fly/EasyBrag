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
      $cooldown = $this->getConfig()->get("Cooldown");
      $message =  $this->getConfig()->get("Message");
      $player = $this->getServer()->getPlayerByPrefix($sender);
      $item = $player->getInventory()->getItemInHand();
  if (!$sender instanceof Player) {
  $sender->sendMessage("Error, must be in game");
    return false;
  }
      if( $cooldown < 0){
        if($item !== null ){
$bc = "$player . $message . $item";
          $this->getServer()->broadcastMessage($bc);
      return false;
        }
        else {
$sender->sendMessage("Error: no item");
return true;
        }
      }
      else{
$sender->sendMessage("Error: still in timeout");
        return false;
      }
      return true;
    }
    }
}

