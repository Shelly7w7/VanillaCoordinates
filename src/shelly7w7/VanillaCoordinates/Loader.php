<?php

namespace shelly7w7\VanillaCoordinates; 

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use shelly7w7\VanillaCoordinates\command\CoordinateCommand;

class Loader extends PluginBase implements Listener {

	public function onEnable(){
    @mkdir($this->getDataFolder());
    $this->saveResource('config.yml');
    $this->config = new Config($this->getDataFolder().'config.yml', Config::YAML);
    $this->getServer()->getCommandMap()->register("vanillacoordinates", new CoordinateCommand("coordinates", $this));
     }
  }