<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use App\Models\Dotabuff;
use App\Models\Matchup;

include 'simple_html_dom.php';


class ParseController extends Controller
{
    private static $heroes = [102 => 'abaddon', 68 => 'ancient apparition', 73 => 'alchemist', 1 => 'anti-mage', 113 => 'arc warden', 2 => 'axe',
        3 => 'bane', 65 => 'batrider', 38 => 'beastmaster', 4 => 'bloodseeker', 62 => 'bounty hunter', 78 => 'brewmaster',
        99 => 'bristleback', 61 => 'broodmother',
        96 => 'centaur warrunner', 81 => 'chaos knight', 66 => 'chen', 56 => 'clinkz', 51 => 'clockwerk',
        5 => 'crystal maiden',
        55 => 'dark seer', 119 => 'dark willow', 135 => 'dawnbreaker', 50 => 'dazzle', 43 => 'death prophet',
        87 => 'disruptor', 69 => 'doom', 49 => 'dragon knight',
        6 => 'drow ranger',
        107 => 'earth spirit', 7 => 'earthshaker', 103 => 'elder titan', 106 => 'ember spirit', 58 => 'enchantress',
        33 => 'enigma',
        41 => 'faceless void',
        121 => 'grimstroke', 72 => 'gyrocopter',
        123 => 'hoodwink', 59 => 'huskar',
        74 => 'invoker', 91 => 'io',
        64 => 'jakiro', 8 => 'juggernaut',
        90 => 'keeper of the light', 23 => 'kunkka',
        104 => 'legion commander', 52 => 'leshrac', 31 => 'lich', 54 => 'lifestealer', 25 => 'lina', 26 => 'lion',
        80 => 'lone druid', 48 => 'luna', 77 => 'lycan',
        97 => 'magnus', 136 => 'marci', 129 => 'mars', 94 => 'medusa', 82 => 'meepo', 9 => 'mirana', 114 => 'monkey king',
        10 => 'morphling',
        89 => 'naga siren', 53 => 'natures prophet', 36 => 'necrophos', 60 => 'night stalker', 88 => 'nyx assassin',
        84 => 'ogre magi', 57 => 'omniknight', 111 => 'oracle', 76 => 'outworld destroyer',
        120 => 'pangolier', 44 => 'phantom assassin', 12 => 'phantom lancer', 110 => 'phoenix', 137 => 'primal beast',
        13 => 'puck', 14 => 'pudge', 45 => 'pugna',
        39 => 'queen of pain',
        15 => 'razor', 32 => 'riki', 86 => 'rubick',
        16 => 'sand king', 79 => 'shadow demon', 11 => 'shadow fiend', 27 => 'shadow shaman', 75 => 'silencer',
        101 => 'skywrath mage', 28 => 'slardar', 93 => 'slark',
        128 => 'snapfire', 35 => 'sniper', 67 => 'spectre', 71 => 'spirit breaker', 17 => 'storm spirit', 18 => 'sven',
        105 => 'techies', 46 => 'templar assassin', 109 => 'terrorblade', 29 => 'tidehunter', 98 => 'timbersaw',
        34 => 'tinker', 19 => 'tiny', 83 => 'treant protector',
        95 => 'troll warlord', 100 => 'tusk',
        108 => 'underlord', 85 => 'undying', 70 => 'ursa',
        20 => 'vengeful spirit', 40 => 'venomancer', 47 => 'viper', 92 => 'visage', 126 => 'void spirit',
        37 => 'warlock', 63 => 'weaver', 21 => 'windranger', 112 => 'winter wyvern', 30 => 'witch doctor',
        42 => 'wraith king',
        22 => 'zeus'];

