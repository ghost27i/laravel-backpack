<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ActorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ActorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Actor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/actor');
        CRUD::setEntityNameStrings('actor', 'actors');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns


        CRUD::setColumnDetails('movie_id', [
            'label' => 'Movie',
            'type' => 'select',
            'entity' => 'movie',
            'attribute' => 'title',
        ]);  

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ActorRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::addFields([
                [
                    'label' => "Movie",
                    'name' => 'movie_id',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'name' => 'name',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'name' => 'role',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'name' => 'publish',
                    'type' => 'boolean',
                    'attributes' => [
                        'required' => true,
                    ],
                ]

        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
