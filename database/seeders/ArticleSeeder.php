<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = ['politics', 'technology', 'business', 'sports', 'entertainment', 'health', 'science', 'world'];
        
        // Create 20 published articles
        for ($i = 1; $i <= 20; $i++) {
            $category = $categories[array_rand($categories)];
            
            Article::create([
                'title' => $this->generateTitle($category, $i),
                'slug' => Str::slug($this->generateTitle($category, $i)),
                'excerpt' => $this->generateExcerpt($category),
                'content' => $this->generateContent($category),
                'status' => 'published',
                'category' => $category,
                'tags' => $this->generateTags($category),
                'views' => rand(100, 10000),
                'likes' => rand(10, 500),
                'author_id' => $users->random()->id,
                'published_at' => now()->subDays(rand(0, 30)),
                'created_at' => now()->subDays(rand(0, 60)),
            ]);
        }

        // Create 5 draft articles
        for ($i = 1; $i <= 5; $i++) {
            $category = $categories[array_rand($categories)];
            
            Article::create([
                'title' => "Draft: " . $this->generateTitle($category, $i),
                'slug' => Str::slug("draft-" . $this->generateTitle($category, $i)),
                'excerpt' => $this->generateExcerpt($category),
                'content' => $this->generateContent($category),
                'status' => 'draft',
                'category' => $category,
                'tags' => $this->generateTags($category),
                'views' => 0,
                'likes' => 0,
                'author_id' => $users->random()->id,
                'published_at' => null,
                'created_at' => now()->subDays(rand(0, 7)),
            ]);
        }
    }

    private function generateTitle($category, $index)
    {
        $titles = [
            'politics' => [
                'New Policy Bill Passes Senate with Bipartisan Support',
                'Global Summit Addresses Climate Change Challenges',
                'President Announces Economic Recovery Plan',
                'Election Results Spark Nationwide Discussion',
                'Diplomatic Talks Resume Between World Powers'
            ],
            'technology' => [
                'AI Breakthrough Revolutionizes Healthcare Industry',
                'Tech Giant Unveils Next-Generation Smartphone',
                'Cybersecurity Experts Warn of New Threats',
                'Startup Innovates Renewable Energy Solutions',
                'Quantum Computing Milestone Achieved'
            ],
            'business' => [
                'Stock Markets Reach Record Highs Amid Recovery',
                'Major Merger Announced in Tech Sector',
                'Small Business Grants Program Launched',
                'Global Supply Chain Issues Resolved',
                'Cryptocurrency Market Shows Volatility'
            ],
            'sports' => [
                'National Team Advances to Championship Finals',
                'Athlete Breaks World Record in Marathon',
                'Sports League Announces Expansion Plans',
                'Olympic Committee Reveals Host City',
                'Underdog Team Upsets Championship Favorites'
            ],
            'entertainment' => [
                'Award Season Kicks Off with Stellar Performances',
                'Blockbuster Film Breaks Box Office Records',
                'Music Festival Returns After Three-Year Hiatus',
                'Streaming Service Launches Original Series',
                'Celebrity Chef Opens New Restaurant Chain'
            ],
            'health' => [
                'Medical Researchers Discover New Treatment',
                'Public Health Campaign Reduces Disease Rates',
                'Hospital Implements Advanced Surgical Technology',
                'Mental Health Awareness Month Initiatives',
                'Nutrition Study Reveals Surprising Findings'
            ],
            'science' => [
                'Space Agency Launches Mission to Mars',
                'Scientists Make Breakthrough in Genetics Research',
                'Archaeologists Uncover Ancient Civilization',
                'Climate Study Predicts Future Trends',
                'Physics Experiment Confirms Theory'
            ],
            'world' => [
                'International Relief Effort Aids Disaster Victims',
                'Cultural Festival Celebrates Global Diversity',
                'UN Addresses Humanitarian Crisis',
                'Travel Industry Bounces Back Strongly',
                'Global Education Initiative Launched'
            ]
        ];

        return $titles[$category][array_rand($titles[$category])] . " - Part $index";
    }

    private function generateExcerpt($category)
    {
        $excerpts = [
            'politics' => 'Significant developments in government policy and international relations are shaping the future of global politics.',
            'technology' => 'Innovative technological advancements are transforming industries and changing the way we live and work.',
            'business' => 'Economic trends and market movements are creating new opportunities for investors and entrepreneurs alike.',
            'sports' => 'Exciting athletic competitions and remarkable achievements are capturing the attention of sports fans worldwide.',
            'entertainment' => 'Captivating performances and creative productions are entertaining audiences across various media platforms.',
            'health' => 'Important medical discoveries and healthcare initiatives are improving lives and promoting wellbeing.',
            'science' => 'Groundbreaking scientific research is expanding our understanding of the universe and our place within it.',
            'world' => 'Global events and international collaborations are highlighting our interconnected world and shared humanity.'
        ];

        return $excerpts[$category];
    }

    private function generateContent($category)
    {
        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $contents = [
            'politics' => "<p>In a significant development that has captured national attention, policymakers have reached a consensus on critical legislation. The decision comes after months of deliberation and represents a major step forward in addressing pressing social issues.</p><p>$lorem $lorem</p><p>Experts believe this move will have far-reaching implications for the country's future direction and international standing.</p>",
            'technology' => "<p>The technology sector continues to innovate at an unprecedented pace, with recent breakthroughs promising to reshape entire industries. From artificial intelligence to renewable energy, advancements are occurring across multiple fronts.</p><p>$lorem $lorem</p><p>Industry leaders emphasize the importance of responsible development and ethical considerations in deploying these new technologies.</p>",
            'business' => "<p>Economic indicators suggest a period of sustained growth and opportunity for businesses of all sizes. Market analysts point to several factors contributing to this positive outlook, including consumer confidence and technological innovation.</p><p>$lorem $lorem</p><p>Entrepreneurs and investors alike are watching these developments closely, seeking to capitalize on emerging opportunities.</p>",
            'sports' => "<p>The sports world is buzzing with excitement following a series of remarkable achievements and competitive events. Athletes continue to push the boundaries of human performance, setting new records and inspiring fans globally.</p><p>$lorem $lorem</p><p>These developments highlight not only athletic excellence but also the important role sports play in community building and cultural exchange.</p>",
            'entertainment' => "<p>Creative expression continues to thrive across various entertainment mediums, with artists and performers finding new ways to connect with audiences. From film and music to digital content, the industry is evolving rapidly.</p><p>$lorem $lorem</p><p>These artistic endeavors provide not only entertainment but also important commentary on contemporary society and human experience.</p>",
            'health' => "<p>Medical research and healthcare innovation are making significant strides in improving patient outcomes and public health. Recent studies and technological advancements are opening new possibilities for treatment and prevention.</p><p>$lorem $lorem</p><p>These developments underscore the importance of continued investment in healthcare infrastructure and medical research.</p>",
            'science' => "<p>Scientific discovery continues to expand our understanding of the natural world and the universe beyond. Researchers across disciplines are making breakthroughs that challenge previous assumptions and open new avenues of inquiry.</p><p>$lorem $lorem</p><p>These advancements highlight the importance of scientific literacy and continued support for research institutions.</p>",
            'world' => "<p>Global interconnectedness is increasingly evident as nations collaborate on shared challenges and opportunities. From climate action to economic cooperation, international efforts are shaping our collective future.</p><p>$lorem $lorem</p><p>These developments remind us of our shared humanity and the importance of cross-cultural understanding and cooperation.</p>"
        ];

        return $contents[$category];
    }

    private function generateTags($category)
    {
        $tagsByCategory = [
            'politics' => ['government', 'policy', 'election', 'diplomacy', 'legislation'],
            'technology' => ['innovation', 'ai', 'digital', 'startup', 'future'],
            'business' => ['economy', 'finance', 'market', 'investment', 'entrepreneurship'],
            'sports' => ['athletics', 'competition', 'team', 'championship', 'performance'],
            'entertainment' => ['arts', 'culture', 'media', 'performance', 'creativity'],
            'health' => ['medicine', 'wellness', 'research', 'treatment', 'prevention'],
            'science' => ['research', 'discovery', 'experiment', 'theory', 'innovation'],
            'world' => ['global', 'international', 'culture', 'cooperation', 'diversity']
        ];

        return $tagsByCategory[$category];
    }
}