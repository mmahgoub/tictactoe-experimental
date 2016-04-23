<?php

/**
 * Games Shell
 *
 * @property Game $Game
 */
class ElemenateImpossibleShell extends AppShell {

    public $uses = array('Game');

    public function main() {
        
        $layouts = $this->Game->find('all');
        $layouts_deleted = 0;
        
        foreach ($layouts as $key => $data) {
            $x = 0;
            $o = 0;
            $this->Game->id = $data['Game']['id'];
            $x += $this->validate_lines(1, $data);
            $o += $this->validate_lines(2, $data);
            if($x > 10 || $o > 10){
                if($this->Game->delete()){
                    $layouts_deleted++;
                 //$this->out($data['Game']['id'].': [' . $data['Game']['b1'] . ', ' . $data['Game']['b2'] . ', ' . $data['Game']['b3'] . ', ' . $data['Game']['b4'] . ', ' . $data['Game']['b5'] . ', ' . $data['Game']['b6'] . ', ' . $data['Game']['b7'] . ', ' . $data['Game']['b8'] . ', ' . $data['Game']['b9'] . ']', 1);
                }
                
            }
            //illegale draw
            if($x == 10 && $o == 10){
                if($this->Game->delete()){
                    $layouts_deleted++;
                }
            }
            $this->overwrite('Layout deleted: '.$layouts_deleted,0);
            
        }

    }
    
    public function validate_lines($player ,$data) {
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
