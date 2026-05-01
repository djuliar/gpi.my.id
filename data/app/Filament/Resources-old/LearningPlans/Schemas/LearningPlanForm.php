<?php

namespace App\Filament\Resources\LearningPlans\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class LearningPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        $toolbars = [
            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'clearFormatting'],
            ['h1','h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
            ['blockquote', 'codeBlock', 'bulletList', 'orderedList', 'link'],
            ['grid', 'gridDelete', 'highlight', 'horizontalRule', 'lead', 'small', 'code', 'textColor'],
            ['table', 'attachFiles'], // The `customBlocks` and `mergeTags` tools are also added here if those features are used.
            ['undo', 'redo', 'fullscreen'],
        ];

        $floatingToolbars = [
            'paragraph' => [
                'bold', 'italic', 'underline', 'h1', 'h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd', 'alignJustify'
            ],
            'heading' => [
                'h1', 'h2', 'h3',
            ],
            'table' => [
                'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
                'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
                'tableMergeCells', 'tableSplitCell',
                'tableToggleHeaderRow', 'tableToggleHeaderCell',
                'tableDelete',
            ],
        ];

        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Select::make('course_id')
                            ->relationship('course', 'course_name')
                            ->label('Mata Kuliah')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpanFull()
                            ->default(null),
                        TextInput::make('launch_city')
                            ->label('Kota Launching')
                            ->columnSpan(1)
                            ->required()
                            ->default('Jember'),
                        DatePicker::make('launch_date')
                            ->label('Tanggal Launching')
                            ->columnSpan(1)
                            ->required()
                            ->default(now()),
                        TextInput::make('course_coordinator')
                            ->label('Koordinator Mata Kuliah')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('course_coordinator_nip')
                            ->label('NIP Koordinator')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('author')
                            ->label('Penulis')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                        TextInput::make('author_nip')
                            ->label('NIP Penulis')
                            ->columnSpan(1)
                            ->required()
                            ->default(null),
                    ]),
                Grid::make(2)
                    ->schema([
                        Repeater::make('lecturer')
                            ->label('Tim Teaching')
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(7)
                            ->required()
                            ->columnSpanFull()
                            ->addActionLabel('Add Dosen')
                            ->schema([
                                TextInput::make('name')->label('Nama Dosen')->required(),
                            ]),
                    ]),
                Grid::make(2)
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('cpl')
                            ->label('Capaian Pembelajaran Lulusan')
                            ->defaultItems(0)
                            ->minItems(1)
                            ->columnSpan(1)
                            ->addActionLabel('Add CPL')
                            ->schema([
                                TextInput::make('code')->label('Kode')->required(),
                                TextArea::make('description')->label('Deskripsi')->required(),
                            ]),
                        Repeater::make('tb')
                            ->label('Tujuan Pembelajaran')
                            ->defaultItems(0)
                            ->minItems(1)
                            ->columnSpan(1)
                            ->addActionLabel('Add TB')
                            ->schema([
                                TextInput::make('code')->label('Kode')->required(),
                                TextArea::make('description')->label('Deskripsi')->required(),
                            ]),
                        RichEditor::make('introduction')
                            ->label('Kata Pengantar')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->required()
                            ->columnSpan(1)
                            // ->toolbarButtons($toolbars)
                            // ->floatingToolbars($floatingToolbars)
                            ->default(null),
                        RichEditor::make('description')
                            ->label('Deskripsi Mata Kuliah')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(1)
                            ->default(null),
                        RichEditor::make('material')
                            ->label('Materi Pembelajaran')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(1)
                            ->default(null),
                        RichEditor::make('reference')
                            ->label('Daftar Referensi')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(1)
                            ->default(null),
                        RichEditor::make('prerequisite_course')
                            ->label('Mata Kuliah Prasyarat')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(1)
                            ->default(null),
                        RichEditor::make('note')
                            ->label('Catatan')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(1)
                            ->default(null),
                        Repeater::make('additional_page')
                            ->label('Halaman Tambahan')
                            ->defaultItems(0)
                            ->maxItems(3)
                            ->columnSpan(1)
                            ->addActionLabel('Add Halaman Tambahan')
                            ->schema([
                                TextInput::make('title')->label('Judul')->required(),
                                RichEditor::make('content')->label('Kontent')->required(),
                            ]),
                        Select::make('status')
                            ->options(Status::class)
                            ->hiddenOn('create')
                            ->columnSpan(1)
                            ->default(1),
                        Hidden::make('user_id')
                            ->default(auth()->id()),
                    ]),
            ]);
    }
}
