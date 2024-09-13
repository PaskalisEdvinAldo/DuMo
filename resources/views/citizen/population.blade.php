@extends('layouts.main')

@section('citizen')
    <div class="pagetitle">
      <h1>Population Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item">Citizen</li>
          <li class="breadcrumb-item active">Population</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
    
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Citizen Population</h5>
              <p>This data is a collection of old and new resident data.</p>
    
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>Name</b>
                    </th>
                    <th>Phone Number</th>
                    <th>Marital Status</th>
                    <th data-type="date" data-format="DD/MM/YYYY">Joining Date</th>
                    <th>Resident Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($citizens) && $citizens->isNotEmpty())
                    @foreach($citizens as $citizen)
                      <tr>
                        <td>{{ $citizen->fullname }}</td>
                        <td>{{ $citizen->phone }}</td>
                        <td>{{ $citizen->marital }}</td>
                        <td>{{ $citizen->join_date }}</td>
                        <td>{{ $citizen->res_stats }}</td>
                        <td>
                          <div>
                            <a href="{{ route('citizen.edit', ['id' => $citizen->id]) }}" class="btn btn-warning m-1 btn-sm">
                                <i class="bi bi-pencil-square"></i>
                                <span>Update</span>
                            </a>
                            <form action="{{ route('citizen.destroy', ['id' => $citizen->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1 btn-sm delete-button" data-citizen-id="{{ $citizen->id }}">
                                    <i class="bi bi-trash-fill"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
    
            </div>
          </div>
    
        </div>
      </div>
    </section>
@endsection