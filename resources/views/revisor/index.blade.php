<x-layout>
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-3">
                <div class="rounded shadow bg-body-secondary">
                    <h1 class="display-5 text-center pb-2">
                        Revisor dashboard
                    </h1>
                </div>
            </div>
        </div>
        @if ($advertisement_to_check)
        <div class="row justify-content-center pt-5">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-6 col-md-4 mb-4 text-center">
                        <img src="https://picsum.photos/300"
                            class="img-fluid rounded shadow "
                            alt="immagine segnaposto">
                </div>
                @endfor
            </div>
        </div>
        <div class="col-md-4 ps-4 d-flex flex-column justify-content-between">
            <div>
                <h1>{{ $advertisement_to_check->title }}</h1>
                <h3>Autore: {{ $advertisement_to_check->user->name }}</h3>
                <h4>{{ $advertisement_to_check->price }}€</h4>
                <h4 class="fst-italic text-muted">#{{ $advertisement_to_check->category->name }}</h4>
                <p class="h6">{{ $advertisement_to_check->description }}</p>
            </div>
            <!-- Logiche del revisor -->
            <div class="d-flex pb-4 justify-content-around">
                <form action="{{route('reject',['advertisement'=>$advertisement_to_check])}}" method="POST">
                    @csrf
                    @method('patch')
                    <button class="btn btn-danger py-2 px-5 fw-bold ">Rifiuta</button>
                </form>
                <form action="{{route('accept',['advertisement'=>$advertisement_to_check])}}" method="POST">
                    @csrf
                    @method('patch')
                    <button class="btn btn-success py-2 px-5 fw-bold ">Accetta</button>
                </form>
            </div>
            <!-- Fine logiche del revisor -->
        </div>
    </div>
    @else
    <div class="row justify-content-center align-items-center height-custom text-center">
        <div class="col-12">
            <h1 class="fst-italic display-4">
                Nessun articolo da revisionare
            </h1>
            <a href="{{ route('welcome') }}" class="mt-5 btn btn-success"> Torna all'homepage</a>
        </div>
    </div>
    @endif
    </div>

    @if(session()->has('message'))
    <div class="row justify-content-center">
        <div class="col-5 alert-success text-center shadow rounded">
            {{session('message')}}
        </div>
    </div>
    @endif
</x-layout>