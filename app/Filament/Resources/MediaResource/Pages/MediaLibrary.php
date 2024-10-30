<?php

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\Page;

class MediaLibrary extends Page
{
    protected static string $resource = MediaResource::class;

    protected static string $view = 'filament.resources.media-resource.pages.media-library';
}
