<?php

namespace skyss0fly\EasyBrag;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\lang\Language;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    private $cooldowns = [];
    private $prefix;
    private $cooldown;
    private $message;
    private $cooldown_message;
    private $invalid_item_message;
    private $message_enchants;
    private $disabled;
    private $disable;
    private $enable;
    private $noperm;
    private $status;
    

    public function onLoad(): void {
        $this->saveDefaultConfig();
        // New Update:
        $this->disabled = TextFormat::colorize($this->getConfig()->get("Disabled"));
        $this->noperm = TextFormat::colorize($this->getConfig()->get("NoPerm"));
        $this->disable = TextFormat::colorize($this->getConfig()->get("DisableMessage")); 
$this->enable = TextFormat::colorize($this->getConfig()->get("EnableMessage"));
        $this->status = $this->getConfig()->get("Status");

            // New Update ^
        $this->prefix = TextFormat::colorize(trim($this->getConfig()->get("Prefix")));
        $this->cooldown = $this->getConfig()->get("Cooldown");
        $this->message = TextFormat::colorize($this->getConfig()->get("Message"));
        $this->cooldown_message = TextFormat::colorize($this->getConfig()->get("CooldownMessage"));
        $this->invalid_item_message = TextFormat::colorize($this->getConfig()->get("InvalidItemMessage"));
        $this->message_enchants = TextFormat::colorize($this->getConfig()->get("MessageWithEnchants"));
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "brag":
            if ($status === true) {
                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cError, must be in game");
                    return false;
                }
                
                $player = $this->getServer()->getPlayerExact($sender->getName());
                $player_name = $player->getName();
                
                $currentTime = time();
                if (isset($this->cooldowns[$player_name]) && $this->cooldowns[$player_name] > $currentTime && !$sender->hasPermission("easybrag.cooldown_bypass")) {
                    $remainingTime = $this->cooldowns[$player_name] - $currentTime;
                    $sender->sendMessage($this->prefix . " " . str_replace('{seconds}', $remainingTime, $this->cooldown_message));
                    return false;
                }

                $item = $player->getInventory()->getItemInHand();
                $item_name = $item->getName();
                $player_displayname = $player->getDisplayName();
                
                if ($item !== null && $item_name != "Air") {
                    if ($item->hasEnchantments()) {
                        $bc = $this->prefix . " " . str_replace(array('{player}', '{user}', '{username}', '{name}'), $player_displayname, $this->message_enchants);
                        
                        $enchantment_names = array_map(function(EnchantmentInstance $enchantment) : string{
                            $ench_name = $enchantment->getType()->getName();
                            if (gettype($ench_name) === 'string') { //The name is a string in, for example, Custom Enchantments. PocketMine itself returns translatable
                                return $ench_name;
                            } else {
                                return $this->getServer()->getLanguage()->translateString($ench_name->getText());
                            }
                        }, $item->getEnchantments());

                        $enchantment_levels = array_map(function(EnchantmentInstance $enchantment) : int{
                            return $enchantment->getLevel();
                        }, $item->getEnchantments());
                        
                        $enchantment_list = "";
                        foreach ($enchantment_names as $index => $ench_name) {
                            $enchantment_list = $enchantment_list . " " . $ench_name . " : " . $enchantment_levels[$index] . ",";
                        }
                        
                        $bc = str_replace('{enchantments}', substr($enchantment_list, 1, -1), $bc);
                    } else {
                        $bc = $this->prefix . " " . str_replace(array('{player}', '{user}', '{username}', '{name}'), $player_displayname, $this->message);
                    }
                    $bc = str_replace("{item}", $item_name, $bc);
                    $this->getServer()->broadcastMessage($bc);
                    $this->cooldowns[$player_name] = $currentTime + $this->cooldown;
                } else {
                    $sender->sendMessage($this->prefix . " " . $this->invalid_item_message);
                }  
        } 
        else {
$sender->sendMessage($this->prefix . " " . $this->disabled);
            
        }
        return false;
    }
    return true;
}

        
case "bragadmin":
     if ($player hasPermission("easybrag.administrator")) {
if ($this->status === true){
    $this->status = false;
    $sender->sendMessage($this->prefix . " " . $this->disable);

return true;

    }
else {
$this->status = true;
    $sender->sendMessage($this->prefix . " " . $this->enable);

}
    else {
$sender->sendMessage($this->prefix . " " . $this->noperm);
        return false;
}




}
