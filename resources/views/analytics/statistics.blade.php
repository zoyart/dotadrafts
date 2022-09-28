@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="draft_points pt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="h4">Team Dire</div>
                    <hr>
                    @foreach($teamsData['dire']['heroes'] as $key => $direHero)
                        <div class="d-flex align-items-center bg-dark">
                            <div>
                                <img src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                            </div>
                            <div class="d-flex flex-grow-1 justify-content-around text-white">
                                <div class="">
                                    @if($direHero['points'] <= 0)
                                        TOTAL <span class="text-danger"> {{ $direHero['points'] }}</span>
                                    @elseif($direHero['points'] > 0 and $direHero['points'] < 3)
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
                            </div>
                        </div>
                        <div class="bg-light">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th title="Early duration" scope="col">ED</th>
                                    <th title="Middle duration" scope="col">MD</th>
                                    <th title="Late duration" scope="col">LD</th>
                                    <th title="Early winrate" scope="col">EW</th>
                                    <th title="Middle winrate" scope="col">MW</th>
                                    <th title="Late winrate" scope="col">LW</th>
                                    <th title="Gradient" scope="col">G</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $direHero['tempo']['earlyDuration'] }}</td>
                                    <td>{{ $direHero['tempo']['middleDuration'] }}</td>
                                    <td>{{ $direHero['tempo']['lateDuration'] }}</td>
                                    <td>{{ $direHero['tempo']['earlyWinrate'] }}%</td>
                                    <td>{{ $direHero['tempo']['middleWinrate'] }}%</td>
                                    <td>{{ $direHero['tempo']['lateWinrate'] }}%</td>
                                    <td>{{ $direHero['tempo']['gradient'] }}%</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="px-2 pb-3">
                                @if(! empty($direHero['counterPicks']))
                                    <div class="text-center">
                                        COUNTER PICKS
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex justify-content-around">
                                        @foreach($direHero['counterPicks'] as $counterPick)
                                            <div class="text-uppercase">
                                                {{ $counterPick }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="col">
                    <div class="h4">Team Radiant</div>
                    <hr>
                    @foreach($teamsData['radiant']['heroes'] as $key => $radiantHero)
                        <div class="d-flex align-items-center bg-dark">
                            <div>
                                <img src="/images/heroes/{{ $key }}.jpg" alt="" width="100px">
                            </div>
                            <div class="d-flex flex-grow-1 justify-content-around text-white px-3">
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
                                    @if($radiantHero['weakPoints'] <= 0)
                                        WEAK <span class="text-success"> {{ $radiantHero['weakPoints'] }} </span>
                                    @elseif($radiantHero['weakPoints'] > 0 and $radiantHero['weakPoints'] < 3)
                                        WEAK <span class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>
                                    @elseif($radiantHero['weakPoints'] > 3)
                                        WEAK <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="bg-light">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th title="Early duration" scope="col">ED</th>
                                    <th title="Middle duration" scope="col">MD</th>
                                    <th title="Late duration" scope="col">LD</th>
                                    <th title="Early winrate" scope="col">EW</th>
                                    <th title="Middle winrate" scope="col">MW</th>
                                    <th title="Late winrate" scope="col">LW</th>
                                    <th title="Gradient" scope="col">G</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $radiantHero['tempo']['earlyDuration'] }}</td>
                                    <td>{{ $radiantHero['tempo']['middleDuration'] }}</td>
                                    <td>{{ $radiantHero['tempo']['lateDuration'] }}</td>
                                    <td>{{ $radiantHero['tempo']['earlyWinrate'] }}%</td>
                                    <td>{{ $radiantHero['tempo']['middleWinrate'] }}%</td>
                                    <td>{{ $radiantHero['tempo']['lateWinrate'] }}%</td>
                                    <td>{{ $radiantHero['tempo']['gradient'] }}%</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="px-2 pb-3">
                                @if(! empty($radiantHero['counterPicks']))
                                    <div class="text-center">
                                        COUNTER PICKS
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex justify-content-around">
                                        @foreach($radiantHero['counterPicks'] as $counterPick)
                                            <div class="text-uppercase">
                                                {{ $counterPick }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-dark text-white py-5 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div>
                            TEAM DIRE
                        </div>
                        <hr class="my-2">
                        <div>
                            Points: {{ $teamsData['dire']['points'] }}
                        </div>
                        <div>
                            Weak: {{ $teamsData['dire']['weak'] }}
                        </div>
                        <div>
                            Gradient: {{ $teamsData['dire']['tempo']['totalGradient'] }}%
                        </div>
                        <div>
                            Early winrate: {{ $teamsData['dire']['tempo']['totalEarlyWinrate'] }}%
                        </div>
                        <div>
                            Middle winrate: {{ $teamsData['dire']['tempo']['totalMiddleWinrate'] }}%
                        </div>
                        <div>
                            Late winrate: {{ $teamsData['dire']['tempo']['totalLateWinrate'] }}%
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            TEAM RADIANT
                        </div>
                        <hr class="my-2">
                        <div>
                            Points: {{ $teamsData['radiant']['points'] }}
                        </div>
                        <div>
                            Weak: {{ $teamsData['radiant']['weak'] }}
                        </div>
                        <div>
                            Gradient: {{ $teamsData['radiant']['tempo']['totalGradient'] }}%
                        </div>
                        <div>
                            Early winrate: {{ $teamsData['radiant']['tempo']['totalEarlyWinrate'] }}%
                        </div>
                        <div>
                            Middle winrate: {{ $teamsData['radiant']['tempo']['totalMiddleWinrate'] }}%
                        </div>
                        <div>
                            Late winrate: {{ $teamsData['radiant']['tempo']['totalLateWinrate'] }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
