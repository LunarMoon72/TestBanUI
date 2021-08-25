<?php

namespace LunarMoon72\TestBanUI;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase{
    public function onEnabled(){
    	$this->getLogger()->info("Plugin is enabled!");
    }
    public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
    	if(!$sender instanceof Player){
    		$this->getLogger()->info("Use this command Ingame");
    	} else {
    		$sender->mainui($sender);
    	}
    	switch($cmd->getName()){
    		case "banui":
    		    $sender->mainui($sender);
        
    	}
        return true;
    }
    public function banui($player){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    	$form = $api->createCustomForm(function(Player $player, int $data = null){
            if($data === null){
            	return true;
            }
            switch($data){
            	case 0:
            	    $player->banplayer($player);
            	break;

            	case 1:
            	    $player->kickplayer($player);
            	break;

            	case 2:
            	    $player->freezeplayer($player);
            }
    	});
    	$form->setTitle("Choose an Option");
    	$form->addButton("Ban a Player!");
    	$form->addButton("Kick a Player!");
    	$form->addButton("Freeze a Player!");
    	$form->sendToPlayer();
    	return $form;
    }
    public function banplayer($player){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    	$form = $api->createCustomForm(function(Player $player, int $data = null){
            if($data === null){
            	return true;
            }
            switch($data){
            	case 0:
            	    $this->getServer()->dispatchCommand("ipban " . $data[0]);
            	break;
            }
    	});
    	$form->setTitle("Type a player's name to ban them! WARNING: IP BAN");
    	$form->addInput("Ex: LunarMoon72");
    	$form->sendToPlayer();
    	return $form;
    }
    public function kickplayer($player){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    	$form = $api->createCustomForm(function(Player $player, int $data = null){
            if($data === null){
            	return true;
            }
            switch($data){
            	case 0:
            	    $this->getServer()->dispatchCommand("kick " . $data[0]);
            	break;
            }
    	});
    	$form->setTitle("Type a player's name to kick them!");
    	$form->addInput("Ex: LunarMoon72");
    	$form->sendToPlayer();
    	return $form;
    }
    public function freezeplayer($player){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    	$form = $api->createCustomForm(function(Player $player, int $data = null){
            if($data === null){
            	return true;
            }
            switch($data){
            	case 0:
            	    $this->getServer()->dispatchCommand("freeze " . $data[0]);
            	break;
            }
    	});
    	$form->setTitle("Type a player's name to freeze them!");
    	$form->addInput("Ex: LunarMoon72");
    	$form->sendToPlayer();
    	return $form;
    }

}
