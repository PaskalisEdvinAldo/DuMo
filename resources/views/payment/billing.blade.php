@extends('layouts.main')

@section('payment')
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        <div class="pagetitle">
          <h1>Invoices</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item">Payment</li>
              <li class="breadcrumb-item active">Billing</li>
            </ol>
          </nav>
        </div>
        
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
        
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Invoice Info</h5>
        
                  
                  <form id="payment" name="payment" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="cit_name" class="col-sm-2 col-form-label">Citizen Name</label>
                        <div class="col-sm-10">
                            <div class="form-floating mb-3">
                                <select class="@error('cit_name') is-invalid @enderror form-select" form="payment" id="cit_name" aria-label="State" name="cit_name" :value="{{ old('cit_name') }}" required>
                                    <option selected disabled>Choose Name</option>
                                    @foreach ($citizens as $citizen)
                                      <option value="{{ $citizen->fullname }}" {{ old('cit_name') == $citizen->id ? 'selected' : '' }}>{{ $citizen->fullname }}</option>
                                    @endforeach
                                </select>
                                <label for="cit_name">Citizen Lists</label>
                            </div>
                        </div>
                      </div>
                    <div class="row mb-3">
                      <label for="joinDate" class="col-sm-2 col-form-label">Invoice Date</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="invoice" name="invoice" :value="{{ old('invoice') }}" required>
                      </div>
                    </div>
    
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Payment Method</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="@error('method') is-invalid @enderror form-check-input" type="radio" name="method" id="method-year" value="Year" checked>
                                <label class="form-check-label" for="method-year">
                                    Year
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="@error('method') is-invalid @enderror form-check-input" type="radio" name="method" id="method-month" value="Month">
                                <label class="form-check-label" for="method-month">
                                    Month
                                </label>
                            </div>
                        </div>
                    </fieldset>
                <div class="row mb-3">
                    <label for="category" class="col-sm-2 col-form-label">Payment Category</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <select class="@error('category') is-invalid @enderror form-select" form="payment" id="category" aria-label="State" name="category" :value="{{ old('category') }}" required>
                                <option selected disabled>Choose Category</option>
                                <option value="Security" {{ old('category') == 'Security' ? 'selected' : '' }}>Security</option>
                                <option value="Cleanliness" {{ old('category') == 'Cleanliness' ? 'selected' : '' }}>Cleanliness</option>
                            </select>
                            <label for="category">Category</label>
                        </div>
                    </div>
                </div>
                
                    <div class="row mb-3">
                      <div class="col-md-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                      </div>
                    </div>
        
                  </form>
        
                </div>
              </div>
        
            </div>
          </div>
        </section>
@endsection
