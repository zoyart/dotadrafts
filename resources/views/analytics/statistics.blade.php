@extends("layouts.layout")

@section("title")
    Statistics
@endsection

@section("content")
    <div class="statistic mt-5">
        <div class="row">

            <div class="col">
                <div class="title fs-2 fw-bold text-dark">
                    DIRE
                    <span class="text-danger"> *</span>
                </div>
                <div class="dire-hero mt-3">
                    @foreach($direHeroes as $direHero)
                        <div class="mb-4">
                            <div class="d-flex">
                                <img src="/images/heroes/{{ $direHero }}.jpg" alt="">
                                <div>
                                    <div class="ms-3">
                                        @if($direData[$direHero]['heroPoints'] < 0)
                                            <span class="fw-bold">Hero points: </span>
                                            <span class="text-danger">{{ $direData[$direHero]['heroPoints']  }}</span>
                                        @elseif($direData[$direHero]['heroPoints'] > 0 and $direData[$direHero] < 2)
                                            <span class="fw-bold">Hero points: </span>
                                            <span class="text-warning">{{ $direData[$direHero]['heroPoints'] }}</span>
                                        @else
                                            <span class="fw-bold">Hero points: </span>
                                            <span class="text-success">{{ $direData[$direHero]['heroPoints'] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($direData[$direHero]['heroWeak'] < 1)
                                            Hero weak: <span
                                                class="text-success">{{ $direData[$direHero]['heroWeak'] }}</span>
                                        @elseif($direData[$direHero]['heroWeak'] > 1 and $direData[$direHero]['heroWeak'] < 5)
                                            Hero weak: <span
                                                class="text-warning">{{ $direData[$direHero]['heroWeak'] }}</span>
                                        @else
                                            Hero weak: <span
                                                class="text-danger">{{ $direData[$direHero]['heroWeak'] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($direData[$direHero]['heroPower'] < 1)
                                            Hero power: <span
                                                class="text-danger">{{ $direData[$direHero]['heroPower'] }}</span>
                                        @elseif($direData[$direHero]['heroPower'] > 1 and $direData[$direHero]['heroPower'] < 5)
                                            Hero power: <span
                                                class="text-warning">{{ $direData[$direHero]['heroPower'] }}</span>
                                        @else
                                            Hero power: <span
                                                class="text-success">{{ $direData[$direHero]['heroPower'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($direData[$direHero]['counterPicks'] ))
                                @foreach($direData[$direHero]['counterPicks'] as $counterPick)
                                    <div class="">{{ ucfirst($counterPick) }} неплох
                                        против {{ $direHero }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="weak fs-4 my-5 fw-bold">
                    Dire pick points: {{ $direWeak }}
                </div>
            </div>


            <div class="col">
                <div class="title fs-2 fw-bold text-dark">
                    RADIANT
                    <span class="text-success"> *</span>
                </div>
                <div class="radiant-hero mt-3">
                    @foreach($radiantHeroes as $radiantHero)
                        <div class="mb-4">
                            <div class="d-flex">
                                <img src="/images/heroes/{{ $radiantHero }}.jpg" alt="">
                                <div>
                                    <div class="ms-3">
                                        @if($radiantData[$radiantHero]['heroPoints'] < 0)
                                            <span class="fw-bold">Hero points: </span><span
                                                class="text-danger">{{ $radiantData[$radiantHero]['heroPoints'] }}</span>
                                        @elseif($radiantData[$radiantHero]['heroPoints'] > 0 and $radiantData[$radiantHero]['heroPoints'] < 2)
                                            <span class="fw-bold">Hero points: </span><span
                                                class="text-warning">{{ $radiantData[$radiantHero]['heroPoints'] }}</span>
                                        @else
                                            <span class="fw-bold">Hero points: </span><span
                                                class="text-success">{{ $radiantData[$radiantHero]['heroPoints'] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($radiantData[$radiantHero]['heroWeak'] < 1)
                                            Hero weak: <span
                                                class="text-success">{{ $radiantData[$radiantHero]['heroWeak'] }}</span>
                                        @elseif($radiantData[$radiantHero]['heroWeak'] > 1 and $radiantData[$radiantHero]['heroWeak']< 5)
                                            Hero weak: <span
                                                class="text-warning">{{ $radiantData[$radiantHero]['heroWeak'] }}</span>
                                        @else
                                            Hero weak: <span
                                                class="text-danger">{{ $radiantData[$radiantHero]['heroWeak'] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($radiantData[$radiantHero]['heroPower'] < 1)
                                            Hero power: <span
                                                class="text-danger">{{ $radiantData[$radiantHero]['heroPower'] }}</span>
                                        @elseif($radiantData[$radiantHero]['heroPower']> 1 and $radiantData[$radiantHero]['heroPower'] < 5)
                                            Hero power: <span
                                                class="text-warning">{{ $radiantData[$radiantHero]['heroPower']}}</span>
                                        @else
                                            Hero power: <span
                                                class="text-success">{{ $radiantData[$radiantHero]['heroPower'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($radiantData[$radiantHero]['counterPicks'] ))
                                @foreach($direData[$radiantHero]['counterPicks'] as $counterPick)
                                    <div class="">{{ ucfirst($counterPick) }} неплох
                                        против {{ $radiantHero }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="weak fs-4 my-5 fw-bold">
                    Radiant pick points: {{ $radiantWeak }}
                </div>
            </div>
        </div>
    </div>
@endsection
