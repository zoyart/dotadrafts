@extends("layouts.layout")

@section("title")
    Pick heroes
@endsection

@section("content")
    <div class="drafts">
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-2">
                    <div class="text-light">
                        <span class="title fs-2 fw-bold p-0 " id="dire-title">
                            DIRE
                        </span>
                    </div>
                </div>
                <div class="col-9">
                    <div
                        class="js-cell dire-hero d-flex bg-dark align-items-center rounded-1 justify-content-center"
                        style="height: 100px; width: 100%">
                    </div>
                </div>
                <div class="col-1">
                    <div class="js-cell bg-danger delete-hero rounded-1"
                         style="height: 100px; width: 100%">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center mt-5">
                <div class="col-2">
                    <div class="text-light">
                        <span class="title fs-2 fw-bold p-0" id="dire-title">
                            RADIANT
                        </span>
                    </div>
                </div>
                <div class="col-9">
                    <div
                        class="js-cell radiant-hero d-flex bg-dark align-items-center rounded-1 justify-content-center"
                        style="height: 100px; width: 100%">
                    </div>
                </div>
                <div class="col-1">
                    <div class="js-cell bg-danger delete-hero rounded-1"
                         style="height: 100px; width: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-5">
            <div class="col">
                <div class="d-grid">
                    <button type="submit" form="analyze" class="btn text-light btn-dark"
                            style=""
                    >Statistics
                    </button>
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
                        <input class="form-control text-light border-0" autocomplete="off" id="search" type="text"
                               placeholder="Search hero"
                               aria-label="dire_hero"
                               style="background-color: #17191C">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="all-heroes rounded-1 mt-4 d-flex flex-wrap js-cell" id="all_heroes">
                        @foreach($heroes as $hero)
                            <div class="hero-card" id="{{ $hero->id }}" draggable="true" title="{{ $hero->hero_name }}">
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
            window.hero_name = $(this).attr('title');
        };

        const dragOver = function (evt) {
            evt.preventDefault();
        };

        const dragEnter = function () {
            if (!$(this).hasClass("delete-hero")) {
                $(this).removeClass('bg-dark');
                $(this).addClass('bg-secondary');
            }
        };

        const dragLeave = function () {
            if (!$(this).hasClass("delete-hero")) {
                $(this).removeClass('bg-secondary');
                $(this).addClass('bg-dark');
            }
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

            // Срабатывает при дропе на красную площадь
            if ($(this).hasClass("delete-hero")) {
                // Добавление элемента обратно в список героев
                $('#all_heroes').append($(`#${heroId}`));
                // Удаление input из скрытой формы
                $(`input[value='${heroName}']`).remove();
            }


            if (!$(this).hasClass("delete-hero")) {
                $(this).removeClass('bg-secondary');
                $(this).addClass('bg-dark');
            }
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
                if ($(this).attr('title').toLowerCase().indexOf($(_this).val().toLowerCase()) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
