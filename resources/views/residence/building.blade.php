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
              <li class="breadcrumb-item active">building</li>
            </ol>
          </nav>
        </div>
        
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
        
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Property Information</h5>
        
                  
                  <form id="building" name="building" action="{{ route('residence.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                      <label for="house_number" class="col-sm-2 col-form-label">House Number</label>
                      <div class="col-sm-10">
                          <div class="form-floating mb-3">
                              <select class="@error('house_number') is-invalid @enderror form-select" form="building" id="house_number" aria-label="State" name="house_number" :value="{{ old('house_number') }}" required>
                                  <option selected disabled>Choose Number</option>
                                  @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('house_number') == $i ? 'selected' : '' }}
                                    {{ in_array($i, $existingHouseNumber) ? 'disabled' : '' }}>{{ $i }}</option>
                                  @endfor
                              </select>
                              <label for="house_number">Number Lists</label>
                          </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="oc_list" class="col-sm-2 col-form-label">Occupant Order</label>
                      <div class="col-sm-10">
                          <div class="form-floating mb-3">
                              <select class="@error('oc_list') is-invalid @enderror form-select" form="building" id="oc_list" aria-label="State" name="oc_list" :value="{{ old('oc_list') }}" required>
                                  <option selected disabled>Choose Order</option>
                                  @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{ $i }}" {{ old('oc_list') == $i ? 'selected' : '' }} 
                                    {{ in_array($i, $existingOccupantOrder) ? 'disabled' : '' }}>{{ $i }}</option>
                                  @endfor
                              </select>
                              <label for="oc_lists">Order Lists</label>
                          </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="oc_name" class="col-sm-2 col-form-label">Occupant Name</label>
                      <div class="col-sm-10">
                          <div class="form-floating mb-3">
                              <select class="@error('oc_name') is-invalid @enderror form-select" form="building" id="oc_name" aria-label="State" name="oc_name" :value="{{ old('oc_name') }}" required>
                                  <option selected disabled>Choose Name</option>
                                  @foreach ($citizens as $citizen)
                                    <option value="{{ $citizen->fullname }}" {{ old('oc_name') == $citizen->id ? 'selected' : '' }}>{{ $citizen->fullname }}</option>
                                  @endforeach
                              </select>
                              <label for="oc_name">Citizen Lists</label>
                          </div>
                      </div>
                    </div>       
    
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">House Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="@error('house') is-invalid @enderror form-check-input" type="radio" name="house" id="house-occupied" value="Occupied" checked>
                                <label class="form-check-label" for="house-occupied">
                                    Occupied
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="@error('house') is-invalid @enderror form-check-input" type="radio" name="house" id="house-unoccupied" value="Unoccupied">
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
                      </div>
                    </div>
        
                  </form>
        
                </div>
              </div>
        
            </div>
          </div>
        </section>

        <script>
          document.addEventListener('DOMContentLoaded', function () {
          const houseNumberSelect = document.getElementById('house_number');
          const occupantOrderSelect = document.getElementById('oc_list');

          function disableDatabaseOptions() {
              const existingHouseNumber = @json($existingHouseNumber); // Data from controller
              const existingOccupantOrder = @json($existingOccupantOrder); // Data from controller

              // Nonaktifkan house_number yang sudah ada di database
              existingHouseNumber.forEach(number => {
                  const houseOption = houseNumberSelect.querySelector(`option[value="${number}"]`);
                  if (houseOption) {
                      houseOption.disabled = true;
                  }
              });

              // Nonaktifkan oc_list yang sudah ada di database
              existingOccupantOrder.forEach(order => {
                  const occupantOption = occupantOrderSelect.querySelector(`option[value="${order}"]`);
                  if (occupantOption) {
                      occupantOption.disabled = true;
                  }
              });
          }

          function disableSelectedOptions() {
              // Memastikan tidak menonaktifkan oc_list yang sedang dipilih
              [...occupantOrderSelect.options].forEach(option => {
                  option.disabled = false;
              });

              // Re-apply database disabling (supaya pilihan dari database tetap dinonaktifkan)
              disableDatabaseOptions();
          }

          houseNumberSelect.addEventListener('change', disableSelectedOptions);

          // Menonaktifkan opsi berdasarkan database ketika halaman dimuat pertama kali
          disableDatabaseOptions();
        });
        </script>
@endsection
