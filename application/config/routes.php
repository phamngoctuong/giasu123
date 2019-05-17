<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved
| routes must come before any wildcard or regular expression routes.
|
*/
$route['default_controller'] = "site/site";
$route['logout'] = "site/logout";
//$route['/login']="site/loginuser";(/:num)?
$route['tim-lop-gia-su&gclid=(:any)']="site/ForTeacher";

$route['tim-gia-su&gclid=(:any)']="site/ForUsers";

$route['tim-lop-gia-su']="site/ForTeacher";
$route['tim-lop-gia-su&order=(:any)?(/:num)?']="site/ForTeacher/$1";
$route['tim-gia-su&order=(:any)?(/:num)?']="site/ForUsers/$1";
// $route['tim-lop-gia-su-(:any)-s(:num)c(:num).html(/:num)?']="site/listclassbyfilter/$1/$2/$3";
$route['tim-lop-gia-su-(:any)-s(:num)c(:num)r(:num).html(/:num)?']="site/listclassbyfilter/$1/$2/$3/$4";
$route['tim-lop-hoc']="site/tutorresultfind";
$route['tim-lop-hoc&key=(:any)&subject=(:num)&topic=(:num)&place=(:num)&type=(:num)&sex=(:num)&class=(:num)(/:num)?']="site/tutorresultfind/$1/$2/$3/$4/$5/$6/$7";
$route['lop-hoc/(:any)-(:num)']="site/DetailClass/$1/$2";
$route['tat-ca-lop-hoc']="site/AllTeacher";
$route['tim-gia-su']="site/ForUsers";
$route['gia-su-(:any)-s(:num)c(:num)r(:num).html(/:num)?']="site/listteacherbyfilter/$1/$2/$3/$4";
$route['giao-vien&key=(:any)?&subject=(:num)&topic=(:num)&place=(:num)&type=(:num)&sex=(:num)&order=(:any)(/:num)?']="site/tutorresultteacher/$1/$2/$3/$4/$5/$6/$7";
$route['(:any)-gv(:num)']="site/DetailTeacher/$1/$2";
$route['tat-ca-giao-vien']="site/TeacherAll";
$route['tat-ca-giao-vien&order=(:any)?(/:num)?']="site/TeacherAll/$1";
$route['dang-nhap-chung']="site/generallogin";
$route['dang-ky-chung']="site/generalregister";
$route['gia-su-dang-nhap']="site/teacherlogin";
$route['phu-huynh-dang-nhap']="site/userlogin";
$route['gia-su-lay-lai-mat-khau']="site/teacherforgot";
$route['tk-lay-lai-mat-khau']="site/usersforgot";
$route['lay-lai-mk-thanh-cong']="site/forgotsuccessall";
$route['lay-lai-mat-khau&u=(:any)']="site/ChangeNewPass/$1";
$route['dang-ky-nguoi-dung']="site/phuhuynhdangky";
$route['dang-ky-gia-su']="site/giasudangky";
$route['giao-vien-manager']="site/teacherloginmanager";
$route['mn-giao-vien-tim-lop-day']="site/mnteachsearchuv";
$route['mn-giao-vien-tim-lop-day-theo-mon']="site/mnteachsearchuvbysubject";
$route['mn-giao-vien-tim-lop-day-theo-tt']="site/mnteachsearchbyprovince";
$route['mm-giao-vien-thay-doi-mk']="site/mnteacherchangepass";
$route['mn-danh-sach-lop-de-nghi-day']="site/mnteachervsclass";
$route['mn-danh-sach-lop-moi-day']="site/mnclassvsteacher";
$route['mn-danh-sach-lop-da-day']="site/mnteachervsclassactive";
$route['mn-danh-sach-lop-da-luu']="site/mnteachersaveclass";
$route['mn-gia-su-cap-nhat-thong-tin']="site/mnteacherupdateinfo";
$route['mn-gia-su-nap-tien']="site/mnteacherrecharge";
$route['mn-gia-su-rut-tien']="site/mnteachercashout";
$route['mn-gia-su-qua-tang-km']="site/mnteacherbonus";


$route['phu-huynh-manager']="site/usersloginmanager";
$route['mn-hv-gia-su-da-luu']="site/mnusersteachersave";
$route['mn-hv-gia-su-moi-day']="site/mnusersinviteteacher";
$route['mn-hv-gia-su-phu-hop']="site/mnusersfitteacher";
$route['mn-hv-gia-su-de-nghi-day']="site/mnuserssuggestteacher";
$route['mn-hv-thay-doi-mk']="site/mnuserschangepass";
$route['mn-hv-cai-dat-ho-so']="site/mnuserssetup";
$route['mn-hv-thong-tin-ho-so']="site/mnusersinfomation";
$route['mn-hv-quan-ly-lop-hoc']="site/mnusersclassmanager";
$route['mn-hv-dang-tin(/:num)?']="site/mnuserscreateorupdateclass";
$route['mn-hv-nap-tien']="site/mnusersrecharge";
$route['mn-hv-rut-tien']="site/mnuserscashout";
$route['mn-hv-qua-tang-khuyen-mai']="site/mnusersbonus";


