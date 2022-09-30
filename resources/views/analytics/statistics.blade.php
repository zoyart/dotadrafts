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
                                        {{--                                        @if($direHero['weakPoints'] <= 0)--}}
                                        {{--                                            SYNERGY <span class="text-success"> {{ $direHero['weakPoints'] }} </span>--}}
                                        {{--                                        @elseif($direHero['weakPoints'] > 0 and $direHero['weakPoints'] < 3)--}}
                                        {{--                                            SYNERGY <span class="text-warning"> {{ $direHero['weakPoints'] }} </span>--}}
                                        {{--                                        @elseif($direHero['weakPoints'] > 3)--}}
                                        {{--                                            SYNERGY <span class="text-danger"> {{ $direHero['weakPoints'] }} </span>--}}
                                        {{--                                        @endif--}}
                                        None
                                    </div>
                                </div>
                            </div>
                            <div class="text-white px-3 pb-3">
                                <div class="row pb-2">
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#direWinrateButton{{str_replace(' ', "_", $key)}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    style="background-color: #17191C">
                                                Winrate
                                            </button>
                                            <div class="collapse py-2"
                                                 id="direWinrateButton{{str_replace(' ', "_", $key)}}">
                                                <div class="bg-dark">
                                                    <div>
                                                        Early winrate: {{$direHero['tempo']['earlyWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Middle winrate: {{$direHero['tempo']['middleWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Late winrate: {{$direHero['tempo']['lateWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Gradient: {{$direHero['tempo']['gradient']}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#direSynergyButton{{str_replace(' ', "_", $key)}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    style="background-color: #17191C">
                                                Synergy
                                            </button>
                                            <div class="collapse py-2"
                                                 id="direSynergyButton{{str_replace(' ', "_", $key)}}">
                                                <div class="bg-dark">
                                                    Some placeholder content for the collapse component. This panel is
                                                    hidden by default but revealed when the user activates the relevant
                                                    trigger.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex">
                                            @foreach($direHero['counterPicks'] as $heroName => $percent)
                                                <div class="d-flex align-items-center rounded bg-danger me-3">
                                                    <img class="rounded-start" src="/images/heroes/{{ $heroName }}.jpg" alt="" width="50px">
                                                    <div class="px-3">
                                                        {{ ucfirst($heroName) }} {{ $percent }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        {{--                                        @if($radiantHero['weakPoints'] <= 0)--}}
                                        {{--                                            SYNERGY <span class="text-success"> {{ $radiantHero['weakPoints'] }} </span>--}}
                                        {{--                                        @elseif($radiantHero['weakPoints'] > 0 and $radiantHero['weakPoints'] < 3)--}}
                                        {{--                                            SYNERGY <span class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>--}}
                                        {{--                                        @elseif($radiantHero['weakPoints'] > 3)--}}
                                        {{--                                            SYNERGY <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>--}}
                                        {{--                                        @endif--}}
                                        None
                                    </div>
                                </div>
                            </div>
                            <div class="text-white px-3 pb-3">
                                <div class="row pb-2">
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#direWinrateButton{{str_replace(' ', "_", $key)}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    style="background-color: #17191C">
                                                Winrate
                                            </button>
                                            <div class="collapse py-2"
                                                 id="direWinrateButton{{str_replace(' ', "_", $key)}}">
                                                <div class="bg-dark">
                                                    <div>
                                                        Early winrate: {{$radiantHero['tempo']['earlyWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Middle winrate: {{$radiantHero['tempo']['middleWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Late winrate: {{$radiantHero['tempo']['lateWinrate']}}%
                                                    </div>
                                                    <div>
                                                        Gradient: {{$radiantHero['tempo']['gradient']}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#direSynergyButton{{str_replace(' ', "_", $key)}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample"
                                                    style="background-color: #17191C">
                                                Synergy
                                            </button>
                                            <div class="collapse py-2"
                                                 id="direSynergyButton{{str_replace(' ', "_", $key)}}">
                                                <div class="bg-dark">
                                                    Some placeholder content for the collapse component. This panel is
                                                    hidden by default but revealed when the user activates the relevant
                                                    trigger.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex">
                                            @foreach($radiantHero['counterPicks'] as $heroName => $percent)
                                                <div class="d-flex align-items-center rounded-1 bg-danger me-3">
                                                    <img class="rounded-start" src="/images/heroes/{{ $heroName }}.jpg" alt="" width="50px">
                                                    <div class="px-3">
                                                        {{ ucfirst($heroName) }} {{ $percent }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            Synergy: None
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
                            Synergy: None
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


