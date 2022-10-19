@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="pt-3">
        <div class="container">
            <div class="row pb-3">
                <div class="col">
                    <button class="btn btn-dark w-100" type="button" data-bs-toggle="collapse"
                            data-bs-target="#dotabuff" aria-expanded="false" aria-controls="dotabuff">
                        Dotabuff
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#stratz"
                            aria-expanded="false" aria-controls="stratz">
                        Stratz
                    </button>
                </div>
            </div>
            <div class="collapse show" id="dotabuff">
                <div class="row">
                    <div class="col">
                        <div class="h4 text-light mb-3 d-flex justify-content-between align-items-center">
                            <div>Team Dire</div>
                            <div style="color: rgba(0,126,118,1); font-size: 12px">DOTABUFF</div>
                        </div>
                        @foreach($teamsDataDotabuff['dire']['heroes'] as $key => $direHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            <div class="px-2">
                                                @if($direHero['points'] <= 1)
                                                    TOTAL <span class="text-danger"> {{ $direHero['points'] }}</span>
                                                @elseif($direHero['points'] > 1 and $direHero['points'] < 3)
                                                    TOTAL <span class="text-warning"> {{ $direHero['points'] }}</span>
                                                @elseif($direHero['points'] >= 3)
                                                    TOTAL <span class="text-success"> {{ $direHero['points'] }}</span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($direHero['powerPoints'] <= 0)
                                                    POWER <span class="text-danger"> {{ $direHero['powerPoints'] }} </span>
                                                @elseif($direHero['powerPoints'] > 0 and $direHero['powerPoints'] < 3)
                                                    POWER <span class="text-warning"> {{ $direHero['powerPoints'] }} </span>
                                                @elseif($direHero['powerPoints'] >= 3)
                                                    POWER <span
                                                        class="text-success"> {{ $direHero['powerPoints'] }} </span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($direHero['weakPoints'] < -8)
                                                    WEAK <span class="text-danger"> {{ $direHero['weakPoints'] }} </span>
                                                @elseif($direHero['weakPoints'] <= -2 and $direHero['weakPoints'] >= -8)
                                                    WEAK <span class="text-warning"> {{ $direHero['weakPoints'] }} </span>
                                                @elseif($direHero['weakPoints'] >= -2)
                                                    WEAK <span class="text-success"> {{ $direHero['weakPoints'] }} </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($direHero['farm'] < 400)
                                                        FARM <span class="text-danger"> {{ $direHero['farm'] }} </span>
                                                    @elseif($direHero['farm'] >= 400 and $direHero['farm'] <= 500)
                                                        FARM <span
                                                            class="text-warning"> {{ $direHero['farm'] }} </span>
                                                    @elseif($direHero['farm'] > 500)
                                                        FARM <span
                                                            class="text-success"> {{ $direHero['farm'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($direHero['heroDamage'] < 500)
                                                        HERO DAMAGE <span
                                                            class="text-danger"> {{ $direHero['heroDamage'] }} </span>
                                                    @elseif($direHero['heroDamage'] >= 500 and $direHero['heroDamage'] <= 700)
                                                        HERO DAMAGE <span
                                                            class="text-warning"> {{ $direHero['heroDamage'] }} </span>
                                                    @elseif($direHero['heroDamage'] > 700)
                                                        HERO DAMAGE <span
                                                            class="text-success"> {{ $direHero['heroDamage'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($direHero['towerDamage'] < 80)
                                                        TOWER DAMAGE <span
                                                            class="text-danger"> {{ $direHero['towerDamage'] }} </span>
                                                    @elseif($direHero['towerDamage'] >= 80 and $direHero['towerDamage'] <= 120)
                                                        TOWER DAMAGE <span
                                                            class="text-warning"> {{ $direHero['towerDamage'] }} </span>
                                                    @elseif($direHero['towerDamage'] > 120)
                                                        TOWER DAMAGE <span
                                                            class="text-success"> {{ $direHero['towerDamage'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($direHero['counterPicks']))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($direHero['counterPicks'] as $heroName => $percent)
                                                        <div class="d-flex align-items-center rounded bg-danger me-3">
                                                            <img class="rounded-start"
                                                                 src="/images/heroes/{{ $heroName }}.jpg"
                                                                 alt="" width="50px">
                                                            <div class="px-3">
                                                                {{ $percent }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <div class="h4 text-light mb-3 d-flex justify-content-between align-items-center">
                            <div>Team Radiant</div>
                            <div style="color: rgba(0,126,118,1); font-size: 12px">DOTABUFF</div>
                        </div>
                        @foreach($teamsDataDotabuff['radiant']['heroes'] as $key => $radiantHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex  justify-content-start text-light flex-wrap">
                                            <div class="px-2">
                                                @if($radiantHero['points'] <= 1)
                                                    TOTAL <span class="text-danger"> {{ $radiantHero['points'] }}</span>
                                                @elseif($radiantHero['points'] > 1 and $radiantHero['points'] < 3)
                                                    TOTAL <span class="text-warning"> {{ $radiantHero['points'] }}</span>
                                                @elseif($radiantHero['points'] >= 3)
                                                    TOTAL <span class="text-success"> {{ $radiantHero['points'] }}</span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($radiantHero['powerPoints'] <= 0)
                                                    POWER <span
                                                        class="text-danger"> {{ $radiantHero['powerPoints'] }} </span>
                                                @elseif($radiantHero['powerPoints'] > 0 and $radiantHero['powerPoints'] < 3)
                                                    POWER <span
                                                        class="text-warning"> {{ $radiantHero['powerPoints'] }} </span>
                                                @elseif($radiantHero['powerPoints'] >= 3)
                                                    POWER <span
                                                        class="text-success"> {{ $radiantHero['powerPoints'] }} </span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($radiantHero['weakPoints'] < -8)
                                                    WEAK <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>
                                                @elseif($radiantHero['weakPoints'] <= -2 and $radiantHero['weakPoints'] >= -8)
                                                    WEAK <span class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>
                                                @elseif($radiantHero['weakPoints'] >= -2)
                                                    WEAK <span class="text-success"> {{ $radiantHero['weakPoints'] }} </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($radiantHero['farm'] < 400)
                                                        FARM <span class="text-danger"> {{ $radiantHero['farm'] }} </span>
                                                    @elseif($radiantHero['farm'] >= 400 and $radiantHero['farm'] <= 500)
                                                        FARM <span
                                                            class="text-warning"> {{ $radiantHero['farm'] }} </span>
                                                    @elseif($radiantHero['farm'] > 500)
                                                        FARM <span
                                                            class="text-success"> {{ $radiantHero['farm'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($radiantHero['heroDamage'] < 500)
                                                        HERO DAMAGE <span
                                                            class="text-danger"> {{ $radiantHero['heroDamage'] }} </span>
                                                    @elseif($radiantHero['heroDamage'] >= 500 and $radiantHero['heroDamage'] <= 700)
                                                        HERO DAMAGE <span
                                                            class="text-warning"> {{ $radiantHero['heroDamage'] }} </span>
                                                    @elseif($radiantHero['heroDamage'] > 700)
                                                        HERO DAMAGE <span
                                                            class="text-success"> {{ $radiantHero['heroDamage'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($radiantHero['towerDamage'] < 80)
                                                        TOWER DAMAGE <span
                                                            class="text-danger"> {{ $radiantHero['towerDamage'] }} </span>
                                                    @elseif($radiantHero['towerDamage'] >= 80 and $radiantHero['towerDamage'] <= 120)
                                                        TOWER DAMAGE <span
                                                            class="text-warning"> {{ $radiantHero['towerDamage'] }} </span>
                                                    @elseif($radiantHero['towerDamage'] > 120)
                                                        TOWER DAMAGE <span
                                                            class="text-success"> {{ $radiantHero['towerDamage'] }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($radiantHero['counterPicks']))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($radiantHero['counterPicks'] as $heroName => $percent)
                                                        <div class="d-flex align-items-center rounded bg-danger me-3">
                                                            <img class="rounded-start"
                                                                 src="/images/heroes/{{ $heroName }}.jpg" alt=""
                                                                 width="50px">
                                                            <div class="px-3">
                                                                {{ $percent }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                TOTAL {{ $teamsDataDotabuff['dire']['points'] }}
                            </div>
                            <div class="pe-3">
                                WEAK {{ $teamsDataDotabuff['dire']['weak'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                TOTAL {{ $teamsDataDotabuff['radiant']['points'] }}
                            </div>
                            <div>
                                WEAK {{ $teamsDataDotabuff['radiant']['weak'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                @if($teamsDataDotabuff['dire']['towerDamage'] < 200)
                                    TOWER DAMAGE <span
                                        class="text-danger"> {{ $teamsDataDotabuff['radiant']['towerDamage'] }} </span>
                                @elseif($teamsDataDotabuff['dire']['towerDamage'] >= 200 and $teamsDataDotabuff['dire']['towerDamage'] <= 300)
                                    TOWER DAMAGE <span
                                        class="text-warning"> {{ $teamsDataDotabuff['dire']['towerDamage'] }} </span>
                                @elseif($teamsDataDotabuff['dire']['towerDamage'] > 300)
                                    TOWER DAMAGE <span
                                        class="text-success"> {{ $teamsDataDotabuff['dire']['towerDamage'] }} </span>
                                @endif
                            </div>
                            <div class="pe-3">
                                HERO DAMAGE {{ $teamsDataDotabuff['dire']['heroDamage'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                @if($teamsDataDotabuff['radiant']['towerDamage'] < 200)
                                    TOWER DAMAGE <span
                                        class="text-danger"> {{ $teamsDataDotabuff['radiant']['towerDamage'] }} </span>
                                @elseif($teamsDataDotabuff['radiant']['towerDamage'] >= 200 and $teamsDataDotabuff['radiant']['towerDamage'] <= 300)
                                    TOWER DAMAGE <span
                                        class="text-warning"> {{ $teamsDataDotabuff['radiant']['towerDamage'] }} </span>
                                @elseif($teamsDataDotabuff['radiant']['towerDamage'] > 300)
                                    TOWER DAMAGE <span
                                        class="text-success"> {{ $teamsDataDotabuff['radiant']['towerDamage'] }} </span>
                                @endif
                            </div>
                            <div class="pe-3">
                                HERO DAMAGE {{ $teamsDataDotabuff['radiant']['heroDamage'] }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="collapse" id="stratz">
                <div class="row">
                    <div class="col">
                        <div class="h4 text-light mb-3">Team Dire</div>
                        @foreach($teamsData['dire']['heroes'] as $key => $direHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-grow-1 justify-content-around text-light flex-wrap">
                                        <div class="">
                                            @if($direHero['points'] <= 1)
                                                TOTAL <span class="text-danger"> {{ $direHero['points'] }}</span>
                                            @elseif($direHero['points'] > 1 and $direHero['points'] < 3)
                                                TOTAL <span class="text-warning"> {{ $direHero['points'] }}</span>
                                            @elseif($direHero['points'] >= 3)
                                                TOTAL <span class="text-success"> {{ $direHero['points'] }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($direHero['powerPoints'] <= 0)
                                                POWER <span class="text-danger"> {{ $direHero['powerPoints'] }} </span>
                                            @elseif($direHero['powerPoints'] > 0 and $direHero['powerPoints'] < 3)
                                                POWER <span class="text-warning"> {{ $direHero['powerPoints'] }} </span>
                                            @elseif($direHero['powerPoints'] >= 3)
                                                POWER <span
                                                    class="text-success"> {{ $direHero['powerPoints'] }} </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($direHero['weakPoints'] < 0)
                                                WEAK <span class="text-danger"> {{ $direHero['weakPoints'] }} </span>
                                            @elseif($direHero['weakPoints'] >= 0 and $direHero['weakPoints'] <= 3)
                                                WEAK <span class="text-warning"> {{ $direHero['weakPoints'] }} </span>
                                            @elseif($direHero['weakPoints'] >= 3)
                                                WEAK <span class="text-success"> {{ $direHero['weakPoints'] }} </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($direHero['heroSynergy'] <= 0)
                                                SYNERGY <span
                                                    class="text-danger"> {{ $direHero['heroSynergy'] }} </span>
                                            @elseif($direHero['heroSynergy'] > 0 and $direHero['heroSynergy'] < 3)
                                                SYNERGY <span
                                                    class="text-warning"> {{ $direHero['heroSynergy'] }} </span>
                                            @elseif($direHero['heroSynergy'] >= 3)
                                                SYNERGY <span
                                                    class="text-success"> {{ $direHero['heroSynergy'] }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(count($direHero['counterPicks']))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($direHero['counterPicks'] as $heroName => $percent)
                                                        <div class="d-flex align-items-center rounded bg-danger me-3">
                                                            <img class="rounded-start"
                                                                 src="/images/heroes/{{ $heroName }}.jpg"
                                                                 alt="" width="50px">
                                                            <div class="px-3">
                                                                {{ $percent }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <div class="h4 text-white mb-3">Team Radiant</div>
                        @foreach($teamsData['radiant']['heroes'] as $key => $radiantHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-grow-1 justify-content-around text-light flex-wrap">
                                        <div class="">
                                            @if($radiantHero['points'] <= 0)
                                                TOTAL <span class="text-danger"> {{ $radiantHero['points'] }}</span>
                                            @elseif($radiantHero['points'] > 0 and $radiantHero['points'] < 3)
                                                TOTAL <span class="text-warning"> {{ $radiantHero['points'] }}</span>
                                            @elseif($radiantHero['points'] >= 3)
                                                TOTAL <span class="text-success"> {{ $radiantHero['points'] }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($radiantHero['powerPoints'] <= 0)
                                                POWER <span
                                                    class="text-danger"> {{ $radiantHero['powerPoints'] }} </span>
                                            @elseif($radiantHero['powerPoints'] > 0 and $radiantHero['powerPoints'] < 3)
                                                POWER <span
                                                    class="text-warning"> {{ $radiantHero['powerPoints'] }} </span>
                                            @elseif($radiantHero['powerPoints'] >= 3)
                                                POWER <span
                                                    class="text-success"> {{ $radiantHero['powerPoints'] }} </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($radiantHero['weakPoints'] < 0)
                                                WEAK <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>
                                            @elseif($radiantHero['weakPoints'] >= 0 and $radiantHero['weakPoints'] <= 3)
                                                WEAK <span
                                                    class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>
                                            @elseif($radiantHero['weakPoints'] >= 3)
                                                WEAK <span
                                                    class="text-success"> {{ $radiantHero['weakPoints'] }} </span>
                                            @endif
                                        </div>
                                        <div>
                                            <div>
                                                @if($radiantHero['heroSynergy'] <= 0)
                                                    SYNERGY <span
                                                        class="text-danger"> {{ $radiantHero['heroSynergy'] }} </span>
                                                @elseif($radiantHero['heroSynergy'] > 0 and $radiantHero['heroSynergy'] < 3)
                                                    SYNERGY <span
                                                        class="text-warning"> {{ $radiantHero['heroSynergy'] }} </span>
                                                @elseif($radiantHero['heroSynergy'] > 3)
                                                    SYNERGY <span
                                                        class="text-success"> {{ $radiantHero['heroSynergy'] }} </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($radiantHero['counterPicks']))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($radiantHero['counterPicks'] as $heroName => $percent)
                                                        <div class="d-flex align-items-center rounded bg-danger me-3">
                                                            <img class="rounded-start"
                                                                 src="/images/heroes/{{ $heroName }}.jpg" alt=""
                                                                 width="50px">
                                                            <div class="px-3">
                                                                {{ $percent }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col">
                        <div class="rounded-1 text-light p-3 d-flex justify-content-start"
                             style="background-color: rgba(0,126,118,1);">
                            <div>
                                TOTAL {{ $teamsData['dire']['points'] }}
                            </div>
                            <div>
                                WEAK {{ $teamsData['dire']['weak'] }}
                            </div>
                            <div>
                                SYNERGY {{ $teamsData['dire']['synergy'] }}
                            </div>
                            <div>
                                STRATZ
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="rounded-1 text-light p-3 d-flex justify-content-start"
                             style="background-color: rgba(0,126,118,1);">
                            <div>
                                TOTAL {{ $teamsData['radiant']['points'] }}
                            </div>
                            <div>
                                WEAK {{ $teamsData['radiant']['weak'] }}
                            </div>
                            <div>
                                SYNERGY {{ $teamsData['radiant']['synergy'] }}
                            </div>
                            <div>
                                STRATZ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


