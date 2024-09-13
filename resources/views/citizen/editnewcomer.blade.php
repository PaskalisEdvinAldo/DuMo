@extends('layouts.main')

@section('citizen')
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        <div class="pagetitle">
          <h1>Newcomer Data</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item">Citizen</li>
              <li class="breadcrumb-item active">Newcomer</li>
            </ol>
          </nav>
        </div>
        
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
        
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Personal Information</h5>
        
                  
                  <form id="editnewcomer" name="editnewcomer" action="{{ route('citizen.update', ['id' => $citizen->id, 'citizen' => $citizen->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                      <label for="inputFullName" class="col-sm-2 col-form-label">Fullname</label>
                      <div class="col-sm-10">
                        <div class="form-floating">
                          <input type="text" class="@error('fullname') is-invalid @enderror form-control" id="fullname" placeholder="Your Name" name="fullname" value="{{ $citizen->fullname }}" autofocus required>
                          <label for="fullname">Your Name</label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputPhone" class="col-sm-2 col-form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <div class="form-floating">
                          <input type="tel" class="@error('phone') is-invalid @enderror form-control" id="phone" placeholder="Your Phone Number" name="phone" pattern="[0-9]{10,15}" 
                          oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="{{ $citizen->phone }}" required>
                            <label for="phone">Your Phone Number</label>
                            <small class="form-text text-muted">Please enter a valid phone number (10-15 digits).</small>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="joinDate" class="col-sm-2 col-form-label">Joining Date</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="join_date" name="join_date" value="{{ $citizen->join_date }}" required>
                      </div>
                    </div>
    
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Marital Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="@error('marital') is-invalid @enderror form-check-input" type="radio" name="marital" id="marital-married" value="Married"
                                {{ $citizen->marital == 'Married' ? 'checked' : '' }}>
                                <label class="form-check-label" for="marital-married">
                                    Married
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="@error('marital') is-invalid @enderror form-check-input" type="radio" name="marital" id="marital-single" value="Single"
                                {{ $citizen->marital == 'Single' ? 'checked' : '' }}>
                                <label class="form-check-label" for="marital-single">
                                    Single
                                </label>
                            </div>
                        </div>
                    </fieldset>
                <div class="row mb-3">
                    <label for="res_stats" class="col-sm-2 col-form-label">Resident Status</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <select class="@error('res_stats') is-invalid @enderror form-select" form="editnewcomer" id="res_stats" aria-label="State" name="res_stats" :value="{{ $citizen->res_stats }}" required>
                                <option selected disabled>Choose Category</option>
                                <option value="Permanent" {{ $citizen->res_stats == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                                <option value="Contract" {{ $citizen->res_stats == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                            <label for="res_stats">Housing Status</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Identity Card</label>
                  <div class="col-sm-10">
                    <input class="@error('id_card') is-invalid @enderror form-control" type="file" id="id_card" name="id_card" required>
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
