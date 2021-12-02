<?php
declare(strict_types=1);

namespace shelly7w7\VanillaCoordinates;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use shelly7w7\VanillaCoordinates\command\CoordinateCommand;

class Loader extends PluginBase {

	/** @var Config $config */
	protected $config;

	/** @var self $instance */
	protected static $instance;

	public function onEnable(): void {
		self::$instance = $this;

		@mkdir($this->getDataFolder());
		$this->saveResource('config.yml');
		$this->config = new Config($this->getDataFolder() . 'config.yml', Config::YAML);

		$this->getServer()->getCommandMap()->register("vanillacoordinates", new CoordinateCommand());
	}

	public static function getInstance(): self {
		return self::$instance;
	}

}