    public function dotabuff()
    {
        foreach (self::$heroes as $id => $hero) {
            $hero = str_replace(" ", "-", $hero);
            $request = curl_init("https://www.dotabuff.com/heroes/{$hero}/counters");
            $headers = [
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
            ];

            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($request, CURLOPT_HTTPHEADER, $headers);

            $html = str_get_html(curl_exec($request));
            $table = $html->find('div.content-inner', 0)->find('table', 2)->find('tbody', 0)->find('tr');

            // Перебор таблицы с героями
            foreach ($table as $item) {
                $matchupHero = mb_strtolower($item->find('td', 1)->find('a', 0)->plaintext);
                $matchupPercent = -(str_replace("%", "", $item->find('td', 2)->plaintext));

                if ($matchupHero === 'nature&#39;s prophet') {
                    $matchupHero = str_replace("&#39;", "", $matchupHero);
                }

                // Добавление значений в БД
                if ($hero !== 'anti-mage') $hero = str_replace("-", " ", $hero);
                Dotabuff::create([
                    'hero_id' => $id,
                    'hero' => $hero,
                    'matchup_hero' => $matchupHero,
                    'vs' => $matchupPercent,
                ]);
//                Matchup::where('hero', $hero)->where('matchup_hero', $matchupHero)->update(['vs' => $matchupPercent]);
            }
            // Чтобы не разозлить сайт)
            sleep(5);
        }

        curl_close($request);
    }

    public function stratz()
    {

        foreach (self::$heroes as $heroId => $hero) {
            $request = curl_init("https://api.stratz.com/graphql?query=query%7B%0A%09heroStats%7B%0A%20%20%20%20heroVsHeroMatchup(heroId%3A${heroId}%2C%20week%3A1663688170%2C%20matchLimit%3A20)%20%7B%0A%20%20%20%20%09advantage%20%7B%0A%20%20%20%20%09%20%20heroId%0A%20%20%20%20%09%20%20with%20%7B%0A%20%20%20%20%09%20%20%20%20heroId1%0A%20%20%20%20%09%20%20%20%20heroId2%0A%20%20%20%20%09%20%20%20%20matchCount%0A%20%20%20%20%09%20%20%20%20synergy%0A%20%20%20%20%09%20%20%7D%0A%20%20%20%20%20%20%20%20vs%20%7B%0A%20%20%20%20%20%20%20%20%20%20heroId1%0A%20%20%20%20%09%20%20%20%20heroId2%0A%20%20%20%20%09%20%20%20%20matchCount%0A%20%20%20%20%09%20%20%20%20synergy%0A%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%09%7D%0A%20%20%20%20%7D%0A%20%20%7D%20%0A%7D");

            $headers = [
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1laWQiOiJodHRwczovL3N0ZWFtY29tbXVuaXR5LmNvbS9vcGVuaWQvaWQvNzY1NjExOTgxNDY1MjM4MjQiLCJ1bmlxdWVfbmFtZSI6IikiLCJTdWJqZWN0IjoiZjM1MDRmYTYtMTkyZC00MTMzLWI5ZWMtNDI5NjAzOTdkMmQ2IiwiU3RlYW1JZCI6IjE4NjI1ODA5NiIsIm5iZiI6MTY2NDQzMzU3OSwiZXhwIjoxNjk1OTY5NTc5LCJpYXQiOjE2NjQ0MzM1NzksImlzcyI6Imh0dHBzOi8vYXBpLnN0cmF0ei5jb20ifQ.twAZJyrIW-0MJpFNm85Vzy32G9oEFFvu0uHl_nAZNRE'
            ];

            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($request, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($request);
            $json = (json_decode($response, true));

//            foreach ($json['data']['heroStats']['heroVsHeroMatchup']['advantage'][0]['with'] as $heroMatchup) {
//                Matchup::create([
//                    'hero_id' => $heroId,
//                    'hero' => self::$heroes[$heroId],
//                    'matchup_hero_id' => $heroMatchup['heroId2'],
//                    'matchup_hero' => self::$heroes[$heroMatchup['heroId2']],
//                    'match_count' => $heroMatchup['matchCount'],
//                    'with' => $heroMatchup['synergy'],
//                ]);
//            }

            foreach ($json['data']['heroStats']['heroVsHeroMatchup']['advantage'][0]['vs'] as $heroMatchup) {
                Matchup::where('hero_id', $heroId)->where('matchup_hero_id', $heroMatchup['heroId2'])->update(['vs' => $heroMatchup['synergy']]);
            }

            sleep(1);
        }

        curl_close($request);
    }
}
