@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="pt-3">
        <div class="container">
            <div class="" id="dotabuff">
                <div class="row">
                    <div class="col">
                        <div class="h4 text-light mb-3 d-flex justify-content-between align-items-center">
                            <div>Team Dire</div>
                            <div style="color: rgba(0,126,118,1); font-size: 12px">DOTABUFF</div>
                        </div>
                        @foreach($direTeam->heroes as $direHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $direHero->name }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            <div class="px-2">
                                                @if($direHero->points <= 1)
                                                    TOTAL <span class="text-danger"> {{ $direHero->points }}</span>
                                                @elseif($direHero->points > 1 and $direHero->points < 3)
                                                    TOTAL <span class="text-warning"> {{ $direHero->points }}</span>
                                                @elseif($direHero->points >= 3)
                                                    TOTAL <span class="text-success"> {{ $direHero->points }}</span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($direHero->power <= 0)
                                                    POWER <span class="text-danger"> {{ $direHero->power }} </span>
                                                @elseif($direHero->power > 0 and $direHero->power < 3)
                                                    POWER <span class="text-warning"> {{ $direHero->power }} </span>
                                                @elseif($direHero->power >= 3)
                                                    POWER <span
                                                        class="text-success"> {{ $direHero->power }} </span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($direHero->weak < -8)
                                                    WEAK <span class="text-danger"> {{ $direHero->weak }} </span>
                                                @elseif($direHero->weak <= -2 and $direHero->weak >= -8)
                                                    WEAK <span class="text-warning"> {{ $direHero->weak }} </span>
                                                @elseif($direHero->weak >= -2)
                                                    WEAK <span class="text-success"> {{ $direHero->weak }} </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start text-light flex-wrap">
{{--                                            <div class="d-flex text-light">--}}
{{--                                                <div class="px-2">--}}
{{--                                                    @if($direHero['farm'] < 400)--}}
{{--                                                        FARM <span class="text-danger"> {{ $direHero['farm'] }} </span>--}}
{{--                                                    @elseif($direHero['farm'] >= 400 and $direHero['farm'] <= 500)--}}
{{--                                                        FARM <span--}}
{{--                                                            class="text-warning"> {{ $direHero['farm'] }} </span>--}}
{{--                                                    @elseif($direHero['farm'] > 500)--}}
{{--                                                        FARM <span--}}
{{--                                                            class="text-success"> {{ $direHero['farm'] }} </span>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($direHero->heroDamage < 500)
                                                        HERO DAMAGE <span
                                                            class="text-danger"> {{ $direHero->heroDamage }} </span>
                                                    @elseif($direHero->heroDamage >= 500 and $direHero->heroDamage <= 700)
                                                        HERO DAMAGE <span
                                                            class="text-warning"> {{ $direHero->heroDamage }} </span>
                                                    @elseif($direHero->heroDamage > 700)
                                                        HERO DAMAGE <span
                                                            class="text-success"> {{ $direHero->heroDamage }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($direHero->towerDamage < 80)
                                                        TOWER DAMAGE <span
                                                            class="text-danger"> {{ $direHero->towerDamage }} </span>
                                                    @elseif($direHero->towerDamage >= 80 and $direHero->towerDamage <= 120)
                                                        TOWER DAMAGE <span
                                                            class="text-warning"> {{ $direHero->towerDamage }} </span>
                                                    @elseif($direHero->towerDamage > 120)
                                                        TOWER DAMAGE <span
                                                            class="text-success"> {{ $direHero->towerDamage }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($direHero->counterPicks))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($direHero->counterPicks as $heroName => $percent)
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
                        @foreach($radiantTeam->heroes as $radiantHero)
                            <div class="bg-dark rounded-1 mb-3">
                                <div class="d-flex align-items-center p-3">
                                    <div>
                                        <img class="rounded-1" src="/images/heroes/{{ $radiantHero->name }}.jpg" alt="" width="100px">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            <div class="px-2">
                                                @if($radiantHero->points <= 1)
                                                    TOTAL <span class="text-danger"> {{ $radiantHero->points }}</span>
                                                @elseif($radiantHero->points > 1 and $radiantHero->points < 3)
                                                    TOTAL <span class="text-warning"> {{ $radiantHero->points }}</span>
                                                @elseif($radiantHero->points >= 3)
                                                    TOTAL <span class="text-success"> {{ $radiantHero->points }}</span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($radiantHero->power <= 0)
                                                    POWER <span class="text-danger"> {{ $radiantHero->power }} </span>
                                                @elseif($radiantHero->power > 0 and $radiantHero->power < 3)
                                                    POWER <span class="text-warning"> {{ $radiantHero->power }} </span>
                                                @elseif($radiantHero->power >= 3)
                                                    POWER <span
                                                        class="text-success"> {{ $radiantHero->power }} </span>
                                                @endif
                                            </div>
                                            <div class="px-2">
                                                @if($radiantHero->weak < -8)
                                                    WEAK <span class="text-danger"> {{ $radiantHero->weak }} </span>
                                                @elseif($radiantHero->weak <= -2 and $radiantHero->weak >= -8)
                                                    WEAK <span class="text-warning"> {{ $radiantHero->weak }} </span>
                                                @elseif($radiantHero->weak >= -2)
                                                    WEAK <span class="text-success"> {{ $radiantHero->weak }} </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start text-light flex-wrap">
                                            {{--                                            <div class="d-flex text-light">--}}
                                            {{--                                                <div class="px-2">--}}
                                            {{--                                                    @if($radiantHero['farm'] < 400)--}}
                                            {{--                                                        FARM <span class="text-danger"> {{ $radiantHero['farm'] }} </span>--}}
                                            {{--                                                    @elseif($radiantHero['farm'] >= 400 and $radiantHero['farm'] <= 500)--}}
                                            {{--                                                        FARM <span--}}
                                            {{--                                                            class="text-warning"> {{ $radiantHero['farm'] }} </span>--}}
                                            {{--                                                    @elseif($radiantHero['farm'] > 500)--}}
                                            {{--                                                        FARM <span--}}
                                            {{--                                                            class="text-success"> {{ $radiantHero['farm'] }} </span>--}}
                                            {{--                                                    @endif--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($radiantHero->heroDamage < 500)
                                                        HERO DAMAGE <span
                                                            class="text-danger"> {{ $radiantHero->heroDamage }} </span>
                                                    @elseif($radiantHero->heroDamage >= 500 and $radiantHero->heroDamage <= 700)
                                                        HERO DAMAGE <span
                                                            class="text-warning"> {{ $radiantHero->heroDamage }} </span>
                                                    @elseif($radiantHero->heroDamage > 700)
                                                        HERO DAMAGE <span
                                                            class="text-success"> {{ $radiantHero->heroDamage }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex text-light">
                                                <div class="px-2">
                                                    @if($radiantHero->towerDamage < 80)
                                                        TOWER DAMAGE <span
                                                            class="text-danger"> {{ $radiantHero->towerDamage }} </span>
                                                    @elseif($radiantHero->towerDamage >= 80 and $radiantHero->towerDamage <= 120)
                                                        TOWER DAMAGE <span
                                                            class="text-warning"> {{ $radiantHero->towerDamage }} </span>
                                                    @elseif($radiantHero->towerDamage > 120)
                                                        TOWER DAMAGE <span
                                                            class="text-success"> {{ $radiantHero->towerDamage }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(count($radiantHero->counterPicks))
                                    <div class="text-white px-3 pb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex">
                                                    @foreach($radiantHero->counterPicks as $heroName => $percent)
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
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                TOTAL {{ $direTeam->points }}
                            </div>
                            <div class="pe-3">
                                WEAK {{ $direTeam->weak }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                TOTAL {{ $radiantTeam->points }}
                            </div>
                            <div>
                                WEAK {{ $radiantTeam->weak }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                @if($direTeam->towerDamage < 200)
                                    TOWER DAMAGE <span
                                        class="text-danger"> {{ $direTeam->towerDamage}} </span>
                                @elseif($direTeam->towerDamage >= 200 and $direTeam->towerDamage <= 300)
                                    TOWER DAMAGE <span
                                        class="text-warning"> {{ $direTeam->towerDamage }} </span>
                                @elseif($direTeam->towerDamage > 300)
                                    TOWER DAMAGE <span
                                        class="text-success"> {{ $direTeam->towerDamage }} </span>
                                @endif
                            </div>
                            <div class="pe-3">
                                HERO DAMAGE {{ $direTeam->heroDamage }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded-1 text-light p-3 d-flex justify-content-start">
                            <div class="pe-3">
                                @if($radiantTeam->towerDamage< 200)
                                    TOWER DAMAGE <span
                                        class="text-danger"> {{ $radiantTeam->towerDamage}} </span>
                                @elseif($radiantTeam->towerDamage>= 200 and $radiantTeam->towerDamage<= 300)
                                    TOWER DAMAGE <span
                                        class="text-warning"> {{ $radiantTeam->towerDamage}} </span>
                                @elseif($radiantTeam->towerDamage> 300)
                                    TOWER DAMAGE <span
                                        class="text-success"> {{ $radiantTeam->towerDamage}} </span>
                                @endif
                            </div>
                            <div class="pe-3">
                                HERO DAMAGE {{ $radiantTeam->heroDamage }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


