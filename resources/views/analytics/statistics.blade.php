@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="pt-5">
        <div class="container">
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
                                        @elseif($direHero['points'] > 3)
                                            TOTAL <span class="text-success"> {{ $direHero['points'] }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($direHero['powerPoints'] <= 0)
                                            POWER <span class="text-danger"> {{ $direHero['powerPoints'] }} </span>
                                        @elseif($direHero['powerPoints'] > 0 and $direHero['powerPoints'] < 3)
                                            POWER <span class="text-warning"> {{ $direHero['powerPoints'] }} </span>
                                        @elseif($direHero['powerPoints'] > 3)
                                            POWER <span
                                                class="text-success"> {{ $direHero['powerPoints'] }} </span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($direHero['weakPoints'] <= 0)
                                            WEAK <span class="text-success"> {{ $direHero['weakPoints'] }} </span>
                                        @elseif($direHero['weakPoints'] > 0 and $direHero['weakPoints'] < 3)
                                            WEAK <span class="text-warning"> {{ $direHero['weakPoints'] }} </span>
                                        @elseif($direHero['weakPoints'] > 3)
                                            WEAK <span class="text-danger"> {{ $direHero['weakPoints'] }} </span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($direHero['heroSynergy'] <= 0)
                                            SYNERGY <span class="text-danger"> {{ $direHero['heroSynergy'] }} </span>
                                        @elseif($direHero['heroSynergy'] > 0 and $direHero['heroSynergy'] < 3)
                                            SYNERGY <span class="text-warning"> {{ $direHero['heroSynergy'] }} </span>
                                        @elseif($direHero['heroSynergy'] > 3)
                                            SYNERGY <span class="text-success"> {{ $direHero['heroSynergy'] }} </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
{{--                            <div class="text-white px-3 pb-3">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            @foreach($direHero['synergy'] as $heroName => $percent)--}}
{{--                                                <div class="d-flex align-items-center rounded bg-success     me-3">--}}
{{--                                                    <img class="rounded-start" src="/images/heroes/{{ $heroName }}.jpg"--}}
{{--                                                         alt="" width="50px">--}}
{{--                                                    <div class="px-3">--}}
{{--                                                        {{ $percent }}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
                                        @elseif($radiantHero['points'] > 3)
                                            TOTAL <span class="text-success"> {{ $radiantHero['points'] }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($radiantHero['powerPoints'] <= 0)
                                            POWER <span class="text-danger"> {{ $radiantHero['powerPoints'] }} </span>
                                        @elseif($radiantHero['powerPoints'] > 0 and $radiantHero['powerPoints'] < 3)
                                            POWER <span class="text-warning"> {{ $radiantHero['powerPoints'] }} </span>
                                        @elseif($radiantHero['powerPoints'] > 3)
                                            POWER <span
                                                class="text-success"> {{ $radiantHero['powerPoints'] }} </span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($radiantHero['weakPoints'] <= 1)
                                            WEAK <span class="text-success"> {{ $radiantHero['weakPoints'] }} </span>
                                        @elseif($radiantHero['weakPoints'] > 1 and $radiantHero['weakPoints'] < 3)
                                            WEAK <span class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>
                                        @elseif($radiantHero['weakPoints'] > 3)
                                            WEAK <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>
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
{{--                            <div class="text-white px-3 pb-3">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            @foreach($radiantHero['synergy'] as $heroName => $percent)--}}
{{--                                                <div class="d-flex align-items-center rounded bg-success me-3">--}}
{{--                                                    <img class="rounded-start" src="/images/heroes/{{ $heroName }}.jpg"--}}
{{--                                                         alt="" width="50px">--}}
{{--                                                    <div class="px-3">--}}
{{--                                                        {{ $percent }}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
            <div class="row my-5">
                <div class="h4 text-light mb-3">Total</div>
                <div class="col">
                    <div class="bg-dark rounded-1 text-light p-3">
                        <div>
                            Points: {{ $teamsData['dire']['points'] }}
                        </div>
                        <div>
                            Weak: {{ $teamsData['dire']['weak'] }}
                        </div>
                        <div>
                            Synergy: {{ $teamsData['dire']['synergy'] }}
                        </div>
                        <div class="mt-2">
                            Winrate
                        </div>
                        <div>
                            Early: {{ $teamsData['dire']['tempo']['totalEarlyWinrate'] }}%
                        </div>
                        <div>
                            Middle: {{ $teamsData['dire']['tempo']['totalMiddleWinrate'] }}%
                        </div>
                        <div>
                            Late: {{ $teamsData['dire']['tempo']['totalLateWinrate'] }}%
                        </div>
                        <div>
                            Gradient: {{ $teamsData['dire']['tempo']['totalGradient'] }}%
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-dark rounded-1 text-light p-3">
                        <div>
                            Points: {{ $teamsData['radiant']['points'] }}
                        </div>
                        <div>
                            Weak: {{ $teamsData['radiant']['weak'] }}
                        </div>
                        <div>
                            Synergy: {{ $teamsData['radiant']['synergy'] }}
                        </div>
                        <div class="mt-2">
                            Winrate
                        </div>
                        <div>
                            Early: {{ $teamsData['radiant']['tempo']['totalEarlyWinrate'] }}%
                        </div>
                        <div>
                            Middle: {{ $teamsData['radiant']['tempo']['totalMiddleWinrate'] }}%
                        </div>
                        <div>
                            Late: {{ $teamsData['radiant']['tempo']['totalLateWinrate'] }}%
                        </div>
                        <div>
                            Gradient: {{ $teamsData['radiant']['tempo']['totalGradient'] }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


