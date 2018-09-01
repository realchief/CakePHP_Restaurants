<?php
/**
 * Created by PhpStorm.
 * User: Sundar.S
 * Date: 29-12-2017
 * Time: 19:34
 */
namespace App\Controller\Restaurantadmin;

use Cake\Event\Event;
use App\Controller\AppController;


class CategoriesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('restaurant');
        $this->loadComponent('Flash');
        $this->loadModel('Categories');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'login'
        ]);
    }
#--------------------------------------------------------------------------------------------
    //Restaurantadmin Categories index
    public function index () {
        $catList = $this->Categories->find('all', [
            'fields' => [
                'id',
                'category_name',
                'sortorder',
                'status',
                'delete_status',
                'created'
            ],
            'conditions' => [
                'id IS NOT NULL',
                'delete_status' => 'N'
            ],
            'order' =>[
                'category_name' => 'ASC'
            ]
        ])->hydrate(false)->toArray();
        $this->set(compact('catList'));
    }#index function end...
#------------------------------------------------------------------------------------------- 
}#class function end...