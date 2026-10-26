<?php

namespace App\Support;

use App\Models\ClientService;
use Illuminate\Support\HtmlString;

/**
 * Renders the light plain-text syntax used in service / quotation / invoice
 * line descriptions into safe HTML.
 *
 *   **bold**          bold text
 *   # Heading         small sub-heading
 *   - item / • item   bullet list
 *   1. item           numbered list
 *   blank line        new paragraph
 *
 * Input is always HTML-escaped first, so stored text is never trusted as HTML.
 */
class DocText
{
    public static function render(?string $text): HtmlString
    {
        $text = trim(str_replace(["\r\n", "\r"], "\n", (string) $text));
        if ($text === '') {
            return new HtmlString('');
        }

        $html = '';
        $para = [];
        $list = null; // ['tag' => 'ul'|'ol', 'items' => []]

        $flushPara = function () use (&$html, &$para) {
            if ($para) {
                $html .= '<p>' . implode('<br>', $para) . '</p>';
                $para = [];
            }
        };
        $flushList = function () use (&$html, &$list) {
            if ($list) {
                $html .= '<' . $list['tag'] . '><li>' . implode('</li><li>', $list['items']) . '</li></' . $list['tag'] . '>';
                $list = null;
            }
        };

        foreach (explode("\n", $text) as $line) {
            $line = rtrim($line);

            if (trim($line) === '') {
                $flushPara();
                $flushList();
                continue;
            }

            if (preg_match('/^\s*(?:[-*•])\s+(.*)$/u', $line, $m)) {
                $flushPara();
                if (!$list || $list['tag'] !== 'ul') {
                    $flushList();
                    $list = ['tag' => 'ul', 'items' => []];
                }
                $list['items'][] = self::inline($m[1]);
            } elseif (preg_match('/^\s*\d+[.)]\s+(.*)$/u', $line, $m)) {
                $flushPara();
                if (!$list || $list['tag'] !== 'ol') {
                    $flushList();
                    $list = ['tag' => 'ol', 'items' => []];
                }
                $list['items'][] = self::inline($m[1]);
            } elseif (preg_match('/^\s*#{1,3}\s+(.*)$/u', $line, $m)) {
                $flushPara();
                $flushList();
                $html .= '<p class="dt-h">' . self::inline($m[1]) . '</p>';
            } else {
                $flushList();
                $para[] = self::inline(trim($line));
            }
        }

        $flushPara();
        $flushList();

        return new HtmlString($html);
    }

    /** First line of a block with markup stripped — used as a service name. */
    public static function title(?string $text): string
    {
        $text = trim((string) $text);
        $first = trim(explode("\n", $text, 2)[0]);
        $first = preg_replace('/^\s*(?:#{1,3}\s+|[-*•]\s+)/u', '', $first);

        return trim(str_replace('**', '', $first));
    }

    /** Everything after the first line. */
    public static function body(?string $text): ?string
    {
        $text = trim(str_replace(["\r\n", "\r"], "\n", (string) $text));
        $pos = strpos($text, "\n");
        $rest = $pos === false ? '' : trim(substr($text, $pos + 1));

        return $rest === '' ? null : $rest;
    }

    /** Default line description for a picked service: bold name + its detail. */
    public static function fromService(ClientService $service): string
    {
        $out = '**' . $service->name . '**';
        if (trim((string) $service->description) !== '') {
            $out .= "\n" . trim($service->description);
        }

        return $out;
    }

    private static function inline(string $s): string
    {
        $s = e($s);

        return preg_replace('/\*\*(.+?)\*\*/u', '<strong>$1</strong>', $s);
    }
}
