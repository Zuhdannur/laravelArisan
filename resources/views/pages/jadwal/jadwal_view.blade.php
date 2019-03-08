@extends('layouts.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jadwal</h4>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extras-js')
    <script src="{{ asset('assets') }}/js/plugin/fullcalendar/fullcalendar.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var className = Array('fc-primary', 'fc-danger', 'fc-default', 'fc-success', 'fc-info', 'fc-warning', 'fc-danger-solid', 'fc-warning-solid', 'fc-success-solid', 'fc-default-solid', 'fc-success-solid', 'fc-primary-solid');

            $calendar = $('#calendar');
            $calendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                selectable : true,
                selectHelper: true,
                select: function(start, end) {
                    // on select we show the Sweet Alert modal with an input
                    swal({
                        title: 'Create an Event',
                        html: '',
                        content: {
                            element: "input",
                            attributes: {
                                placeholder: "Event Title",
                                type: "text",
                                id: "input-field",
                                className: "form-control"
                            },
                        },
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                    }).then(
                        function() {
                            var eventData;
                            var classRandom = className[Math.floor(Math.random()*className.length)];
                            event_title = $('#input-field').val();
                            var tgl = new Date(start);
                            var formated = moment(tgl).format('YYYY-MM-DD');
                            if (event_title) {
                                $.ajax({
                                    type:'POST',
                                    url:'/jadwal',
                                    data:{
                                        'title':event_title,
                                        'start':formated,
                                        'className':classRandom,
                                        'end':formated
                                    },
                                    success:function(data){
                                        console.log(data);
                                    }
                                })
                                eventData = {
                                    title: event_title,
                                    start: start,
                                    className: classRandom,
                                    end: end
                                };
                                $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                            }

                            $calendar.fullCalendar('unselect');
                        }
                    );
                },
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        className: 'fc-default'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        className: 'fc-warning'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false,
                        className: 'fc-info'
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        className: 'fc-danger'
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        className: 'fc-primary',
                        description: 'Eat Bro'
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d + 3, 13, 30),
                        allDay: false,
                        className: 'fc-primary-solid',
                        description: 'Meeting'
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        className: 'fc-success',
                        description: 'Coba Googling dulu'
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d + 6, 13, 30),
                        allDay: false,
                        className: 'fc-success-solid',
                        description: 'Lunch'
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        allDay: false,
                        url: 'http://google.com/',
                        className: 'fc-info-solid',
                    }
                ],

            });
        })
    </script>
@endpush


