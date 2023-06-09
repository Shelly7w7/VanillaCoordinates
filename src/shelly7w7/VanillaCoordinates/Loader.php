<?php
declare(strict_types=1);

namespace shelly7w7\VanillaCoordinates;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use shelly7w7\VanillaCoordinates\command\CoordinateCommand;

class Loader extends PluginBase {

	use SingletonTrait;

	protected Config $config;

	public function onEnable(): void {
		self::setInstance($this);

		@mkdir($this->getDataFolder());
		$this->saveResource('config.yml');
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);

		$this->getServer()->getCommandMap()->register("vanillacoordinates", new CoordinateCommand());
	}

}