@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="draft_points py-5">
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
                                        Total: <span class="text-danger"> {{ $direHero['points'] }}</span>
                                    @elseif($direHero['points'] > 0 and $direHero['points'] < 3)
                                        Total: <span class="text-warning"> {{ $direHero['points'] }}</span>
                                    @elseif($direHero['points'] > 3)
                                        Total: <span class="text-success"> {{ $direHero['points'] }}</span>
                                    @endif
                                </div>
                                <div>
                                    @if($direHero['powerPoints'] <= 0)
                                        Power: <span class="text-danger"> {{ $direHero['powerPoints'] }} </span>
                                    @elseif($direHero['powerPoints'] > 0 and $direHero['powerPoints'] < 3)
                                        Power: <span class="text-warning"> {{ $direHero['powerPoints'] }} </span>
                                    @elseif($direHero['powerPoints'] > 3)
                                        Power: <span
                                            class="text-success"> {{ $direHero['powerPoints'] }} </span>
                                    @endif
                                </div>
                                <div>
                                    @if($direHero['weakPoints'] <= 0)
                                        Weak: <span class="text-success"> {{ $direHero['weakPoints'] }} </span>
                                    @elseif($direHero['weakPoints'] > 0 and $direHero['weakPoints'] < 3)
                                        Weak: <span class="text-warning"> {{ $direHero['weakPoints'] }} </span>
                                    @elseif($direHero['weakPoints'] > 3)
                                        Weak: <span class="text-danger"> {{ $direHero['weakPoints'] }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col">
                            </div>
                            <div class="col">
                                @if(!empty($direHero['counterPicks']))
                                    <div class="">
                                        COUNTER PICKS
                                    </div>
                                    <hr class="my-1">
                                    @foreach($direHero['counterPicks'] as $counterPick)
                                        <div>
                                            {{ $counterPick }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="">
                                    TEMPO
                                </div>
                                <hr class="my-1">
                                <div>
                                    <div class="pb-3">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th scope="col">ED</th>
                                                <th scope="col">MD</th>
                                                <th scope="col">LD</th>
                                                <th scope="col">EW</th>
                                                <th scope="col">MW</th>
                                                <th scope="col">LW</th>
                                                <th scope="col">G</th>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        <span class="fs-4">
                            TOTAL
                        </span>
                    </div>
                    <hr>
                    <div>
                        <span class="">
                            Points = {{ $teamsData['dire']['points'] }}
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Weak = {{ $teamsData['dire']['weak'] }}
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Gradient = {{ $teamsData['dire']['tempo']['totalGradient'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Early winrate = {{ $teamsData['dire']['tempo']['totalEarlyWinrate'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Middle winrate = {{ $teamsData['dire']['tempo']['totalMiddleWinrate'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Late winrate = {{ $teamsData['dire']['tempo']['totalLateWinrate'] }}%
                        </span>
                    </div>
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
                                        Total: <span class="text-danger"> {{ $radiantHero['points'] }}</span>
                                    @elseif($radiantHero['points'] > 0 and $radiantHero['points'] < 3)
                                        Total: <span class="text-warning"> {{ $radiantHero['points'] }}</span>
                                    @elseif($radiantHero['points'] > 3)
                                        Total: <span class="text-success"> {{ $radiantHero['points'] }}</span>
                                    @endif
                                </div>
                                <div>
                                    @if($radiantHero['powerPoints'] <= 0)
                                        Power: <span class="text-danger"> {{ $radiantHero['powerPoints'] }} </span>
                                    @elseif($radiantHero['powerPoints'] > 0 and $radiantHero['powerPoints'] < 3)
                                        Power: <span class="text-warning"> {{ $radiantHero['powerPoints'] }} </span>
                                    @elseif($radiantHero['powerPoints'] > 3)
                                        Power: <span
                                            class="text-success"> {{ $radiantHero['powerPoints'] }} </span>
                                    @endif
                                </div>
                                <div>
                                    @if($radiantHero['weakPoints'] <= 0)
                                        Weak: <span class="text-success"> {{ $radiantHero['weakPoints'] }} </span>
                                    @elseif($radiantHero['weakPoints'] > 0 and $radiantHero['weakPoints'] < 3)
                                        Weak: <span class="text-warning"> {{ $radiantHero['weakPoints'] }} </span>
                                    @elseif($radiantHero['weakPoints'] > 3)
                                        Weak: <span class="text-danger"> {{ $radiantHero['weakPoints'] }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row  pb-4">
                            <div class="col">
                                @if(!empty($radiantHero['counterPicks']))
                                    <div class="">
                                        COUNTER PICKS
                                    </div>
                                    <hr class="my-1">
                                    @foreach($radiantHero['counterPicks'] as $counterPick)
                                        <div>
                                            {{ $counterPick }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="">
                                    TEMPO
                                </div>
                                <hr class="my-1">
                                <div>
                                    <div class="pb-3">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th scope="col">ED</th>
                                                <th scope="col">MD</th>
                                                <th scope="col">LD</th>
                                                <th scope="col">EW</th>
                                                <th scope="col">MW</th>
                                                <th scope="col">LW</th>
                                                <th scope="col">G</th>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        <span class="fs-4">
                            TOTAL
                        </span>
                    </div>
                    <hr>
                    <div>
                        <span class="">
                            Points = {{ $teamsData['radiant']['points'] }}
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Weak = {{ $teamsData['radiant']['weak'] }}
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Gradient = {{ $teamsData['radiant']['tempo']['totalGradient'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Early winrate = {{ $teamsData['radiant']['tempo']['totalEarlyWinrate'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Middle winrate = {{ $teamsData['radiant']['tempo']['totalMiddleWinrate'] }}%
                        </span>
                    </div>
                    <div>
                        <span class="">
                            Late winrate = {{ $teamsData['radiant']['tempo']['totalLateWinrate'] }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
@endsection
