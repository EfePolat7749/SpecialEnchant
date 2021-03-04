<?php

namespace iEfePolat\SpecialEnchant\commands;

use pocketmine\{
      Player,
      Server,
      command\Command,
      scheduler\Task,
      utils\Config,
      command\CommandSender as WOOD //emİrhaNa SelAM
};
use jojoe77777\FormAPI\{
        CustomForm,
        SimpleForm
};
use iEfePolat\SpecialEnchant\{
        Main,
        tasks\ETask
};
use onebone\economyapi\EconomyAPI;

class SpecialEnchantCommand extends Command{
        
        public $special;
        public $specialLevel;
        public $id;
        
        public function __construct(){
                parent::__construct("ozelbuyu", "Verimlilik Kırılmazlık Gibi büyülerden sıkıldınmı? bu komut tam sana göre!", "/ozelbuyu", ["ozelbuyu", "specialenchant"]);
        }
        public function execute(WOOD $g, string $label, array $args){
                $this->specialForm($g);
        }
        
        public function specialForm($g){
              $f = new SimpleForm(function(Player $g, $args){
                      if($args === null) return true;
                      switch($args){
                              case 0:
                                      $this->firinAl($g);
                                      break;
                      }
              }); 
              $f->setTitle("§8Özel Büyü");
              $f->setContent("§aButonlara tıklayarak özel büyüler hakkında bilgi alabilir veya satin alabilirsin");
              $f->addButton("§dFırın");
              $f->sendToPlayer($g);
        }
        public function firinAl($g){
                      $f = new CustomForm(function(Player $g, $args){
                              if($args === null) return true;
                              if($args[1] == 0){
                              if(EconomyAPI::getInstance()->myMoney($g) >= 50000){
                                      EconomyAPI::getInstance()->reduceMoney($g, 50000);
                                      $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                                        if($cfg->get($g->getName()) == false){
                                        $this->special[$g->getName()] = true;
                                        $pl = Main::getAPI();
                                        Main::getAPI()->getScheduler()->scheduleRepeatingTask($task = new ETask($this, $this->id, $g, $pl), 20*1);
                                        $g->sendMessage("§aSatın Alındı!");
                                        $this->id[$g->getName()] = $task->getTaskId();
                                        $this->specialLevel[$g->getName()] = 1;
                                        $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                                        $cfg->set($g->getName(), true);
                                        $cfg->save();
                                        }else{
                                                                                    $g->sendMessage("§cZaten Bir Büyü Almışsın!");
                                                                            }
                                                                    }else{
                                                                            $g->sendMessage("§cParan Yetersiz!");
                                                                    }
                              }
                              if($args[1] == 1){
                              if(EconomyAPI::getInstance()->myMoney($g) >= 100000){
                                      EconomyAPI::getInstance()->reduceMoney($g, 100000);
                                      $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                                      if($cfg->get($g->getName()) == false){
                                        $this->special[$g->getName()] = true;
                                        $pl = Main::getAPI();
                                        Main::getAPI()->getScheduler()->scheduleRepeatingTask($task = new ETask($this, $this->id, $g, $pl), 20*1);
                                        $g->sendMessage("§aSatın Alındı!");
                                        $this->id[$g->getName()] = $task->getTaskId();
                                        $this->specialLevel[$g->getName()] = 2;
                                        $cfg = new Config(Main::getAPI()->getDataFolder()."se.yml", Config::YAML);
                                        $cfg->set($g->getName(), true);
                                        $cfg->save();
                                      }else{
                                              $g->sendMessage("§cZaten Bir Büyü Almışsın!");
                                      }
                              }else{
                                      $g->sendMessage("§cParan Yetersiz!");
                              }
                              }
                      }); 
                      $f->setTitle("§8Özel Büyü");
                      $f->addLabel("§dFırın Büyüsü:\n\n§5Kum`u Cama\n§5Kırıktaş`ı Taşa\n§5Ore`leri Külçeye Çeviren Bir Büyüdür 2 Seviyesi Bulunur\n§5Fırın I: kırıktaş`ı Taşa ve Altın Oreyi Altın Külçesine Çevirir\n§5Fırın II: §5Kum`u Cama Oreleri Külçeye Kırıktaşı Stone Çevirir\n\n§c§lNOT: §cBüyüler 30 Dakikalıktır\n\n\n\n§aFırın I: 50.000TL\n\n§aFırın I: 100.000TL");
                      $f->addStepSlider("§dFırın Seviyesi", ["1", "2"]);
                      $f->sendToPlayer($g);
                }
}
