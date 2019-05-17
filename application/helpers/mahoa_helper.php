<?php 

/** 
 * Class Name: KZ_Crypt 
 * Author: Killer 
**/ 

class KZ_Crypt { 

    public $_text = ''; 
     
    //Chìa khoá để mở kho báu ^^ 
    public $_key = 'f_pk_ZingTV_1_@z'; 
    public $_iv = 'f_iv_ZingTV_1_@z'; 
     
    //Kết quả trả về 
    public $_result = ''; 
     
    /** 
     * Hàm mã hoá 
    **/ 
    public function _encrypt(){ 
        if($this->_text != ''){ 
            $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, ''); 
            $iv_size = mcrypt_enc_get_iv_size($cipher); 
            if (mcrypt_generic_init($cipher, $this->_key, $this->_iv) != -1){ 
                $cipherText = mcrypt_generic($cipher,$this->_text); 
                mcrypt_generic_deinit($cipher); 
                $this->_result = bin2hex($cipherText); 
                return true; 
            } 
        }else{ 
            return false; 
        } 
    } 
     
    /** 
     * Hàm giải mã 
    **/ 
    public function _decrypt(){ 
        if($this->_text != ''){ 
            $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, ''); 
            $iv_size = mcrypt_enc_get_iv_size($cipher); 
            if(mcrypt_generic_init($cipher, $this->_key, $this->_iv) != -1){ 
                $cipherText = mdecrypt_generic($cipher,$this->_hexToString($this->_text)); 
                mcrypt_generic_deinit($cipher); 
                $this->_result = $cipherText; 
                return true; 
            }else{ 
                return false; 
            } 
        } 
    } 
     
    /** 
     * Hàm chuyển đổi từ mã hex sang chuỗi. 
    **/ 
    protected function _hexToString($hex){ 
        if(!is_string($hex)){ 
            return null; 
        } 
        $char = ''; 
        for($i=0; $i<strlen($hex);$i+=2){ 
            $char .= chr(hexdec($hex{$i}.$hex{($i+1)})); 
        } 
        return $char; 
    } 
}
?>