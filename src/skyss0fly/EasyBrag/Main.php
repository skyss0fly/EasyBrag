<?php

namespace skyss0fly\EasyBrag;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\inventory\PlayerInventory;

class Main extends PluginBase implements Listener {
  /** @var Config */
    private $config;


public function onLoad(): void {
$this->saveDefaultConfig();
  $config = $this->getConfig();
  

}
public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
  switch ($command->getName()) {
            case "brag":
    if(!$sender instanceof Player){
  $sender->sendMessage("Error, must be in game");
      
    } 
    $cooldown = $config->get("Cooldown");
    $message = $config->get("Message");
    $item = $sender->getItemInHand();
    $this->getServer()->broadcastMessage($sender , $message , $item);
    sleep($cooldown)
      if (sleep($cooldown) < 0) {
      $sender->sendMessage("Please wait until your cooldown ends!");
      return true;
}
}
