@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        報告
    </div>

    <div class="card-body">
        @if(auth()->user()->is_admin)
            <form>
                <div class="form-group">
                    <label class="required" for="employee">職員</label>
                    <select class="form-control" name="employee" id="employee">
                        <option hidden>選擇一位職員</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request()->input('employee') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        @endif
        @if ((!auth()->user()->is_admin || request()->input('employee')) && ($timeEntries))
            <div class="row">
                <div class="{{ $chart->options['column_class'] }}">
                    <h3>{!! $chart->options['chart_title'] !!}</h3>
                    {!! $chart->renderHtml() !!}
                </div>

                <div class="col-md-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        日期
                                    </th>
                                    <th>
                                        累計時間
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dateRange as $date)
                                    <tr>
                                        <td>
                                            {{ $date }}
                                        </td>
                                        <td>
                                            {{ gmdate("H:i:s", $timeEntries[$date] ?? 0) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">選擇一位職員來瀏覽出勤報告</p>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@if ($chart)
{!! $chart->renderJs() !!}
@endif
<script>
$(function () {
    $('#employee').change(function () {
        $(this).parents('form').submit();
    });
});
</script>
@endsection
