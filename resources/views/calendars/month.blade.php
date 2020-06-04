<h1>{{ $test }}</h1>

<form action="#" method="GET">
  <input class="btn btn-warning" type="submit" value="やばい">
<table class="table table-bordered">
  <thead>
    <tr>
      @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
      <th>{{ $dayOfWeek }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($dates ?? array() as $date)
    @if ($date->dayOfWeek == 0)
    <tr>
    @endif
      <td
        @if ($date->month != ($currentMonth = 5))
        class="bg-secondary"
        @endif
        @foreach ($holidays as $holiday)
        @if ($date === $holiday)
        class="bg-warning"
        @endif
      @endforeach
      >

      <input type="checkbox" name="dates[]" class="check_box" id="{{ $date->month.$date->day }}" value="{{ $date->month.$date->day }}" />
      <label class="label" for="{{ $date->month.$date->day }}">{{ $date->day }}</label>
      </td>
    @if ($date->dayOfWeek == 6)
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</form>