<?php

namespace DghDeV;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ExecutorCommand;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\item\Item;
use onebone\economyapi\EconomyAPI;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

    public function onEnable(){
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->getLogger()->info("§l§aPlugin Enable.. By DghDeV");
    }

   public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();
        $inv = $player->getInventory();
 
        $player->getInventory()->setItem(4, Item::get(345, 0, 1)->setCustomName("§l§bSERVER SELECTOR"));
    
        $player->getInventory()->setItem(0, Item::get(340, 0, 1)->setCustomName("§l§bRANKLIST"));
}
    public function onDisable(){
        $this->getLogger()->info("§c§lPlugin Disable.. By DghDeV");
    }


    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
		    $inv = $player->getInventory();
        $inv->clearAll();
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    }

    public function OnInteract(PlayerInteractEvent $event){

        $player = $event->getPlayer();
        $name = $player->getName();
        $inv = $player->getInventory();
        $item = $event->getItem();

        if ($item->getId() == "345") {
        $this->MenuForm($player);
        }
        if ($item->getId() == "340") {
        $this->RankListForm($player);
        }
    }
    public function onDrop(PlayerDropItemEvent $event){
    $player = $event->getPlayer();
    $item = $event->getItem();
    
        if($item->getId() == "345") {
            $event->setCancelled(true);
            
        if($item->getId() == "340") {
            $event->setCancelled(true);
        }
    }
}
    public function MenuForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->OneBlockForm($sender);
                break;
                case 1:
                    $this->SkyBlockForm($sender);
                break;
                case 2:
                    $this->SkyTreeForm($sender);
                break;
                case 3:
                    $this->MinigamesForm($sender);
                break;
                case 4:
                    $sender->sendMessage("§cCancelled");
                break;
            }
        });
        $form->setTitle("§b§lSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lONEBLOCK\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lSKYBLOCK\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lSKYTREE\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lMINIGAMES\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lBACK", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
    }
    
    public function OneBlockForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer oneblock");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
    public function SkyBlockForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer skyblock");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
   public function SkyTreeForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer skytree");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
   public function MinigamesForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer minigames");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }

   public function RankListForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
                case 1:
                    $this->SERVER2($sender);
                break;
                case 2:
                    $this->SERVER3($sender);
                break;
                case 3:
                    $this->SERVER3($sender);
                break;
                case 4:
                    $sender->sendMessage("§cCancelled");
                break;
            }
        });
        $form->setTitle("§l§bRANKLIST");
        $form->setContent("");
        $form->addButton($this->getConfig()->get("SERVER-1"));
        $form->addButton($this->getConfig()->get("SERVER-2"));
        $form->addButton($this->getConfig()->get("SERVER-3"));
        $form->addButton($this->getConfig()->get("SERVER-4"));
        $form->addButton($this->getConfig()->get("BACK"));
        $form->sendToPlayer($sender);
        return ($form);
   }
   
       public function SERVER1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->Rank1Server1($sender);
                break;
                case 1:
                    $this->Rank2Server1($sender);
                break;
                case 2:
                    $this->Rank3Server1($sender);
                break;
                case 3:
                    $this->Rank4Server1($sender);
                break;
                case 4:
                    $this->Rank5Server1($sender);
                break;
                case 5:
                    $this->RankListForm($sender);
                break;

                }
            });
            $form->setTitle($this->getConfig()->get("RANKLIST"));
            $form->setContent($this->getConfig()->get("Content"));
            $form->addButton($this->getConfig()->get("RANK1-BUTTON-SERVER-1"));
            $form->addButton($this->getConfig()->get("RANK2-BUTTON-SERVER-1"));
            $form->addButton($this->getConfig()->get("RANK3-BUTTON-SERVER-1"));
            $form->addButton($this->getConfig()->get("RANK4-BUTTON-SERVER-1"));
            $form->addButton($this->getConfig()->get("RANK5-BUTTON-SERVER-1"));
            $form->addButton($this->getConfig()->get("BACK-SERVER-1"));
            $form->sendToPlayer($sender);
            return $form;
    }
    
    public function Rank1Server1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK1-TITLE-SERVER-1"));
        $form->setContent($this->getConfig()->get("FITUR-RANK1-SERVER-1"));
        $form->addButton($this->getConfig()->get("RANK1-BACK-SERVER-1"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank2Server1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK2-TITLE-SERVER-1"));
        $form->setContent($this->getConfig()->get("FITUR-RANK2-SERVER-1"));
        $form->addButton($this->getConfig()->get("RANK2-BACK-SERVER-1"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank3Server1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK3-TITLE-SERVER-1"));
        $form->setContent($this->getConfig()->get("FITUR-RANK3-SERVER-1"));
        $form->addButton($this->getConfig()->get("RANK3-BACK-SERVER-1"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank4Server1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK4-TITLE-SERVER-1"));
        $form->setContent($this->getConfig()->get("FITUR-RANK4-SERVER-1"));
        $form->addButton($this->getConfig()->get("RANK4-BACK-SERVER-1"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank5Server1($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER1($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK5-TITLE-SERVER-1"));
        $form->setContent($this->getConfig()->get("FITUR-RANK5-SERVER-1"));
        $form->addButton($this->getConfig()->get("RANK5-BACK-SERVER-1"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function SERVER2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->Rank1Server2($sender);
                break;
                case 1:
                    $this->Rank2Server2($sender);
                break;
                case 2:
                      $this->Rank3Server2($sender);
                break;
                case 3:
                    $this->Rank4Server2($sender);
                break;
                case 4:
                    $this->Rank5Server2($sender);
                break;
                case 5:
                    $this->RankListForm($sender);
                break;

                }
            });
            $form->setTitle($this->getConfig()->get("RANKLIST"));
            $form->setContent($this->getConfig()->get("Content"));
            $form->addButton($this->getConfig()->get("RANK1-BUTTON-SERVER-2"));
            $form->addButton($this->getConfig()->get("RANK2-BUTTON-SERVER-2"));
            $form->addButton($this->getConfig()->get("RANK3-BUTTON-SERVER-2"));
            $form->addButton($this->getConfig()->get("RANK4-BUTTON-SERVER-2"));
            $form->addButton($this->getConfig()->get("RANK5-BUTTON-SERVER-2"));
            $form->addButton($this->getConfig()->get("BACK-SERVER-2"));
            $form->sendToPlayer($sender);
            return $form;
    }
    
    public function Rank1Server2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER2($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK1-TITLE-SERVER-2"));
        $form->setContent($this->getConfig()->get("FITUR-RANK1-SERVER-2"));
        $form->addButton($this->getConfig()->get("RANK1-BACK-SERVER-2"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank2Server2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER2($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK2-TITLE-SERVER-2"));
        $form->setContent($this->getConfig()->get("FITUR-RANK2-SERVER-2"));
        $form->addButton($this->getConfig()->get("RANK2-BACK-SERVER-2"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank3Server2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER2($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK3-TITLE-SERVER-2"));
        $form->setContent($this->getConfig()->get("FITUR-RANK3-SERVER-2"));
        $form->addButton($this->getConfig()->get("RANK3-BACK-SERVER-2"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank4Server2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER2($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK4-TITLE-SERVER-2"));
        $form->setContent($this->getConfig()->get("FITUR-RANK4-SERVER-2"));
        $form->addButton($this->getConfig()->get("RANK4-BACK-SERVER-2"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank5Server2($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER2($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK5-TITLE-SERVER-2"));
        $form->setContent($this->getConfig()->get("FITUR-RANK5-SERVER-2"));
        $form->addButton($this->getConfig()->get("RANK5-BACK-SERVER-2"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function SERVER3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->Rank1Server3($sender);
                break;
                case 1:
                    $this->Rank2Server3($sender);
                break;
                case 2:
                    $this->Rank3Server3($sender);
                break;
                case 3:
                    $this->Rank4Server3($sender);
                break;
                case 4:
                    $this->Rank5Server3($sender);
                break;
                case 5:
                    $this->RankListForm($sender);
                break;

                }
            });
            $form->setTitle($this->getConfig()->get("RANKLIST"));
            $form->setContent($this->getConfig()->get("Content"));
            $form->addButton($this->getConfig()->get("RANK1-BUTTON-SERVER-3"));
            $form->addButton($this->getConfig()->get("RANK2-BUTTON-SERVER-3"));
            $form->addButton($this->getConfig()->get("RANK3-BUTTON-SERVER-3"));
            $form->addButton($this->getConfig()->get("RANK4-BUTTON-SERVER-3"));
            $form->addButton($this->getConfig()->get("RANK5-BUTTON-SERVER-3"));
            $form->addButton($this->getConfig()->get("BACK-SERVER-3"));
            $form->sendToPlayer($sender);
            return $form;
    }
    
    public function Rank1Server3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER3($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK1-TITLE-SERVER-3"));
        $form->setContent($this->getConfig()->get("FITUR-RANK1-SERVER-3"));
        $form->addButton($this->getConfig()->get("RANK1-BACK-SERVER-3"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank2Server3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER3($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK2-TITLE-SERVER-3"));
        $form->setContent($this->getConfig()->get("FITUR-RANK2-SERVER-3"));
        $form->addButton($this->getConfig()->get("RANK2-BACK-SERVER-3"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank3Server3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER3($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK3-TITLE-SERVER-3"));
        $form->setContent($this->getConfig()->get("FITUR-RANK3-SERVER-3"));
        $form->addButton($this->getConfig()->get("RANK3-BACK-SERVER-3"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank4Server3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER3($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK4-TITLE-SERVER-3"));
        $form->setContent($this->getConfig()->get("FITUR-RANK4-SERVER-3"));
        $form->addButton($this->getConfig()->get("RANK4-BACK-SERVER-3"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank5Server3($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER3($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK5-TITLE-SERVER-3"));
        $form->setContent($this->getConfig()->get("FITUR-RANK5-SERVER-3"));
        $form->addButton($this->getConfig()->get("RANK5-BACK-SERVER-3"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function SERVER4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                    $this->Rank1Server4($sender);
                break;
                case 1:
                    $this->Rank2server4($sender);
                break;
                case 2:
                    $this->Rank3server4($sender);
                break;
                case 3:
                    $this->Rank4server4($sender);
                break;
                case 4:
                    $this->Rank5Server4($sender);
                break;
                case 5:
                    $this->RankListForm($sender);
                break;

                }
            });
            $form->setTitle($this->getConfig()->get("RANKLIST"));
            $form->setContent($this->getConfig()->get("Content"));
            $form->addButton($this->getConfig()->get("RANK1-BUTTON-SERVER-4"));
            $form->addButton($this->getConfig()->get("RANK2-BUTTON-SERVER-4"));
            $form->addButton($this->getConfig()->get("RANK3-BUTTON-SERVER-4"));
            $form->addButton($this->getConfig()->get("RANK4-BUTTON-SERVER-4"));
            $form->addButton($this->getConfig()->get("RANK5-BUTTON-SERVER-4"));
            $form->addButton($this->getConfig()->get("BACK-SERVER-4"));
            $form->sendToPlayer($sender);
            return $form;
    }
    
    public function Rank1Server4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER4($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK1-TITLE-SERVER-4"));
        $form->setContent($this->getConfig()->get("FITUR-RANK1-SERVER-4"));
        $form->addButton($this->getConfig()->get("RANK1-BACK-SERVER-4"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank2Server4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER4($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK2-TITLE-SERVER-4"));
        $form->setContent($this->getConfig()->get("FITUR-RANK2-SERVER-4"));
        $form->addButton($this->getConfig()->get("RANK2-BACK-SERVER-4"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank3Server4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER4($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK3-TITLE-SERVER-4"));
        $form->setContent($this->getConfig()->get("FITUR-RANK3-SERVER-4"));
        $form->addButton($this->getConfig()->get("RANK3-BACK-SERVER-4"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank4Server4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER4($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK4-TITLE-SERVER-4"));
        $form->setContent($this->getConfig()->get("FITUR-RANK4-SERVER-4"));
        $form->addButton($this->getConfig()->get("RANK4-BACK-SERVER-4"));
        $form->sendToPlayer($sender);
        return $form;
    }
    
    public function Rank5Server4($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->SERVER4($sender);
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("RANK5-TITLE-SERVER-4"));
        $form->setContent($this->getConfig()->get("FITUR-RANK5-SERVER-4"));
        $form->addButton($this->getConfig()->get("RANK5-BACK-SERVER-4"));
        $form->sendToPlayer($sender);
        return $form;
    }
}