$route['mn-candi-manager']="site/candiloginmanager";
$route['mn-candi-updateinfo']="site/mncandiupdateinfo";
$route['mn-candi-changepass']="site/mncandichangepass";
$route['mn-candi-nap-tien']="site/mncandirecharge";
$route['mn-candi-rut-tien']="site/mncandicashout";
$route['mn-candi-qua-tang-km']="site/mncandibonus";
$route['mn-candi-viec-da-ung-tuyen']="site/mncandisugguestjobs";
$route['mg-candi-viec-da-luu']="site/mncandisavejobs";
$route['mn-company-manager']="site/companyloginmanager";
$route['mn-company-updateinfo']="site/mncompanyupdateinfo";
$route['mn-company-changepass']="site/mncompanychangepass";
$route['mn-company-nap-tien']="site/mncompanyrecharge";
$route['mn-company-rut-tien']="site/mncompanycashout";
$route['mn-company-qua-tang-km']="site/mncompanybonus";
$route['mn-company-ds-ung-tuyen']="site/mncompanycomfirmcandi";
$route['mn-company-ds-ung-vien-luu']="site/mncompanysavecandi";
$route['mn-company-manager-news']="site/companymanagernewsjobs";
$route['mn-company-addnew(/:num)?']="site/companyaddnewjobs";


$route['huong-dan-dang-nhap-gia-su']="site/supportteacherlogin";
$route['huong-dan-dang-ky-gia-su']="site/supportteacherregister";
$route['huong-dan-dang-ky-tk']="site/supportusersregister";
$route['huong-dan-dang-nhap-tk']="site/supportuserslogin";

//viec lam them
$route['tong-hop-viec-lam-them']="site/homejobparttime";
$route['tim-viec-lam-them']="site/resultsearchparttime";
$route['tim-viec-lam-them&key=(:any)?&c=(:num)&n=(:num)&t=(:num)(/:num)?']="site/resultsearchparttime/$1/$2/$3/$4";
// vi?c l�m fulltime
$route['viec-lam-full-time']="site/homejobfulltime";
$route['tim-viec-lam(/:num)?']="site/resultsearchjobfulltime";
$route['tim-viec-lam&keywork=(:any)?&n=(:num)&t=(:num)(/:num)?']="site/resultsearchjobfulltime/$1/$2/$3";
//old function
//viec-lam-kiem-toan-ke-toan-tai-ha-noi-c1p1.html
$route['nha-tuyen-dung&keywork=(:any)?&c=(:num)&n=(:num)&type=(:num)(/:num)?']="site/ListCompanyByFilter/$1/$2/$3/$4";
$route['dang-tin-tuyen-dung.html']="site/createjobfree";
$route['lien-he']="site/contactus";
//nha tuyen dung&
$route['cong-ty.html(/:num)?']="site/nhatuyendung/$1";
$route['nha-tuyen-dung-tai-(:any)-c(:num).html(/:num)?']="site/listcompanybyCity/$1/$2";
$route['nguoi-tim-viec.html(/:num)?']="site/ListCandidatebyfilter";
$route['tim-kiem-ung-vien(/:num)?']="site/ResultSearchCandi";
$route['tim-kiem-ung-vien&keywork=(:any)?&t=(:num)&n=(:num)(/:num)?']="site/ResultSearchCandi/$1/$2/$3";
$route['(:any)-job(:num).html']="site/detailjob/$1/$2";
$route['hoan-thien-ho-so.html']="site/hoanthienhoso";
//http://localhost/timviec1/cong-ty-tnhh-xd-hqkt-hung-thinh-viet-ntd84309.html
//http://localhost/timviec1/nhan-vien-phoi-mau-job360415.html
$route['(:any)-ntd(:num).html']="site/DetailCompany/$1/$2";
$route['ung-vien/(:any)-uv(:num).html']="site/DetailCandidate/$1/$2";
$route['dang-nhap-nha-tuyen-dung']="site/login";
$route['ung-vien-dang-nhap']="site/candidatelogin";
$route['dang-ky-ung-vien']="site/register";
$route['dang-ky-nha-tuyen-dung']="site/registernhatuyendung";
$route['kichhoattaikhoan&c=(:any)&u=(:any)(:/any)?']="site/confirmuser/$1/$2";
$route['/']="site/index";
$route['(:any)-b(:num).html'] = 'site/show_news/$1/$2';
$route['(:any).html(/:num)?']="site/show_cat_sub/$1";

//điều khoản và sử dụng
$route['gioi-thieu-chung']="site/gioithieuchung";
$route['thoa-thuan-su-dung']="site/thoathuansd";
$route['thong-tin-can-biet']="site/thongtincb";
$route['quy-trinh-giai-quyet-tranh-chap']="site/quytrinh_gttc";
$route['quy-trinh-bao-mat']="site/quytrinhbm";
/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
