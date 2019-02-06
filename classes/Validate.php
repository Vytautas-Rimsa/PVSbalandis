<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value)){
                    $this->addError("Neįvesti duomenys <b>{$item}</b> laukelyje");
                } elseif(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("<b>{$item}</b> turi būti mažiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("<b>{$item}</b> turi būti daugiausiai <b>{$rule_value}</b> raidžių ilgio");
                            }
                        break;

                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("<b>{$rule_value}</b> turi sutapti su <b>{$item}</b>");
                            }
                        break;

                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("<b>{$item}</b> - toks el. paštas jau yra įvestas sistemoje");
                            }
                        break;

                        case 'oneNumber':
                            if($rule === 'oneNumber' && !preg_match("/\d/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent vienas skaičius");
                            }
                        break;

                        case 'oneBigLetter':
                            if($rule === 'oneBigLetter' && !preg_match("/[A-Z]/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent viena didžioji raidė");
                            }
                        break;

                        case 'oneSmallLetter':
                            if($rule === 'oneSmallLetter' && !preg_match("/[a-z]/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent viena mažoji raidė");
                            }
                        break;

                        case 'oneSpecialSymbol':
                            if($rule === 'oneSpecialSymbol' && !preg_match("/\W/", $value)){
                                $this->addError("Slaptažodyje privalo būti bent vienas specialusis simbolis");
                            }
                        break;

                        case 'noSpaces':
                            if($rule === 'noSpaces' && preg_match("/\s/", $value)){
                                $this->addError("Slaptažodyje negali būti įterptų  tuščių tarpų");
                            }
                        break;
                    }
                }          
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }


}