@extends('layouts.admin')

@section('title', 'Configuración del Sistema')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Configuración del Sistema</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Información General -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Información General</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="site_name">Nombre del Sitio</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                   id="site_name" name="site_name"
                                   value="{{ old('site_name', $settings['site_name']) }}">
                            @error('site_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_logo">Logo del Sitio</label>
                            <input type="file" class="form-control-file @error('site_logo') is-invalid @enderror"
                                   id="site_logo" name="site_logo">
                            @error('site_logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(Cache::has('site_logo'))
                            <div class="mt-2">
                                <img src="{{ Cache::get('site_logo') }}" alt="Logo actual" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Email de Contacto</label>
                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                   id="contact_email" name="contact_email"
                                   value="{{ old('contact_email', $settings['contact_email']) }}">
                            @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone"
                                   value="{{ old('phone', $settings['phone']) }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                   id="address" name="address"
                                   value="{{ old('address', $settings['address']) }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Redes Sociales -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Redes Sociales</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="social_facebook">Facebook</label>
                            <input type="url" class="form-control @error('social_facebook') is-invalid @enderror"
                                   id="social_facebook" name="social_facebook"
                                   value="{{ old('social_facebook', $settings['social_media']['facebook']) }}">
                            @error('social_facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="social_twitter">Twitter</label>
                            <input type="url" class="form-control @error('social_twitter') is-invalid @enderror"
                                   id="social_twitter" name="social_twitter"
                                   value="{{ old('social_twitter', $settings['social_media']['twitter']) }}">
                            @error('social_twitter')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="social_instagram">Instagram</label>
                            <input type="url" class="form-control @error('social_instagram') is-invalid @enderror"
                                   id="social_instagram" name="social_instagram"
                                   value="{{ old('social_instagram', $settings['social_media']['instagram']) }}">
                            @error('social_instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Métodos de Pago -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Métodos de Pago</h6>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="payment_paypal" name="payment_paypal" value="1"
                                   {{ $settings['payment_methods']['paypal'] ? 'checked' : '' }}>
                            <label class="custom-control-label" for="payment_paypal">PayPal</label>
                        </div>

                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="payment_credit_card" name="payment_credit_card" value="1"
                                   {{ $settings['payment_methods']['credit_card'] ? 'checked' : '' }}>
                            <label class="custom-control-label" for="payment_credit_card">Tarjeta de Crédito</label>
                        </div>

                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input"
                                   id="payment_bank_transfer" name="payment_bank_transfer" value="1"
                                   {{ $settings['payment_methods']['bank_transfer'] ? 'checked' : '' }}>
                            <label class="custom-control-label" for="payment_bank_transfer">Transferencia Bancaria</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración de Reservas -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Configuración de Reservas</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="booking_max_passengers">Máximo de Pasajeros por Reserva</label>
                                    <input type="number" class="form-control @error('booking_max_passengers') is-invalid @enderror"
                                           id="booking_max_passengers" name="booking_max_passengers"
                                           value="{{ old('booking_max_passengers', $settings['booking_settings']['max_passengers']) }}">
                                    @error('booking_max_passengers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="booking_advance_days">Días de Anticipación para Reservar</label>
                                    <input type="number" class="form-control @error('booking_advance_days') is-invalid @enderror"
                                           id="booking_advance_days" name="booking_advance_days"
                                           value="{{ old('booking_advance_days', $settings['booking_settings']['advance_days']) }}">
                                    @error('booking_advance_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="booking_cancellation_hours">Horas para Cancelación</label>
                                    <input type="number" class="form-control @error('booking_cancellation_hours') is-invalid @enderror"
                                           id="booking_cancellation_hours" name="booking_cancellation_hours"
                                           value="{{ old('booking_cancellation_hours', $settings['booking_settings']['cancellation_hours']) }}">
                                    @error('booking_cancellation_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-save mr-2"></i>Guardar Configuración
            </button>
        </div>
    </form>
</div>
@endsection
