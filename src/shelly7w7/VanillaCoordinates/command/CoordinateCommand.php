<?php

namespace shelly7w7\VanillaCoordinates\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\Server;
use shelly7w7\vanillacoordinates\Loader;


class CoordinateCommand extends PluginCommand{

    public function __construct($name, Loader $plugin)
    {
        parent::__construct($name, $plugin);
        $this->plugin = $plugin;        
        $this->setAliases($this->plugin->config->get("aliases"));
        $this->setDescription("Show coordinates");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

               if (count($args) < 1) {
                $sender->sendMessage($this->plugin->config->get("invalid-arguments"));
                 return true;
                 }

                if (isset($args[0])) {
                 switch ($args[0]) {

                  case "on":
                   $pk = new GameRulesChangedPacket();
                   $pk->gameRules = ["showcoordinates" => [1, true, true]];
                   $sender->dataPacket($pk);
                   $sender->sendMessage($this->plugin->config->get("turned-on"));
                     break;

                  case "off":
                   $pk = new GameRulesChangedPacket();
                   $pk->gameRules = ["showcoordinates" => [1, false, false]];
                   $sender->dataPacket($pk);
                   $sender->sendMessage($this->plugin->config->get("turned-off"));

                 }
            }
      }
}
