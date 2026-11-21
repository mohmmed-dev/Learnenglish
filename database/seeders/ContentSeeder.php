<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\Playlist;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categoriesData = [
            [
                'name' => 'Everyday English',
                'slug' => 'everyday-english',
                'description' => 'Real-life conversational expressions, greetings, slang, and phrases used by native speakers daily.',
            ],
            [
                'name' => 'Pronunciation & Accent',
                'slug' => 'pronunciation-accent',
                'description' => 'Master connected speech, intonation, vowel reductions, and rhythm for effortless English pronunciation.',
            ],
            [
                'name' => 'Listening Practice',
                'slug' => 'listening-practice',
                'description' => 'Train your ear to understand fast native speakers without relying on mental translation.',
            ],
            [
                'name' => 'Business & Workplace',
                'slug' => 'business-workplace',
                'description' => 'Professional vocabulary, meeting expressions, negotiations, and job interview English.',
            ],
            [
                'name' => 'Idioms & Phrasal Verbs',
                'slug' => 'idioms-phrasal-verbs',
                'description' => 'Essential idioms and phrasal verbs that make your English sound natural, vivid, and fluent.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $data) {
            $categories[$data['slug']] = Category::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // 2. Playlists
        $playlistsData = [
            [
                'category_id' => $categories['everyday-english']->id,
                'name' => 'Natural Conversations Bootcamp',
                'slug' => 'natural-conversations-bootcamp',
                'description' => 'Go from hesitant to fluent in casual coffee chats, weekend talks, and everyday social interactions.',
            ],
            [
                'category_id' => $categories['pronunciation-accent']->id,
                'name' => 'American Accent Blueprint',
                'slug' => 'american-accent-blueprint',
                'description' => 'Unlock clear pronunciation through linking, reductions, and shadowing exercises.',
            ],
            [
                'category_id' => $categories['listening-practice']->id,
                'name' => 'Fast English Ear Training',
                'slug' => 'fast-english-ear-training',
                'description' => 'Break down mumbled words, dropped sounds, and real-life fast speech dialogue.',
            ],
            [
                'category_id' => $categories['business-workplace']->id,
                'name' => 'Confidant Workplace English',
                'slug' => 'confidant-workplace-english',
                'description' => 'Speak up in team meetings, write crisp emails, and present ideas clearly at work.',
            ],
        ];

        $playlists = [];
        foreach ($playlistsData as $data) {
            $playlists[$data['slug']] = Playlist::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // 3. Tags
        $tagNames = [
            'Beginner', 'Intermediate', 'Advanced', 'Shadowing',
            'Vocabulary', 'Conversations', 'Slang', 'Workplace', 'Audio Practice',
        ];
        $tags = [];
        foreach ($tagNames as $name) {
            $slug = Str::slug($name);
            $tags[$slug] = Tag::firstOrCreate(['slug' => $slug], ['name' => $name, 'slug' => $slug]);
        }

        // 4. Lessons with rich body JSON transcripts
        $lessonsData = [
            [
                'title' => 'Small Talk That Sounds Natural and Confident',
                'slug' => 'small-talk-that-sounds-natural-and-confident',
                'category_id' => $categories['everyday-english']->id,
                'playlist_id' => $playlists['natural-conversations-bootcamp']->id,
                'description' => 'Learn the go-to phrases native English speakers use when bumping into someone or starting a casual conversation in the office or on the street.',
                'image_url' => 'https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['beginner', 'conversations', 'shadowing'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:02.000',
                        'end' => '00:00:05.500',
                        'text' => 'Hey there! How have you been holding up lately?',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:06.000',
                        'end' => '00:00:09.200',
                        'text' => 'Can you believe how fast this whole week has flown by?',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:10.000',
                        'end' => '00:00:14.000',
                        'text' => 'I was just grabbing a coffee before getting started on my next project.',
                    ],
                    [
                        'index' => 4,
                        'start' => '00:00:14.500',
                        'end' => '00:00:18.500',
                        'text' => 'Notice how native speakers blend "What have you been up to?" into a smooth sound.',
                    ],
                    [
                        'index' => 5,
                        'start' => '00:00:19.000',
                        'end' => '00:00:23.000',
                        'text' => 'Repeat after me: What you been up to? Keep it relaxed and steady.',
                    ],
                ],
            ],
            [
                'title' => 'Stop Sounding Like a Textbook: Connected Speech Secrets',
                'slug' => 'stop-sounding-like-a-textbook-connected-speech',
                'category_id' => $categories['pronunciation-accent']->id,
                'playlist_id' => $playlists['american-accent-blueprint']->id,
                'description' => 'Swap stiff, isolated words for the fluid connected rhythm that characterizes natural spoken English. We examine linking, elision, and rhythm.',
                'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['intermediate', 'shadowing', 'audio-practice'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:01.000',
                        'end' => '00:00:04.500',
                        'text' => 'When native speakers talk, words do not stop and start like bricks.',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:05.000',
                        'end' => '00:00:09.000',
                        'text' => 'Instead, the final consonant links directly into the following vowel sound.',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:09.500',
                        'end' => '00:00:13.800',
                        'text' => 'For instance, "turn it off" becomes "tur-ni-toff". Listen carefully.',
                    ],
                    [
                        'index' => 4,
                        'start' => '00:00:14.200',
                        'end' => '00:00:18.000',
                        'text' => 'Let us shadow this sentence together three times in a row.',
                    ],
                ],
            ],
            [
                'title' => 'Fast English Listening: Train Your Brain for Real Speech',
                'slug' => 'fast-english-listening-train-your-brain',
                'category_id' => $categories['listening-practice']->id,
                'playlist_id' => $playlists['fast-english-ear-training']->id,
                'description' => 'Why do native speakers sound like they are speaking at lightning speed? Discover the exact dropped sounds and reductions that confuse your ear.',
                'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['intermediate', 'audio-practice', 'conversations'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:01.200',
                        'end' => '00:00:05.000',
                        'text' => 'Most learners struggle not because of vocabulary, but because of acoustic reduction.',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:05.500',
                        'end' => '00:00:09.800',
                        'text' => 'Words like "going to" become "gonna", and "want to" becomes "wanna".',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:10.200',
                        'end' => '00:00:14.500',
                        'text' => 'Try listening to this dialogue once with eyes closed before reading the subtitles.',
                    ],
                ],
            ],
            [
                'title' => 'Lead Team Meetings with Confidence in Professional English',
                'slug' => 'lead-team-meetings-with-confidence-professional-english',
                'category_id' => $categories['business-workplace']->id,
                'playlist_id' => $playlists['confidant-workplace-english']->id,
                'description' => 'Master polite interruptions, steering conversation back on topic, summarizing action items, and agreeing diplomatically in corporate settings.',
                'image_url' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['advanced', 'workplace', 'vocabulary'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:01.000',
                        'end' => '00:00:04.200',
                        'text' => 'Good morning everyone, thank you for jumping on the call on short notice.',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:04.800',
                        'end' => '00:00:08.500',
                        'text' => 'The main objective of today is meeting is to align on the quarterly roadmap.',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:09.000',
                        'end' => '00:00:13.200',
                        'text' => 'If anyone wants to chime in, please feel free to raise your hand in the chat.',
                    ],
                    [
                        'index' => 4,
                        'start' => '00:00:13.800',
                        'end' => '00:00:17.500',
                        'text' => 'Let us wrap up with clear action items and accountable owners.',
                    ],
                ],
            ],
            [
                'title' => '20 Must-Know English Idioms Used in Real Conversations',
                'slug' => '20-must-know-english-idioms-real-conversations',
                'category_id' => $categories['idioms-phrasal-verbs']->id,
                'playlist_id' => $playlists['natural-conversations-bootcamp']->id,
                'description' => 'Learn vivid idioms like "bite the bullet", "cut corners", "hit the nail on the head", and how native speakers actually weave them into dialogue.',
                'image_url' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['intermediate', 'vocabulary', 'conversations'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:01.000',
                        'end' => '00:00:04.500',
                        'text' => 'Idioms carry emotional color and subtle humor in conversation.',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:05.000',
                        'end' => '00:00:09.000',
                        'text' => 'When someone says "let us call it a day", it means it is time to finish working.',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:09.500',
                        'end' => '00:00:13.000',
                        'text' => 'Practice using this idiom at the end of your study sessions!',
                    ],
                ],
            ],
            [
                'title' => 'The Shadowing Technique: Master English Fluency in 15 Minutes a Day',
                'slug' => 'the-shadowing-technique-master-english-fluency',
                'category_id' => $categories['listening-practice']->id,
                'playlist_id' => $playlists['fast-english-ear-training']->id,
                'description' => 'The number one scientifically backed method polyglots use to train ear-to-mouth coordination and develop an instinctive feel for English sentence structures.',
                'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'audio_url' => null,
                'file_url' => null,
                'is_public' => true,
                'tags' => ['shadowing', 'audio-practice', 'beginner'],
                'body' => [
                    [
                        'index' => 1,
                        'start' => '00:00:01.000',
                        'end' => '00:00:04.800',
                        'text' => 'Shadowing means repeating words immediately as you hear them, like an echo.',
                    ],
                    [
                        'index' => 2,
                        'start' => '00:00:05.200',
                        'end' => '00:00:09.000',
                        'text' => 'Do not wait for the sentence to finish. Speak along with the speaker.',
                    ],
                    [
                        'index' => 3,
                        'start' => '00:00:09.500',
                        'end' => '00:00:14.000',
                        'text' => 'This forces your mouth muscles to adapt to English stress patterns.',
                    ],
                ],
            ],
        ];

        foreach ($lessonsData as $item) {
            $tagSlugs = $item['tags'];
            unset($item['tags']);

            $lesson = Lesson::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            // Attach tags
            $tagIds = [];
            foreach ($tagSlugs as $slug) {
                if (isset($tags[$slug])) {
                    $tagIds[] = $tags[$slug]->id;
                }
            }
            if (!empty($tagIds)) {
                $lesson->tags()->sync($tagIds);
            }
        }
    }
}
