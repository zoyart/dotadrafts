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
                    @foreach($dire as $direHero)
                        <div class="mb-4">
                            <div class="d-flex">
                                <img src="/images/heroes/{{ $direHero }}.jpg" alt="">
                                <div>
                                    <div class="ms-3">
                                        @if($direHeroesPoints[$direHero] < 0)
                                            <span class="fw-bold">Hero points: </span><span class="text-danger">{{ $direHeroesPoints[$direHero] }}</span>
                                        @elseif($direHeroesPoints[$direHero] > 0 and $direHeroesPoints[$direHero] < 2)
                                            <span class="fw-bold">Hero points: </span><span class="text-warning">{{ $direHeroesPoints[$direHero] }}</span>
                                        @else
                                            <span class="fw-bold">Hero points: </span><span class="text-success">{{ $direHeroesPoints[$direHero] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($direHeroesWeak[$direHero] < 1)
                                            Hero weak: <span class="text-success">{{ $direHeroesWeak[$direHero] }}</span>
                                        @elseif($direHeroesWeak[$direHero] > 1 and $direHeroesWeak[$direHero] < 5)
                                            Hero weak: <span class="text-warning">{{ $direHeroesWeak[$direHero] }}</span>
                                        @else
                                            Hero weak: <span class="text-danger">{{ $direHeroesWeak[$direHero] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($direHeroesPower[$direHero] < 1)
                                            Hero power: <span class="text-danger">{{ $direHeroesPower[$direHero] }}</span>
                                        @elseif($direHeroesPower[$direHero] > 1 and $direHeroesPower[$direHero] < 5)
                                            Hero power: <span class="text-warning">{{ $direHeroesPower[$direHero] }}</span>
                                        @else
                                            Hero power: <span class="text-success">{{ $direHeroesPower[$direHero] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($direCounterPick[$direHero]))
                                <div class="">{{ ucfirst($direCounterPick[$direHero]) }} неплох
                                    против {{ $direHero }}
                                </div>
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
                    @foreach($radiant as $radiantHero)
                        <div class="mb-4">
                            <div class="d-flex">
                                <img src="/images/heroes/{{ $radiantHero }}.jpg" alt="">
                                <div>
                                    <div class="ms-3">
                                        @if($radiantHeroesPoints[$radiantHero] < 0)
                                            <span class="fw-bold">Hero points: </span><span class="text-danger">{{ $radiantHeroesPoints[$radiantHero]}}</span>
                                        @elseif($radiantHeroesPoints[$radiantHero] > 0 and $radiantHeroesPoints[$radiantHero] < 2)
                                            <span class="fw-bold">Hero points: </span><span class="text-warning">{{ $radiantHeroesPoints[$radiantHero] }}</span>
                                        @else
                                            <span class="fw-bold">Hero points: </span><span class="text-success">{{ $radiantHeroesPoints[$radiantHero] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($radiantHeroesWeak[$radiantHero] < 1)
                                            Hero weak: <span class="text-success">{{ $radiantHeroesWeak[$radiantHero]}}</span>
                                        @elseif($radiantHeroesWeak[$radiantHero] > 1 and $radiantHeroesWeak[$radiantHero] < 5)
                                            Hero weak: <span class="text-warning">{{ $radiantHeroesWeak[$radiantHero] }}</span>
                                        @else
                                            Hero weak: <span class="text-danger">{{ $radiantHeroesWeak[$radiantHero] }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3">
                                        @if($radiantHeroesPower[$radiantHero] < 1)
                                            Hero power: <span class="text-danger">{{ $radiantHeroesPower[$radiantHero] }}</span>
                                        @elseif($radiantHeroesPower[$radiantHero] > 1 and $radiantHeroesPower[$radiantHero] < 5)
                                            Hero power: <span class="text-warning">{{ $radiantHeroesPower[$radiantHero] }}</span>
                                        @else
                                            Hero power: <span class="text-success">{{ $radiantHeroesPower[$radiantHero] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(isset($radiantCounterPick[$radiantHero]))
                                <div class="">{{ ucfirst($radiantCounterPick[$radiantHero]) }} неплох
                                    против {{ $radiantHero }}
                                </div>
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
