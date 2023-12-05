<?php

namespace App\Nova;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class LoanRecord extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\LoanRecord>
     */
    public static $model = \App\Models\LoanRecord::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function singularLabel()
    {
        return __('Empréstimo');
    }

    public static function Label()
    {
        return __('Empréstimos');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Cópia', 'copy', Copy::class)
                ->searchable()
                ->required(),

            BelongsTo::make('Para quem foi emprestado', 'borrowedBy', User::class)
                ->required()
                ->searchable(),

            Date::make(__('Data do empréstimo'), 'date_loaned')
                ->rules('required'),

            Date::make(__('Data de retorno'), 'date_return')
                ->rules('required'),

            Date::make(__('Data que foi retornado'), 'date_returned')
                ->hideFromIndex(),

            BelongsTo::make('Criado por', 'registeredBy', User::class)
                ->readonly()
                ->onlyOnDetail(),

            Hidden::make('Criado por', 'registered_by')
                ->default(function () {
                    return Auth::id();
                }),

            DateTime::make('Criado em', 'created_at')
                ->hideWhenCreating()
                ->hideFromIndex()
                ->readonly(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
