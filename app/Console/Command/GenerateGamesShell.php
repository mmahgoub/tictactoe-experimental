<?php

/**
 * Games Shell
 *
 * @property Game $Game
 */
class GenerateGamesShell extends AppShell {

    public $uses = array('Game');
    public $board = array(0, 1, 2, 3, 4, 5, 6, 7, 8);

    public function main() {
        
        $c = 0;
        while ($c < 262144){
            $data = array();
            (bool) $valid = ($c & 3) < 3;
            (bool) $valid &= (($c >>  2) & 3) < 3;
            (bool) $valid &= (($c >>  4) & 3) < 3;
            (bool) $valid &= (($c >>  6) & 3) < 3;
            (bool) $valid &= (($c >>  8) & 3) < 3;
            (bool) $valid &= (($c >> 10) & 3) < 3;
            (bool) $valid &= (($c >> 12) & 3) < 3;
            (bool) $valid &= (($c >> 14) & 3) < 3;
            (bool) $valid &= (($c >> 16) & 3) < 3;
            
            if ($valid){
                
                $i = $c;
                $j = 1;
                while ($j < 10){
                    $data['Game']['b'.$j] = $i & 3;
                    $i >>= 2;
                    $j++;
                    
                }
                $this->add($data);
                unset($data);
                //cout << endl;
            }

            $c++;
        }
        //$this->add($data);
        
        
    }

    public function add($data) {
        $this->Game->create();
        if ($this->Game->save($data)) {
            $this->out($this->Game->id.': [' . $data['Game']['b1'] . ', ' . $data['Game']['b2'] . ', ' . $data['Game']['b3'] . ', ' . $data['Game']['b4'] . ', ' . $data['Game']['b5'] . ', ' . $data['Game']['b6'] . ', ' . $data['Game']['b7'] . ', ' . $data['Game']['b8'] . ', ' . $data['Game']['b9'] . ']');
        }
    }

}
