<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Setup
 * 
 * @author      Ryan Sullivan
 */
class Setup extends MS2_Controller {
    
    /**
     * Walks user through setting up application
     */
    public function index()
    {
        // try and add default database values
        try
        {
            //================
            // Data
            //================
            Data::connection()->query('delete from data');
            // client-version
            $data = new Data();
            $data->key      = 'client-version';
            $data->value    = '3.8.2';
            $data->save();
            // game-build
            $data = new Data();
            $data->key      = 'game-build';
            $data->value    = '1355999243000';
            $data->save();
            // highest-texture-location
            $data = new Data();
            $data->key      = 'highest-texture-location';
            $data->value    = 'aaaaa';
            $data->save();
            // default-skin
            $data = new Data();
            $data->key      = 'default-skin';
            $data->value    = 'Steve';
            $data->save();
            
            //================
            // Download Group
            //================
            Downloadgroup::connection()->query('delete from download_groups');
            // client
            $download_group = array();
            $download_group['client'] = new Downloadgroup();
            $download_group['client']->name = 'Client Proxy';
            $download_group['client']->version = '3.8.3';
            $download_group['client']->description = '<p>The client proxy is what you need if you want to play Minecraft and use our services.</p><p>Click on your Operating System to download the launcher.</p>';
            $download_group['client']->save();
            // server
            $download_group['server'] = new Downloadgroup();
            $download_group['server']->name = 'Server Proxy';
            $download_group['server']->version = '3.8.3';
            $download_group['server']->description = '<p>The server proxy is what you need if you want to run a multiplayer server.</p><p>You will still need to download either the official <a href="http://minecraft.net/download" target="_blank">Minecraft Server</a> or <a href="http://dl.bukkit.org/" target="_blank">Bukkit</a> Jar as well.</p>';
            $download_group['server']->save();
            // source
            $download_group['source'] = new Downloadgroup();
            $download_group['source']->name = 'Source Code';
            $download_group['source']->version = 'Version Proxy 3.8.0 / Auth 3.0.0';
            $download_group['source']->description = '<p>Here are the links to all the source code Mineshafter Squared uses.<p><p>Feel free to use it however you like, just remember to credit us and don\'t take credit for work you did not do :)</p>';
            $download_group['source']->save();
            // other
            $download_group['other'] = new Downloadgroup();
            $download_group['other']->name = 'Other Links';
            $download_group['other']->version = 'Version depends on project.';
            $download_group['other']->description = '<p>Here are some links to other projects related to or using Mineshafter Squared.</p>';
            $download_group['other']->save();
            
            //================
            // Downloads
            //================
            Download::connection()->query('delete from downloads');
            // windows client
            $download = new Download();
            $download->name = 'Windows';
            $download->link = '/assets/downloads/Mineshafter Squared.exe';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['client']->id;
            $download->save();
            // mac client
            $download = new Download();
            $download->name = 'Mac OS X';
            $download->link = '/assets/downloads/Mineshafter Squared.zip';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['client']->id;
            $download->save();
            // linux client
            $download = new Download();
            $download->name = 'Linux / Other';
            $download->link = '/assets/downloads/Mineshafter Squared.jar';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['client']->id;
            $download->save();
            // java server
            $download = new Download();
            $download->name = 'Java Server';
            $download->link = '/assets/downloads/mineshafter_squared_server.jar';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['server']->id;
            $download->save();
            // proxy
            $download = new Download();
            $download->name = 'Client / Server Proxy';
            $download->link = 'https://github.com/KayoticSully/Mineshafter-Squared-Proxy';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['source']->id;
            $download->save();
            // auth
            $download = new Download();
            $download->name = 'Authentication Server';
            $download->link = 'https://github.com/KayoticSully/Mineshafter-Squared-Web';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['source']->id;
            $download->save();
            // tr0lit
            $download = new Download();
            $download->name = 'tr0lit\'s Launchers';
            $download->link = 'http://mineshafter.tr0l.it/';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['other']->id;
            $download->save();
            // Cowan
            $download = new Download();
            $download->name = 'Cowan\'s Login Fix (use with versions >= 3.8.3)';
            $download->link = '/assets/downloads/Login Fix.zip';
            $download->number_of_downloads = 0;
            $download->download_group_id = $download_group['other']->id;
            $download->save();
            
            //================
            // Tags
            //================
            Tag::connection()->query('delete from tags');
            $tag = new Tag();
            $tag->name = 'Public';
            $tag->color = 'important';
            $tag->save();
            
            //================
            // User Types
            //================
            Usertype::connection()->query('delete from usertypes');
            $user_type = new Usertype();
            $user_type->level = 0;
            $user_type->name = "Admin";
            $user_type->save();
            
            $user_type = new Usertype();
            $user_type->level = 10;
            $user_type->name = "User";
            $user_type->save();
            
            
        }
        catch(Exception $ex)
        {
            echo '<pre>';
            print_r($ex);
            echo '</pre>';
        }
    }
}