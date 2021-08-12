<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class UserTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp()
    {
        $this->perPageValues = [10, 25, 50, 100];

        $this
            ->showCheckBox('id')
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
        return User::query();
    }

    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('created_at')
            ->addColumn('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('#'))
                ->field('id')
                ->visibleInExport(false)
                ->sortable()
                ->headerAttribute('text-sm')
                ->bodyAttribute('text-sm'),

            Column::add()
                ->title(__('NAME'))
                ->field('name')
                ->visibleInExport(true)
                ->sortable()
                ->makeInputText()
                ->searchable()
                ->headerAttribute('text-sm')
                ->bodyAttribute('text-sm'),

            Column::add()
                ->title(__('EMAIL'))
                ->field('email')
                ->visibleInExport(true)
                ->sortable()
                ->makeInputText()
                ->searchable()
                ->headerAttribute('text-sm')
                ->bodyAttribute('text-sm'),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at')
                ->visibleInExport(true)
                ->sortable()
                ->searchable()
                ->headerAttribute('text-sm')
                ->bodyAttribute('text-sm')
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title(__('UPDATED AT'))
                ->field('updated_at')
                ->visibleInExport(true)
                ->sortable()
                ->searchable()
                ->headerAttribute('text-sm')
                ->bodyAttribute('text-sm')
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
               ->route('user.edit', ['user' => 'id']),

           Button::add('destroy')
               ->caption(__('Delete'))
               ->class('bg-red-500 text-white')
               ->route('user.destroy', ['user' => 'id'])
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
           $updated = User::query()->find($data['id'])->update([
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
