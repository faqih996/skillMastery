<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingResource\Pages;
use App\Filament\Resources\PricingResource\RelationManagers;
use App\Models\Pricing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricingResource extends Resource
{
    protected static ?string $model = Pricing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            FieldSet::make('Details')
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),

                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->prefix('Month')
            ]),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name')
                ->sortable()
                ->searchable(),
            TextColumn::make('price'),

            TextColumn::make('duration'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPricings::route('/'),
            'create' => Pages\CreatePricing::route('/create'),
            'edit' => Pages\EditPricing::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
