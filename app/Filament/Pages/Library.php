<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Library extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.library';


    public function delete($id)
    {
        $post = Media::findOrFail($id);

        //$this->authorize('delete', $post);

        $post->delete();
    }

}
