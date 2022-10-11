@extends("layouts.layout")

@section("title")
    Pick heroes
@endsection

@section("content")
    <div class="drafts">
        <div class="container">
            <div class="row mt-4">
                <div class="col">
                    <div class="d-flex align-items-center text-light">
                        <span class="title fs-2 fw-bold p-0 me-3" id="dire-title">
                            DIRE
                        </span>
                        <div class="js-cell delete-hero rounded-1" style="background-color: #17191C">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="js-cell dire-hero d-flex mt-3 bg-dark align-items-center rounded-1 justify-content-center" style="height: 100px; width: 100%">

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-4">
                <div class="d-flex align-items-center text-light">
                        <span class="title fs-2 fw-bold p-0" id="dire-title">
                            RADIANT
                        </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="js-cell radiant-hero d-flex mt-3 bg-dark align-items-center rounded-1 justify-content-center" style="height: 100px; width: 100%">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-4">
            <div class="col">
                <div class="d-grid">
                    <button type="submit" form="analyze" class="btn btn-dark"
                    >Analyze</button>
                </div>
            </div>
        </div>
    </div>
    <div class="heroes py-4 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title fs-2 fw-bold text-light mb-3">
                        HEROES
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="search">
                        <input class="form-control text-light border-0" autocomplete="off" id="search" type="text" placeholder="Search hero"
                               aria-label="dire_hero"
                               style="background-color: #17191C">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="all-heroes rounded-1 mt-4 d-flex flex-wrap js-cell" id="all_heroes">
                        @foreach($heroes as $hero)
                            <div class="hero-card" id="{{ $hero->id }}" draggable="true">
                                <span class="hero_name" style="display: none">{{ $hero->hero_name }}</span>
                                <div class="">
                                    <img src="/images/heroes/{{ $hero->hero_name }}.jpg" alt="" width="auto">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="analyze" action="{{ route('analytics') }}" style="display: none">
    </form>
@endsection
<script
    src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
    crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
        const cards = $('div .hero-card');
        const cells = $('div .js-cell');

        const dragStart = function () {
            window.heroId = $(this).attr('id');
            window.hero_name = $(this).text();

            console.log(window.hero_name);
        };

        const dragOver = function (evt) {
            evt.preventDefault();
        };

        const dragEnter = function () {
            $(this).removeClass('bg-dark');
            $(this).addClass('bg-secondary');
        };

        const dragLeave = function () {
            $(this).removeClass('bg-secondary');
            $(this).addClass('bg-dark');
        };

        const drop = function () {
            let heroId = window.heroId;
            let heroName = window.hero_name;
            $("#search").val('');

            if ($(this).hasClass("dire-hero")) {
                $(this).append($(`#${heroId}`));
                $('#analyze').append(`<input class="d-none" type="text" name="dire[]" value="${heroName}">`);
            }

            if ($(this).hasClass("radiant-hero")) {
                $(this).append($(`#${heroId}`));
                $('#analyze').append(`<input class="d-none" type="text" name="radiant[]" value="${heroName}">`);
            }

            if ($(this).hasClass("delete-hero")) {
                $('#all_heroes').append($(`#${heroId}`));
                $('#analyze').append(`<input class="d-none" type="text" name="dire[]" value="${heroName}">`);
            }

            $(this).removeClass('bg-secondary');
            $(this).addClass('bg-dark');
        };

        for (let i = 0; i < cells.length; i++) {
            cells[i].addEventListener('dragover', dragOver);
            cells[i].addEventListener('drop', drop);
            cells[i].addEventListener('dragenter', dragEnter);
            cells[i].addEventListener('dragleave', dragLeave);
        }

        for (let i = 0; i < cards.length; i++) {
            cards[i].addEventListener('dragstart', dragStart);
        }
    });

    // search hero
    $(document).ready(function () {
        $("#search").keyup(function () {
            _this = this;
            $.each($("#all_heroes .hero-card"), function () {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
