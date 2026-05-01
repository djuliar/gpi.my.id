<?php

namespace App\Filament\Resources\WorkBookEvents\Schemas;

use App\Enums\Status;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use CodeWithDennis\SimpleAlert\Components\SimpleAlert;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkBook;

class WorkBookEventForm
{
    public static function configure(Schema $schema): Schema
    {
        $toolbars = [
            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'clearFormatting'],
            ['h1','h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
            ['blockquote', 'codeBlock', 'bulletList', 'orderedList', 'link'],
            ['grid', 'gridDelete', 'highlight', 'horizontalRule', 'lead', 'small', 'code', 'textColor'],
            ['table', 'attachFiles'],
            ['undo', 'redo', 'fullscreen', 'source-ai'],
        ];

        $default = [
            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'clearFormatting'],
            ['h1','h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
            ['blockquote', 'codeBlock', 'bulletList', 'orderedList', 'link', 'code'],
            ['table', 'attachFiles'],
            ['undo', 'redo', 'horizontalRule', 'fullscreen', 'source-ai'],
        ];

        $minimal = [
            ['bold', 'italic', 'underline', 'clearFormatting'],
            ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
            ['bulletList', 'orderedList', 'table'],
            ['undo', 'redo', 'horizontalRule', 'source-ai'],
        ];

        $floatingToolbars = [
            'paragraph' => [
                'bold', 'italic', 'underline', 'h2', 'h3', 'bulletList', 'orderedList', 'alignStart', 'alignCenter', 'alignEnd', 'alignJustify', 'horizontalRule', 'tableMergeCells'
            ],
            'heading' => [
                'h1', 'h2', 'h3'
            ],
            'table' => [
                'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
                'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
                'tableMergeCells', 'tableSplitCell',
                'tableToggleHeaderRow', 'tableToggleHeaderCell',
                'tableDelete',
            ],
        ];
        
        $information = Str::markdown("- Jika setelah upload gambar tidak tampil Tekan **Save Changes** atau **Ctrl+S**.
- Gunakan tombol **&mdash;** `[Horizontal Rule]` untuk membuat tulisan ke Halaman Baru.");

        $userId = Auth::id();

        return $schema
            ->components([
                Grid::make(12)
                    ->columnSpanFull()
                    ->schema([
                        SimpleAlert::make('information')
                            ->columnSpanFull()
                            ->title('Informasi!')
                            ->description(new HtmlString($information)),
                        Select::make('bkpm_id')
                            ->relationship(
                                name: 'bkpm.course', 
                                titleAttribute: 'course_name',
                            )
                            ->label('BKPM')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpan(4)
                            ->default(null),
                        TextInput::make('event_to')
                            ->label('Acara Ke')
                            ->columnSpan(2)
                            ->numeric()
                            ->default(1),
                        TextInput::make('title')
                            ->label('Judul Acara')
                            ->columnSpan(6)
                            ->default(null),
                        TextInput::make('main_topic')
                            ->label('Pokok Bahasan')
                            ->columnSpan(4)
                            ->default(null),
                        TextInput::make('weeks')
                            ->label('Acara Praktikum')
                            ->placeholder('MINGGU 1/1')
                            ->columnSpan(3)
                            ->default(null),
                        Select::make('class_name')
                            ->label('Tempat')
                            ->options([
                                'Luring' => 'Luring',
                                'Daring' => 'Daring',
                                'Hybrid' => 'Hybrid',
                            ])
                            ->default('Hybrid')
                            ->columnSpan(3)
                            ->placeholder('Select Class')
                            ->native(false),
                        TextInput::make('time_allocation')
                            ->label('Alokasi Waktu')
                            ->helperText('Tuliskan Dalam Menit')
                            ->columnSpan(2)
                            ->numeric()
                            ->default(100),
                        TextInput::make('page_number')
                            ->label('No. Halaman')
                            ->hint('Untuk Daftar Isi')
                            ->columnSpan(4)
                            ->numeric()
                            ->default(1),
                        Select::make('status')
                            ->options(Status::class)
                            ->columnSpan(2)
                            ->hiddenOn('create')
                            ->default(1),
                        Section::make()
                            ->columnSpan(6),
                        RichEditor::make('cpmk')
                            ->label('CPMK')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('indicator')
                            ->label('Indikator Penilaian')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('bnsp')
                            ->label('BNSP')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('tool_material')
                            ->label('Alat dan Bahan')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('basic_theory')
                            ->label('Dasar Teori')
                            ->toolbarButtons($toolbars)
                            ->floatingToolbars($floatingToolbars)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('procedure')
                            ->label('Prosedur Kerja')
                            ->toolbarButtons($toolbars)
                            ->floatingToolbars($floatingToolbars)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('result')
                            ->label('Hasil dan Pembahasan')
                            ->toolbarButtons($default)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('conclusion')
                            ->label('Kesimpulan')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpan(6)
                            ->default(null),
                        RichEditor::make('assessment_rubric')
                            ->label('Rubrik Penilaian')
                            ->toolbarButtons($minimal)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('attachments')
                            ->fileAttachmentsVisibility('public')
                            ->default(null)
                            ->columnSpanFull(),
                        Hidden::make('user_id')
                            ->default(auth()->id()),
                ]),
            ]);
    }
}
