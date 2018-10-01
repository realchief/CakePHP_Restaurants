<?php
/**
 * Created by PhpStorm.
 * User: NagaRaj.V
 * Date: 08-Jan-2018
 * Time: 21:30
 */
namespace App\Controller\Restaurantadmin;

use Cake\Event\Event;
use App\Controller\AppController;


class PizzamenusController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('restaurant');
        $this->loadComponent('Flash');
        $this->loadComponent('Common');

        $this->loadModel('Users');
        $this->loadModel('Restaurants');
        $this->loadModel('Categories');
        $this->loadModel('RestaurantMenus');
        $this->loadModel('MenuDetails');
        $this->loadModel('MenuAddons');
        $this->loadModel('Mainaddons');
        $this->loadModel('Meats');
        $this->loadModel('Veggies');
    }
//----------------------------------------------------------------------------------
    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'login'
        ]);
    }
//----------------------------------------------------------------------------------
    /*Get All Menu*/
    public function index() {

        $user = $this->Auth->user();
        $restDetails = $this->Restaurants->find('all', [
               'conditions' => [
                'user_id' => $user['id']
            ],
            'contain' => [
                'DeliverySettings',
                'Areamaps',
                'RestaurantPayments' => [
                    'PaymentMethods'
                ]
            ]
        ])->hydrate(false)->first();     

        $resId  = $restDetails['id'];
        $id = $resId;

        // // echo $resId;die;            

        $meatList = $this->Meats->find('list',[
            'keyField' => 'id',
            'valueField' => 'meat_name'            
        ])->hydrate(false)->toArray();

        $veggiesList = $this->Veggies->find('list',[
            'keyField' => 'id',
            'valueField' => 'veggies_name'            
        ])->hydrate(false)->toArray();

        $menuDetails = $this->RestaurantMenus->find('all', [
            'conditions' => [
                'id' => $id
            ],
            'contain' => [
                'MenuDetails'
            ]
        ])->first();

        $menuList = $this->RestaurantMenus->find('list', [
            'keyField' => 'id',
            'conditions' => [
                'restaurant_id' => $resId
            ],
            'valueField' => 'menu_name'
        ])->toArray();

        $this->set(compact('meatList', 'veggiesList', 'restDetails', 'menuDetails', 'resId', 'menuList'));
    }   


//----------------------------------------------------------------------------------


    public function pizzamenusSettings() {
        
        $user = $this->Auth->user(); 
        
        $restDetails = $this->Restaurants->find('all', [
               'conditions' => [
                'user_id' => $user['id']
            ],
            'contain' => [
                'DeliverySettings',
                'Areamaps',
                'RestaurantPayments' => [
                    'PaymentMethods'
                ]
            ]
        ])->hydrate(false)->first();

        $resId  = $restDetails['id']; 

        // echo "<pre>";print_r($this->request->getData());    
        // echo "<pre>";print_r($this->request->getData('menu_meats'));        

        if($this->request->getData('menu_meats') != '') {
            $selectedMeats = implode(',',$this->request->getData('menu_meats'));           
        }else {
            $selectedMeats = '';
        }

        if($this->request->getData('menu_veggies') != '') {            
            $selectedVeggies = implode(',',$this->request->getData('menu_veggies'));
        }else {
            $selectedVeggies = '';
        }        
        
        if($this->request->is(['post'])) {           

            $menuEntity = $this->RestaurantMenus->newEntity();
            $menuPatch = $this->RestaurantMenus->patchEntity($menuEntity,$this->request->getData());

            $menuPatch['restaurant_id'] = $resId;  
            $menuPatch['id'] = $this->request->getData('selectedId');            
            $menuPatch['menu_meats'] = $selectedMeats; 
            $menuPatch['menu_veggies'] = $selectedVeggies;      
            
            $menuSave = $this->RestaurantMenus->save($menuPatch); 
            
            if($menuSave){                              
                $this->Flash->success('Saved Successful');
                return $this->redirect(REST_BASE_URL.'pizzamenus'); 
            }          
        }
    }
//----------------------------------------------------------------------------------
} #classEnd...


