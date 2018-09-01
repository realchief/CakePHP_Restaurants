<?php
/**
 * Created by PhpStorm.
 * User: Sundar.S
 * Date: 29-12-2017
 * Time: 19:22
 */
namespace App\Controller\Restaurantadmin;

use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
use Cake\Mailer\Email;


class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('restaurant');
        $this->loadComponent('Flash');
        $this->loadComponent('Common');

        $this->loadModel('Users');
        $this->loadModel('Restaurants');  
        $this->loadModel('Orders');
        $this->loadModel('Notifications');
    }
//-----------------------------------------------------------------------------------
    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'login',
            'forgotPassword'
        ]);
    }
#--------------------------------------------------------------------------------------------
    //Restaturantadmin login 
    public function login() {

        if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 1) {
            $this->Flash->success('Please logout Admin panel');
            return $this->redirect(ADMIN_BASE_URL);
        }else if (!empty($this->Auth->user()) && $this->Auth->user('role_id') === 3) {
            $this->Flash->success('Please logout frontend');
            return $this->redirect(BASE_URL);
        }

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout'
            ]
        ]);


        if(!empty($this->Auth->user())){
            if($this->Auth->redirectUrl() == '/') {
                return $this->redirect(REST_BASE_URL.'dashboard');
            }else {
                return $this->redirect($this->Auth->redirectUrl());
            }

        }else if($this->request->is('post')){
            $user = $this->Auth->identify();
            //echo "<pre>"; print_r($user); die();
            if(!empty($user) && ($user['role_id'] == 2)){
                $this->Auth->setUser($user);

                if($this->Auth->redirectUrl() == '/') {
                    return $this->redirect(REST_BASE_URL.'dashboard');
                }else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }else{
                $this->Flash->error('Invalid username or password, try again');
            }
        }
    }#login funtion end...
#--------------------------------------------------------------------------------------------
    //Foodadmin getlocation
    public function getLocation() {

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['country'] = $ip_data->geoplugin_countryCode;
            $result['city'] = $ip_data->geoplugin_city;
        }
        if(!empty($result)) {
            echo $result['country'];die();
        }else {
            echo 'IND';die();
        }

    }#getlocation function end...
#---------------------------------------------------------------------------------------------
    //Restaurantadmin dashboard 
    public function dashboard() {

        $user = $this->Auth->user();     
        $restDetails = $this->Restaurants->find('all', [
               'fields' =>[
                   'id'
               ],
               'conditions' => [
                   'user_id' => $user['id']
               ]
        ])->hydrate(false)->first();
        $resId  = $restDetails['id'];        

        $orderList = $this->Orders->find('all',[
            'fields' => [
                'Orders.order_grand_total'
            ],
            'conditions' => [
                'Orders.restaurant_id' => $resId,
                'Orders.status' => 'Delivered'
            ]
        ])->hydrate(false)->toArray();

        $deliveredCount = count($orderList); 
        $salesPrice = 0;
        foreach ($orderList as $key => $value) {
            $salesPrice = $salesPrice + $value['order_grand_total'];
        }        
        
        $no_customers = $this->Orders->find('all',[
            'conditions' => [
                'Orders.restaurant_id' => $resId,               
            ],
            'contain' => [
                'Users' 
            ],
            'group' =>[
                'Users.id'
            ]
        ])->count();   

        $no_orders = $this->Orders->find('all',[            
            'conditions' => [
                'Orders.restaurant_id' => $resId,                
            ]
        ])->count();  

        $this->set(compact('deliveredCount', 'salesPrice', 'no_orders', 'no_customers'));        
    }
//-----------------------------------------------------------------------------------
    /*Change Password */
    public function changepassword() {

        if($this->request->is('post')) {

             if($this->request->getData('oldPassword') != '' &&
                $this->request->getData('newPassword') != '' && 
                $this->request->getData('confirmPassword') != '') {

                $oldPassword = $this->request->getData('oldPassword');
                $newPassword = $this->request->getData('newPassword');
                $confirmPassword = $this->request->getData('confirmPassword');

                $id =  $this->Auth->user('id');
                $userDet = $this->Users->get($id);
                $password = $userDet['password'];

                if($newPassword != $confirmPassword){
                    $this->Flash->error(__('New password and confirm password mismatch'));
                    return $this->redirect(REST_BASE_URL.'changepassword');
                }else if((new DefaultPasswordHasher())->check($oldPassword, $password)){
                    $custEntity = $this->Users->newEntity();
                    $userDetails = [
                        'id' => $this->Auth->user('id'),
                        'password' => $newPassword
                    ];
                    $custPatch = $this->Users->patchEntity($custEntity,$userDetails);
                    $saveCust = $this->Users->save($custPatch);
                    if($saveCust) {
                        $this->Flash->success(__('Password updated successfully'));
                        $this->Auth->logout();
                        return $this->redirect(REST_BASE_URL.'changepassword');
                    }                    
                }else{                   
                    $this->Flash->error(__('Current password mismatched'));
                    return $this->redirect(REST_BASE_URL.'changepassword');                  
                }                  

            }else {
                $this->Flash->error('Error occured');
                return $this->redirect(REST_BASE_URL.'changepassword');
            }
        }
    }
