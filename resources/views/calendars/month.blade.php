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


  {{--
  @if($i == 4) active show @endif
  month 
  @if($i < 13) {{$i++}} @else {{($i++) - 12}} @endif
  @if($i < 13) {{$i}} @else {{$i - 12}} @endif -tab
  --}}

<ul class="nav nav-tabs" role="tablist">
  
  @for($i = 4; $i <= 15; $i++)
  <li class="nav-item">
    <!-- タブの名前 -->
    <a id="{{$i < 13 ? 'month'.$i.'-tab' : 'month'.($i - 12).'-tab'}}" href="{{$i < 13 ? '#month'.$i :'#month'.($i - 12)}}" class="nav-link {{$i == 4 ? 'active' : ''}}" data-toggle="tab" role="tab" aria-controls="{{$i < 13 ? 'month'.$i : 'month'.($i - 12)}}" aria-selected="{{$i == 4 ? 'true' : 'false'}}">
    @if($i < 13) {{$i}} @else {{$i - 12}} @endif</a>
  </li>
  @endfor
  
</ul>

  <!-- ここまでループ -->
{{-- <div class="tab-content" id="nav-tabContent"> --}}
  <form action="#" method="GET">
  <!-- ここからループ(12回) -->
  
  <?php $i = 4; ?>
  
  <!-- カレンダー -->
  <div class="tab-content">
    @foreach ($allDates ?? array() as $dates)
    <div id="{{$i < 13 ? 'month'.$i : 'month'.($i - 12)}}" class="tab-pane fade {{$i == 4 ? 'show active' : ''}}" role="tabpanel" aria-labelledby="{{$i < 13 ? 'month'.$i.'-tab' : 'month'.($i - 12).'-tab'}}">
      <!--ここにカレンダー-->
      {{$i}}
      <?php $i++; ?>
    </div>
    @endforeach
  </div>
  
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
  
  <!-- ここまでループ -->
  <input class="btn btn-warning" type="submit" value="登録">
</form>