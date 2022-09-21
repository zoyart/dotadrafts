@extends("layouts.layout")

@section("title")
    Pick heroes
@endsection

@section("content")
    <div class="drafts" style="min-height: 500px">
        <div class="row">
            <div class="col">
                <div class="title fs-2 fw-bold text-dark mt-5">
                    DIRE
                    <span class="text-danger"> *</span>
                </div>
                <div class="dire-hero mt-3">

                </div>
            </div>
            <div class="col">
                <div class="title fs-2 fw-bold text-dark mt-5"  >
                    RADIANT
                    <span class="text-success"> *</span>
                </div>
                <div class="radiant-hero mt-3">

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="d-grid">
                <button type="submit" form="analyze" class="btn btn-outline-dark">Analyze</button>
            </div>
        </div>
    </div>
    <div class="heroes mt-5 mb-5">
        <div class="row">
            <div class="col">
                <div class="title fs-2 fw-bold text-dark mb-3">
                    HEROES
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="search">
                    <input class="form-control" autocomplete="off" id="search" type="text" placeholder="Search hero" aria-label="dire_hero">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="all-heroes mt-4 d-flex flex-wrap" id="all_heroes">
                    @foreach($heroes as $hero)
                        <div class="hero">
                            <div class="hero_name" style="display: none">{{ $hero->hero_name }}</div>
                            <div class="position-relative">
                                <button id="dire_btn" name="{{ $hero->hero_name }}" class="btn btn-outline-light btn-sm position-absolute top-0 start-0">D</button>
                                <button id="radiant_btn" name="{{ $hero->hero_name }}" class="btn btn-outline-light btn-sm position-absolute bottom-0 start-0">R</button>
                                <img src="/images/heroes/{{ $hero->hero_name }}.jpg" alt="" width="120px">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <form id="analyze" action="{{ route('analytics') }}">
    </form>
@endsection
<script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous">
</script>
<script>

    $(document).on('click', '#dire_btn', function() {
        let hero_name = $(this).attr('name')
        let image = `<img src="/images/heroes/${hero_name}.jpg" alt="" width="120px"><div class="hero-name">${hero_name}</div>`
        $('.dire-hero').append(image);
        $('#analyze').append(`<input class="d-none" type="text" name="dire[]" value="${hero_name}">`);
    });

    $(document).on('click', '#radiant_btn', function() {
        let hero_name = $(this).attr('name')
        let image = `<img src="/images/heroes/${hero_name}.jpg" alt="" width="120px"><div class="hero-name">${hero_name}</div>`
        $('.radiant-hero').append(image);
        $('#analyze').append(`<input class="d-none" type="text" name="radiant[]" value="${hero_name}">`);
    });

    $(document).ready(function(){
        $("#search").keyup(function(){
            _this = this;
            $.each($("#all_heroes .hero"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
