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


<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
  @for($i = 4; $i <= 15; $i++)
    <a class="nav-item nav-link @if($i == 4) active @endif" 
    id="month @if($i < 13) {{$i}} @else {{$i - 12}} @endif -tab" 
    data-toggle="tab" href="#month @if($i < 13) {{$i}} @else {{$i - 12}} @endif" 
    role="tab" aria-controls="@if($i < 13) {{$i}} @else {{$i - 12}} @endif" 
    aria-selected="@if($i == 4) true @else false @endif">
    @if($i < 13) {{$i}} @else {{$i - 12}} @endif</a>
    
  @endfor
  </div>
  <!-- ここまでループ -->
</nav>
<div class="tab-content" id="nav-tabContent">
  <form action="#" method="GET">
  <!-- ここからループ(12回) -->
  
   {{ $i = 4 }}
  
  @foreach ($allDates ?? array() as $dates)
  <div class="tab-pane fade @if($i == 4) active show @endif" 
  id="month @if($i < 13) {{$i++}} @else {{($i++) - 12}} @endif" 
  role="tabpanel" 
  aria-labelledby="@if($i < 13) {{$i}} @else {{$i - 12}} @endif -tab">

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
            @if ($date->month != $currentMonth ?? 4)
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
  </div>
  @endforeach
  <!-- ここまでループ -->
  <input class="btn btn-warning" type="submit" value="登録">
</form>
</div>