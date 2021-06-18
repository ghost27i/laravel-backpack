<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MovieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MovieCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Movie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/movie');
        CRUD::setEntityNameStrings('movie', 'movies');

        CRUD::operation('list', function() {
            // CRUD::removeButton('create');
            // CRUD::removeButton('delete');
            // CRUD::removeButton('update');
            // CRUD::removeButton('show');
            // CRUD::enableExportButtons();
        });
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

        CRUD::removeColumns(['actors', 'image']);

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
        CRUD::setValidation(MovieRequest::class);


        // CRUD::setFromDb(); // fields

        CRUD::addFields([
                [
                    'label' => "Movie Title",
                    'name' => 'title',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'name' => 'director',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'name' => 'trailer',
                    'attributes' => [
                        'required' => true,
                    ],
                ],
                [
                    'label' => "Movie Image",
                    'name' => "image",
                    'type' => 'image',
                    'crop' => true, // set to true to allow cropping, false to disable
                    // 'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
                    // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
                    // 'prefix'    => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
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
