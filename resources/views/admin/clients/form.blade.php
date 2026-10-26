@extends('layouts.admin')

@section('title', isset($client) ? 'Edit Client' : 'Create Client')

@section('content')
<div class="container-fluid pf pf--narrow">
    <div class="pf-head">
        <div>
            <h1>{{ isset($client) ? 'Edit client' : 'New client' }}</h1>
        </div>
        <a href="{{ route('admin.clients.index') }}" class="pf-back">&larr; All clients</a>
    </div>

    <form action="{{ isset($client) ? route('admin.clients.update', $client) : route('admin.clients.store') }}" 
                  method="POST" 
                  class="needs-validation" 
                  novalidate>
        @csrf
                @if(isset($client))
                    @method('PUT')
                @endif

        <div class="pf-panel">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $client->name ?? '') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $client->email ?? '') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $client->phone ?? '') }}" 
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      required>{{ old('address', $client->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
        </div>

        <div class="pf-actions">
            <a href="{{ route('admin.clients.index') }}" class="pf-back">Cancel</a>
            <x-admin.button type="submit">{{ isset($client) ? 'Update' : 'Create' }} client</x-admin.button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    // Form validation
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endpush
@endsection
