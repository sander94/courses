@extends('layouts.web')

@section('content')

@include('partials.admin.submenu')

<style>
.month-card {
    background-color: #FFFFFF;
    border-radius: 10px;
}
</style>

    <div class="content p-4">
        <div class="row">

 @foreach($views as $month => $viewItems)
            <div class="col-3 month-card p-4">

               <strong style="color: #F66F4D;"> {{ $month }} </strong>
                    <table class="mt-2">
                        <tr>
                            <td style="width: 150px;">
                                <strong>Kuu</strong>
                            </td>
                            <td style="width: 100px;">
                                <strong>Klikid</strong>
                            </td>
                        </tr>
                        @foreach($viewItems as $view)
                            <tr>
                                <td>
                                    {{ Carbon\Carbon::parse($view->date)->format('m.Y') }}
                                </td>
                                <td>
                                    {{ $view->views*3 }}
                                </td>
                            </tr>
                        @endforeach
                    </table>

            </div>
         @endforeach

        </div>
    </div>

@endsection
