<div class="sidebar-category">
        <div class="col-md-12">
            <div class="card p-3">
                <section>

                    <h5>Categorías</h5>

                    <div class="text-muted small text-uppercase mb-2">
                        <p class="mb-3">Volver a <br><a href="{{ URL::to('/') }}" class="card-link-secondary"><strong>Productos destacados</strong></a></p>

                        @foreach($categorias as $categoria)
                        <p class="mb-3"><a href="{{ route('producto.byCat', ['id' => $categoria->id]) }}" class="card-link link-sidebar"><span style="font-size:11px;">&#9654;</span> &nbsp; {{ $categoria->nombre }} ({{ $categoria->productos->count() }}) </a></p>
                        @endforeach                  
                    </div>

                </section>
                    <!-- Section: Categories -->
            </div>
        </div>
    </div>