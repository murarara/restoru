<style>
    label{
        cursor: pointer;
        padding:5px;
        border: 1px solid #434343;
        border-radius: 5px;
    }
    input{
        display: none;
    }
    .check_box:checked + .label {
        background-color: orange;
    }
</style>
<form action="#" method="GET">
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
            @if ($date->month != ($currentMonth = 4))
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
    <input class="btn btn-warning" type="submit" value="登録">
</form>