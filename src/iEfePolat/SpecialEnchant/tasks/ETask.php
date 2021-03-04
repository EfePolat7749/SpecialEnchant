<?php

namespace iEfePolat\SpecialEnchant\tasks;

use pocketmine\{
        Server,
        scheduler\Task,
        Player,
        utils\Config
};
use iEfePolat\SpecialEnchant\commands\SpecialEnchantCommand;
use iEfePolat\SpecialEnchant\Main;

class ETask extends Task{
        
        public $plugin;
        public $id;
        public $timer = 1800;
        public $dakika = 29;
        public $saniye = 60;
        public $g;
        public $special;
        public $pl;
        
        public function __construct($plugin, $id, $g, $pl){
                 $this->plugin = $plugin;
                 $this->id = $id;
                 $this->g = $g;
                 $this->pl = $pl;
        }
        
        public function onRun(int $currentTick){
                $g = $this->g;
                $dk = $this->dakika;
                $sn = $this->saniye;
                $timer = $this->timer;
                if(!$timer == 0){
                        $g->sendPopUp("§6Özel Büyünün Bitmesine §e$this->dakika §6Dakika §e$this->saniye §6Saniye Kaldı");
                }
                if($this->saniye == 0){
                        $this->saniye = 60;
                        $dk-1;
                }
                if($timer == 0){
                        $this->plugin->special[$g->getName()] = false;
                        $cfg = new Config($this->pl->getDataFolder()."se.yml", Config::YAML);
                        $cfg->set($g->getName(), false);
                        $cfg->save();
                        $this->pl->getScheduler()->cancelTask($this->plugin->id[$g->getName()]);
                        $this->plugin->specialLevel[$g->getName()] = 0;
                        
                }
                $this->saniye--;
                $this->timer--;
        }
        
}
