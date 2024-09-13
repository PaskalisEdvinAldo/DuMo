@extends('layouts.main')

@section('residence')
    <div class="pagetitle">
      <h1>Population Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('residence.show') }}">Resident</a></li>
          <li class="breadcrumb-item active">Resident History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
    
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">House Member History</h5>
              <p>This data is a collection of old and new resident data from this house.</p>
    
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>Name</b>
                    </th>
                    <th>House Number</th>
                    <th>Occupant Order</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($residences) && $residences->isNotEmpty())
                    @foreach($residences as $residence)
                            <tr>
                                <td>{{ $residence->oc_name }}</td>
                                <td>{{ $residence->house_number }}</td>
                                <td>{{ $residence->oc_list }}</td>
                                <td>
                                <div>
                                    <form action="{{ route('residence.destroy', ['id' => $residence->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger m-1 btn-sm delete-button" data-residence-id="{{ $residence->id }}">
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