<?php

/**
 * Games Shell
 *
 * @property Game $Game
 */
class ValidateShell extends AppShell {

    public $uses = array('Game');

    public function main() {
        
        $layouts = $this->Game->find('all');
        $layouts_deleted = 0;
        
        foreach ($layouts as $key => $data) {
             $this->Game->id = $data['Game']['id'];
            $x = $this->calc(1, $data);
            $o = $this->calc(2, $data);
            if($x != $o+1){
                    $this->overwrite($data['Game']['id'].': [' . $data['Game']['b1'] . ', ' . $data['Game']['b2'] . ', ' . $data['Game']['b3'] . ', ' . $data['Game']['b4'] . ', ' . $data['Game']['b5'] . ', ' . $data['Game']['b6'] . ', ' . $data['Game']['b7'] . ', ' . $data['Game']['b8'] . ', ' . $data['Game']['b9'] . ']', 0);
                    if($this->Game->delete()){
                        $layouts_deleted++;
                    }
                
            }else{

            }
            $this->overwrite('Layout deleted: '.$layouts_deleted,0);
        }

    }
    
    public function calc($player ,$data) {
        $score = 0;
        for ($index = 1; $index < 10; $index++) {
            if($data['Game']['b'.$index] == $player){
                $score++;
            }
        }
        return $score;
    }

    

}
