<?php

namespace iEfePolat\SpecialEnchant\events;

use pocketmine\{
        Player,
        Server,
        event\Listener,
        event\block\BlockBreakEvent as BBE,
        event\player\PlayerQuitEvent as PQE,
        item\Item,
        utils\Config,
        block\Block
};
use iEfePolat\SpecialEnchant\commands\SpecialEnchantCommand;
use iEfePolat\SpecialEnchant\Main;

class SpecialEnchantEvent implements Listener{
        
        public $special;
        
        public function onBreak(BBE $e){
                $g = $e->getPlayer();
                $block = $e->getBlock();
                $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                if($cfg->get($g->getName()) == true){
                if($block->getId() == 4){
                                $e->setDrops([]);
                                $g->getInventory()->addItem(Item::get(1,0,1));
                        }
                        
                if($block->getId() == 14){
                                $e->setDrops([]);
                                $g->getInventory()->addItem(Item::get(Item::GOLD_INGOT,0,1));
                } //12 14 15
                if($block->getId() == 12){
                                $e->setDrops([]);
                                $g->getInventory()->addItem(Item::get(Item::GRASS,0,1));
                }
                if($block->getId() == 15){
                                $e->setDrops([]);
                                $g->getInventory()->addItem(Item::get(Item::IRON_INGOT,0,1));
                }
                }
        }
        public function onQuit(PQE $e){
                $g = $e->getPlayer();
                $this->special[$g->getName()] = false;
                $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                                                        $cfg->set($g->getName(), false);
                                                        $cfg->save();
        }
        
}
