<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

/**
 * Drafts the first two case studies. Only fills fields that are still empty,
 * so edits made in the admin panel are never overwritten. Review the copy before publishing.
 */
class PortfolioCaseStudySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->caseStudies() as $slug => $fields) {
            $portfolio = Portfolio::where('slug', $slug)->first();
            if (!$portfolio) {
                $this->command?->warn("Portfolio not found: {$slug}");
                continue;
            }

            $updates = [];
            foreach ($fields as $field => $value) {
                if (blank($portfolio->getRawOriginal($field)) || ($field === 'project_type' && $portfolio->project_type === 'ict')) {
                    $updates[$field] = $value;
                }
            }

            $portfolio->update($updates);
            $this->command?->info("Updated {$slug}: " . implode(', ', array_keys($updates)));
        }
    }

    private function caseStudies(): array
    {
        return [
            'official-commissioning-of-the-uvtab-assessment-centre' => [
                'project_type' => 'multimedia',
                'highlights' => [
                    ['value' => 'UGX 28bn', 'label' => 'National infrastructure investment commissioned'],
                    ['value' => 'Live', 'label' => 'Broadcast to audiences beyond the venue'],
                    ['value' => 'First Lady', 'label' => 'Commissioned by the First Lady of Uganda'],
                ],
                'challenge' => "The commissioning of the new UVTAB Assessment Centre, now the institution's permanent headquarters, was a one-time, high-profile event attended by government officials, sector leaders and stakeholders.\nThere was no second take: the ceremony had to be broadcast in real time to audiences beyond the venue, at broadcast-grade quality and with full operational reliability.",
                'solution' => "ByteWave Investments was entrusted with the technical production and live broadcast of the event.\nWe planned the technical setup ahead of the day, then produced and streamed the ceremony live, capturing the significance of the occasion with clarity and precision.",
                'process_steps' => [
                    ['title' => 'Pre-event technical planning', 'description' => "- Assessed the venue and the broadcast requirements\n- Planned the production and streaming setup for a high-stakes, live-only event"],
                    ['title' => 'Live production', 'description' => "- Produced the ceremony in real time at broadcast-grade quality\n- Covered the key moments of the commissioning for the audience"],
                    ['title' => 'Livestream delivery', 'description' => "- Delivered the stream to national and remote audiences in real time\n- Kept the broadcast reliable throughout the event"],
                    ['title' => 'Documentation', 'description' => 'The commissioning ceremony was documented, accessible and professionally presented for the record.'],
                ],
                'results' => "A seamless livestream of the commissioning, giving national and remote audiences real-time access to the ceremony.\nThe event was documented and professionally presented, reinforcing ByteWave as a trusted partner for institutional, government and nationally significant events.",
            ],

            'hesfb-8-years-magazine' => [
                'project_type' => 'multimedia',
                'highlights' => [
                    ['value' => '8 years', 'label' => "Of the Board's impact documented, since 2014"],
                    ['value' => '4', 'label' => 'Editorial sections: dreams, timeline, impact, reflections'],
                    ['value' => 'Print + Digital', 'label' => 'Files prepared for both formats'],
                ],
                'challenge' => "To mark eight years of the inaugural Board's service, the Higher Education Students' Financing Board (HESFB) needed a publication that turned a long record of milestones, statistics and beneficiary stories into something people would want to read.\nIt had to balance the professionalism of the administrative record with the human impact of the Students' Loan Scheme.",
                'solution' => "We designed a clean, modern magazine with a consistent visual hierarchy, bright brand colours and high-quality imagery of graduates, stakeholders and events.\nComplex data became easy-to-read infographics, and the content was organised into clear themed sections so the story flows from personal success stories to institutional results.",
                'process_steps' => [
                    ['title' => 'Editorial design and layout', 'description' => "- Designed a clean, modern layout with a consistent visual hierarchy\n- Used bright brand colours (yellow, purple and grey) to reinforce identity and optimism"],
                    ['title' => 'Content structuring', 'description' => "- Empowering Dreams: beneficiary success stories\n- Timeline: key milestones since 2014\n- HESFB Impact: statistics and performance highlights\n- Board Reflections: messages from leadership and stakeholders"],
                    ['title' => 'Infographics and data visualisation', 'description' => 'Charts, graphs and timelines that summarise eight years of impact and show the growth of the Students\' Loan Scheme in simple visuals.'],
                    ['title' => 'Photography and image editing', 'description' => 'Edited and colour-corrected photographs for uniform quality, with improved composition and contrast.'],
                    ['title' => 'Print and digital preparation', 'description' => "- Prepared final files optimised for print and digital publication\n- Created a mockup presentation for online showcase on Behance"],
                ],
                'results' => "A complete 8-year impact publication, ready for print and digital distribution, that celebrates the Board's achievements and the beneficiaries behind them, and sets out future aspirations and recommendations for the incoming leadership.",
            ],
        ];
    }
}
