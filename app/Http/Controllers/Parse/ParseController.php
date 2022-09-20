<?php

namespace App\Http\Controllers\Parse;

use App\Http\Controllers\Controller;
use App\Models\Matchup;
include 'simple_html_dom.php';

class ParseController extends Controller
{
    public function matchups() {
        $heroes = [
            'abaddon', 'ancient-apparition', 'alchemist', 'anti-mage', 'arc-warden', 'axe',
            'bane', 'batrider', 'beastmaster', 'bloodseeker', 'bounty-hunter', 'brewmaster', 'bristleback', 'broodmother',
            'centaur-warrunner', 'chaos-knight', 'chen', 'clinkz', 'clockwerk', 'crystal-maiden',
            'dark-seer', 'dark-willow', 'dawnbreaker', 'dazzle', 'death-prophet', 'disruptor', 'doom', 'dragon-knight',
            'drow-ranger',
            'earth-spirit', 'earthshaker', 'elder-titan', 'ember-spirit', 'enchantress', 'enigma',
            'faceless-void',
            'grimstroke', 'gyrocopter',
            'hoodwink', 'huskar',
            'invoker', 'io',
            'jakiro', 'juggernaut',
            'keeper-of-the-light', 'kunkka',
            'legion-commander', 'leshrac', 'lich', 'lifestealer', 'lina', 'lion', 'lone-druid', 'luna', 'lycan',
            'magnus', 'marci', 'mars', 'medusa', 'meepo', 'mirana', 'monkey-king', 'morphling',
            'naga-siren', 'natures-prophet', 'necrophos', 'night-stalker', 'nyx-assassin',
            'ogre-magi', 'omniknight', 'oracle', 'outworld-destroyer',
            'pangolier', 'phantom-assassin', 'phantom-lancer', 'phoenix', 'primal-beast', 'puck', 'pudge', 'pugna',
            'queen-of-pain',
            'razor', 'riki', 'rubick',
            'sand-king', 'shadow-demon', 'shadow-fiend', 'shadow-shaman', 'silencer', 'skywrath-mage', 'slardar', 'slark',
            'snapfire', 'sniper', 'spectre', 'spirit-breaker', 'storm-spirit', 'sven',
            'techies', 'templar-assassin', 'terrorblade', 'tidehunter', 'timbersaw', 'tinker', 'tiny', 'treant-protector',
            'troll-warlord', 'tusk',
            'underlord', 'undying', 'ursa',
            'vengeful-spirit', 'venomancer', 'viper', 'visage', 'void-spirit',
            'warlock', 'weaver', 'windranger', 'winter-wyvern', 'witch-doctor', 'wraith-king',
            'zeus',
        ];

        foreach ($heroes as $hero) {
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
                $heroName = mb_strtolower($item->find('td', 1)->find('a', 0)->plaintext);
                $matchupPercent = str_replace("%", "", $item->find('td', 2)->plaintext);

                if ($hero == 'anti-mage') {
                    $correctHeroName = $hero;
                } else {
                    $correctHeroName = str_replace("-", " ", $hero);
                }

                // Добавление значений в БД
                Matchup::create([
                    'hero' => $correctHeroName,
                    'matchup_hero' => $heroName,
                    'percent' => $matchupPercent,
                ]);
            }

            // Чтобы не разозлить сайт)
            sleep(8);
        }
    }
}
