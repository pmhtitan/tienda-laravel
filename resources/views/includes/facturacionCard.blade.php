<div class="card">
                <div class="card-header text-center text-uppercase"><strong>Datos de Facturación</strong></div>

                <div class="card-body">
                    <form action="{{ route('carrito.checkout_start') }}" method="POST">
                    @csrf

                        <div class="form-group row">
                            
                            <label for="nombre" class="col-md-3 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-7">
                                <input type="text" id="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="@if($datosexisten) {{ $datosfacturacion->nombre }}  @endif" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if($datosexisten) {{ $datosfacturacion->email }}  @endif" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="telefono" class="col-md-3 col-form-label text-md-right">Telefono</label>

                            <div class="col-md-4">
                                <input type="number" max="999999999" id="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="@if($datosexisten){{ $datosfacturacion->telefono }}@endif" required autofocus/>

                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            
                            <label for="provincia" class="col-md-3 col-form-label text-md-right">Provincia</label>

                            <div class="col-md-7">
                                <input type="text" id="provincia" class="form-control{{ $errors->has('provincia') ? ' is-invalid' : '' }}" value="@if($datosexisten) {{ $datosfacturacion->provincia }}  @endif" name="provincia" required autofocus>   

                                @if ($errors->has('provincia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('provincia') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>
                
                        <div class="form-group row">
                            
                            <label for="localidad" class="col-md-3 col-form-label text-md-right">Localidad</label>

                            <div class="col-md-7">
                                <input type="text" id="localidad" class="form-control{{ $errors->has('localidad') ? ' is-invalid' : '' }}" name="localidad" value="@if($datosexisten) {{ $datosfacturacion->localidad }}  @endif" required autofocus>   

                                @if ($errors->has('localidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('localidad') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            
                            <label for="direccion" class="col-md-3 col-form-label text-md-right">Dirección</label>

                            <div class="col-md-7">
                                <input type="text" id="direccion" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="@if($datosexisten) {{ $datosfacturacion->direccion }}  @endif" required autofocus>   

                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        <div class="form-group row">
                            
                            <label for="codigo_postal" class="col-md-3 col-form-label text-md-right">Código Postal</label>

                            <div class="col-md-4">
                                <input type="number" max="99999" id="codigo_postal" class="form-control{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" value="@if($datosexisten){{ $datosfacturacion->codigo_postal }}@endif" name="codigo_postal" required autofocus>   

                                @if ($errors->has('codigo_postal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codigo_postal') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>

                        @if($datosexisten)
                        <input type="hidden" name="facturacion_id" value="{{ $datosfacturacion->id }}"/>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-3">
                                <button type="submit" class="btn btn-primary" name="submitDatosFacturacion">
                                    Guardar
                                </button>
                            </div>
                        </div>                       
                                            
                    </form>

                </div>
                
            </div>