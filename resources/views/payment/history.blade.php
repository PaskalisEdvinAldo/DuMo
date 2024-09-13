@extends('layouts.main')

@section('payment')
    <div class="pagetitle">
      <h1>Payment Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item">Payment</li>
          <li class="breadcrumb-item active">History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
    
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Payment Information</h5>
              <p>This data is a collection of all resident data who already paid the subcription.</p>
    
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>Name</b>
                    </th>
                    <th data-type="date" data-format="DD/MM/YYYY">Invoice Date</th>
                    <th>Payment Method</th>
                    <th>Payment Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($payments) && $payments->isNotEmpty())
                    @foreach($payments as $payment)
                      <tr>
                        <td>{{ $payment->cit_name }}</td>
                        <td>{{ $payment->invoice }}</td>
                        <td>{{ $payment->method }}</td>
                        <td>{{ $payment->category }}</td>
                        <td>
                          <div>
                            <a href="{{ route('payment.edit', ['id' => $payment->id]) }}" class="btn btn-warning m-1 btn-sm">
                                <i class="bi bi-pencil-square"></i>
                                <span>Update</span>
                            </a>
                            <form action="{{ route('payment.destroy', ['id' => $payment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1 btn-sm delete-button" data-payment-id="{{ $payment->id }}">
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