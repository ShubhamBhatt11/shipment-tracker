@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">All Shipments</h4>
        <form method="GET" action="{{ route('shipments.index') }}" class="d-flex gap-2">
            <input
                type="text"
                name="search"
                class="form-control form-control-sm"
                placeholder="Search tracking number..."
                value="{{ request('search') }}"
                style="width: 240px;"
            >
            <button type="submit" class="btn btn-sm btn-dark">Search</button>
            @if(request('search'))
                <a href="{{ route('shipments.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
            @endif
        </form>
    </div>

    @if($shipments->isEmpty())
        <div class="alert alert-info">No shipments found.</div>
    @else
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>Tracking Number</th>
                        <th>Receiver Name</th>
                        <th>Destination City</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shipments as $shipment)
                        <tr>
                            <td class="fw-semibold font-monospace">{{ $shipment->tracking_number }}</td>
                            <td>{{ $shipment->receiver_name }}</td>
                            <td>{{ $shipment->destination_city }}</td>
                            <td>
                                @php
                                    $badge = match($shipment->status) {
                                        'Delivered'  => 'success',
                                        'In Transit' => 'warning',
                                        default      => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $shipment->status }}</span>
                            </td>
                            <td class="text-muted small">{{ $shipment->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('shipments.show', $shipment) }}" class="btn btn-sm btn-outline-dark">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <p class="text-muted small mb-0">
                Showing {{ $shipments->firstItem() }}–{{ $shipments->lastItem() }} of {{ $shipments->total() }} shipments
            </p>
            {{ $shipments->links() }}
        </div>
    @endif

@endsection
