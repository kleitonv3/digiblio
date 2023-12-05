<?php

namespace App\Nova;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Copy extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Copy>
     */
    public static $model = \App\Models\Copy::class;

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
        'editor',
        'book',
        'location',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Livro', 'book', Book::class)
                ->searchable()
                ->sortable(),

            Text::make('Edição', 'edition')
                ->rules('required', 'max:255'),

            Text::make('Editor(a)', 'editor')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Páginas', 'pages')
                ->min(1)
                ->step(1),

            Date::make(__('Data de impressão'), 'print_date')
                ->hideFromIndex(),

            Select::make('Estado de conservação', 'copy_state')
                ->options([
                    'normal' => 'Normal',
                    'degraded' => 'Degradado',
                    'irreparable' => 'Irreparável'
                ])
                ->displayUsingLabels()
                ->showOnIndex(),

            Text::make(__('Localização'), 'location')
                ->rules('nullable', 'max:255'),

            Boolean::make('Emprestado', 'loan_status')
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->default(0),

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
