<?php

/**
 * Games Shell
 *
 * @property Game $Game
 */
class CalcScoresShell extends AppShell {

    public $uses = array('Game');

    public function main() {
        
        $layouts = $this->Game->find('all');
        foreach ($layouts as $key => $data) {
            $this->Game->id = $data['Game']['id'];
            $this->out($data['Game']['id'].': [' . $data['Game']['b1'] . ', ' . $data['Game']['b2'] . ', ' . $data['Game']['b3'] . ', ' . $data['Game']['b4'] . ', ' . $data['Game']['b5'] . ', ' . $data['Game']['b6'] . ', ' . $data['Game']['b7'] . ', ' . $data['Game']['b8'] . ', ' . $data['Game']['b9'] . ']');
            $x = $this->calc(1, $data);
            $o = $this->calc(2, $data);
            if($this->Game->saveField('xscore', $x)){
               $this->Game->saveField('oscore', $o);
            }
            $this->out('Player X: '.$x); 
            $this->out('Player O: '.$o); 
            $this->out('', 1);
        }
        
    }

    public function calc($player, $data = array()) {
        $score = $this->calc_section_1($player, array(
            $data['Game']['b1'],
            $data['Game']['b2'],
            $data['Game']['b5'],
            $data['Game']['b4'],
        ));
        $score += $this->calc_section_2($player, array(
            $data['Game']['b3'],
            $data['Game']['b6'],
        ));
        $score += $this->calc_section_3($player, array(
            $data['Game']['b9'],
            $data['Game']['b8'],
            $data['Game']['b7'],
        ));
        return $score;
    }
    
    public function calc_section_1($player, $cells = array()) {
        $score = 0;
        switch ($cells[0]) {
            case $player:
                $score++;
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        switch ($cells[1]) {
            case $player:
                $score++;
                if($cells[0] == $player){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        switch ($cells[2]) {
            case $player:
                $score++;
                if($cells[1] == $player){
                    $score += 10;
                }
                if($cells[0] == $player){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        switch ($cells[3]) {
            case $player:
                $score++;
                if($cells[0] == $player){
                    $score += 10;
                }
                if($cells[2] == $player){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        return $score;
    }
    
    public function calc_section_2($player, $cells = array()) {
        $score = 0;
        switch ($cells[0]) {
            case $player:
                $score++;
                if($cells[0] == $cells[1]){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        
    }
    public function calc_section_3($player, $cells = array()) {
        $score = 0;
        switch ($cells[0]) {
            case $player:
                $score++;
                if($cells[0] == $cells[1]){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        switch ($cells[2]) {
            case $player:
                $score++;
                if($cells[2] == $cells[1]){
                    $score += 10;
                }
                break;
            case $this->opponent($player):
                $score--;
                break;
            default:
                break;
        }
        
    }
    public function opponent($player) {
        if($player == 1){
            return 2;
        }
        if($player == 2){
            return 1;
        }
    }
    

}
