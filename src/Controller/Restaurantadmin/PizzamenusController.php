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

        $meatList = $this->Meats->find('list',[
            'keyField' => 'id',
            'valueField' => 'meat_name'            
        ])->hydrate(false)->toArray();

        $veggiesList = $this->Veggies->find('list',[
            'keyField' => 'id',
            'valueField' => 'veggies_name'            
        ])->hydrate(false)->toArray();

        $this->set(compact('meatList', 'veggiesList'));
    }    
//----------------------------------------------------------------------------------
} #classEnd...