<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Collection;
use Filament\Forms\Get;


class ListMedia extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public Media $media;

    public function table(Table $table): Table
    {
        return $table
            ->query(Media::query())
            ->columns([
                SpatieMediaLibraryImageColumn::make('model.avatar')
                    ->collection('avatars')
                    ->filterMediaUsing(
                        function (Collection $media, Media $item){
                            return $media->where(
                                'name',
                                $item->name,
                            );
                        },
                    ),
                TextColumn::make('model.title')->label('Assigned to'),
                TextColumn::make('name'),
                TextColumn::make('collection_name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.list-media');
    }
}
