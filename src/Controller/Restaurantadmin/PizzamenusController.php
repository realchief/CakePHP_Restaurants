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

        $addonsList = $this->Mainaddons->find('all', [
            'fields' => [
                'Mainaddons.id',
                'Mainaddons.mainaddons_name',
                'Mainaddons.status',
                'Mainaddons.created'
            ],
            'conditions' => [
                'Mainaddons.delete_status' => 'N',
            ],
            'contain' => [
                'Subaddons' => [
                    'conditions' => [
                        'Subaddons.delete_status' => 'N',
                    ]
                ],
                'Categories' => [
                    'fields' => [
                        'Categories.id',
                        'Categories.category_name'
                    ],
                    'conditions' => [
                        'Categories.delete_status' => 'N',
                    ]
                ]
            ],
            'order' => [
                'Mainaddons.id' => 'DESC'
            ]
        ])->hydrate(false)->toArray();
        $this->set(compact('addonsList'));
    }    
//----------------------------------------------------------------------------------
} #classEnd...