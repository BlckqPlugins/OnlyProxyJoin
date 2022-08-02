<?php

namespace blckqplugins\onlyproxyjoin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\plugin\PluginBase;

class OnlyProxyJoin extends PluginBase implements Listener {

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }

    public function onPreLogin(PlayerLoginEvent $event) {
        if($this->getConfig()->get("use-onlyproxyjoin") === true) {
            if($event->getPlayer()->getNetworkSession()->getIp() != $this->getConfig()->get("proxy-address")) {
                $event->setKickMessage($this->getConfig()->get("kick-message"));
                $event->cancel();
            }
        }
    }
}
