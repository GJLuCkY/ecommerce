<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArticleRequest as StoreRequest;
use App\Http\Requests\ArticleRequest as UpdateRequest;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Article');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Новости',
        ]);
        $this->crud->addColumn([
            'name' => 'date',
            'label' => 'Дата',
            'type' => 'date',
        ]);
$this->crud->addColumn([
            'name' => 'status',
            'label' => 'Статус опубликованности',
        ]);

// $this->crud->addColumn([
//             'name' => 'featured',
//             'label' => 'Featured',
//             'type' => 'check',
//         ]);
// $this->crud->addColumn([
//             'label' => 'Category',
//             'type' => 'select',
//             'name' => 'category_id',
//             'entity' => 'category',
//             'attribute' => 'name',
//             'model' => "Backpack\NewsCRUD\app\Models\Category",
//         ]);
// ------ CRUD FIELDS
$this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Заголовок',
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);
$this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Будет автоматически сгенерирован из вашего названия, если он оставлен пустым.',
            // 'disabled' => 'disabled'
        ]);
$this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Дата',
            'type' => 'date',
            'value' => date('Y-m-d'),
        ], 'create');
$this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Дата',
            'type' => 'date',
        ], 'update');
$this->crud->addField([    // WYSIWYG
            'name' => 'content',
            'label' => 'Описание',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
$this->crud->addField([    // Image
            'name' => 'image',
            'label' => 'Изображение',
            'type' => 'browse',
        ]);
// $this->crud->addField([    // SELECT
//             'label' => 'Category',
//             'type' => 'select2',
//             'name' => 'category_id',
//             'entity' => 'category',
//             'attribute' => 'name',
//             'model' => "Backpack\NewsCRUD\app\Models\Category",
//         ]);
// $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
//             'label' => 'Tags',
//             'type' => 'select2_multiple',
//             'name' => 'tags', // the method that defines the relationship in your Model
//             'entity' => 'tags', // the method that defines the relationship in your Model
//             'attribute' => 'name', // foreign key attribute that is shown to user
//             'model' => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
//             'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//         ]);
$this->crud->addField([
    'name' => 'category_id',
    'type' => 'hidden',
    'value' => 1
]);
$this->crud->addField([    // ENUM
            'name' => 'status',
            'label' => 'Опубликовать',
            'type' => 'enum',
        ]);
        $this->crud->addField([
            'name' => 'featured',
            'type' => 'hidden',
            'value' => 1
        ]);
// $this->crud->enableAjaxTable();

        // add asterisk for fields that are required in ArticleRequest
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
