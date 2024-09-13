@extends('layouts.main')

@section('residence')
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-1"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        <div class="pagetitle">
          <h1>Property Data</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item">Residence</li>
              <li class="breadcrumb-item active">Edit Resident</li>
            </ol>
          </nav>
        </div>
        
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
        
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Edit Property Information</h5>
        
                  
                  <form id="building" name="building" action="{{ route('residence.update', ['residence'=> $residence->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label for="house_number" class="col-sm-2 col-form-label">House Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="house_number" name="house_number" value="{{ $residence->house_number }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="oc_list" class="col-sm-2 col-form-label">Occupant Order</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="oc_list" name="oc_list" value="{{ $residence->oc_list }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="oc_name" class="col-sm-2 col-form-label">Occupant Name</label>
                        <div class="col-sm-10">
                            <div id="oc_name_container">
                                @foreach($residences as $residence)
                                <div class="d-flex align-items-center mb-2">
                                    <input type="text" class="form-control me-2" name="oc_name[]" value="{{ $residence->oc_name }}">
                                </div>
                                @endforeach
                            </div>
                            <div>
                                <button type="button" class="btn btn-success mt-2" id="add-more-btn">Add More Member</button>
                            </div>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">House Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="@error('house') is-invalid @enderror form-check-input" type="radio" name="house" id="house-occupied" value="Occupied"
                                {{ $residence->house == 'Occupied' ? 'checked' : '' }}>
                                <label class="form-check-label" for="house-occupied">
                                    Occupied
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="@error('house') is-invalid @enderror form-check-input" type="radio" name="house" id="house-unoccupied" value="Unoccupied"
                                {{ $residence->house == 'Unoccupied' ? 'checked' : '' }}>
                                <label class="form-check-label" for="house-unoccupied">
                                    Unoccupied
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <div class="col-md-5">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="reset" class="btn btn-danger">Cancel</button>
                          <a href="{{ route('residence.show') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
                
        
                </div>
              </div>
        
            </div>
          </div>
        </section>

        <script>
          document.getElementById('add-more-btn').addEventListener('click', function() {
              var newField = `
                  <div class="d-flex align-items-center mb-2">
                      <input type="text" class="form-control me-2" name="oc_name[]" placeholder="Enter another house member">
                  </div>`;
              document.getElementById('oc_name_container').insertAdjacentHTML('beforeend', newField);
          });
      </script>
@endsection
