<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?

include("config.php");
$linklogo="http://www.careerlink.vn/image/bba7514e90d9c5be812cb2ffde00b78b?w=195&h=120";
$dir  = geturlimageAvatar(time());
            $name = generate_name($linklogo.".jpg.jpg");
            $luatweb=1;
            if($luatweb == 6)
            {
               file_put_contents($dir.$name, file_get_contents($linklogo.".jpg"));
            }
            else
            {
               file_put_contents($dir.$name, file_get_contents($linklogo));
            }
            //echo $dir.$name;
            //var_dump($dir,$name,$$linklogo);die();
            $resizeObjj = new resize($dir.$name);
            $resizeObjj -> resizeImage(177,130,'resize');
            $resizeObjj -> saveImage($dir.$name, 100);
            opz($dir.$name);
function opz($imagePath){     
   $checkValidImage = @getimagesize($imagePath);
   $type = strtolower(substr(strrchr($imagePath,"."),1));

   if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
   {     
       $type = strtolower($type);
       if($type=='png'){
           exec('optipng '.$imagePath);
           var_dump($imagePath);    
       }
       if($type=='jpg' or $type=='jpeg'){
           exec('jpegoptim '.$imagePath);
       }     
   }     
}
//$a=['a1'=>'T?t c? trình d?'];
//header("Content-Type:application/json;charset=utf-8");
//print json_encode($a);die();
//$linklogo="https://cdn.timviecnhanh.com/asset/home/img/employer/59a526b5ef753_1503995573_274x274.png";
//$url_to_image = 'https://cdn.timviecnhanh.com/asset/home/img/employer/59a526b5ef753_1503995573_274x274.png';
//
//$dir  = geturlimageAvatar(time());
//            $name = generate_name($linklogo.".jpg");
//             $image = file_get_contents($linklogo);
//file_put_contents('../pictures/'.$name.'.jpg', $image);
//
//            $luatweb=6;
//            if($luatweb == 6)
//            {
//               file_put_contents($dir.$name, file_get_contents($linklogo));
//            }
//            else
//            {
//               file_put_contents($dir.$name, file_get_contents($linklogo));
//            }
//           // echo $dir.$name;
//            //var_dump($dir,$name,$$linklogo);die();
//            $resizeObjj = new resize($dir.$name);
//            $resizeObjj -> resizeImage(177,130,'resize');
//            $resizeObjj -> saveImage($dir.$name, 100);
//            var_dump($dir.$name) ;die();
//            opz($dir.$name);
//function opz($imagePath){     
//   $checkValidImage = @getimagesize($imagePath);
//   $type = strtolower(substr(strrchr($imagePath,"."),1));
//
//   if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
//   {     
//       $type = strtolower($type);
//       if($type=='png'){
//           exec('optipng '.$imagePath);
//           var_dump($imagePath);    
//       }
//       if($type=='jpg' or $type=='jpeg'){
//           exec('jpegoptim '.$imagePath);
//       }     
//   }     
//}
//header("content-type:application/json;charset=utf-8");
//echo json_encode(array("abc"=>'5 nam tr? lên'),JSON_UNESCAPED_UNICODE);
//$link='https://www.timviecnhanh.com/tuyen-nhan-vien-ho-tro-thong-tin-toi-khach-hang-truyen-hinh-vtvcab-hn9-ha-noi-4217604.html';
//$b=file_get_contents('https://www.timviecnhanh.com/tuyen-nhan-vien-ho-tro-thong-tin-toi-khach-hang-truyen-hinh-vtvcab-hn9-ha-noi-4217604.html',false,null,-1);
//var_dump($b)    ;die(); 
//require_once '../functions/function_banthe.php';
//$result=GetCards("VTT:10000:1","0f87d4ee-368c-4891-9245-d667b2807646");
//var_dump("123123");die();
//require_once '../functions/function_banthe.php';
//$arr=Decrypt("BMEymdHUrIgB1PfoZyQOAB5b0CoY53AZ3Apa","1kdrmVuQEY5PUKxZr76KNg==");//Decrypt('72a13155-818c-4cac-9687-47d72b2c3348','');
//$arr=json_decode('{"errorCode": 0,"message": "Thành công!","Data": "[{\"Telco\":\"VNP\",\"Serial\":\"36274900076441\",\"PinCode\":\"1kdrmVuQEY5PUKxZr76KNg==\",\"Amount\":10000,\"Trace\":\"822540\"}]"}',true);
//var_dump($arr);die();
//$url='https://www.googleapis.com/oauth2/v3/tokeninfo?access_token='.'ya29.GlvmBTgcvDTenUJlUPoEd6qhkqLYxf92yBr0JuWAZeS50vyGcjE6X3PcgxH8FH7ERU-EUYN6xchGAITvA2SdzU2ppQLb4gONKKN1qJfTATJBBjn3CQ6X3tdPHwD7';
//$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_VERBOSE, 1);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//		curl_setopt($ch, CURLOPT_POST, 1);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, "");
//		$result = curl_exec($ch);
        //var_dump($result);die(); 
