<?php
declare(strict_types=1);

namespace shelly7w7\VanillaCoordinates\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\permission\DefaultPermissionNames;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use shelly7w7\VanillaCoordinates\Loader;

class CoordinateCommand extends Command {

	public function __construct() {
		parent::__construct("coordinates", "Toggle on/off coordinates.", "/coordinates", ["coords"]);
		$this->setPermission(DefaultPermissionNames::GROUP_USER);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): void {
		if(!$sender instanceof Player) {
			$sender->sendMessage("Use this command in-game only.");
			return;
		}

		if(count($args) < 1) {
			$sender->sendMessage(TextFormat::RED . "Invalid Arguments, please use /coordinates [on/off]");
			return;
		}

		switch($args[0]) {
			case "on":
				$pk = new GameRulesChangedPacket();
				$pk->gameRules = ["showcoordinates" => new BoolGameRule(true, false)];
				$sender->getNetworkSession()->sendDataPacket($pk);
				$sender->sendMessage(Loader::getInstance()->getConfig()->get("turned-on"));
				break;
			case "off":
				$pk = new GameRulesChangedPacket();
				$pk->gameRules = ["showcoordinates" => new BoolGameRule(false, false)];
				$sender->getNetworkSession()->sendDataPacket($pk);
				$sender->sendMessage(Loader::getInstance()->getConfig()->get("turned-off"));
				break;
			default:
				$sender->sendMessage(TextFormat::RED . "Invalid Arguments, please use /coordinates [on/off]");
		}
	}
}