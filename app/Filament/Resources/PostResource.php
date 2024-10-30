<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Set;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('col 1')
                    ->description('Lorem upsum dolor sit amet')
                    ->schema([
                        Builder::make('flexiblecontent')
                        ->blocks([
                            Builder\Block::make('heading')
                                ->schema([
                                    Forms\Components\TextInput::make('content')
                                        ->label('Heading')
                                        ->required(),
                                        Forms\Components\Select::make('level')
                                        ->options([
                                            'h1' => 'Heading 1',
                                            'h2' => 'Heading 2',
                                            'h3' => 'Heading 3',
                                            'h4' => 'Heading 4',
                                            'h5' => 'Heading 5',
                                            'h6' => 'Heading 6',
                                        ])
                                        ->required(),
                                ])
                                ->columns(2),
                            Builder\Block::make('paragraph')
                                ->schema([
                                    Forms\Components\Textarea::make('content')
                                        ->label('Paragraph')
                                        ->required(),
                                ]),
                            Builder\Block::make('image')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('avatar')
                                        ->collection('avatars')
                                        ->multiple()
                                        ->hintAction(
                                            Action::make('attachMedia')
                                                ->icon('heroicon-m-clipboard')
                                                ->requiresConfirmation()
                                                ->form([
                                                    Select::make('mediaId')
                                                        ->label('Author')
                                                        ->options(Media::query()->pluck('name', 'id'))
                                                        ->required(),
                                                ])
                                                ->action(function (Set $set, array $data, $record) {
                                                    //dd(Storage::url($data['mediaId']));
                                                    //$set('avatar', Media::where('id', $data['mediaId'])->first());
                                                    //dd(Media::where('id', $data['mediaId'])->first()->model);
                                                    //dd(Media::where('id', $data['mediaId'])->first()->getPath());
                                                    Post::find(2)
                                                        ->addMediaFromUrl(Media::where('id', $data['mediaId'])->first()->getUrl())
                                                        ->toMediaCollection();
                                                    $set('avatar', Media::where('id', $data['mediaId'])->first()->model->avatar);
                                                })
                                            ),
                                        Forms\Components\TextInput::make('alt')
                                        ->label('Alt text')
                                        ->required(),
                                ]),
                        ])
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')->collection('avatars'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TopicRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
