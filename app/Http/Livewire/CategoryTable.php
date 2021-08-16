<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class CategoryTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp()
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput();
    }

    public function template(): ?string
    {
        return null;
    }

    public function dataSource(): ?Builder
    {
        return Category::query();
    }

    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('code')
            ->addColumn('status')
            ->addColumn('enabled')
            ->addColumn('name')
            ->addColumn('description')
            ->addColumn('enabled_at_formatted', function(Category $model) { 
                return Carbon::parse($model->enabled_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('publication_at_formatted', function(Category $model) { 
                return Carbon::parse($model->publication_at)->format('d/m/Y');
            })
            ->addColumn('created_at_formatted', function(Category $model) { 
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function(Category $model) { 
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id')
                ->makeInputRange(),

            Column::add()
                ->title(__('CODE'))
                ->field('code')
                ->makeInputRange(),

            Column::add()
                ->title(__('STATUS'))
                ->field('status')
                ->toggleable(),

            Column::add()
                ->title(__('ENABLED'))
                ->field('enabled')
                ->toggleable(),

            Column::add()
                ->title(__('NAME'))
                ->field('name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('DESCRIPTION'))
                ->field('description')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('ENABLED AT'))
                ->field('enabled_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('enabled_at'),

            Column::add()
                ->title(__('PUBLICATION AT'))
                ->field('publication_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('publication_at'),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title(__('UPDATED AT'))
                ->field('updated_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('updated_at'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

    /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption(__('Edit'))
               ->class('bg-indigo-500 text-white')
               ->route('category.edit', ['category' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('category.destroy', ['category' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = Category::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            "error" => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }
    */
}
