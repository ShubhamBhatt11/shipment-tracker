@extends('layouts.app')

@section('content')

    <div class="mb-3">
        <a href="{{ route('shipments.index') }}" class="btn btn-sm btn-outline-secondary">&larr; Back to list</a>
    </div>

    <div class="row g-4">

        {{-- LEFT: Shipment Details --}}
        <div class="col-md-7">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Shipment Details</span>
                    @php
                        $badge = match($shipment->status) {
                            'Delivered'  => 'success',
                            'In Transit' => 'warning',
                            default      => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $shipment->status }}</span>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">
                        Tracking: <strong class="text-dark font-monospace">{{ $shipment->tracking_number }}</strong>
                        &nbsp;·&nbsp; Date: {{ $shipment->created_at->format('d M Y') }}
                    </p>

                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Sender</p>
                            <p class="mb-0 fw-semibold">{{ $shipment->sender_name }}</p>
                            <p class="text-muted small">{{ $shipment->sender_address }}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-muted small mb-1 fw-semibold text-uppercase">Receiver</p>
                            <p class="mb-0 fw-semibold">{{ $shipment->receiver_name }}</p>
                            <p class="text-muted small">{{ $shipment->receiver_address }}</p>
                        </div>
                    </div>

                    <div class="mt-2">
                        <p class="text-muted small mb-1 fw-semibold text-uppercase">Destination City</p>
                        <p class="mb-0">{{ $shipment->destination_city }}</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT: Status Timeline --}}
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white fw-semibold">
                    Status Timeline
                </div>
                <div class="card-body">

                    @if($shipment->statusLogs->isEmpty())
                        <p class="text-muted small">No status updates yet.</p>
                    @else
                        <ul class="list-unstyled mb-0">
                            @foreach($shipment->statusLogs as $log)
                                <li class="d-flex gap-3 mb-3">

                                    {{-- Timeline dot + connector line --}}
                                    <div class="d-flex flex-column align-items-center" style="width: 20px;">
                                        @php
                                            $dotColor = match($log->status) {
                                                'Delivered'  => '#198754',
                                                'In Transit' => '#ffc107',
                                                default      => '#6c757d',
                                            };
                                        @endphp
                                        <div style="width:14px; height:14px; border-radius:50%;
                                                    background:{{ $dotColor }};
                                                    flex-shrink:0; margin-top:3px;"></div>
                                        @if(!$loop->last)
                                            <div style="width:2px; flex:1; background:#dee2e6; margin:4px 0;"></div>
                                        @endif
                                    </div>

                                    {{-- Log content --}}
                                    <div class="pb-1">
                                        <p class="mb-0 fw-semibold small">{{ $log->status }}</p>
                                        <p class="mb-0 text-muted small">{{ $log->location }}</p>
                                        <p class="mb-0 text-muted" style="font-size:11px;">
                                            {{ $log->created_at->format('d M Y, h:i A') }}
                                        </p>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>

        </div>

    </div>

@endsection
