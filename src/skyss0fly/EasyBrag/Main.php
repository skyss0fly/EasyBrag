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
    
    } 
    $player = $this->getServer()->getPlayerByPrefix($sender);  
    $cooldown = $this->getConfig->get("Cooldown");
    $message =  $this->getConfig()->get("Message");
    $item = $player->getItemInHand();
    $this->getServer()->broadcastMessage($sender , $message , $item);
      if ($cooldown < 0) {
      $sender->sendMessage("Please wait until your cooldown ends!");
      return false;
}
    return true;
}
}
}
