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
    <a id="@if($i < 13){{'month'.$i.'-tab'}} @else{{'month'.($i - 12).'-tab'}} @endif" href="@if($i < 13){{'#month'.$i}} @else{{'#month'.($i - 12)}} @endif" class="nav-link @if($i == 4) active @endif" data-toggle="tab" role="tab" aria-controls="@if($i < 13){{'month'.$i}} @else{{'month'.($i - 12)}} @endif" aria-selected="@if($i == 4)true @else false @endif">
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
    <div id="@if($i < 13){{'month'.$i}} @else{{'month'.($i - 12)}} @endif" class="tab-pane fade @if($i == 4)show active @endif" role="tabpanel" aria-labelledby="@if($i < 13){{'month'.$i.'-tab'}} @else{{'month'.($i - 12).'-tab'}} @endif">
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


  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">Item#1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">Item#2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item3" role="tab" aria-controls="item3" aria-selected="false">Item#3</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">This is a text of item#1.</div>
    <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">This is a text of item#2.</div>
    <div class="tab-pane fade" id="item3" role="tabpanel" aria-labelledby="item3-tab">This is a text of item#3.</div>
  </div>
</div>