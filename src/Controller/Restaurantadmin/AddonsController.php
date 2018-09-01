<?php
/**
 * Created by PhpStorm.
 * User: Sundar.S
 * Date: 29-12-2017
 * Time: 19:34
 */
namespace App\Controller\RestaurantAdmin;

use Cake\Event\Event;
use App\Controller\AppController;


class AddonsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('restaurant');
        $this->loadComponent('Flash');
        $this->loadModel('Categories');
        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'login'
        ]);
    }
#--------------------------------------------------------------------------------------------
    //Restaurantadmin Addons index
    public function index() {
        $addonsList = $this->Mainaddons->find('all', [
            'fields' => [
                'Mainaddons.id',
                'Mainaddons.mainaddons_name',
                'Mainaddons.status',
                'Mainaddons.delete_status'
            ],
            'conditions' => [
                'Mainaddons.id IS NOT NULL',
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
                        'Categories.delete_status' => 'N'
                    ]
                ]
            ],
            'order' => [
                'Mainaddons.id' => 'DESC'
            ]
        ])->hydrate(false)->toArray();
        $this->set(compact('addonsList'));
    }#index function end...
#---------------------------------------------------------------------------------------------
}#class end...