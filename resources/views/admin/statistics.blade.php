@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            @foreach($views as $month => $viewItems)
                <div class="col-12">
                    {{ $month }}
                    <table class="mt-5">
                        <tr>
                            <td style="width: 100px;">
                                <strong>Date</strong>
                            </td>
                            <td style="width: 100px;">
                                <strong>Views</strong>
                            </td>
                        </tr>
                        @foreach($viewItems as $view)
                            <tr>
                                <td>
                                    {{ $view->date }}
                                </td>
                                <td>
                                    {{ $view->views }}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            @endforeach
        </div>
    </div>

@endsection
