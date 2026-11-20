<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\Playlist;
use App\Models\Tag;
use App\Services\YouTubeService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layout.admin')]
#[Title('Manage Lessons')]
class ManageLessons extends Component
{
    use WithFileUploads;

    public string $search = '';

    // Form fields
    public string $youtubeInput = '';
    public string $title = '';
    public string $slug = '';
    public string $description = '';
    public string $image_url = '';
    public string $youtube_url = '';
    public ?int $category_id = null;
    public ?int $playlist_id = null;
    public array $selectedTags = [];
    public bool $is_public = true;

    // File uploads
    public $audioFile = null;
    public $textFile = null;
    public string $existingAudioUrl = '';
    public string $existingFileUrl = '';

    // Body JSON (lines with timing)
    public array $bodyLines = [];

    // UI state
    public ?int $editingId = null;
    public bool $showModal = false;
    public ?int $confirmingDelete = null;
    public bool $fetchingYoutube = false;
    public string $youtubeError = '';
    public string $activeTab = 'info'; // info, media, body

    protected function rules(): array
    {
        $uniqueRule = $this->editingId
            ? "unique:lessons,slug,{$this->editingId}"
            : 'unique:lessons,slug';

        return [
            'title' => 'required|string|max:255',
            'slug' => "required|string|max:255|{$uniqueRule}",
            'description' => 'nullable|string|max:5000',
            'image_url' => 'nullable|url|max:1000',
            'youtube_url' => 'nullable|url|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'playlist_id' => 'nullable|exists:playlists,id',
            'is_public' => 'boolean',
            'audioFile' => 'nullable|file|mimes:mp3,wav,ogg,m4a|max:51200',
            'textFile' => 'nullable|file|mimes:txt,srt,vtt|max:5120',
            'selectedTags' => 'array',
            'selectedTags.*' => 'exists:tags,id',
        ];
    }

    public function updatedTitle(): void
    {
        if (! $this->editingId) {
            $this->slug = Str::slug($this->title);
        }
    }

    /**
     * Fetch video details from YouTube API.
     */
    public function fetchYoutube(): void
    {
        $this->youtubeError = '';

        if (empty($this->youtubeInput)) {
            $this->youtubeError = 'Please enter a YouTube URL or video ID.';
            return;
        }

        $this->fetchingYoutube = true;

        try {
            $yt = app(YouTubeService::class);
            $data = $yt->getVideoDetails($this->youtubeInput);

            if (! $data) {
                $this->youtubeError = 'Could not fetch video details. Check the URL/ID and your API key.';
                $this->fetchingYoutube = false;
                return;
            }

            $this->title = $data['title'];
            $this->slug = Str::slug($data['title']);
            $this->description = $data['description'];
            $this->image_url = $data['thumbnail'];
            $this->youtube_url = $data['youtube_url'];

        } catch (\Exception $e) {
            $this->youtubeError = 'Error fetching from YouTube: ' . $e->getMessage();
        }

        $this->fetchingYoutube = false;
    }

    /**
     * Parse uploaded text file and generate body JSON lines.
     */
    public function updatedTextFile(): void
    {
        if (! $this->textFile) {
            return;
        }

        $content = file_get_contents($this->textFile->getRealPath());
        $extension = $this->textFile->getClientOriginalExtension();

        if (in_array($extension, ['srt', 'vtt'])) {
            $this->bodyLines = $this->parseSrtVtt($content);
        } else {
            // Plain text: each line becomes an entry
            $lines = array_filter(explode("\n", $content), fn ($l) => trim($l) !== '');
            $this->bodyLines = [];
            foreach (array_values($lines) as $i => $line) {
                $this->bodyLines[] = [
                    'index' => $i + 1,
                    'start' => '',
                    'end' => '',
                    'text' => trim($line),
                ];
            }
        }
    }

