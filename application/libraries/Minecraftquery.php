<?php
class minecraftQueryException extends Exception
{
    // Exception thrown by MinecraftQuery class
}

class Minecraftquery
{
    /*
     * Originally written by xPaw
     * Modifications and additions by ivkos
     * Codeigniter Compatibility by KayoticSully
     *
     * GitHub: https://github.com/ivkos/Minecraft-Query-for-PHP
     */
    
    const STATISTIC = 0x00;
    const HANDSHAKE = 0x09;
    
    private $socket;
    private $players;
    private $info;
    private $online;
    private $latencyStart;
    private $latencyEnd;
    
    public function connect($IP, $port = 25565, $timeout = 3)
    {
        if (!is_int($timeout) || $timeout < 0) {
            throw new InvalidArgumentException('Timeout must be an integer.');
        }
        
        $this->latencyStart = microtime(true);
        
        $this->socket = @fsockopen('udp://' . $IP, (int) $port, $errNo, $errStr, $timeout);
        
        if ($errNo || $this->socket === false) {
            throw new minecraftQueryException('Could not create socket: ' . $errStr);
        }
        
        stream_set_timeout($this->socket, $timeout);
        stream_set_blocking($this->socket, true);
        
        try {
            $challenge = $this->getChallenge();
            
            $this->getStatus($challenge);
            $this->online = true;
        }
        // We catch this because we want to close the socket, not very elegant
        catch (minecraftQueryException $e) {
            fclose($this->socket);
            $this->online = false;
            
            throw new minecraftQueryException($e->getMessage());
        }
        
        fclose($this->socket);
    }
    
    public function getInfo()
    {
        return isset($this->info) ? $this->info : false;
    }
    
    // Kept for compatibility reasons
    public function getPlayers()
    {
        return isset($this->players) ? $this->players : false;
    }

    // Alias to getPlayers(). Better represents what the function really does.
    public function getPlayerList()
    {
        return isset($this->players) ? $this->players : false;
    }

    // Added for convenience
    public function isOnline()
    {
        return isset($this->online) ? $this->online : false;
    }
    
    private function getChallenge()
    {
        $data = $this->writeData(self::HANDSHAKE);
        
        if ($data === false) {
            throw new minecraftQueryException("Failed to receive challenge.");
        }
        
        return pack('N', $data);
    }
    
    private function getStatus($challenge)
    {
        $data = $this->writeData(self::STATISTIC, $challenge . pack('c*', 0x00, 0x00, 0x00, 0x00));
        
        if (!$data) {
            throw new minecraftQueryException("Failed to receive status.");
        }
        
        $last = "";
        $info = array();
        
        $data    = substr($data, 11); // splitnum + 2 int
        $data    = explode("\x00\x00\x01player_\x00\x00", $data);
        $players = substr($data[1], 0, -2);
        $data    = explode("\x00", $data[0]);
        
        // Array with known keys in order to validate the result
        // It can happen that server sends custom strings containing bad things (who can know!)
        $keys = array(
            'hostname'   => 'HostName',
            'gametype'   => 'GameType',
            'version'    => 'Version',
            'plugins'    => 'Plugins',
            'map'        => 'Map',
            'numplayers' => 'Players',
            'maxplayers' => 'MaxPlayers',
            'hostport'   => 'HostPort',
            'hostip'     => 'HostIp'
        );
        
        foreach ($data as $key => $value) {
            if (~$key & 1) {
                if (!array_key_exists($value, $keys)) {
                    $last = false;
                    continue;
                }
                
                $last        = $keys[$value];
                $info[$last] = "";
            } else if ($last != false) {
                $info[$last] = $value;
            }
        }
        
        // Ints
        $info['Players']    = intval($info['Players']);
        $info['MaxPlayers'] = intval($info['MaxPlayers']);
        $info['HostPort']   = intval($info['HostPort']);
        
        // Parse "plugins", if any
        if ($info['Plugins']) {
            $data = explode(": ", $info['Plugins'], 2);
            
            $info['RawPlugins'] = $info['Plugins'];
            $info['Software']   = $data[0];
            
            if (count($data) == 2) {
                $info['Plugins'] = explode("; ", $data[1]);
            }
        } else {
            $info['Software'] = 'Vanilla';
        }
        
        // (float) Returns approximate server latency in milliseconds
        $this->latencyEnd = microtime(true);
        $info['Latency'] = round(($this->latencyEnd - $this->latencyStart) * 1000, 2);
        
        $this->info = $info;
        
        if ($players) {
            $this->players = explode("\x00", $players);
        }
    }
    
    private function writeData($command, $append = "")
    {
        $command = pack('c*', 0xFE, 0xFD, $command, 0x01, 0x02, 0x03, 0x04) . $append;
        $length  = strlen($command);
        
        if ($length !== fwrite($this->socket, $command, $length)) {
            throw new minecraftQueryException("Failed to write on socket.");
        }
        
        $data = fread($this->socket, 2048);
        
        if ($data === false) {
            throw new minecraftQueryException("Failed to read from socket.");
        }
        
        if (strlen($data) < 5 || $data[0] != $command[2]) {
            return false;
        }
        
        return substr($data, 5);
    }
}