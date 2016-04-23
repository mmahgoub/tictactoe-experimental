<?php

/**
 * Games Shell
 *
 * @property Game $Game
 */
class FindWinnersShell extends AppShell {

    public $uses = array('Game');

    public function main() {
        
        $layouts = $this->Game->find('all');
        $layouts_deleted = 0;
        
        foreach ($layouts as $key => $data) {
            $this->Game->id = $data['Game']['id'];
            $x = $this->calc(1, $data);
            $o = $this->calc(2, $data);
            $this->overwrite($data['Game']['id'].': [' . $data['Game']['b1'] . ', ' . $data['Game']['b2'] . ', ' . $data['Game']['b3'] . ', ' . $data['Game']['b4'] . ', ' . $data['Game']['b5'] . ', ' . $data['Game']['b6'] . ', ' . $data['Game']['b7'] . ', ' . $data['Game']['b8'] . ', ' . $data['Game']['b9'] . ']', 0);
            if($x == 10){
                $this->Game->saveField('winner', 1);
                $this->out(' -> X wins!');
            }
            if($o == 10){
                $this->Game->saveField('winner', 2);
                $this->out(' -> O wins!');
            }
            $unfilled = 0;
            for ($index = 1; $index < 10; $index++) {
                if($data['Game']['b'.$index] == 0){
                    $unfilled++;
                }
            }
            if($unfilled == 0 && $o != 10 && $x != 10){
                $this->out(' -> DRAW!');
                $this->Game->saveField('winner', -1);
            }

        }

    }
    
    public function calc($player ,$data) {
        $score = 0;
        if($data['Game']['b1'] == $player && $data['Game']['b2'] == $player && $data['Game']['b3'] == $player){
            $score += 10;
        }
        if($data['Game']['b4'] == $player && $data['Game']['b5'] == $player && $data['Game']['b6'] == $player){
            $score += 10;
        }
        if($data['Game']['b7'] == $player && $data['Game']['b8'] == $player && $data['Game']['b9'] == $player){
            $score += 10;
        }
        if($data['Game']['b1'] == $player && $data['Game']['b4'] == $player && $data['Game']['b7'] == $player){
            $score += 10;
        }
        if($data['Game']['b2'] == $player && $data['Game']['b5'] == $player && $data['Game']['b8'] == $player){
            $score += 10;
        }
        if($data['Game']['b3'] == $player && $data['Game']['b6'] == $player && $data['Game']['b9'] == $player){
            $score += 10;
        }
        if($data['Game']['b1'] == $player && $data['Game']['b5'] == $player && $data['Game']['b9'] == $player){
            $score += 10;
        }
        if($data['Game']['b3'] == $player && $data['Game']['b5'] == $player && $data['Game']['b7'] == $player){
            $score += 10;
        }
        return $score;
    }

    

}
