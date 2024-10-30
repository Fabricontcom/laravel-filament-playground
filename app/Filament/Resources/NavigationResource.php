<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationResource\Pages;
use App\Filament\Resources\NavigationResource\RelationManagers;
use App\Models\Navigation;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Post;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                        ->required(),
                Forms\Components\Select::make('url')
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $search): array => Post::where('title', 'like', "%{$search}%")->limit(50)->pluck('title', 'id')->toArray())
                        ->getOptionLabelUsing(fn ($value): ?string => Post::find($value)?->title),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort')
            ->reorderable('sort');
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
            'index' => Pages\ListNavigations::route('/'),
            'create' => Pages\CreateNavigation::route('/create'),
            'edit' => Pages\EditNavigation::route('/{record}/edit'),
        ];
    }
}
