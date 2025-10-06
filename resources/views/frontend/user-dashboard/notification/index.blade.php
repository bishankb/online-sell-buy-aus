@extends('layouts.user-dashboard')

@section('frontend-style')
    <style>
        @media only screen and (max-width: 580px)  {
            .table1 td:nth-of-type(1):before { content: "Id"; }
            .table1 td:nth-of-type(2):before { content: "Notification"; }
            .table1 td:nth-of-type(3):before { content: "Read"; }
            .table1 td:nth-of-type(4):before { content: "Read At"; }
            .table1 td:nth-of-type(5):before { content: "Action"; }
        }

        @media only screen and (min-width: 580px)  {
            .notify-id {
                width: 5% !important;
            }

            .notify-notification {
                width: 50% !important;
            }

            .notify-action {
                width: 10% !important;
            }
        }
    </style>
@endsection

@section('user-dashboard-content')
    <div class="user-dashboard-body">
        <h5 class="header-section">Notifications</h5>
        <div class="table-responsive customResp">
            <table id="user-dashboard-dataTable" class="table1 table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="notify-id">#</th>
                        <th class="notify-notification">Notification</th>
                        <th>Read</th>
                        <th>Read At</th>
                        <th class="notify-action">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($notifications as $notification)
                        <tr  @if($notification->read_at == null) class="font-bold" @endif>
                        <td class="notify-id">{{ reversePagination($notifications, $loop) }}</td>    

                            @php $notificationData = json_decode($notification->data, true); @endphp
                            
                            @isset($notificationData['message'])
                                <td class="notify-notification">
                                    {{ $notificationData['message'] }}
                                </td>
                            @endisset
                            @if(isset($notification->read_at))
                                <td>
                                    <a class="red-color" href="{{ url($notificationData['url']). '?' . http_build_query(['notify_id' => $notification->id])}}">Viewed</a>
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($notification->read_at)->format('d M, Y, h:m:s a') }}
                                </td>
                            @else
                                <td>
                                    <a class="red-color"  href="{{ route('notification.read', $notification->id) }}">View Now</a>
                                </td>
                                <td>
                                    Not Read
                                </td>
                            @endif
                            <td class="notify-action">
                                <button class="btn btn-danger btn-sm action-button" data-bs-toggle="modal" data-bs-target="#delete-modal{{$notification->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
            {{ $notifications->links('vendor.pagination.bootstrap-4') }}
        </div>

        @foreach($notifications as $notification)
            <form action="{{ route('notification.destroy', $notification->id) }}" class="pull-xs-right5 card-link" method="POST">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <div class="modal fade" id="delete-modal{{$notification->id}}" role="dialog">
                  @include('backend.partials.delete-modal')
                </div>
            </form>
        @endforeach
    </div>
@endsection
