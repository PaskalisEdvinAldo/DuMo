@extends('layouts.main')

@section('residence')
    <div class="pagetitle">
      <h1>Property Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item">Residence</li>
          <li class="breadcrumb-item active">Resident</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
      <div class="row align-items-top">

        @if($residences->count() > 0)
          @php
            $groupedResidences = $residences->groupBy('house_number');
          @endphp

          @foreach($groupedResidences as $house_number => $residencesByHouse)
            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Rumah {{ $house_number }}</h5>
                  
                  <h6 class="card-subtitle mb-2 text-muted">Penghuni:</h6>
                  <ul>
                    @foreach($residencesByHouse as $residence)
                      <li>{{ $residence->oc_name }}</li>
                    @endforeach
                  </ul>
                  <h6 class="card-subtitle mb-2 text-muted">House Status: 
                    @if($residence->house == 'Occupied')
                        <span class="badge bg-success">{{ $residence->house }}</span>
                    @else
                        <span class="badge bg-danger">{{ $residence->house }}</span>
                    @endif
                  </h6>
                  
                  <p class="card-text">
                    <a href="{{ route('residence.history') }}" class="btn btn-primary"><i class="bi bi-file-earmark-person-fill"></i></a>
                    <a href="#" class="btn btn-warning"><i class="bi bi-currency-dollar"></i></a>
                    <a href="{{ route('residence.edit', ['id' => $residence->first()->id]) }}" class="btn btn-info"><i class="bi bi-people-fill"></i></a>
                  </p>
                </div>
              </div><!-- End Card with titles, buttons, and links -->  
            </div>
          @endforeach

        @else
          <p>No residence data available.</p>
        @endif

      </div>
    </section>
@endsection
