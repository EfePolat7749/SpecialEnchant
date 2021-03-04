<?php

declare(strict_types=1);

namespace iEfePolat\SpecialEnchant;

use pocketmine\{
        plugin\PluginBase,
        command\Command,
        command\CommandSender,
        Player,
        Server,
        event\Listener
};
use iEfePolat\SpecialEnchant\{
        commands\SpecialEnchantCommand,
        events\SpecialEnchantEvent
};
class Main extends PluginBase implements Listener{
        
        private static $api;
                
       public function onLoad(){
          $this->registerMultipleAcces();
        }
                
        public function registerMultipleAcces(){          
                return static::$api = $this;
        }
        
        public function onEnable(){
              $this->getServer()->getPluginManager()->registerEvents(new SpecialEnchantEvent, $this);
                $this->getServer()->getCommandMap()->register("ozelbuyu", new SpecialEnchantCommand($this)); //tabiki
        }
        public static function getAPI(): ?self{
                return self::$api;
        }
                  

}
