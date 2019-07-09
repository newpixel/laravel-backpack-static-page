<?php

namespace Newpixel\StaticPageCRUD\App\Http\Controllers\Admin;

// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Newpixel\StaticPageCRUD\App\Http\Requests\StaticPageRequest as StoreRequest;
use Newpixel\StaticPageCRUD\App\Http\Requests\StaticPageRequest as UpdateRequest;

/**
 * Class StaticPageCrudController.
 * @property-read CrudPanel $crud
 */
class StaticPageCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('Newpixel\StaticPageCRUD\App\Models\StaticPage');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/static-page');
        $this->crud->setEntityNameStrings('pagina', 'pagini');
        $this->crud->enableReorder('name', 0);
        $this->crud->allowAccess('reorder', 1);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        // $this->crud->setFromDb();

        $this->crud->addColumns([
            [
                'name'      => 'row_number',
                'type'      => 'row_number',
                'label'     => '#',
                'orderable' => false,
            ],
            [
               'name'  => 'name',
               'label' => 'Denumire',
            ],
            [
                'name'    => 'display_in_menu',
                'label'   => 'Afiseaza in meniul',
                'type'    => 'select_from_array',
                'options' => $this->crud->model::$displayZones,
            ],
            [
               'name'    => 'active',
               'label'   => 'Activ',
               'type'    => 'boolean',
               'options' => [0 => 'Nu', 1 => 'Da'],
            ],
        ]);

        $this->crud->addFields(
            [
                [
                    'name'              => 'name',
                    'label'             => 'Denumire',
                    'type'              => 'text',
                    'tab'               => 'General',
                    'wrapperAttributes' => ['class' => 'form-group col-md-7'],
                ],
                [
                    'name'              => 'display_in_menu',
                    'label'             => 'Afiseaza in meniu',
                    'type'              => 'select_from_array',
                    'options'           => $this->crud->model::$displayZones,
                    'allows_null'       => false,
                    'tab'               => 'General',
                    'wrapperAttributes' => ['class' => 'form-group col-md-3'],
                ],
                [
                    'name'              => 'active',
                    'label'             => 'Activ',
                    'type'              => 'radio',
                    'options'           => [0 => 'Nu', 1 => 'Da'],
                    'inline'            => true,
                    'tab'               => 'General',
                    'wrapperAttributes' => ['class' => 'form-group col-md-2'],
                ],
                [
                    'name'              => 'details',
                    'label'             => 'Detalii',
                    'type'              => 'ckeditor',
                    'tab'               => 'General',
                    'wrapperAttributes' => ['class' => 'form-group col-md-12'],
                ],
                [
                    'name'     => 'title',
                    'label'    => 'Meta Title',
                    'fake'     => true,
                    'store_in' => 'meta',
                    'tab'      => 'SEO',
                ],
                [
                    'name'     => 'description',
                    'label'    => 'Meta Description',
                    'type'     => 'textarea',
                    'fake'     => true,
                    'store_in' => 'meta',
                    'tab'      => 'SEO',
                ],
                [
                    'name'     => 'keywords',
                    'label'    => 'Meta Keywords',
                    'fake'     => true,
                    'store_in' => 'meta',
                    'tab'      => 'SEO',
                ],
            ]
        );

        $this->crud->addButtonFromModelFunction('line', 'open', 'getOpenButton', 'beginning');

        // add asterisk for fields that are required in StaticPageRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