//        if(!empty($result)){
//            $result=json_decode($result,true);
            //var_dump($result);die();
//            if(count($result)==1 ){
                //var_dum($result);die();
//            }else{
//                var_dump($result['email'],$result['email_verified'],$result['access_type']);die(); 
 ///           }
 //       }else{
 //           var_dump($result);die(); 
 //       }

         //curl_setopt($s,CURLOPT_COOKIEJAR,$this->_cookieFileLocation); 
         //curl_setopt($s,CURLOPT_COOKIEFILE,$this->_cookieFileLocation); 

         //if($this->authentication == 1){ 
//           curl_setopt($s, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass); 
//         } 
//         if($this->_post) 
//         { 
//             curl_setopt($s,CURLOPT_POST,true); 
//             curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields); 
//
//         } 
//
//         if($this->_includeHeader) 
//         { 
//               curl_setopt($s,CURLOPT_HEADER,true); 
//         } 
//
//         if($this->_noBody) 
//         { 
//             curl_setopt($s,CURLOPT_NOBODY,true); 
//         } 
         /* 
         if($this->_binary) 
         { 
             curl_setopt($s,CURLOPT_BINARYTRANSFER,true); 
         } 
         */ 
         //curl_setopt($s,CURLOPT_USERAGENT,$this->_useragent); 
         //curl_setopt($s,CURLOPT_REFERER,$this->_referer); 

         //{ "azp": "1049266294465-dje6sdla5hm55ujqd0bgsiocmfdpmm4i.apps.googleusercontent.com", "aud": "1049266294465-dje6sdla5hm55ujqd0bgsiocmfdpmm4i.apps.googleusercontent.com", "sub": "105192304153958530009", "scope": "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email", "exp": "1529980677", "expires_in": "2753", "email": "hunghaair@gmail.com", "email_verified": "true", "access_type": "online" }
         
//echo json_encode(addvnpayment("NCB","0913081236",10000,"trantronglong87@gmail.com",$vnp_TmnCode,$vnp_Url,$vnp_HashSecret,$vnp_Returnurl));
//require_once '../functions/FunctionAPI.php';
//require_once '../classes/IOClass/service.php';
//require_once '../classes/IOClass/IOServices.php';
//$key="a";
//var_dump(intval($key));die();
//$io1=new IOServices();
//$result= $io1->TopupMobile("VP","0913081236","10000",true,);
//var_dump($result);die();
//$iomedia = new ioneMedia();
//$Trace=rand(10000000,99999999);
//$clientDateTime=date("YmdHis",time());
//$parrams=array('partnerCode'=>'','partnerTransId'=>$Trace,'telcoCode'=>'VP','mobileType'=>'TT','mobileNo'=>'0913081236','topupAmount'=>'10000','clientDateTime'=>$clientDateTime);