    /**
     * Parse SRT/VTT subtitle format.
     */
    protected function parseSrtVtt(string $content): array
    {
        $lines = [];
        // Normalize line endings
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        // Remove VTT header
        $content = preg_replace('/^WEBVTT.*?\n\n/s', '', $content);

        // Split into blocks
        $blocks = preg_split('/\n\n+/', trim($content));

        $index = 1;
        foreach ($blocks as $block) {
            $parts = explode("\n", trim($block));

            // Skip numeric index line if present (SRT format)
            if (isset($parts[0]) && is_numeric(trim($parts[0]))) {
                array_shift($parts);
            }

            if (count($parts) < 2) {
                continue;
            }

            // Parse timing line
            $timingLine = $parts[0];
            if (preg_match('/(\d{1,2}:?\d{2}:\d{2}[.,]\d{3})\s*-->\s*(\d{1,2}:?\d{2}:\d{2}[.,]\d{3})/', $timingLine, $m)) {
                $start = str_replace(',', '.', $m[1]);
                $end = str_replace(',', '.', $m[2]);
                $text = implode(' ', array_slice($parts, 1));

                $lines[] = [
                    'index' => $index++,
                    'start' => $start,
                    'end' => $end,
                    'text' => strip_tags(trim($text)),
                ];
            }
        }

        return $lines;
    }

    public function addBodyLine(): void
    {
        $this->bodyLines[] = [
            'index' => count($this->bodyLines) + 1,
            'start' => '',
            'end' => '',
            'text' => '',
        ];
    }

    public function removeBodyLine(int $index): void
    {
        unset($this->bodyLines[$index]);
        $this->bodyLines = array_values($this->bodyLines);
        // Re-index
        foreach ($this->bodyLines as $i => &$line) {
            $line['index'] = $i + 1;
        }
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showModal = true;
        $this->activeTab = 'info';
    }

    public function openEdit(int $id): void
    {
        $lesson = Lesson::with('tags')->findOrFail($id);
        $this->editingId = $lesson->id;
        $this->title = $lesson->title;
        $this->slug = $lesson->slug;
        $this->description = $lesson->description ?? '';
        $this->image_url = $lesson->image_url ?? '';
        $this->youtube_url = $lesson->youtube_url ?? '';
        $this->category_id = $lesson->category_id;
        $this->playlist_id = $lesson->playlist_id;
        $this->selectedTags = $lesson->tags->pluck('id')->toArray();
        $this->is_public = $lesson->is_public;
        $this->existingAudioUrl = $lesson->audio_url ?? '';
        $this->existingFileUrl = $lesson->file_url ?? '';
        $this->bodyLines = $lesson->body ?? [];
        $this->showModal = true;
        $this->activeTab = 'info';
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'youtube_url' => $this->youtube_url,
            'category_id' => $this->category_id,
            'playlist_id' => $this->playlist_id,
            'is_public' => $this->is_public,
            'body' => ! empty($this->bodyLines) ? $this->bodyLines : null,
        ];

        // Handle audio upload
        if ($this->audioFile) {
            $data['audio_url'] = $this->audioFile->store('lessons/audio', 'public');
        }

        // Handle text file upload
        if ($this->textFile) {
            $data['file_url'] = $this->textFile->store('lessons/files', 'public');
        }

        $lesson = Lesson::updateOrCreate(
            ['id' => $this->editingId],
            $data
        );

        // Sync tags
        $lesson->tags()->sync($this->selectedTags);

        $this->resetForm();
        $this->showModal = false;
        session()->flash('success', $this->editingId ? 'Lesson updated.' : 'Lesson created.');
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDelete = $id;
    }

    public function delete(int $id): void
    {
        $lesson = Lesson::findOrFail($id);

        // Delete associated files
        if ($lesson->audio_url) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($lesson->audio_url);
        }
        if ($lesson->file_url) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($lesson->file_url);
        }

        $lesson->tags()->detach();
        $lesson->delete();

        $this->confirmingDelete = null;
        session()->flash('success', 'Lesson deleted.');
    }

    public function cancelDelete(): void
    {
        $this->confirmingDelete = null;
    }

    protected function resetForm(): void
    {
        $this->editingId = null;
        $this->youtubeInput = '';
        $this->title = '';
        $this->slug = '';
        $this->description = '';
        $this->image_url = '';
        $this->youtube_url = '';
        $this->category_id = null;
        $this->playlist_id = null;
        $this->selectedTags = [];
        $this->is_public = true;
        $this->audioFile = null;
        $this->textFile = null;
        $this->existingAudioUrl = '';
        $this->existingFileUrl = '';
        $this->bodyLines = [];
        $this->youtubeError = '';
        $this->activeTab = 'info';
        $this->resetValidation();
    }

    public function render(): View
    {
        $lessons = Lesson::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->with(['category', 'playlist', 'tags'])
            ->latest()
            ->paginate(15);

        $categories = Category::orderBy('name')->get();
        $playlists = Playlist::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('livewire.admin.manage-lessons', compact('lessons', 'categories', 'playlists', 'tags'));
    }
}
