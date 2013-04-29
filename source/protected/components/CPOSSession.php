<?php
class CPOSSession {
    private $_session;
    private $_array;
    private $_label;
    public function __construct($label='session'){
        $this->_label = $label;
        $this->_array = array();
        $this->_session = new CHttpSession;
        $this->update();
    }
    public function set($key,$value){
        $count = count($key);
        if(is_array($key)==true && $count>0){
            if($count==2){
               $this->_array[$key[0]][$key[1]] = $value;
            }
            else{
                $this->_array[$key[0]] = $value;
            }   
        }
        else{
            return null;
        }
        $this->update();
    }
    public function get($key=null){
        if(is_null($key)){
            return $this->_array;
        }
        $count = count($key);
        if(is_array($key)==true && $count>0){
            if($count==2){
               return $this->_array[$key[0]][$key[1]];
            }
            else{
                return $this->_array[$key[0]];
            }   
            
        }
        else{
            return null;
        }
    }
    public function clear(){
        $this->_array = array();
        $this->update();
    }
    private function update(){
        if(!isset($this->_session[$this->_label])){
            $this->_session->add($this->_label,$this->_array);   
        }
        else{
            $this->_session[$this->_label] = $this->_array;
        }
    }
}
?>