<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Landing page content
    |--------------------------------------------------------------------------
    |
    | Placeholder content for the channel-powered landing page. Replace these
    | arrays with published videos and playlists when the YouTube sync is
    | connected. Every value is passed through __() in the views.
    |
    */

    'videos' => [
        [
            'title' => 'Small Talk That Sounds Natural',
            'description' => 'Learn the everyday phrases native speakers use when they meet someone new.',
            'topic' => 'Everyday English',
            'level' => 'Beginner',
            'duration' => '12:45',
            'youtube_id' => null,
            'poster' => 'poster-brand',
        ],
        [
            'title' => 'Stop Sounding Like a Textbook',
            'description' => 'Swap stiff sentences for the relaxed rhythm real conversations are built on.',
            'topic' => 'Pronunciation',
            'level' => 'Intermediate',
            'duration' => '18:20',
            'youtube_id' => null,
            'poster' => 'poster-sky',
        ],
        [
            'title' => 'The Listening Trick Every Learner Misses',
            'description' => 'Train your ear to catch fast speech without translating every single word.',
            'topic' => 'Listening',
            'level' => 'Upper Intermediate',
            'duration' => '15:32',
            'youtube_id' => null,
            'poster' => 'poster-indigo',
        ],
        [
            'title' => 'Meetings in English, Made Simple',
            'description' => 'The exact expressions you need to sound clear and confident at work.',
            'topic' => 'Business English',
            'level' => 'Intermediate',
            'duration' => '21:08',
            'youtube_id' => null,
            'poster' => 'poster-ocean',
        ],
        [
            'title' => 'Master the Art of Shadowing',
            'description' => 'Listen, repeat, and absorb natural intonation one sentence at a time.',
            'topic' => 'Speaking',
            'level' => 'All Levels',
            'duration' => '09:54',
            'youtube_id' => null,
            'poster' => 'poster-brand',
        ],
        [
            'title' => 'IELTS Listening: Hear the Keywords',
            'description' => 'A focused breakdown of the signals examiners hide in plain sight.',
            'topic' => 'Exam Prep',
            'level' => 'Advanced',
            'duration' => '24:16',
            'youtube_id' => null,
            'poster' => 'poster-sky',
        ],
    ],

    'playlists' => [
        [
            'title' => 'English for Everyday Life',
            'description' => 'Real-world conversations for shops, travel, and the little moments in between.',
            'count' => '24 lessons',
            'poster' => 'poster-brand',
        ],
        [
            'title' => 'Business English Essentials',
            'description' => 'Emails, meetings, and interviews with language that actually gets used.',
            'count' => '18 lessons',
            'poster' => 'poster-ocean',
        ],
        [
            'title' => 'Listening Lab',
            'description' => 'Slow, clear breakdowns of authentic speech from our newest uploads.',
            'count' => '31 lessons',
            'poster' => 'poster-indigo',
        ],
    ],
];