//$result= json_decode('{"resCode":"00","partnerTransId":"15496913","partnerCode":"paycard365_AirtimeIV","telcoCode":"VP","mobileType":"TT","mobileNo":"0913081236","topupAmount":"10000","discountValue":"560","debitValue":"9440","clientDateTime":"20180621100225","serverDateTime":"20180621100226","description":"SUCCESS","sign":"Q4SLT6c53XQcQk9hW4wHEgBdz1T1vX7NNlCovpViPA\/RiJ2OOdyIn6F8Mhd8UXKnO+HBYDI9g8tr\r\n3lNzAQqEUguBmCFGaYX7HBH7aIFiGfhPEsMNHy8mYfbm57JtpXkoLp2WmKRo4tdj1\/chzXLdKEih\r\nvK8qxGaHrsDSfSdLi\/s=","message":"Th\u00e0nh c\u00f4ng","verify":false}',true);
//{"resCode":"00","partnerTransId":"15496913","partnerCode":"paycard365_AirtimeIV","telcoCode":"VP","mobileType":"TT","mobileNo":"0913081236","topupAmount":"10000","discountValue":"560","debitValue":"9440","clientDateTime":"20180621100225","serverDateTime":"20180621100226","description":"SUCCESS","sign":"Q4SLT6c53XQcQk9hW4wHEgBdz1T1vX7NNlCovpViPA\/RiJ2OOdyIn6F8Mhd8UXKnO+HBYDI9g8tr\r\n3lNzAQqEUguBmCFGaYX7HBH7aIFiGfhPEsMNHy8mYfbm57JtpXkoLp2WmKRo4tdj1\/chzXLdKEih\r\nvK8qxGaHrsDSfSdLi\/s=","message":"Th\u00e0nh c\u00f4ng","verify":false}
//var_dump($result);die();
//require_once '../functions/FunctionTopup.php';
//require_once '../classes/IOClass/service.php';
//$iomedia = new ioneMedia();
//$Trace=rand(10000000,99999999);
//$clientDateTime=date("YmdHis",time());
//$parrams=array('partnerCode'=>'','partnerTransId'=>$Trace,'telcoCode'=>'VT','mobileType'=>'TT','mobileNo'=>'0913081236','topupAmount'=>'10000','clientDateTime'=>$clientDateTime);
//$result=APIUserTopupMobile("f888877e-49e0-4715-b666-293ba5442388","0913081236:10000:TT");//$iomedia->directTopup($parrams);
//
//var_dump($result);die();
//$data=updateuserinfo("U4926513","trantronglong87@gmail.com");//updateuserinfoNotConfirm(5506,"711a017894951213","TRAN TRONG LONG","Agribank","HOAN KIEM","TRAN TRONG LONG","Ha noi","09130812361");
//echo json_encode($data)
//TransferType: 1
//TransferBank: Vietcombank
//CustomerName: tran trong long
//CustomerBN: 123123123
//ReceiveBank: 1
//TransferDateStr: 15.06.2018
//Amount: 1
//ToBankCode: 1
//ToBankNumber: 4
//$data=BuyCardaddvnpayment("NCB",1,'trantronglong87@gmail.com',10000,1,"HUNGHA01","http://sandbox.vnpayment.vn/paymentv2/vpcpay.html","KEWSNQRGEZCBXMDDTQLLBXMKGVYUMVOM","http://localhost:8999/thong-bao");//UserCreateCashOut(5506,"longtt123",50000,"longtt");//AddCashOutLogToServerNusoap(50000,156770,"TRAN TRONG LONG1","HOAN KIEN","0913081236","711a017894951213","Agribank","Agribank","2018-06-15 21:42:58",5506,0,1,62000,1,"620180615214258964","trantronglong87@gmail.com");//UserCreateCashOut(5506,"longtt123",50000,"longtt");//UserPayMentUnCode(5506,4,'50000',"trantronglong87@gmail.com","tran trong long");
//echo json_encode($data);
//$data=str_replace('xmlns="url"','',$data);
//$simple_result=simplexml_load_string($data);
//$json_result=json_encode($simple_result);
//$json_result=json_decode($json_result,true);
//echo $json_result;

    
//require_once '../functions/FunctionTopup.php';
//if(isset($_SESSION['UserInfo']))
//{
//    $result=array("Success"=>false,"message"=>"l?i giao d?ch");
//    
//    $resulttopup=paymenttopuphaslogin("0913081236","10000","a@gmail.com","longtt123");
//    
//    if(isset($resulttopup)){
//        //array('errorCode'=>278,'listCards'=>'','message'=>'không t?n t?i ngu?i dùng','transaction'=>$transaction);
//         if($resulttopup['errorCode']==0){
//            $result=array("Success"=>true,"message"=>$resulttopup['message']);
//        }else{
//            $result=array("Success"=>false,"message"=>$resulttopup['message']);
//        }
//    }
//    echo json_encode($result);
//}
//echo SendNapTienDienThoai('trantronglong87@gmail.com','abc','123123','10000');

        //echo $key123;
        //$this->privateKeyBase = base64_encode($privatekey);
        
        
//function encryptOrDecrypt($mprhase, $crypt) {
//     $MASTERKEY = "KEY PHRASE!";
//     $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//     $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//     mcrypt_generic_init($td, $MASTERKEY, $iv);
//     if ($crypt == 'encrypt')
//     {
//         $return_value = base64_encode(mcrypt_generic($td, $mprhase));
//     }
//     else
//     {
//         $return_value = mdecrypt_generic($td, base64_decode($mprhase));
//     }
//     mcrypt_generic_deinit($td);
//     mcrypt_module_close($td);
//     return $return_value;
//} 
//$array = "";
//echo json_decode("DXRE0kkRCRmk+CgB0gJJqh4Yw+ofOyfL",true);
//require_once '../ajax/login.php';

//echo SendNapTienDienThoai('trantronglong87@gmail.com','abc','123123','10000');

        //echo $key123;
        //$this->privateKeyBase = base64_encode($privatekey);
        
        
//function encryptOrDecrypt($mprhase, $crypt) {
//     $MASTERKEY = "KEY PHRASE!";
//     $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//     $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//     mcrypt_generic_init($td, $MASTERKEY, $iv);
//     if ($crypt == 'encrypt')
//     {
//         $return_value = base64_encode(mcrypt_generic($td, $mprhase));
//     }
//     else
//     {
//         $return_value = mdecrypt_generic($td, base64_decode($mprhase));
//     }
//     mcrypt_generic_deinit($td);
//     mcrypt_module_close($td);
//     return $return_value;
//} 
//$array = "";
//echo json_decode("DXRE0kkRCRmk+CgB0gJJqh4Yw+ofOyfL",true);
?>