//-----------------------------------------------------------------------------------
    /*Forgot Password*/
    public function forgotPassword(){

        if($this->request->is(['post','put'])) {
            if(!empty($this->request->getData('username'))){

                $userData = $this->Users->find('all', [
                    'conditions' =>[
                        'username' => $this->request->getData('username'),
                        'status' => 1,
                        'deleted_status' => 'N',
                        'role_id' => 2
                    ]
                ])->first();

                if(!empty($userData)){

                    $newRegisteration = $this->Notifications->find('all',[
                        'conditions'=>[
                            'title' => 'Reset password'
                        ]
                    ])->hydrate(false)->first();

                    if($newRegisteration){

                        $forgetpasswordContent = $newRegisteration['content'];
                        $forgetpasswordsubject = $newRegisteration['subject'];
                    }

                    $mailContent = $forgetpasswordContent;
                    $title 	 = 'logo.png';
                    $adminName  = $this->siteSettings['site_name'];


                    $toemail      = $this->request->getData('username');
                    $customerName = 'Restaurant Owner';
                    $site_url     = BASE_URL;
                    $source       = BASE_URL.'images/logo-home.png';
                    $adminEmail   = $this->siteSettings['admin_email'];
                    $siteName     = $this->siteSettings['site_name'];
                    $tmpPassword  = $this->Common->passwordGenerator(7);

                    $userID      = $userData['id'];
                    $siteUrl = BASE_URL.'restaurantadmin';
                    $mailContent = str_replace("{firstname}", $customerName, $mailContent);
                    $mailContent = str_replace("{source}", $source, $mailContent);
                    $mailContent = str_replace("{title}", $title, $mailContent);
                    $mailContent = str_replace("{SITE_URL}", $siteUrl, $mailContent);
                    $mailContent = str_replace("{tmpPassword}", $tmpPassword, $mailContent);
                    $mailContent = str_replace("{Store name}", $adminName, $mailContent);



                    $datas['password'] = $tmpPassword;
                    $datas['id'] = $userData['id'];
                    $userEnty     = $this->Users->newEntity();
                    $userPatch    = $this->Users->patchEntity($userEnty,$datas);
                    if ($this->Users->save($userPatch) ){

                        $fromMail = $this->siteSettings['admin_email'];
                        $to = $toemail;
                        $mailSubject = "Forget password";
                        $email = new Email();
                        $email->setFrom([$fromMail => 'Comeneat2.0']);
                        $email->setTo($to);
                        $email->setSubject($mailSubject);
                        $temp=$email->setTemplate('default');
                        $email->setEmailFormat('html');
                        $email->setViewVars([
                            'mailContent' => $mailContent,
                            'title' => $mailSubject ,
                            'password' => $tmpPassword,
                            'customerName' => $customerName,
                            'siteName'    => $siteName,
                            'source'    => $source,
                            'siteUrl'    => $site_url
                        ]);



                        // $email->setViewVars(array('mailContent' => $mailContent,'source'=>$source,'storename'=>$adminName));
                        //$this->Flash->success('Temporary Password sent To your Registered email id.');

                        if($email->send()){
                            $this->Flash->success('Temporary Password sent To your Registered email id.');
                            echo '1';die();
                        }
                    }
                }else{
                    $this->Flash->error('Your account was not registered with us.');
                    echo '0';die();
                }
            }
            echo '0';die();
        }
    }
#---------------------------------------------------------------------------------------------
    //Restaurantadmin logout 
    public function logout() {
        $this->Auth->logout();
        return $this->redirect(REST_BASE_URL.'');
    }#logout function end...
#---------------------------------------------------------------------------------------------
}