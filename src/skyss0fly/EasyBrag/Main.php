<?php

namespace skyss0fly\EasyBrag;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\enchantment\VanillaEnchantments;
class Main extends PluginBase implements Listener {
    private $cooldowns = [];

    public function onLoad(): void {
        $this->saveDefaultConfig();
    }
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "brag":
                $cooldown = $this->getConfig()->get("Cooldown");
                
                $prefix = $this->getConfig()->get("Prefix");
                $player = $this->getServer()->getPlayerExact($sender->getName());
                $item = $player->getInventory()->getItemInHand();
//* $enchants = $item->getEnchantments()
           // brag message: with the following Enchants: " $enchants->getType()->getName();"
        


                if (!$sender instanceof Player) {
                    $sender->sendMessage($prefix . "§cError, must be in game");
                    return false;
                }

                $currentTime = time();
                if (isset($this->cooldowns[$player->getName()]) && $this->cooldowns[$player->getName()] > $currentTime) {
                    $remainingTime = $this->cooldowns[$player->getName()] - $currentTime;
                    $sender->sendMessage($prefix . "§cError: still in timeout. Remaining time: " . $remainingTime . " seconds.");
                    return false;
                }

                if ($item !== null) { 
                    $bc = $prefix . $player->getName() . " has got: §r" . $item->getName() 
                    $this->getServer()->broadcastMessage($bc);
                    $this->cooldowns[$player->getName()] = $currentTime + $cooldown;
                }
                
                return true;
            case "itembrag":
            $cooldown = $this->getConfig()->get("Cooldown");
                $prefix = $this->getConfig()->get("Prefix");
                $player = $this->getServer()->getPlayerExact($sender->getName());
                $item = $player->getInventory()->getItemInHand();

                if (!$sender instanceof Player) {
                    $sender->sendMessage($prefix . "§cError, must be in game");
                    return false;
                }

                $currentTime = time();
                if (isset($this->cooldowns[$player->getName()]) && $this->cooldowns[$player->getName()] > $currentTime) {
                    $remainingTime = $this->cooldowns[$player->getName()] - $currentTime;
                    $sender->sendMessage($prefix . "§cError: still in timeout. Remaining time: " . $remainingTime . " seconds.");
                    return false;
                }

                if ($item !== null) { 
                    $bc = $prefix . $player->getName() . " has got: §r" . $item->getName();
                    $this->getServer()->broadcastMessage($bc);
                    $this->cooldowns[$player->getName()] = $currentTime + $cooldown;
                }
                
                return true;
            case "itemview":
            $prefix = $this->getConfig()->get("Prefix");
            $cooldown = $this->getConfig()->get("DisableBragView");
         $disabled = $this->getConfig()->get("Prefix");
$player = $this->getServer()->getPlayerExact($sender->getName());
$disabledmessage = $prefix . "Unfortunately your admins Have Disabled this Command or you have no perms:(";
if ($disabled === true) {
    $sender->sendMessage($disabledmessage);
    return false;
}
            else {
$sender->sendMessage("Coming Soon:)");
                return false;
            }
        }
        
        return false;
    }
}
