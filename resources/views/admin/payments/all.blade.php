@extends('admin.layouts.master')

@section("title")
Все платежи
@endsection

@section("content")
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                Все платежи
                <small>
                    Просто список с возможностью поиска
                </small>
            </h2>
            <div class="clearfix">
            </div>
        </div>
        <div class="x_content">
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datatable_wrapper">
                <div class="row">
                    {{-- <div class="col-sm-6">
                        <div class="dataTables_length" id="datatable_length">
                            <label>
                                Show
                                <select aria-controls="datatable" class="form-control input-sm" name="datatable_length">
                                    <option value="10">
                                        10
                                    </option>
                                    <option value="25">
                                        25
                                    </option>
                                    <option value="50">
                                        50
                                    </option>
                                    <option value="100">
                                        100
                                    </option>
                                </select>
                                entries
                            </label>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <form action="{{route("payment.find")}}" class="dataTables_filter" id="datatable_filter" method="get">
                            <label>
                                <input aria-controls="datatable" class="form-control input-sm" placeholder="Поиск по ID платежа" name="id" type="search"/>
                            </label>
                        </form>
                    </div>
                </div>
                {{-- {{dd($payments)}} --}}
                <div class="row">
                    <div class="col-sm-12">
                        <table aria-describedby="datatable_info" class="table table-striped table-bordered dataTable no-footer" id="datatable" role="grid">
                            <thead>
                                <tr role="row">
                                    <th aria-controls="datatable" aria-label="Name: activate to sort column descending" aria-sort="ascending" class="sorting_asc" colspan="1" rowspan="1" style="width: 160px;" tabindex="0">
                                        ID
                                    </th>
                                    <th aria-controls="datatable" aria-label="Position: activate to sort column ascending" class="sorting" colspan="1" rowspan="1" style="width: 261px;" tabindex="0">
                                        Пользователь
                                    </th>
                                    <th aria-controls="datatable" aria-label="Start date: activate to sort column ascending" class="sorting" colspan="1" rowspan="1" style="width: 113px;" tabindex="0">
                                        Сумма
                                    </th>
                                    <th aria-controls="datatable" aria-label="Office: activate to sort column ascending" class="sorting" colspan="1" rowspan="1" style="width: 118px;" tabindex="0">
                                        Дата создания
                                    </th>
                                    <th aria-controls="datatable" aria-label="Age: activate to sort column ascending" class="sorting" colspan="1" rowspan="1" style="width: 59px;" tabindex="0">
                                        Дата оплаты
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($payments) > 0)
                            @foreach($payments as $payment)
                                <tr class="odd" role="row">
                                    <td class="sorting_1">
                                        {{$payment->id}}
                                    </td>
                                    <td>
                                        {{App\User::find($payment->id)->name}}
                                    </td>
                                    <td>
                                        {{$payment->payment}}
                                    </td>
                                    <td>
                                        {{$payment->created_at}}
                                    </td>
                                    <td>
                                        {{$payment->payment_date}}
                                    </td>
                                </tr>
                            @endforeach
                            @else 
                            <p>Платежей нет</p>
                            @endif
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                @if(count($payments) > 10)
                {{$payments->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
